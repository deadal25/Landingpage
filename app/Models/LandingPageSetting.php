<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LandingPageSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    /**
     * Cache key for settings.
     */
    protected static string $cacheKey = 'musashi_landing_settings';

    /**
     * Get a setting by key, with optional locale awareness and fallback.
     */
    public static function get(string $key, mixed $default = null, bool $localeAware = true): mixed
    {
        $settings = static::allKeyed();
        $locale = app()->getLocale();

        // 1. If locale-aware, check for localized key (e.g. hero_headline_ja)
        if ($localeAware) {
            $localizedKey = "{$key}_{$locale}";
            if (isset($settings[$localizedKey]) && $settings[$localizedKey] !== '' && $settings[$localizedKey] !== null) {
                return $settings[$localizedKey];
            }
        }

        // 2. If locale is Indonesian (id), check base key or _id key
        if ($locale === 'id') {
            if ($localeAware && isset($settings["{$key}_id"]) && $settings["{$key}_id"] !== '' && $settings["{$key}_id"] !== null) {
                return $settings["{$key}_id"];
            }
            if (isset($settings[$key]) && $settings[$key] !== '' && $settings[$key] !== null) {
                return $settings[$key];
            }
        }

        // 3. For non-Indonesian locales (en, ja), if a translated $default was passed, prefer it!
        if ($default !== null) {
            return $default;
        }

        // 4. Fallback to general key or default
        if (isset($settings[$key]) && $settings[$key] !== '' && $settings[$key] !== null) {
            return $settings[$key];
        }

        if ($localeAware && isset($settings["{$key}_id"]) && $settings["{$key}_id"] !== '' && $settings["{$key}_id"] !== null) {
            return $settings["{$key}_id"];
        }

        return $default;
    }

    /**
     * Get a setting specifically for an editing locale in admin portal.
     */
    public static function getForLocale(string $key, string $locale, mixed $default = null): mixed
    {
        $settings = static::allKeyed();
        $localizedKey = "{$key}_{$locale}";

        if (isset($settings[$localizedKey]) && $settings[$localizedKey] !== '' && $settings[$localizedKey] !== null) {
            return $settings[$localizedKey];
        }

        if ($locale === 'id') {
            if (isset($settings["{$key}_id"]) && $settings["{$key}_id"] !== '' && $settings["{$key}_id"] !== null) {
                return $settings["{$key}_id"];
            }
            if (isset($settings[$key]) && $settings[$key] !== '' && $settings[$key] !== null) {
                return $settings[$key];
            }
        }

        if ($default !== null) {
            return $default;
        }

        if (isset($settings[$key]) && $settings[$key] !== '' && $settings[$key] !== null) {
            return $settings[$key];
        }

        return $default;
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, mixed $value, string $group = 'landing', string $type = 'text'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
            ]
        );

        Cache::forget(static::$cacheKey);

        return $setting;
    }

    /**
     * Retrieve all settings keyed by their key, cached.
     */
    public static function allKeyed(): array
    {
        return Cache::remember(static::$cacheKey, 60, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get default hero slides.
     */
    public static function defaultHeroSlides(): array
    {
        return [
            [
                'id' => 1,
                'badge' => 'Energy Solutions',
                'headline_id' => 'Hybrid Super Capacitor',
                'headline_en' => 'Hybrid Super Capacitor',
                'headline_ja' => 'Hybrid Super Capacitor',
                'subtitle_id' => 'Solusi Energi Mutakhir Menjawab Tantangan Transisi Hijau',
                'subtitle_en' => 'Next-Generation Energy Storage Devices Solving Global Challenges',
                'subtitle_ja' => 'エネルギー課題を解決する 次世代蓄電デバイス',
                'description_id' => 'Umur pakai siklus tinggi, pengisian daya sangat cepat, dan modul densitas daya tinggi untuk mobilitas hijau.',
                'description_en' => 'High-cycle longevity, ultrafast charging, and high-power density energy storage systems.',
                'description_ja' => '高サイクル寿命、超急速充電、高出力密度エネルギー貯蔵システム。',
                'media_type' => 'image',
                'media_url' => '/images/products/product-energy-storage.jpg',
                'cta_text_id' => 'Jelajahi Solusi Energi',
                'cta_text_en' => 'Explore Energy Solutions',
                'cta_text_ja' => 'エネルギーソリューションを見る',
                'cta_link' => '/business/innovation',
                'show_gofarbeyond' => false,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'badge' => 'Musashi Art & Innovation',
                'headline_id' => 'Menuju Dimensi Baru Musashi Monozukuri',
                'headline_en' => 'Toward Another Dimension of Monozukuri',
                'headline_ja' => 'もうひとつのムサシづくりへ',
                'subtitle_id' => 'Break Barriers and Go on Adventures! • Musashi 100th Year Vision',
                'subtitle_en' => 'Break Barriers and Go on Adventures! • Musashi 100th Year Vision',
                'subtitle_ja' => 'Break Barriers and Go on Adventures! • Musashi 100th Year Vision',
                'description_id' => '社内で生成AIアートコンクールを実施 弊社社員が作り出した作品です',
                'description_en' => '社内で生成AIアートコンクールを実施 弊社社員が作り出した作品です',
                'description_ja' => '社内で生成AIアートコンクールを実施 弊社社員が作り出した作品です',
                'media_type' => 'image',
                'media_url' => '/images/hero/hero-sunrise.jpg',
                'cta_text_id' => 'Filosofi Musashi',
                'cta_text_en' => 'Musashi Philosophy',
                'cta_text_ja' => 'ムサシ哲学',
                'cta_link' => '/company/philosophy',
                'show_gofarbeyond' => true,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'badge' => 'Precision Mobility',
                'headline_id' => 'Precision Powertrain & e-Axle',
                'headline_en' => 'Precision Powertrain & e-Axle',
                'headline_ja' => '世界を走る高精度ドライブトレイン',
                'subtitle_id' => 'Drivetrain Berpresisi Sub-Mikron untuk Kendaraan Global & Listrik',
                'subtitle_en' => 'Sub-Micron Precision Drivetrain for Global EV Mobility',
                'subtitle_ja' => '世界を走る高精度ドライブトレインと次世代e-Axle',
                'description_id' => 'Tempaan presisi tinggi, permesinan sub-mikron, dan unit transmisi listrik EV.',
                'description_en' => 'Integrated forging, precision machining, and electric drivetrain units.',
                'description_ja' => '四輪・二輪駆動系部品およびEV駆動ユニット。',
                'media_type' => 'image',
                'media_url' => '/images/hero/hero-automotive.jpg',
                'cta_text_id' => 'Lihat Katalog Produk',
                'cta_text_en' => 'View Products Catalog',
                'cta_text_ja' => '製品カタログを見る',
                'cta_link' => '/product',
                'show_gofarbeyond' => false,
                'is_active' => true,
            ],
        ];
    }

    /**
     * Get hero slides list from database or default.
     */
    public static function getHeroSlides(): array
    {
        $raw = static::get('hero_slides_data', null, false);
        $slides = [];
        if ($raw) {
            $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
            if (is_array($decoded) && !empty($decoded)) {
                $slides = $decoded;
            }
        }

        if (empty($slides)) {
            $slides = static::defaultHeroSlides();
        }

        // Backward compatibility: sync individual hero_scene1_headline if explicitly set
        $legacyH1Id = static::get('hero_scene1_headline_id', null, false);
        if ($legacyH1Id && isset($slides[0])) {
            $slides[0]['headline_id'] = $legacyH1Id;
        }

        return $slides;
    }

    /**
     * Save hero slides list into database.
     */
    public static function saveHeroSlides(array $slides): void
    {
        static::set('hero_slides_data', json_encode(array_values($slides)), 'hero', 'json');
    }

    /**
     * Get list of Technology gallery images.
     */
    public static function getTechGalleryImages(): array
    {
        $raw = static::get('tech_gallery_images', null, false);
        $images = [];
        if ($raw) {
            $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
            if (is_array($decoded) && !empty($decoded)) {
                $images = array_values(array_filter($decoded));
            }
        }

        if (empty($images)) {
            $primary = static::get('tech_image', 'images/hero/hero-plant.jpg', false);
            $images = [
                $primary,
                'images/business/support-tech-1-1585x695.jpg',
                'images/business/rd-1447x674.jpg',
                'images/business/p-system01-pc-en-775x232.png',
            ];
        }

        return array_values(array_unique($images));
    }

    /**
     * Save Technology gallery images.
     */
    public static function saveTechGalleryImages(array $images): void
    {
        static::set('tech_gallery_images', json_encode(array_values(array_unique(array_filter($images)))), 'tech', 'json');
    }

    /**
     * Get list of Innovation gallery images.
     */
    public static function getInnovGalleryImages(): array
    {
        $raw = static::get('innov_gallery_images', null, false);
        $images = [];
        if ($raw) {
            $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
            if (is_array($decoded) && !empty($decoded)) {
                $images = array_values(array_filter($decoded));
            }
        }

        if (empty($images)) {
            $primary = static::get('innov_image', 'images/business/green_smart_factory.jpg', false);
            $images = [
                $primary,
                'images/business/mapin-ai-1076x668.png',
                'images/business/energi-1117x560.jpg',
                'images/business/solar-1236x640.jpg',
            ];
        }

        return array_values(array_unique($images));
    }

    /**
     * Save Innovation gallery images.
     */
    public static function saveInnovGalleryImages(array $images): void
    {
        static::set('innov_gallery_images', json_encode(array_values(array_unique(array_filter($images)))), 'tech', 'json');
    }

    /**
     * Clear settings cache.
     */
    public static function clearCache(): void
    {
        Cache::forget(static::$cacheKey);
    }
}
