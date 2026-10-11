<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MusashiWebsiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_home_page_renders_successfully(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('PT. Musashi Auto Parts Indonesia');
        $response->assertSee('Break Barriers and Go on Adventures!');
    }

    public function test_news_carousel_on_landing_page_renders_with_images_and_multiple_cards(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('id="news"', false);
        $response->assertSee('news-card');
        $response->assertSee('autoScrollTimer');
        $response->assertSee('newsCarousel');
        $content = $response->getContent();
        $this->assertGreaterThanOrEqual(4, substr_count($content, 'news-card'));
        $this->assertStringContainsString('object-cover group-hover:scale-105', $content);
    }

    public function test_company_pages_render_successfully(): void
    {
        $this->get(route('company.about'))->assertStatus(200)->assertSee('About Us');
        $this->get(route('company.message'))->assertStatus(200)->assertSee('Corporate Message');
        $this->get(route('company.philosophy'))->assertStatus(200)->assertSee('Musashi Philosophy');
        $this->get(route('company.vision'))->assertStatus(200)->assertSee('Global Vision');
        $this->get(route('company.outline'))->assertStatus(200)->assertSee('Company Outline');
        $this->get(route('company.bod'))->assertStatus(200)->assertSee('Board of Directors');
        $this->get(route('company.network'))->assertStatus(200)->assertSee('Network');
    }

    public function test_products_render_successfully(): void
    {
        $response = $this->get(route('product.index'));
        $response->assertStatus(200);

        $product = Product::first();
        $this->assertNotNull($product);
        $this->get(route('product.show', $product->slug))->assertStatus(200)->assertSee($product->name);
    }

    public function test_business_pages_render_successfully(): void
    {
        $this->get(route('business.technology'))->assertStatus(200)->assertSee('Technology');
        $this->get(route('business.innovation'))->assertStatus(200)->assertSee('Innovation');
    }

    public function test_news_renders_successfully(): void
    {
        $response = $this->get(route('news.index'));
        $response->assertStatus(200);

        $news = News::first();
        $this->assertNotNull($news);
        $this->get(route('news.show', $news->slug))->assertStatus(200)->assertSee($news->title);
    }

    public function test_sustainability_renders_successfully(): void
    {
        $this->get(route('sustainability.index'))->assertStatus(200)->assertSee('Green Company');
    }

    public function test_careers_and_ir_removed_from_navbar_and_routes(): void
    {
        // Route /careers should no longer exist (404)
        $response = $this->get('/careers');
        $response->assertStatus(404);

        // Home page has exact musashi.co.id navbar structure
        $home = $this->get(route('home'));
        $home->assertStatus(200);
        $home->assertSee('PT. Musashi Auto Parts Indonesia');
        $home->assertSee('Company');
        $home->assertSee('Product');
        $home->assertSee('Business');
        $home->assertSee('News');
        $home->assertSee('Sustainability');
        $home->assertSee('https://career.musashi.co.id/');
        // Company dropdown items
        $home->assertSee('About Us');
        $home->assertSee('Corporate Message');
        $home->assertSee('Philosophy');
        $home->assertSee('Global Vision');
        $home->assertSee('Company Outline');
        $home->assertSee('Board Of Director');
        $home->assertSee('Network');
        // Business dropdown items
        $home->assertSee('Technology');
        $home->assertSee('Innovation');
    }

    public function test_contact_us_completely_removed_and_footer_updated_with_karawang_and_social_links(): void
    {
        // 1. Contact Us redirect
        $this->get('/contact')->assertRedirect('/');

        // 2. Navbar & Footer do NOT contain Contact us
        $home = $this->get(route('home'));
        $home->assertStatus(200);
        $home->assertDontSee('Contact us :');

        // 3. Footer contains Karawang Plant & EJIP Cikarang Plant
        $home->assertSee('Cikarang Plant (Head Office)');
        $home->assertSee('EJIP Industrial Park Plot 3J-2 Cikarang Selatan');
        $home->assertSee('Karawang Plant');
        $home->assertSee('Suryacipta City of Industry Jl. Surya Madya Kav 1-36 BC');
        $home->assertDontSee('+62-21-89115116');
        $home->assertDontSee('karawang.office@musashi.co.id');

        // 4. Footer contains all 4 verified social media & web links
        $home->assertSee('https://youtube.com/@musashi_career?si=9gEY_ceAFkpI7Jnq');
        $home->assertSee('https://www.linkedin.com/company/musashi-auto-parts-indonesia/');
        $home->assertSee('https://www.instagram.com/careermusashi.id?dlrf=MTBvZnMzcGR0dDNvMQ%3D%3D');
        $home->assertSee('https://www.musashi.co.id/');
    }

    public function test_locale_switcher_works(): void
    {
        $response = $this->get(route('locale.switch', 'id'));
        $response->assertSessionHas('locale', 'id');
    }

    public function test_admin_route_no_longer_exists(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(404);
    }

    public function test_superadmin_musashi_requires_authentication(): void
    {
        $response = $this->get('/SuperadminMusashi');
        $response->assertRedirect('/SuperadminMusashi/login');
    }

    public function test_superadmin_can_login_with_valid_credentials(): void
    {
        $response = $this->post('/SuperadminMusashi/login', [
            'email' => 'admin@musashi.co.id',
            'password' => 'password',
        ]);
        $response->assertRedirect('/SuperadminMusashi');
        $this->assertAuthenticated();
    }

    public function test_superadmin_musashi_shows_unified_dashboard_overview(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);
        $response = $this->actingAs($admin)->get('/SuperadminMusashi');
        $response->assertStatus(200)->assertSee('System Overview');
        $response->assertSee('Superadmin Musashi');
        $response->assertSee('/SuperadminMusashi');
    }

    public function test_superadmin_can_update_landing_page_content(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $response = $this->actingAs($admin)->post('/SuperadminMusashi/update', [
            'hero_scene1_headline_id' => 'Musashi Masa Depan Kendaraan Listrik',
            'redirect_tab' => 'hero',
            'redirect_lang' => 'id',
        ]);

        $response->assertRedirect('/SuperadminMusashi?tab=hero&lang=id');
        $this->assertDatabaseHas('landing_page_settings', [
            'key' => 'hero_scene1_headline_id',
            'value' => 'Musashi Masa Depan Kendaraan Listrik',
        ]);

        // Home in Indonesian must reflect the new custom content
        $home = $this->withSession(['locale' => 'id'])->get(route('home'));
        $home->assertStatus(200);
        $home->assertSee('Musashi Masa Depan Kendaraan Listrik');
    }

    public function test_superadmin_can_toggle_news_and_products(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $news = News::first();
        $this->assertNotNull($news);
        $originalStatus = (bool) $news->is_published;

        $response = $this->actingAs($admin)->post(route('superadmin.news.toggle', $news->id));
        $response->assertStatus(302);
        
        $news->refresh();
        $this->assertEquals(!$originalStatus, (bool) $news->is_published);

        $product = Product::first();
        $this->assertNotNull($product);
        $originalFeatured = (bool) $product->is_featured;

        $responseProd = $this->actingAs($admin)->post(route('superadmin.product.toggle', $product->id));
        $responseProd->assertStatus(302);

        $product->refresh();
        $this->assertEquals(!$originalFeatured, (bool) $product->is_featured);
    }

    public function test_tri_lingual_switching_en_id_ja(): void
    {
        // 1. English
        $responseEn = $this->get(route('locale.switch', 'en'));
        $responseEn->assertSessionHas('locale', 'en');
        $homeEn = $this->withSession(['locale' => 'en'])->get(route('home'));
        $homeEn->assertStatus(200);
        $homeEn->assertSee('Company');
        $homeEn->assertSee('Product');
        $homeEn->assertSee('Business');
        $homeEn->assertSee('News');
        $homeEn->assertSee('Sustainability');
        $homeEn->assertSee('Careers');
        $homeEn->assertSee('Our Business & Global Pillars');
        $homeEn->assertDontSee('NEWS & TOPICS');

        // 2. Indonesian
        $responseId = $this->get(route('locale.switch', 'id'));
        $responseId->assertSessionHas('locale', 'id');
        $homeId = $this->withSession(['locale' => 'id'])->get(route('home'));
        $homeId->assertStatus(200);
        $homeId->assertSee('Perusahaan');
        $homeId->assertSee('Produk');
        $homeId->assertSee('Bisnis');
        $homeId->assertSee('Berita');
        $homeId->assertSee('Keberlanjutan');
        $homeId->assertSee('Karier');
        $homeId->assertSee('Bisnis & Pilar Global Kami');
        $homeId->assertDontSee('NEWS & TOPICS');

        // 3. Japanese
        $responseJa = $this->get(route('locale.switch', 'ja'));
        $responseJa->assertSessionHas('locale', 'ja');
        $homeJa = $this->withSession(['locale' => 'ja'])->get(route('home'));
        $homeJa->assertStatus(200);
        $homeJa->assertSee('企業情報');
        $homeJa->assertSee('製品情報');
        $homeJa->assertSee('事業紹介');
        $homeJa->assertSee('ニュース');
        $homeJa->assertSee('サステナビリティ');
        $homeJa->assertSee('採用情報');
        $homeJa->assertSee('事業領域とグローバルピラー');
        $homeJa->assertDontSee('NEWS & TOPICS');
    }

    public function test_superadmin_can_add_news_and_it_appears_on_landing_page(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $uniqueTitle = 'Inovasi Super Presisi Motor Listrik Musashi ' . uniqid();

        // 1. Post new news via Superadmin
        $response = $this->actingAs($admin)->post(route('superadmin.news.store'), [
            'title' => $uniqueTitle,
            'category' => 'Innovation',
            'excerpt' => 'Musashi Indonesia mengembangkan inovasi motor listrik teranyar.',
            'content' => 'Isi berita lengkap mengenai teknologi motor listrik sub-mikron presisi.',
            'is_published' => '1',
            'is_featured' => '1',
        ]);

        $response->assertRedirect('/SuperadminMusashi?tab=news&lang=id');

        $this->assertDatabaseHas('news', [
            'title' => $uniqueTitle,
            'category' => 'Innovation',
        ]);

        // 2. Check landing page reacts and displays the newly added news
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee($uniqueTitle);
    }

    public function test_superadmin_can_add_news_with_multiple_images(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $uniqueTitle = 'Ekspansi Pabrik Karawang dengan Multi-Foto ' . uniqid();
        $file1 = \Illuminate\Http\UploadedFile::fake()->image('foto1.jpg');
        $file2 = \Illuminate\Http\UploadedFile::fake()->image('foto2.jpg');
        $file3 = \Illuminate\Http\UploadedFile::fake()->image('foto3.jpg');

        $response = $this->actingAs($admin)->post(route('superadmin.news.store'), [
            'title' => $uniqueTitle,
            'category' => 'Corporate',
            'excerpt' => 'Liputan multi-foto peresmian lini produksi baru.',
            'content' => 'Fasilitas baru diresmikan dengan standar Monozukuri terdepan.',
            'images' => [$file1, $file2, $file3],
            'is_published' => '1',
            'is_featured' => '1',
        ]);

        $response->assertRedirect('/SuperadminMusashi?tab=news&lang=id');

        $news = News::where('title', $uniqueTitle)->first();
        $this->assertNotNull($news);
        $this->assertCount(3, $news->all_images);

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee($uniqueTitle);
    }

    public function test_superadmin_can_edit_profile_and_it_appears_on_about_page(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $customHeadline = 'Musashi Masa Depan: Presisi Tanpa Batas ' . uniqid();
        $customHeritage = 'Musashi Global 80% & Astra Honda Motor 20% Partnership Certified';

        // 1. Update Profile in Superadmin
        $response = $this->actingAs($admin)->post(route('superadmin.update'), [
            'about_headline_id' => $customHeadline,
            'about_heritage_id' => $customHeritage,
            'redirect_tab' => 'profile',
            'redirect_lang' => 'id',
        ]);

        $response->assertRedirect('/SuperadminMusashi?tab=profile&lang=id');

        // 2. Check About Us page renders the updated content
        $aboutResponse = $this->withSession(['locale' => 'id'])->get(route('company.about'));
        $aboutResponse->assertStatus(200);
        $aboutResponse->assertSee($customHeadline);
        $aboutResponse->assertSee($customHeritage);
    }

    public function test_superadmin_can_update_hero_video_and_slides_and_it_appears_on_home(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $uniqueHeadline = 'Revolusi Kendaraan Elektrik Musashi ' . uniqid();
        $videoFile = \Illuminate\Http\UploadedFile::fake()->create('musashi-brand-video.mp4', 1024, 'video/mp4');

        $response = $this->actingAs($admin)->post(route('superadmin.hero.update'), [
            'redirect_lang' => 'id',
            'slides' => [
                [
                    'id' => 1,
                    'badge' => 'Video Mobility',
                    'headline_id' => $uniqueHeadline,
                    'headline_en' => 'English Headline',
                    'headline_ja' => 'Japanese Headline',
                    'subtitle_id' => 'Sub-headline Indonesia EV',
                    'media_type' => 'video',
                    'media_url' => '',
                    'cta_text_id' => 'Tonton Video',
                    'cta_link' => '/product',
                    'show_gofarbeyond' => false,
                    'is_active' => '1',
                ]
            ],
            'slide_media_0' => $videoFile,
        ]);

        $response->assertRedirect('/SuperadminMusashi?tab=hero&lang=id');
        $response->assertSessionHas('success');

        // Verify Home page renders the video and custom headline
        $homeResponse = $this->withSession(['locale' => 'id'])->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee($uniqueHeadline);
        $homeResponse->assertSee('<video', false);
        $homeResponse->assertSee('musashi-brand-video.mp4');
    }

    public function test_superadmin_sidebar_matches_landing_page_and_excludes_messages(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $response = $this->actingAs($admin)->get(route('superadmin.index'));
        $response->assertStatus(200);

        // Verify Landing Page aligned sidebar menus
        $response->assertSee('Ringkasan Dashboard');
        $response->assertSee('Hero Visual & Video Slider', false);
        $response->assertSee('Kelola Berita (News)');
        $response->assertSee('Bisnis & 4 Pilar Global', false);
        $response->assertSee('Katalog Produk & EV', false);
        $response->assertSee('Teknologi & Monozukuri', false);
        $response->assertSee('Profil & Tentang Kami', false);
        $response->assertSee('Dewan Direksi (BOD)');
        $response->assertSee('Keberlanjutan & ESG', false);
        $response->assertSee('Footer & Kontak Pabrik', false);

        // Verify obsolete Contact messages is removed
        $response->assertDontSee('Pesan Masuk dari Formulir Kontak');
    }

    public function test_superadmin_can_update_technology_sustainability_and_footer_and_reflects_on_landing_page(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        // 1. Update Technology
        $uniqueTechTitle = 'Inovasi Presisi Robotik Musashi ' . uniqid();
        $resTech = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'technology',
            'redirect_lang' => 'id',
            'tech_title_id' => $uniqueTechTitle,
            'tech_plants_headline_id' => 'Pusat Keunggulan Otomotif Masa Depan',
        ]);
        $resTech->assertRedirect('/SuperadminMusashi?tab=technology&lang=id');

        // 2. Update Sustainability
        $uniqueEsgTitle = 'Komitmen Net-Zero Hijau Musashi ' . uniqid();
        $resEsg = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'sustainability',
            'redirect_lang' => 'id',
            'sustainability_title_id' => $uniqueEsgTitle,
            'sustainability_carbon_title_id' => 'Target Dekarbonisasi 2038',
        ]);
        $resEsg->assertRedirect('/SuperadminMusashi?tab=sustainability&lang=id');

        // 3. Update Footer
        $uniquePhone = '+62-21-' . rand(1000000, 9999999);
        $resFooter = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'footer',
            'redirect_lang' => 'id',
            'footer_cikarang_phone' => $uniquePhone,
            'footer_copyright' => '©2026 PT. Musashi Auto Parts Indonesia All rights reserved',
        ]);
        $resFooter->assertRedirect('/SuperadminMusashi?tab=footer&lang=id');

        // 4. Verify landing page renders all updated content
        $homeResponse = $this->withSession(['locale' => 'id'])->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee($uniqueTechTitle);
        $homeResponse->assertSee('Pusat Keunggulan Otomotif Masa Depan');
        $homeResponse->assertSee($uniqueEsgTitle);
        $homeResponse->assertSee('Target Dekarbonisasi 2038');
        $homeResponse->assertSee($uniquePhone);
        $homeResponse->assertSee('©2026 PT. Musashi Auto Parts Indonesia All rights reserved');
    }

    public function test_superadmin_can_manage_stats_and_company_outline_and_reflects_on_pages(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $uniqueEmployees = '1,' . rand(700, 999) . '+ Specialists';
        $uniqueArea = '1' . rand(20, 50) . ',000 m²';
        $uniqueEstablished = '199' . rand(6, 9);
        $uniqueSales = 'IDR 3.' . rand(1, 9) . 'T+';

        // Update via Superadmin
        $response = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'profile',
            'redirect_lang' => 'id',
            'outline_employees_stat' => $uniqueEmployees,
            'outline_plant_area_stat' => $uniqueArea,
            'outline_established_stat' => $uniqueEstablished,
            'outline_sales_stat' => $uniqueSales,
            'outline_plant1_info_id' => 'EJIP Industrial Park Plot 3J-2 Cikarang Pusat Produksi ' . $uniqueArea,
            'outline_plant2_info_id' => 'Suryacipta City of Industry Karawang Plant ' . $uniqueArea,
        ]);
        $response->assertRedirect('/SuperadminMusashi?tab=profile&lang=id');

        // Check Landing Page #company
        $home = $this->withSession(['locale' => 'id'])->get(route('home'));
        $home->assertStatus(200);
        $home->assertSee($uniqueEmployees);
        $home->assertSee($uniqueArea);
        $home->assertSee($uniqueEstablished);
        $home->assertSee($uniqueSales);

        // Check Company Outline Page
        $outline = $this->withSession(['locale' => 'id'])->get(route('company.outline'));
        $outline->assertStatus(200);
        $outline->assertSee('EJIP Industrial Park Plot 3J-2 Cikarang Pusat Produksi ' . $uniqueArea);
        $outline->assertSee('Suryacipta City of Industry Karawang Plant ' . $uniqueArea);

        // Check Company About Page
        $about = $this->withSession(['locale' => 'id'])->get(route('company.about'));
        $about->assertStatus(200);
        $about->assertSee($uniqueEmployees);
        $about->assertSee($uniqueArea);
    }

    public function test_superadmin_can_crud_directors_and_reflects_on_landing_page_and_bod_page(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $uniqueDirectorName = 'Ir. Budi Santoso ' . uniqid();
        $uniqueTitle = 'Executive Vice President of Operations';
        $uniqueBio = 'Memimpin inovasi manufaktur cerdas dan transformasi rantai pasok otomotif MAP-IN.';

        // 1. TAMBAH DIREKTUR (CREATE)
        $resStore = $this->actingAs($admin)->post(route('superadmin.directors.store'), [
            'name' => $uniqueDirectorName,
            'title' => $uniqueTitle,
            'bio' => $uniqueBio,
            'order' => 99,
        ]);
        $resStore->assertRedirect('/SuperadminMusashi?tab=directors&lang=id');

        $director = \App\Models\Director::where('name', $uniqueDirectorName)->first();
        $this->assertNotNull($director);

        // Verify director appears on Landing Page #directors
        $home = $this->get(route('home'));
        $home->assertStatus(200);
        $home->assertSee($uniqueDirectorName);
        $home->assertSee($uniqueTitle);

        // Verify director appears on Company BOD Page
        $bodPage = $this->get(route('company.bod'));
        $bodPage->assertStatus(200);
        $bodPage->assertSee($uniqueDirectorName);
        $bodPage->assertSee($uniqueTitle);

        // 2. EDIT DIREKTUR (UPDATE)
        $updatedTitle = 'Senior Executive Vice President & COO';
        $resUpdate = $this->actingAs($admin)->post('/SuperadminMusashi/directors/' . $director->id . '/update', [
            'name' => $uniqueDirectorName,
            'title' => $updatedTitle,
            'bio' => $uniqueBio . ' Diperbarui.',
            'order' => 10,
        ]);
        $resUpdate->assertRedirect('/SuperadminMusashi?tab=directors&lang=id');

        $director->refresh();
        $this->assertEquals($updatedTitle, $director->title);

        $homeUpdated = $this->get(route('home'));
        $homeUpdated->assertSee($updatedTitle);

        // 3. HAPUS DIREKTUR (DELETE)
        $resDelete = $this->actingAs($admin)->delete(route('superadmin.directors.destroy', $director));
        $resDelete->assertRedirect('/SuperadminMusashi?tab=directors&lang=id');

        $this->assertNull(\App\Models\Director::find($director->id));

        $this->flushSession();
        $homeDeleted = $this->get(route('home'));
        $homeDeleted->assertDontSee($uniqueDirectorName);
    }

    public function test_superadmin_can_manage_global_vision_and_reflects_on_vision_page_and_landing_page(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $uniqueVisionHeadline = 'Menembus Batas Baru Visi 2038 Musashi ' . uniqid();
        $uniquePillar1 = 'Transmisi e-Axle Masa Depan ' . uniqid();
        $uniqueCallout = 'Komitmen 100 Tahun Kepercayaan Pelanggan ' . uniqid();

        // 1. Update Global Vision via Superadmin Tab Profile
        $response = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'profile',
            'redirect_lang' => 'id',
            'vision_headline_id' => $uniqueVisionHeadline,
            'vision_pillar1_title_id' => $uniquePillar1,
            'vision_callout_title_id' => $uniqueCallout,
            'company_card4_desc_id' => 'Deskripsi Visi 100 Tahun Kartu Landing Page ' . $uniqueVisionHeadline,
        ]);
        $response->assertRedirect('/SuperadminMusashi?tab=profile&lang=id');

        // 2. Check Global Vision page (/company/global-vision)
        $visionPage = $this->withSession(['locale' => 'id'])->get(route('company.vision'));
        $visionPage->assertStatus(200);
        $visionPage->assertSee($uniqueVisionHeadline);
        $visionPage->assertSee($uniquePillar1);
        $visionPage->assertSee($uniqueCallout);

        // 3. Check Landing page Card 4 (#company-vision)
        $homePage = $this->withSession(['locale' => 'id'])->get(route('home'));
        $homePage->assertStatus(200);
        $homePage->assertSee('Deskripsi Visi 100 Tahun Kartu Landing Page ' . $uniqueVisionHeadline);

        // 4. Check Superadmin Profile Tab shows the updated content
        $superadmin = $this->actingAs($admin)->get('/SuperadminMusashi?tab=profile&lang=id');
        $superadmin->assertStatus(200);
        $superadmin->assertSee($uniqueVisionHeadline);
        $superadmin->assertSee($uniquePillar1);
        $superadmin->assertSee($uniqueCallout);
    }

    public function test_superadmin_can_manage_corporate_message_and_reflects_on_message_page(): void
    {
        $admin = User::first();
        $uniqueMsgBadge = 'Top Message Musashi 2026';
        $uniqueMsgTitle = 'Pesan Transformasi Eksekutif Musashi Global';
        $uniqueMsgSub = 'Pernyataan Resmi Dewan Direksi Terkait Elektrifikasi Powertrain';
        $uniqueCeoName = 'Takeshi Musashi';
        $uniqueCeoTitle = 'Executive Chairman & CEO Musashi Global Group';
        $uniqueIndoName = 'Bambang Soediro';
        $uniqueIndoTitle = 'Presiden Direktur PT Musashi Auto Parts Indonesia';

        // 1. Update Corporate Message via Superadmin Profile Tab
        $response = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'profile',
            'redirect_lang' => 'id',
            'message_page_badge_id' => $uniqueMsgBadge,
            'message_page_title_id' => $uniqueMsgTitle,
            'message_page_sub_id' => $uniqueMsgSub,
            'message_ceo_badge_id' => 'Pesan Khusus CEO',
            'message_president_title_id' => 'Tantangan Baru di Era 100 Tahun Musashi',
            'message_president_body_id' => 'Musashi berkomitmen penuh memimpin inovasi e-Axle global dengan kejujuran Monozukuri.',
            'message_global_ceo_name' => $uniqueCeoName,
            'message_global_ceo_title_id' => $uniqueCeoTitle,
            'message_indo_ceo_name' => $uniqueIndoName,
            'message_indo_ceo_title_id' => $uniqueIndoTitle,
        ]);
        $response->assertRedirect('/SuperadminMusashi?tab=profile&lang=id');

        // 2. Check Corporate Message Page (/company/corporate-message)
        $msgPage = $this->withSession(['locale' => 'id'])->get(route('company.message'));
        $msgPage->assertStatus(200);
        $msgPage->assertSee($uniqueMsgBadge);
        $msgPage->assertSee($uniqueMsgTitle);
        $msgPage->assertSee($uniqueMsgSub);
        $msgPage->assertSee('Pesan Khusus CEO');
        $msgPage->assertSee('Tantangan Baru di Era 100 Tahun Musashi');
        $msgPage->assertSee('Musashi berkomitmen penuh memimpin inovasi e-Axle global');
        $msgPage->assertSee($uniqueCeoName);
        $msgPage->assertSee($uniqueCeoTitle);
        $msgPage->assertSee($uniqueIndoName);
        $msgPage->assertSee($uniqueIndoTitle);

        // 3. Check Superadmin Profile Tab displays the values
        $superadmin = $this->actingAs($admin)->get('/SuperadminMusashi?tab=profile&lang=id');
        $superadmin->assertStatus(200);
        $superadmin->assertSee($uniqueMsgTitle);
        $superadmin->assertSee($uniqueCeoName);
        $superadmin->assertSee($uniqueIndoName);
    }

    public function test_superadmin_can_manage_philosophy_and_reflects_on_philosophy_page(): void
    {
        $admin = User::first();
        $uniquePhiloTitle = 'Filosofi Luhur Musashi Auto Parts 2026';
        $uniqueOriginTitle = 'Akar Semangat Monozukuri Generasi ke Generasi';
        $uniqueTenet1 = 'Ketulusan Sejati Tanpa Kompromi';
        $uniquePurposeQuote = 'Menghadirkan Harmoni Berkelanjutan antara Mobilitas Manusia dan Bumi';
        $uniqueWayTitle = 'Terus Menantang Batas Teknologi Baru dengan Eksplorasi';
        $uniqueColorDesc = 'Merah Musashi melambangkan api gairah rekayasa teknologi dan keberanian tanpa henti.';

        // 1. Update Musashi Philosophy via Superadmin Profile Tab
        $response = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'profile',
            'redirect_lang' => 'id',
            'philosophy_badge_id' => 'Filosofi Korporat',
            'philosophy_title_id' => $uniquePhiloTitle,
            'philosophy_sub_id' => 'Semangat abadi seluruh insan Musashi di seluruh penjuru dunia.',
            'philosophy_intro_badge_id' => 'Pilar Utama Nilai Musashi',
            'philosophy_intro_title_id' => 'Komposisi Struktur Filosofi Musashi',
            'philosophy_origin_badge_id' => '01. Asal Usul Kami',
            'philosophy_origin_title_id' => $uniqueOriginTitle,
            'philosophy_origin_lead_id' => 'Sejak awal berdiri, semangat kami berakar pada dua ajaran sakral Jepang:',
            'philosophy_origin_kanji' => '至誠',
            'philosophy_origin_kanji_label_id' => 'Semangat Pendirian',
            'philosophy_tenet1_kanji_id' => '至誠一貫 (Shisei-Ikkan)',
            'philosophy_tenet1_title_id' => $uniqueTenet1,
            'philosophy_tenet1_desc_id' => 'Ketulusan dalam manufaktur dan integritas penuh.',
            'philosophy_tenet2_kanji_id' => '質実剛健 (Shitsujitsu-Goken)',
            'philosophy_tenet2_title_id' => 'Kukuh dan Bersahaja',
            'philosophy_tenet2_desc_id' => 'Karakter rekayasa tangguh berfokus pada kualitas substansial.',
            'philosophy_purpose_badge_id' => '02. Tujuan Kami',
            'philosophy_purpose_quote_id' => $uniquePurposeQuote,
            'philosophy_purpose_desc_id' => 'Alasan keberadaan kami adalah memecahkan tantangan sosial mendesak.',
            'philosophy_purpose_kanji' => '調和',
            'philosophy_purpose_kanji_label_id' => 'Harmoni & Bumi',
            'philosophy_way_badge_id' => '03. Cara Kami',
            'philosophy_way_title_id' => $uniqueWayTitle,
            'philosophy_way_desc_id' => 'Keseimbangan antara eksploitasi kapabilitas Monozukuri dan eksplorasi elektrifikasi.',
            'philosophy_way_kanji' => '挑戦',
            'philosophy_way_kanji_label_id' => 'Tantangan Berkelanjutan',
            'philosophy_mark_title_id' => 'Lambang Korporat Musashi',
            'philosophy_mark_desc_id' => 'Sistem produksi terintegrasi berbasis tempa presisi tinggi.',
            'philosophy_colors_title_id' => 'Warna Korporat: Musashi Red & Musashi Black',
            'philosophy_color1_name' => 'Musashi Red (#E60012)',
            'philosophy_color1_desc_id' => $uniqueColorDesc,
            'philosophy_color2_name' => 'Musashi Black (#111111)',
            'philosophy_color2_desc_id' => 'Baja hitam integritas tanpa kompromi.',
        ]);
        $response->assertRedirect('/SuperadminMusashi?tab=profile&lang=id');

        // 2. Check Philosophy Page (/company/philosophy)
        $philoPage = $this->withSession(['locale' => 'id'])->get(route('company.philosophy'));
        $philoPage->assertStatus(200);
        $philoPage->assertSee($uniquePhiloTitle);
        $philoPage->assertSee($uniqueOriginTitle);
        $philoPage->assertSee($uniqueTenet1);
        $philoPage->assertSee($uniquePurposeQuote);
        $philoPage->assertSee($uniqueWayTitle);
        $philoPage->assertSee($uniqueColorDesc);
        $philoPage->assertSee('至誠');
        $philoPage->assertSee('調和');
        $philoPage->assertSee('挑戦');

        // 3. Check Superadmin Profile Tab shows the values
        $superadmin = $this->actingAs($admin)->get('/SuperadminMusashi?tab=profile&lang=id');
        $superadmin->assertStatus(200);
        $superadmin->assertSee($uniquePhiloTitle);
        $superadmin->assertSee($uniqueTenet1);
        $superadmin->assertSee($uniquePurposeQuote);
    }

    public function test_superadmin_can_manage_about_us_and_reflects_on_about_page(): void
    {
        $admin = User::first();
        $uniqueAboutBadge = 'Profil Resmi Musashi 2026';
        $uniqueIdentityBadge = 'Identitas Monozukuri MAP-IN';
        $uniquePlantsBadge = 'Jaringan Manufaktur Kelas Dunia';
        $uniquePlantsHeadline = 'Pusat Keunggulan Dua Pabrik Cikarang & Karawang';
        $uniquePlant1Tag = 'Pusat Kantor Pusat & Presisi';
        $uniquePlant2Tag = 'Fasilitas Tempa Panas Terbesar';

        // 1. Update About Us via Superadmin Profile Tab
        $response = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'profile',
            'redirect_lang' => 'id',
            'about_badge_id' => $uniqueAboutBadge,
            'about_identity_badge_id' => $uniqueIdentityBadge,
            'about_plants_badge_id' => $uniquePlantsBadge,
            'about_plants_headline_id' => $uniquePlantsHeadline,
            'outline_plant1_tag_id' => $uniquePlant1Tag,
            'outline_plant2_tag_id' => $uniquePlant2Tag,
        ]);
        $response->assertRedirect('/SuperadminMusashi?tab=profile&lang=id');

        // 2. Check About Us Page (/company/about-us)
        $aboutPage = $this->withSession(['locale' => 'id'])->get(route('company.about'));
        $aboutPage->assertStatus(200);
        $aboutPage->assertSee($uniqueAboutBadge);
        $aboutPage->assertSee($uniqueIdentityBadge);
        $aboutPage->assertSee($uniquePlantsBadge);
        $aboutPage->assertSee($uniquePlantsHeadline);
        $aboutPage->assertSee($uniquePlant1Tag);
        $aboutPage->assertSee($uniquePlant2Tag);

        // 3. Check Superadmin Profile Tab shows the values
        $superadmin = $this->actingAs($admin)->get('/SuperadminMusashi?tab=profile&lang=id');
        $superadmin->assertStatus(200);
        $superadmin->assertSee($uniqueAboutBadge);
        $superadmin->assertSee($uniquePlantsHeadline);
    }

    public function test_superadmin_profile_hub_subtabs_navigation_and_redirects(): void
    {
        $admin = User::first();

        // 1. Visit Superadmin Profile Tab and ensure all 6 subtabs exist
        $response = $this->actingAs($admin)->get('/SuperadminMusashi?tab=profile&lang=id');
        $response->assertStatus(200);
        $response->assertSee('1. About Us');
        $response->assertSee('2. Corporate Message');
        $response->assertSee('3. Philosophy');
        $response->assertSee('4. Global Vision');
        $response->assertSee('5. Company Outline');
        $response->assertSee('6. Board of Directors');
        $response->assertSee('Tampilkan Semua');

        // 2. Test saving with subtab retains redirect to that specific subtab
        $saveResponse = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'profile',
            'redirect_subtab' => 'philosophy',
            'redirect_lang' => 'id',
            'philosophy_badge_id' => 'Filosofi Resmi 2026',
        ]);
        $saveResponse->assertRedirect('/SuperadminMusashi?tab=profile&lang=id&subtab=philosophy');

        // 3. Visit with specific subtab parameter
        $subtabResponse = $this->actingAs($admin)->get('/SuperadminMusashi?tab=profile&lang=id&subtab=philosophy');
        $subtabResponse->assertStatus(200);
        $subtabResponse->assertSee('Filosofi Resmi 2026');
    }

    public function test_superadmin_multi_image_gallery_management_and_frontend_sliders(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        // 1. Public Technology Page renders multi-image slider and lightbox
        $techRes = $this->get(route('business.technology'));
        $techRes->assertStatus(200);
        $techRes->assertSee('techSlider');
        $techRes->assertSee('Geser / Scroll ➔');
        $techRes->assertSee('fullscreenImg');

        // 2. Public Innovation Page renders multi-image slider and lightbox
        $innovRes = $this->get(route('business.innovation'));
        $innovRes->assertStatus(200);
        $innovRes->assertSee('innovSlider');
        $innovRes->assertSee('Geser / Scroll ➔');
        $innovRes->assertSee('fullscreenImg');

        // 3. Landing Page renders both sliders
        $homeRes = $this->get(route('home'));
        $homeRes->assertStatus(200);
        $homeRes->assertSee('homeTechSlider');
        $homeRes->assertSee('homeInnovSlider');

        // 4. Superadmin Technology Tab renders multi-image manager cards
        $superRes = $this->actingAs($admin)->get('/SuperadminMusashi?tab=technology&lang=id');
        $superRes->assertStatus(200);
        $superRes->assertSee('tech_gallery_new_files[]');
        $superRes->assertSee('innov_gallery_new_files[]');
        $superRes->assertSee('Galeri Foto Fasilitas');
        $superRes->assertSee('Galeri Foto Inovasi');

        // 5. Test multi-image upload in Superadmin update
        $fakeImg1 = \Illuminate\Http\UploadedFile::fake()->image('custom_tech1.jpg');
        $fakeImg2 = \Illuminate\Http\UploadedFile::fake()->image('custom_tech2.jpg');
        $fakeInnov = \Illuminate\Http\UploadedFile::fake()->image('custom_innov1.jpg');

        $updateRes = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'technology',
            'redirect_lang' => 'id',
            'tech_gallery_submitted' => '1',
            'tech_gallery_existing' => ['images/hero/hero-plant.jpg'],
            'tech_gallery_new_files' => [$fakeImg1, $fakeImg2],
            'innov_gallery_submitted' => '1',
            'innov_gallery_existing' => ['images/business/green_smart_factory.jpg'],
            'innov_gallery_new_files' => [$fakeInnov],
        ]);
        $updateRes->assertRedirect('/SuperadminMusashi?tab=technology&lang=id');

        $techImgs = \App\Models\LandingPageSetting::getTechGalleryImages();
        $this->assertGreaterThanOrEqual(3, count($techImgs));
        $this->assertEquals('images/hero/hero-plant.jpg', $techImgs[0]);

        $innovImgs = \App\Models\LandingPageSetting::getInnovGalleryImages();
        $this->assertGreaterThanOrEqual(2, count($innovImgs));
        $this->assertEquals('images/business/green_smart_factory.jpg', $innovImgs[0]);
    }

    public function test_superadmin_sidebar_has_navbar_tab_and_can_update_navbar_settings(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        // 1. Check sidebar has navbar tab button
        $superadmin = $this->actingAs($admin)->get('/SuperadminMusashi?tab=navbar&lang=id');
        $superadmin->assertStatus(200);
        $superadmin->assertSee('Navbar &amp; Menu Navigasi', false);
        $superadmin->assertSee('navbar_brand_title_id');
        $superadmin->assertSee('announcement_bar_text_id');
        $superadmin->assertSee('nav_company_id');
        $superadmin->assertSee('nav_careers_link');

        // 2. Update Navbar Brand, Navigation Menu, and Top Announcement Bar
        $customBrand = 'PT Musashi Indonesia Mega Portal ' . uniqid();
        $customNavCompany = 'Korporasi Musashi ' . uniqid();
        $customAnnounce = 'PENGUMUMAN PENTING: Lini Produksi Baru 2026 ' . uniqid();

        $updateRes = $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'navbar',
            'redirect_lang' => 'id',
            'navbar_brand_title_id' => $customBrand,
            'nav_company_id' => $customNavCompany,
            'announcement_bar_enabled' => '1',
            'announcement_bar_text_id' => $customAnnounce,
            'announcement_bar_link' => 'https://musashi.co.id/news',
            'nav_careers_link' => 'https://career.musashi.co.id/openings',
        ]);
        $updateRes->assertRedirect('/SuperadminMusashi?tab=navbar&lang=id');

        // 3. Verify Landing Page renders all updated navbar elements
        $homePage = $this->withSession(['locale' => 'id'])->get(route('home'));
        $homePage->assertStatus(200);
        $homePage->assertSee($customBrand);
        $homePage->assertSee($customNavCompany);
        $homePage->assertSee($customAnnounce);
        $homePage->assertSee('https://musashi.co.id/news');
        $homePage->assertSee('https://career.musashi.co.id/openings');
    }

    public function test_superadmin_can_update_section_headers_for_news_products_and_pillars(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        $customNewsTitle = 'Warta Resmi & Perkembangan Bisnis Musashi ' . uniqid();
        $customNewsBadge = 'KABAR TERKINI ' . uniqid();
        $customNewsViewAll = 'Jelajahi Semua Arsip Warta ' . uniqid();

        $customProdTitle = 'Etalase Komponen Powertrain Presisi ' . uniqid();
        $customProdBadge = 'KATALOG UNGGULAN ' . uniqid();
        $customProdDesc = 'Koleksi produk gear dan e-Axle tercanggih ' . uniqid();
        $customProdViewAll = 'Akses Katalog Utuh ' . uniqid();

        $customPillarBadge = '01. MOBILITAS GENERASI MASA DEPAN ' . uniqid();
        $customPillarPill = 'INISIATIF MOBILITAS LISTRIK ' . uniqid();
        $customPillarsViewAll = 'Telusuri Keempat Pilar ' . uniqid();

        // 1. Update News and Products and Pillars Section Headers
        $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'news',
            'redirect_lang' => 'id',
            'news_title_id' => $customNewsTitle,
            'news_badge_id' => $customNewsBadge,
            'news_view_all_text_id' => $customNewsViewAll,
        ])->assertRedirect('/SuperadminMusashi?tab=news&lang=id');

        $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'products',
            'redirect_lang' => 'id',
            'products_title_id' => $customProdTitle,
            'products_badge_id' => $customProdBadge,
            'products_desc_id' => $customProdDesc,
            'products_view_all_text_id' => $customProdViewAll,
        ])->assertRedirect('/SuperadminMusashi?tab=products&lang=id');

        $this->actingAs($admin)->post(route('superadmin.update'), [
            'redirect_tab' => 'pillars',
            'redirect_lang' => 'id',
            'pillars_view_all_text_id' => $customPillarsViewAll,
            'pillar1_badge_id' => $customPillarBadge,
            'pillar1_pill_id' => $customPillarPill,
        ])->assertRedirect('/SuperadminMusashi?tab=pillars&lang=id');

        // 2. Verify Landing Page displays all updated headers
        $homePage = $this->withSession(['locale' => 'id'])->get(route('home'));
        $homePage->assertStatus(200);
        $homePage->assertSee($customNewsTitle);
        $homePage->assertSee($customNewsBadge);
        $homePage->assertSee($customNewsViewAll);
        $homePage->assertSee($customProdTitle);
        $homePage->assertSee($customProdBadge);
        $homePage->assertSee($customProdDesc);
        $homePage->assertSee($customProdViewAll);
        $homePage->assertSee($customPillarBadge);
        $homePage->assertSee($customPillarPill);
        $homePage->assertSee($customPillarsViewAll);
    }
}

