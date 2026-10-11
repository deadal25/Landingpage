@extends('layouts.app')

@section('title', __('messages.nav.product') . ' - ' . __('messages.company_name'))
@section('meta_description', 'Explore our comprehensive range of high precision 2-wheelers gears, 4-wheelers transmission components, and next-generation e-Axle electric vehicle systems.')

@section('content')
    <!-- Page Header Banner (Clean Japanese Corporate White/Light Style) -->
    <div class="relative pt-36 pb-16 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-900 font-semibold">{{ __('messages.nav.product') }}</span>
            </div>
            <div class="flex items-center gap-2 text-musashi-red text-xs font-mono font-bold tracking-widest uppercase mb-1">
                <span>PRODUCTS & TECHNOLOGY</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ __('messages.nav.product') }}</h1>
            <p class="text-slate-600 text-sm sm:text-base mt-2 max-w-2xl">
                Suku cadang presisi tinggi untuk kendaraan roda dua, roda empat, dan mobilitas listrik e-Axle yang diproduksi dengan teknologi tempa presisi dan permesinan terpadu.
            </p>
        </div>
    </div>

    <!-- Product Listing Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <!-- Filter & Search Toolbar -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <!-- Category Pills -->
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <a href="{{ route('product.index') }}" 
                       class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all {{ !request('category') ? 'bg-musashi-red text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        All Products
                    </a>
                    @foreach($categories as $catKey => $catLabel)
                        <a href="{{ route('product.index', ['category' => $catKey]) }}" 
                           class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all {{ request('category') === $catKey ? 'bg-musashi-red text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $catKey }}
                        </a>
                    @endforeach
                </div>

                <!-- Search Form -->
                <form method="GET" action="{{ route('product.index') }}" class="w-full md:w-72 relative">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search products..." 
                        class="w-full bg-slate-50 border border-slate-300 rounded-full py-2 pl-9 pr-4 text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:border-musashi-red focus:bg-white transition-colors">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>
            </div>

            <!-- Products Grid (Clean White Cards) -->
            @if($products->isEmpty())
                <div class="text-center py-20 text-slate-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <h3 class="text-base font-bold text-slate-900">Tidak ada produk ditemukan</h3>
                    <p class="text-xs mt-1 text-slate-500">Silakan gunakan kata kunci pencarian lain atau pilih kategori lain.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        @php
                            $prodImgs = !empty($product->all_images) ? array_values($product->all_images) : ($product->image ? [$product->image] : []);
                        @endphp
                        <div class="musashi-card overflow-hidden flex flex-col group bg-white border border-slate-200"
                            x-data="{
                                pImgs: {{ json_encode(array_values(array_map(fn($img) => str_starts_with($img, 'http') ? $img : asset($img), $prodImgs))) }},
                                pIdx: 0,
                                pTimer: null,
                                isHovered: false,
                                init() {
                                    if (this.pImgs.length > 1) {
                                        this.startAutoSlide();
                                    }
                                },
                                startAutoSlide() {
                                    this.pTimer = setInterval(() => {
                                        if (!this.isHovered) {
                                            this.pIdx = (this.pIdx + 1) % this.pImgs.length;
                                        }
                                    }, 3500 + (({{ $product->id }} % 3) * 500));
                                },
                                nextP(e) { e.preventDefault(); e.stopPropagation(); this.pIdx = (this.pIdx + 1) % this.pImgs.length; },
                                prevP(e) { e.preventDefault(); e.stopPropagation(); this.pIdx = (this.pIdx - 1 + this.pImgs.length) % this.pImgs.length; }
                            }"
                            @mouseenter="isHovered = true"
                            @mouseleave="isHovered = false">
                            <div class="relative h-52 overflow-hidden bg-slate-100">
                                <div 
                                    class="flex h-full w-full transition-transform duration-700 ease-in-out"
                                    :style="'transform: translateX(-' + (pIdx * 100) + '%);'">
                                    @php
                                        $renderedProdImgs = array_values(array_map(fn($img) => str_starts_with($img, 'http') ? $img : asset($img), $prodImgs));
                                    @endphp
                                    @foreach($renderedProdImgs as $prIdx => $prImg)
                                        <div class="w-full h-full flex-shrink-0 relative overflow-hidden">
                                            <img src="{{ $prImg }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        </div>
                                    @endforeach
                                </div>
                                <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase text-slate-800 bg-white/90 border border-slate-200 z-10 pointer-events-none">
                                    {{ $product->category }}
                                </span>

                                <template x-if="pImgs.length > 1">
                                    <div class="absolute top-3 right-3 z-10 pointer-events-none">
                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-black/75 text-white" x-text="(pIdx + 1) + '/' + pImgs.length + ' Foto'"></span>
                                    </div>
                                </template>

                                <template x-if="pImgs.length > 1">
                                    <div class="absolute inset-x-2 top-1/2 -translate-y-1/2 flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                        <button @click="prevP($event)" type="button" class="w-6 h-6 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center text-xs">‹</button>
                                        <button @click="nextP($event)" type="button" class="w-6 h-6 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center text-xs">›</button>
                                    </div>
                                </template>
                            </div>

                            <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                                <div>
                                    <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-musashi-red transition-colors mb-2">
                                        <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <p class="text-slate-500 text-xs sm:text-sm line-clamp-2 leading-relaxed">
                                        {{ $product->description }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-xs font-mono text-slate-400">IATF 16949 Certified</span>
                                    <a href="{{ route('product.show', $product->slug) }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-musashi-red hover:text-black gap-1 transition-colors">
                                        <span>Details</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-8">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
