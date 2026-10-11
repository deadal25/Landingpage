<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Superadmin Musashi') - PT. Musashi Auto Parts Indonesia</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F6F8] text-slate-800 min-h-screen flex font-sans antialiased selection:bg-musashi-red selection:text-white" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" style="display: none;" class="fixed inset-0 bg-black/40 z-40 lg:hidden"></div>

    <!-- Sidebar Navigation -->
    <aside 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 z-50 flex flex-col justify-between transition-transform duration-300 shadow-xs">
        
        <div>
            <!-- Admin Brand Logo -->
            <div class="h-20 flex items-center px-6 border-b border-slate-200 gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Musashi Logo" class="w-8 h-8 object-contain">
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-black font-black text-sm uppercase tracking-tighter">MUSASHI</span>
                        <span class="text-[9px] font-mono font-bold bg-red-50 text-musashi-red px-1.5 py-0.5 rounded border border-red-200">SUPERADMIN</span>
                    </div>
                    <span class="text-[11px] text-slate-500 font-medium">Superadmin Control Center</span>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="p-4 space-y-1 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-600 hover:text-black hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Superadmin Dashboard</span>
                </a>

                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.news.*') ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-600 hover:text-black hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>News & Press</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-600 hover:text-black hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span>Products</span>
                </a>

                <a href="{{ route('admin.careers.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.careers.index') || request()->routeIs('admin.careers.create') || request()->routeIs('admin.careers.edit') ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-600 hover:text-black hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Careers</span>
                </a>

                <a href="{{ route('admin.careers.applications') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.careers.applications') ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-600 hover:text-black hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Applications</span>
                </a>

                <a href="{{ route('admin.directors.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.directors.*') ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-600 hover:text-black hover:bg-slate-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Directors (BOD)</span>
                </a>

                <div class="pt-4 mt-4 border-t border-slate-200">
                    <a href="{{ route('superadmin.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-red-50 text-musashi-red border border-red-200 font-bold hover:bg-red-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Superadmin Musashi CMS</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Sidebar Bottom: Public link & Logout -->
        <div class="p-4 border-t border-slate-200 space-y-2 bg-slate-50/50">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-black hover:bg-white border border-transparent hover:border-slate-200 transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>View Public Site</span>
            </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-xs text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Admin Container -->
    <div class="lg:pl-64 flex-1 flex flex-col min-h-screen">
        
        <!-- Admin Topbar -->
        <header class="h-16 bg-white/95 backdrop-blur-md border-b border-slate-200 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30">
            <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-slate-600 hover:text-black">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <div class="text-xs font-mono text-slate-500 hidden sm:block">
                PT. Musashi Auto Parts Indonesia • Superadmin Control Center
            </div>

            <div class="flex items-center gap-4">
                <span class="text-xs text-slate-700 font-semibold">{{ Auth::user()->name ?? 'Administrator' }}</span>
                <div class="w-8 h-8 rounded-full bg-musashi-red flex items-center justify-center text-white text-xs font-bold shadow-xs">
                    M
                </div>
            </div>
        </header>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="mx-4 sm:mx-8 mt-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mx-4 sm:mx-8 mt-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <!-- Main Content Slot -->
        <main class="flex-1 p-4 sm:p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>
