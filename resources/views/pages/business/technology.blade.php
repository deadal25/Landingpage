@extends('layouts.app')

@section('title', \App\Models\LandingPageSetting::get('tech_page_main_title', 'Teknologi & Monozukuri - PT. Musashi Auto Parts Indonesia'))
@section('meta_description', 'Memahami Kebutuhan, Membangun Masa Depan Berpresisi: Kemampuan Pengembangan Produk, Sistem Produksi Terpadu, dan Teknologi Pendukung Mandiri.')

@section('content')
    <!-- 1. Page Header & Hero Showcase Section (Identical to Landing Page & Enhanced) -->
    <section class="pt-32 pb-16 sm:pb-20 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('home') }}#business" class="hover:text-musashi-red transition-colors">Bisnis</a>
                <span>/</span>
                <span class="text-slate-900 font-semibold">Teknologi</span>
            </nav>

            <!-- Top Grid Showcase (Matching Landing Page Layout & Picture Exactly) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Left: Headline, Description & 3 Core Pillars (7 Cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase">
                        <span>{{ \App\Models\LandingPageSetting::get('tech_badge', __('messages.tech_section.badge')) }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight font-sans leading-tight">
                        {{ \App\Models\LandingPageSetting::get('tech_title', __('messages.tech_section.title')) }}
                    </h1>

                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed font-normal">
                        {{ \App\Models\LandingPageSetting::get('tech_desc', __('messages.tech_section.desc')) }}
                    </p>

                    <!-- 3 Pillars Cards Overview (Matching Landing Page) -->
                    <div class="space-y-3 pt-2">
                        <!-- Pillar 1 -->
                        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-lg bg-red-50 text-musashi-red border border-red-100 flex items-center justify-center text-xs font-mono font-bold shrink-0 mt-0.5">01</span>
                            <div>
                                <h4 class="text-slate-900 font-bold text-sm leading-snug">
                                    {{ \App\Models\LandingPageSetting::get('tech_pillar1_title', __('messages.tech_section.pillar1_title')) }}
                                </h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                    {{ \App\Models\LandingPageSetting::get('tech_pillar1_desc', __('messages.tech_section.pillar1_desc')) }}
                                </p>
                            </div>
                        </div>

                        <!-- Pillar 2 -->
                        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-lg bg-red-50 text-musashi-red border border-red-100 flex items-center justify-center text-xs font-mono font-bold shrink-0 mt-0.5">02</span>
                            <div>
                                <h4 class="text-slate-900 font-bold text-sm leading-snug">
                                    {{ \App\Models\LandingPageSetting::get('tech_pillar2_title', __('messages.tech_section.pillar2_title')) }}
                                </h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                    {{ \App\Models\LandingPageSetting::get('tech_pillar2_desc', __('messages.tech_section.pillar2_desc')) }}
                                </p>
                            </div>
                        </div>

                        <!-- Pillar 3 -->
                        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-lg bg-red-50 text-musashi-red border border-red-100 flex items-center justify-center text-xs font-mono font-bold shrink-0 mt-0.5">03</span>
                            <div>
                                <h4 class="text-slate-900 font-bold text-sm leading-snug">
                                    {{ \App\Models\LandingPageSetting::get('tech_pillar3_title', __('messages.tech_section.pillar3_title')) }}
                                </h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                    {{ \App\Models\LandingPageSetting::get('tech_pillar3_desc', __('messages.tech_section.pillar3_desc')) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Navigation to Detailed Pillars -->
                    <div class="pt-2 flex flex-wrap items-center gap-3">
                        <a href="#pillar-01" class="text-xs font-mono font-bold text-slate-700 hover:text-musashi-red underline underline-offset-4">
                            ↓ Detail Pilar 01
                        </a>
                        <span class="text-slate-300">•</span>
                        <a href="#pillar-02" class="text-xs font-mono font-bold text-slate-700 hover:text-musashi-red underline underline-offset-4">
                            ↓ Detail Pilar 02
                        </a>
                        <span class="text-slate-300">•</span>
                        <a href="#pillar-03" class="text-xs font-mono font-bold text-slate-700 hover:text-musashi-red underline underline-offset-4">
                            ↓ Detail Pilar 03
                        </a>
                    </div>
                </div>

                <!-- Right: Visual Tech Card with Multi-Image Horizontal Slider (5 Cols) -->
                @php
                    $techGallery = \App\Models\LandingPageSetting::getTechGalleryImages();
                    if (empty($techGallery)) {
                        $techGallery = [\App\Models\LandingPageSetting::get('tech_image', 'images/hero/hero-plant.jpg', false)];
                    }
                @endphp
                <div class="lg:col-span-5"
                     x-data="{
                         currentIdx: 0,
                         total: {{ count($techGallery) }},
                         fullscreenImg: null,
                         scrollTo(index) {
                             const slider = this.$refs.techSlider;
                             if (slider) {
                                 slider.scrollTo({ left: index * slider.clientWidth, behavior: 'smooth' });
                                 this.currentIdx = index;
                             }
                         },
                         prev() {
                             const nextIdx = (this.currentIdx - 1 + this.total) % this.total;
                             this.scrollTo(nextIdx);
                         },
                         next() {
                             const nextIdx = (this.currentIdx + 1) % this.total;
                             this.scrollTo(nextIdx);
                         },
                         onScroll() {
                             const slider = this.$refs.techSlider;
                             if (slider && slider.clientWidth > 0) {
                                 this.currentIdx = Math.round(slider.scrollLeft / slider.clientWidth);
                             }
                         }
                     }">
                    <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-xl bg-white group">
                        
                        <!-- Multi-Image Carousel Viewport -->
                        <div class="relative overflow-hidden aspect-[16/10] bg-slate-900">
                            <!-- Scrollable Track (Swipeable / Scrollable to right) -->
                            <div 
                                x-ref="techSlider"
                                @scroll.passive="onScroll()"
                                class="flex w-full h-full overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar"
                                style="scrollbar-width: none; -ms-overflow-style: none;">
                                @foreach($techGallery as $idx => $tImg)
                                    <div class="w-full h-full flex-shrink-0 snap-center relative flex items-center justify-center bg-slate-950">
                                        <img 
                                            src="{{ asset($tImg) }}" 
                                            alt="Musashi Technology Visual #{{ $idx + 1 }}" 
                                            class="w-full h-full object-cover select-none">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-40 pointer-events-none"></div>
                                        
                                        <!-- Lightbox Click Button -->
                                        <button 
                                            type="button" 
                                            @click="fullscreenImg = '{{ asset($tImg) }}'" 
                                            class="absolute top-3 right-3 p-2 rounded-xl bg-black/60 hover:bg-black/80 text-white/90 backdrop-blur-md opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer shadow-md"
                                            title="Lihat Foto Utuh (Fullscreen)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Floating Arrow Navigation Controls (Prev & Next) -->
                            @if(count($techGallery) > 1)
                                <button 
                                    type="button" 
                                    @click="prev()" 
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-black/50 hover:bg-musashi-red text-white flex items-center justify-center backdrop-blur-md opacity-85 hover:opacity-100 transition-all shadow-md z-10 cursor-pointer"
                                    aria-label="Previous Slide">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button 
                                    type="button" 
                                    @click="next()" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-black/50 hover:bg-musashi-red text-white flex items-center justify-center backdrop-blur-md opacity-85 hover:opacity-100 transition-all shadow-md z-10 cursor-pointer"
                                    aria-label="Next Slide">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>

                                <!-- Slide Index Counter & Swipe Hint Badge -->
                                <div class="absolute bottom-3 left-3 flex items-center gap-2 pointer-events-none z-10">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-black/70 text-white backdrop-blur-md border border-white/10 shadow-xs flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-musashi-red animate-pulse"></span>
                                        <span x-text="(currentIdx + 1) + ' / ' + total"></span>
                                    </span>
                                    <span class="px-2 py-0.5 rounded-md text-[9px] font-mono text-white/80 bg-black/50 backdrop-blur-xs hidden sm:inline-block">
                                        Geser / Scroll ➔
                                    </span>
                                </div>

                                <!-- Bottom Dots Indicators -->
                                <div class="absolute bottom-3 right-3 flex items-center gap-1.5 z-10 bg-black/40 px-2 py-1 rounded-full backdrop-blur-md">
                                    @foreach($techGallery as $idx => $tImg)
                                        <button 
                                            type="button" 
                                            @click="scrollTo({{ $idx }})" 
                                            :class="currentIdx === {{ $idx }} ? 'w-5 bg-musashi-red' : 'w-1.5 bg-white/60 hover:bg-white'"
                                            class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"
                                            aria-label="Slide {{ $idx + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Thumbnail Strip for Quick Switching -->
                        @if(count($techGallery) > 1)
                            <div class="p-2.5 bg-slate-50 border-t border-slate-100 flex items-center gap-2 overflow-x-auto no-scrollbar">
                                @foreach($techGallery as $idx => $tImg)
                                    <button 
                                        type="button" 
                                        @click="scrollTo({{ $idx }})" 
                                        :class="currentIdx === {{ $idx }} ? 'ring-2 ring-musashi-red ring-offset-1 opacity-100 scale-102' : 'opacity-60 hover:opacity-100'"
                                        class="relative flex-shrink-0 w-14 h-10 rounded-lg overflow-hidden border border-slate-200 transition-all duration-200 cursor-pointer">
                                        <img src="{{ asset($tImg) }}" alt="Thumb {{ $idx + 1 }}" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <!-- Card Content Footer -->
                        <div class="p-5 sm:p-6 bg-white border-t border-slate-100">
                            <div class="flex items-center justify-between text-xs font-mono text-musashi-red font-bold mb-1.5">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-musashi-red animate-pulse"></span>
                                    {{ \App\Models\LandingPageSetting::get('tech_plants_badge', __('messages.tech_section.plants_badge')) }}
                                </span>
                                <span class="text-slate-400 font-normal">{{ \App\Models\LandingPageSetting::get('tech_space_badge', __('messages.tech_section.space_badge')) }}</span>
                            </div>
                            <h3 class="text-slate-900 font-bold text-base leading-snug">
                                {{ \App\Models\LandingPageSetting::get('tech_plants_headline', __('messages.tech_section.plants_headline')) }}
                            </h3>
                        </div>

                    </div>

                    <!-- Fullscreen Image Lightbox Modal (Gambar Utuh) -->
                    <div 
                        x-show="fullscreenImg" 
                        @keydown.escape.window="fullscreenImg = null" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        style="display: none;" 
                        class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4 sm:p-8"
                        @click.self="fullscreenImg = null">
                        
                        <button 
                            type="button" 
                            @click="fullscreenImg = null" 
                            class="absolute top-4 right-4 sm:top-6 sm:right-6 p-3 rounded-full bg-white/10 hover:bg-white/20 text-white text-sm font-bold backdrop-blur-md transition-colors cursor-pointer"
                            title="Tutup Preview">
                            ✕ Tutup
                        </button>

                        <div class="max-w-5xl max-h-[85vh] flex flex-col items-center">
                            <img :src="fullscreenImg" class="max-w-full max-h-[80vh] object-contain rounded-xl shadow-2xl border border-white/10" alt="Full View">
                            <p class="text-white/70 text-xs font-mono mt-3 text-center">Foto Fasilitas & Manufaktur Presisi PT Musashi Auto Parts Indonesia</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 2. Detailed Technical Breakdown: 3 Pillars of Monozukuri Mastery -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">

            <!-- Section Introduction -->
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-widest block mb-2">
                    {{ app()->getLocale() === 'ja' ? 'モノづくりの3大柱' : (app()->getLocale() === 'id' ? '3 Pilar Keunggulan Monozukuri' : '3 Pillars of Monozukuri Precision') }}
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ app()->getLocale() === 'ja' ? '確かな技術力と一貫生産が生む高精度品質' : (app()->getLocale() === 'id' ? 'Sinergi Keahlian Rekayasa, Pabrik Terpadu, dan Perkakas Mandiri' : 'Synergy of Engineering Prowess, Integrated Production, and In-House Tooling') }}
                </h2>
                <div class="w-16 h-1 bg-musashi-red mx-auto mt-4 mb-4 rounded-full"></div>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    {{ app()->getLocale() === 'ja' ? '世界基準の品質とコスト競争力を両立する武蔵グループ独自の技術体系。' : (app()->getLocale() === 'id' ? 'Memadukan lebih dari delapan dekade pengalaman manufaktur global dan keahlian lokal Indonesia demi menghasilkan komponen transmisi dan powertrain otomotif kelas dunia.' : 'Combining over eight decades of global manufacturing expertise and Indonesian excellence to deliver world-class automotive powertrain components.') }}
                </p>
            </div>

            <!-- 01. Product Development Capability -->
            <div id="pillar-01" class="bg-[#F8F9FA] rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8 scroll-mt-28">
                <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-200 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3.5 py-1 rounded-lg text-sm font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            01
                        </span>
                        <div>
                            <span class="text-xs font-mono text-slate-500 uppercase tracking-wider block">Engineering Prowess</span>
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                {{ \App\Models\LandingPageSetting::get('tech_pillar1_title', __('messages.tech_section.pillar1_title')) }}
                            </h3>
                        </div>
                    </div>
                    <span class="text-xs font-mono font-bold text-slate-400 bg-white px-3 py-1 rounded-full border border-slate-200">
                        35 Fasilitas di 14 Negara
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-4 text-slate-700 text-sm sm:text-base leading-relaxed">
                        <p class="font-semibold text-slate-900 text-base sm:text-lg">
                            Memberikan Solusi Rekayasa Terdepan Melalui Inovasi Riset & Pengembangan Global.
                        </p>
                        <p>
                            Keunggulan Musashi berakar dari warisan teknik lebih dari 80 tahun, pengetahuan mendalam di lantai pabrik (*gemba*), dan jaringan penelitian terpadu di 35 fasilitas di 14 negara. Kami berkolaborasi erat dengan pabrikan otomotif terkemuka sejak tahap konsep awal untuk mendesain unit reduksi gigi, diferensial ringan, dan powertrain mobilitas listrik modern.
                        </p>
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                                <span class="text-musashi-red font-mono font-bold text-xs uppercase block mb-1">Simulasi Digital (CAE)</span>
                                <span class="text-slate-600 text-xs">Analisis tegangan struktur & dinamika fluida pelumasan roda gigi.</span>
                            </div>
                            <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                                <span class="text-musashi-red font-mono font-bold text-xs uppercase block mb-1">Drivetrain Mobilitas Listrik</span>
                                <span class="text-slate-600 text-xs">Pengembangan modular unit e-Axle berdensitas daya tinggi.</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-md">
                            <img src="{{ asset('images/business/rd-1447x674.jpg') }}" alt="Musashi R&D Product Development Facility" class="w-full h-64 object-cover">
                            <div class="p-3 bg-white text-center text-xs text-slate-500 font-mono">
                                Fasilitas R&D & Pengujian Daya Tahan Musashi Global
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 02. Integrated Production System -->
            <div id="pillar-02" class="bg-[#F8F9FA] rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8 scroll-mt-28">
                <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-200 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3.5 py-1 rounded-lg text-sm font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            02
                        </span>
                        <div>
                            <span class="text-xs font-mono text-slate-500 uppercase tracking-wider block">Manufacturing Synergy</span>
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                {{ \App\Models\LandingPageSetting::get('tech_pillar2_title', __('messages.tech_section.pillar2_title')) }}
                            </h3>
                        </div>
                    </div>
                    <span class="text-xs font-mono font-bold text-slate-400 bg-white px-3 py-1 rounded-full border border-slate-200">
                        Zero Defect • Alur Terpadu
                    </span>
                </div>

                <div class="space-y-6 text-slate-700 text-sm sm:text-base leading-relaxed">
                    <p class="font-semibold text-slate-900 text-base sm:text-lg">
                        Berfokus pada Penempaan Presisi dan Pemrosesan Akurasi Tinggi dengan Kualitas Unggul dan Biaya Kompetitif.
                    </p>
                    <p>
                        Grup Musashi telah membentuk sistem manufaktur terpadu (*Integrated Production System*) yang mengintegrasikan secara mulus lima tahapan kritis: **Forging (penempaan presisi)**, **Lathing (pembubutan CNC akurasi tinggi)**, **Heat Treatment (perlakuan panas berdistorsi rendah)**, **Finishing (penyelesaian akhir sub-mikron)**, dan **Assembly (perakitan otomatis)**. Sistem ini memungkinkan kami melakukan aktivitas Kaizen dari sudut pandang optimalisasi menyeluruh demi meniadakan cacat produksi.
                    </p>

                    <!-- Flow Diagram Card -->
                    <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="text-xs font-mono font-bold text-slate-500 uppercase block mb-3 text-center">
                            Diagram Alur Sistem Produksi Terpadu Musashi (Precision Monozukuri Workflow)
                        </span>
                        <img src="{{ asset('images/business/p-system01-pc-en-775x232.png') }}" alt="Musashi Integrated Production System Flow Diagram" class="w-full max-w-4xl mx-auto h-auto object-contain">
                    </div>
                </div>
            </div>

            <!-- 03. Support Technology -->
            <div id="pillar-03" class="bg-[#F8F9FA] rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8 scroll-mt-28">
                <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-200 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3.5 py-1 rounded-lg text-sm font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            03
                        </span>
                        <div>
                            <span class="text-xs font-mono text-slate-500 uppercase tracking-wider block">In-House Tooling & Know-How</span>
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                {{ \App\Models\LandingPageSetting::get('tech_pillar3_title', __('messages.tech_section.pillar3_title')) }}
                            </h3>
                        </div>
                    </div>
                    <span class="text-xs font-mono font-bold text-slate-400 bg-white px-3 py-1 rounded-full border border-slate-200">
                        In-House Machine & Mold Making
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-4 text-slate-700 text-sm sm:text-base leading-relaxed">
                        <p class="font-semibold text-slate-900 text-base sm:text-lg">
                            Mendukung Sistem Produksi Terpadu Melalui Pembuatan Mesin Perkakas Mandiri dan Akumulasi Pengetahuan Teknik.
                        </p>
                        <p>
                            Melalui akumulasi keahlian puluhan tahun, Musashi merancang dan memproduksi sendiri mesin-mesin khusus (*custom machine tools*), cetakan tempa berdaya tahan tinggi (*dies*), perlengkapan presisi (*jigs*), serta peranti kendali otomatis. Kemampuan in-house ini memastikan stabilitas kualitas sub-mikron, waktu respon perbaikan yang kilat, dan diferensiasi teknologi yang sulit ditiru kompetitor.
                        </p>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 font-medium">
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                                Pembuatan cetakan tempa dingin dan panas berumur pakai ekstra panjang.
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                                Kalibrasi mikrometer in-line untuk inspeksi dimensi tanpa henti.
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                                Rekayasa robotik otomatisasi jalur konveyor pabrik Cikarang & Karawang.
                            </li>
                        </ul>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-md">
                            <img src="{{ asset('images/business/support-tech-1-1585x695.jpg') }}" alt="Musashi Support Technology In-House Manufacturing Facility" class="w-full h-64 object-cover">
                            <div class="p-3 bg-white text-center text-xs text-slate-500 font-mono">
                                Rekayasa Cetakan & Perkakas Presisi In-House Musashi
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Bottom Navigation & Connected Pages -->
            <div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-6">
                <a href="{{ route('home') }}#technology" class="inline-flex items-center gap-2 text-xs font-mono font-bold uppercase tracking-wider text-slate-600 hover:text-musashi-red transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Beranda (Bagian Teknologi)</span>
                </a>

                <div class="flex items-center gap-4">
                    <a href="{{ route('business.innovation') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-musashi-red hover:bg-musashi-darkred text-white text-xs font-bold uppercase tracking-wider shadow-md hover:shadow-lg transition-all group">
                        <span>Jelajahi Halaman Inovasi</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
