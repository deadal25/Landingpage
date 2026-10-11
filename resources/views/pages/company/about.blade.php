@extends('layouts.app')

@section('title', 'About Us - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Learn about PT Musashi Auto Parts Indonesia, our history, manufacturing plants in Cikarang and Karawang, and commitment to precision Monozukuri.')

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Company</span>
                <span>/</span>
                <span class="text-black font-semibold">About Us</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">{{ \App\Models\LandingPageSetting::get('about_badge', 'Company Profile') }}</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                {{ \App\Models\LandingPageSetting::get('about_headline', 'About Musashi Indonesia') }}
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                {{ \App\Models\LandingPageSetting::get('about_sub', 'Break Barriers and Go on Adventures! Engineering world-class transmission and automotive components since 1996.') }}
            </p>
        </div>
    </section>

    <!-- Main About Content -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
            
            <!-- Headline block -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200 inline-block">
                        {{ \App\Models\LandingPageSetting::get('about_identity_badge', 'Corporate Identity') }}
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-black leading-tight tracking-tight">
                        {{ \App\Models\LandingPageSetting::get('about_headline', 'Break Barriers and Go on Adventures!') }}
                    </h2>
                    <div class="w-12 h-1 bg-musashi-red"></div>
                    <p class="text-slate-700 text-base leading-relaxed">
                        {{ \App\Models\LandingPageSetting::get('about_sub', 'According to Musashi\'s Philosophy, for "a world where the earth and people coexist in prosperity and harmony," each one of us became adventurers and we will create a path forward into the future.') }}
                    </p>
                    <div class="text-slate-600 text-sm leading-relaxed space-y-3">
                        {!! nl2br(e(\App\Models\LandingPageSetting::get('about_desc', 'Looking to the year 2038, the 100th anniversary of Musashi Seimitsu Industry\'s founding, we break free of limitations to create new value that is not an extension of the present. Through seamless collaboration between our Cikarang and Karawang facilities and global headquarters in Toyohashi, Japan, we remain an indispensable partner for the world\'s premier automotive OEMs.'))) !!}
                    </div>
                </div>

                <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-sm bg-slate-50 p-2">
                    <img src="{{ asset(\App\Models\LandingPageSetting::get('about_hero_image', 'images/hero/hero-sunrise.jpg', false)) }}" alt="Musashi Corporate Dawn" class="w-full h-[400px] object-cover rounded-xl">
                    <div class="absolute bottom-6 left-6 right-6 p-4 rounded-xl bg-white/95 backdrop-blur-md border border-slate-200 text-xs text-slate-700 shadow-sm">
                        <strong class="text-black block font-bold mb-0.5">{{ \App\Models\LandingPageSetting::get('about_heritage_title', 'Heritage & Joint Venture') }}</strong>
                        {{ \App\Models\LandingPageSetting::get('about_heritage', 'Joint venture between Musashi Seimitsu Industry Co., Ltd., Japan (80%) and PT Astra Honda Motor (20%).') }}
                    </div>
                </div>
            </div>

            <!-- Fast Facts Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-slate-50 rounded-2xl p-6 text-center border-t-2 border-t-musashi-red border border-slate-200">
                    <div class="text-3xl sm:text-4xl font-black text-black font-mono mb-1">{{ \App\Models\LandingPageSetting::get('outline_established_stat', '1996', false) }}</div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-600">{{ \App\Models\LandingPageSetting::get('outline_established_stat_label', __('messages.company_stats.established')) }}</div>
                </div>

                <div class="bg-slate-50 rounded-2xl p-6 text-center border-t-2 border-t-slate-800 border border-slate-200">
                    <div class="text-3xl sm:text-4xl font-black text-black font-mono mb-1">{{ \App\Models\LandingPageSetting::get('outline_employees_stat', '1,637+', false) }}</div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-600">{{ \App\Models\LandingPageSetting::get('outline_employees_stat_label', __('messages.company_stats.workforce')) }}</div>
                </div>

                <div class="bg-slate-50 rounded-2xl p-6 text-center border-t-2 border-t-emerald-600 border border-slate-200">
                    <div class="text-3xl sm:text-4xl font-black text-black font-mono mb-1">{{ \App\Models\LandingPageSetting::get('outline_plant_area_stat', '115,000 m²', false) }}</div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-600">{{ \App\Models\LandingPageSetting::get('outline_plant_area_stat_label', __('messages.company_stats.plant_area')) }}</div>
                </div>

                <div class="bg-slate-50 rounded-2xl p-6 text-center border-t-2 border-t-blue-600 border border-slate-200">
                    <div class="text-3xl sm:text-4xl font-black text-black font-mono mb-1">{{ \App\Models\LandingPageSetting::get('outline_sales_stat', 'IDR 2.8T+', false) }}</div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-600">{{ \App\Models\LandingPageSetting::get('outline_sales_stat_label', __('messages.company_stats.sales_scale')) }}</div>
                </div>
            </div>

            <!-- Two Production Plants Highlight -->
            <div class="space-y-8">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-3 h-0.5 bg-musashi-red"></div>
                        <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">{{ \App\Models\LandingPageSetting::get('about_plants_badge', 'Manufacturing Network') }}</span>
                    </div>
                    <h3 class="text-2xl font-black text-black">
                        {{ \App\Models\LandingPageSetting::get('about_plants_headline', 'Two World-Class Indonesian Production Plants') }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Cikarang Plant -->
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition-all group">
                        <div class="h-52 overflow-hidden relative bg-slate-100">
                            <img src="{{ asset('images/hero/hero-plant.jpg') }}" alt="Cikarang Plant" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 px-3 py-1 rounded text-xs font-bold font-mono uppercase tracking-wider text-black bg-white/95 border border-slate-200 shadow-xs">
                                {{ \App\Models\LandingPageSetting::get('outline_plant1_title', 'Plant 1 - Cikarang (Head Office)') }}
                            </span>
                        </div>
                        <div class="p-6 space-y-3">
                            <h4 class="text-lg font-bold text-black">{{ \App\Models\LandingPageSetting::get('outline_plant1_name', 'EJIP Industrial Park, Cikarang Selatan') }}</h4>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                {{ \App\Models\LandingPageSetting::get('outline_plant1_info', 'EJIP Industrial Park Plot 3J-2, Cikarang Selatan, Bekasi (55,000 m²)') }}
                            </p>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                                <span>Phone: {{ \App\Models\LandingPageSetting::get('footer_phone_cikarang', '+62-21-8970866', false) }}</span>
                                <span class="text-musashi-red font-semibold">{{ \App\Models\LandingPageSetting::get('outline_plant1_tag', 'Head Office & Plant') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Karawang Plant -->
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition-all group">
                        <div class="h-52 overflow-hidden relative bg-slate-100">
                            <img src="{{ asset('images/hero/hero-automotive.jpg') }}" alt="Karawang Plant" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 px-3 py-1 rounded text-xs font-bold font-mono uppercase tracking-wider text-black bg-white/95 border border-slate-200 shadow-xs">
                                {{ \App\Models\LandingPageSetting::get('outline_plant2_title', 'Plant 2 - Karawang') }}
                            </span>
                        </div>
                        <div class="p-6 space-y-3">
                            <h4 class="text-lg font-bold text-black">{{ \App\Models\LandingPageSetting::get('outline_plant2_name', 'Suryacipta City of Industry, Karawang') }}</h4>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                {{ \App\Models\LandingPageSetting::get('outline_plant2_info', 'Suryacipta City of Industry Kav 1-36 BC, Ciampel, Karawang (60,000 m²)') }}
                            </p>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                                <span>Karawang Plant</span>
                                <span class="text-musashi-red font-semibold">{{ \App\Models\LandingPageSetting::get('outline_plant2_tag', 'Mass Forging Center') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
