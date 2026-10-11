@extends('layouts.app')

@section('title', 'Corporate Message - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Corporate message from Musashi leadership. Taking on new challenges for a company with an 80+ year history and vision toward 2038.')

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-slate-600">Company</span>
                <span>/</span>
                <span class="text-black font-semibold">Corporate Message</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">{{ \App\Models\LandingPageSetting::get('message_page_badge', 'Top Message') }}</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                {{ \App\Models\LandingPageSetting::get('message_page_title', 'Corporate Message') }}
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                {{ \App\Models\LandingPageSetting::get('message_page_sub', 'A statement from Musashi Leadership on innovation, Monozukuri sincerity, and our 100-Year Global Vision.') }}
            </p>
        </div>
    </section>

    <!-- Message Content Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <div class="bg-white rounded-2xl p-8 sm:p-14 border border-slate-200 shadow-xs relative">
                <!-- Quote mark badge -->
                <div class="w-14 h-14 rounded-2xl bg-red-50 border border-red-200 text-musashi-red flex items-center justify-center mb-8">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                </div>

                <div class="flex items-center gap-2 mb-3">
                    <div class="w-3 h-0.5 bg-musashi-red"></div>
                    <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">{{ \App\Models\LandingPageSetting::get('message_ceo_badge', 'CEO Vision & Sincerity') }}</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-black mb-6 leading-tight tracking-tight">
                    {{ \App\Models\LandingPageSetting::get('message_president_title', 'New Challenge for a Company with a 100-Year History') }}
                </h2>

                <div class="space-y-6 text-slate-700 text-base sm:text-lg leading-relaxed font-normal">
                    @php
                        $msgBody = \App\Models\LandingPageSetting::get('message_president_body');
                    @endphp
                    @if($msgBody)
                        <div class="space-y-4">
                            {!! nl2br(e($msgBody)) !!}
                        </div>
                    @else
                        <p>
                            Sincerity in <strong class="text-black font-bold">"Monozukuri"</strong> and the development of human resources is the origin of the Musashi Group. This philosophy has enabled us to withstand the many challenges that we have faced over our 80+ years of history by anticipating market needs and then developing new and unique technologies to meet those needs.
                        </p>
                        <p>
                            As we look to the future, the prospects for the overall global economy remain uncertain. Still, we can be confident that the automotive and motorcycle markets in which we operate will continue to show steady mid- and long-term growth. In addition, global competition has intensified due to proactive initiatives for mechanical changes in vehicles, including electrification and autonomous driving. A quicker and more flexible approach is required to respond to a rapidly evolving management environment.
                        </p>
                        <p>
                            To survive and grow in this era of significant transition, we have established the <span class="text-musashi-red font-bold">"Musashi 100th Year Vision"</span> which forms an image of the new Musashi. We put the basis on <em class="text-black font-semibold not-italic">"Shisei-Ikkan"</em> (Consistent Sincerity) and <em class="text-black font-semibold not-italic">"Shitsujitsu-Goken"</em> (Simple and Sturdy), which is our foundation spirit and origin, and we have kept our approach of taking a challenge to ever-changing times since our founding.
                        </p>
                        <p>
                            We will take a new challenge for a company with a history of 100 years. We will deepen the automobile parts business, our core business, and bring out further growth by creating new businesses. We will solve social issues with our technology and aim to be an <strong class="text-black font-bold">"essential company"</strong> whose existence is expected by society, while also discharging our social responsibility across local communities and environmental conservation.
                        </p>
                    @endif
                </div>

                <!-- Signature Block -->
                <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-6 bg-slate-50 -mx-8 -mb-8 sm:-mx-14 sm:-mb-14 p-6 sm:p-10 rounded-b-2xl">
                    <div>
                        <div class="text-black font-bold text-lg">{{ \App\Models\LandingPageSetting::get('message_global_ceo_name', 'Hiroshi Otsuka', false) }}</div>
                        <div class="text-slate-600 text-xs sm:text-sm font-medium">{{ \App\Models\LandingPageSetting::get('message_global_ceo_title', 'President & CEO, Musashi Seimitsu Industry Co., Ltd.') }}</div>
                    </div>

                    <div class="sm:text-right border-l-2 sm:border-l-0 sm:border-r-2 border-musashi-red pl-4 sm:pl-0 sm:pr-4">
                        <div class="text-black font-bold text-lg">{{ \App\Models\LandingPageSetting::get('message_indo_ceo_name', 'Asep Nugraha', false) }}</div>
                        <div class="text-slate-600 text-xs sm:text-sm">{{ \App\Models\LandingPageSetting::get('message_indo_ceo_title', 'President Director, PT Musashi Auto Parts Indonesia') }}</div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
