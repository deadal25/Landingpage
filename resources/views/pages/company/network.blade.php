@extends('layouts.app')

@section('title', 'Global & Domestic Network - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Explore Musashi global presence across Indonesia, Japan, Europe, Asia, and the Americas spanning 35 production plants in 14 countries.')

@section('content')
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
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Global Operations</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                Global & Domestic Network
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                A connected ecosystem of 35 production plants in 14 countries delivering uniform precision and localized supply assurance.
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
                    class="px-5 py-2 rounded-full text-xs font-sans tracking-wide transition-all">
                    Indonesia
                </button>
                <button 
                    @click="activeRegion = 'japan'"
                    :class="activeRegion === 'japan' ? 'bg-white text-musashi-red shadow-xs font-bold' : 'text-slate-600 hover:text-black'"
                    class="px-5 py-2 rounded-full text-xs font-sans tracking-wide transition-all">
                    Japan (HQ)
                </button>
                <button 
                    @click="activeRegion = 'europe'"
                    :class="activeRegion === 'europe' ? 'bg-white text-musashi-red shadow-xs font-bold' : 'text-slate-600 hover:text-black'"
                    class="px-5 py-2 rounded-full text-xs font-sans tracking-wide transition-all">
                    Europe
                </button>
                <button 
                    @click="activeRegion = 'asia'"
                    :class="activeRegion === 'asia' ? 'bg-white text-musashi-red shadow-xs font-bold' : 'text-slate-600 hover:text-black'"
                    class="px-5 py-2 rounded-full text-xs font-sans tracking-wide transition-all">
                    Asia & Americas
                </button>
            </div>

            <!-- Tab 1: Indonesia Network -->
            <div x-show="activeRegion === 'indonesia'" x-transition class="space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">Domestic Production Network</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-black mt-1">Indonesia Operating Plants</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Cikarang Plant -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">Plant 1 - Head Office</span>
                            <span class="text-xs font-mono text-slate-500">Established Jan 1996</span>
                        </div>
                        <h3 class="text-xl font-bold text-black">PT Musashi Auto Parts Indonesia - Cikarang</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            EJIP Industrial Park Plot 3J-2 Cikarang Selatan, Bekasi 17550, West Java, Indonesia
                        </p>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs font-mono text-slate-700">
                            <div><strong>Phone:</strong> +62-21-8970866</div>
                            <div><strong>Production Scope:</strong> 2W & 4W Transmission Gear, Shaft, Camshaft, AT Mission</div>
                            <div><strong>Land Area:</strong> 55,000 m² &bull; <strong>Workforce:</strong> 1,194 Persons</div>
                        </div>
                    </div>

                    <!-- Karawang Plant -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-black bg-slate-100 border border-slate-200">Plant 2 - Mass Production</span>
                            <span class="text-xs font-mono text-slate-500">Established Jan 2006</span>
                        </div>
                        <h3 class="text-xl font-bold text-black">PT Musashi Auto Parts Indonesia - Karawang</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Suryacipta City of Industry Jl. Surya Madya Kav 1-36 BC, Desa Kutanegara Kec. Ciampel, Karawang 41361, Indonesia
                        </p>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs font-mono text-slate-700">
                            <div><strong>Phone:</strong> +62-21-89115116</div>
                            <div><strong>Production Scope:</strong> Heavy Forging, Differential Assembly, Ball Joint Assembly</div>
                            <div><strong>Land Area:</strong> 60,000 m² &bull; <strong>Workforce:</strong> 443 Persons</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Japan Network -->
            <div x-show="activeRegion === 'japan'" x-transition style="display: none;" class="space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">Global Headquarters & Japanese Facilities</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-black mt-1">Japan Network</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Global HQ / Aichi</span>
                        <h4 class="text-base font-bold text-black">Head Office / Ueta Plant</h4>
                        <p class="text-slate-600 text-xs">39-5 Daizen, Ueta-cho, Toyohashi-shi, Aichi</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: (+81)532-25-8111</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Aichi Production</span>
                        <h4 class="text-base font-bold text-black">Akemi Plants #1 & #2</h4>
                        <p class="text-slate-600 text-xs">2-18 & 3-29 Akemi-cho, Toyohashi-shi, Aichi</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: (+81)532-25-3111</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Energy Solutions</span>
                        <h4 class="text-base font-bold text-black">Musashi Energy Solutions Co., Ltd.</h4>
                        <p class="text-slate-600 text-xs">8565 Nishiide, Oizumi-cho, Hokuto-shi, Yamanashi</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: (+81)551-38-8008</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Mie Plant</span>
                        <h4 class="text-base font-bold text-black">Suzuka Plant</h4>
                        <p class="text-slate-600 text-xs">393-12-16 Oike, Suzuka-shi, Mie</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: (+81)59-378-0621</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Kyushu</span>
                        <h4 class="text-base font-bold text-black">Kyushu Musashi Seimitsu Co., Ltd.</h4>
                        <p class="text-slate-600 text-xs">2605-7 Karimasashita, Ichibu, Nishiki-machi, Kumamoto</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: (+81)966-38-2121</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Precision Casting</span>
                        <h4 class="text-base font-bold text-black">Musashi Casting Co., Ltd.</h4>
                        <p class="text-slate-600 text-xs">2-3 Miwachomiwa, Fukuchiyama-shi, Kyoto</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: (+81)773-59-2433</p>
                    </div>
                </div>
            </div>

            <!-- Tab 3: Europe Network -->
            <div x-show="activeRegion === 'europe'" x-transition style="display: none;" class="space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">European Manufacturing</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-black mt-1">Europe Network</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Germany HQ</span>
                        <h4 class="text-base font-bold text-black">Musashi Europe GmbH</h4>
                        <p class="text-slate-600 text-xs">Haystrasse 7-13, 55566 Bad Sobernheim, Germany</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: +49-6751-83-0</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Hungary</span>
                        <h4 class="text-base font-bold text-black">Musashi Hungary Manufacturing, Ltd.</h4>
                        <p class="text-slate-600 text-xs">2451 Ercsi, Ercseny Ut 1, Hungary</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: +36-25-551-801</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">United Kingdom</span>
                        <h4 class="text-base font-bold text-black">Musashi Auto Parts UK Ltd.</h4>
                        <p class="text-slate-600 text-xs">6 Hawtin Park Gellihaf Pontllanfraith, Blackwood, UK</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: +44-1443-866-100</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Spain</span>
                        <h4 class="text-base font-bold text-black">Musashi Spain Villalba S.L.</h4>
                        <p class="text-slate-600 text-xs">Camino del Molino n°5, Collado Villalba (Madrid), Spain</p>
                        <p class="text-slate-500 text-xs font-mono">TEL: +34-91-856-1482</p>
                    </div>
                </div>
            </div>

            <!-- Tab 4: Asia & Americas -->
            <div x-show="activeRegion === 'asia'" x-transition style="display: none;" class="space-y-8">
                <div class="text-center max-w-xl mx-auto">
                    <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">Global Reach</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-black mt-1">Asia & The Americas</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">China</span>
                        <h4 class="text-base font-bold text-black">Musashi Auto Parts (Zhongshan) Co., Ltd.</h4>
                        <p class="text-slate-600 text-xs">Torch Hi-tech Industrial Development Zone, Zhongshan, Guangdong</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">Thailand</span>
                        <h4 class="text-base font-bold text-black">Musashi Auto Parts (Thailand) Co., Ltd.</h4>
                        <p class="text-slate-600 text-xs">7/230 Moo 6, Tambol Mabyangporn, Pluakdaeng, Rayong</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">India</span>
                        <h4 class="text-base font-bold text-black">Musashi Auto Parts India Pvt. Ltd.</h4>
                        <p class="text-slate-600 text-xs">Plot No. 40, Sector 7, IIE Pantnagar, Rudrapur, Uttarakhand</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-2">
                        <span class="text-xs font-mono text-musashi-red font-bold uppercase">USA</span>
                        <h4 class="text-base font-bold text-black">Musashi Auto Parts Michigan, Inc.</h4>
                        <p class="text-slate-600 text-xs">195 Concord Road, Battle Creek, Michigan, USA</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
