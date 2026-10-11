@extends('layouts.app')

@section('title', __('messages.nav.news') . ' - ' . __('messages.company_name'))
@section('meta_description', 'Latest company announcements, partnerships, EV developments, and sustainability initiatives from PT Musashi Auto Parts Indonesia.')

@section('content')
    <!-- Page Header Banner (Clean Japanese Corporate White/Light Style) -->
    <div class="relative pt-36 pb-16 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-900 font-semibold">{{ __('messages.nav.news') }}</span>
            </div>
            <div class="flex items-center gap-2 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase mb-1">
                <span>NEWS RELEASE & TOPICS</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ __('messages.nav.news') }}</h1>
            <p class="text-slate-600 text-sm sm:text-base mt-2 max-w-2xl">
                Dapatkan informasi resmi mengenai tonggak korporasi, pencapaian inovasi mobilitas listrik, dan kemitraan strategis PT Musashi Auto Parts Indonesia.
            </p>
        </div>
    </div>

    <!-- News Listing Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <!-- Featured News Banner (if present and not searching) -->
            @if($featuredNews && !request('search') && !request('category'))
                <div class="musashi-card rounded-2xl overflow-hidden border border-slate-200 group bg-white shadow-xs">
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <div class="relative h-64 lg:h-auto overflow-hidden bg-slate-100">
                            <img src="{{ asset($featuredNews->image) }}" alt="{{ $featuredNews->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <span class="absolute top-4 left-4 px-3 py-1 rounded text-xs font-bold uppercase tracking-wider text-white bg-musashi-red shadow-xs">
                                Featured Story
                            </span>
                        </div>
                        <div class="p-8 sm:p-10 flex flex-col justify-between space-y-5">
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-xs font-mono text-slate-500">
                                    <span class="text-musashi-red font-bold uppercase">{{ $featuredNews->category }}</span>
                                    <span>•</span>
                                    <span>{{ $featuredNews->published_at ? $featuredNews->published_at->format('Y.m.d') : $featuredNews->created_at->format('Y.m.d') }}</span>
                                </div>
                                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-snug group-hover:text-musashi-red transition-colors">
                                    <a href="{{ route('news.show', $featuredNews->slug) }}">{{ $featuredNews->title }}</a>
                                </h2>
                                <p class="text-slate-600 text-sm leading-relaxed line-clamp-3">
                                    {{ $featuredNews->excerpt }}
                                </p>
                            </div>

                            <div>
                                <a href="{{ route('news.show', $featuredNews->slug) }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">
                                    <span>{{ __('messages.news_section.read_story') }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Filter & Search Toolbar -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <a href="{{ route('news.index') }}" 
                       class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all {{ !request('category') ? 'bg-musashi-red text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        All News
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('news.index', ['category' => $cat]) }}" 
                           class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all {{ request('category') === $cat ? 'bg-musashi-red text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                <form method="GET" action="{{ route('news.index') }}" class="w-full md:w-72 relative">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search news..." 
                        class="w-full bg-slate-50 border border-slate-300 rounded-full py-2 pl-9 pr-4 text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:border-musashi-red focus:bg-white transition-colors">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>
            </div>

            <!-- News Grid (Crisp Japanese cards) -->
            @if($newsList->isEmpty())
                <div class="text-center py-20 text-slate-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <h3 class="text-base font-bold text-slate-900">Tidak ada artikel ditemukan</h3>
                    <p class="text-xs mt-1 text-slate-500">Silakan gunakan kata kunci pencarian lain atau pilih kategori yang berbeda.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($newsList as $item)
                        @php
                            $nImages = !empty($item->all_images) ? array_values($item->all_images) : ($item->image ? [$item->image] : []);
                            $renderedNewsImgs = array_values(array_map(fn($img) => str_starts_with($img, 'http') ? $img : asset($img), $nImages));
                        @endphp
                        <article class="musashi-card overflow-hidden flex flex-col group bg-white border border-slate-200"
                            x-data="{
                                nImgs: {{ json_encode($renderedNewsImgs) }},
                                nIdx: 0,
                                nTimer: null,
                                isHovered: false,
                                init() {
                                    if (this.nImgs.length > 1) {
                                        this.startAutoSlide();
                                    }
                                },
                                startAutoSlide() {
                                    this.nTimer = setInterval(() => {
                                        if (!this.isHovered) {
                                            this.nIdx = (this.nIdx + 1) % this.nImgs.length;
                                        }
                                    }, 3500 + (({{ $item->id }} % 3) * 500));
                                },
                                nextN(e) { e.preventDefault(); e.stopPropagation(); this.nIdx = (this.nIdx + 1) % this.nImgs.length; },
                                prevN(e) { e.preventDefault(); e.stopPropagation(); this.nIdx = (this.nIdx - 1 + this.nImgs.length) % this.nImgs.length; }
                            }"
                            @mouseenter="isHovered = true"
                            @mouseleave="isHovered = false">
                            <div class="relative h-48 overflow-hidden bg-slate-900">
                                <div 
                                    class="flex h-full w-full transition-transform duration-700 ease-in-out"
                                    :style="'transform: translateX(-' + (nIdx * 100) + '%);'">
                                    @foreach($renderedNewsImgs as $nImgIdx => $nImgUrl)
                                        <div class="w-full h-full flex-shrink-0 relative overflow-hidden">
                                            <img src="{{ $nImgUrl }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        </div>
                                    @endforeach
                                </div>
                                <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase text-slate-800 bg-white/90 border border-slate-200 z-10 pointer-events-none">
                                    {{ $item->category }}
                                </span>

                                <template x-if="nImgs.length > 1">
                                    <div class="absolute top-3 right-3 z-10 pointer-events-none">
                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-black/75 text-white" x-text="(nIdx + 1) + '/' + nImgs.length + ' Foto'"></span>
                                    </div>
                                </template>

                                <template x-if="nImgs.length > 1">
                                    <div class="absolute inset-x-2 top-1/2 -translate-y-1/2 flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                        <button @click="prevN($event)" type="button" class="w-6 h-6 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center text-xs">‹</button>
                                        <button @click="nextN($event)" type="button" class="w-6 h-6 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center text-xs">›</button>
                                    </div>
                                </template>
                            </div>

                            <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                                <div>
                                    <span class="text-xs font-mono text-slate-400 mb-2 block">
                                        {{ $item->published_at ? $item->published_at->format('Y.m.d') : $item->created_at->format('Y.m.d') }}
                                    </span>
                                    <h3 class="text-base font-bold text-slate-900 group-hover:text-musashi-red transition-colors line-clamp-2 mb-2 leading-snug">
                                        <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                                    </h3>
                                    <p class="text-slate-500 text-xs sm:text-sm line-clamp-3 leading-relaxed">
                                        {{ $item->excerpt }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-slate-100">
                                    <a href="{{ route('news.show', $item->slug) }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1 transition-colors">
                                        <span>{{ __('messages.news_section.read_story') }}</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-8">
                    {{ $newsList->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
