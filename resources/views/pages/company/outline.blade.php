@extends('layouts.app')

@section('title', 'Company Outline - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Detailed profile of PT Musashi Auto Parts Indonesia: capital, investment ratio, plant dimensions, employees, and primary OEM customers.')

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Company</span>
                <span>/</span>
                <span class="text-black font-semibold">Company Outline</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Corporate Overview</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                Company Outline
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                Corporate credentials, plant specifications, investment structure, and primary automotive client network.
            </p>
        </div>
    </section>

    <!-- Main Outline Content -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <!-- Corporate Profile Table -->
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-xs">
                <div class="p-6 sm:p-8 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-black tracking-tight">PT Musashi Auto Parts Indonesia (MAP-IN)</h2>
                        <span class="text-xs text-musashi-red font-mono font-bold uppercase">Corporate Specification Sheet</span>
                    </div>
                    <img src="{{ asset('images/logo.png') }}" alt="Musashi Logo" class="w-10 h-10 object-contain hidden sm:block">
                </div>

                <div class="divide-y divide-slate-100 text-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">Company Name</span>
                        <div class="md:col-span-2 text-black font-semibold">{{ \App\Models\LandingPageSetting::get('outline_company_name', 'PT Musashi Auto Parts Indonesia (MAP-IN)', false) }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">Establishment</span>
                        <div class="md:col-span-2 text-slate-800 font-medium">{{ \App\Models\LandingPageSetting::get('outline_established', 'March 1996 (Commenced Commercial Production)') }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">Business Content</span>
                        <div class="md:col-span-2 text-slate-800 font-medium leading-relaxed">
                            {{ \App\Models\LandingPageSetting::get('outline_business_content', 'Manufacture and Sale of Two-Wheel & Four-Wheel Engine, Transmission, Camshaft, Differential, and e-Axle Electric Powertrain Components.') }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">President Director</span>
                        <div class="md:col-span-2 text-black font-bold">{{ \App\Models\LandingPageSetting::get('outline_president_director', 'Mr. Asep Nugraha', false) }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">Capitalization</span>
                        <div class="md:col-span-2 text-black font-mono font-bold">{{ \App\Models\LandingPageSetting::get('outline_capital', 'USD 14,000,000', false) }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">Investment Ratio</span>
                        <div class="md:col-span-2 space-y-2">
                            <div class="flex items-center justify-between max-w-md p-2.5 rounded-lg bg-slate-50 border border-slate-200 text-xs">
                                <span class="font-medium text-slate-800">[JAPAN] Musashi Seimitsu Industry Co., Ltd.</span>
                                <strong class="font-mono text-musashi-red font-bold">{{ \App\Models\LandingPageSetting::get('outline_investment_japan', '80%', false) }}</strong>
                            </div>
                            <div class="flex items-center justify-between max-w-md p-2.5 rounded-lg bg-slate-50 border border-slate-200 text-xs">
                                <span class="font-medium text-slate-800">[INDONESIA] PT Astra Honda Motor</span>
                                <strong class="font-mono text-black font-bold">{{ \App\Models\LandingPageSetting::get('outline_investment_indo', '20%', false) }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">Amount of Sales</span>
                        <div class="md:col-span-2 text-black font-mono font-bold">{{ \App\Models\LandingPageSetting::get('outline_sales', 'IDR 2,813 Billion (FY 2022)', false) }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">Number of Employees</span>
                        <div class="md:col-span-2 text-slate-800 font-medium">
                            <strong class="text-black font-bold">{{ \App\Models\LandingPageSetting::get('outline_employees', '1,637 Persons') }}</strong>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 p-5 sm:p-6 hover:bg-slate-50/60 transition-colors">
                        <span class="text-slate-500 font-semibold font-mono text-xs uppercase tracking-wider">Production Locations</span>
                        <div class="md:col-span-2 space-y-2 text-slate-700">
                            <div><strong class="text-black">Plant 1:</strong> {{ \App\Models\LandingPageSetting::get('outline_plant1_info', 'EJIP Industrial Park Plot 3J-2, Cikarang Selatan, Bekasi (55,000 m²)') }}</div>
                            <div><strong class="text-black">Plant 2:</strong> {{ \App\Models\LandingPageSetting::get('outline_plant2_info', 'Suryacipta City of Industry Kav 1-36 BC, Ciampel, Karawang (60,000 m²)') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Plants Information Detail Cards -->
            <div class="space-y-8">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-3 h-0.5 bg-musashi-red"></div>
                        <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Facilities</span>
                    </div>
                    <h3 class="text-2xl font-black text-black">Plant Information</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Plant 1 -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">Head Office & Plant 1</span>
                            <span class="text-xs font-mono text-slate-500">Est. Mar 1996</span>
                        </div>
                        <h4 class="text-xl font-bold text-black">Cikarang Plant</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            EJIP Industrial Park Plot 3J-2 Cikarang Selatan, Bekasi 17550, Indonesia
                        </p>
                        <div class="pt-4 border-t border-slate-100 space-y-1 text-xs font-mono text-slate-600">
                            <div>TEL : +62-21-8970866</div>
                            <div>Factory Space : 55,000 m²</div>
                            <div>Workforce : 1,194 Team Members</div>
                        </div>
                    </div>

                    <!-- Plant 2 -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-black bg-slate-100 border border-slate-200">Mass Production Plant 2</span>
                            <span class="text-xs font-mono text-slate-500">Est. Jan 2006</span>
                        </div>
                        <h4 class="text-xl font-bold text-black">Karawang Plant</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Suryacipta City of Industry Jl. Surya Madya Kav 1-36 BC, Desa Kutanegara Kec. Ciampel, Karawang 41361, Indonesia
                        </p>
                        <div class="pt-4 border-t border-slate-100 space-y-1 text-xs font-mono text-slate-600">
                            <div>TEL : +62-21-89115116</div>
                            <div>Factory Space : 60,000 m²</div>
                            <div>Workforce : 443 Team Members</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Customers Grid -->
            <div class="bg-white rounded-2xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-3 h-0.5 bg-musashi-red"></div>
                        <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Trusted Partnerships</span>
                    </div>
                    <h3 class="text-2xl font-black text-black">Our Esteemed OEM Customers</h3>
                    <p class="text-slate-600 text-sm mt-1">Providing Tier-1 drivetrain components for the most respected automotive brands:</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 text-xs font-semibold text-slate-700">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Astra Honda Motor</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Toyota Motor Mfg Indonesia</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Astra Daihatsu Motor</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Honda Prospect Motor</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Kawasaki Motor Indonesia</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Suzuki Indomobil Motor</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Honda Precision Parts Mfg</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT FCC Indonesia</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Aisin Indonesia</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT JTEKT Indonesia</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Akashi Wahana Indonesia</div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 hover:border-musashi-red transition-colors flex items-center">PT Honda Trading Indonesia</div>
                </div>
            </div>

        </div>
    </section>
@endsection
