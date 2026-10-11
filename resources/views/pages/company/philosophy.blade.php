@extends('layouts.app')

@section('title', 'Musashi Philosophy - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Discover the Musashi Philosophy: Our Origin, Our Purpose, Our Way, Corporate Mark, and Corporate Colors (Musashi Red & Musashi Black).')

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Company</span>
                <span>/</span>
                <span class="text-black font-semibold">Musashi Philosophy</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">{{ \App\Models\LandingPageSetting::get('philosophy_badge', 'Corporate Philosophy') }}</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                {{ \App\Models\LandingPageSetting::get('philosophy_title', 'Musashi Philosophy') }}
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                {{ \App\Models\LandingPageSetting::get('philosophy_sub', 'The enduring spirit, core purpose, and shared behavioral values that guide all Musashi members worldwide.') }}
            </p>
        </div>
    </section>

    <!-- Philosophy Pillars Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <!-- Structure Intro -->
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-xs font-mono uppercase tracking-widest text-musashi-red font-bold">{{ \App\Models\LandingPageSetting::get('philosophy_intro_badge', 'Foundation of Value Creation') }}</span>
                <h2 class="text-2xl sm:text-4xl font-black text-black mt-2 tracking-tight">{{ \App\Models\LandingPageSetting::get('philosophy_intro_title', 'Composition of Musashi Philosophy') }}</h2>
                <div class="w-12 h-1 bg-musashi-red mx-auto mt-4"></div>
            </div>

            <!-- 1. Our Origin -->
            <div class="bg-white rounded-2xl p-8 sm:p-12 border border-slate-200 border-l-4 border-l-amber-500 shadow-xs">
                <div class="flex flex-col md:flex-row gap-8 items-start justify-between">
                    <div class="space-y-4 max-w-2xl">
                        <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-amber-700 bg-amber-50 border border-amber-200 inline-block">{{ \App\Models\LandingPageSetting::get('philosophy_origin_badge', '01. Our Origin') }}</span>
                        <h3 class="text-2xl font-black text-black">{{ \App\Models\LandingPageSetting::get('philosophy_origin_title', 'The origins of Musashi, passed down from generation to generation.') }}</h3>
                        <p class="text-slate-700 text-base leading-relaxed">
                            {{ \App\Models\LandingPageSetting::get('philosophy_origin_lead', 'Since our inception, our founding spirit has been anchored in two sacred Japanese tenets:') }}
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-musashi-red font-bold block text-sm">{{ \App\Models\LandingPageSetting::get('philosophy_tenet1_kanji', '至誠一貫 (Shisei-Ikkan)') }}</span>
                                <span class="text-black font-semibold text-sm">{{ \App\Models\LandingPageSetting::get('philosophy_tenet1_title', 'Consistent Sincerity') }}</span>
                                <p class="text-slate-600 text-xs mt-1">{{ \App\Models\LandingPageSetting::get('philosophy_tenet1_desc', 'Sincerity in Monozukuri manufacturing and genuine honesty toward customers, colleagues, and society.') }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-musashi-red font-bold block text-sm">{{ \App\Models\LandingPageSetting::get('philosophy_tenet2_kanji', '質実剛健 (Shitsujitsu-Goken)') }}</span>
                                <span class="text-black font-semibold text-sm">{{ \App\Models\LandingPageSetting::get('philosophy_tenet2_title', 'Simple and Sturdy') }}</span>
                                <p class="text-slate-600 text-xs mt-1">{{ \App\Models\LandingPageSetting::get('philosophy_tenet2_desc', 'Robust engineering, resilient character, avoiding extravagance, and focusing wholeheartedly on substantive quality.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center p-6 rounded-2xl bg-slate-50 border border-slate-200 w-full md:w-56 flex-shrink-0">
                        <span class="text-5xl font-serif text-amber-600 block mb-2">{{ \App\Models\LandingPageSetting::get('philosophy_origin_kanji', '至誠', false) }}</span>
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-mono font-bold">{{ \App\Models\LandingPageSetting::get('philosophy_origin_kanji_label', 'Founding Spirit') }}</span>
                    </div>
                </div>
            </div>

            <!-- 2. Our Purpose -->
            <div class="bg-white rounded-2xl p-8 sm:p-12 border border-slate-200 border-l-4 border-l-musashi-red shadow-xs">
                <div class="flex flex-col md:flex-row gap-8 items-start justify-between">
                    <div class="space-y-4 max-w-2xl">
                        <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200 inline-block">{{ \App\Models\LandingPageSetting::get('philosophy_purpose_badge', '02. Our Purpose') }}</span>
                        <h3 class="text-2xl sm:text-3xl font-black text-black leading-snug tracking-tight">
                            {{ \App\Models\LandingPageSetting::get('philosophy_purpose_quote', '"We contribute to enriched Harmony between our lives and Earth, using our Passion for technology and Wisdom for innovation."') }}
                        </h3>
                        <p class="text-slate-700 text-base leading-relaxed">
                            {{ \App\Models\LandingPageSetting::get('philosophy_purpose_desc', 'Our reason for being is to harness the passion of engineering and the wisdom of collective ingenuity to solve pressing social challenges, promote decarbonization, and elevate mobility for future generations.') }}
                        </p>
                    </div>
                    <div class="text-center p-6 rounded-2xl bg-slate-50 border border-slate-200 w-full md:w-56 flex-shrink-0">
                        <span class="text-5xl font-serif text-musashi-red block mb-2">{{ \App\Models\LandingPageSetting::get('philosophy_purpose_kanji', '調和', false) }}</span>
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-mono font-bold">{{ \App\Models\LandingPageSetting::get('philosophy_purpose_kanji_label', 'Harmony & Earth') }}</span>
                    </div>
                </div>
            </div>

            <!-- 3. Our Way -->
            <div class="bg-white rounded-2xl p-8 sm:p-12 border border-slate-200 border-l-4 border-l-blue-600 shadow-xs">
                <div class="flex flex-col md:flex-row gap-8 items-start justify-between">
                    <div class="space-y-4 max-w-2xl">
                        <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-blue-700 bg-blue-50 border border-blue-200 inline-block">{{ \App\Models\LandingPageSetting::get('philosophy_way_badge', '03. Our Way') }}</span>
                        <h3 class="text-2xl font-black text-black">{{ \App\Models\LandingPageSetting::get('philosophy_way_title', 'The values each of us hold in our hearts. Moving into the future with Exploration and Exploitation of knowledge.') }}</h3>
                        <p class="text-slate-700 text-base leading-relaxed">
                            {{ \App\Models\LandingPageSetting::get('philosophy_way_desc', 'We balance continuous refinement of our core Monozukuri precision capabilities (Exploitation) while actively taking on fearless new ventures into electric powertrains, AI systems, and green technologies (Exploration).') }}
                        </p>
                    </div>
                    <div class="text-center p-6 rounded-2xl bg-slate-50 border border-slate-200 w-full md:w-56 flex-shrink-0">
                        <span class="text-5xl font-serif text-blue-600 block mb-2">{{ \App\Models\LandingPageSetting::get('philosophy_way_kanji', '挑戦', false) }}</span>
                        <span class="text-xs uppercase tracking-wider text-slate-500 font-mono font-bold">{{ \App\Models\LandingPageSetting::get('philosophy_way_kanji_label', 'Continuous Challenge') }}</span>
                    </div>
                </div>
            </div>

            <!-- 4. Corporate Mark & 5. Corporate Colors -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Corporate Mark -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4">
                    <div class="w-12 h-12 flex items-center justify-center mb-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Mark" class="w-12 h-12 object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-black">{{ \App\Models\LandingPageSetting::get('philosophy_mark_title', 'Corporate Mark') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ \App\Models\LandingPageSetting::get('philosophy_mark_desc', 'An integrated production system centered on precision forging and processing technology. The rotating celestial orbit signifies global connectivity, dynamic momentum, and sub-micron rotational precision realizing high quality and competitive cost globally.') }}
                    </p>
                </div>

                <!-- Corporate Color -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-6 h-6 rounded-full bg-[#E60012] shadow-xs"></div>
                        <div class="w-6 h-6 rounded-full bg-black"></div>
                    </div>
                    <h3 class="text-xl font-bold text-black">{{ \App\Models\LandingPageSetting::get('philosophy_colors_title', 'Corporate Colors: Musashi Red & Musashi Black') }}</h3>
                    <div class="space-y-3 text-sm text-slate-700 leading-relaxed">
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <strong class="text-musashi-red font-bold block mb-0.5">{{ \App\Models\LandingPageSetting::get('philosophy_color1_name', 'Musashi Red (#E60012)', false) }}</strong>
                            {{ \App\Models\LandingPageSetting::get('philosophy_color1_desc', 'Represents "Passion, Innovation, and Challenge" — the unstoppable energy to create new value.') }}
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                            <strong class="text-black font-bold block mb-0.5">{{ \App\Models\LandingPageSetting::get('philosophy_color2_name', 'Musashi Black (#111111)', false) }}</strong>
                            {{ \App\Models\LandingPageSetting::get('philosophy_color2_desc', 'Represents "A sense of mission, iron will, and determination" — unflinching dedication to quality and integrity.') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
