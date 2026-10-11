@extends('layouts.app')

@section('title', 'Sustainability & Green Company - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Discover Musashi environmental sustainability initiatives: Green Company policy, Net-Zero roadmap, ISO 14001 certified operations, and community coexistence.')

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-black font-semibold">Sustainability</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Environmental & Social</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                Sustainability & ESG
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                A company built on trust. Dedicated to co-existence and co-prosperity with the global environment through carbon neutrality and social responsibility.
            </p>
        </div>
    </section>

    <!-- Sustainability Content -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <!-- Green Company Statement -->
            <div class="bg-white rounded-2xl p-8 sm:p-12 border border-slate-200 border-l-4 border-l-emerald-600 shadow-xs space-y-6">
                <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 border border-emerald-200 inline-block">
                    Environmental Policy
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-black leading-tight tracking-tight">
                    Green Company: Co-existence and Co-prosperity with the Earth
                </h2>
                <div class="w-12 h-1 bg-emerald-600"></div>

                <div class="space-y-4 text-slate-700 text-base leading-relaxed">
                    <p class="italic text-slate-800 font-medium">
                        "Our policy is to take the initiative in addressing environmental issues to achieve co-existence and co-prosperity with the global environment, to improve our environmental performance and contribute to the resolution of global environmental challenges, including carbon neutrality."
                    </p>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        At PT Musashi Auto Parts Indonesia, sustainability is not an afterthought — it is embedded in every forging strike, every CNC cutting fluid cycle, and every human resources development program across our Cikarang and Karawang facilities.
                    </p>
                </div>
            </div>

            <!-- 4 Key Sustainability Focus Areas Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- 1. Carbon Neutrality -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4 hover:shadow-md hover:border-slate-300 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black">
                        Energy Decarbonization & Rooftop Solar
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Deploying rooftop solar photovoltaic (PV) systems across our factory roofs, generating clean megawatt hours and replacing traditional fossil energy with renewable electricity. Transitioning diesel boilers to clean electric and natural gas systems.
                    </p>
                </div>

                <!-- 2. Circular Metallurgy -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4 hover:shadow-md hover:border-slate-300 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-red-50 border border-red-200 text-musashi-red flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black">
                        100% Circular Steel Scrap Recycling
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Machining swarf and forging flash are briquetted and returned directly to certified steel mills for remelting, ensuring a closed-loop raw material lifecycle without industrial landfill disposal.
                    </p>
                </div>

                <!-- 3. Water Conservation -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4 hover:shadow-md hover:border-slate-300 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black">
                        Wastewater Treatment & Zero Discharge
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Our state-of-the-art Wastewater Treatment Plants (WWTP) treat 100% of industrial coolant and washing effluents to parameters far exceeding national standards, with treated water recycled for factory landscape irrigation.
                    </p>
                </div>

                <!-- 4. Astra Green Company -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4 hover:shadow-md hover:border-slate-300 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black">
                        Astra Green Company & Social Synergy
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Active participant in the Astra Green Company audits and Astra CSR initiatives. Partnering with Indonesian technical vocational schools (SMK) to provide Monozukuri scholarships and tree-planting drives in West Java.
                    </p>
                </div>

            </div>

            <!-- Environmental Management Certifications Bar -->
            <div class="p-8 sm:p-12 rounded-2xl bg-slate-50 border border-slate-200 text-center space-y-6">
                <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">Standard Certifications</span>
                <h3 class="text-2xl font-black text-black">Certified World-Class Management Systems</h3>
                <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                    <div class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-center shadow-xs">
                        <strong class="text-base text-black block">ISO 14001:2015</strong>
                        <span class="text-xs text-slate-500">Environmental Management</span>
                    </div>
                    <div class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-center shadow-xs">
                        <strong class="text-base text-black block">ISO 45001:2018</strong>
                        <span class="text-xs text-slate-500">Occupational Health & Safety</span>
                    </div>
                    <div class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-center shadow-xs">
                        <strong class="text-base text-black block">IATF 16949:2016</strong>
                        <span class="text-xs text-slate-500">Automotive Quality Standard</span>
                    </div>
                    <div class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-center shadow-xs">
                        <strong class="text-base text-emerald-700 block">Green Industry Award</strong>
                        <span class="text-xs text-slate-500">Ministry of Industry RI</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
