@extends('layouts.app')

@section('title', \App\Models\LandingPageSetting::get('innov_page_main_title', 'Inovasi Bisnis Baru - PT. Musashi Auto Parts Indonesia'))
@section('meta_description', 'Jaringan Inovasi Terbuka: Inspeksi Visual AI & Smart Factory, Solusi Penyimpanan Energi Kapasitor Lithium-Ion, dan Kolaborasi Global SDGs.')

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
                <span class="text-slate-900 font-semibold">Inovasi</span>
            </nav>

            <!-- Top Grid Showcase (Matching Landing Page Layout & Picture Exactly) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Left: Headline, Description & 3 Core Innovation Pillars (7 Cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase">
                        <span>{{ \App\Models\LandingPageSetting::get('innov_badge', __('messages.innovation_section.badge')) }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight font-sans leading-tight">
                        {{ \App\Models\LandingPageSetting::get('innov_title', __('messages.innovation_section.title')) }}
                    </h1>

                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed font-normal">
                        {{ \App\Models\LandingPageSetting::get('innov_desc', __('messages.innovation_section.desc')) }}
                    </p>

                    <!-- 3 Innovation Pillars Cards Overview (Matching Landing Page) -->
                    <div class="space-y-3 pt-2">
                        <!-- Pillar 1 -->
                        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-lg bg-red-50 text-musashi-red border border-red-100 flex items-center justify-center text-xs font-mono font-bold shrink-0 mt-0.5">01</span>
                            <div>
                                <h4 class="text-slate-900 font-bold text-sm leading-snug">
                                    {{ \App\Models\LandingPageSetting::get('innov_pillar1_title', __('messages.innovation_section.pillar1_title')) }}
                                </h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                    {{ \App\Models\LandingPageSetting::get('innov_pillar1_desc', __('messages.innovation_section.pillar1_desc')) }}
                                </p>
                            </div>
                        </div>

                        <!-- Pillar 2 -->
                        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-lg bg-red-50 text-musashi-red border border-red-100 flex items-center justify-center text-xs font-mono font-bold shrink-0 mt-0.5">02</span>
                            <div>
                                <h4 class="text-slate-900 font-bold text-sm leading-snug">
                                    {{ \App\Models\LandingPageSetting::get('innov_pillar2_title', __('messages.innovation_section.pillar2_title')) }}
                                </h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                    {{ \App\Models\LandingPageSetting::get('innov_pillar2_desc', __('messages.innovation_section.pillar2_desc')) }}
                                </p>
                            </div>
                        </div>

                        <!-- Pillar 3 -->
                        <div class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-lg bg-red-50 text-musashi-red border border-red-100 flex items-center justify-center text-xs font-mono font-bold shrink-0 mt-0.5">03</span>
                            <div>
                                <h4 class="text-slate-900 font-bold text-sm leading-snug">
                                    {{ \App\Models\LandingPageSetting::get('innov_pillar3_title', __('messages.innovation_section.pillar3_title')) }}
                                </h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                    {{ \App\Models\LandingPageSetting::get('innov_pillar3_desc', __('messages.innovation_section.pillar3_desc')) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Navigation to Detailed Pillars -->
                    <div class="pt-2 flex flex-wrap items-center gap-3">
                        <a href="#pillar-ai" class="text-xs font-mono font-bold text-slate-700 hover:text-musashi-red underline underline-offset-4">
                            ↓ Detail Pilar 01 (AI & Smart Factory)
                        </a>
                        <span class="text-slate-300">•</span>
                        <a href="#pillar-energy" class="text-xs font-mono font-bold text-slate-700 hover:text-musashi-red underline underline-offset-4">
                            ↓ Detail Pilar 02 (Energy Solutions)
                        </a>
                        <span class="text-slate-300">•</span>
                        <a href="#pillar-cocreation" class="text-xs font-mono font-bold text-slate-700 hover:text-musashi-red underline underline-offset-4">
                            ↓ Detail Pilar 03 (Co-Creation & SDGs)
                        </a>
                    </div>
                </div>

                <!-- Right: Visual Innovation Card with Multi-Image Horizontal Slider (5 Cols) -->
                @php
                    $innovGallery = \App\Models\LandingPageSetting::getInnovGalleryImages();
                    if (empty($innovGallery)) {
                        $innovGallery = [\App\Models\LandingPageSetting::get('innov_image', 'images/business/green_smart_factory.jpg', false)];
                    }
                @endphp
                <div class="lg:col-span-5"
                     x-data="{
                         currentIdx: 0,
                         total: {{ count($innovGallery) }},
                         fullscreenImg: null,
                         scrollTo(index) {
                             const slider = this.$refs.innovSlider;
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
                             const slider = this.$refs.innovSlider;
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
                                x-ref="innovSlider"
                                @scroll.passive="onScroll()"
                                class="flex w-full h-full overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar"
                                style="scrollbar-width: none; -ms-overflow-style: none;">
                                @foreach($innovGallery as $idx => $iImg)
                                    <div class="w-full h-full flex-shrink-0 snap-center relative flex items-center justify-center bg-slate-950">
                                        <img 
                                            src="{{ asset($iImg) }}" 
                                            alt="Musashi Innovation Visual #{{ $idx + 1 }}" 
                                            class="w-full h-full object-cover select-none">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-40 pointer-events-none"></div>
                                        
                                        <!-- Lightbox Click Button -->
                                        <button 
                                            type="button" 
                                            @click="fullscreenImg = '{{ asset($iImg) }}'" 
                                            class="absolute top-3 right-3 p-2 rounded-xl bg-black/60 hover:bg-black/80 text-white/90 backdrop-blur-md opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer shadow-md"
                                            title="Lihat Foto Utuh (Fullscreen)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Floating Arrow Navigation Controls (Prev & Next) -->
                            @if(count($innovGallery) > 1)
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
                                    @foreach($innovGallery as $idx => $iImg)
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
                        @if(count($innovGallery) > 1)
                            <div class="p-2.5 bg-slate-50 border-t border-slate-100 flex items-center gap-2 overflow-x-auto no-scrollbar">
                                @foreach($innovGallery as $idx => $iImg)
                                    <button 
                                        type="button" 
                                        @click="scrollTo({{ $idx }})" 
                                        :class="currentIdx === {{ $idx }} ? 'ring-2 ring-musashi-red ring-offset-1 opacity-100 scale-102' : 'opacity-60 hover:opacity-100'"
                                        class="relative flex-shrink-0 w-14 h-10 rounded-lg overflow-hidden border border-slate-200 transition-all duration-200 cursor-pointer">
                                        <img src="{{ asset($iImg) }}" alt="Thumb {{ $idx + 1 }}" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <!-- Card Content Footer -->
                        <div class="p-5 sm:p-6 bg-white border-t border-slate-100">
                            <div class="flex items-center justify-between text-xs font-mono text-musashi-red font-bold mb-1.5">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-musashi-red animate-pulse"></span>
                                    {{ \App\Models\LandingPageSetting::get('innov_card_badge', __('messages.innovation_section.card_badge')) }}
                                </span>
                                <span class="text-slate-400 font-normal">{{ \App\Models\LandingPageSetting::get('innov_card_space_badge', __('messages.innovation_section.card_space_badge')) }}</span>
                            </div>
                            <h3 class="text-slate-900 font-bold text-base leading-snug">
                                {{ \App\Models\LandingPageSetting::get('innov_card_headline', __('messages.innovation_section.card_headline')) }}
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
                            <p class="text-white/70 text-xs font-mono mt-3 text-center">Inisiatif Riset & Inovasi Terbuka PT Musashi Auto Parts Indonesia</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 2. Detailed Technical Breakdown: 3 Pillars of Open Innovation -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">

            <!-- Section Introduction -->
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-widest block mb-2">
                    {{ app()->getLocale() === 'ja' ? '事業創出とオープンイノベーション' : (app()->getLocale() === 'id' ? 'Inisiatif Inovasi & Masa Depan Berkelanjutan' : 'Business Creation & Open Innovation') }}
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ app()->getLocale() === 'ja' ? '最先端技術とグローバル協創で拓く新たな可能性' : (app()->getLocale() === 'id' ? 'Memadukan Kecerdasan Buatan, Solusi Energi, dan Kolaborasi Global' : 'Bridging Artificial Intelligence, Energy Solutions, and Global Co-Creation') }}
                </h2>
                <div class="w-16 h-1 bg-musashi-red mx-auto mt-4 mb-4 rounded-full"></div>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    {{ app()->getLocale() === 'ja' ? '本業である自動車部品製造の枠を超え、持続可能な地球社会の実現に向けてオープンイノベーションを推進しています。' : (app()->getLocale() === 'id' ? 'Selain mengembangkan suku cadang presisi inti, kami bertekad memecahkan tantangan sosial global dan mempercepat tercapainya Tujuan Pembangunan Berkelanjutan (SDGs).' : 'Beyond our core automotive components, we are actively solving societal challenges to support a harmonious, carbon-neutral future.') }}
                </p>
            </div>

            <!-- 01. AI Optical Inspection & Smart Factory -->
            <div id="pillar-ai" class="bg-[#F8F9FA] rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8 scroll-mt-28">
                <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-200 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3.5 py-1 rounded-lg text-sm font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            01
                        </span>
                        <div>
                            <span class="text-xs font-mono text-slate-500 uppercase tracking-wider block">AI & Robotics Engineering</span>
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                {{ \App\Models\LandingPageSetting::get('innov_pillar1_title', __('messages.innovation_section.pillar1_title')) }}
                            </h3>
                        </div>
                    </div>
                    <span class="text-xs font-mono font-bold text-slate-400 bg-white px-3 py-1 rounded-full border border-slate-200">
                        Smart Factory • Zero Defect
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-4 text-slate-700 text-sm sm:text-base leading-relaxed">
                        <p class="font-semibold text-slate-900 text-base sm:text-lg">
                            Menerapkan Inspeksi Visual Berbasis Deep Learning untuk Akurasi Sub-Mikron pada Kecepatan Produksi Penuh.
                        </p>
                        <p>
                            Melalui pengembangan AI in-house bekerja sama dengan startup dan mitra riset komputasi global, Musashi mengotomatiskan keterampilan inspeksi visual yang sebelumnya memerlukan ketelitian panca indra manusia tingkat tinggi. Sistem optik cerdas kami mendeteksi goresan mikro, porositas, dan variasi dimensi dalam hitungan milidetik saat komponen melaju di lini konveyor berkecepatan tinggi.
                        </p>
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                                <span class="text-musashi-red font-mono font-bold text-xs uppercase block mb-1">Deep Learning Vision</span>
                                <span class="text-slate-600 text-xs">Mendeteksi cacat sub-mikron dengan tingkat akurasi 99,99%.</span>
                            </div>
                            <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                                <span class="text-musashi-red font-mono font-bold text-xs uppercase block mb-1">Otomasi Sel Robotik</span>
                                <span class="text-slate-600 text-xs">Pemilahan komponen otomatis tanpa henti selama 24/7.</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-md">
                            <img src="{{ asset('images/business/mapin-ai-1076x668.png') }}" alt="Musashi AI Optical Inspection System" class="w-full h-64 object-cover">
                            <div class="p-3 bg-white text-center text-xs text-slate-500 font-mono">
                                Sistem Inspeksi Optik AI & Sel Robotik Musashi
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 02. Energy Solutions & Lithium-Ion Capacitors -->
            <div id="pillar-energy" class="bg-[#F8F9FA] rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8 scroll-mt-28">
                <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-200 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3.5 py-1 rounded-lg text-sm font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            02
                        </span>
                        <div>
                            <span class="text-xs font-mono text-slate-500 uppercase tracking-wider block">Advanced Energy Storage</span>
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                {{ \App\Models\LandingPageSetting::get('innov_pillar2_title', __('messages.innovation_section.pillar2_title')) }}
                            </h3>
                        </div>
                    </div>
                    <span class="text-xs font-mono font-bold text-slate-400 bg-white px-3 py-1 rounded-full border border-slate-200">
                        100.000+ Siklus • Rapid Charge
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-4 text-slate-700 text-sm sm:text-base leading-relaxed">
                        <p class="font-semibold text-slate-900 text-base sm:text-lg">
                            Kapasitor Hibrida Lithium-Ion Berdaya Tahan Tinggi untuk Transportasi Kereta Api & Sistem Tenaga Surya.
                        </p>
                        <p>
                            Grup Musashi memelopori pengembangan Lithium-Ion Capacitor (LIC) berkinerja tinggi yang menggabungkan kepadatan energi baterai litium dengan kecepatan pengisian kilat kapasitor konvensional. Memiliki ketahanan lebih dari 100.000 siklus tanpa penurunan kapasitas signifikan dan toleransi suhu luas (-30°C hingga +70°C), modul ini ideal untuk penyimpanan energi pengereman regeneratif kereta api dan penstabil tegangan (*peak power leveling*) jaringan listrik hijau.
                        </p>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 font-medium">
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                                Pengisian & pengosongan daya ultra-cepat dalam hitungan detik.
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                                Keamanan tingkat tinggi tanpa risiko pelepasan termal (*thermal runaway*).
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                                Solusi penyimpanan daya ramah lingkungan untuk transportasi masa depan.
                            </li>
                        </ul>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-md">
                            <img src="{{ asset('images/business/energi-1117x560.jpg') }}" alt="Musashi Lithium-Ion Capacitor & Energy Solutions" class="w-full h-64 object-cover">
                            <div class="p-3 bg-white text-center text-xs text-slate-500 font-mono">
                                Modul Solusi Penyimpanan Energi & Kapasitor Lithium-Ion
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 03. Global Alliances & Co-Creation (SDGs) -->
            <div id="pillar-cocreation" class="bg-[#F8F9FA] rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8 scroll-mt-28">
                <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-200 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3.5 py-1 rounded-lg text-sm font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            03
                        </span>
                        <div>
                            <span class="text-xs font-mono text-slate-500 uppercase tracking-wider block">Global Open Innovation Network</span>
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                {{ \App\Models\LandingPageSetting::get('innov_pillar3_title', __('messages.innovation_section.pillar3_title')) }}
                            </h3>
                        </div>
                    </div>
                    <span class="text-xs font-mono font-bold text-slate-400 bg-white px-3 py-1 rounded-full border border-slate-200">
                        Net Zero 2060 • SDGs
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-4 text-slate-700 text-sm sm:text-base leading-relaxed">
                        <p class="font-semibold text-slate-900 text-base sm:text-lg">
                            Bekerja Sama dengan Universitas Global, Startup Mobilitas, dan Mitra Industri untuk Keberlanjutan Bumi.
                        </p>
                        <p>
                            Melalui jaringan *Open Innovation Network*, kami secara proaktif merangkul kemitraan dengan perguruan tinggi teknik dunia, start-up mobilitas listrik, serta pemangku kepentingan industri terkemuka. Bersama-sama, kami mengembangkan ekosistem transisi energi hijau di Indonesia, mendukung inisiatif dekarbonisasi Net Zero Emissions 2060 pemerintah, serta memperkuat kontribusi nyata bagi kelestarian alam dan keharmonisan sosial.
                        </p>
                        <div class="p-4 rounded-xl bg-white border border-slate-200 space-y-1">
                            <span class="text-slate-900 font-bold text-xs uppercase block">Fokus Komitmen Berkelanjutan:</span>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Instalasi panel surya atap (rooftop solar PV) di pabrik Cikarang & Karawang, efisiensi energi tungku induksi, serta daur ulang seratus persen limbah logam produksi.
                            </p>
                        </div>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-md">
                            <img src="{{ asset('images/business/solar-1236x640.jpg') }}" alt="Musashi Solar Clean Energy & Global SDGs" class="w-full h-64 object-cover">
                            <div class="p-3 bg-white text-center text-xs text-slate-500 font-mono">
                                Inisiatif Energi Bersih & Kolaborasi Keberlanjutan Global
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Bottom Navigation & Connected Pages -->
            <div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-6">
                <a href="{{ route('home') }}#innovation" class="inline-flex items-center gap-2 text-xs font-mono font-bold uppercase tracking-wider text-slate-600 hover:text-musashi-red transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Beranda (Bagian Inovasi)</span>
                </a>

                <div class="flex items-center gap-4">
                    <a href="{{ route('business.technology') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-musashi-red hover:bg-musashi-darkred text-white text-xs font-bold uppercase tracking-wider shadow-md hover:shadow-lg transition-all group">
                        <span>Lihat Halaman Teknologi</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
