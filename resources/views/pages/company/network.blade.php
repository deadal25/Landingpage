@extends('layouts.app')

@section('title', \App\Models\LandingPageSetting::get('network_hero_title', 'Global & Domestic Network') . ' - PT Musashi Auto Parts Indonesia')
@section('meta_description', \App\Models\LandingPageSetting::get('network_hero_desc', 'Explore Musashi global presence across Indonesia, Japan, Europe, Asia, and the Americas spanning 35 production plants in 14 countries.'))

@section('content')
    @php
        $allFacilities = \App\Models\LandingPageSetting::getNetworkFacilities();
        $indoFacilities = array_values(array_filter($allFacilities, fn($f) => ($f['region'] ?? '') === 'indonesia'));
        $japanFacilities = array_values(array_filter($allFacilities, fn($f) => ($f['region'] ?? '') === 'japan'));
        $europeFacilities = array_values(array_filter($allFacilities, fn($f) => ($f['region'] ?? '') === 'europe'));
        $asiaFacilities = array_values(array_filter($allFacilities, fn($f) => ($f['region'] ?? '') === 'asia'));
    @endphp

    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Company</span>
                <span>/</span>
                <span class="text-black font-semibold">Network</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">{{ \App\Models\LandingPageSetting::get('network_hero_badge', 'Global Operations') }}</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                {{ \App\Models\LandingPageSetting::get('network_hero_title', 'Global & Domestic Network') }}
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                {{ \App\Models\LandingPageSetting::get('network_hero_desc', 'A connected ecosystem of 35 production plants in 14 countries delivering uniform precision and localized supply assurance.') }}
            </p>
        </div>
    </section>

    <!-- Network Main Section with Alpine.js Tabs -->
    <section class="py-16 sm:py-20 bg-white" x-data="{ activeRegion: 'indonesia' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <!-- Region Filter Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-2 bg-slate-100 p-1.5 rounded-full max-w-2xl mx-auto border border-slate-200">
                <button 
                    @click="activeRegion = 'indonesia'"
                    :class="activeRegion === 'indonesia' ? 'bg-white text-musashi-red shadow-xs font-bold' : 'text-slate-600 hover:text-black'"
                    class="px-5 py-2 rounded-full text-xs font-sans tracking-wide transition-all cursor-pointer">
                    Indonesia ({{ count($indoFacilities) }})
                </button>
                <button 
                    @click="activeRegion = 'japan'"
                    :class="activeRegion === 'japan' ? 'bg-white text-musashi-red shadow-xs font-bold' : 'text-slate-600 hover:text-black'"
                    class="px-5 py-2 rounded-full text-xs font-sans tracking-wide transition-all cursor-pointer">
                    Japan (HQ) ({{ count($japanFacilities) }})
                </button>
                <button 
                    @click="activeRegion = 'europe'"
                    :class="activeRegion === 'europe' ? 'bg-white text-musashi-red shadow-xs font-bold' : 'text-slate-600 hover:text-black'"
                    class="px-5 py-2 rounded-full text-xs font-sans tracking-wide transition-all cursor-pointer">
                    Europe ({{ count($europeFacilities) }})
                </button>
                <button 
                    @click="activeRegion = 'asia'"
                    :class="activeRegion === 'asia' ? 'bg-white text-musashi-red shadow-xs font-bold' : 'text-slate-600 hover:text-black'"
                    class="px-5 py-2 rounded-full text-xs font-sans tracking-wide transition-all cursor-pointer">
                    Asia & Americas ({{ count($asiaFacilities) }})
                </button>
            </div>

            <!-- Tab 1: Indonesia Network -->
            <div x-show="activeRegion === 'indonesia'" x-transition class="space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">{{ \App\Models\LandingPageSetting::get('network_indo_badge', 'Domestic Production Network') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-black mt-1">{{ \App\Models\LandingPageSetting::get('network_indo_title', 'Indonesia Operating Plants') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($indoFacilities as $item)
                        <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4 hover:border-musashi-red/40 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">{{ $item['badge'] ?? 'Plant' }}</span>
                                @if(!empty($item['est']))
                                    <span class="text-xs font-mono text-slate-500">{{ $item['est'] }}</span>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-black">{{ $item['name'] }}</h3>
                            @if(!empty($item['address']))
                                <p class="text-slate-600 text-sm leading-relaxed">{{ $item['address'] }}</p>
                            @endif
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs font-mono text-slate-700">
                                @if(!empty($item['phone']))
                                    <div><strong>Phone:</strong> {{ $item['phone'] }}</div>
                                @endif
                                @if(!empty($item['scope']))
                                    <div><strong>Production Scope:</strong> {{ $item['scope'] }}</div>
                                @endif
                                @if(!empty($item['stats']))
                                    <div>{{ $item['stats'] }}</div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-12 text-slate-400 text-xs font-mono">
                            Belum ada data fasilitas untuk wilayah Indonesia. Anda dapat menambahkannya melalui Superadmin &gt; Profil &amp; Tentang Kami &gt; 7. Jaringan Global.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Tab 2: Japan Network -->
            <div x-show="activeRegion === 'japan'" x-transition style="display: none;" class="space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">{{ \App\Models\LandingPageSetting::get('network_japan_badge', 'Global Headquarters & Japanese Facilities') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-black mt-1">{{ \App\Models\LandingPageSetting::get('network_japan_title', 'Japan Network') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($japanFacilities as $item)
                        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2 hover:border-musashi-red/40 hover:shadow-md transition-all">
                            <span class="text-xs font-mono text-musashi-red font-bold uppercase">{{ $item['badge'] ?? 'Japan' }}</span>
                            <h4 class="text-base font-bold text-black">{{ $item['name'] }}</h4>
                            @if(!empty($item['address']))
                                <p class="text-slate-600 text-xs">{{ $item['address'] }}</p>
                            @endif
                            @if(!empty($item['phone']))
                                <p class="text-slate-500 text-xs font-mono">TEL: {{ $item['phone'] }}</p>
                            @endif
                            @if(!empty($item['scope']))
                                <p class="text-slate-500 text-[11px] font-mono">{{ $item['scope'] }}</p>
                            @endif
                            @if(!empty($item['stats']))
                                <p class="text-slate-400 text-[10px] font-mono">{{ $item['stats'] }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-slate-400 text-xs font-mono">
                            Belum ada data fasilitas untuk wilayah Jepang.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Tab 3: Europe Network -->
            <div x-show="activeRegion === 'europe'" x-transition style="display: none;" class="space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">{{ \App\Models\LandingPageSetting::get('network_europe_badge', 'European Manufacturing') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-black mt-1">{{ \App\Models\LandingPageSetting::get('network_europe_title', 'Europe Network') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($europeFacilities as $item)
                        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2 hover:border-musashi-red/40 hover:shadow-md transition-all">
                            <span class="text-xs font-mono text-musashi-red font-bold uppercase">{{ $item['badge'] ?? 'Europe' }}</span>
                            <h4 class="text-base font-bold text-black">{{ $item['name'] }}</h4>
                            @if(!empty($item['address']))
                                <p class="text-slate-600 text-xs">{{ $item['address'] }}</p>
                            @endif
                            @if(!empty($item['phone']))
                                <p class="text-slate-500 text-xs font-mono">TEL: {{ $item['phone'] }}</p>
                            @endif
                            @if(!empty($item['scope']))
                                <p class="text-slate-500 text-[11px] font-mono">{{ $item['scope'] }}</p>
                            @endif
                            @if(!empty($item['stats']))
                                <p class="text-slate-400 text-[10px] font-mono">{{ $item['stats'] }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-slate-400 text-xs font-mono">
                            Belum ada data fasilitas untuk wilayah Eropa.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Tab 4: Asia & Americas -->
            <div x-show="activeRegion === 'asia'" x-transition style="display: none;" class="space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">{{ \App\Models\LandingPageSetting::get('network_asia_badge', 'Global Reach') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-black mt-1">{{ \App\Models\LandingPageSetting::get('network_asia_title', 'Asia & The Americas') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($asiaFacilities as $item)
                        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2 hover:border-musashi-red/40 hover:shadow-md transition-all">
                            <span class="text-xs font-mono text-musashi-red font-bold uppercase">{{ $item['badge'] ?? 'Asia / Americas' }}</span>
                            <h4 class="text-base font-bold text-black">{{ $item['name'] }}</h4>
                            @if(!empty($item['address']))
                                <p class="text-slate-600 text-xs">{{ $item['address'] }}</p>
                            @endif
                            @if(!empty($item['phone']))
                                <p class="text-slate-500 text-xs font-mono">TEL: {{ $item['phone'] }}</p>
                            @endif
                            @if(!empty($item['scope']))
                                <p class="text-slate-500 text-[11px] font-mono">{{ $item['scope'] }}</p>
                            @endif
                            @if(!empty($item['stats']))
                                <p class="text-slate-400 text-[10px] font-mono">{{ $item['stats'] }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-slate-400 text-xs font-mono">
                            Belum ada data fasilitas untuk wilayah Asia &amp; Amerika.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </section>
@endsection
