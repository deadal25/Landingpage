@extends('layouts.app')

@section('title', $product->name . ' - PT Musashi Auto Parts Indonesia')
@section('meta_description', Str::limit($product->description, 160))

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('product.index') }}" class="hover:text-musashi-red transition-colors">Products</a>
                <span>/</span>
                <span class="text-black font-semibold">{{ $product->name }}</span>
            </nav>

            <div class="flex flex-wrap items-center gap-3 mb-3">
                <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                    {{ $product->category }}
                </span>
                <span class="px-2.5 py-1 rounded text-xs font-mono text-slate-600 bg-white border border-slate-200">
                    Precision Powertrain & Chassis
                </span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                {{ $product->name }}
            </h1>
        </div>
    </section>

    <!-- Product Detail Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                
                <!-- Left: Large Image & Multi-Image Gallery -->
                @php
                    $prodGallery = !empty($product->all_images) ? array_values($product->all_images) : ($product->image ? [$product->image] : []);
                @endphp
                <div class="space-y-4" x-data="{
                    activePIdx: 0,
                    pGallery: {{ json_encode(array_values(array_map(fn($img) => str_starts_with($img, 'http') ? $img : asset($img), $prodGallery))) }},
                    nextP() { this.activePIdx = (this.activePIdx + 1) % this.pGallery.length; },
                    prevP() { this.activePIdx = (this.activePIdx - 1 + this.pGallery.length) % this.pGallery.length; }
                }">
                    <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-md bg-slate-900 group">
                        <img :src="pGallery[activePIdx]" alt="{{ $product->name }}" class="w-full h-[420px] object-cover transition-all duration-300">
                        
                        <template x-if="pGallery.length > 1">
                            <div class="absolute inset-x-4 top-1/2 -translate-y-1/2 flex items-center justify-between pointer-events-none">
                                <button @click="prevP()" type="button" class="pointer-events-auto w-9 h-9 rounded-full bg-black/60 hover:bg-musashi-red text-white flex items-center justify-center transition-colors cursor-pointer">
                                    ‹
                                </button>
                                <button @click="nextP()" type="button" class="pointer-events-auto w-9 h-9 rounded-full bg-black/60 hover:bg-musashi-red text-white flex items-center justify-center transition-colors cursor-pointer">
                                    ›
                                </button>
                            </div>
                        </template>

                        <template x-if="pGallery.length > 1">
                            <span class="absolute bottom-3 right-3 px-2.5 py-1 rounded-full text-xs font-mono font-bold bg-black/75 text-white backdrop-blur-xs">
                                📸 <span x-text="(activePIdx + 1) + ' / ' + pGallery.length + ' Foto'"></span>
                            </span>
                        </template>
                    </div>

                    <!-- Thumbnails row if multiple images -->
                    <template x-if="pGallery.length > 1">
                        <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-xl flex items-center gap-2 overflow-x-auto scrollbar-none">
                            <template x-for="(pic, pidx) in pGallery" :key="pidx">
                                <button 
                                    @click="activePIdx = pidx" 
                                    type="button" 
                                    :class="activePIdx === pidx ? 'ring-2 ring-musashi-red scale-105' : 'opacity-65 hover:opacity-100'"
                                    class="relative w-16 h-12 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0 transition-all cursor-pointer">
                                    <img :src="pic" class="w-full h-full object-cover">
                                    <span class="absolute bottom-0 right-0 bg-black/70 text-white text-[8px] font-mono px-1 rounded-tl" x-text="pidx + 1"></span>
                                </button>
                            </template>
                        </div>
                    </template>

                    <!-- Quality Standards Cards -->
                    <div class="grid grid-cols-3 gap-3">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-center">
                            <span class="text-[11px] font-mono text-slate-500 uppercase block font-semibold">Standard</span>
                            <strong class="text-sm text-black font-bold mt-1 block">IATF 16949</strong>
                        </div>
                        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-center">
                            <span class="text-[11px] font-mono text-emerald-700 uppercase block font-semibold">Quality</span>
                            <strong class="text-sm text-emerald-800 font-bold mt-1 block">Zero Defect</strong>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-center">
                            <span class="text-[11px] font-mono text-slate-500 uppercase block font-semibold">Specification</span>
                            <strong class="text-sm text-musashi-red font-bold mt-1 block">JIS / ISO</strong>
                        </div>
                    </div>
                </div>

                <!-- Right: Description, Features, Specs & Inquiry CTA -->
                <div class="space-y-8">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-3 h-0.5 bg-musashi-red"></div>
                            <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Engineering Overview</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-black tracking-tight mb-4">
                            High-Precision Manufacturing
                        </h2>
                        <p class="text-slate-600 text-base leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Key Technical Features -->
                    @if(!empty($product->features) && is_array($product->features))
                        <div class="space-y-3 bg-slate-50 border border-slate-200 rounded-2xl p-6">
                            <h3 class="text-xs font-mono font-bold text-black uppercase tracking-wider">
                                Key Technical Features
                            </h3>
                            <ul class="space-y-2.5">
                                @foreach($product->features as $feature)
                                    <li class="flex items-start gap-3 text-sm text-slate-700">
                                        <span class="w-2 h-2 rounded-full bg-musashi-red mt-1.5 flex-shrink-0"></span>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Specifications Block -->
                    @if($product->specifications)
                        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-2">
                            <span class="text-xs font-mono text-musashi-red font-bold uppercase tracking-wider block">Specifications & Metallurgy</span>
                            <p class="text-xs sm:text-sm text-slate-700 font-mono leading-relaxed">
                                {{ $product->specifications }}
                            </p>
                        </div>
                    @endif

                    <!-- Inquiry CTA Box -->
                    <div class="p-6 rounded-2xl bg-slate-900 text-white border border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-md">
                        <div>
                            <span class="text-xs font-mono text-amber-400 font-semibold block mb-1">Commercial & OEM Inquiry</span>
                            <h4 class="text-white font-bold text-base sm:text-lg">Inquire About This Product</h4>
                            <p class="text-slate-300 text-xs mt-1">Connect with our sales and engineering team in Cikarang & Karawang for customized specifications.</p>
                        </div>
                        <a href="mailto:karawang.office@musashi.co.id?subject=Inquiry%20{{ urlencode($product->name) }}" class="px-6 py-3 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md transition-all whitespace-nowrap flex-shrink-0">
                            Request Quotation &rarr;
                        </a>
                    </div>
                </div>

            </div>

            <!-- Related Products Section -->
            @if($relatedProducts->isNotEmpty())
                <div class="pt-16 border-t border-slate-200 space-y-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-3 h-0.5 bg-musashi-red"></div>
                                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Related Lineup</span>
                            </div>
                            <h3 class="text-2xl font-bold text-black">
                                Related {{ $product->category }} Parts
                            </h3>
                        </div>
                        <a href="{{ route('product.index') }}" class="text-xs font-bold text-musashi-red hover:underline font-mono">
                            View All Products &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('product.show', $related->slug) }}" class="group bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md hover:border-slate-300 transition-all flex flex-col">
                                <div class="relative h-48 overflow-hidden bg-slate-100">
                                    <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <span class="absolute top-3 left-3 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-white/90 text-black backdrop-blur-sm border border-slate-200">
                                        {{ $related->category }}
                                    </span>
                                </div>
                                <div class="p-6 flex-grow flex flex-col justify-between">
                                    <h4 class="text-base font-bold text-black group-hover:text-musashi-red transition-colors mb-2">
                                        {{ $related->name }}
                                    </h4>
                                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                        <span class="text-xs text-slate-500 line-clamp-1">{{ Str::limit($related->description, 50) }}</span>
                                        <span class="text-xs font-bold text-musashi-red group-hover:translate-x-1 transition-transform inline-flex items-center">
                                            &rarr;
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
