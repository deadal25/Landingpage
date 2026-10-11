@extends('layouts.app')

@section('title', 'Board Of Directors - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Meet the executive leadership and Board of Directors of PT Musashi Auto Parts Indonesia leading precision manufacturing and corporate governance.')

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Company</span>
                <span>/</span>
                <span class="text-black font-semibold">Board Of Directors</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Executive Governance</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                {{ \App\Models\LandingPageSetting::get('bod_title', 'The Board of Directors') }}
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                {{ \App\Models\LandingPageSetting::get('bod_desc', 'Dedicated leadership guiding PT Musashi Auto Parts Indonesia toward sustainable growth, innovation, and Monozukuri excellence.') }}
            </p>
        </div>
    </section>

    <!-- BOD Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">{{ \App\Models\LandingPageSetting::get('bod_badge', 'Executive Governance') }}</span>
                <h2 class="text-2xl sm:text-4xl font-black text-black mt-2 tracking-tight">{{ \App\Models\LandingPageSetting::get('bod_title', 'Executive Leadership') }}</h2>
                <div class="w-12 h-1 bg-musashi-red mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($directors as $director)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-md transition-all flex flex-col group">
                        <div class="relative h-80 overflow-hidden bg-slate-100">
                            <img src="{{ asset($director->photo) }}" alt="{{ $director->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-4 left-6 right-6">
                                <span class="px-3 py-1 rounded text-[11px] font-mono font-bold uppercase tracking-wider text-musashi-red bg-white/95 border border-slate-200 shadow-xs inline-block mb-2">
                                    {{ $director->title }}
                                </span>
                                <h3 class="text-xl font-black text-white drop-shadow-md">
                                    {{ $director->name }}
                                </h3>
                            </div>
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                {{ $director->bio }}
                            </p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                                <span>PT MAP-IN</span>
                                <span class="text-musashi-red font-bold">Directorate</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Corporate Governance Message -->
            <div class="p-8 sm:p-12 rounded-2xl bg-slate-50 border border-slate-200 space-y-3 text-center max-w-3xl mx-auto">
                <h3 class="text-xl font-bold text-black">Commitment to High Integrity Governance</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Under our Board of Directors, PT Musashi Auto Parts Indonesia adheres to the highest compliance standards, transparent ethical guidelines, risk management, and employee health and safety across all manufacturing departments.
                </p>
            </div>

        </div>
    </section>
@endsection
