<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Director;
use App\Models\LandingPageSetting;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SuperadminController extends Controller
{
    /**
     * Display the Unified Superadmin Landing Page and Database Management Control Center.
     */
    public function index(Request $request)
    {
        // Active editing tab
        $activeTab = $request->get('tab', 'overview');
        $activeSubTab = $request->get('subtab', 'about');
        $editLocale = $request->get('lang', session('locale', 'id'));
        if (!in_array($editLocale, ['id', 'en', 'ja'])) {
            $editLocale = 'id';
        }
        session(['locale' => $editLocale]);
        app()->setLocale($editLocale);

        // Load all settings
        $settings = LandingPageSetting::allKeyed();

        // Data for unified management
        $newsList = News::latest()->get();
        $productsList = Product::ordered()->get();
        $directorsList = Director::ordered()->get();
        $heroSlides = LandingPageSetting::getHeroSlides();

        $stats = [
            'total_news' => News::count(),
            'published_news' => News::published()->count(),
            'total_products' => Product::count(),
            'featured_products' => Product::where('is_featured', true)->count(),
            'total_directors' => Director::count(),
            'hero_slides_count' => count($heroSlides),
            'news_count' => News::count(),
            'products_count' => Product::count(),
            'directors_count' => Director::count(),
        ];

        $techGalleryImages = LandingPageSetting::getTechGalleryImages();
        $innovGalleryImages = LandingPageSetting::getInnovGalleryImages();

        return view('superadmin.index', compact(
            'settings',
            'heroSlides',
            'newsList',
            'productsList',
            'directorsList',
            'stats',
            'editLocale',
            'activeTab',
            'activeSubTab',
            'techGalleryImages',
            'innovGalleryImages'
        ));
    }

    /**
     * Safely store an uploaded file across environments (local, standard hosting, Vercel serverless).
     * Prevents read-only filesystem exceptions on Vercel by trying writable paths and fallbacks.
     *
     * @param \Illuminate\Http\UploadedFile|mixed $file
     * @param string $folder Relative path, e.g. 'images/news', 'images/products', 'images/bod', 'images/hero'
     * @param string|null $prefix Optional filename prefix
     * @return string|null Web-accessible path or data URI
     */
    protected function storeUploadedFile($file, string $folder = 'images/news', ?string $prefix = null): ?string
    {
        if (!$file || !is_object($file) || !method_exists($file, 'isValid') || !$file->isValid()) {
            return null;
        }

        $folder = trim($folder, '/');
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $baseName = $prefix ? Str::slug($prefix) : Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename = time() . '_' . uniqid() . ($baseName ? '_' . $baseName : '') . '.' . $ext;

        // 1. Try public_path first (standard hosting / localhost)
        $publicDir = public_path($folder);
        try {
            if (!is_dir($publicDir)) {
                @mkdir($publicDir, 0755, true);
            }
            if (is_dir($publicDir) && is_writable($publicDir)) {
                $file->move($publicDir, $filename);
                return '/' . $folder . '/' . $filename;
            }
        } catch (\Throwable $e) {
            // Read-only filesystem fallback
        }

        // 2. Try storage_path('app/public/...') (writable /tmp/storage on Vercel)
        try {
            $storageDir = storage_path('app/public/' . $folder);
            if (!is_dir($storageDir)) {
                @mkdir($storageDir, 0755, true);
            }
            if (is_dir($storageDir) && is_writable($storageDir)) {
                $file->move($storageDir, $filename);
                return '/storage/' . $folder . '/' . $filename;
            }
        } catch (\Throwable $e) {
            // Fall through
        }

        // 3. Try sys_get_temp_dir()
        try {
            $tmpDir = sys_get_temp_dir() . '/' . $folder;
            if (!is_dir($tmpDir)) {
                @mkdir($tmpDir, 0755, true);
            }
            if (is_dir($tmpDir) && is_writable($tmpDir)) {
                $file->move($tmpDir, $filename);
                return '/images/' . $folder . '/' . $filename;
            }
        } catch (\Throwable $e) {
            // Fall through
        }

        // 4. Safe serverless fallback: Base64 data URI for images
        try {
            $mime = $file->getMimeType() ?: ('image/' . $ext);
            if (str_starts_with($mime, 'image/')) {
                $realPath = method_exists($file, 'getRealPath') ? $file->getRealPath() : null;
                if ($realPath && file_exists($realPath)) {
                    $content = @file_get_contents($realPath);
                    if ($content !== false && strlen($content) > 0) {
                        return 'data:' . $mime . ';base64,' . base64_encode($content);
                    }
                }
            }
        } catch (\Throwable $e) {
            // Never throw unhandled exception
        }

        return null;
    }

    /**
     * Save landing page content & profile settings.
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', 'redirect_tab', 'redirect_lang', 'redirect_subtab']);

        // 1. Handle multi-file uploads & existing gallery for Technology
        if ($request->has('tech_gallery_submitted') || $request->hasFile('tech_gallery_new_files') || $request->has('tech_gallery_existing')) {
            $currentTechImages = $request->input('tech_gallery_existing', []);
            if (!is_array($currentTechImages)) {
                $currentTechImages = [];
            }
            if ($request->hasFile('tech_gallery_new_files')) {
                $uploadedTechFiles = $request->file('tech_gallery_new_files');
                if (!is_array($uploadedTechFiles)) {
                    $uploadedTechFiles = [$uploadedTechFiles];
                }
                foreach ($uploadedTechFiles as $tFile) {
                    if ($path = $this->storeUploadedFile($tFile, 'images/hero', 'tech_gallery')) {
                        $currentTechImages[] = $path;
                    }
                }
            }
            // If empty (e.g. no changes submitted or deleted all), preserve defaults if no delete was intended
            if (empty($currentTechImages) && !$request->has('tech_gallery_submitted')) {
                $currentTechImages = LandingPageSetting::getTechGalleryImages();
            }
            LandingPageSetting::saveTechGalleryImages($currentTechImages);
            if (!empty($currentTechImages)) {
                $data['tech_image'] = $currentTechImages[0];
            }
            unset($data['tech_gallery_new_files'], $data['tech_gallery_existing'], $data['tech_gallery_submitted']);
        }

        // 2. Handle multi-file uploads & existing gallery for Innovation
        if ($request->has('innov_gallery_submitted') || $request->hasFile('innov_gallery_new_files') || $request->has('innov_gallery_existing')) {
            $currentInnovImages = $request->input('innov_gallery_existing', []);
            if (!is_array($currentInnovImages)) {
                $currentInnovImages = [];
            }
            if ($request->hasFile('innov_gallery_new_files')) {
                $uploadedInnovFiles = $request->file('innov_gallery_new_files');
                if (!is_array($uploadedInnovFiles)) {
                    $uploadedInnovFiles = [$uploadedInnovFiles];
                }
                foreach ($uploadedInnovFiles as $iFile) {
                    if ($path = $this->storeUploadedFile($iFile, 'images/business', 'innov_gallery')) {
                        $currentInnovImages[] = $path;
                    }
                }
            }
            if (empty($currentInnovImages) && !$request->has('innov_gallery_submitted')) {
                $currentInnovImages = LandingPageSetting::getInnovGalleryImages();
            }
            LandingPageSetting::saveInnovGalleryImages($currentInnovImages);
            if (!empty($currentInnovImages)) {
                $data['innov_image'] = $currentInnovImages[0];
            }
            unset($data['innov_gallery_new_files'], $data['innov_gallery_existing'], $data['innov_gallery_submitted']);
        }

        // Handle dynamic single file uploads (any input ending with '_file')
        foreach ($request->allFiles() as $fileKey => $file) {
            if (in_array($fileKey, ['tech_gallery_new_files', 'innov_gallery_new_files'])) {
                continue;
            }
            $targetSettingKey = preg_replace('/_file$/', '', $fileKey);
            $folder = str_contains($targetSettingKey, 'tech') ? 'images/hero' : 'images/business';
            if ($path = $this->storeUploadedFile($file, $folder, $targetSettingKey)) {
                $data[$targetSettingKey] = $path;
            }
            unset($data[$fileKey]);
        }

        foreach ($data as $key => $value) {
            LandingPageSetting::set($key, $value);
        }

        LandingPageSetting::clearCache();

        $tab = $request->input('redirect_tab', 'overview');
        $lang = $request->input('redirect_lang', 'id');
        $subtab = $request->input('redirect_subtab');

        $redirectParams = ['tab' => $tab, 'lang' => $lang];
        if ($subtab) {
            $redirectParams['subtab'] = $subtab;
        }

        return redirect()
            ->route('superadmin.index', $redirectParams)
            ->with('success', 'Konten berhasil diperbarui dan telah diterapkan ke Landing Page!');
    }

    /**
     * Update Hero Visual Slider (handles video & image upload for slides).
     */
    public function updateHero(Request $request)
    {
        $slidesData = $request->input('slides', []);
        $existingSlides = LandingPageSetting::getHeroSlides();
        $updatedSlides = [];

        foreach ($slidesData as $index => $slideInput) {
            $slideId = $slideInput['id'] ?? ($index + 1);
            $existing = collect($existingSlides)->firstWhere('id', (int)$slideId) ?? [];

            $mediaType = $slideInput['media_type'] ?? ($existing['media_type'] ?? 'image');
            $mediaUrl = $slideInput['media_url'] ?? ($existing['media_url'] ?? '');

            // Handle file upload for this slide (Video or Image)
            if ($request->hasFile("slide_media_{$index}")) {
                $file = $request->file("slide_media_{$index}");
                if ($file && $file->isValid()) {
                    $ext = strtolower($file->getClientOriginalExtension());
                    $isVideo = in_array($ext, ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv']) || str_starts_with($file->getMimeType() ?: '', 'video/');
                    $folder = $isVideo ? 'videos/hero' : 'images/hero';
                    
                    if ($path = $this->storeUploadedFile($file, $folder, "slide_{$slideId}")) {
                        $mediaUrl = $path;
                        $mediaType = $isVideo ? 'video' : 'image';
                    }
                }
            }

            $updatedSlides[] = [
                'id' => (int)$slideId,
                'badge' => $slideInput['badge'] ?? ($existing['badge'] ?? 'Musashi Precision'),
                'headline_id' => $slideInput['headline_id'] ?? ($existing['headline_id'] ?? ''),
                'headline_en' => $slideInput['headline_en'] ?? ($existing['headline_en'] ?? ''),
                'headline_ja' => $slideInput['headline_ja'] ?? ($existing['headline_ja'] ?? ''),
                'subtitle_id' => $slideInput['subtitle_id'] ?? ($existing['subtitle_id'] ?? ''),
                'subtitle_en' => $slideInput['subtitle_en'] ?? ($existing['subtitle_en'] ?? ''),
                'subtitle_ja' => $slideInput['subtitle_ja'] ?? ($existing['subtitle_ja'] ?? ''),
                'description_id' => $slideInput['description_id'] ?? ($existing['description_id'] ?? ''),
                'description_en' => $slideInput['description_en'] ?? ($existing['description_en'] ?? ''),
                'description_ja' => $slideInput['description_ja'] ?? ($existing['description_ja'] ?? ''),
                'media_type' => $mediaType,
                'media_url' => $mediaUrl,
                'cta_text_id' => $slideInput['cta_text_id'] ?? ($existing['cta_text_id'] ?? ''),
                'cta_text_en' => $slideInput['cta_text_en'] ?? ($existing['cta_text_en'] ?? ''),
                'cta_text_ja' => $slideInput['cta_text_ja'] ?? ($existing['cta_text_ja'] ?? ''),
                'cta_link' => $slideInput['cta_link'] ?? ($existing['cta_link'] ?? ''),
                'show_gofarbeyond' => !empty($slideInput['show_gofarbeyond']),
                'is_active' => !empty($slideInput['is_active']),
            ];
        }

        // Add a new slide if requested
        if ($request->input('action') === 'add_slide') {
            $newId = count($updatedSlides) > 0 ? max(array_column($updatedSlides, 'id')) + 1 : 1;
            $updatedSlides[] = [
                'id' => $newId,
                'badge' => 'New Innovation',
                'headline_id' => 'Judul Slide Baru',
                'headline_en' => 'New Slide Headline',
                'headline_ja' => '新しいスライド見出し',
                'subtitle_id' => 'Sub-headline keterangan slide baru',
                'subtitle_en' => 'New slide subtitle description',
                'subtitle_ja' => '新しいスライドのサブタイトル',
                'description_id' => 'Deskripsi inovasi baru Musashi Indonesia.',
                'description_en' => 'Description of new Musashi Indonesia innovation.',
                'description_ja' => '武蔵インドネシアの新しいイノベーションの説明。',
                'media_type' => 'image',
                'media_url' => '/images/hero/hero-plant.jpg',
                'cta_text_id' => 'Selengkapnya',
                'cta_text_en' => 'Learn More',
                'cta_text_ja' => '詳細を見る',
                'cta_link' => '/product',
                'show_gofarbeyond' => false,
                'is_active' => true,
            ];
        }

        // Save announcement bar if present
        if ($request->has('announcement_bar_enabled')) {
            LandingPageSetting::set('announcement_bar_enabled', $request->input('announcement_bar_enabled'));
        }
        $editLocale = $request->input('redirect_lang', 'id');
        if ($request->has("announcement_bar_text_{$editLocale}")) {
            LandingPageSetting::set("announcement_bar_text_{$editLocale}", $request->input("announcement_bar_text_{$editLocale}"));
        }

        LandingPageSetting::saveHeroSlides($updatedSlides);
        LandingPageSetting::clearCache();

        $lang = $request->input('redirect_lang', 'id');
        return redirect()
            ->route('superadmin.index', ['tab' => 'hero', 'lang' => $lang])
            ->with('success', 'Hero Visual Slider & Media (Video/Foto) berhasil diperbarui dan telah diterapkan ke Landing Page!');
    }

    /**
     * Delete a Hero Slide.
     */
    public function deleteHeroSlide(Request $request)
    {
        $slideId = (int)$request->input('slide_id');
        $slides = LandingPageSetting::getHeroSlides();
        $filtered = array_values(array_filter($slides, fn($s) => ((int)($s['id'] ?? 0)) !== $slideId));
        
        LandingPageSetting::saveHeroSlides($filtered);
        LandingPageSetting::clearCache();

        $lang = $request->input('redirect_lang', 'id');
        return redirect()
            ->route('superadmin.index', ['tab' => 'hero', 'lang' => $lang])
            ->with('success', 'Slide Hero berhasil dihapus!');
    }

    /**
     * Quick toggle news publish status for landing page.
     */
    public function toggleNews(News $news)
    {
        if ($news->published_at) {
            $news->update(['published_at' => null]);
            $msg = 'disembunyikan (draft)';
        } else {
            $news->update(['published_at' => now()]);
            $msg = 'diterbitkan (tayang)';
        }

        return back()->with('success', "Status berita '{$news->title}' berhasil diubah menjadi {$msg}!");
    }

    /**
     * Create a new News item.
     */
    public function storeNews(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'published_at' => 'nullable',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable',
            'image' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'nullable',
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $validated['slug'] = $slug;
        $validated['is_featured'] = $request->boolean('is_featured');
        if ($request->boolean('is_published', true)) {
            $validated['published_at'] = $request->filled('published_at')
                ? \Carbon\Carbon::parse($request->input('published_at'))
                : now();
        } else {
            $validated['published_at'] = null;
        }

        // Multi-image upload handling (supports up to 10+ images)
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                if ($path = $this->storeUploadedFile($file, 'images/news')) {
                    $uploadedImages[] = $path;
                }
            }
        }

        if ($request->hasFile('image')) {
            if ($path = $this->storeUploadedFile($request->file('image'), 'images/news')) {
                if (!in_array($path, $uploadedImages)) {
                    array_unshift($uploadedImages, $path);
                }
            }
        } elseif ($request->filled('image') && is_string($request->input('image'))) {
            $path = $request->input('image');
            if (!in_array($path, $uploadedImages)) {
                array_unshift($uploadedImages, $path);
            }
        }

        if (empty($uploadedImages)) {
            $uploadedImages = ['/images/hero/hero-automotive.jpg'];
        }

        $validated['image'] = $uploadedImages[0];
        $validated['images'] = $uploadedImages;

        News::create($validated);

        return redirect()
            ->route('superadmin.index', ['tab' => 'news', 'lang' => session('locale', 'id')])
            ->with('success', "Berita '{$validated['title']}' dengan " . count($uploadedImages) . " foto berhasil ditambahkan!");
    }

    /**
     * Update an existing News item.
     */
    public function updateNews(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'published_at' => 'nullable',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable',
            'image' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'nullable',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->boolean('is_published')) {
            $validated['published_at'] = $request->filled('published_at')
                ? \Carbon\Carbon::parse($request->input('published_at'))
                : ($news->published_at ?: now());
        } else {
            $validated['published_at'] = null;
        }

        $existingImages = is_array($news->images) ? $news->images : ($news->image ? [$news->image] : []);
        $newUploaded = [];

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                if ($path = $this->storeUploadedFile($file, 'images/news')) {
                    $newUploaded[] = $path;
                }
            }
        }

        if ($request->hasFile('image')) {
            if ($path = $this->storeUploadedFile($request->file('image'), 'images/news')) {
                array_unshift($newUploaded, $path);
            }
        }

        if (!empty($newUploaded)) {
            $combined = array_values(array_unique(array_merge($newUploaded, $existingImages)));
            $validated['images'] = $combined;
            $validated['image'] = $combined[0];
        } else {
            $validated['images'] = $existingImages;
            $validated['image'] = $news->image ?: ($existingImages[0] ?? '/images/hero/hero-automotive.jpg');
        }

        $news->update($validated);

        return redirect()
            ->route('superadmin.index', ['tab' => 'news', 'lang' => session('locale', 'id')])
            ->with('success', "Berita '{$news->title}' berhasil diperbarui!");
    }

    /**
     * Delete a News item.
     */
    public function destroyNews(News $news)
    {
        $title = $news->title;
        $news->delete();

        return redirect()
            ->route('superadmin.index', ['tab' => 'news'])
            ->with('success', "Berita '{$title}' berhasil dihapus dari sistem!");
    }

    /**
     * Quick toggle product featured status for landing page.
     */
    public function toggleProduct(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);
        return back()->with('success', "Status unggulan produk '{$product->name}' berhasil diubah!");
    }

    /**
     * Store new product.
     */
    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'specifications' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'nullable',
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['order'] = $validated['order'] ?? 0;

        // Multi-image upload handling for products (up to 10+ images)
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                if ($path = $this->storeUploadedFile($file, 'images/products')) {
                    $uploadedImages[] = $path;
                }
            }
        }

        if ($request->hasFile('image')) {
            if ($path = $this->storeUploadedFile($request->file('image'), 'images/products')) {
                if (!in_array($path, $uploadedImages)) {
                    array_unshift($uploadedImages, $path);
                }
            }
        } elseif ($request->filled('image') && is_string($request->input('image'))) {
            $path = $request->input('image');
            if (!in_array($path, $uploadedImages)) {
                array_unshift($uploadedImages, $path);
            }
        }

        if (empty($uploadedImages)) {
            $uploadedImages = ['/images/products/product-transmission-gear.jpg'];
        }

        $validated['image'] = $uploadedImages[0];
        $validated['images'] = $uploadedImages;

        Product::create($validated);

        return redirect()
            ->route('superadmin.index', ['tab' => 'products'])
            ->with('success', "Produk '{$validated['name']}' dengan " . count($uploadedImages) . " foto berhasil ditambahkan ke katalog!");
    }

    /**
     * Update product.
     */
    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'specifications' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'nullable',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        $existingImages = is_array($product->images) ? $product->images : ($product->image ? [$product->image] : []);
        $newUploaded = [];

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                if ($path = $this->storeUploadedFile($file, 'images/products')) {
                    $newUploaded[] = $path;
                }
            }
        }

        if ($request->hasFile('image')) {
            if ($path = $this->storeUploadedFile($request->file('image'), 'images/products')) {
                array_unshift($newUploaded, $path);
            }
        }

        if (!empty($newUploaded)) {
            $combined = array_values(array_unique(array_merge($newUploaded, $existingImages)));
            $validated['images'] = $combined;
            $validated['image'] = $combined[0];
        } else {
            $validated['images'] = $existingImages;
            $validated['image'] = $product->image ?: ($existingImages[0] ?? '/images/products/product-transmission-gear.jpg');
        }

        $product->update($validated);

        return redirect()
            ->route('superadmin.index', ['tab' => 'products'])
            ->with('success', "Produk '{$product->name}' berhasil diperbarui!");
    }

    /**
     * Delete product.
     */
    public function destroyProduct(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()
            ->route('superadmin.index', ['tab' => 'products'])
            ->with('success', "Produk '{$name}' berhasil dihapus!");
    }

    /**
     * Store new director.
     */
    public function storeDirector(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer',
            'photo' => 'nullable',
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('photo')) {
            $path = $this->storeUploadedFile($request->file('photo'), 'images/bod', $validated['name']);
            $validated['photo'] = $path ?: '/images/bod/asep-nugraha.jpg';
        } elseif (!$request->filled('photo')) {
            $validated['photo'] = '/images/bod/asep-nugraha.jpg';
        }

        Director::create($validated);

        $lang = $request->input('redirect_lang', session('locale', 'id'));

        return redirect()
            ->route('superadmin.index', ['tab' => 'directors', 'lang' => $lang])
            ->with('success', "Direktur '{$validated['name']}' berhasil ditambahkan!");
    }

    /**
     * Update director.
     */
    public function updateDirector(Request $request, Director $director)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer',
            'photo' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            if ($path = $this->storeUploadedFile($request->file('photo'), 'images/bod', $validated['name'])) {
                $validated['photo'] = $path;
            }
        }

        $director->update($validated);

        $lang = $request->input('redirect_lang', session('locale', 'id'));

        return redirect()
            ->route('superadmin.index', ['tab' => 'directors', 'lang' => $lang])
            ->with('success', "Direktur '{$director->name}' berhasil diperbarui!");
    }

    /**
     * Delete director.
     */
    public function destroyDirector(Request $request, Director $director)
    {
        $name = $director->name;
        $director->delete();

        $lang = $request->input('redirect_lang', session('locale', 'id'));

        return redirect()
            ->route('superadmin.index', ['tab' => 'directors', 'lang' => $lang])
            ->with('success', "Direktur '{$name}' berhasil dihapus!");
    }
}
