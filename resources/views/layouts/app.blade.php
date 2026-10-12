<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>@yield('title', 'PT. Musashi Auto Parts Indonesia') - Precision Monozukuri & Electric Mobility</title>
    <meta name="description" content="@yield('meta_description', 'PT. Musashi Auto Parts Indonesia (MAP-IN) is a premier manufacturer of precision two-wheel and four-wheel engine, transmission, and e-Axle electric mobility parts based in Cikarang and Karawang.')">
    <meta name="keywords" content="Musashi, PT Musashi Auto Parts Indonesia, MAP-IN, Astra Honda Motor, Monozukuri, automotive parts, transmission gear, camshaft, differential assembly, e-Axle, Cikarang, Karawang">
    <meta name="author" content="PT. Musashi Auto Parts Indonesia">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'PT. Musashi Auto Parts Indonesia')">
    <meta property="og:description" content="@yield('meta_description', 'Manufacturer of precision automotive transmission parts, Monozukuri excellence, and e-Mobility innovations.')">
    <meta property="og:image" content="{{ asset('images/hero/hero-sunrise.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'PT. Musashi Auto Parts Indonesia')">
    <meta property="twitter:description" content="@yield('meta_description', 'Manufacturer of precision automotive transmission parts, Monozukuri excellence, and e-Mobility innovations.')">
    <meta property="twitter:image" content="{{ asset('images/hero/hero-sunrise.jpg') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white text-slate-800 min-h-screen flex flex-col font-sans antialiased overflow-x-hidden" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 30)">

    <!-- Flash notifications -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" class="fixed bottom-6 right-6 z-50 flex items-center p-4 max-w-md text-slate-100 bg-emerald-950/90 border border-emerald-500/40 rounded-xl shadow-2xl backdrop-blur-md transition transform duration-300">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-400 bg-emerald-900/60 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="ml-3 text-sm font-medium">{{ session('success') }}</div>
            <button @click="show = false" type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 text-slate-400 hover:text-white focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" class="fixed bottom-6 right-6 z-50 flex items-center p-4 max-w-md text-slate-100 bg-red-950/90 border border-red-500/40 rounded-xl shadow-2xl backdrop-blur-md">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-400 bg-red-900/60 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
            <div class="ml-3 text-sm font-medium">{{ session('error') }}</div>
            <button @click="show = false" type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 text-slate-400 hover:text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    <!-- Main Navigation Header -->
    <x-navbar />

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- Back to top button -->
    <button 
        x-show="scrolled" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        aria-label="Back to top"
        class="fixed bottom-6 left-6 z-40 p-3 rounded-full bg-white border border-slate-200 hover:border-musashi-red text-slate-600 hover:text-white hover:bg-musashi-red shadow-lg transition-all duration-300 group">
        <svg class="w-5 h-5 transform group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- Instant Clean Client-Side Helper & Cookie Cleanup -->
    <script>
        // Immediately clear any legacy googtrans cookie to prevent external delays
        document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=" + window.location.hostname;
    </script>

    @stack('scripts')
</body>
</html>
