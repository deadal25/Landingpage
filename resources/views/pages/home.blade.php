@extends('layouts.app')

@section('title', __('messages.company_name') . ' - Official Website')
@section('meta_description', __('messages.tagline') . ' - Precision automotive parts, transmission gears, camshafts, e-Axle electric mobility, and Monozukuri excellence.')

@section('content')

    <!-- Top Announcement Bar (Configurable in /SuperadminMusashi) -->
    @if(\App\Models\LandingPageSetting::get('announcement_bar_enabled', '0', false) === '1')
        <div class="bg-red-50 border-b border-red-200 text-slate-800 text-xs sm:text-sm py-2.5 px-4 text-center font-medium relative z-30">
            <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto flex items-center justify-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-musashi-red animate-pulse"></span>
                @php $annLink = \App\Models\LandingPageSetting::get('announcement_bar_link', '', false); @endphp
                @if(!empty($annLink))
                    <a href="{{ $annLink }}" class="hover:text-musashi-red transition-colors underline font-semibold">
                        {{ \App\Models\LandingPageSetting::getForLocale('announcement_bar_text', app()->getLocale(), 'Welcome to PT. Musashi Auto Parts Indonesia Official Portal.') }}
                    </a>
                @else
                    <span>{{ \App\Models\LandingPageSetting::getForLocale('announcement_bar_text', app()->getLocale(), 'Welcome to PT. Musashi Auto Parts Indonesia Official Portal.') }}</span>
                @endif
            </div>
        </div>
    @endif

    <!-- Hero Section (Exact visual match to musashi.co.jp screenshots) -->
    <x-hero-video />

    <!-- 1. NEWS SECTION (Interactive Horizontal News Carousel with Auto-Scroll & In-Page Article Reader) -->
    <section id="news" class="py-16 sm:py-20 bg-white border-b border-slate-200 scroll-mt-24"
        x-data="{
            appLocale: '{{ app()->getLocale() }}',
            activeNews: null,
            modalOpen: false,
            modalImgIndex: 0,
            autoScrollTimer: null,
            isHovered: false,
            canScrollLeft: false,
            canScrollRight: true,
            scrollPosition: 0,
            init() {
                this.$nextTick(() => {
                    this.updateScrollButtons();
                    this.startAutoScroll();
                });
            },
            startAutoScroll() {
                this.stopAutoScroll();
                this.autoScrollTimer = setInterval(() => {
                    if (!this.modalOpen) {
                        this.scrollNext();
                    }
                }, 4000);
            },
            stopAutoScroll() {
                if (this.autoScrollTimer) {
                    clearInterval(this.autoScrollTimer);
                    this.autoScrollTimer = null;
                }
            },
            scrollNext() {
                const el = this.$refs.newsCarousel;
                if (!el) return;
                const maxScroll = el.scrollWidth - el.clientWidth;
                const cardWidth = this.getCardWidth(el);
                if (el.scrollLeft >= maxScroll - 20) {
                    el.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    el.scrollBy({ left: cardWidth, behavior: 'smooth' });
                }
                setTimeout(() => this.updateScrollButtons(), 400);
            },
            scrollPrev() {
                const el = this.$refs.newsCarousel;
                if (!el) return;
                const cardWidth = this.getCardWidth(el);
                if (el.scrollLeft <= 20) {
                    const maxScroll = el.scrollWidth - el.clientWidth;
                    el.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    el.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                }
                setTimeout(() => this.updateScrollButtons(), 400);
            },
            getCardWidth(el) {
                const firstCard = el.querySelector('.news-card');
                return firstCard ? firstCard.offsetWidth + 24 : 360;
            },
            updateScrollButtons() {
                const el = this.$refs.newsCarousel;
                if (!el) return;
                const maxScroll = el.scrollWidth - el.clientWidth;
                this.canScrollLeft = el.scrollLeft > 15;
                this.canScrollRight = el.scrollLeft < maxScroll - 15;
                this.scrollPosition = el.scrollLeft;
            },
            openNews(item, initialIdx = 0) {
                this.activeNews = item;
                this.modalImgIndex = initialIdx;
                this.modalOpen = true;
                this.stopAutoScroll();
                document.body.style.overflow = 'hidden';
            },
            closeModal() {
                this.modalOpen = false;
                this.activeNews = null;
                this.modalImgIndex = 0;
                this.startAutoScroll();
                document.body.style.overflow = 'auto';
            },
            modalNextImg() {
                if (!this.activeNews?.images?.length) return;
                this.modalImgIndex = (this.modalImgIndex + 1) % this.activeNews.images.length;
            },
            modalPrevImg() {
                if (!this.activeNews?.images?.length) return;
                this.modalImgIndex = (this.modalImgIndex - 1 + this.activeNews.images.length) % this.activeNews.images.length;
            }
        }">
        <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header with Title, Carousel Controls & All News Link -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-4 border-b border-slate-200 gap-4">
                <div>
                    <div class="flex items-center gap-2 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase mb-1">
                        <span class="w-2 h-2 rounded-full bg-musashi-red animate-pulse"></span>
                        <span>{{ \App\Models\LandingPageSetting::get('news_badge', __('messages.nav.news')) }}</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ \App\Models\LandingPageSetting::get('news_title', __('messages.news_section.title')) }}
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Prev / Next Carousel Controls -->
                    <div class="flex items-center gap-2">
                        <button 
                            @click="scrollPrev()" 
                            type="button" 
                            aria-label="Previous News"
                            class="w-9 h-9 rounded-full border border-slate-300 bg-white hover:bg-slate-100 hover:border-musashi-red text-slate-700 hover:text-musashi-red flex items-center justify-center transition-all shadow-xs cursor-pointer focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button 
                            @click="scrollNext()" 
                            type="button" 
                            aria-label="Next News"
                            class="w-9 h-9 rounded-full border border-slate-300 bg-white hover:bg-slate-100 hover:border-musashi-red text-slate-700 hover:text-musashi-red flex items-center justify-center transition-all shadow-xs cursor-pointer focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    <div class="h-5 w-px bg-slate-200 hidden sm:block"></div>

                    <!-- View All Press Releases Link -->
                    <a href="{{ route('news.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-slate-700 hover:text-musashi-red transition-colors group">
                        <span>{{ \App\Models\LandingPageSetting::get('news_view_all_text', __('messages.news_section.view_all')) }}</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform text-musashi-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- News Cards Carousel (Scrolls automatically to the right, interactive, with multi-image auto-slider per card) -->
            <div class="relative">
                
                <div 
                    x-ref="newsCarousel"
                    @scroll.debounce.100ms="updateScrollButtons()"
                    class="flex gap-4 sm:gap-6 overflow-x-auto scroll-smooth py-4 px-1 snap-x snap-mandatory scrollbar-none"
                    style="-webkit-overflow-scrolling: touch; scrollbar-width: none; -ms-overflow-style: none;">
                    
                    @foreach($latestNews as $news)
                        @php
                            $cardImageUrls = array_values(array_map(fn($img) => str_starts_with($img, 'http') ? $img : asset($img), $news->all_images ?: [$news->image ?: 'images/hero/hero-automotive.jpg']));
                        @endphp
                        <article 
                            x-data="{
                                cardImgs: {{ json_encode($cardImageUrls) }},
                                currImgIdx: 0,
                                cardTimer: null,
                                isCardHovered: false,
                                init() {
                                    if (this.cardImgs.length > 1) {
                                        this.startAutoSlide();
                                    }
                                },
                                startAutoSlide() {
                                    this.stopAutoSlide();
                                    // Auto-scroll images in this card continuously to the right
                                    this.cardTimer = setInterval(() => {
                                        if (!this.isCardHovered) {
                                            this.currImgIdx = (this.currImgIdx + 1) % this.cardImgs.length;
                                        }
                                    }, 3000 + (({{ $news->id }} % 3) * 500));
                                },
                                stopAutoSlide() {
                                    if (this.cardTimer) {
                                        clearInterval(this.cardTimer);
                                        this.cardTimer = null;
                                    }
                                },
                                nextCardImg(e) {
                                    if (e) e.stopPropagation();
                                    this.currImgIdx = (this.currImgIdx + 1) % this.cardImgs.length;
                                },
                                prevCardImg(e) {
                                    if (e) e.stopPropagation();
                                    this.currImgIdx = (this.currImgIdx - 1 + this.cardImgs.length) % this.cardImgs.length;
                                }
                            }"
                            @mouseenter="isCardHovered = true"
                            @mouseleave="isCardHovered = false"
                            @click="openNews({
                                id: {{ $news->id }},
                                title: {{ json_encode($news->title) }},
                                category: {{ json_encode($news->category) }},
                                date: '{{ $news->published_at ? $news->published_at->format('Y.m.d') : $news->created_at->format('Y.m.d') }}',
                                image: '{{ $news->image ? asset($news->image) : asset('images/hero/hero-automotive.jpg') }}',
                                images: {{ json_encode($cardImageUrls) }},
                                content: {{ json_encode($news->content) }},
                                url: '{{ route('news.show', $news->slug) }}'
                            }, currImgIdx)"
                            class="news-card w-[265px] xs:w-[290px] sm:w-[330px] md:w-[360px] shrink-0 snap-start bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-musashi-red/40 hover:-translate-y-1 transition-all duration-300 flex flex-col group overflow-hidden cursor-pointer">
                            
                            <!-- News Image with Auto-Scroll to the right, Category Badge & Switcher -->
                            <div class="relative h-48 sm:h-52 w-full overflow-hidden bg-slate-900 flex-shrink-0">
                                
                                <!-- Horizontal sliding track for multiple images (scrolls to the right) -->
                                <div 
                                    class="flex h-full w-full transition-transform duration-700 ease-in-out"
                                    :style="'transform: translateX(-' + (currImgIdx * 100) + '%);'">
                                    @foreach($cardImageUrls as $cIdx => $cImgUrl)
                                        <div class="w-full h-full flex-shrink-0 relative overflow-hidden">
                                            <img 
                                                src="{{ $cImgUrl }}" 
                                                alt="{{ $news->title }}" 
                                                loading="lazy"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                                onerror="this.onerror=null;this.src='{{ asset('images/hero/hero-automotive.jpg') }}';">
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-black/25 opacity-70 group-hover:opacity-40 transition-opacity pointer-events-none"></div>
                                
                                <!-- Category Pill Badge -->
                                <div class="absolute top-3 left-3 z-10 pointer-events-none">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/95 backdrop-blur-md text-slate-800 shadow-sm border border-white/60">
                                        {{ $news->category }}
                                    </span>
                                </div>

                                <!-- Multi-image Photo Counter Badge if card has multiple photos -->
                                <template x-if="cardImgs.length > 1">
                                    <div class="absolute top-3 right-3 z-10 pointer-events-none">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-black/80 backdrop-blur-md text-white shadow-sm border border-white/20">
                                            <svg class="w-3 h-3 text-musashi-red animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>
                                            <span x-text="(currImgIdx + 1) + '/' + cardImgs.length"></span>
                                        </span>
                                    </div>
                                </template>

                                <!-- Mini Arrows to flip photos directly on the card -->
                                <template x-if="cardImgs.length > 1">
                                    <div class="absolute inset-x-2 top-1/2 -translate-y-1/2 flex items-center justify-between z-10 pointer-events-none">
                                        <button 
                                            @click="prevCardImg($event)" 
                                            type="button" 
                                            title="Foto sebelumnya"
                                            class="pointer-events-auto w-7 h-7 rounded-full bg-black/70 hover:bg-musashi-red text-white flex items-center justify-center text-xs font-bold shadow-md opacity-0 group-hover:opacity-100 transition-all cursor-pointer">
                                            ‹
                                        </button>
                                        <button 
                                            @click="nextCardImg($event)" 
                                            type="button" 
                                            title="Foto berikutnya"
                                            class="pointer-events-auto w-7 h-7 rounded-full bg-black/70 hover:bg-musashi-red text-white flex items-center justify-center text-xs font-bold shadow-md opacity-0 group-hover:opacity-100 transition-all cursor-pointer">
                                            ›
                                        </button>
                                    </div>
                                </template>

                                <!-- Date Tag on Image Bottom -->
                                <div class="absolute bottom-3 left-3 text-white/90 text-xs font-mono font-medium drop-shadow-sm flex items-center gap-1.5 z-10 pointer-events-none">
                                    <svg class="w-3.5 h-3.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ $news->published_at ? $news->published_at->format('Y.m.d') : $news->created_at->format('Y.m.d') }}</span>
                                </div>

                                <!-- Dot indicators on card image bottom right -->
                                <template x-if="cardImgs.length > 1">
                                    <div class="absolute bottom-3 right-3 flex items-center gap-1 z-10">
                                        <template x-for="(pic, pidx) in cardImgs" :key="pidx">
                                            <button 
                                                @click.stop="currImgIdx = pidx"
                                                type="button"
                                                :class="currImgIdx === pidx ? 'w-3 bg-musashi-red' : 'w-1.5 bg-white/60 hover:bg-white'" 
                                                class="h-1.5 rounded-full transition-all cursor-pointer"></button>
                                        </template>
                                    </div>
                                </template>
                            </div>

                            <!-- News Card Content -->
                            <div class="p-5 sm:p-6 flex flex-col flex-grow justify-between bg-white">
                                <div>
                                    <!-- Title -->
                                    <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-musashi-red transition-colors line-clamp-2 leading-snug mb-2.5">
                                        {{ $news->title }}
                                    </h3>

                                    <!-- Excerpt Preview -->
                                    <p class="text-xs sm:text-sm text-slate-600 line-clamp-2 leading-relaxed mb-4">
                                        {{ Str::limit($news->excerpt ?: strip_tags($news->content), 100) }}
                                    </p>
                                </div>

                                <!-- Card Footer: Baca News Button -->
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-musashi-red group-hover:text-musashi-darkred transition-colors">
                                        <span>{{ app()->getLocale() === 'ja' ? 'ニュースを読む' : (app()->getLocale() === 'id' ? 'Baca News' : 'Read News') }}</span>
                                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </span>

                                    <span class="text-[11px] font-mono text-slate-400 group-hover:text-slate-600 transition-colors">
                                        Musashi Press
                                    </span>
                                </div>
                            </div>

                        </article>
                    @endforeach

                </div>

                <!-- Floating gradient shadows on edges indicating scrollability -->
                <div 
                    x-show="canScrollLeft" 
                    x-transition 
                    class="pointer-events-none absolute left-0 top-4 bottom-4 w-12 bg-gradient-to-r from-white via-white/80 to-transparent z-10 hidden sm:block">
                </div>
                <div 
                    x-show="canScrollRight" 
                    x-transition 
                    class="pointer-events-none absolute right-0 top-4 bottom-4 w-12 bg-gradient-to-l from-white via-white/80 to-transparent z-10 hidden sm:block">
                </div>
            </div>

        </div>

        <!-- In-Page Quick-Read Article Modal (Reads whole article with full multiple photos gallery) -->
        <template x-teleport="body">
            <div 
                x-show="modalOpen" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                style="display: none;"
                class="fixed inset-0 z-50 flex items-center justify-center p-3 xs:p-4 sm:p-6 bg-black/80 backdrop-blur-md overflow-y-auto"
                @keydown.escape.window="closeModal()">
                
                <div 
                    @click.away="closeModal()"
                    x-show="modalOpen"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="bg-white rounded-2xl max-w-3xl w-full max-h-[92vh] overflow-hidden shadow-2xl border border-slate-200 flex flex-col my-3 sm:my-8">
                       <!-- Modal Header with Main Photo, Gallery Chevrons & Close Button -->
                    <div class="relative h-64 sm:h-72 md:h-80 bg-slate-950 flex-shrink-0">
                        <img 
                            :src="(activeNews?.images && activeNews?.images[modalImgIndex]) || activeNews?.image" 
                            :alt="activeNews?.title" 
                            class="w-full h-full object-cover opacity-95 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                        
                        <!-- Close Button -->
                        <button 
                            @click="closeModal()" 
                            class="absolute top-4 right-4 w-10 h-10 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center transition-colors shadow-lg cursor-pointer focus:outline-none z-20"
                            aria-label="Tutup">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>

                        <!-- Modal Photo Prev / Next Chevrons -->
                        <template x-if="activeNews?.images && activeNews.images.length > 1">
                            <div class="absolute inset-x-4 top-1/2 -translate-y-1/2 flex items-center justify-between z-20 pointer-events-none">
                                <button 
                                    @click="modalPrevImg()" 
                                    type="button" 
                                    title="Foto sebelumnya"
                                    class="pointer-events-auto w-10 h-10 rounded-full bg-black/60 hover:bg-musashi-red text-white flex items-center justify-center shadow-lg transition-colors cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button 
                                    @click="modalNextImg()" 
                                    type="button" 
                                    title="Foto berikutnya"
                                    class="pointer-events-auto w-10 h-10 rounded-full bg-black/60 hover:bg-musashi-red text-white flex items-center justify-center shadow-lg transition-colors cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        </template>

                        <!-- Bottom Info & Photo Counter -->
                        <div class="absolute bottom-4 left-6 right-6 flex items-center justify-between z-10 pointer-events-none">
                            <div class="flex items-center gap-3">
                                <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-musashi-red text-white shadow-sm" x-text="activeNews?.category"></span>
                                <span class="text-xs font-mono text-white/90" x-text="activeNews?.date"></span>
                            </div>
                            <template x-if="activeNews?.images && activeNews.images.length > 1">
                                <span class="px-3 py-1 rounded-full text-xs font-mono font-bold bg-black/75 text-white border border-white/20 backdrop-blur-md">
                                    📸 <span x-text="(appLocale === 'ja' ? '写真 ' : (appLocale === 'id' ? 'Foto ' : 'Photo ')) + (modalImgIndex + 1) + (appLocale === 'ja' ? ' / ' : (appLocale === 'id' ? ' dari ' : ' of ')) + activeNews.images.length"></span>
                                </span>
                            </template>
                        </div>
                    </div>

                    <!-- Modal Thumbnail Gallery Strip if multiple photos -->
                    <template x-if="activeNews?.images && activeNews.images.length > 1">
                        <div class="px-6 py-2.5 bg-slate-100 border-b border-slate-200 flex items-center gap-2 overflow-x-auto scrollbar-none flex-shrink-0">
                            <span class="text-[11px] font-mono font-bold text-slate-500 uppercase whitespace-nowrap mr-1">{{ app()->getLocale() === 'ja' ? 'フォトギャラリー:' : (app()->getLocale() === 'id' ? 'Galeri Foto:' : 'Photo Gallery:') }}</span>
                            <template x-for="(pic, pidx) in activeNews.images" :key="pidx">
                                <button 
                                    @click="modalImgIndex = pidx" 
                                    type="button" 
                                    :class="modalImgIndex === pidx ? 'ring-2 ring-musashi-red scale-105' : 'opacity-65 hover:opacity-100'"
                                    class="relative w-14 h-10 rounded-lg overflow-hidden border border-slate-300 flex-shrink-0 transition-all cursor-pointer">
                                    <img :src="pic" class="w-full h-full object-cover">
                                    <span class="absolute bottom-0 right-0 bg-black/70 text-white text-[8px] font-mono px-1 rounded-tl" x-text="pidx + 1"></span>
                                </button>
                            </template>
                        </div>
                    </template>

                    <!-- Modal Body (Full text article readable right here on the landing page) -->
                    <div class="p-4 xs:p-6 sm:p-8 overflow-y-auto flex-grow space-y-5 sm:space-y-6">
                        <div>
                            <h2 class="text-lg xs:text-xl sm:text-2xl font-extrabold text-slate-900 leading-snug" x-text="activeNews?.title"></h2>
                            <div class="w-12 h-1 bg-musashi-red rounded-full mt-2.5 sm:mt-3"></div>
                        </div>
                        
                        <div class="text-slate-700 text-xs sm:text-base leading-relaxed whitespace-pre-line" x-html="(activeNews?.content || '').includes('<') ? activeNews?.content : (activeNews?.content || '').replace(/\n/g, '<br>')"></div>

                        <!-- Gallery Grid in Modal if multiple photos -->
                        <template x-if="activeNews?.images && activeNews.images.length > 1">
                            <div class="pt-5 sm:pt-6 border-t border-slate-200 space-y-3">
                                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-900 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-musashi-red"></span>
                                    <span>{{ app()->getLocale() === 'ja' ? 'すべてのニュース写真' : (app()->getLocale() === 'id' ? 'Semua Foto Berita' : 'All Article Photos') }} (<span x-text="activeNews.images.length"></span> {{ app()->getLocale() === 'ja' ? '枚' : (app()->getLocale() === 'id' ? 'Foto' : 'Photos') }})</span>
                                </h4>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 sm:gap-3">
                                    <template x-for="(pic, pidx) in activeNews.images" :key="pidx">
                                        <div 
                                            @click="modalImgIndex = pidx" 
                                            class="rounded-xl overflow-hidden border border-slate-200 bg-slate-50 cursor-pointer hover:shadow-md hover:border-musashi-red transition-all group">
                                            <div class="relative h-24 xs:h-28 sm:h-32">
                                                <img :src="pic" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                <span class="absolute bottom-1.5 right-1.5 bg-black/70 text-white text-[9px] font-mono px-1.5 py-0.5 rounded-full" x-text="'#' + (pidx + 1)"></span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Modal Footer (Actions: Share WhatsApp, Salin Link, Buka Halaman, Tutup) -->
                    <div class="p-3.5 sm:p-6 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 flex-shrink-0"
                         x-data="{ copiedModal: false }">
                        <button 
                            @click="closeModal()" 
                            type="button" 
                            class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 text-xs font-bold transition-colors cursor-pointer order-last sm:order-first text-center">
                            {{ app()->getLocale() === 'ja' ? '閉じる' : (app()->getLocale() === 'id' ? 'Tutup' : 'Close') }}
                        </button>

                        <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto justify-stretch sm:justify-end">
                            <!-- Share to WhatsApp -->
                            <a 
                                :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent((activeNews?.title || '') + '\n' + (activeNews?.url || window.location.href))" 
                                target="_blank"
                                rel="noopener noreferrer"
                                title="Bagikan ke WhatsApp"
                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs transition-all shadow-sm hover:shadow-md cursor-pointer">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.79 14.07c-.24.68-1.4 1.25-1.92 1.33-.51.08-1.18.11-3.41-.81-2.85-1.18-4.68-4.08-4.82-4.27-.14-.19-1.16-1.54-1.16-2.94 0-1.4 7.3-2.09 1-.2.27-.29.6-.39.81-.39.21 0 .42 0 .61.01.2.01.46-.07.72.55.27.64.91 2.22.99 2.38.08.16.14.35.03.56-.11.21-.17.34-.33.53-.16.19-.34.42-.49.56-.16.16-.33.34-.14.66.19.32.84 1.38 1.8 2.24 1.24 1.11 2.28 1.45 2.6 1.61.32.16.51.13.7-.08.19-.21.82-.96 1.04-1.29.21-.32.43-.27.72-.16.29.11 1.85.87 2.17 1.03.32.16.53.24.61.37.08.14.08.79-.16 1.47z"/>
                                </svg>
                                <span>WhatsApp</span>
                            </a>

                            <!-- Salin Link -->
                            <button 
                                @click="navigator.clipboard.writeText(activeNews?.url || window.location.href); copiedModal = true; setTimeout(() => copiedModal = false, 2500)"
                                type="button"
                                :class="copiedModal ? 'bg-emerald-50 text-emerald-700 border-emerald-300 ring-1 ring-emerald-200' : 'bg-slate-100 hover:bg-slate-200 text-slate-800 border-slate-300'"
                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border text-xs font-bold transition-all cursor-pointer">
                                <template x-if="!copiedModal">
                                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                </template>
                                <template x-if="copiedModal">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </template>
                                <span x-text="copiedModal ? '{{ app()->getLocale() === 'ja' ? '✓ コピー完了' : (app()->getLocale() === 'id' ? '✓ Link Tersalin!' : '✓ Link Copied') }}' : '{{ app()->getLocale() === 'ja' ? 'リンクコピー' : (app()->getLocale() === 'id' ? 'Salin Link' : 'Copy Link') }}'"></span>
                            </button>

                            <!-- Buka Halaman Lengkap -->
                            <a 
                                :href="activeNews?.url" 
                                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-musashi-red hover:bg-musashi-darkred text-white text-xs font-bold uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                                <span>{{ app()->getLocale() === 'ja' ? '詳細ページ' : (app()->getLocale() === 'id' ? 'Halaman Penuh' : 'Full Page') }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </section>

    <!-- 2. FEATURED AUTOMOTIVE & EV PRODUCTS -->
    <section id="products" class="py-20 sm:py-24 bg-white border-b border-slate-200 scroll-mt-24">
        <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 pb-4 border-b border-slate-100">
                <div>
                    <span class="text-musashi-red text-xs font-bold uppercase tracking-widest font-mono">
                        {{ \App\Models\LandingPageSetting::get('products_badge', __('messages.nav.product')) }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1">
                        {{ \App\Models\LandingPageSetting::get('products_title', __('messages.products_section.title')) }}
                    </h2>
                    <p class="text-slate-600 text-xs sm:text-sm mt-1 max-w-xl">
                        {{ \App\Models\LandingPageSetting::get('products_desc', __('messages.products_section.desc')) }}
                    </p>
                </div>

                <a href="{{ route('product.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider text-slate-800 hover:text-white bg-slate-100 hover:bg-musashi-red border border-slate-200 hover:border-transparent transition-all">
                    <span>{{ \App\Models\LandingPageSetting::get('products_view_all_text', __('messages.products_section.view_all')) }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <!-- Products Grid (Clean White Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $product)
                    <div class="musashi-card overflow-hidden flex flex-col group bg-white border border-slate-200">
                        <div class="relative h-52 overflow-hidden bg-slate-100">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded text-[10px] font-bold tracking-wider uppercase text-slate-800 bg-white/90 border border-slate-200 backdrop-blur-sm shadow-xs">
                                {{ $product->category }}
                            </span>
                        </div>
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-musashi-red transition-colors mb-2">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-slate-500 text-xs sm:text-sm line-clamp-2 leading-relaxed mb-4">
                                    {{ $product->description }}
                                </p>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-xs font-mono text-slate-400">{{ __('messages.products_section.certified') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1 transition-colors">
                                    <span>{{ __('messages.products_section.details') }}</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. OUR BUSINESS & 4 GLOBAL PILLARS SECTION (Kompetensi Inti) -->
    <section id="business" class="py-20 sm:py-24 bg-slate-50/70 border-b border-slate-200 scroll-mt-24">
        <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header: Exactly matching Image 2 reference style -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 sm:mb-12 gap-6 pb-4 border-b border-slate-200">
                <div>
                    <span class="text-musashi-red text-xs font-bold uppercase tracking-widest font-mono">
                        {{ \App\Models\LandingPageSetting::get('pillars_badge', __('messages.pillars.badge')) }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mt-1">
                        {{ \App\Models\LandingPageSetting::get('pillars_title', __('messages.pillars.title')) }}
                    </h2>
                    <p class="text-slate-600 text-xs sm:text-sm mt-1 max-w-2xl leading-relaxed">
                        {{ \App\Models\LandingPageSetting::get('pillars_subtitle', __('messages.pillars.subtitle')) }}
                    </p>
                </div>
                <a href="{{ route('business.mobility') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white hover:bg-musashi-red hover:text-white text-slate-700 text-xs font-bold uppercase tracking-wider transition-all duration-200 shadow-xs border border-slate-200/90 self-start md:self-auto cursor-pointer group">
                    <span>{{ \App\Models\LandingPageSetting::getForLocale('pillars_view_all_text', app()->getLocale(), app()->getLocale() === 'ja' ? 'すべてのピラーを見る' : (app()->getLocale() === 'id' ? 'Lihat Semua Pilar' : 'Explore All Pillars')) }}</span>
                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <!-- 2x2 Large Domain Cards Grid with Spacious, Beautiful Typography & Authentic Photos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                
                <!-- Card 1: Mobility -->
                <div class="relative rounded-3xl overflow-hidden shadow-md hover:shadow-2xl group min-h-[340px] xs:min-h-[360px] h-auto sm:h-96 md:h-[420px] bg-slate-950 border border-slate-200/80 hover:border-musashi-red/60 transition-all duration-500">
                    <img 
                        src="{{ asset(\App\Models\LandingPageSetting::get('pillar1_image', 'images/business/p-product01-1117x719.jpg', false)) }}" 
                        alt="Mobility" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/55 to-black/15 group-hover:via-black/45 transition-colors duration-500"></div>
                    
                    <!-- Pillar Top Badge -->
                    <div class="absolute top-4 sm:top-5 left-4 sm:left-5 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-mono font-bold tracking-wider uppercase bg-black/60 backdrop-blur-md text-white border border-white/20 shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                            <span>{{ \App\Models\LandingPageSetting::getForLocale('pillar1_badge', app()->getLocale(), app()->getLocale() === 'ja' ? '01. モビリティ' : (app()->getLocale() === 'id' ? '01. Mobilitas' : '01. Mobility')) }}</span>
                        </span>
                    </div>

                    <!-- Content overlay bottom -->
                    <div class="absolute inset-x-0 bottom-0 p-5 xs:p-6 sm:p-8 md:p-9 flex flex-col justify-end z-10">
                        <div class="space-y-2 mb-4">
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white tracking-tight leading-snug drop-shadow-md">
                                {{ \App\Models\LandingPageSetting::get('pillar1_title', __('messages.pillars.mobility_title')) }}
                            </h3>
                            <p class="text-white/90 text-xs sm:text-sm font-normal leading-relaxed line-clamp-2 sm:line-clamp-3 drop-shadow-xs max-w-xl">
                                {{ \App\Models\LandingPageSetting::get('pillar1_desc', __('messages.pillars.mobility_desc')) }}
                            </p>
                        </div>
                        
                        <div class="pt-3.5 border-t border-white/15 flex flex-col xs:flex-row xs:items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-white/60 text-[11px] font-mono tracking-wider uppercase hidden sm:flex">
                                <span>{{ \App\Models\LandingPageSetting::getForLocale('pillar1_pill', app()->getLocale(), app()->getLocale() === 'ja' ? '電動化イニシアティブ' : (app()->getLocale() === 'id' ? 'Inisiatif Elektrifikasi' : 'Electrification Initiative')) }}</span>
                            </div>
                            <a href="{{ \App\Models\LandingPageSetting::get('pillar1_link', route('business.mobility'), false) }}" 
                               class="inline-flex items-center justify-center gap-2 bg-white hover:bg-musashi-red text-slate-900 hover:text-white font-bold text-xs sm:text-sm px-5 sm:px-6 py-2.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 self-stretch xs:self-end flex-shrink-0 whitespace-nowrap cursor-pointer group/btn">
                                <span>{{ \App\Models\LandingPageSetting::get('pillar1_btn_text', __('messages.pillars.read_more')) }}</span>
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Industry -->
                <div class="relative rounded-3xl overflow-hidden shadow-md hover:shadow-2xl group min-h-[340px] xs:min-h-[360px] h-auto sm:h-96 md:h-[420px] bg-slate-950 border border-slate-200/80 hover:border-musashi-red/60 transition-all duration-500">
                    <img 
                        src="{{ asset(\App\Models\LandingPageSetting::get('pillar2_image', 'images/business/industry-2-1117x642.jpg', false)) }}" 
                        alt="Industry" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/55 to-black/15 group-hover:via-black/45 transition-colors duration-500"></div>
                    
                    <!-- Pillar Top Badge -->
                    <div class="absolute top-4 sm:top-5 left-4 sm:left-5 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-mono font-bold tracking-wider uppercase bg-black/60 backdrop-blur-md text-white border border-white/20 shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                            <span>{{ \App\Models\LandingPageSetting::getForLocale('pillar2_badge', app()->getLocale(), app()->getLocale() === 'ja' ? '02. インダストリー' : (app()->getLocale() === 'id' ? '02. Industri 4.0' : '02. Industry 4.0')) }}</span>
                        </span>
                    </div>

                    <!-- Content overlay bottom -->
                    <div class="absolute inset-x-0 bottom-0 p-5 xs:p-6 sm:p-8 md:p-9 flex flex-col justify-end z-10">
                        <div class="space-y-2 mb-4">
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white tracking-tight leading-snug drop-shadow-md">
                                {{ \App\Models\LandingPageSetting::get('pillar2_title', __('messages.pillars.industry_title')) }}
                            </h3>
                            <p class="text-white/90 text-xs sm:text-sm font-normal leading-relaxed line-clamp-2 sm:line-clamp-3 drop-shadow-xs max-w-xl">
                                {{ \App\Models\LandingPageSetting::get('pillar2_desc', __('messages.pillars.industry_desc')) }}
                            </p>
                        </div>
                        
                        <div class="pt-3.5 border-t border-white/15 flex flex-col xs:flex-row xs:items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-white/60 text-[11px] font-mono tracking-wider uppercase hidden sm:flex">
                                <span>{{ \App\Models\LandingPageSetting::getForLocale('pillar2_pill', app()->getLocale(), app()->getLocale() === 'ja' ? 'スマートモノづくり' : (app()->getLocale() === 'id' ? 'Evolusi Monozukuri' : 'Monozukuri Evolution')) }}</span>
                            </div>
                            <a href="{{ \App\Models\LandingPageSetting::get('pillar2_link', route('business.industry'), false) }}" 
                               class="inline-flex items-center justify-center gap-2 bg-white hover:bg-musashi-red text-slate-900 hover:text-white font-bold text-xs sm:text-sm px-5 sm:px-6 py-2.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 self-stretch xs:self-end flex-shrink-0 whitespace-nowrap cursor-pointer group/btn">
                                <span>{{ \App\Models\LandingPageSetting::get('pillar2_btn_text', __('messages.pillars.read_more')) }}</span>
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Energy -->
                <div class="relative rounded-3xl overflow-hidden shadow-md hover:shadow-2xl group min-h-[340px] xs:min-h-[360px] h-auto sm:h-96 md:h-[420px] bg-slate-950 border border-slate-200/80 hover:border-musashi-red/60 transition-all duration-500">
                    <img 
                        src="{{ asset(\App\Models\LandingPageSetting::get('pillar3_image', 'images/business/energi-1117x560.jpg', false)) }}" 
                        alt="Energy" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/55 to-black/15 group-hover:via-black/45 transition-colors duration-500"></div>
                    
                    <!-- Pillar Top Badge -->
                    <div class="absolute top-4 sm:top-5 left-4 sm:left-5 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-mono font-bold tracking-wider uppercase bg-black/60 backdrop-blur-md text-white border border-white/20 shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                            <span>{{ \App\Models\LandingPageSetting::getForLocale('pillar3_badge', app()->getLocale(), app()->getLocale() === 'ja' ? '03. エネルギー' : (app()->getLocale() === 'id' ? '03. Solusi Energi' : '03. Energy Solutions')) }}</span>
                        </span>
                    </div>

                    <!-- Content overlay bottom -->
                    <div class="absolute inset-x-0 bottom-0 p-5 xs:p-6 sm:p-8 md:p-9 flex flex-col justify-end z-10">
                        <div class="space-y-2 mb-4">
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white tracking-tight leading-snug drop-shadow-md">
                                {{ \App\Models\LandingPageSetting::get('pillar3_title', __('messages.pillars.energy_title')) }}
                            </h3>
                            <p class="text-white/90 text-xs sm:text-sm font-normal leading-relaxed line-clamp-2 sm:line-clamp-3 drop-shadow-xs max-w-xl">
                                {{ \App\Models\LandingPageSetting::get('pillar3_desc', __('messages.pillars.energy_desc')) }}
                            </p>
                        </div>
                        
                        <div class="pt-3.5 border-t border-white/15 flex flex-col xs:flex-row xs:items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-white/60 text-[11px] font-mono tracking-wider uppercase hidden sm:flex">
                                <span>{{ \App\Models\LandingPageSetting::getForLocale('pillar3_pill', app()->getLocale(), app()->getLocale() === 'ja' ? '次世代バッテリー・BMS' : (app()->getLocale() === 'id' ? 'BMS & Baterai Hibrida' : 'BMS & Energy Storage')) }}</span>
                            </div>
                            <a href="{{ \App\Models\LandingPageSetting::get('pillar3_link', route('business.energy'), false) }}" 
                               class="inline-flex items-center justify-center gap-2 bg-white hover:bg-musashi-red text-slate-900 hover:text-white font-bold text-xs sm:text-sm px-5 sm:px-6 py-2.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 self-stretch xs:self-end flex-shrink-0 whitespace-nowrap cursor-pointer group/btn">
                                <span>{{ \App\Models\LandingPageSetting::get('pillar3_btn_text', __('messages.pillars.read_more')) }}</span>
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Well-being -->
                <div class="relative rounded-3xl overflow-hidden shadow-md hover:shadow-2xl group min-h-[340px] xs:min-h-[360px] h-auto sm:h-96 md:h-[420px] bg-slate-950 border border-slate-200/80 hover:border-musashi-red/60 transition-all duration-500">
                    <img 
                        src="{{ asset(\App\Models\LandingPageSetting::get('pillar4_image', 'images/business/well-being2-1117x556.jpg', false)) }}" 
                        alt="Well-being" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/55 to-black/15 group-hover:via-black/45 transition-colors duration-500"></div>
                    
                    <!-- Pillar Top Badge -->
                    <div class="absolute top-4 sm:top-5 left-4 sm:left-5 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-mono font-bold tracking-wider uppercase bg-black/60 backdrop-blur-md text-white border border-white/20 shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-musashi-red"></span>
                            <span>{{ \App\Models\LandingPageSetting::getForLocale('pillar4_badge', app()->getLocale(), app()->getLocale() === 'ja' ? '04. ウェルビーイング' : (app()->getLocale() === 'id' ? '04. Kesejahteraan Sosial' : '04. Social Well-being')) }}</span>
                        </span>
                    </div>

                    <!-- Content overlay bottom -->
                    <div class="absolute inset-x-0 bottom-0 p-5 xs:p-6 sm:p-8 md:p-9 flex flex-col justify-end z-10">
                        <div class="space-y-2 mb-4">
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white tracking-tight leading-snug drop-shadow-md">
                                {{ \App\Models\LandingPageSetting::get('pillar4_title', __('messages.pillars.wellbeing_title')) }}
                            </h3>
                            <p class="text-white/90 text-xs sm:text-sm font-normal leading-relaxed line-clamp-2 sm:line-clamp-3 drop-shadow-xs max-w-xl">
                                {{ \App\Models\LandingPageSetting::get('pillar4_desc', __('messages.pillars.wellbeing_desc')) }}
                            </p>
                        </div>
                        
                        <div class="pt-3.5 border-t border-white/15 flex flex-col xs:flex-row xs:items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-white/60 text-[11px] font-mono tracking-wider uppercase hidden sm:flex">
                                <span>{{ \App\Models\LandingPageSetting::getForLocale('pillar4_pill', app()->getLocale(), app()->getLocale() === 'ja' ? '地域共生と社会貢献' : (app()->getLocale() === 'id' ? 'Harmonisasi & Komunitas' : 'Community & Harmony')) }}</span>
                            </div>
                            <a href="{{ \App\Models\LandingPageSetting::get('pillar4_link', route('business.wellbeing'), false) }}" 
                               class="inline-flex items-center justify-center gap-2 bg-white hover:bg-musashi-red text-slate-900 hover:text-white font-bold text-xs sm:text-sm px-5 sm:px-6 py-2.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 self-stretch xs:self-end flex-shrink-0 whitespace-nowrap cursor-pointer group/btn">
                                <span>{{ \App\Models\LandingPageSetting::get('pillar4_btn_text', __('messages.pillars.read_more')) }}</span>
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 4. TECHNOLOGY & MONOZUKURI (Matching Technology Page Pillars) -->
    <section id="technology" class="py-16 sm:py-20 bg-[#F8F9FA] border-b border-slate-200 scroll-mt-24">
        <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Left: Technology Story (7 Cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase">
                        <span>{{ \App\Models\LandingPageSetting::get('tech_badge', __('messages.tech_section.badge')) }}</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        {{ \App\Models\LandingPageSetting::get('tech_title', __('messages.tech_section.title')) }}
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        {{ \App\Models\LandingPageSetting::get('tech_desc', __('messages.tech_section.desc')) }}
                    </p>

                    <!-- Tech Pillars: 3 Pillars matching Technology Page -->
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

                    <div class="pt-2">
                        <a href="{{ \App\Models\LandingPageSetting::get('tech_btn1_link', route('business.technology'), false) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md hover:shadow-lg transition-all duration-200 group">
                            <span>{{ \App\Models\LandingPageSetting::get('tech_btn1_text', __('messages.tech_section.btn_tech')) }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Right: Visual Tech Card with Multi-Image Horizontal Slider (5 Cols) -->
                @php
                    $homeTechGallery = \App\Models\LandingPageSetting::getTechGalleryImages();
                    if (empty($homeTechGallery)) {
                        $homeTechGallery = [\App\Models\LandingPageSetting::get('tech_image', 'images/hero/hero-plant.jpg', false)];
                    }
                @endphp
                <div class="lg:col-span-5"
                     x-data="{
                         currentIdx: 0,
                         total: {{ count($homeTechGallery) }},
                         scrollTo(index) {
                             const slider = this.$refs.homeTechSlider;
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
                             const slider = this.$refs.homeTechSlider;
                             if (slider && slider.clientWidth > 0) {
                                 this.currentIdx = Math.round(slider.scrollLeft / slider.clientWidth);
                             }
                         }
                     }">
                    <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-xl bg-white group">
                        
                        <!-- Carousel Viewport -->
                        <div class="relative overflow-hidden aspect-[16/10] bg-slate-900">
                            <div 
                                x-ref="homeTechSlider"
                                @scroll.passive="onScroll()"
                                class="flex w-full h-full overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar"
                                style="scrollbar-width: none; -ms-overflow-style: none;">
                                @foreach($homeTechGallery as $idx => $tImg)
                                    <div class="w-full h-full flex-shrink-0 snap-center relative flex items-center justify-center bg-slate-950">
                                        <img 
                                            src="{{ asset($tImg) }}" 
                                            alt="Musashi Technology Visual #{{ $idx + 1 }}" 
                                            class="w-full h-full object-cover select-none">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-40 pointer-events-none"></div>
                                    </div>
                                @endforeach
                            </div>

                            @if(count($homeTechGallery) > 1)
                                <button 
                                    type="button" 
                                    @click="prev()" 
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/50 hover:bg-musashi-red text-white flex items-center justify-center backdrop-blur-md opacity-85 hover:opacity-100 transition-all shadow-md z-10 cursor-pointer"
                                    aria-label="Previous Slide">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button 
                                    type="button" 
                                    @click="next()" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/50 hover:bg-musashi-red text-white flex items-center justify-center backdrop-blur-md opacity-85 hover:opacity-100 transition-all shadow-md z-10 cursor-pointer"
                                    aria-label="Next Slide">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>

                                <!-- Slide Index Counter -->
                                <div class="absolute bottom-3 left-3 flex items-center gap-1.5 pointer-events-none z-10">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-black/70 text-white backdrop-blur-md border border-white/10 shadow-xs flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-musashi-red animate-pulse"></span>
                                        <span x-text="(currentIdx + 1) + ' / ' + total"></span>
                                    </span>
                                </div>

                                <!-- Dots -->
                                <div class="absolute bottom-3 right-3 flex items-center gap-1 z-10 bg-black/40 px-2 py-1 rounded-full backdrop-blur-md">
                                    @foreach($homeTechGallery as $idx => $tImg)
                                        <button 
                                            type="button" 
                                            @click="scrollTo({{ $idx }})" 
                                            :class="currentIdx === {{ $idx }} ? 'w-4 bg-musashi-red' : 'w-1.5 bg-white/60 hover:bg-white'"
                                            class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"
                                            aria-label="Slide {{ $idx + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Card Link & Footer -->
                        <a href="{{ \App\Models\LandingPageSetting::get('tech_btn1_link', route('business.technology'), false) }}" class="block p-5 sm:p-6 bg-white border-t border-slate-100 group-hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-center justify-between text-xs font-mono text-musashi-red font-bold mb-1.5">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-musashi-red animate-pulse"></span>
                                    {{ \App\Models\LandingPageSetting::get('tech_plants_badge', __('messages.tech_section.plants_badge')) }}
                                </span>
                                <span class="text-slate-400 font-normal">{{ \App\Models\LandingPageSetting::get('tech_space_badge', __('messages.tech_section.space_badge')) }}</span>
                            </div>
                            <h3 class="text-slate-900 font-bold text-base leading-snug group-hover:text-musashi-red transition-colors flex items-center justify-between gap-2">
                                <span>{{ \App\Models\LandingPageSetting::get('tech_plants_headline', __('messages.tech_section.plants_headline')) }}</span>
                                <span class="text-slate-400 text-sm font-normal">→</span>
                            </h3>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. INNOVATION & OPEN CO-CREATION SECTION (Polished & Harmonious) -->
    <section id="innovation" class="py-16 sm:py-20 bg-white border-b border-slate-200 scroll-mt-24">
        <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Left: Innovation Story & Pillars (7 Cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase">
                        <span>{{ \App\Models\LandingPageSetting::get('innov_badge', __('messages.innovation_section.badge')) }}</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        {{ \App\Models\LandingPageSetting::get('innov_title', __('messages.innovation_section.title')) }}
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        {{ \App\Models\LandingPageSetting::get('innov_desc', __('messages.innovation_section.desc')) }}
                    </p>

                    <!-- Innovation 3 Pillars matching Innovation Page -->
                    <div class="space-y-3 pt-2">
                        <!-- Pillar 1 -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
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
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
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
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/90 shadow-xs hover:border-musashi-red/40 hover:shadow-sm transition-all flex items-start gap-3.5">
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

                    <div class="pt-2">
                        <a href="{{ \App\Models\LandingPageSetting::get('innov_btn_link', route('business.innovation'), false) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md hover:shadow-lg transition-all duration-200 group">
                            <span>{{ \App\Models\LandingPageSetting::get('innov_btn_text', __('messages.innovation_section.btn_innov')) }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Right: Visual Innovation Card with Multi-Image Horizontal Slider (5 Cols) -->
                @php
                    $homeInnovGallery = \App\Models\LandingPageSetting::getInnovGalleryImages();
                    if (empty($homeInnovGallery)) {
                        $homeInnovGallery = [\App\Models\LandingPageSetting::get('innov_image', 'images/business/green_smart_factory.jpg', false)];
                    }
                @endphp
                <div class="lg:col-span-5"
                     x-data="{
                         currentIdx: 0,
                         total: {{ count($homeInnovGallery) }},
                         scrollTo(index) {
                             const slider = this.$refs.homeInnovSlider;
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
                             const slider = this.$refs.homeInnovSlider;
                             if (slider && slider.clientWidth > 0) {
                                 this.currentIdx = Math.round(slider.scrollLeft / slider.clientWidth);
                             }
                         }
                     }">
                    <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-xl bg-white group">
                        
                        <!-- Carousel Viewport -->
                        <div class="relative overflow-hidden aspect-[16/10] bg-slate-900">
                            <div 
                                x-ref="homeInnovSlider"
                                @scroll.passive="onScroll()"
                                class="flex w-full h-full overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar"
                                style="scrollbar-width: none; -ms-overflow-style: none;">
                                @foreach($homeInnovGallery as $idx => $iImg)
                                    <div class="w-full h-full flex-shrink-0 snap-center relative flex items-center justify-center bg-slate-950">
                                        <img 
                                            src="{{ asset($iImg) }}" 
                                            alt="Musashi Innovation Visual #{{ $idx + 1 }}" 
                                            class="w-full h-full object-cover select-none">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-40 pointer-events-none"></div>
                                    </div>
                                @endforeach
                            </div>

                            @if(count($homeInnovGallery) > 1)
                                <button 
                                    type="button" 
                                    @click="prev()" 
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/50 hover:bg-musashi-red text-white flex items-center justify-center backdrop-blur-md opacity-85 hover:opacity-100 transition-all shadow-md z-10 cursor-pointer"
                                    aria-label="Previous Slide">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button 
                                    type="button" 
                                    @click="next()" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/50 hover:bg-musashi-red text-white flex items-center justify-center backdrop-blur-md opacity-85 hover:opacity-100 transition-all shadow-md z-10 cursor-pointer"
                                    aria-label="Next Slide">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>

                                <!-- Slide Index Counter -->
                                <div class="absolute bottom-3 left-3 flex items-center gap-1.5 pointer-events-none z-10">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-black/70 text-white backdrop-blur-md border border-white/10 shadow-xs flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-musashi-red animate-pulse"></span>
                                        <span x-text="(currentIdx + 1) + ' / ' + total"></span>
                                    </span>
                                </div>

                                <!-- Dots -->
                                <div class="absolute bottom-3 right-3 flex items-center gap-1 z-10 bg-black/40 px-2 py-1 rounded-full backdrop-blur-md">
                                    @foreach($homeInnovGallery as $idx => $iImg)
                                        <button 
                                            type="button" 
                                            @click="scrollTo({{ $idx }})" 
                                            :class="currentIdx === {{ $idx }} ? 'w-4 bg-musashi-red' : 'w-1.5 bg-white/60 hover:bg-white'"
                                            class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"
                                            aria-label="Slide {{ $idx + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Card Link & Footer -->
                        <a href="{{ \App\Models\LandingPageSetting::get('innov_btn_link', route('business.innovation'), false) }}" class="block p-5 sm:p-6 bg-white border-t border-slate-100 group-hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-center justify-between text-xs font-mono text-musashi-red font-bold mb-1.5">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-musashi-red animate-pulse"></span>
                                    {{ \App\Models\LandingPageSetting::get('innov_card_badge', __('messages.innovation_section.card_badge')) }}
                                </span>
                                <span class="text-slate-400 font-normal">{{ \App\Models\LandingPageSetting::get('innov_card_space_badge', __('messages.innovation_section.card_space_badge')) }}</span>
                            </div>
                            <h3 class="text-slate-900 font-bold text-base leading-snug group-hover:text-musashi-red transition-colors flex items-center justify-between gap-2">
                                <span>{{ \App\Models\LandingPageSetting::get('innov_card_headline', __('messages.innovation_section.card_headline')) }}</span>
                                <span class="text-slate-400 text-sm font-normal">→</span>
                            </h3>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. COMPANY OVERVIEW SECTION (All 7 Pillars with In-Page Anchors & Read More) -->
    <section id="company" class="py-20 sm:py-24 bg-white border-b border-slate-200 scroll-mt-24">
        <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase mb-3">
                    <span>{{ \App\Models\LandingPageSetting::get('company_badge', __('messages.nav.company')) }}</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ \App\Models\LandingPageSetting::get('about_headline', 'PT. Musashi Auto Parts Indonesia') }}
                </h2>
                <div class="w-16 h-1 bg-musashi-red mx-auto mt-4 mb-5 rounded-full"></div>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    {{ \App\Models\LandingPageSetting::get('about_sub', 'Monozukuri berpresisi tinggi dan dedikasi manufaktur terpadu sejak 1996 di Cikarang dan Karawang.') }}
                </p>
            </div>

            <!-- Fast Facts Stats Grid (Jumlah Karyawan, Total Luas Pabrik, Tahun Berdiri, Skala Penjualan) -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-12">
                <div class="musashi-card bg-slate-50/80 rounded-2xl p-3.5 xs:p-5 sm:p-6 text-center border-t-2 border-t-musashi-red border border-slate-200">
                    <div class="text-xl xs:text-2xl sm:text-4xl font-black text-slate-900 font-mono mb-1">
                        {{ \App\Models\LandingPageSetting::get('outline_established_stat', '1996', false) }}
                    </div>
                    <div class="text-[10px] xs:text-[11px] sm:text-xs font-semibold uppercase tracking-wider text-slate-600">
                        {{ \App\Models\LandingPageSetting::get('outline_established_stat_label', __('messages.company_stats.established')) }}
                    </div>
                </div>

                <div class="musashi-card bg-slate-50/80 rounded-2xl p-3.5 xs:p-5 sm:p-6 text-center border-t-2 border-t-slate-800 border border-slate-200">
                    <div class="text-xl xs:text-2xl sm:text-4xl font-black text-slate-900 font-mono mb-1">
                        {{ \App\Models\LandingPageSetting::get('outline_employees_stat', '1,637+', false) }}
                    </div>
                    <div class="text-[10px] xs:text-[11px] sm:text-xs font-semibold uppercase tracking-wider text-slate-600">
                        {{ \App\Models\LandingPageSetting::get('outline_employees_stat_label', __('messages.company_stats.workforce')) }}
                    </div>
                </div>

                <div class="musashi-card bg-slate-50/80 rounded-2xl p-3.5 xs:p-5 sm:p-6 text-center border-t-2 border-t-emerald-600 border border-slate-200">
                    <div class="text-xl xs:text-2xl sm:text-4xl font-black text-slate-900 font-mono mb-1">
                        {{ \App\Models\LandingPageSetting::get('outline_plant_area_stat', '115,000 m²', false) }}
                    </div>
                    <div class="text-[10px] xs:text-[11px] sm:text-xs font-semibold uppercase tracking-wider text-slate-600">
                        {{ \App\Models\LandingPageSetting::get('outline_plant_area_stat_label', __('messages.company_stats.plant_area')) }}
                    </div>
                </div>

                <div class="musashi-card bg-slate-50/80 rounded-2xl p-3.5 xs:p-5 sm:p-6 text-center border-t-2 border-t-blue-600 border border-slate-200">
                    <div class="text-xl xs:text-2xl sm:text-4xl font-black text-slate-900 font-mono mb-1">
                        {{ \App\Models\LandingPageSetting::get('outline_sales_stat', 'IDR 2.8T+', false) }}
                    </div>
                    <div class="text-[10px] xs:text-[11px] sm:text-xs font-semibold uppercase tracking-wider text-slate-600">
                        {{ \App\Models\LandingPageSetting::get('outline_sales_stat_label', __('messages.company_stats.sales_scale')) }}
                    </div>
                </div>
            </div>

            <!-- 7 Company Cards Grid corresponding to Navbar dropdown -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- 1. About Us -->
                <div id="company-about" class="musashi-card p-6 sm:p-7 bg-slate-50/70 border border-slate-200 rounded-2xl flex flex-col justify-between hover:border-musashi-red hover:shadow-lg transition-all scroll-mt-28">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ \App\Models\LandingPageSetting::get('company_card1_title', __('messages.nav.about_us')) }}</h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
                            {{ \App\Models\LandingPageSetting::get('company_card1_desc', 'Profil lengkap PT Musashi Auto Parts Indonesia, sejarah pendirian, pabrik Cikarang & Karawang, serta sinergi Monozukuri terpadu.') }}
                        </p>
                    </div>
                    <a href="{{ route('company.about') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1.5 transition-colors">
                        <span>{{ __('messages.common.read_more') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- 2. Corporate Message -->
                <div id="company-message" class="musashi-card p-6 sm:p-7 bg-slate-50/70 border border-slate-200 rounded-2xl flex flex-col justify-between hover:border-musashi-red hover:shadow-lg transition-all scroll-mt-28">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ \App\Models\LandingPageSetting::get('company_card2_title', __('messages.nav.corporate_message')) }}</h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
                            {{ \App\Models\LandingPageSetting::get('company_card2_desc', 'Pesan resmi Presiden Direktur mengenai komitmen mutu, keselamatan kerja tanpa kompromi, dan keberlanjutan mobilitas masa depan.') }}
                        </p>
                    </div>
                    <a href="{{ route('company.message') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1.5 transition-colors">
                        <span>{{ __('messages.common.read_more') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- 3. Philosophy -->
                <div id="company-philosophy" class="musashi-card p-6 sm:p-7 bg-slate-50/70 border border-slate-200 rounded-2xl flex flex-col justify-between hover:border-musashi-red hover:shadow-lg transition-all scroll-mt-28">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ \App\Models\LandingPageSetting::get('company_card3_title', __('messages.nav.philosophy')) }}</h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
                            {{ \App\Models\LandingPageSetting::get('company_card3_desc', 'Filosofi Musashi: Menembus batas dan melangkah ke petualangan baru! Harmoni antara manusia, kendaraan, dan bumi.') }}
                        </p>
                    </div>
                    <a href="{{ route('company.philosophy') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1.5 transition-colors">
                        <span>{{ __('messages.common.read_more') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- 4. Global Vision -->
                <div id="company-vision" class="musashi-card p-6 sm:p-7 bg-slate-50/70 border border-slate-200 rounded-2xl flex flex-col justify-between hover:border-musashi-red hover:shadow-lg transition-all scroll-mt-28">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ \App\Models\LandingPageSetting::get('company_card4_title', __('messages.nav.global_vision')) }}</h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
                            {{ \App\Models\LandingPageSetting::get('company_card4_desc', 'Visi 100 Tahun Musashi Group (2038): Inovasi teknologi ramah lingkungan, elektrifikasi e-Axle, dan kontribusi masyarakat global.') }}
                        </p>
                    </div>
                    <a href="{{ route('company.vision') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1.5 transition-colors">
                        <span>{{ __('messages.common.read_more') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- 5. Company Outline -->
                <div id="company-outline" class="musashi-card p-6 sm:p-7 bg-slate-50/70 border border-slate-200 rounded-2xl flex flex-col justify-between hover:border-musashi-red hover:shadow-lg transition-all scroll-mt-28">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ \App\Models\LandingPageSetting::get('company_card5_title', __('messages.nav.company_outline')) }}</h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4">
                            {{ \App\Models\LandingPageSetting::get('company_card5_desc', 'Legalitas, data modal, struktur kepemilikan saham, luas area Cikarang & Karawang, serta sertifikasi standar mutu otomotif internasional.') }}
                        </p>
                        
                        <!-- Quick Outline Highlights on Card -->
                        <div class="space-y-1.5 mb-6 text-[11px] font-mono text-slate-600 border-t border-slate-200/80 pt-3">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Karyawan:</span>
                                <span class="font-bold text-slate-800">{{ \App\Models\LandingPageSetting::get('outline_employees_stat', '1,637+ Dedicated Workforce') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Pabrik:</span>
                                <span class="font-bold text-slate-800">Cikarang & Karawang ({{ \App\Models\LandingPageSetting::get('outline_plant_area_stat', '115,000 m²') }})</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('company.outline') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1.5 transition-colors">
                        <span>{{ __('messages.common.read_more') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- 6. Board Of Director -->
                <div id="company-bod" class="musashi-card p-6 sm:p-7 bg-slate-50/70 border border-slate-200 rounded-2xl flex flex-col justify-between hover:border-musashi-red hover:shadow-lg transition-all scroll-mt-28">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ \App\Models\LandingPageSetting::get('company_card6_title', __('messages.nav.bod')) }}</h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4">
                            {{ \App\Models\LandingPageSetting::get('company_card6_desc', 'Jajaran Dewan Direksi yang memimpin operasional, inovasi teknologi, dan tata kelola perusahaan berkelanjutan.') }}
                        </p>
                        
                        <!-- Quick BOD count -->
                        <div class="space-y-1.5 mb-6 text-[11px] font-mono text-slate-600 border-t border-slate-200/80 pt-3">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Struktur:</span>
                                <span class="font-bold text-slate-800">{{ $directors->count() }} Eksekutif Direktur</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('home') }}#directors" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1.5 transition-colors">
                        <span>{{ \App\Models\LandingPageSetting::getForLocale('company_card6_btn_text', app()->getLocale(), app()->getLocale() === 'ja' ? '役員一覧を見る ↓' : (app()->getLocale() === 'id' ? 'Lihat Jajaran Direksi ↓' : 'View Directors ↓')) }}</span>
                    </a>
                </div>

                <!-- 7. Network -->
                <div id="company-network" class="musashi-card p-6 sm:p-7 bg-slate-50/70 border border-slate-200 rounded-2xl flex flex-col justify-between hover:border-musashi-red hover:shadow-lg transition-all lg:col-span-3 scroll-mt-28">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">{{ \App\Models\LandingPageSetting::get('company_card7_title', __('messages.nav.network')) }}</h3>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-3xl">
                                {{ \App\Models\LandingPageSetting::get('company_card7_desc', 'Dua pabrik utama di Cikarang (Head Office) dan Karawang Plant, terkoneksi dengan lebih dari 30 fasilitas global Musashi Group di seluruh dunia.') }}
                            </p>
                        </div>
                        <a href="{{ route('company.network') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1.5 transition-colors self-start sm:self-center flex-shrink-0">
                            <span>{{ __('messages.common.read_more') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 5B. DEDICATED BOARD OF DIRECTORS SHOWCASE (Executive Leadership) -->
    <section id="directors" class="py-20 sm:py-24 bg-slate-50 border-b border-slate-200 scroll-mt-24">
        <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase mb-3">
                    <span>{{ \App\Models\LandingPageSetting::get('bod_badge', __('messages.nav.bod')) }}</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ \App\Models\LandingPageSetting::get('bod_title', __('messages.bod_section.title')) }}
                </h2>
                <div class="w-16 h-1 bg-musashi-red mx-auto mt-4 mb-5 rounded-full"></div>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    {{ \App\Models\LandingPageSetting::get('bod_desc', __('messages.bod_section.desc')) }}
                </p>
            </div>

            <!-- Directors Grid (Dynamic from Database) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($directors as $director)
                    <div class="musashi-card bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-lg transition-all flex flex-col group">
                        <div class="relative h-80 overflow-hidden bg-slate-100">
                            <img src="{{ asset($director->photo) }}" alt="{{ $director->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
                            <div class="absolute bottom-4 left-5 right-5">
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider text-musashi-red bg-white/95 border border-slate-200 shadow-xs inline-block mb-1.5">
                                    {{ $director->title }}
                                </span>
                                <h3 class="text-xl font-black text-white drop-shadow-sm">
                                    {{ $director->name }}
                                </h3>
                            </div>
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-4">
                                {{ $director->bio }}
                            </p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                                <span>PT MAP-IN</span>
                                <span class="text-musashi-red font-bold">Directorate</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400 font-mono text-xs">
                        Belum ada data direktur yang ditambahkan.
                    </div>
                @endforelse
            </div>

            <!-- View Detailed Governance Link -->
            <div class="mt-12 text-center">
                <a href="{{ route('company.bod') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm hover:shadow transition-all">
                    <span>{{ __('messages.bod_section.view_full') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- 6. SUSTAINABILITY & ESG (Green Company Commitment) -->
    <section id="sustainability" class="py-20 sm:py-24 bg-[#F8F9FA] border-b border-slate-200 scroll-mt-24">
        <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-mono font-bold tracking-widest uppercase">
                    <span>{{ \App\Models\LandingPageSetting::get('sustainability_badge', __('messages.nav.sustainability')) }}</span>
                </div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ \App\Models\LandingPageSetting::get('sustainability_title', __('messages.sustainability_section.title')) }}
                </h2>
                <div class="w-16 h-1 bg-emerald-500 mx-auto rounded-full"></div>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                    {{ \App\Models\LandingPageSetting::get('sustainability_desc', __('messages.sustainability_section.desc')) }}
                </p>

                <!-- Environmental 3 Pillars Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-8 text-left">
                    <div class="musashi-card p-6 bg-white border border-slate-200">
                        <div class="text-emerald-600 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <h4 class="text-slate-900 font-bold text-base mb-1">{{ \App\Models\LandingPageSetting::get('sustainability_carbon_title', __('messages.sustainability_section.carbon_title')) }}</h4>
                        <p class="text-slate-600 text-xs leading-relaxed">{{ \App\Models\LandingPageSetting::get('sustainability_carbon_desc', __('messages.sustainability_section.carbon_desc')) }}</p>
                    </div>

                    <div class="musashi-card p-6 bg-white border border-slate-200">
                        <div class="text-emerald-600 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </div>
                        <h4 class="text-slate-900 font-bold text-base mb-1">{{ \App\Models\LandingPageSetting::get('sustainability_waste_title', __('messages.sustainability_section.waste_title')) }}</h4>
                        <p class="text-slate-600 text-xs leading-relaxed">{{ \App\Models\LandingPageSetting::get('sustainability_waste_desc', __('messages.sustainability_section.waste_desc')) }}</p>
                    </div>

                    <div class="musashi-card p-6 bg-white border border-slate-200">
                        <div class="text-emerald-600 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <h4 class="text-slate-900 font-bold text-base mb-1">{{ \App\Models\LandingPageSetting::get('sustainability_community_title', __('messages.sustainability_section.community_title')) }}</h4>
                        <p class="text-slate-600 text-xs leading-relaxed">{{ \App\Models\LandingPageSetting::get('sustainability_community_desc', __('messages.sustainability_section.community_desc')) }}</p>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="{{ \App\Models\LandingPageSetting::get('sustainability_btn_link', route('sustainability.index'), false) }}" class="inline-flex items-center gap-2 px-7 py-3 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-emerald-700 hover:bg-emerald-600 shadow-sm transition-all">
                        <span>{{ \App\Models\LandingPageSetting::get('sustainability_btn_text', __('messages.sustainability_section.btn_report')) }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>



@endsection
