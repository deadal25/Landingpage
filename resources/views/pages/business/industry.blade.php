@extends('layouts.app')

@section('title', \App\Models\LandingPageSetting::get('pillar_industry_page_title', 'Industry 4.0 - Evolution of Monozukuri') . ' - ' . __('messages.company_name'))
@section('meta_description', 'Musashi smart factory innovation, AI Visual Inspection System, and Autonomous Moving Robots leading Industry 4.0 under the slogan human jobs for humans.')

@section('content')
    <!-- Page Header Banner (Clean Japanese Corporate Aesthetic) -->
    <section class="pt-32 pb-14 bg-[#F8F9FA] border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Our Business</span>
                <span>/</span>
                <span class="text-slate-900 font-semibold">Industry</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-widest">
                    {{ app()->getLocale() === 'ja' ? '事業領域 02 / インダストリー' : (app()->getLocale() === 'id' ? 'PILAR BISNIS 02 / INDUSTRI' : 'BUSINESS PILLAR 02 / INDUSTRY') }}
                </span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight font-sans leading-tight">
                {{ \App\Models\LandingPageSetting::get('pillar_industry_page_title', (app()->getLocale() === 'ja' ? 'Industry 4.0 - モノづくりの進化' : (app()->getLocale() === 'id' ? 'Industri 4.0 - Evolusi Monozukuri' : 'Industry 4.0 -Evolution of Monozukuri'))) }}
            </h1>
            <p class="text-slate-600 text-base sm:text-lg mt-3 max-w-3xl leading-relaxed font-normal">
                {{ \App\Models\LandingPageSetting::get('pillar_industry_page_subtitle', (app()->getLocale() === 'ja' ? '「人にしかできない仕事を人が担う」— AI外観検査と自律走行搬送ロボットによるスマートファクトリーの実現' : (app()->getLocale() === 'id' ? '"Pekerjaan manusia untuk manusia" — mewujudkan smart factory melalui inspeksi visual AI dan robot bergerak otonom' : 'Under the slogan "human jobs for humans", realizing smart factory innovation through AI visual inspection and autonomous moving robots.'))) }}
            </p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- Section 1: AI Visual Inspection System -->
            <div class="bg-[#F8F9FA] rounded-2xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            {{ app()->getLocale() === 'ja' ? 'イノベーション 01' : (app()->getLocale() === 'id' ? 'INOVASI 01' : 'INNOVATION 01') }}
                        </span>
                        <span class="text-xs font-mono text-slate-500 uppercase tracking-wider">Musashi AI</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug tracking-tight">
                        {{ \App\Models\LandingPageSetting::get('pillar_industry_sec1_title', (app()->getLocale() === 'ja' ? 'AI外観検査システム' : (app()->getLocale() === 'id' ? 'Sistem Inspeksi Visual AI' : 'AI Visual Inspection System'))) }}
                    </h2>
                    <div class="w-16 h-1 bg-musashi-red rounded-full"></div>
                </div>

                <!-- Text Content -->
                <div class="text-slate-700 text-base sm:text-lg leading-relaxed space-y-4">
                    @php
                        $defaultSec1 = app()->getLocale() === 'ja'
                            ? "武蔵精密工業は、新たな時代を拓く製造業の変革に取り組んでいます。Industry 4.0によって生まれる新規市場の獲得に向け、スマートファクトリーを具現化します。製造現場における独自の設備製作、試作、治具、金型、切削工具製作など長年培ってきた「武器」を駆使し、現場のあらゆるニーズに応えます。\n\n手作業による搬送や目視検査は、製造において大きな負荷を伴う長時間ルーチン作業です。「人にしかできない仕事を人が担う」というスローガンのもと、Musashi AIは製造ラインにAIを導入することで現場の人々を高負荷なルーチンワークから解放し、モノづくりの革新を推進しています。"
                            : (app()->getLocale() === 'id'
                                ? "Musashi bekerja pada transformasi manufaktur yang memimpin era baru. Untuk menangkap peluang memperluas pasar baru sebagai hasil dari Industri 4.0, kami mewujudkan smart factory menjadi kenyataan. Tools & Machinery memberikan jawaban baru untuk setiap kebutuhan dalam manufaktur di lantai pabrik dengan memanfaatkan 'senjata' kami berupa teknologi akumulasi pembuatan peralatan unik, prototipe, jig, dies, dan perkakas potong.\n\nTransfer manual atau inspeksi visual adalah proses rutin berjam-jam yang membutuhkan beban tinggi dalam produksi. Di bawah slogan 'human jobs for humans' (pekerjaan manusia untuk manusia), Musashi AI bekerja pada inovasi Monozukuri dengan menerapkan AI dalam produksi untuk membebaskan manusia dari pekerjaan rutin berbeban tinggi."
                                : "Musashi is working on the transformation of manufacturing leading a new era. To grasp a chance to expand new markets resulting from Industry 4.0, we bring a smart factory into reality. Tools & Machinery provides a new answer to every need in manufacturing on the floor by utilizing our \"weapon\" of the accumulated technology of fabricating unique equipment, prototypes, jigs, dies and cutting tools.\n\nManual transfer or visual inspection is a long-hour routine process requiring high load in production. Under the slogan \"human jobs for humans\", Musashi AI is working on Monozukuri innovation by implementing AI in production to release people from high-load routine work.");
                        $industrySec1 = \App\Models\LandingPageSetting::get('pillar_industry_sec1_content', $defaultSec1);
                    @endphp
                    {!! nl2br(e($industrySec1)) !!}
                </div>

                <!-- Dual Photos for Section 1 (from musashi.co.id/Industry.html) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                    <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs">
                        <img src="{{ asset('images/business/p-ai-project01-pc-en-1076x757.png') }}" alt="AI Visual Inspection System" class="w-full h-64 sm:h-72 object-cover">
                        <div class="p-4 bg-white border-t border-slate-100">
                            <span class="text-xs font-mono font-bold text-slate-800">AI Deep Learning Edge Architecture</span>
                        </div>
                    </div>
                    <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs">
                        <img src="{{ asset('images/business/mapin-ai-1076x668.png') }}" alt="MAP-IN AI Deployment" class="w-full h-64 sm:h-72 object-cover">
                        <div class="p-4 bg-white border-t border-slate-100">
                            <span class="text-xs font-mono font-bold text-slate-800">Shop Floor Monozukuri Implementation</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Autonomous Moving Robot -->
            <div class="bg-[#F8F9FA] rounded-2xl p-8 sm:p-12 border border-slate-200 shadow-xs space-y-8">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            {{ app()->getLocale() === 'ja' ? 'イノベーション 02' : (app()->getLocale() === 'id' ? 'INOVASI 02' : 'INNOVATION 02') }}
                        </span>
                        <span class="text-xs font-mono text-slate-500 uppercase tracking-wider">Intralogistics Automation</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug tracking-tight">
                        {{ \App\Models\LandingPageSetting::get('pillar_industry_sec2_title', (app()->getLocale() === 'ja' ? '自律走行搬送ロボット' : (app()->getLocale() === 'id' ? 'Robot Bergerak Otonom (Autonomous Robot)' : 'Autonomous Moving Robot'))) }}
                    </h2>
                    <div class="w-16 h-1 bg-musashi-red rounded-full"></div>
                </div>

                <!-- Text Content -->
                <div class="text-slate-700 text-base sm:text-lg leading-relaxed space-y-4">
                    @php
                        $defaultSec2 = app()->getLocale() === 'ja'
                            ? "「人にしかできない仕事を人が担う」という理念に基づき、生産工程にAIを融合させることで製造の革新を進めています。当社の製品はお客様へ搬送、機械加工、検査の各工程を経て届けられます。\n\n機械加工は人の技術と判断によって付加価値を生み出す「モノづくり」の核心です。一方で、搬送や目視検査のプロセスは長時間かつ高い負荷を要するルーチンワークです。しかし人間は本来、極めて創造的な存在です。反復作業を自動化することで人々がイノベーションに集中し、自己の仕事をさらに発展させることができます。私たちは誰もが有意義で創造的な役割に専念できる環境づくりに尽力し、グループ拠点のみならず世界の製造業へ幅広い技術を提供し続けます。"
                            : (app()->getLocale() === 'id'
                                ? "Berdasarkan slogan kami 'human jobs for humans', kami menginovasi manufaktur dengan mengintegrasikan AI ke dalam proses produksi. Produk kami dikirimkan ke pelanggan melalui proses transfer, pemesinan, dan inspeksi.\n\nPemesinan adalah inti dari 'Monozukuri' di mana nilai ditambahkan oleh teknologi dan pertimbangan manusia. Proses transfer dan inspeksi visual, di sisi lain, adalah pekerjaan rutin berjam-jam dan berbeban tinggi. Manusia, bagaimanapun, secara alami kreatif. Dengan mengotomatiskan tugas-tugas berulang, kita dapat memungkinkan orang untuk fokus pada inovasi dan terus mengembangkan pekerjaan mereka. Kami berkomitmen untuk menciptakan lingkungan yang memungkinkan individu terlibat dalam peran yang bermakna dan kreatif. Kami bertujuan untuk terus menyediakan berbagai teknologi bagi pabrik-pabrik grup kami serta manufaktur global."
                                : "Based with our \"human jobs for humans\", we are innovating manufacturing by integrating AI into production processes. Our products are delivered to customers through the process of transfer, machining, and inspection.\n\nMachining is a core of \"Monozukuri\" that values are added by human technology and judgment. The process of transfer and visual inspection, on the other hand, is a long-hour and high-load routine work. Human beings, however, are naturally creative. By automating repetitive tasks, we can enable people to focus on innovation and continue developing their work. We are committed to creating an environment that allows individuals to engage in meaningful and creative roles. We aim to keep providing our group plants as well as global manufacturers with a wide range of technologies.");
                        $industrySec2 = \App\Models\LandingPageSetting::get('pillar_industry_sec2_content', $defaultSec2);
                    @endphp
                    {!! nl2br(e($industrySec2)) !!}
                </div>

                <!-- Dual Photos for Section 2 (from musashi.co.id/Industry.html) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                    <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs">
                        <img src="{{ asset('images/business/autonomous-robot-587x389.png') }}" alt="Autonomous Moving Robot" class="w-full h-64 sm:h-72 object-cover">
                        <div class="p-4 bg-white border-t border-slate-100">
                            <span class="text-xs font-mono font-bold text-slate-800">Autonomous Mobile Robot (AMR) Navigation</span>
                        </div>
                    </div>
                    <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs">
                        <img src="{{ asset('images/business/p-industry03-570x367.jpg') }}" alt="Smart Factory Floor Implementation" class="w-full h-64 sm:h-72 object-cover">
                        <div class="p-4 bg-white border-t border-slate-100">
                            <span class="text-xs font-mono font-bold text-slate-800">Zero-Defect Robotic Workstation</span>
                        </div>
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
