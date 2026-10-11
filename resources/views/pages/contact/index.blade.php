@extends('layouts.app')

@section('title', 'Contact Us - PT Musashi Auto Parts Indonesia')
@section('meta_description', 'Get in touch with PT Musashi Auto Parts Indonesia at our Cikarang or Karawang facilities for OEM inquiries, procurement, or corporate communications.')

@section('content')
    <!-- Page Header Banner (Musashi Japan Clean White Corporate) -->
    <section class="pt-32 pb-12 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-musashi-red transition-colors">Home</a>
                <span>/</span>
                <span class="text-black font-semibold">Contact Us</span>
            </nav>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-3 h-0.5 bg-musashi-red"></div>
                <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">Inquiry</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-black tracking-tight font-sans">
                Contact Us
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl font-normal">
                Connect with our corporate office, sales engineering team, or plant operations in Cikarang and Karawang.
            </p>
        </div>
    </section>

    <!-- Contact Details & Form Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <!-- Plant Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Cikarang Plant Card -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-musashi-red bg-red-50 border border-red-200">
                            Head Office & Plant 1
                        </span>
                        <span class="text-xs font-mono text-slate-500">Bekasi, West Java</span>
                    </div>
                    <h3 class="text-xl font-bold text-black">Cikarang Plant</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        EJIP Industrial Park Plot 3J-2 Cikarang Selatan, Bekasi 17550, Indonesia
                    </p>
                    <div class="space-y-2 pt-2 text-xs font-mono text-slate-700">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-musashi-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>Phone: +62-21-8970866 (Hunting)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-musashi-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>Email: contact@musashi.co.id</span>
                        </div>
                    </div>
                </div>

                <!-- Karawang Plant Card -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-xs space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded text-xs font-mono font-bold uppercase tracking-wider text-black bg-slate-100 border border-slate-200">
                            Mass Production Plant 2
                        </span>
                        <span class="text-xs font-mono text-slate-500">Karawang, West Java</span>
                    </div>
                    <h3 class="text-xl font-bold text-black">Karawang Plant</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Suryacipta City of Industry Jl. Surya Madya Kav 1-36 BC, Desa Kutanegara Kec. Ciampel, Karawang 41361, Indonesia
                    </p>
                    <div class="space-y-2 pt-2 text-xs font-mono text-slate-700">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-musashi-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>Phone: +62-21-89115116 (Hunting)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-musashi-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>Email: karawang.office@musashi.co.id</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inquiry Form Container -->
            <div class="bg-white rounded-2xl p-8 sm:p-14 border border-slate-200 shadow-xs">
                <div class="max-w-2xl mb-8">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-3 h-0.5 bg-musashi-red"></div>
                        <span class="text-xs font-mono font-bold text-musashi-red uppercase tracking-wider">General Inquiry</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-black text-black tracking-tight">Send Us a Message</h2>
                    <p class="text-slate-600 text-sm mt-2">
                        For procurement, vendor partnerships, product specifications, or institutional inquiries, please fill in your details below.
                    </p>
                </div>

                @if($errors->any())
                    <div class="p-4 mb-6 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
                        @foreach($errors->all() as $error)
                            <div>• {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <div>
                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Your Full Name *</label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="John Doe" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">
                    </div>

                    <div>
                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Email Address *</label>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="name@company.com" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">
                    </div>

                    <div>
                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+62 21..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">
                    </div>

                    <div>
                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Company / Organization</label>
                        <input type="text" name="company" value="{{ old('company') }}" placeholder="Company Name" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Subject *</label>
                        <input type="text" name="subject" required value="{{ old('subject') }}" placeholder="Subject of your message" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-semibold">Message *</label>
                        <textarea name="message" required rows="5" placeholder="Detail your inquiry or project specifications..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black placeholder-slate-400 focus:outline-none focus:border-musashi-red shadow-xs">{{ old('message') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit" class="px-8 py-3.5 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs transition-all">
                            Submit Inquiry &rarr;
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
