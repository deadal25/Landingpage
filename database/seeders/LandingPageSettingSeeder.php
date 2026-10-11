<?php

namespace Database\Seeders;

use App\Models\LandingPageSetting;
use Illuminate\Database\Seeder;

class LandingPageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $en = require base_path('lang/en/messages.php');
        $id = require base_path('lang/id/messages.php');
        $ja = require base_path('lang/ja/messages.php');

        $settings = [
            // Hero General
            ['key' => 'hero_scene1_video', 'value' => 'videos/hero-sunrise.mp4', 'group' => 'hero', 'type' => 'text'],
            ['key' => 'hero_scene1_poster', 'value' => 'images/hero/hero-sunrise.jpg', 'group' => 'hero', 'type' => 'text'],
            ['key' => 'hero_scene1_accent', 'value' => '#FF6F00', 'group' => 'hero', 'type' => 'text'],

            ['key' => 'hero_scene2_video', 'value' => 'videos/hero-automotive.mp4', 'group' => 'hero', 'type' => 'text'],
            ['key' => 'hero_scene2_poster', 'value' => 'images/hero/hero-automotive.jpg', 'group' => 'hero', 'type' => 'text'],
            ['key' => 'hero_scene2_accent', 'value' => '#E60012', 'group' => 'hero', 'type' => 'text'],

            ['key' => 'hero_scene3_video', 'value' => 'videos/hero-plant.mp4', 'group' => 'hero', 'type' => 'text'],
            ['key' => 'hero_scene3_poster', 'value' => 'images/hero/hero-plant.jpg', 'group' => 'hero', 'type' => 'text'],
            ['key' => 'hero_scene3_accent', 'value' => '#F59E0B', 'group' => 'hero', 'type' => 'text'],

            // Announcement Banner
            ['key' => 'announcement_bar_enabled', 'value' => '0', 'group' => 'general', 'type' => 'boolean'],
            ['key' => 'announcement_bar_text_en', 'value' => 'Welcome to PT. Musashi Auto Parts Indonesia Official Portal.', 'group' => 'general', 'type' => 'text'],
            ['key' => 'announcement_bar_text_id', 'value' => 'Selamat datang di Portal Resmi PT. Musashi Auto Parts Indonesia.', 'group' => 'general', 'type' => 'text'],
            ['key' => 'announcement_bar_text_ja', 'value' => 'PT. Musashi Auto Parts Indonesia 公式ポータルへようこそ。', 'group' => 'general', 'type' => 'text'],
        ];

        // Seed localized keys from existing dictionaries
        $locales = ['en' => $en, 'id' => $id, 'ja' => $ja];

        foreach ($locales as $loc => $dict) {
            // Hero
            $settings[] = ['key' => "hero_scene1_badge_{$loc}", 'value' => $dict['hero']['badge'] ?? 'Musashi 100th Year Vision', 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene1_theme_{$loc}", 'value' => $dict['hero']['scene1_theme'], 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene1_headline_{$loc}", 'value' => $dict['hero']['scene1_headline'], 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene1_sub_{$loc}", 'value' => $dict['hero']['scene1_sub'], 'group' => 'hero', 'type' => 'textarea'];

            $settings[] = ['key' => "hero_scene2_badge_{$loc}", 'value' => 'Monozukuri Innovation', 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene2_theme_{$loc}", 'value' => $dict['hero']['scene2_theme'], 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene2_headline_{$loc}", 'value' => $dict['hero']['scene2_headline'], 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene2_sub_{$loc}", 'value' => $dict['hero']['scene2_sub'], 'group' => 'hero', 'type' => 'textarea'];

            $settings[] = ['key' => "hero_scene3_badge_{$loc}", 'value' => 'Zero Defect Quality System', 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene3_theme_{$loc}", 'value' => $dict['hero']['scene3_theme'], 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene3_headline_{$loc}", 'value' => $dict['hero']['scene3_headline'], 'group' => 'hero', 'type' => 'text'];
            $settings[] = ['key' => "hero_scene3_sub_{$loc}", 'value' => $dict['hero']['scene3_sub'], 'group' => 'hero', 'type' => 'textarea'];

            // Pillars
            $settings[] = ['key' => "pillars_title_{$loc}", 'value' => $dict['pillars']['title'], 'group' => 'pillars', 'type' => 'text'];
            $settings[] = ['key' => "pillars_subtitle_{$loc}", 'value' => $dict['pillars']['subtitle'], 'group' => 'pillars', 'type' => 'textarea'];
            $settings[] = ['key' => "pillar1_title_{$loc}", 'value' => $dict['pillars']['mobility_title'], 'group' => 'pillars', 'type' => 'text'];
            $settings[] = ['key' => "pillar1_desc_{$loc}", 'value' => $dict['pillars']['mobility_desc'], 'group' => 'pillars', 'type' => 'textarea'];
            $settings[] = ['key' => "pillar2_title_{$loc}", 'value' => $dict['pillars']['industry_title'], 'group' => 'pillars', 'type' => 'text'];
            $settings[] = ['key' => "pillar2_desc_{$loc}", 'value' => $dict['pillars']['industry_desc'], 'group' => 'pillars', 'type' => 'textarea'];
            $settings[] = ['key' => "pillar3_title_{$loc}", 'value' => $dict['pillars']['energy_title'], 'group' => 'pillars', 'type' => 'text'];
            $settings[] = ['key' => "pillar3_desc_{$loc}", 'value' => $dict['pillars']['energy_desc'], 'group' => 'pillars', 'type' => 'textarea'];
            $settings[] = ['key' => "pillar4_title_{$loc}", 'value' => $dict['pillars']['wellbeing_title'], 'group' => 'pillars', 'type' => 'text'];
            $settings[] = ['key' => "pillar4_desc_{$loc}", 'value' => $dict['pillars']['wellbeing_desc'], 'group' => 'pillars', 'type' => 'textarea'];

            // Tech & Plants
            $settings[] = ['key' => "tech_title_{$loc}", 'value' => $dict['tech_section']['title'], 'group' => 'tech', 'type' => 'text'];
            $settings[] = ['key' => "tech_desc_{$loc}", 'value' => $dict['tech_section']['desc'], 'group' => 'tech', 'type' => 'textarea'];
            $settings[] = ['key' => "tech_plants_badge_{$loc}", 'value' => $dict['tech_section']['plants_badge'], 'group' => 'tech', 'type' => 'text'];
            $settings[] = ['key' => "tech_plants_headline_{$loc}", 'value' => $dict['tech_section']['plants_headline'], 'group' => 'tech', 'type' => 'text'];

            // Sustainability
            $settings[] = ['key' => "sustainability_title_{$loc}", 'value' => $dict['sustainability_section']['title'], 'group' => 'sustainability', 'type' => 'text'];
            $settings[] = ['key' => "sustainability_desc_{$loc}", 'value' => $dict['sustainability_section']['desc'], 'group' => 'sustainability', 'type' => 'textarea'];

            // Careers
            $settings[] = ['key' => "careers_title_{$loc}", 'value' => $dict['careers_cta']['title'], 'group' => 'careers', 'type' => 'text'];
            $settings[] = ['key' => "careers_desc_{$loc}", 'value' => $dict['careers_cta']['desc'], 'group' => 'careers', 'type' => 'textarea'];
            $settings[] = ['key' => "careers_fraud_warning_{$loc}", 'value' => $dict['careers_cta']['fraud_warning'], 'group' => 'careers', 'type' => 'textarea'];
        }

        foreach ($settings as $item) {
            LandingPageSetting::updateOrCreate(
                ['key' => $item['key']],
                [
                    'value' => $item['value'],
                    'group' => $item['group'],
                    'type' => $item['type'],
                ]
            );
        }

        LandingPageSetting::clearCache();
    }
}
