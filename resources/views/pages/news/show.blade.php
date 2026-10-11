@extends('layouts.app')

@section('title', $news->title . ' - News | PT. Musashi Auto Parts Indonesia')
@section('meta_description', Str::limit($news->excerpt, 160))

@section('content')
    <!-- Page Header Banner (Clean Japanese Corporate White Style) -->
    <div class="relative pt-36 pb-14 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('news.index') }}" class="hover:text-musashi-red transition-colors">{{ __('messages.nav.news') }}</a>
                <span>/</span>
                <span class="text-slate-900 font-medium">{{ $news->category }}</span>
            </div>

            <div class="flex items-center gap-3 mb-4">
                <span class="px-3 py-0.5 rounded text-xs font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-100 font-mono">
                    {{ $news->category }}
                </span>
                <span class="text-xs font-mono text-slate-500">
                    {{ $news->published_at ? $news->published_at->format('Y.m.d') : $news->created_at->format('Y.m.d') }}
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                {{ $news->title }}
            </h1>
        </div>
    </div>

    <!-- Article Content Section -->
    <article class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- Hero Image & Multi-Image Gallery -->
            @php
                $newsImages = !empty($news->all_images) ? array_values($news->all_images) : ($news->image ? [$news->image] : []);
            @endphp

            @if(!empty($newsImages))
                <div class="space-y-4" x-data="{
                    activeIdx: 0,
                    gallery: {{ json_encode(array_values(array_map(fn($img) => str_starts_with($img, 'http') ? $img : asset($img), $newsImages))) }},
                    next() { this.activeIdx = (this.activeIdx + 1) % this.gallery.length; },
                    prev() { this.activeIdx = (this.activeIdx - 1 + this.gallery.length) % this.gallery.length; }
                }">
                    <!-- Main Hero Image Frame -->
                    <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-lg bg-slate-950 group">
                        <img :src="gallery[activeIdx]" alt="{{ $news->title }}" class="w-full h-[420px] sm:h-[480px] object-cover transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60 pointer-events-none"></div>

                        <!-- Chevrons if multiple images -->
                        <template x-if="gallery.length > 1">
                            <div class="absolute inset-x-4 top-1/2 -translate-y-1/2 flex items-center justify-between pointer-events-none">
                                <button 
                                    @click="prev()" 
                                    type="button" 
                                    aria-label="Previous image"
                                    class="pointer-events-auto w-11 h-11 rounded-full bg-black/60 hover:bg-musashi-red text-white flex items-center justify-center shadow-lg transition-colors cursor-pointer opacity-80 group-hover:opacity-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button 
                                    @click="next()" 
                                    type="button" 
                                    aria-label="Next image"
                                    class="pointer-events-auto w-11 h-11 rounded-full bg-black/60 hover:bg-musashi-red text-white flex items-center justify-center shadow-lg transition-colors cursor-pointer opacity-80 group-hover:opacity-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        </template>

                        <!-- Counter badge -->
                        <template x-if="gallery.length > 1">
                            <div class="absolute bottom-4 right-4 z-10">
                                <span class="px-3 py-1 rounded-full text-xs font-mono font-bold bg-black/75 text-white backdrop-blur-md border border-white/20">
                                    📸 Foto <span x-text="(activeIdx + 1) + ' / ' + gallery.length"></span>
                                </span>
                            </div>
                        </template>
                    </div>

                    <!-- Thumbnails row if multiple images -->
                    <template x-if="gallery.length > 1">
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl flex items-center gap-2.5 overflow-x-auto scrollbar-none">
                            <span class="text-xs font-mono font-bold text-slate-500 uppercase whitespace-nowrap mr-1">Galeri Foto (<span x-text="gallery.length"></span>):</span>
                            <template x-for="(pic, gidx) in gallery" :key="gidx">
                                <button 
                                    @click="activeIdx = gidx" 
                                    type="button"
                                    :class="activeIdx === gidx ? 'ring-2 ring-musashi-red scale-105' : 'opacity-65 hover:opacity-100'"
                                    class="relative w-16 sm:w-20 h-12 sm:h-14 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0 transition-all cursor-pointer">
                                    <img :src="pic" class="w-full h-full object-cover">
                                    <span class="absolute bottom-0 right-0 bg-black/75 text-white text-[9px] font-mono px-1 rounded-tl" x-text="gidx + 1"></span>
                                </button>
                            </template>
                        </div>
                    </template>
                </div>
            @endif

            <!-- Excerpt Callout -->
            @if($news->excerpt)
                <div class="p-6 rounded-xl bg-slate-50 border-l-4 border-l-musashi-red text-slate-700 text-base leading-relaxed font-medium">
                    {{ $news->excerpt }}
                </div>
            @endif

            <!-- Body Content -->
            <div class="text-slate-700 text-base sm:text-lg leading-relaxed space-y-6">
                {!! nl2br(e($news->content)) !!}
            </div>

            <!-- Share & Back navigation -->
            <div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-6"
                 x-data="{ copied: false }">
                
                <!-- Back to All News Button -->
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-700 hover:text-musashi-red transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-slate-100 group-hover:bg-red-50 group-hover:text-musashi-red flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    </div>
                    <span>{{ app()->getLocale() === 'ja' ? 'すべてのニュースを見る' : (app()->getLocale() === 'en' ? 'View All News' : 'Lihat Semua Berita') }}</span>
                </a>

                <!-- Share Buttons Group (WhatsApp, Salin Link, FB, X, LinkedIn) -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mr-1 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        <span>{{ app()->getLocale() === 'ja' ? '共有:' : (app()->getLocale() === 'en' ? 'Share:' : 'Bagikan:') }}</span>
                    </span>

                    <!-- 1. WhatsApp Button -->
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($news->title . "\n" . url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="Bagikan ke WhatsApp"
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5 cursor-pointer">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.79 14.07c-.24.68-1.4 1.25-1.92 1.33-.51.08-1.18.11-3.41-.81-2.85-1.18-4.68-4.08-4.82-4.27-.14-.19-1.16-1.54-1.16-2.94 0-1.4 7.3-2.09 1-.2.27-.29.6-.39.81-.39.21 0 .42 0 .61.01.2.01.46-.07.72.55.27.64.91 2.22.99 2.38.08.16.14.35.03.56-.11.21-.17.34-.33.53-.16.19-.34.42-.49.56-.16.16-.33.34-.14.66.19.32.84 1.38 1.8 2.24 1.24 1.11 2.28 1.45 2.6 1.61.32.16.51.13.7-.08.19-.21.82-.96 1.04-1.29.21-.32.43-.27.72-.16.29.11 1.85.87 2.17 1.03.32.16.53.24.61.37.08.14.08.79-.16 1.47z"/>
                        </svg>
                        <span>WhatsApp</span>
                    </a>

                    <!-- 2. Copy Link Button with Alpine interactive tooltip/state -->
                    <button 
                        @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2500)"
                        type="button"
                        title="{{ app()->getLocale() === 'ja' ? 'リンクをコピー' : (app()->getLocale() === 'en' ? 'Copy Link' : 'Salin Link Berita') }}"
                        :class="copied ? 'bg-emerald-50 text-emerald-700 border-emerald-300 ring-1 ring-emerald-200' : 'bg-slate-100 hover:bg-slate-200 text-slate-800 border-slate-200'"
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border text-xs font-bold transition-all shadow-2xs hover:-translate-y-0.5 cursor-pointer">
                        <template x-if="!copied">
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </template>
                        <template x-if="copied">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </template>
                        <span x-text="copied ? '{{ app()->getLocale() === 'ja' ? '✓ コピー完了' : (app()->getLocale() === 'en' ? '✓ Link Copied' : '✓ Link Tersalin!') }}' : '{{ app()->getLocale() === 'ja' ? 'リンクをコピー' : (app()->getLocale() === 'en' ? 'Copy Link' : 'Salin Link') }}'"></span>
                    </button>

                    <!-- 3. Facebook Share -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="Bagikan ke Facebook"
                       class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-slate-100 hover:bg-blue-600 hover:text-white text-slate-600 transition-all border border-slate-200 shadow-2xs cursor-pointer">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>

                    <!-- 4. X (Twitter) Share -->
                    <a href="https://twitter.com/intent/tweet?text={{ rawurlencode($news->title) }}&url={{ urlencode(url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="Bagikan ke X"
                       class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-slate-100 hover:bg-black hover:text-white text-slate-600 transition-all border border-slate-200 shadow-2xs cursor-pointer">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>

                    <!-- 5. LinkedIn Share -->
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="Bagikan ke LinkedIn"
                       class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-slate-100 hover:bg-blue-700 hover:text-white text-slate-600 transition-all border border-slate-200 shadow-2xs cursor-pointer">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76a1.64 1.64 0 1 0 0-3.28 1.64 1.64 0 0 0 0 3.28m1.39 9.74v-8.37H5.07v8.37h2.78z"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </article>
@endsection
