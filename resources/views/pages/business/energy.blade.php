@extends('layouts.app')

@section('title', \App\Models\LandingPageSetting::get('pillar_energy_page_title', 'Energy Solution') . ' - ' . __('messages.company_name'))
@section('meta_description', 'Musashi Energy Solutions thoroughly develops and manufactures lithium iron capacitors, backup power systems, and energy storage devices.')

@section('content')
    <!-- Page Header Banner (Clean Japanese Corporate Aesthetic) -->
    <section class="pt-32 pb-14 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Our Business</span>
                <span>/</span>
                <span class="text-slate-900 font-semibold">Energy</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-widest">
                    {{ app()->getLocale() === 'ja' ? '事業領域 03 / エネルギー' : (app()->getLocale() === 'id' ? 'PILAR BISNIS 03 / ENERGI' : 'BUSINESS PILLAR 03 / ENERGY') }}
                </span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight font-sans leading-tight">
                {{ \App\Models\LandingPageSetting::get('pillar_energy_page_title', (app()->getLocale() === 'ja' ? 'エネルギーソリューション' : (app()->getLocale() === 'id' ? 'Solusi Energi (Energy Solution)' : 'Energy Solution'))) }}
            </h1>
            <p class="text-slate-600 text-base sm:text-lg mt-3 max-w-3xl leading-relaxed font-normal">
                {{ \App\Models\LandingPageSetting::get('pillar_energy_page_subtitle', (app()->getLocale() === 'ja' ? 'モビリティで培った技術を多彩な領域へ応用。人々の暮らしを支えるエネルギーを創り出し、新たな冒険へ！' : (app()->getLocale() === 'id' ? 'Menerapkan teknologi yang dikembangkan untuk otomobilitas di berbagai bidang. Kami menciptakan energi — kehidupan masyarakat dan melangkah maju menghadapi tantangan!' : 'Applying technologies developed for automobility in various fields. We create energy - livelihood of the people barriers and go on adventures!'))) }}
            </p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Featured Image (from musashi.co.id/Energy.html) -->
            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-md bg-slate-950 max-h-[500px]">
                <img 
                    src="{{ asset(\App\Models\LandingPageSetting::get('pillar_energy_page_image', 'images/business/energy-975x387.png', false)) }}" 
                    alt="Musashi Energy Solutions - Lithium Ion Capacitors" 
                    class="w-full h-full object-cover">
            </div>

            <!-- Content Card -->
            <div class="bg-[#F8F9FA] rounded-2xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-6">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                        {{ app()->getLocale() === 'ja' ? '蓄電デバイス技術' : (app()->getLocale() === 'id' ? 'TEKNOLOGI PENYIMPANAN ENERGI' : 'ENERGY STORAGE TECHNOLOGY') }}
                    </span>
                    <span class="text-xs font-mono text-slate-500 uppercase tracking-wider">Musashi Energy Solutions Co., Ltd.</span>
                </div>

                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug tracking-tight">
                    {{ \App\Models\LandingPageSetting::get('pillar_energy_sec_title', (app()->getLocale() === 'ja' ? 'リチウムイオンキャパシタの徹底開発と製造' : (app()->getLocale() === 'id' ? 'Pengembangan Mendalam dan Manufaktur Kapasitor Lithium Ion' : 'Advanced Development and Manufacturing of Lithium-Ion Capacitors'))) }}
                </h2>
                <div class="w-16 h-1 bg-musashi-red rounded-full"></div>

                <!-- Body Text Paragraphs -->
                <div class="text-slate-700 text-base sm:text-lg leading-relaxed space-y-5">
                    @php
                        $defaultContent = app()->getLocale() === 'ja'
                            ? "武蔵エナジーソリューションズ株式会社は、リチウムイオンキャパシタの徹底的な開発と製造を行っています。\n\n当社の製品群は、バックアップ電源システムから燃料電池自動車（FCV）の補助電源まで多岐にわたり、未来のエネルギー社会の発展に大きく貢献しています。長寿命・高出力・高い安全性を兼ね備えた革新的な蓄電デバイスを通じて、再生可能エネルギーの普及や鉄道・社会インフラの安定稼働を力強く支え続けます。"
                            : (app()->getLocale() === 'id'
                                ? "Musashi Energy Solutions Co., Ltd. mengembangkan dan memproduksi kapasitor lithium ion secara mendalam.\n\nProduk kami berkisar dari sistem daya cadangan (backup power) hingga sumber daya tambahan untuk kendaraan sel bahan bakar (fuel cell vehicles), berkontribusi pada kemajuan masyarakat energi masa depan dengan efisiensi pengisian ultra-cepat, siklus hidup yang sangat panjang, dan stabilitas termal tingkat otomotif."
                                : "Musashi Energy Solutions Co., Ltd. thoroughly develops and manufactures lithium iron capacitors. Our products range from backup power systems to auxiliary power sources for fuel cell vehicles, contributing to the advancement of a future energy society.");
                        $energyContent = \App\Models\LandingPageSetting::get('pillar_energy_page_content', $defaultContent);
                    @endphp
                    {!! nl2br(e($energyContent)) !!}
                </div>
            </div>

            <!-- Other Pillars Navigation Links -->
            <div class="pt-8 border-t border-slate-200">
                <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 mb-6">
                    {{ app()->getLocale() === 'ja' ? 'その他の事業領域を見る' : (app()->getLocale() === 'id' ? 'JELAJAHI PILAR BISNIS LAINNYA' : 'EXPLORE OTHER BUSINESS PILLARS') }}
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="{{ route('business.mobility') }}" class="group p-5 rounded-2xl border border-slate-200 bg-white hover:border-musashi-red hover:shadow-md transition-all">
                        <span class="text-xs font-mono font-bold text-musashi-red uppercase block mb-1">01. Mobility</span>
                        <h4 class="text-sm font-bold text-slate-900 group-hover:text-musashi-red transition-colors">Initiatives in Electrification</h4>
                        <span class="inline-flex items-center text-xs font-bold text-slate-500 group-hover:text-musashi-red mt-3 gap-1">Read More →</span>
                    </a>
                    <a href="{{ route('business.industry') }}" class="group p-5 rounded-2xl border border-slate-200 bg-white hover:border-musashi-red hover:shadow-md transition-all">
                        <span class="text-xs font-mono font-bold text-musashi-red uppercase block mb-1">02. Industry</span>
                        <h4 class="text-sm font-bold text-slate-900 group-hover:text-musashi-red transition-colors">Industry 4.0 - Evolution of Monozukuri</h4>
                        <span class="inline-flex items-center text-xs font-bold text-slate-500 group-hover:text-musashi-red mt-3 gap-1">Read More →</span>
                    </a>
                    <a href="{{ route('business.wellbeing') }}" class="group p-5 rounded-2xl border border-slate-200 bg-white hover:border-musashi-red hover:shadow-md transition-all">
                        <span class="text-xs font-mono font-bold text-musashi-red uppercase block mb-1">04. Well-being</span>
                        <h4 class="text-sm font-bold text-slate-900 group-hover:text-musashi-red transition-colors">Enriching People's Lives</h4>
                        <span class="inline-flex items-center text-xs font-bold text-slate-500 group-hover:text-musashi-red mt-3 gap-1">Read More →</span>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
