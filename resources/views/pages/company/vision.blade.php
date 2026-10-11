@extends('layouts.app')

@section('title', 'Global Vision - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Discover Musashi 100th Year Vision (towards 2038): Break Barriers and Go on Adventures! Transforming future mobility and sustainable industry.')

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Company</span>
                <span>/</span>
                <span class="text-black font-semibold">Global Vision</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">
                    {{ \App\Models\LandingPageSetting::get('vision_badge', 'Vision 2038') }}
                </span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                {{ \App\Models\LandingPageSetting::get('vision_title', 'Musashi 100th Year Vision') }}
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                {{ \App\Models\LandingPageSetting::get('vision_header_sub', 'Break Barriers and Go on Adventures! Navigating our transformative journey toward our centenary anniversary in 2038.') }}
            </p>
        </div>
    </section>

    <!-- Vision Content -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <div class="text-center max-w-3xl mx-auto space-y-6">
                <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200 inline-block">
                    {{ \App\Models\LandingPageSetting::get('vision_badge', 'Vision 2038') }}
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-black tracking-tight leading-tight">
                    {{ \App\Models\LandingPageSetting::get('vision_headline', 'Break Barriers and Go on Adventures!') }}
                </h2>
                <div class="w-12 h-1 bg-musashi-red mx-auto"></div>
                <p class="text-slate-700 text-base sm:text-lg leading-relaxed">
                    {{ \App\Models\LandingPageSetting::get('vision_sub', 'According to Musashi\'s philosophy of "a world where the earth and people coexist in prosperity and harmony," each of us becomes an adventurer as we create a path forward into the future.') }}
                </p>
                <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-3">
                    {!! nl2br(e(\App\Models\LandingPageSetting::get('vision_desc', 'Looking to the year 2038, the 100th anniversary of Musashi Seimitsu Industry\'s founding, we will break free of limitations and perceived barriers to create new value that is not an extension of the present.'))) !!}
                </div>
            </div>

            <!-- Vision Trajectory Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pillar 1 -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs relative overflow-hidden group hover:shadow-md hover:border-slate-300 transition-all">
                    <span class="text-5xl font-black text-slate-100 absolute -top-2 right-4 font-mono select-none">01</span>
                    <div class="w-12 h-12 rounded-xl bg-red-50 border border-red-200 flex items-center justify-center text-musashi-red mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-3">
                        {{ \App\Models\LandingPageSetting::get('vision_pillar1_title', 'Drivetrain Electrification') }}
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ \App\Models\LandingPageSetting::get('vision_pillar1_desc', 'Transitioning from conventional mechanical transmission into integrated 3-in-1 e-Axle propulsion, hybrid planetary reducers, and high-energy-density capacitor storage modules.') }}
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs relative overflow-hidden group hover:shadow-md hover:border-slate-300 transition-all">
                    <span class="text-5xl font-black text-slate-100 absolute -top-2 right-4 font-mono select-none">02</span>
                    <div class="w-12 h-12 rounded-xl bg-red-50 border border-red-200 flex items-center justify-center text-musashi-red mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-3">
                        {{ \App\Models\LandingPageSetting::get('vision_pillar2_title', 'AI & Smart Monozukuri') }}
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ \App\Models\LandingPageSetting::get('vision_pillar2_desc', 'Pioneering fully automated forging lines, digital twin simulation, robotic handling, and real-time AI optical inspection to eliminate defects and raise operator safety.') }}
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs relative overflow-hidden group hover:shadow-md hover:border-slate-300 transition-all">
                    <span class="text-5xl font-black text-slate-100 absolute -top-2 right-4 font-mono select-none">03</span>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-700 mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-3">
                        {{ \App\Models\LandingPageSetting::get('vision_pillar3_title', 'Carbon Neutrality') }}
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ \App\Models\LandingPageSetting::get('vision_pillar3_desc', 'Operating Indonesian plants with 100% clean power, zero process scrap to landfill, and creating circular economy value with Astra Group and international stakeholders.') }}
                    </p>
                </div>
            </div>

            <!-- Callout Box -->
            <div class="rounded-2xl p-8 sm:p-12 bg-slate-900 text-white border border-slate-800 text-center space-y-6 shadow-md">
                <span class="text-xs uppercase tracking-widest text-amber-400 font-mono font-bold">
                    {{ \App\Models\LandingPageSetting::get('vision_callout_badge', '100 Years of Trust') }}
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white">
                    {{ \App\Models\LandingPageSetting::get('vision_callout_title', 'An Essential Company Expected by Society') }}
                </h3>
                <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ \App\Models\LandingPageSetting::get('vision_callout_desc', 'We will not be bound by conventional precedent. We strive to be an enterprise whose presence makes society healthier, more sustainable, and brimming with human potential.') }}
                </p>
                <div class="pt-2">
                    <a href="{{ route('company.about') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md transition-all">
                        {{ \App\Models\LandingPageSetting::get('vision_callout_btn', 'Learn About Our Journey →') }}
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
