@extends('layouts.app')

@section('title', \App\Models\LandingPageSetting::get('pillar_mobility_page_title', 'Mobility - Initiatives in electrification') . ' - ' . __('messages.company_name'))
@section('meta_description', 'Musashi mobility initiatives in electrification, EV reduction mechanisms, differential assembly gears, and lightweight e-Axle modular powertrains.')

@section('content')
    <!-- Page Header Banner (Clean Japanese Corporate Aesthetic) -->
    <section class="pt-32 pb-14 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Our Business</span>
                <span>/</span>
                <span class="text-slate-900 font-semibold">Mobility</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-widest">
                    {{ app()->getLocale() === 'ja' ? '事業領域 01 / モビリティ' : (app()->getLocale() === 'id' ? 'PILAR BISNIS 01 / MOBILITAS' : 'BUSINESS PILLAR 01 / MOBILITY') }}
                </span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight font-sans leading-tight">
                {{ \App\Models\LandingPageSetting::get('pillar_mobility_page_title', (app()->getLocale() === 'ja' ? '電動化への取り組み' : (app()->getLocale() === 'id' ? 'Inisiatif dalam Elektrifikasi' : 'Initiatives in electrification'))) }}
            </h1>
            <p class="text-slate-600 text-base sm:text-lg mt-3 max-w-3xl leading-relaxed font-normal">
                {{ \App\Models\LandingPageSetting::get('pillar_mobility_page_subtitle', (app()->getLocale() === 'ja' ? '精密部品にとどまらず、社会にとって真に価値の高い製品を創り出し続けます' : (app()->getLocale() === 'id' ? 'Bukan hanya suku cadang presisi, kami terus menciptakan produk yang benar-benar bernilai tinggi bagi masyarakat' : 'Not only precision parts, but we also keep creating products truly highly valuable in society'))) }}
            </p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Featured Image (Exact authentic photo from musashi.co.id/mobility.html) -->
            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-md bg-slate-950 max-h-[500px]">
                <img 
                    src="{{ asset(\App\Models\LandingPageSetting::get('pillar_mobility_page_image', 'images/business/p-product01-933x601.jpg', false)) }}" 
                    alt="Musashi Mobility Initiatives in Electrification" 
                    class="w-full h-full object-cover">
            </div>

            <!-- Content Card -->
            <div class="bg-[#F8F9FA] rounded-2xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-6">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                        {{ app()->getLocale() === 'ja' ? '電動化ビジョン' : (app()->getLocale() === 'id' ? 'VISI MOBILITAS LISTRIK' : 'ELECTRIFICATION VISION') }}
                    </span>
                    <span class="text-xs font-mono text-slate-500 uppercase tracking-wider">Musashi Auto Parts</span>
                </div>

                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug tracking-tight">
                    {{ \App\Models\LandingPageSetting::get('pillar_mobility_sec_title', (app()->getLocale() === 'ja' ? '次世代EV市場を牽引するギア技術と減速機構' : (app()->getLocale() === 'id' ? 'Teknologi Roda Gigi Presisi & Unit Reduksi untuk Era Kendaraan Listrik' : 'Leading the EV Era with Precision Gears & Reduction Units'))) }}
                </h2>
                <div class="w-16 h-1 bg-musashi-red rounded-full"></div>

                <!-- Body Text Paragraphs -->
                <div class="text-slate-700 text-base sm:text-lg leading-relaxed space-y-5">
                    @php
                        $defaultContent = app()->getLocale() === 'ja' 
                            ? "近年、EV市場は急速に拡大しています。グローバルな開発競争が激化する一方で、自動車メーカー各社のアウトソーシング傾向は広がりを見せています。メーカーや開発プロジェクトの増加、そして開発サイクルの短縮化は、私たちにとって新たなチャンスをもたらしています。\n\n当社の主力製品であるデファレンシャルアセンブリギアや減速機構用ギアは、EVにおいて極めて重要な役割を果たしており、これら製品の需要増が見込まれています。\n\nモビリティ用ギアの専業メーカーとして長年培ってきた技術と知見は、電動化時代において大きな強みとなります。私たちはデファレンシャルアセンブリギアと減速ギアを融合させたEV向け減速ユニットの開発にも注力しており、EV時代のキーデバイスを基盤にさらなる飛躍を目指します。"
                            : (app()->getLocale() === 'id' 
                                ? "Dalam beberapa tahun terakhir pasar EV berkembang pesat. Sementara kompetisi global untuk pengembangan semakin meningkat, tren outsourcing oleh produsen mobil semakin meluas. Peluang baru bagi kami muncul dari lebih banyaknya produsen atau proyek pengembangan dan siklus pengembangan yang lebih singkat.\n\nGear differential assembly, produk unggulan kami, dan gear yang digunakan untuk mekanisme reduksi memainkan peran penting bagi EV. Peningkatan permintaan untuk produk-produk ini sangat dinantikan.\n\nSebagai manufaktur yang berdedikasi pada gear untuk mobilitas, teknologi dan pengetahuan yang terakumulasi selama bertahun-tahun adalah keunggulan besar bagi kami di era elektrifikasi. Kami juga fokus mengembangkan unit reduksi untuk EV dengan menggabungkan gear differential assembly dan gear reduksi. Berdasarkan perangkat kunci untuk era EV, kami berusaha untuk melakukan lompatan lebih jauh ke depan."
                                : "In recent years the EV market has grown rapidly.\nWhile global competition for development is increasing, the trend of outsourcing by automobile manufacturers is expanding. New opportunities for us are arising from more manufacturers or development projects and shorter development cycles. Differential assembly gears, our flagship product, and gears used for the reduction mechanism play the important role for EV. An increase in demand for these products is anticipated.\n\nAs a manufacturer dedicated to gears for mobility, the technology and knowledge accumulated for long time is a great advantage for us in the era of electrification. We also focus on developing reduction units for EVs by combining differential assembly gears and reduction gears. Based on the key device for the era of EV, we strive to make a further leap forward.");
                        $mobilityContent = \App\Models\LandingPageSetting::get('pillar_mobility_page_content', $defaultContent);
                    @endphp
                    {!! nl2br(e($mobilityContent)) !!}
                </div>
            </div>

            <!-- Other Pillars Navigation Links -->
            <div class="pt-8 border-t border-slate-200">
                <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 mb-6">
                    {{ app()->getLocale() === 'ja' ? 'その他の事業領域を見る' : (app()->getLocale() === 'id' ? 'JELAJAHI PILAR BISNIS LAINNYA' : 'EXPLORE OTHER BUSINESS PILLARS') }}
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
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
