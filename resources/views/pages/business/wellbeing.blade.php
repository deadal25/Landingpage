@extends('layouts.app')

@section('title', \App\Models\LandingPageSetting::get('pillar_wellbeing_page_title', 'Well-being') . ' - ' . __('messages.company_name'))
@section('meta_description', 'Musashi new businesses enriching people lives and solving local social issues through sustainable agriculture, childcare tech, and bio-phytochemical health.')

@section('content')
    <!-- Page Header Banner (Clean Japanese Corporate Aesthetic) -->
    <section class="pt-32 pb-14 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Our Business</span>
                <span>/</span>
                <span class="text-slate-900 font-semibold">Well-being</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-widest">
                    {{ app()->getLocale() === 'ja' ? '事業領域 04 / ウェルビーイング' : (app()->getLocale() === 'id' ? 'PILAR BISNIS 04 / KESEJAHTERAAN' : 'BUSINESS PILLAR 04 / WELL-BEING') }}
                </span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight font-sans leading-tight">
                {{ \App\Models\LandingPageSetting::get('pillar_wellbeing_page_title', (app()->getLocale() === 'ja' ? 'ウェルビーイング' : (app()->getLocale() === 'id' ? 'Kesejahteraan (Well-being)' : 'Well-being'))) }}
            </h1>
            <p class="text-slate-600 text-base sm:text-lg mt-3 max-w-3xl leading-relaxed font-normal">
                {{ \App\Models\LandingPageSetting::get('pillar_wellbeing_page_subtitle', (app()->getLocale() === 'ja' ? '人々の暮らしを豊かにし、地域の社会課題を解決する武蔵の新規事業' : (app()->getLocale() === 'id' ? 'Bisnis baru Musashi memperkaya taraf hidup masyarakat dan memecahkan masalah sosial lokal' : "Musashi's new business enriches people's lives and solves local social issues"))) }}
            </p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Featured Image (from musashi.co.id/Well-being.html) -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center bg-[#F8F9FA] rounded-2xl p-6 sm:p-10 border border-slate-200 shadow-xs">
                <div class="md:col-span-5 rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-sm max-h-[460px] flex items-center justify-center">
                    <img 
                        src="{{ asset(\App\Models\LandingPageSetting::get('pillar_wellbeing_page_image', 'images/business/well-being4-481x687.jpg', false)) }}" 
                        alt="Musashi Well-being Projects" 
                        class="w-full h-full object-cover">
                </div>

                <div class="md:col-span-7 space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            {{ app()->getLocale() === 'ja' ? '持続可能な未来' : (app()->getLocale() === 'id' ? 'MASYARAKAT BERKELANJUTAN' : 'SUSTAINABLE SOCIETY') }}
                        </span>
                        <span class="text-xs font-mono text-slate-500 uppercase tracking-wider">Life of 100 Years</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug tracking-tight">
                        {{ \App\Models\LandingPageSetting::get('pillar_wellbeing_sec_title', (app()->getLocale() === 'ja' ? '社会のウェルビーイングに寄与する持続可能なビジネスモデル' : (app()->getLocale() === 'id' ? 'Model Bisnis Berkelanjutan yang Berkontribusi pada Kesejahteraan Sosial' : 'Sustainable Business Models Contributing to Societal Well-being'))) }}
                    </h2>
                    <div class="w-16 h-1 bg-musashi-red rounded-full"></div>

                    <!-- Body Text Paragraphs -->
                    <div class="text-slate-700 text-base leading-relaxed space-y-4">
                        @php
                            $defaultContent = app()->getLocale() === 'ja'
                                ? "私たちが新規事業を立ち上げる唯一の条件は、「社会のウェルビーイングに貢献する持続可能なビジネスモデルであること」です。\n\n農家の課題を解決するために新規事業創出プログラムから2017年に誕生した「アグリトリオ（Agritrio）」や、子育て家族と保育者の不安を可視化する「イクコ（icuco）」など、社内スタートアッププロジェクトを積極的に生み出しています。\n\nまた東三河の土壌で育まれた植物の機能性成分に着目したバイオ事業では、大学との共同研究を行う「M Lab」、その研究成果を活かした生産拠点「Plant Bio Factory」、植物療法に基づくインナー・アウターケア製品を提供する「Waphyto」を展開。人々の健康に貢献し、「人生100年時代」を支える事業へと発展させていきます。"
                                : (app()->getLocale() === 'id'
                                    ? "Satu-satunya syarat yang kami tetapkan untuk meluncurkan bisnis baru adalah harus merupakan model bisnis berkelanjutan yang berkontribusi pada kesejahteraan (well-being) masyarakat.\n\nKami memproduksi proyek startup secara proaktif, termasuk 'Agritrio' yang didirikan pada tahun 2017 sebagai bagian dari program penciptaan bisnis baru kami untuk memecahkan masalah petani, dan 'icuco' untuk memvisualisasikan kekhawatiran pengasuhan anak bagi keluarga dan pengasuh.\n\nBerfokus pada bahan-bahan fungsional tumbuhan yang dihasilkan di tanah wilayah Mikawa Timur, bisnis hayati (bio) kami mencakup M Lab yang melakukan penelitian kolaboratif dengan universitas, Plant Bio Factory untuk produksi berdasarkan proyek penelitian tersebut, dan Waphyto yang menawarkan produk perawatan tubuh berbasis terapi fitokimia. Berkontribusi pada kesehatan manusia, bisnis kami berkembang untuk mendukung kehidupan 100 tahun."
                                    : "The only condition we set to launch a new business is it should be a sustainable business model that contributes to the well-being of society. We produce startup projects proactively, including \"Agritrio\" founded in 2017 as part of our new business creation program to solve farmers' issues, and \"icuco\" to visualize child caring concerns of families and caretakers.\n\nFocusing on the functional ingredients of plants yielded in the soil of the East Mikawa region, our bio business includes M Lab which undertakes collaborative research with universities, Plant Bio Factory for production based on such research projects, and Waphyto which offers inner and outer care products based on phytochemical therapy. Contributing to people's health, our business will develop to support a life of 100 years.");
                            $wellbeingContent = \App\Models\LandingPageSetting::get('pillar_wellbeing_page_content', $defaultContent);
                        @endphp
                        {!! nl2br(e($wellbeingContent)) !!}
                    </div>
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
                    <a href="{{ route('business.energy') }}" class="group p-5 rounded-2xl border border-slate-200 bg-white hover:border-musashi-red hover:shadow-md transition-all">
                        <span class="text-xs font-mono font-bold text-musashi-red uppercase block mb-1">03. Energy</span>
                        <h4 class="text-sm font-bold text-slate-900 group-hover:text-musashi-red transition-colors">Energy Solution & Capacitors</h4>
                        <span class="inline-flex items-center text-xs font-bold text-slate-500 group-hover:text-musashi-red mt-3 gap-1">Read More →</span>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
