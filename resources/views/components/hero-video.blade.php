@php
    $heroSlides = \App\Models\LandingPageSetting::getHeroSlides();
    $activeSlides = array_values(array_filter($heroSlides, fn($s) => !isset($s['is_active']) || $s['is_active']));
    if (empty($activeSlides)) {
        $activeSlides = \App\Models\LandingPageSetting::defaultHeroSlides();
    }
    $locale = app()->getLocale();
@endphp

<section 
    x-data="{
        currentScene: 0,
        totalScenes: {{ count($activeSlides) }},
        timer: null,
        init() {
            this.startTimer();
        },
        startTimer() {
            this.stopTimer();
            this.timer = setInterval(() => {
                this.nextScene();
            }, 7000);
        },
        stopTimer() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
        resetTimer() {
            this.stopTimer();
            this.startTimer();
        },
        nextScene() {
            this.currentScene = (this.currentScene + 1) % this.totalScenes;
        },
        prevScene() {
            this.currentScene = (this.currentScene - 1 + this.totalScenes) % this.totalScenes;
        },
        goTo(index) {
            this.currentScene = index;
            this.resetTimer();
        }
    }"
    class="relative min-h-[500px] xs:min-h-[580px] sm:min-h-[660px] lg:min-h-[720px] 2xl:min-h-[840px] flex items-center justify-center overflow-hidden bg-slate-950 text-white pt-16 sm:pt-20">

    <!-- Carousel Slides Background (Video or Image) -->
    @foreach($activeSlides as $index => $slide)
        @php
            $mediaUrl = $slide['media_url'] ?? asset('images/hero/hero-sunrise.jpg');
            if (!str_starts_with($mediaUrl, 'http') && !str_starts_with($mediaUrl, '/')) {
                $mediaUrl = asset($mediaUrl);
            }
            $isVideo = ($slide['media_type'] ?? '') === 'video' 
                || preg_match('/\.(mp4|webm|ogg|mov)$/i', $mediaUrl);
            
            $headline = $slide['headline_' . $locale] ?? $slide['headline_id'] ?? $slide['headline'] ?? '';
            $subtitle = $slide['subtitle_' . $locale] ?? $slide['subtitle_id'] ?? $slide['subtitle'] ?? '';
            $description = $slide['description_' . $locale] ?? $slide['description_id'] ?? $slide['description'] ?? '';
            $ctaText = $slide['cta_text_' . $locale] ?? $slide['cta_text_id'] ?? $slide['cta_text'] ?? __('messages.nav.philosophy');
            $ctaLink = $slide['cta_link'] ?? route('company.philosophy');
            $showGoFarBeyond = !empty($slide['show_gofarbeyond']);
            $badge = $slide['badge'] ?? 'Musashi Precision';
        @endphp

        <div 
            x-show="currentScene === {{ $index }}"
            x-transition:enter="transition-opacity ease-out duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-800"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 w-full h-full overflow-hidden">
            
            @if($isVideo)
                <!-- Background HTML5 Video with Autoplay, Muted, Loop & Playsinline -->
                <video 
                    autoplay 
                    muted 
                    loop 
                    playsinline 
                    class="absolute inset-0 w-full h-full object-cover transform scale-105 transition-transform duration-[7000ms] ease-out brightness-75">
                    <source src="{{ $mediaUrl }}" type="video/mp4">
                    <source src="{{ $mediaUrl }}" type="video/webm">
                </video>
            @else
                <!-- Slide Background Image with subtle zoom motion -->
                <img 
                    src="{{ $mediaUrl }}" 
                    alt="{{ $headline }}"
                    class="absolute inset-0 w-full h-full object-cover transform scale-105 transition-transform duration-[7000ms] ease-out brightness-75" />
            @endif

            <!-- Dark / Contrast Gradient Overlay for text legibility -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-black/30 pointer-events-none"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30 pointer-events-none"></div>
        </div>
    @endforeach

    <!-- Slide Content Overlay Container -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-28 w-full">
        @foreach($activeSlides as $index => $slide)
            @php
                $headline = $slide['headline_' . $locale] ?? $slide['headline_id'] ?? $slide['headline'] ?? '';
                $subtitle = $slide['subtitle_' . $locale] ?? $slide['subtitle_id'] ?? $slide['subtitle'] ?? '';
                $description = $slide['description_' . $locale] ?? $slide['description_id'] ?? $slide['description'] ?? '';
                $ctaText = $slide['cta_text_' . $locale] ?? $slide['cta_text_id'] ?? $slide['cta_text'] ?? '';
                $ctaLink = $slide['cta_link'] ?? '';
                $showGoFarBeyond = !empty($slide['show_gofarbeyond']);
                $badge = $slide['badge'] ?? '';
            @endphp

            <div x-show="currentScene === {{ $index }}" x-transition class="max-w-4xl" style="{{ $index > 0 ? 'display: none;' : '' }}">
                
                @if($badge)
                    <!-- Category Pill Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-black/60 border border-white/20 text-[11px] sm:text-xs font-semibold text-white tracking-widest uppercase mb-4 sm:mb-5 backdrop-blur-md">
                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-musashi-red animate-pulse"></span>
                        <span>{{ $badge }}</span>
                    </div>
                @endif

                <!-- Big Headline with Fluid Typography -->
                <h1 class="text-2xl xs:text-3xl sm:text-5xl lg:text-7xl font-black text-white tracking-tight leading-[1.15] sm:leading-[1.1] mb-3 sm:mb-4">
                    {{ $headline }}
                </h1>

                <!-- Subtitle -->
                @if($subtitle)
                    <p class="text-sm xs:text-base sm:text-2xl lg:text-3xl font-bold text-slate-100 tracking-normal mb-4 sm:mb-5 text-shadow">
                        {{ $subtitle }}
                    </p>
                @endif

                <!-- Optional GO FAR BEYOND Stylized Emblem (As in Image 1) -->
                @if($showGoFarBeyond)
                    <div class="my-4 sm:my-8 flex items-center gap-3">
                        <div class="border-2 border-white/30 rounded-2xl p-3 sm:p-6 bg-black/40 backdrop-blur-md inline-block">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <svg class="w-7 h-7 sm:w-14 sm:h-14 text-white" viewBox="0 0 48 48" fill="none">
                                    <path d="M10 26L20 36L42 12" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex flex-col">
                                    <span class="text-lg xs:text-xl sm:text-4xl font-black text-white tracking-tighter leading-none">GO FAR</span>
                                    <span class="text-lg xs:text-xl sm:text-4xl font-black text-white tracking-tighter leading-none">BEYOND</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Description / Caption Note -->
                @if($description)
                    <p class="text-xs sm:text-base text-slate-300 max-w-2xl leading-relaxed mb-5 sm:mb-8 italic drop-shadow">
                        {{ $description }}
                    </p>
                @endif

                <!-- CTA Button -->
                @if($ctaText && $ctaLink)
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                        <a href="{{ $ctaLink }}" 
                           class="inline-flex items-center justify-center gap-2.5 px-5 sm:px-7 py-2.5 sm:py-3.5 rounded-full text-xs sm:text-sm font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-lg transition-transform transform hover:-translate-y-0.5 text-center">
                            <span>{{ $ctaText }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                @endif

            </div>
        @endforeach
    </div>

    <!-- Center-Bottom Slide Pagination Indicator dots -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-30 flex items-center gap-2.5 bg-black/40 border border-white/10 backdrop-blur-md px-4 py-2 rounded-full">
        @foreach($activeSlides as $idx => $s)
            <button 
                @click="goTo({{ $idx }})" 
                :class="currentScene === {{ $idx }} ? 'w-6 bg-musashi-red' : 'w-2 bg-white/40 hover:bg-white'"
                class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                aria-label="Slide {{ $idx + 1 }}">
            </button>
        @endforeach
    </div>

    <!-- Navigation Arrows (Left/Right) -->
    <button 
        @click="prevScene()" 
        class="hidden md:flex absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-black/40 hover:bg-black/70 border border-white/10 text-white items-center justify-center backdrop-blur-md transition-colors cursor-pointer"
        aria-label="Previous Slide">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button 
        @click="nextScene()" 
        class="hidden md:flex absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-black/40 hover:bg-black/70 border border-white/10 text-white items-center justify-center backdrop-blur-md transition-colors cursor-pointer"
        aria-label="Next Slide">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

</section>
