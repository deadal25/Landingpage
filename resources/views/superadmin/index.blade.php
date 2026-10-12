@php
    $adm = [
        'portal_title' => ['id' => 'Superadmin Musashi', 'en' => 'Superadmin Musashi', 'ja' => '武蔵スーパー管理者'],
        'control_center' => ['id' => 'Database & Landing Page Control', 'en' => 'Database & Landing Page Control', 'ja' => 'DB＆ランディングページ管理'],
        'tab_overview' => ['id' => 'Dashboard & Ringkasan', 'en' => 'Dashboard & Overview', 'ja' => 'ダッシュボードと概要'],
        'tab_navbar' => ['id' => 'Navbar & Menu Navigasi', 'en' => 'Navbar & Navigation Menu', 'ja' => 'ナビゲーション＆ヘッダー'],
        'tab_hero' => ['id' => 'Beranda & Hero Banner', 'en' => 'Home & Hero Banner', 'ja' => 'トップ＆ヒーローバナー'],
        'tab_news' => ['id' => 'Daftar Berita & Pers', 'en' => 'News & Press Releases', 'ja' => 'ニュース＆プレスリリース'],
        'tab_pillars' => ['id' => 'Bisnis & 4 Pilar Global', 'en' => 'Business & 4 Global Pillars', 'ja' => '事業領域＆4つの柱'],
        'tab_products' => ['id' => 'Katalog Produk & EV', 'en' => 'Products Catalog & EV', 'ja' => '製品カタログ＆EV'],
        'tab_technology' => ['id' => 'Teknologi & Monozukuri', 'en' => 'Technology & Monozukuri', 'ja' => '技術力＆モノづくり'],
        'tab_profile' => ['id' => 'Profil & Tentang Kami', 'en' => 'Profile & About Us', 'ja' => '会社概要＆企業案内'],
        'tab_directors' => ['id' => 'Dewan Direksi (BOD)', 'en' => 'Board of Directors (BOD)', 'ja' => '役員紹介 (BOD)'],
        'tab_sustainability' => ['id' => 'Keberlanjutan & ESG', 'en' => 'Sustainability & ESG', 'ja' => 'サステナビリティ＆ESG'],
        'tab_footer' => ['id' => 'Footer & Kontak Pabrik', 'en' => 'Footer & Factory Contacts', 'ja' => 'フッター＆拠点連絡先'],
        'view_lp' => ['id' => 'Lihat Landing Page', 'en' => 'View Landing Page', 'ja' => 'ランディングページを見る'],
        'sign_out' => ['id' => 'Keluar (Sign Out)', 'en' => 'Sign Out', 'ja' => 'ログアウト'],
        'live_note' => ['id' => 'Perubahan yang disimpan di halaman ini langsung terhubung dan terbit di Landing Page.', 'en' => 'Changes saved here are instantly connected and published live to the Landing Page.', 'ja' => 'ここで保存された変更は即座にランディングページに反映・公開されます。'],
        'view_web' => ['id' => 'Lihat Web', 'en' => 'View Web', 'ja' => 'サイト確認'],
        'active_lang' => ['id' => 'Bahasa Aktif', 'en' => 'Active Language', 'ja' => 'アクティブ言語'],
        'save_changes' => ['id' => 'Simpan Perubahan', 'en' => 'Save Changes', 'ja' => '変更を保存'],
        'cancel' => ['id' => 'Batal', 'en' => 'Cancel', 'ja' => 'キャンセル'],
        'add_news' => ['id' => '+ Tambah Berita Baru', 'en' => '+ Add New Article', 'ja' => '+ 新規ニュース追加'],
        'close_form' => ['id' => 'Tutup Formulir', 'en' => 'Close Form', 'ja' => 'フォームを閉じる'],
        'date' => ['id' => 'Tanggal', 'en' => 'Date', 'ja' => '日付'],
        'publish_status' => ['id' => 'Status Tayang', 'en' => 'Publish Status', 'ja' => '公開状態'],
        'actions' => ['id' => 'Aksi', 'en' => 'Actions', 'ja' => '操作'],
        'edit' => ['id' => 'Edit', 'en' => 'Edit', 'ja' => '編集'],
        'delete' => ['id' => 'Hapus', 'en' => 'Delete', 'ja' => '削除'],
    ];
    $L = fn($k) => $adm[$k][$editLocale] ?? $adm[$k]['id'] ?? $k;
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Superadmin Musashi - PT Musashi Auto Parts Indonesia</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8F9FA] text-slate-800 font-sans antialiased min-h-screen selection:bg-musashi-red selection:text-white"
      x-data="{ 
          sidebarOpen: false,
          currentTab: '{{ $activeTab }}',
          profileSubTab: '{{ $activeSubTab ?? 'about' }}',
          editLocale: '{{ $editLocale }}',
          showCreateNews: false,
          editingNews: null,
          showCreateProduct: false,
          editingProduct: null,
          showCreateDirector: false,
          editingDirector: null,
          createNewsPhotos: [],
          editNewPhotos: [],
          createProductPhotos: [],
          editProductNewPhotos: [],
          isCompressingPhotos: false,
          networkFacilities: {{ json_encode(\App\Models\LandingPageSetting::getNetworkFacilities()) }},
          networkRegionFilter: 'all',
          showAddFacilityModal: false,
          newFacility: {
              region: 'indonesia',
              badge: '',
              name: '',
              est: '',
              address: '',
              phone: '',
              scope: '',
              stats: ''
          }
      }">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;" 
         class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

    <!-- ==================== SIDEBAR NAVIGATION ==================== -->
    <aside 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 z-50 flex flex-col justify-between transition-transform duration-300 shadow-sm">
        
        <div class="flex-1 flex flex-col min-h-0">
            <!-- Brand Header with Mobile Close Button -->
            <div class="h-18 flex items-center justify-between px-5 border-b border-slate-200 gap-3 flex-shrink-0">
                <a href="{{ route('superadmin.index') }}" class="flex items-center gap-2.5 group min-w-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Musashi" class="w-8 h-8 object-contain flex-shrink-0">
                    <div class="min-w-0">
                        <div class="flex items-center gap-1.5">
                            <span class="text-black font-black text-sm tracking-tighter uppercase font-sans">MUSASHI</span>
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-red-50 text-musashi-red border border-red-200">CMS</span>
                        </div>
                        <span class="text-[10px] text-slate-500 font-medium block truncate">Superadmin Portal</span>
                    </div>
                </a>
                <button 
                    @click="sidebarOpen = false" 
                    type="button" 
                    class="p-1.5 rounded-xl text-slate-400 hover:text-black hover:bg-slate-100 lg:hidden focus:outline-none flex-shrink-0"
                    aria-label="Tutup Sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation Links (Exact 1:1 match with Landing Page Sections) -->
            <nav class="p-3 space-y-1 text-xs font-semibold overflow-y-auto flex-1">
                <!-- 1. Ringkasan Dashboard -->
                <button 
                    @click="currentTab = 'overview'; sidebarOpen = false" 
                    :class="currentTab === 'overview' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>{{ $L('tab_overview') }}</span>
                    </div>
                </button>

                <!-- 2. Navbar & Menu Navigasi -->
                <button 
                    @click="currentTab = 'navbar'; sidebarOpen = false" 
                    :class="currentTab === 'navbar' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        <span>{{ $L('tab_navbar') }}</span>
                    </div>
                </button>

                <!-- 3. Hero Visual & Video Slider -->
                <button 
                    @click="currentTab = 'hero'; sidebarOpen = false" 
                    :class="currentTab === 'hero' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ $L('tab_hero') }}</span>
                    </div>
                </button>

                <!-- 3. Kelola Berita (News) -->
                <button 
                    @click="currentTab = 'news'; sidebarOpen = false" 
                    :class="currentTab === 'news' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>{{ $L('tab_news') }}</span>
                    </div>
                    <span :class="currentTab === 'news' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'" class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold">{{ $stats['total_news'] }}</span>
                </button>

                <!-- 4. Bisnis & 4 Pilar Global -->
                <button 
                    @click="currentTab = 'pillars'; sidebarOpen = false" 
                    :class="currentTab === 'pillars' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        <span>{{ $L('tab_pillars') }}</span>
                    </div>
                </button>

                <!-- 5. Katalog Produk & EV -->
                <button 
                    @click="currentTab = 'products'; sidebarOpen = false" 
                    :class="currentTab === 'products' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span>{{ $L('tab_products') }}</span>
                    </div>
                    <span :class="currentTab === 'products' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'" class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold">{{ $stats['total_products'] }}</span>
                </button>

                <!-- 6. Teknologi & Monozukuri (NEW) -->
                <button 
                    @click="currentTab = 'technology'; sidebarOpen = false" 
                    :class="currentTab === 'technology' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        <span>{{ $L('tab_technology') }}</span>
                    </div>
                </button>

                <!-- 7. Profil & Tentang Kami -->
                <button 
                    @click="currentTab = 'profile'; sidebarOpen = false" 
                    :class="currentTab === 'profile' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>{{ $L('tab_profile') }}</span>
                    </div>
                </button>

                <!-- 8. Dewan Direksi (BOD) -->
                <button 
                    @click="currentTab = 'directors'; sidebarOpen = false" 
                    :class="currentTab === 'directors' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>{{ $L('tab_directors') }}</span>
                    </div>
                    <span :class="currentTab === 'directors' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'" class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold">{{ $stats['total_directors'] }}</span>
                </button>

                <!-- 9. Keberlanjutan & ESG (NEW) -->
                <button 
                    @click="currentTab = 'sustainability'; sidebarOpen = false" 
                    :class="currentTab === 'sustainability' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                        <span>{{ $L('tab_sustainability') }}</span>
                    </div>
                </button>

                <!-- 10. Pengaturan Footer & Medsos (NEW) -->
                <button 
                    @click="currentTab = 'footer'; sidebarOpen = false" 
                    :class="currentTab === 'footer' ? 'bg-musashi-red text-white shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-black'"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $L('tab_footer') }}</span>
                    </div>
                </button>
            </nav>
        </div>

        <!-- Sidebar Footer Actions -->
        <div class="p-4 border-t border-slate-200 bg-slate-50 space-y-2 flex-shrink-0">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:text-black hover:bg-white border border-transparent hover:border-slate-200 transition-all">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    {{ $L('view_lp') }}
                </span>
                <span class="text-[10px] font-mono text-slate-400">↗</span>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    {{ $L('sign_out') }}
                </button>
            </form>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <div class="lg:pl-64 flex-1 flex flex-col min-h-screen">
        
        <!-- Top Sticky Header -->
        <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-slate-200 px-3 xs:px-4 sm:px-6 md:px-8 py-2.5 sm:py-3 flex items-center justify-between gap-2 sm:gap-4 shadow-2xs">
            <div class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1">
                <!-- Hamburger Button (Mobile) -->
                <button 
                    @click="sidebarOpen = !sidebarOpen" 
                    type="button" 
                    class="p-1.5 xs:p-2 rounded-xl text-slate-700 hover:bg-slate-100 lg:hidden focus:outline-none flex-shrink-0"
                    aria-label="Toggle Sidebar">
                    <svg class="w-5 h-5 xs:w-6 xs:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <!-- Full Page Title without truncation -->
                <div class="min-w-0 flex-1">
                    <h2 class="text-xs xs:text-sm sm:text-base md:text-lg font-bold text-slate-900 tracking-tight flex items-center gap-1.5 sm:gap-2 leading-tight">
                        <span x-show="currentTab === 'overview'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">📊 {{ $L('tab_overview') }}</span>
                        <span x-show="currentTab === 'navbar'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">🧭 {{ $L('tab_navbar') }}</span>
                        <span x-show="currentTab === 'hero'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">🎬 {{ $L('tab_hero') }}</span>
                        <span x-show="currentTab === 'news'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">📰 {{ $L('tab_news') }}</span>
                        <span x-show="currentTab === 'pillars'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">🌐 {{ $L('tab_pillars') }}</span>
                        <span x-show="currentTab === 'products'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">⚙️ {{ $L('tab_products') }}</span>
                        <span x-show="currentTab === 'technology'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">🔬 {{ $L('tab_technology') }}</span>
                        <span x-show="currentTab === 'profile'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">🏢 {{ $L('tab_profile') }}</span>
                        <span x-show="currentTab === 'directors'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">👥 {{ $L('tab_directors') }}</span>
                        <span x-show="currentTab === 'sustainability'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">🌱 {{ $L('tab_sustainability') }}</span>
                        <span x-show="currentTab === 'footer'" class="inline-flex items-center gap-1.5 whitespace-normal sm:whitespace-nowrap">📌 {{ $L('tab_footer') }}</span>
                    </h2>
                    <p class="text-[11px] text-slate-500 hidden md:block">{{ $L('live_note') }}</p>
                </div>
            </div>

            <!-- Top Right Bar (Clean language switcher, view web button, admin badge) -->
            <div class="flex items-center gap-1.5 xs:gap-2 sm:gap-3 flex-shrink-0">
                
                <!-- Language Selector for Superadmin (ID / EN / JP) -->
                <div class="flex items-center bg-slate-100 border border-slate-200 rounded-xl p-0.5 sm:p-1 text-[10px] xs:text-[11px] sm:text-xs font-mono font-bold flex-shrink-0">
                    <a href="{{ route('superadmin.index', ['tab' => $activeTab, 'lang' => 'id']) }}"
                       title="Edit Konten Bahasa Indonesia"
                       class="px-1.5 xs:px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-lg transition-all {{ $editLocale === 'id' ? 'bg-musashi-red text-white shadow-xs font-extrabold' : 'text-slate-600 hover:text-black hover:bg-white/70' }}">
                        ID
                    </a>
                    <a href="{{ route('superadmin.index', ['tab' => $activeTab, 'lang' => 'en']) }}"
                       title="Edit Konten Bahasa Inggris"
                       class="px-1.5 xs:px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-lg transition-all {{ $editLocale === 'en' ? 'bg-musashi-red text-white shadow-xs font-extrabold' : 'text-slate-600 hover:text-black hover:bg-white/70' }}">
                        EN
                    </a>
                    <a href="{{ route('superadmin.index', ['tab' => $activeTab, 'lang' => 'ja']) }}"
                       title="Edit Konten Bahasa Jepang"
                       class="px-1.5 xs:px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-lg transition-all {{ $editLocale === 'ja' ? 'bg-musashi-red text-white shadow-xs font-extrabold' : 'text-slate-600 hover:text-black hover:bg-white/70' }}">
                        JP
                    </a>
                </div>

                <!-- Live Preview Link to Landing Page -->
                <a href="{{ route('locale.switch', $editLocale) }}" target="_blank"
                   title="Buka Website Landing Page"
                   class="inline-flex items-center gap-1.5 px-2 xs:px-2.5 sm:px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold border border-slate-200 transition-colors shadow-2xs flex-shrink-0">
                    <span class="hidden md:inline">{{ $L('view_web') }}</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>

                <!-- Admin Badge (Musashi Admin) -->
                <div class="hidden sm:flex items-center gap-2 pl-1.5 sm:pl-2 border-l border-slate-200 flex-shrink-0">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-red-50 text-musashi-red border border-red-200 flex items-center justify-center font-bold text-xs flex-shrink-0">
                        A
                    </div>
                    <div class="text-left hidden lg:block">
                        <span class="text-xs font-bold text-slate-900 block leading-tight">Musashi Admin</span>
                        <span class="text-[10px] text-slate-400 font-mono block">admin@musashi.co.id</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Workspace Container -->
        <main class="max-w-7xl 2xl:max-w-[1600px] 3xl:max-w-[1800px] mx-auto px-3.5 sm:px-8 py-5 sm:py-8 w-full space-y-6 flex-1">

            <!-- Flash Success Notification -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-emerald-900">Perubahan Berhasil!</p>
                            <p class="text-xs text-emerald-700">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-800 p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 shadow-xs">
                    <div class="flex items-center gap-2 font-bold text-sm mb-1">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Terjadi Kesalahan:</span>
                    </div>
                    <ul class="list-disc pl-5 text-xs text-red-700 space-y-0.5">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ========================================== -->
            <!-- TAB 1: OVERVIEW & DASHBOARD               -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'overview'" class="space-y-6">
                <!-- Welcome Card -->
                <div class="bg-white border border-slate-200 rounded-2xl p-4 xs:p-6 sm:p-8 shadow-xs relative overflow-hidden">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5 sm:gap-6">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-100 text-musashi-red text-xs font-mono font-bold uppercase mb-2.5 sm:mb-3">
                                <span class="w-2 h-2 rounded-full bg-musashi-red"></span>
                                <span>PT. Musashi Auto Parts Indonesia &bull; System Overview</span>
                            </div>
                            <h1 class="text-xl xs:text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                {{ $editLocale === 'ja' ? '武蔵スーパー管理者 コントロールセンター' : ($editLocale === 'en' ? 'Musashi Superadmin Control Center' : 'Pusat Kendali Superadmin Musashi') }}
                            </h1>
                            <p class="text-slate-600 text-xs sm:text-sm mt-1 max-w-3xl leading-relaxed">
                                {{ $editLocale === 'ja' ? 'ランディングページの全コンテンツ（3言語：ID・EN・JA）、ニュース記事、企業概要（About Us）、製品カタログ、役員紹介をリアルタイムで一元管理できます。' : ($editLocale === 'en' ? 'Manage all landing page content (3 Languages: ID, EN, JP), news articles, company profile (About Us), product catalog, and board of directors in realtime.' : 'Kelola seluruh konten landing page (3 Bahasa: ID, EN, JP), artikel berita, profil perusahaan (About Us), katalog produk, dan dewan direksi secara real-time.') }}
                            </p>
                        </div>

                        <!-- Quick Stats summary -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3 text-center">
                            <div class="p-2.5 xs:p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-xl xs:text-2xl font-black text-slate-900 block font-mono">{{ $stats['total_news'] }}</span>
                                <span class="text-[9px] xs:text-[10px] font-mono text-slate-500 uppercase">{{ $editLocale === 'ja' ? 'ニュース' : ($editLocale === 'en' ? 'News' : 'Berita') }} ({{ $stats['published_news'] }} {{ $editLocale === 'ja' ? '公開' : ($editLocale === 'en' ? 'Live' : 'Tayang') }})</span>
                            </div>
                            <div class="p-2.5 xs:p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-xl xs:text-2xl font-black text-musashi-red block font-mono">{{ $stats['total_products'] }}</span>
                                <span class="text-[9px] xs:text-[10px] font-mono text-slate-500 uppercase">{{ $editLocale === 'ja' ? '製品' : ($editLocale === 'en' ? 'Products' : 'Produk') }} ({{ $stats['featured_products'] }} Featured)</span>
                            </div>
                            <div class="p-2.5 xs:p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-xl xs:text-2xl font-black text-emerald-700 block font-mono">{{ $stats['directors_count'] }}</span>
                                <span class="text-[9px] xs:text-[10px] font-mono text-slate-500 uppercase">{{ $editLocale === 'ja' ? '役員 (BOD)' : ($editLocale === 'en' ? 'Board of Directors' : 'Dewan Direksi') }}</span>
                            </div>
                            <div class="p-2.5 xs:p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="text-xl xs:text-2xl font-black text-purple-700 block font-mono">{{ $stats['hero_slides_count'] }}</span>
                                <span class="text-[9px] xs:text-[10px] font-mono text-slate-500 uppercase">{{ $editLocale === 'ja' ? 'ヒーロー＆動画' : ($editLocale === 'en' ? 'Hero & Video Slides' : 'Slide Hero & Video') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Action Buttons -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3.5">
                    <button @click="currentTab = 'profile'" class="p-4 rounded-2xl bg-white border border-slate-200 hover:border-musashi-red hover:shadow-md transition-all text-left group">
                        <div class="w-9 h-9 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3 class="font-bold text-xs text-slate-900 group-hover:text-musashi-red transition-colors">{{ $editLocale === 'ja' ? '企業案内 & About Us' : ($editLocale === 'en' ? 'Profile & About Us' : 'Profil & About Us') }}</h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $editLocale === 'ja' ? '企業案内、トップメッセージ、理念を管理' : ($editLocale === 'en' ? 'Manage About Us, Top Message & Philosophy.' : 'Kelola narasi About Us, Top Message & filosofi.') }}</p>
                    </button>

                    <button @click="currentTab = 'profile'" class="p-4 rounded-2xl bg-white border border-slate-200 hover:border-emerald-600 hover:shadow-md transition-all text-left group">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="font-bold text-xs text-slate-900 group-hover:text-emerald-700 transition-colors">{{ $editLocale === 'ja' ? '会社要項 & 統計' : ($editLocale === 'en' ? 'Outline & Statistics' : 'Outline & Statistik') }}</h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $editLocale === 'ja' ? '従業員数、敷地面積、所在地、資本金' : ($editLocale === 'en' ? 'Employees, plant size, location & capital.' : 'Jumlah karyawan, luas pabrik, lokasi & modal.') }}</p>
                    </button>

                    <button @click="currentTab = 'directors'; showCreateDirector = true" class="p-4 rounded-2xl bg-white border border-slate-200 hover:border-musashi-red hover:shadow-md transition-all text-left group">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <h3 class="font-bold text-xs text-slate-900 group-hover:text-musashi-red transition-colors">{{ $editLocale === 'ja' ? '+ 役員を追加' : ($editLocale === 'en' ? '+ Add Director' : '+ Tambah Direktur') }}</h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $editLocale === 'ja' ? '役員名簿の追加・編集・削除' : ($editLocale === 'en' ? 'Add, edit & delete board of directors.' : 'Tambah, edit & hapus jajaran dewan direksi.') }}</p>
                    </button>

                    <button @click="currentTab = 'hero'" class="p-4 rounded-2xl bg-white border border-slate-200 hover:border-amber-600 hover:shadow-md transition-all text-left group">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-bold text-xs text-slate-900 group-hover:text-amber-700 transition-colors">{{ $editLocale === 'ja' ? 'ヒーロー＆動画' : ($editLocale === 'en' ? 'Hero & Video' : 'Hero & Video') }}</h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $editLocale === 'ja' ? 'バナースライダーと背景動画を設定' : ($editLocale === 'en' ? 'Configure banner slider & background video.' : 'Atur slider banner & video background.') }}</p>
                    </button>

                    <button @click="currentTab = 'news'; showCreateNews = true" class="p-4 rounded-2xl bg-white border border-slate-200 hover:border-musashi-red hover:shadow-md transition-all text-left group">
                        <div class="w-9 h-9 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <h3 class="font-bold text-xs text-slate-900 group-hover:text-musashi-red transition-colors">{{ $editLocale === 'ja' ? '+ ニュースを追加' : ($editLocale === 'en' ? '+ Add News Article' : '+ Tambah Berita') }}</h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $editLocale === 'ja' ? 'プレスリリース・写真投稿（最大10枚）' : ($editLocale === 'en' ? 'Upload press release & photos (up to 10 photos).' : 'Upload rilis pers & foto (hingga 10 foto).') }}</p>
                    </button>

                    <button @click="currentTab = 'products'" class="p-4 rounded-2xl bg-white border border-slate-200 hover:border-purple-600 hover:shadow-md transition-all text-left group">
                        <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <h3 class="font-bold text-xs text-slate-900 group-hover:text-purple-700 transition-colors">{{ $editLocale === 'ja' ? '製品カタログ' : ($editLocale === 'en' ? 'Products Catalog' : 'Katalog Produk') }}</h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $editLocale === 'ja' ? '自動車部品＆EVユニットを管理' : ($editLocale === 'en' ? 'Manage automotive parts & EV units.' : 'Kelola komponen otomotif & EV unit.') }}</p>
                    </button>
                </div>

                <!-- Panel Kendali Khusus: Profil, Garis Besar Pabrik & Dewan Direksi -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-7 shadow-xs space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-slate-100 gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-red-50 text-musashi-red flex items-center justify-center font-bold text-sm">
                                🏢
                            </div>
                            <div>
                                <h3 class="font-extrabold text-base text-slate-900">{{ $editLocale === 'ja' ? '企業概要・工場要項・役員紹介の管理' : ($editLocale === 'en' ? 'Company Profile, Plant Outline & BOD Control' : 'Kendali Profil Perusahaan, Garis Besar Pabrik & Dewan Direksi') }}</h3>
                                <p class="text-xs text-slate-500">{{ $editLocale === 'ja' ? '以下のデータはランディングページ (#company, #directors) および会社概要ページに直結しています。' : ($editLocale === 'en' ? 'All data below connects directly to the Landing Page (#company, #directors) and Company Outline.' : 'Seluruh data di bawah ini langsung terhubung ke Landing Page (#company, #directors) dan halaman Company Outline.') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="currentTab = 'profile'" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs transition-colors">
                                {{ $editLocale === 'ja' ? 'プロフィールタブで管理' : ($editLocale === 'en' ? 'Manage in Profile Tab' : 'Kelola di Tab Profil') }} &rarr;
                            </button>
                            <button @click="currentTab = 'directors'" class="px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 text-musashi-red font-bold text-xs transition-colors">
                                {{ $editLocale === 'ja' ? '役員一覧を管理' : ($editLocale === 'en' ? 'Manage Directors' : 'Kelola Dewan Direksi') }} &rarr;
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- 1. Indikator Statistik Landing Page (Fast Facts) -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-mono font-bold text-musashi-red uppercase tracking-wider">1. {{ $editLocale === 'ja' ? 'ランディングページ統計' : ($editLocale === 'en' ? 'Landing Page Statistics' : 'Statistik Landing Page') }}</span>
                                    <span class="px-2 py-0.5 rounded text-[9px] font-mono bg-white text-slate-600 border border-slate-200">4 Fast Facts</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div class="p-2.5 rounded-lg bg-white border border-slate-200">
                                        <span class="text-[10px] font-mono text-slate-400 block uppercase">{{ $editLocale === 'ja' ? '設立年' : ($editLocale === 'en' ? 'Established' : 'Pendirian') }}</span>
                                        <span class="font-black text-slate-900 font-mono text-sm">{{ \App\Models\LandingPageSetting::get('outline_established_stat', '1996', false) }}</span>
                                    </div>
                                    <div class="p-2.5 rounded-lg bg-white border border-slate-200">
                                        <span class="text-[10px] font-mono text-slate-400 block uppercase">{{ $editLocale === 'ja' ? '従業員数' : ($editLocale === 'en' ? 'Employees' : 'Karyawan') }}</span>
                                        <span class="font-black text-slate-900 font-mono text-sm">{{ \App\Models\LandingPageSetting::get('outline_employees_stat', '1,637+', false) }}</span>
                                    </div>
                                    <div class="p-2.5 rounded-lg bg-white border border-slate-200">
                                        <span class="text-[10px] font-mono text-slate-400 block uppercase">{{ $editLocale === 'ja' ? '敷地面積' : ($editLocale === 'en' ? 'Plant Area' : 'Luas Pabrik') }}</span>
                                        <span class="font-black text-slate-900 font-mono text-sm truncate block">{{ \App\Models\LandingPageSetting::get('outline_plant_area_stat', '115,000 m²', false) }}</span>
                                    </div>
                                    <div class="p-2.5 rounded-lg bg-white border border-slate-200">
                                        <span class="text-[10px] font-mono text-slate-400 block uppercase">{{ $editLocale === 'ja' ? '売上規模' : ($editLocale === 'en' ? 'Sales Scale' : 'Skala Sales') }}</span>
                                        <span class="font-black text-slate-900 font-mono text-sm truncate block">{{ \App\Models\LandingPageSetting::get('outline_sales_stat', 'IDR 2.8T+', false) }}</span>
                                    </div>
                                </div>
                            </div>
                            <button @click="currentTab = 'profile'" class="w-full text-center py-2 rounded-lg bg-white border border-slate-200 hover:border-musashi-red text-slate-700 hover:text-musashi-red text-xs font-bold transition-all">
                                ✏️ {{ $editLocale === 'ja' ? 'プロフィールタブで統計値を編集' : ($editLocale === 'en' ? 'Edit Statistics in Profile Tab' : 'Edit 4 Nilai Statistik di Tab Profil') }}
                            </button>
                        </div>

                        <!-- 2. Garis Besar Pabrik & Lokasi -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-mono font-bold text-emerald-700 uppercase tracking-wider">2. {{ $editLocale === 'ja' ? '工場概要＆拠点' : ($editLocale === 'en' ? 'Plant Outline & Locations' : 'Garis Besar Pabrik & Lokasi') }}</span>
                                    <span class="px-2 py-0.5 rounded text-[9px] font-mono bg-white text-slate-600 border border-slate-200">2 {{ $editLocale === 'ja' ? '工場' : ($editLocale === 'en' ? 'Plants' : 'Pabrik') }}</span>
                                </div>
                                <div class="space-y-1.5 text-xs text-slate-700">
                                    <div class="p-2 rounded-lg bg-white border border-slate-200">
                                        <span class="text-[10px] font-mono text-slate-400 block uppercase">{{ $editLocale === 'ja' ? '代表者' : ($editLocale === 'en' ? 'President Director' : 'Presiden Direktur') }}</span>
                                        <span class="font-bold text-slate-900">{{ \App\Models\LandingPageSetting::get('outline_president_director', 'Mr. Asep Nugraha', false) }}</span>
                                    </div>
                                    <div class="p-2 rounded-lg bg-white border border-slate-200">
                                        <span class="text-[10px] font-mono text-slate-400 block uppercase">{{ $editLocale === 'ja' ? '2038年ビジョン' : ($editLocale === 'en' ? 'Global Vision 2038' : 'Visi Global 2038') }}</span>
                                        <span class="font-bold text-musashi-red text-[11px] block truncate">{{ \App\Models\LandingPageSetting::getForLocale('vision_headline', $editLocale, 'Break Barriers and Go on Adventures!') }}</span>
                                    </div>
                                    <div class="p-2 rounded-lg bg-white border border-slate-200">
                                        <span class="text-[10px] font-mono text-slate-400 block uppercase">{{ $editLocale === 'ja' ? '第1チカラン工場・第2カラワン工場' : ($editLocale === 'en' ? 'Plant 1 Cikarang &bull; Plant 2 Karawang' : 'Pabrik 1 - Cikarang &bull; Pabrik 2 - Karawang') }}</span>
                                        <span class="font-medium text-slate-800 text-[11px] line-clamp-1">Total 115.000 m² &bull; {{ \App\Models\LandingPageSetting::get('outline_investment_japan', '80%') }} Musashi Japan / {{ \App\Models\LandingPageSetting::get('outline_investment_indo', '20%') }} AHM</span>
                                    </div>
                                </div>
                            </div>
                            <button @click="currentTab = 'profile'" class="w-full text-center py-2 rounded-lg bg-white border border-slate-200 hover:border-emerald-600 text-slate-700 hover:text-emerald-700 text-xs font-bold transition-all">
                                ✏️ {{ $editLocale === 'ja' ? '工場詳細をプロフィールタブで編集' : ($editLocale === 'en' ? 'Edit Factory Details in Profile Tab' : 'Edit Detail Pabrik di Tab Profil') }}
                            </button>
                        </div>

                        <!-- 3. Dewan Direksi (BOD) -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-mono font-bold text-blue-700 uppercase tracking-wider">3. {{ $editLocale === 'ja' ? '役員紹介 (BOD)' : ($editLocale === 'en' ? 'Board of Directors (BOD)' : 'Dewan Direksi (BOD)') }}</span>
                                    <span class="px-2 py-0.5 rounded text-[9px] font-mono bg-white text-slate-600 border border-slate-200">{{ $directorsList->count() }} {{ $editLocale === 'ja' ? '名' : ($editLocale === 'en' ? 'Members' : 'Anggota') }}</span>
                                </div>
                                <div class="space-y-1.5">
                                    @forelse($directorsList->take(3) as $d)
                                        <div class="p-2 rounded-lg bg-white border border-slate-200 flex items-center justify-between gap-2">
                                            <div class="flex items-center gap-2 min-w-0">
                                                <img src="{{ asset($d->photo) }}" alt="" class="w-7 h-7 rounded-full object-cover border border-slate-200 flex-shrink-0">
                                                <div class="min-w-0">
                                                    <span class="font-bold text-xs text-slate-900 block truncate">{{ $d->name }}</span>
                                                    <span class="text-[10px] text-musashi-red font-medium block truncate">{{ $d->title }}</span>
                                                </div>
                                            </div>
                                            <button @click="currentTab = 'directors'; editingDirector = JSON.parse(atob('{{ base64_encode(json_encode($d)) }}'))" class="text-[10px] font-bold text-slate-500 hover:text-black px-2 py-1 rounded bg-slate-50 hover:bg-slate-100 flex-shrink-0">
                                                {{ $editLocale === 'ja' ? '編集' : ($editLocale === 'en' ? 'Edit' : 'Edit') }}
                                            </button>
                                        </div>
                                    @empty
                                        <p class="text-xs text-slate-400 py-4 text-center">{{ $editLocale === 'ja' ? '役員データがまだありません。' : ($editLocale === 'en' ? 'No directors listed yet.' : 'Belum ada direktur terdaftar.') }}</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button @click="currentTab = 'directors'; showCreateDirector = true" class="flex-1 py-2 rounded-lg bg-musashi-red hover:bg-musashi-darkred text-white text-xs font-bold transition-all text-center">
                                    {{ $editLocale === 'ja' ? '+ 役員を追加' : ($editLocale === 'en' ? '+ Add Director' : '+ Tambah Direktur') }}
                                </button>
                                <button @click="currentTab = 'directors'" class="py-2 px-3 rounded-lg bg-white border border-slate-200 hover:border-slate-300 text-slate-700 text-xs font-bold transition-all">
                                    {{ $editLocale === 'ja' ? '全員' : ($editLocale === 'en' ? 'All' : 'Semua') }} ({{ $directorsList->count() }})
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Recent News & Landing Page Sections Panel -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent News Section -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h3 class="font-bold text-base text-slate-900">{{ $editLocale === 'ja' ? 'ランディングページの最新ニュース' : ($editLocale === 'en' ? 'Latest News on Landing Page' : 'Berita Terbaru di Landing Page') }}</h3>
                            <button @click="currentTab = 'news'" class="text-xs font-bold text-musashi-red hover:underline">{{ $editLocale === 'ja' ? 'すべて見る' : ($editLocale === 'en' ? 'View All' : 'Lihat Semua') }} ({{ $newsList->count() }}) &rarr;</button>
                        </div>
                        <div class="divide-y divide-slate-100">
                            @forelse($newsList->take(5) as $n)
                                <div class="py-3 flex items-center justify-between gap-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <img src="{{ asset($n->image ?? 'images/hero/hero-automotive.jpg') }}" alt="" class="w-12 h-10 object-cover rounded-lg border border-slate-200 flex-shrink-0">
                                        <div class="min-w-0">
                                            <h4 class="text-xs font-bold text-slate-900 truncate">{{ $n->title }}</h4>
                                            <span class="text-[10px] text-slate-400 font-mono">{{ $n->category }} &bull; {{ $n->published_at ? $n->published_at->format('Y.m.d') : $n->created_at->format('Y.m.d') }}</span>
                                        </div>
                                    </div>
                                    <form action="{{ route('superadmin.news.toggle', $n) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase font-mono transition-colors {{ $n->published_at ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                            {{ $n->published_at ? ($editLocale === 'ja' ? '公開中' : ($editLocale === 'en' ? 'Live' : 'Tayang')) : 'Draft' }}
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-xs text-slate-400 py-6 text-center">{{ $editLocale === 'ja' ? 'ニュースデータがまだありません。' : ($editLocale === 'en' ? 'No news articles listed yet.' : 'Belum ada berita terdaftar.') }}</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Seksi Konten Landing Page (Status Integrasi 1:1) -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h3 class="font-bold text-base text-slate-900">{{ $editLocale === 'ja' ? '各セクションの接続状況' : ($editLocale === 'en' ? 'Landing Page Section Status' : 'Status Seksi Landing Page') }}</h3>
                            <span class="text-[11px] font-mono text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full font-bold">100% {{ $editLocale === 'ja' ? '連携完了' : ($editLocale === 'en' ? 'Connected' : 'Terhubung') }}</span>
                        </div>
                        <div class="space-y-2.5 text-xs">
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-base">🎬</span>
                                    <div>
                                        <span class="font-bold text-slate-900 block">1. {{ $editLocale === 'ja' ? 'ヒーロービジュアル＆動画スライダー' : ($editLocale === 'en' ? 'Hero Visual & Video Slider' : 'Hero Visual & Video Slider') }}</span>
                                        <span class="text-[10px] text-slate-500">{{ $stats['hero_slides_count'] }} {{ $editLocale === 'ja' ? '枚のスライド' : 'slide aktif' }} &bull; {{ $editLocale === 'ja' ? '背景動画対応' : 'Video background didukung' }}</span>
                                    </div>
                                </div>
                                <button @click="currentTab = 'hero'" class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 font-bold text-[11px] text-slate-700 hover:border-musashi-red hover:text-musashi-red">{{ $editLocale === 'ja' ? '管理' : ($editLocale === 'en' ? 'Manage' : 'Kelola') }}</button>
                            </div>

                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-base">📰</span>
                                    <div>
                                        <span class="font-bold text-slate-900 block">2. {{ $editLocale === 'ja' ? 'ニュースカルーセル＆モーダルリーダー' : ($editLocale === 'en' ? 'News Carousel & Modal Reader' : 'News Carousel & Modal Reader') }}</span>
                                        <span class="text-[10px] text-slate-500">{{ $stats['total_news'] }} {{ $editLocale === 'ja' ? '件の記事' : 'rilis pers' }} &bull; {{ $editLocale === 'ja' ? '最大10枚以上の複数写真対応' : 'Multi-upload foto hingga 10+' }}</span>
                                    </div>
                                </div>
                                <button @click="currentTab = 'news'" class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 font-bold text-[11px] text-slate-700 hover:border-musashi-red hover:text-musashi-red">{{ $editLocale === 'ja' ? '管理' : ($editLocale === 'en' ? 'Manage' : 'Kelola') }}</button>
                            </div>

                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-base">🌐</span>
                                    <div>
                                        <span class="font-bold text-slate-900 block">3. {{ $editLocale === 'ja' ? '事業紹介＆4つのグローバルピラー' : ($editLocale === 'en' ? 'Business & 4 Global Pillars' : 'Bisnis & 4 Pilar Global') }}</span>
                                        <span class="text-[10px] text-slate-500">Mobility, Industry, Energy, Well-being (3 {{ $editLocale === 'ja' ? '言語' : ($editLocale === 'en' ? 'Languages' : 'Bahasa') }})</span>
                                    </div>
                                </div>
                                <button @click="currentTab = 'pillars'" class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 font-bold text-[11px] text-slate-700 hover:border-musashi-red hover:text-musashi-red">{{ $editLocale === 'ja' ? '管理' : ($editLocale === 'en' ? 'Manage' : 'Kelola') }}</button>
                            </div>

                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-base">⚙️</span>
                                    <div>
                                        <span class="font-bold text-slate-900 block">4. {{ $editLocale === 'ja' ? '製品カタログ＆EVパワートレイン' : ($editLocale === 'en' ? 'Products Catalog & EV Powertrain' : 'Katalog Produk & EV Powertrain') }}</span>
                                        <span class="text-[10px] text-slate-500">{{ $stats['total_products'] }} {{ $editLocale === 'ja' ? '点の製品' : 'komponen' }} &bull; {{ $stats['featured_products'] }} {{ $editLocale === 'ja' ? '主要製品' : 'unggulan' }}</span>
                                    </div>
                                </div>
                                <button @click="currentTab = 'products'" class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 font-bold text-[11px] text-slate-700 hover:border-musashi-red hover:text-musashi-red">{{ $editLocale === 'ja' ? '管理' : ($editLocale === 'en' ? 'Manage' : 'Kelola') }}</button>
                            </div>

                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-base">🔬</span>
                                    <div>
                                        <span class="font-bold text-slate-900 block">5. {{ $editLocale === 'ja' ? '技術力＆スマートモノづくり' : ($editLocale === 'en' ? 'Technology & Smart Monozukuri' : 'Teknologi & Smart Monozukuri') }}</span>
                                        <span class="text-[10px] text-slate-500">{{ $editLocale === 'ja' ? '技術ナラティブ、研究開発、施設ビジュアル' : 'Narasi teknologi, 2 pilar riset, dan visual fasilitas pabrik' }}</span>
                                    </div>
                                </div>
                                <button @click="currentTab = 'technology'" class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 font-bold text-[11px] text-slate-700 hover:border-musashi-red hover:text-musashi-red">{{ $editLocale === 'ja' ? '管理' : ($editLocale === 'en' ? 'Manage' : 'Kelola') }}</button>
                            </div>

                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-base">🏢</span>
                                    <div>
                                        <span class="font-bold text-slate-900 block">6. {{ $editLocale === 'ja' ? '企業概要＆7ピラー (#company)' : ($editLocale === 'en' ? 'Company Profile (#company)' : 'Profil & 7 Pilar Overview (#company)') }}</span>
                                        <span class="text-[10px] text-slate-500">{{ $editLocale === 'ja' ? 'About、トップメッセージ、理念、100年ビジョン、要綱' : 'About, Pesan Direktur, Filosofi, Visi 100 Tahun, Outline' }}</span>
                                    </div>
                                </div>
                                <button @click="currentTab = 'profile'" class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 font-bold text-[11px] text-slate-700 hover:border-musashi-red hover:text-musashi-red">{{ $editLocale === 'ja' ? '管理' : ($editLocale === 'en' ? 'Manage' : 'Kelola') }}</button>
                            </div>

                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-base">🌱</span>
                                    <div>
                                        <span class="font-bold text-slate-900 block">7. {{ $editLocale === 'ja' ? 'サステナビリティ＆ESG (#sustainability)' : ($editLocale === 'en' ? 'Sustainability & ESG (#sustainability)' : 'Keberlanjutan & ESG (#sustainability)') }}</span>
                                        <span class="text-[10px] text-slate-500">{{ $editLocale === 'ja' ? 'カーボンニュートラル、ゼロウェイスト、社会貢献' : 'Net-Zero Carbon, Zero Waste, dan Kontribusi Sosial' }}</span>
                                    </div>
                                </div>
                                <button @click="currentTab = 'sustainability'" class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 font-bold text-[11px] text-slate-700 hover:border-musashi-red hover:text-musashi-red">{{ $editLocale === 'ja' ? '管理' : ($editLocale === 'en' ? 'Manage' : 'Kelola') }}</button>
                            </div>

                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-base">📌</span>
                                    <div>
                                        <span class="font-bold text-slate-900 block">8. {{ $editLocale === 'ja' ? 'フッター＆工場連絡先' : ($editLocale === 'en' ? 'Footer & Factory Contacts' : 'Footer & Kontak Pabrik') }}</span>
                                        <span class="text-[10px] text-slate-500">{{ $editLocale === 'ja' ? 'チカラン＆カラワン工場住所、電話番号、SNSリンク' : 'Alamat Cikarang & Karawang, Phone, dan 4 Link Medsos' }}</span>
                                    </div>
                                </div>
                                <button @click="currentTab = 'footer'" class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 font-bold text-[11px] text-slate-700 hover:border-musashi-red hover:text-musashi-red">{{ $editLocale === 'ja' ? '管理' : ($editLocale === 'en' ? 'Manage' : 'Kelola') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 2: NAVBAR & HEADER NAVIGATION          -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'navbar'" class="space-y-6">
                <form action="{{ route('superadmin.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_tab" value="navbar">
                    <input type="hidden" name="redirect_lang" :value="editLocale">

                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-red-50 text-musashi-red border border-red-200 uppercase">Header & Navigation Control</span>
                                <span class="text-xs font-mono text-slate-400">components/navbar.blade.php</span>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900">{{ $L('tab_navbar') }}</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Kelola logo saturn orbit, nama brand perusahaan, running announcement bar, 6 menu utama, dan semua submenu dropdown (ID / EN / JA).</p>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm transition-all cursor-pointer">
                            💾 Simpan Pengaturan Navbar
                        </button>
                    </div>

                    <!-- 1. Logo Brand & Nama Perusahaan Header -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">1</span>
                                Logo & Nama Brand Header
                            </h4>
                            <span class="text-[11px] font-mono text-slate-400">Bahasa aktif: <span class="font-bold text-slate-700 uppercase" x-text="editLocale"></span></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Brand Header (Nama Perusahaan)</label>
                                <input type="text" name="navbar_brand_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('navbar_brand_title', $editLocale, 'PT. Musashi Auto Parts Indonesia') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-semibold">
                                <span class="text-[10px] text-slate-400 mt-1 block">Teks brand yang tampil di samping logo Saturn Orbit di navbar.</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Logo Navbar (Upload Gambar)</label>
                                <input type="file" name="navbar_logo_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:font-semibold">
                                <span class="text-[10px] text-slate-400 mt-1 block">Logo saat ini: <code class="font-mono text-slate-600">{{ \App\Models\LandingPageSetting::get('navbar_logo', 'images/business/musashi-white-logo.png', false) }}</code></span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Top Announcement Bar (Banner Pengumuman Header) -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">2</span>
                                Top Announcement Bar (Banner Atas)
                            </h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Status Banner</label>
                                <select name="announcement_bar_enabled" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-semibold">
                                    <option value="1" {{ \App\Models\LandingPageSetting::get('announcement_bar_enabled', '0', false) === '1' ? 'selected' : '' }}>✅ Aktif / Tayangkan</option>
                                    <option value="0" {{ \App\Models\LandingPageSetting::get('announcement_bar_enabled', '0', false) !== '1' ? 'selected' : '' }}>❌ Nonaktif / Sembunyikan</option>
                                </select>
                                <span class="text-[10px] text-slate-400 mt-1 block">Tampilkan banner bar tipis di bagian atas landing page.</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Pengumuman (Bahasa: {{ strtoupper($editLocale) }})</label>
                                <input type="text" name="announcement_bar_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('announcement_bar_text', $editLocale, 'Welcome to PT. Musashi Auto Parts Indonesia Official Portal.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                <span class="text-[10px] text-slate-400 mt-1 block">Pesan pengumuman atau sorotan korporat.</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Tautan URL Opsional (Link)</label>
                                <input type="text" name="announcement_bar_link" value="{{ \App\Models\LandingPageSetting::get('announcement_bar_link', '', false) }}" placeholder="https://..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-mono">
                                <span class="text-[10px] text-slate-400 mt-1 block">Kosongkan jika teks tidak bisa diklik.</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Enam Menu Utama Navigasi Navbar -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">3</span>
                                Label 6 Menu Navigasi Utama (Desktop & Mobile)
                            </h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Label tombol menu horizontal yang tampil di bagian tengah navbar dan drawer mobile.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Menu 1: Perusahaan (Dropdown)</label>
                                <input type="text" name="nav_company_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_company', $editLocale, __('messages.nav.company')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Menu 2: Produk (#products)</label>
                                <input type="text" name="nav_product_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_product', $editLocale, __('messages.nav.product')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Menu 3: Bisnis (Dropdown & #business)</label>
                                <input type="text" name="nav_business_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_business', $editLocale, __('messages.nav.business')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Menu 4: Berita (#news)</label>
                                <input type="text" name="nav_news_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_news', $editLocale, __('messages.nav.news')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Menu 5: Keberlanjutan (#sustainability)</label>
                                <input type="text" name="nav_sustainability_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_sustainability', $editLocale, __('messages.nav.sustainability')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Menu 6: Karir (Tombol Tautan)</label>
                                <input type="text" name="nav_careers_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_careers', $editLocale, __('messages.nav.careers')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Tautan URL Portal Karir (Target Eksternal)</label>
                                <input type="text" name="nav_careers_link" value="{{ \App\Models\LandingPageSetting::get('nav_careers_link', 'https://career.musashi.co.id/', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-mono">
                                <span class="text-[10px] text-slate-400 mt-1 block">URL situs karir resmi saat menu Karir diklik (default: https://career.musashi.co.id/).</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Submenu Dropdown Menu Perusahaan (Company Dropdown) -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">4</span>
                                Submenu Dropdown Perusahaan (Company)
                            </h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Semua 7 item yang tampil ketika pengunjung mengklik atau mengarahkan kursor ke menu Perusahaan.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">1. Tentang Kami (#company-about)</label>
                                <input type="text" name="nav_about_us_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_about_us', $editLocale, __('messages.nav.about_us')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">2. Pesan Perusahaan (#company-message)</label>
                                <input type="text" name="nav_corporate_message_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_corporate_message', $editLocale, __('messages.nav.corporate_message')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">3. Filosofi Musashi (#company-philosophy)</label>
                                <input type="text" name="nav_philosophy_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_philosophy', $editLocale, __('messages.nav.philosophy')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">4. Visi Global (#company-vision)</label>
                                <input type="text" name="nav_global_vision_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_global_vision', $editLocale, __('messages.nav.global_vision')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">5. Garis Besar (#company-outline)</label>
                                <input type="text" name="nav_company_outline_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_company_outline', $editLocale, __('messages.nav.company_outline')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">6. Dewan Direksi BOD (#company-bod)</label>
                                <input type="text" name="nav_bod_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_bod', $editLocale, __('messages.nav.bod')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">7. Jaringan Global (#company-network)</label>
                                <input type="text" name="nav_network_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_network', $editLocale, __('messages.nav.network')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                        </div>
                    </div>

                    <!-- 5. Submenu Dropdown Menu Bisnis (Business Dropdown) -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">5</span>
                                Submenu Dropdown Bisnis (Business)
                            </h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">3 item submenu yang tampil saat mengklik/hover dropdown menu Bisnis.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">1. Kompetensi Inti (#business)</label>
                                <input type="text" name="nav_core_competence_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_core_competence', $editLocale, __('messages.nav.core_competence')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">2. Teknologi (#technology)</label>
                                <input type="text" name="nav_technology_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_technology', $editLocale, __('messages.nav.technology')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">3. Inovasi (#innovation)</label>
                                <input type="text" name="nav_innovation_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('nav_innovation', $editLocale, __('messages.nav.innovation')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md cursor-pointer transition-all">
                            💾 Simpan Semua Pengaturan Navbar & Navigasi
                        </button>
                    </div>
                </form>
            </div>

            <!-- ========================================== -->
            <!-- TAB: NEWS MANAGEMENT                       -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'news'" class="space-y-6">
                <!-- Action Header -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Daftar Berita & Siaran Pers</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Kelola artikel berita yang tampil pada seksi 'NEWS & TOPICS' di landing page.</p>
                    </div>
                    <button 
                        @click="showCreateNews = !showCreateNews" 
                        type="button" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span x-text="showCreateNews ? '{{ $L('close_form') }}' : '{{ $L('add_news') }}'"></span>
                    </button>
                </div>

                <!-- Pengaturan Tampilan Header Seksi Berita Landing Page (#news) -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                    <form action="{{ route('superadmin.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="redirect_tab" value="news">
                        <input type="hidden" name="redirect_lang" :value="editLocale">

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">Pengaturan Header Seksi Berita di Landing Page (#news)</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Bahasa Aktif: <strong class="uppercase text-musashi-red" x-text="editLocale"></strong></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Seksi Berita</label>
                                <input type="text" name="news_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('news_badge', $editLocale, __('messages.nav.news')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black" placeholder="Contoh: BERITA & PUBLIKASI">
                                <span class="text-[10px] text-slate-400 mt-1 block">Badge kecil di atas judul seksi berita.</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Seksi Berita</label>
                                <input type="text" name="news_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('news_title', $editLocale, __('messages.news_section.title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold" placeholder="Contoh: Siaran Pers & Berita Terkini">
                                <span class="text-[10px] text-slate-400 mt-1 block">Headline besar seksi berita di beranda.</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol Lihat Semua</label>
                                <input type="text" name="news_view_all_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('news_view_all_text', $editLocale, __('messages.news_section.view_all')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black" placeholder="Contoh: Lihat Semua Berita">
                                <span class="text-[10px] text-slate-400 mt-1 block">Teks tombol pojok kanan seksi berita.</span>
                            </div>
                        </div>

                        <div class="flex justify-end pt-1">
                            <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer">
                                💾 Simpan Header Berita
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Form Tambah Berita Baru (Alpine Expandable) -->
                <div x-show="showCreateNews" x-transition class="bg-white border-2 border-red-200 rounded-2xl p-6 sm:p-8 shadow-md">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                        <h4 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                            {{ $editLocale === 'ja' ? '新規ニュース追加フォーム' : ($editLocale === 'en' ? 'Add New News Article Form' : 'Formulir Tambah Berita Baru') }}
                        </h4>
                        <button @click="showCreateNews = false" class="text-xs text-slate-400 hover:text-black">{{ $L('cancel') }}</button>
                    </div>

                    <form action="{{ route('superadmin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="md:col-span-2">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1.5 font-bold">{{ $editLocale === 'ja' ? 'ニュースタイトル *' : ($editLocale === 'en' ? 'News Title *' : 'Judul Berita *') }}</label>
                                <input type="text" name="title" required placeholder="{{ $editLocale === 'ja' ? '例: PT Musashi 新型e-Axle生産ラインをカラワン工場に新設' : ($editLocale === 'en' ? 'E.g., PT Musashi Inaugurates New e-Axle Facility in Karawang' : 'Contoh: PT Musashi Resmikan Fasilitas e-Axle Baru di Karawang') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1.5 font-bold">{{ $editLocale === 'ja' ? 'カテゴリー *' : ($editLocale === 'en' ? 'Category *' : 'Kategori *') }}</label>
                                <select name="category" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs">
                                    <option value="Corporate">Corporate</option>
                                    <option value="Product">Product & Technology</option>
                                    <option value="Sustainability">Sustainability & CSR</option>
                                    <option value="Innovation">Innovation & EV</option>
                                    <option value="Monozukuri">Monozukuri & Facility</option>
                                </select>
                            </div>
                        </div>

                        <!-- Realtime Upload Date Selector (Waktu Sekarang & Pilihan Tanggal) -->
                        <div class="p-4 bg-red-50/60 border border-red-200/80 rounded-2xl">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                <label class="text-[11px] font-mono text-slate-900 uppercase font-bold flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-musashi-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ $editLocale === 'ja' ? '公開日時 / アップロード日時 (リアルタイム) *' : ($editLocale === 'en' ? 'Publish / Upload Date (Realtime) *' : 'Tanggal Upload / Terbit Berita (Realtime) *') }}</span>
                                </label>
                                <span class="text-[10px] text-slate-500 font-mono">
                                    ⏱ {{ $editLocale === 'ja' ? '自動で現在時刻がセットされます（手動変更可能）' : ($editLocale === 'en' ? 'Defaults to current time (customizable)' : 'Otomatis terisi waktu sekarang saat upload (bisa diubah)') }}
                                </span>
                            </div>
                            <input type="datetime-local" name="published_at" value="{{ now()->format('Y-m-d\TH:i') }}" required class="w-full sm:w-80 bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-xs text-black font-mono focus:outline-none focus:border-musashi-red shadow-2xs">
                            <p class="text-[10px] text-slate-500 mt-1.5">
                                📌 <strong>{{ $editLocale === 'ja' ? '表示先:' : ($editLocale === 'en' ? 'Notice:' : 'Catatan:') }}</strong> {{ $editLocale === 'ja' ? 'この日付がランディングページのニュースカードおよび詳細ポップアップにリアルタイムで表示されます。' : ($editLocale === 'en' ? 'This date will appear in realtime on the landing page news cards and popup reader.' : 'Tanggal ini yang langsung muncul di kartu berita & foto di tampilan landing page.') }}
                            </p>
                        </div>

                        <div>
                            <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1.5 font-bold">{{ $editLocale === 'ja' ? '要約 (Excerpt)' : ($editLocale === 'en' ? 'Short Excerpt' : 'Ringkasan Singkat (Excerpt)') }}</label>
                            <textarea name="excerpt" rows="2" placeholder="{{ $editLocale === 'ja' ? 'ランディングページプレビュー用の要約文...' : ($editLocale === 'en' ? 'Short 1-2 sentence excerpt for landing page preview...' : 'Ringkasan 1-2 kalimat untuk preview di landing page...') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs"></textarea>
                        </div>

                        <div>
                            <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1.5 font-bold">{{ $editLocale === 'ja' ? '記事本文全文 *' : ($editLocale === 'en' ? 'Full Article Content *' : 'Konten Artikel Lengkap *') }}</label>
                            <textarea name="content" rows="6" required placeholder="{{ $editLocale === 'ja' ? 'ニュースの本文をここに入力してください...' : ($editLocale === 'en' ? 'Write the full news article content here...' : 'Tuliskan isi berita lengkap di sini...') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black focus:outline-none focus:border-musashi-red shadow-xs"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1.5 font-bold flex items-center justify-between">
                                    <span>{{ $editLocale === 'ja' ? 'ニュース写真アップロード (1〜10枚以上対応) *' : ($editLocale === 'en' ? 'Upload News Photos (1 to 10+ photos) *' : 'Upload Foto Berita (Bisa 1 s/d 10+ Foto) *') }}</span>
                                    <span class="text-musashi-red text-[10px] font-bold">Multi-Upload Didukung</span>
                                </label>
                                <input type="file" 
                                       multiple 
                                       accept="image/*" 
                                       @change="async (e) => {
                                           isCompressingPhotos = true;
                                           const files = Array.from(e.target.files || []);
                                           for (const f of files) {
                                               const res = await window.compressFileToDataUrl(f);
                                               if (res) createNewsPhotos.push(res);
                                           }
                                           e.target.value = '';
                                           isCompressingPhotos = false;
                                       }"
                                       class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-musashi-red hover:file:bg-red-100 cursor-pointer border border-slate-200 rounded-xl p-1.5 bg-white">
                                <span class="text-[10px] text-slate-500 block mt-1.5">
                                    💡 <strong>Tips:</strong> Anda bisa memilih <strong>1, 3, 5, bahkan 10 foto sekaligus</strong>. Foto pertama (#1) otomatis menjadi sampul cover, dan foto lainnya menjadi galeri artikel.
                                </span>

                                <!-- Loading / Optimizing Indicator -->
                                <div x-show="isCompressingPhotos" style="display: none;" class="mt-2 text-xs font-mono text-musashi-red flex items-center gap-1.5 animate-pulse">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                    <span>Memproses & mengoptimalkan foto...</span>
                                </div>

                                <!-- Preview Grid with Red 'X' Delete Button on Top Right -->
                                <div x-show="createNewsPhotos.length > 0" class="mt-3 p-3.5 bg-red-50/50 border border-red-200/80 rounded-2xl space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-mono text-slate-800 uppercase font-bold flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-musashi-red" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>
                                            <span>Foto Terpilih (<span x-text="createNewsPhotos.length"></span> Foto) — Klik <span class="text-musashi-red font-bold">X</span> untuk menghapus:</span>
                                        </span>
                                        <button type="button" @click="createNewsPhotos = []" class="text-[10px] text-red-600 hover:text-red-800 font-mono font-bold hover:underline">Hapus Semua</button>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <template x-for="(pic, idx) in createNewsPhotos" :key="idx">
                                            <div class="relative w-20 h-20 rounded-xl overflow-visible border-2 border-slate-300 bg-white shadow-xs group">
                                                <div class="w-full h-full rounded-[10px] overflow-hidden">
                                                    <img :src="pic" class="w-full h-full object-cover">
                                                </div>
                                                <!-- Red Circle 'X' Button on Top Right -->
                                                <button type="button" 
                                                        @click="createNewsPhotos.splice(idx, 1)" 
                                                        title="Hapus / batalkan foto ini"
                                                        class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-115 cursor-pointer border-2 border-white z-20">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                                <span class="absolute bottom-0 inset-x-0 bg-black/80 text-white text-[9px] font-mono text-center py-0.5 rounded-b-[9px]" x-text="idx === 0 ? '#1 Cover' : '#' + (idx + 1)"></span>
                                                <input type="hidden" name="new_data_images[]" :value="pic">
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 pt-2">
                                <label class="flex items-center gap-2.5 cursor-pointer">
                                    <input type="checkbox" name="is_published" value="1" checked class="rounded border-slate-300 text-musashi-red focus:ring-0">
                                    <span class="text-xs font-bold text-slate-900">{{ $editLocale === 'ja' ? 'ランディングページに即時公開する' : ($editLocale === 'en' ? 'Publish immediately to Landing Page' : 'Langsung Terbitkan ke Landing Page (Tayang)') }}</span>
                                </label>
                                <label class="flex items-center gap-2.5 cursor-pointer">
                                    <input type="checkbox" name="is_featured" value="1" class="rounded border-slate-300 text-musashi-red focus:ring-0">
                                    <span class="text-xs font-semibold text-slate-700">{{ $editLocale === 'ja' ? '主要ニュース (Featured) に指定' : ($editLocale === 'en' ? 'Set as Featured Article' : 'Jadikan Berita Utama / Sorotan (Featured)') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <button type="button" @click="showCreateNews = false" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ $L('cancel') }}</button>
                            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm">
                                🚀 {{ $editLocale === 'ja' ? '今すぐニュースを公開' : ($editLocale === 'en' ? 'Publish News Now' : 'Terbitkan Berita Sekarang') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- News Items Table -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-[11px] font-mono uppercase text-slate-500 border-b border-slate-200">
                                <tr>
                                    <th class="py-3.5 px-4">{{ $editLocale === 'ja' ? '写真' : ($editLocale === 'en' ? 'Photo Gallery' : 'Foto Galeri') }}</th>
                                    <th class="py-3.5 px-4">{{ $editLocale === 'ja' ? 'タイトル & カテゴリ' : ($editLocale === 'en' ? 'Title & Category' : 'Judul & Kategori') }}</th>
                                    <th class="py-3.5 px-4">{{ $editLocale === 'ja' ? '公開日時 (Realtime)' : ($editLocale === 'en' ? 'Publish Date (Realtime)' : 'Tanggal Rilis (Realtime)') }}</th>
                                    <th class="py-3.5 px-4 text-center">{{ $editLocale === 'ja' ? '公開状況' : ($editLocale === 'en' ? 'Publish Status' : 'Status Tayang') }}</th>
                                    <th class="py-3.5 px-4 text-right">{{ $editLocale === 'ja' ? '操作' : ($editLocale === 'en' ? 'Actions' : 'Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($newsList as $news)
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="py-3 px-4 w-28">
                                            <div class="relative inline-block">
                                                <img src="{{ ($news->image && (str_starts_with($news->image, 'http') || str_starts_with($news->image, 'data:'))) ? $news->image : asset($news->image ?: 'images/hero/hero-automotive.jpg') }}" alt="" class="w-16 h-12 object-cover rounded-lg border border-slate-200 shadow-xs" onerror="this.onerror=null; this.src='/images/hero/hero-automotive.jpg';">
                                                @if(count($news->all_images) > 1)
                                                    <span class="absolute -bottom-1.5 -right-1.5 px-1.5 py-0.5 rounded-full text-[9px] font-mono font-bold bg-musashi-red text-white shadow-xs">
                                                        +{{ count($news->all_images) }} foto
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-musashi-red transition-colors block line-clamp-1">
                                                {{ $news->title }}
                                            </a>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-700">{{ $news->category }}</span>
                                                <span class="text-[10px] text-slate-400 font-mono">/news/{{ $news->slug }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 font-mono text-slate-600 whitespace-nowrap">
                                            <div class="font-bold text-slate-800">{{ $news->published_at ? $news->published_at->format('Y.m.d') : $news->created_at->format('Y.m.d') }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $news->published_at ? $news->published_at->format('H:i') . ' WIB' : $news->created_at->format('H:i') . ' WIB' }}</div>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <form action="{{ route('superadmin.news.toggle', $news) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase transition-colors {{ $news->published_at ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200 border border-slate-200' }}">
                                                    {{ $news->published_at ? ($editLocale === 'ja' ? '✓ 公開中' : ($editLocale === 'en' ? '✓ Published' : '✓ Tayang')) : 'Draft' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="py-3 px-4 text-right space-x-1 whitespace-nowrap">
                                            <button 
                                                @click="editingNews = JSON.parse(JSON.stringify({{ json_encode($news) }})); editNewPhotos = [];" 
                                                class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                                                {{ $editLocale === 'ja' ? '編集' : ($editLocale === 'en' ? 'Edit' : 'Edit') }}
                                            </button>
                                            <form action="{{ route('superadmin.news.destroy', $news) }}" method="POST" class="inline" onsubmit="return confirm('{{ $editLocale === 'ja' ? 'このニュースを完全に削除してもよろしいですか？' : ($editLocale === 'en' ? 'Are you sure you want to permanently delete this news?' : 'Yakin ingin menghapus berita ini secara permanen?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 font-bold text-xs transition-colors">
                                                    {{ $editLocale === 'ja' ? '削除' : ($editLocale === 'en' ? 'Delete' : 'Hapus') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-400 text-xs">
                                            {{ $editLocale === 'ja' ? 'ニュースはまだありません。上の「+ 新しいニュースを追加」をクリックしてください。' : ($editLocale === 'en' ? 'No news yet. Click "+ Add New Article" above to create one!' : 'Belum ada berita. Klik tombol "+ Tambah Berita Baru" di atas untuk menambahkan!') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Edit Berita -->
                <div x-show="editingNews !== null" style="display: none;" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
                    <div @click.away="editingNews = null" class="bg-white rounded-2xl max-w-2xl w-full p-6 sm:p-8 space-y-5 max-h-[90vh] overflow-y-auto shadow-2xl">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                            <h4 class="text-base font-extrabold text-slate-900">
                                {{ $editLocale === 'ja' ? 'ニュースと写真ギャラリーの編集' : ($editLocale === 'en' ? 'Edit News & Photo Gallery' : 'Edit Berita & Galeri Foto') }}
                            </h4>
                            <button @click="editingNews = null" class="text-slate-400 hover:text-black text-xl font-bold">&times;</button>
                        </div>
                        <template x-if="editingNews">
                            <form :action="'/SuperadminMusashi/news/' + editingNews.id + '/update'" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">
                                        {{ $editLocale === 'ja' ? 'ニュースのタイトル' : ($editLocale === 'en' ? 'News Title' : 'Judul Berita') }}
                                    </label>
                                    <input type="text" name="title" :value="editingNews.title" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">
                                            {{ $editLocale === 'ja' ? 'カテゴリ' : ($editLocale === 'en' ? 'Category' : 'Kategori') }}
                                        </label>
                                        <input type="text" name="category" :value="editingNews.category" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">
                                            {{ $editLocale === 'ja' ? '公開日時 (Realtime)' : ($editLocale === 'en' ? 'Publish Date & Time (Realtime)' : 'Tanggal & Jam Rilis (Realtime)') }}
                                        </label>
                                        <input type="datetime-local" name="published_at" :value="editingNews.published_at_input" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-slate-800 font-mono">
                                        <span class="text-[10px] text-slate-400 block mt-1">
                                            {{ $editLocale === 'ja' ? 'ランディングページに表示されるリアルタイム日時' : ($editLocale === 'en' ? 'Realtime date & time shown on landing page' : 'Tanggal & waktu realtime yang muncul di landing page') }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">
                                        {{ $editLocale === 'ja' ? '新しい写真の追加 / アップロード (複数可)' : ($editLocale === 'en' ? 'Upload / Add New Photos (Multiple)' : 'Upload / Tambah Foto Baru (Bisa Banyak)') }}
                                    </label>
                                    <input type="file" 
                                           multiple 
                                           accept="image/*" 
                                           @change="async (e) => {
                                               isCompressingPhotos = true;
                                               const files = Array.from(e.target.files || []);
                                               for (const f of files) {
                                                   const res = await window.compressFileToDataUrl(f);
                                                   if (res) editNewPhotos.push(res);
                                               }
                                               e.target.value = '';
                                               isCompressingPhotos = false;
                                           }"
                                           class="w-full text-xs text-slate-500 border border-slate-200 rounded-xl p-1 bg-white file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-musashi-red hover:file:bg-red-100 cursor-pointer">
                                    <span class="text-[10px] text-slate-400 block mt-1">
                                        {{ $editLocale === 'ja' ? '複数の写真を一度に選択できます（最大10枚）' : ($editLocale === 'en' ? 'Can select multiple photos at once (up to 10 photos).' : 'Bisa pilih beberapa foto sekaligus (hingga 10 foto).') }}
                                    </span>

                                    <!-- Loading indicator -->
                                    <div x-show="isCompressingPhotos" style="display: none;" class="mt-1.5 text-xs font-mono text-musashi-red flex items-center gap-1.5 animate-pulse">
                                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                        <span>Memproses & mengoptimalkan foto baru...</span>
                                    </div>

                                    <!-- Preview of Newly Added Photos with 'X' button -->
                                    <div x-show="editNewPhotos.length > 0" class="mt-2.5 p-3 bg-red-50/60 border border-red-200 rounded-xl space-y-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-[11px] font-mono text-slate-800 uppercase font-bold flex items-center gap-1">
                                                <span class="text-musashi-red">+ Foto Baru yang Dipilih</span> (<span x-text="editNewPhotos.length"></span> foto) — Klik tanda <span class="text-musashi-red font-bold">X</span> untuk membatalkan:
                                            </span>
                                            <button type="button" @click="editNewPhotos = []" class="text-[10px] text-red-600 hover:text-red-800 font-mono font-bold hover:underline">Batalkan Semua</button>
                                        </div>
                                        <div class="flex flex-wrap gap-3">
                                            <template x-for="(npic, nidx) in editNewPhotos" :key="'new_'+nidx">
                                                <div class="relative w-20 h-20 rounded-xl overflow-visible border-2 border-red-300 bg-white shadow-xs group">
                                                    <div class="w-full h-full rounded-[10px] overflow-hidden">
                                                        <img :src="npic" class="w-full h-full object-cover">
                                                    </div>
                                                    <!-- Delete 'X' Button on Top Right -->
                                                    <button type="button" 
                                                            @click="editNewPhotos.splice(nidx, 1)" 
                                                            title="Batalkan foto baru ini"
                                                            class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-115 cursor-pointer border-2 border-white z-20">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    </button>
                                                    <span class="absolute bottom-0 inset-x-0 bg-red-600/90 text-white text-[8px] font-mono text-center py-0.5 rounded-b-[9px]">Baru</span>
                                                    <input type="hidden" name="new_data_images[]" :value="npic">
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden input to submit updated list of retained existing photos -->
                                <input type="hidden" name="has_existing_images_list" value="1">
                                <input type="hidden" name="existing_images_json" :value="JSON.stringify(editingNews.all_images || [])">

                                <!-- Current Photos Preview in Edit Modal with Red 'X' Delete Button -->
                                <div x-show="editingNews.all_images && editingNews.all_images.length" class="p-3.5 bg-slate-50 border border-slate-200 rounded-xl space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-mono text-slate-700 uppercase font-bold block">
                                            {{ $editLocale === 'ja' ? '現在設定されている写真' : ($editLocale === 'en' ? 'Current Photos' : 'Foto Saat Ini Terpasang') }} (<span x-text="editingNews.all_images.length"></span> {{ $editLocale === 'ja' ? '枚' : 'Foto' }}):
                                        </span>
                                        <span class="text-[10px] text-slate-500 font-mono">
                                            💡 Klik tanda <strong class="text-red-600 font-bold">X merah</strong> pada foto untuk menghapus foto itu
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <template x-for="(pic, pidx) in editingNews.all_images" :key="pidx">
                                            <div class="relative w-20 h-20 rounded-xl overflow-visible border-2 border-slate-200 bg-white shadow-xs group">
                                                <div class="w-full h-full rounded-[10px] overflow-hidden bg-slate-100 flex items-center justify-center">
                                                    <img :src="pic" 
                                                         class="w-full h-full object-cover"
                                                         onerror="this.onerror=null; this.src='/images/hero/hero-automotive.jpg'; this.classList.add('opacity-40');">
                                                </div>
                                                <!-- Red Circle 'X' Button on Top Right -->
                                                <button type="button" 
                                                        @click="editingNews.all_images.splice(pidx, 1)" 
                                                        title="Hapus foto ini dari berita"
                                                        class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-115 cursor-pointer border-2 border-white z-20">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                                <span class="absolute bottom-0 inset-x-0 bg-black/75 text-white text-[9px] font-mono text-center py-0.5 rounded-b-[9px]" x-text="pidx === 0 ? '#1 Cover' : '#' + (pidx + 1)"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">
                                        {{ $editLocale === 'ja' ? '要約 (Excerpt)' : ($editLocale === 'en' ? 'Summary (Excerpt)' : 'Ringkasan (Excerpt)') }}
                                    </label>
                                    <textarea name="excerpt" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black" x-text="editingNews.excerpt"></textarea>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">
                                        {{ $editLocale === 'ja' ? 'ニュース本文' : ($editLocale === 'en' ? 'News Content' : 'Isi Konten Berita') }}
                                    </label>
                                    <textarea name="content" rows="6" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black" x-text="editingNews.content"></textarea>
                                </div>
                                <div>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="is_published" value="1" :checked="editingNews.published_at !== null" class="rounded border-slate-300 text-musashi-red">
                                        <span class="text-xs font-bold text-slate-900">
                                            {{ $editLocale === 'ja' ? 'ニュースを公開する（ランディングページに表示）' : ($editLocale === 'en' ? 'Publish News (Show on Landing Page)' : 'Publikasikan Berita (Tayang di Landing Page)') }}
                                        </span>
                                    </label>
                                </div>
                                <div class="pt-4 border-t border-slate-200 flex justify-end gap-2">
                                    <button type="button" @click="editingNews = null" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ $L('cancel') }}</button>
                                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm">{{ $L('save_changes') }}</button>
                                </div>
                            </form>
                        </template>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 3: PROFIL PERUSAHAAN (ABOUT US)       -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'profile'" class="space-y-6">
                <form action="{{ route('superadmin.update') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_tab" value="profile">
                    <input type="hidden" name="redirect_subtab" :value="profileSubTab">
                    <input type="hidden" name="redirect_lang" :value="editLocale">

                    
                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase bg-red-100 text-musashi-red border border-red-200">
                                    Bahasa Aktif: {{ strtoupper($editLocale) }}
                                </span>
                                <span class="text-xs text-slate-400 font-mono">(7 Modul Profil Perusahaan)</span>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900">Pusat Pengaturan Profil Perusahaan (Company Profile Hub)</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Kelola seluruh 7 bagian profil perusahaan mulai dari Tentang Kami, Pesan Korporat, Filosofi, Visi 2038, Garis Besar, Dewan Direksi, hingga Jaringan Global.</p>
                        </div>
                        <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer flex items-center gap-2">
                            <span>💾 Simpan Semua Profil</span>
                        </button>
                    </div>

                    <!-- 7-Section Interactive Sub-Tab Navigator -->
                    <div class="bg-white p-2 sm:p-2.5 rounded-2xl border border-slate-200 shadow-xs sticky top-20 z-30 backdrop-blur-md bg-white/95">
                        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 scrollbar-thin">
                            <!-- SubTab 1: About Us -->
                            <button type="button" 
                                    @click="profileSubTab = 'about'" 
                                    :class="profileSubTab === 'about' ? 'bg-musashi-red text-white shadow-xs font-bold' : 'text-slate-600 hover:text-black hover:bg-slate-100 font-semibold'" 
                                    class="px-3.5 py-2.5 rounded-xl text-xs whitespace-nowrap transition-all flex items-center gap-2 cursor-pointer flex-shrink-0">
                                <span>🏢 1. About Us</span>
                            </button>

                            <!-- SubTab 2: Corporate Message -->
                            <button type="button" 
                                    @click="profileSubTab = 'message'" 
                                    :class="profileSubTab === 'message' ? 'bg-musashi-red text-white shadow-xs font-bold' : 'text-slate-600 hover:text-black hover:bg-slate-100 font-semibold'" 
                                    class="px-3.5 py-2.5 rounded-xl text-xs whitespace-nowrap transition-all flex items-center gap-2 cursor-pointer flex-shrink-0">
                                <span>📜 2. Corporate Message</span>
                            </button>

                            <!-- SubTab 3: Philosophy -->
                            <button type="button" 
                                    @click="profileSubTab = 'philosophy'" 
                                    :class="profileSubTab === 'philosophy' ? 'bg-musashi-red text-white shadow-xs font-bold' : 'text-slate-600 hover:text-black hover:bg-slate-100 font-semibold'" 
                                    class="px-3.5 py-2.5 rounded-xl text-xs whitespace-nowrap transition-all flex items-center gap-2 cursor-pointer flex-shrink-0">
                                <span>🏮 3. Philosophy</span>
                            </button>

                            <!-- SubTab 4: Global Vision -->
                            <button type="button" 
                                    @click="profileSubTab = 'vision'" 
                                    :class="profileSubTab === 'vision' ? 'bg-musashi-red text-white shadow-xs font-bold' : 'text-slate-600 hover:text-black hover:bg-slate-100 font-semibold'" 
                                    class="px-3.5 py-2.5 rounded-xl text-xs whitespace-nowrap transition-all flex items-center gap-2 cursor-pointer flex-shrink-0">
                                <span>🌟 4. Global Vision</span>
                            </button>

                            <!-- SubTab 5: Company Outline -->
                            <button type="button" 
                                    @click="profileSubTab = 'outline'" 
                                    :class="profileSubTab === 'outline' ? 'bg-musashi-red text-white shadow-xs font-bold' : 'text-slate-600 hover:text-black hover:bg-slate-100 font-semibold'" 
                                    class="px-3.5 py-2.5 rounded-xl text-xs whitespace-nowrap transition-all flex items-center gap-2 cursor-pointer flex-shrink-0">
                                <span>📊 5. Company Outline</span>
                            </button>

                            <!-- SubTab 6: Board of Directors -->
                            <button type="button" 
                                    @click="profileSubTab = 'directors'" 
                                    :class="profileSubTab === 'directors' ? 'bg-musashi-red text-white shadow-xs font-bold' : 'text-slate-600 hover:text-black hover:bg-slate-100 font-semibold'" 
                                    class="px-3.5 py-2.5 rounded-xl text-xs whitespace-nowrap transition-all flex items-center gap-2 cursor-pointer flex-shrink-0">
                                <span>👥 6. Board of Directors & Kartu</span>
                            </button>

                            <!-- SubTab 7: Jaringan Global (Network) -->
                            <button type="button" 
                                    @click="profileSubTab = 'network'" 
                                    :class="profileSubTab === 'network' ? 'bg-musashi-red text-white shadow-xs font-bold' : 'text-slate-600 hover:text-black hover:bg-slate-100 font-semibold'" 
                                    class="px-3.5 py-2.5 rounded-xl text-xs whitespace-nowrap transition-all flex items-center gap-2 cursor-pointer flex-shrink-0">
                                <span>🌐 7. Jaringan Global (Network)</span>
                            </button>

                            <!-- All Option -->
                            <button type="button" 
                                    @click="profileSubTab = 'all'" 
                                    :class="profileSubTab === 'all' ? 'bg-slate-800 text-white shadow-xs font-bold' : 'text-slate-500 hover:text-black hover:bg-slate-100 font-medium'" 
                                    class="px-3 py-2 rounded-xl text-[11px] whitespace-nowrap transition-all flex items-center gap-1.5 ml-auto border border-dashed border-slate-300 cursor-pointer flex-shrink-0">
                                <span>📑 Tampilkan Semua</span>
                            </button>
                        </div>
                    </div>


                    
                    <!-- ============================================== -->
                    <!-- SUB-TAB 1: ABOUT US (TENTANG KAMI)             -->
                    <!-- ============================================== -->
                    <div x-show="profileSubTab === 'about' || profileSubTab === 'all'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        <!-- 1. Tentang Kami (About Us) -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">1. Halaman Tentang Kami (About Us)</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Tampil di Halaman /company/about-us</span>
                        </div>

                        <!-- 1A. Header Banner & Identitas Utama -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
                            <span class="text-xs font-mono font-bold text-musashi-red block uppercase">🏷️ Header Banner & Identitas Perusahaan</span>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Header Banner</label>
                                    <input type="text" name="about_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('about_badge', $editLocale, 'Company Profile') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Identitas Korporat</label>
                                    <input type="text" name="about_identity_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('about_identity_badge', $editLocale, 'Corporate Identity') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Headline Profil</label>
                                <input type="text" name="about_headline_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('about_headline', $editLocale, 'Break Barriers and Go on Adventures!') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Sub-Headline / Filosofi Pembuka</label>
                                <textarea name="about_sub_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('about_sub', $editLocale, 'According to Musashi\'s Philosophy, for "a world where the earth and people coexist in prosperity and harmony," each one of us became adventurers and we will create a path forward into the future.') }}</textarea>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Narasi Utama Profil</label>
                                <textarea name="about_desc_{{ $editLocale }}" rows="4" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('about_desc', $editLocale, 'Looking to the year 2038, the 100th anniversary of Musashi Seimitsu Industry\'s founding, we break free of limitations to create new value that is not an extension of the present. Through seamless collaboration between our Cikarang and Karawang facilities and global headquarters in Toyohashi, Japan, we remain an indispensable partner for the world\'s premier automotive OEMs.') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Kemitraan (Heritage Title)</label>
                                    <input type="text" name="about_heritage_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('about_heritage_title', $editLocale, 'Heritage & Joint Venture') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Informasi Kemitraan (Heritage / Joint Venture)</label>
                                    <input type="text" name="about_heritage_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('about_heritage', $editLocale, 'Joint venture between Musashi Seimitsu Industry Co., Ltd., Japan (80%) and PT Astra Honda Motor (20%).') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                            </div>
                        </div>

                        <!-- 1B. Bagian Jaringan Pabrik di Halaman About Us -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
                            <span class="text-xs font-mono font-bold text-slate-800 block uppercase">🏭 Bagian Dua Pabrik Indonesia (Manufacturing Network)</span>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Seksi Pabrik</label>
                                    <input type="text" name="about_plants_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('about_plants_badge', $editLocale, 'Manufacturing Network') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Headline Seksi Pabrik</label>
                                    <input type="text" name="about_plants_headline_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('about_plants_headline', $editLocale, 'Two World-Class Indonesian Production Plants') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                                <!-- Pabrik 1 -->
                                <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Pabrik 1: Cikarang (Head Office)</span>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Label Header Card</label>
                                        <input type="text" name="outline_plant1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant1_title', $editLocale, 'Plant 1 - Cikarang (Head Office)') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Nama Lokasi Kawasan</label>
                                        <input type="text" name="outline_plant1_name_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant1_name', $editLocale, 'EJIP Industrial Park, Cikarang Selatan') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Tag Peran Pabrik</label>
                                        <input type="text" name="outline_plant1_tag_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant1_tag', $editLocale, 'Head Office & Plant') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                </div>

                                <!-- Pabrik 2 -->
                                <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Pabrik 2: Karawang Plant</span>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Label Header Card</label>
                                        <input type="text" name="outline_plant2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant2_title', $editLocale, 'Plant 2 - Karawang') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Nama Lokasi Kawasan</label>
                                        <input type="text" name="outline_plant2_name_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant2_name', $editLocale, 'Suryacipta City of Industry, Karawang') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Tag Peran Pabrik</label>
                                        <input type="text" name="outline_plant2_tag_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant2_tag', $editLocale, 'Mass Forging Center') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- Action Toolbar Sub-Tab 1 -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                            <div class="flex items-center gap-2 text-xs text-slate-500 font-mono">
                                <span class="w-2 h-2 rounded-full bg-musashi-red"></span>
                                <span>Bagian 1 dari 6 • Halaman Tentang Kami (/company/about-us)</span>
                            </div>
                            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer flex items-center gap-1.5">
                                    <span>💾 Simpan Tentang Kami</span>
                                </button>
                                <button type="button" @click="profileSubTab = 'message'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                    <span>Lanjut ke 2. Corporate Message →</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    
                    <!-- ============================================== -->
                    <!-- SUB-TAB 2: CORPORATE MESSAGE (PESAN KORPORAT)  -->
                    <!-- ============================================== -->
                    <div x-show="profileSubTab === 'message' || profileSubTab === 'all'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        <!-- 2. Pesan Korporat (Corporate Message) -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">2. Pesan Korporat Presiden Direktur (Top Message)</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Tampil di Halaman /company/corporate-message</span>
                        </div>

                        <!-- 2A. Header Banner & Pesan Utama -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
                            <span class="text-xs font-mono font-bold text-blue-700 block uppercase">📜 Header Banner & Narasi Pesan Korporat</span>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Header Banner</label>
                                    <input type="text" name="message_page_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('message_page_badge', $editLocale, 'Top Message') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Halaman Banner</label>
                                    <input type="text" name="message_page_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('message_page_title', $editLocale, 'Corporate Message') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Sub-Judul Halaman Banner</label>
                                <input type="text" name="message_page_sub_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('message_page_sub', $editLocale, 'A statement from Musashi Leadership on innovation, Monozukuri sincerity, and our 100-Year Global Vision.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Seksi Pesan</label>
                                    <input type="text" name="message_ceo_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('message_ceo_badge', $editLocale, 'CEO Vision & Sincerity') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pesan Direktur</label>
                                    <input type="text" name="message_president_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('message_president_title', $editLocale, 'New Challenge for a Company with a 100-Year History') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                                </div>
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Isi Pesan Korporat Lengkap</label>
                                <textarea name="message_president_body_{{ $editLocale }}" rows="5" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('message_president_body', $editLocale, 'Sincerity in "Monozukuri" and the development of human resources is the origin of the Musashi Group. This philosophy has enabled us to withstand the many challenges that we have faced over our 80+ years of history by anticipating market needs and then developing new and unique technologies to meet those needs.') }}</textarea>
                            </div>
                        </div>

                        <!-- 2B. Blok Tanda Tangan & Pimpinan (Signature Block) -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
                            <span class="text-xs font-mono font-bold text-slate-800 block uppercase">✍️ Blok Tanda Tangan Pimpinan (Signature Block)</span>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Global CEO -->
                                <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-slate-700 uppercase block">Pimpinan Global (Musashi Japan)</span>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Nama Lengkap (Global)</label>
                                        <input type="text" name="message_global_ceo_name" value="{{ \App\Models\LandingPageSetting::get('message_global_ceo_name', 'Hiroshi Otsuka', false) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Jabatan / Titel Resmi</label>
                                        <input type="text" name="message_global_ceo_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('message_global_ceo_title', $editLocale, 'President & CEO, Musashi Seimitsu Industry Co., Ltd.') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                </div>

                                <!-- Indonesia CEO -->
                                <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Pimpinan Musashi Indonesia</span>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Nama Lengkap (Global)</label>
                                        <input type="text" name="message_indo_ceo_name" value="{{ \App\Models\LandingPageSetting::get('message_indo_ceo_name', 'Asep Nugraha', false) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Jabatan / Titel Resmi</label>
                                        <input type="text" name="message_indo_ceo_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('message_indo_ceo_title', $editLocale, 'President Director, PT Musashi Auto Parts Indonesia') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- Action Toolbar Sub-Tab 2 -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                            <button type="button" @click="profileSubTab = 'about'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                <span>← Kembali ke 1. About Us</span>
                            </button>
                            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer flex items-center gap-1.5">
                                    <span>💾 Simpan Pesan Korporat</span>
                                </button>
                                <button type="button" @click="profileSubTab = 'philosophy'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                    <span>Lanjut ke 3. Philosophy →</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    
                    <!-- ============================================== -->
                    <!-- SUB-TAB 3: MUSASHI PHILOSOPHY (FILOSOFI)       -->
                    <!-- ============================================== -->
                    <div x-show="profileSubTab === 'philosophy' || profileSubTab === 'all'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        <!-- 6. Halaman Filosofi Perusahaan (Musashi Philosophy) -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">3. Halaman Filosofi Perusahaan (Musashi Philosophy)</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Tampil di Halaman /company/philosophy & Kartu Filosofi Landing Page</span>
                        </div>

                        <!-- 6A. Header Banner & Intro Komposisi Filosofi -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
                            <span class="text-xs font-mono font-bold text-amber-700 block uppercase">🏮 Header Banner & Struktur Filosofi</span>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Header Banner</label>
                                    <input type="text" name="philosophy_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_badge', $editLocale, 'Corporate Philosophy') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Halaman Banner</label>
                                    <input type="text" name="philosophy_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_title', $editLocale, 'Musashi Philosophy') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Sub-Judul Header Halaman</label>
                                <input type="text" name="philosophy_sub_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_sub', $editLocale, 'The enduring spirit, core purpose, and shared behavioral values that guide all Musashi members worldwide.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Pengantar Komposisi</label>
                                    <input type="text" name="philosophy_intro_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_intro_badge', $editLocale, 'Foundation of Value Creation') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pengantar Komposisi</label>
                                    <input type="text" name="philosophy_intro_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_intro_title', $editLocale, 'Composition of Musashi Philosophy') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>
                            </div>
                        </div>

                        <!-- 6B. Pilar 01 - Our Origin (Semangat Pendirian) -->
                        <div class="p-4 rounded-xl bg-amber-50/50 border border-amber-200/80 space-y-4">
                            <div class="flex items-center justify-between pb-2 border-b border-amber-200/60">
                                <span class="text-xs font-mono font-bold text-amber-800 block uppercase">🌱 01. Our Origin (Semangat Pendirian Musashi)</span>
                                <span class="text-[10px] font-mono text-amber-700">Shisei-Ikkan & Shitsujitsu-Goken</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Bagian</label>
                                    <input type="text" name="philosophy_origin_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_origin_badge', $editLocale, '01. Our Origin') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Origin</label>
                                    <input type="text" name="philosophy_origin_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_origin_title', $editLocale, 'The origins of Musashi, passed down from generation to generation.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Kalimat Pengantar Nilai</label>
                                <input type="text" name="philosophy_origin_lead_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_origin_lead', $editLocale, 'Since our inception, our founding spirit has been anchored in two sacred Japanese tenets:') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Karakter Kanji Kotak Kanan</label>
                                    <input type="text" name="philosophy_origin_kanji" value="{{ \App\Models\LandingPageSetting::get('philosophy_origin_kanji', '至誠', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold font-serif">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Label Teks Kanji Kotak Kanan</label>
                                    <input type="text" name="philosophy_origin_kanji_label_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_origin_kanji_label', $editLocale, 'Founding Spirit') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                                <!-- Tenet 1 -->
                                <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Ajaran 1: Shisei-Ikkan</span>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Kanji & Romaji</label>
                                        <input type="text" name="philosophy_tenet1_kanji_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_tenet1_kanji', $editLocale, '至誠一貫 (Shisei-Ikkan)') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Terjemahan Judul</label>
                                        <input type="text" name="philosophy_tenet1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_tenet1_title', $editLocale, 'Consistent Sincerity') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Penjelasan Makna</label>
                                        <textarea name="philosophy_tenet1_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('philosophy_tenet1_desc', $editLocale, 'Sincerity in Monozukuri manufacturing and genuine honesty toward customers, colleagues, and society.') }}</textarea>
                                    </div>
                                </div>

                                <!-- Tenet 2 -->
                                <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Ajaran 2: Shitsujitsu-Goken</span>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Kanji & Romaji</label>
                                        <input type="text" name="philosophy_tenet2_kanji_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_tenet2_kanji', $editLocale, '質実剛健 (Shitsujitsu-Goken)') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Terjemahan Judul</label>
                                        <input type="text" name="philosophy_tenet2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_tenet2_title', $editLocale, 'Simple and Sturdy') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                    </div>
                                    <div>
                                        <label class="text-[9px] font-mono text-slate-500 uppercase block">Penjelasan Makna</label>
                                        <textarea name="philosophy_tenet2_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('philosophy_tenet2_desc', $editLocale, 'Robust engineering, resilient character, avoiding extravagance, and focusing wholeheartedly on substantive quality.') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6C. Pilar 02 - Our Purpose (Tujuan Keberadaan) -->
                        <div class="p-4 rounded-xl bg-red-50/50 border border-red-200/80 space-y-4">
                            <div class="flex items-center justify-between pb-2 border-b border-red-200/60">
                                <span class="text-xs font-mono font-bold text-musashi-red block uppercase">🌍 02. Our Purpose (Tujuan Keberadaan & Harmoni)</span>
                                <span class="text-[10px] font-mono text-slate-500">Harmony with Lives and Earth</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Bagian</label>
                                    <input type="text" name="philosophy_purpose_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_purpose_badge', $editLocale, '02. Our Purpose') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Kanji Kotak</label>
                                        <input type="text" name="philosophy_purpose_kanji" value="{{ \App\Models\LandingPageSetting::get('philosophy_purpose_kanji', '調和', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold font-serif">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Label Kanji</label>
                                        <input type="text" name="philosophy_purpose_kanji_label_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_purpose_kanji_label', $editLocale, 'Harmony & Earth') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Pernyataan Misi / Kutipan Utama (Our Purpose Quote)</label>
                                <textarea name="philosophy_purpose_quote_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">{{ \App\Models\LandingPageSetting::getForLocale('philosophy_purpose_quote', $editLocale, '"We contribute to enriched Harmony between our lives and Earth, using our Passion for technology and Wisdom for innovation."') }}</textarea>
                            </div>

                            <div>
                                <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Penjelasan Tujuan</label>
                                <textarea name="philosophy_purpose_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('philosophy_purpose_desc', $editLocale, 'Our reason for being is to harness the passion of engineering and the wisdom of collective ingenuity to solve pressing social challenges, promote decarbonization, and elevate mobility for future generations.') }}</textarea>
                            </div>
                        </div>

                        <!-- 6D. Pilar 03 - Our Way (Nilai Perilaku) -->
                        <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-200/80 space-y-4">
                            <div class="flex items-center justify-between pb-2 border-b border-blue-200/60">
                                <span class="text-xs font-mono font-bold text-blue-700 block uppercase">🚀 03. Our Way (Nilai Perilaku & Eksplorasi)</span>
                                <span class="text-[10px] font-mono text-slate-500">Exploration & Exploitation</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Bagian</label>
                                    <input type="text" name="philosophy_way_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_way_badge', $editLocale, '03. Our Way') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Kanji Kotak</label>
                                        <input type="text" name="philosophy_way_kanji" value="{{ \App\Models\LandingPageSetting::get('philosophy_way_kanji', '挑戦', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold font-serif">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Label Kanji</label>
                                        <input type="text" name="philosophy_way_kanji_label_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_way_kanji_label', $editLocale, 'Continuous Challenge') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Nilai Perilaku Utama</label>
                                <input type="text" name="philosophy_way_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_way_title', $editLocale, 'The values each of us hold in our hearts. Moving into the future with Exploration and Exploitation of knowledge.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                            </div>

                            <div>
                                <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Narasi Our Way</label>
                                <textarea name="philosophy_way_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('philosophy_way_desc', $editLocale, 'We balance continuous refinement of our core Monozukuri precision capabilities (Exploitation) while actively taking on fearless new ventures into electric powertrains, AI systems, and green technologies (Exploration).') }}</textarea>
                            </div>
                        </div>

                        <!-- 6E. Lambang & Warna Korporat (Corporate Mark & Colors) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Corporate Mark -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-slate-900 block uppercase">🪐 Lambang Korporat (Corporate Mark)</span>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Seksi Mark</label>
                                    <input type="text" name="philosophy_mark_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_mark_title', $editLocale, 'Corporate Mark') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Makna Filosofi Lambang</label>
                                    <textarea name="philosophy_mark_desc_{{ $editLocale }}" rows="5" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('philosophy_mark_desc', $editLocale, 'An integrated production system centered on precision forging and processing technology. The rotating celestial orbit signifies global connectivity, dynamic momentum, and sub-micron rotational precision realizing high quality and competitive cost globally.') }}</textarea>
                                </div>
                            </div>

                            <!-- Corporate Colors -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-slate-900 block uppercase">🎨 Warna Korporat (Corporate Colors)</span>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Seksi Warna</label>
                                    <input type="text" name="philosophy_colors_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('philosophy_colors_title', $editLocale, 'Corporate Colors: Musashi Red & Musashi Black') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>

                                <div class="space-y-2 pt-1">
                                    <div class="p-2.5 bg-white rounded-lg border border-slate-200 space-y-1">
                                        <div class="flex items-center gap-2">
                                            <span class="w-3 h-3 rounded-full bg-[#E60012]"></span>
                                            <input type="text" name="philosophy_color1_name" value="{{ \App\Models\LandingPageSetting::get('philosophy_color1_name', 'Musashi Red (#E60012)', false) }}" class="w-full bg-transparent border-0 p-0 text-xs text-musashi-red font-bold">
                                        </div>
                                        <textarea name="philosophy_color1_desc_{{ $editLocale }}" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-md p-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('philosophy_color1_desc', $editLocale, 'Represents "Passion, Innovation, and Challenge" — the unstoppable energy to create new value.') }}</textarea>
                                    </div>

                                    <div class="p-2.5 bg-white rounded-lg border border-slate-200 space-y-1">
                                        <div class="flex items-center gap-2">
                                            <span class="w-3 h-3 rounded-full bg-black"></span>
                                            <input type="text" name="philosophy_color2_name" value="{{ \App\Models\LandingPageSetting::get('philosophy_color2_name', 'Musashi Black (#111111)', false) }}" class="w-full bg-transparent border-0 p-0 text-xs text-black font-bold">
                                        </div>
                                        <textarea name="philosophy_color2_desc_{{ $editLocale }}" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-md p-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('philosophy_color2_desc', $editLocale, 'Represents "A sense of mission, iron will, and determination" — unflinching dedication to quality and integrity.') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- Action Toolbar Sub-Tab 3 -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                            <button type="button" @click="profileSubTab = 'message'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                <span>← Kembali ke 2. Corporate Message</span>
                            </button>
                            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer flex items-center gap-1.5">
                                    <span>💾 Simpan Filosofi Perusahaan</span>
                                </button>
                                <button type="button" @click="profileSubTab = 'vision'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                    <span>Lanjut ke 4. Global Vision →</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    
                    <!-- ============================================== -->
                    <!-- SUB-TAB 4: GLOBAL VISION (VISI 100 TAHUN 2038) -->
                    <!-- ============================================== -->
                    <div x-show="profileSubTab === 'vision' || profileSubTab === 'all'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        <!-- 5. Halaman Visi Global 100 Tahun (Global Vision 2038) -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">4. Halaman Visi Global 100 Tahun (Global Vision 2038)</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Tampil di Halaman /company/global-vision & Rangkuman Landing Page</span>
                        </div>

                        <!-- 5A. Header Banner & Narasi Utama Visi -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
                            <span class="text-xs font-mono font-bold text-musashi-red block uppercase">🌟 Header Banner & Slogan Visi 2038</span>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Visi</label>
                                    <input type="text" name="vision_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_badge', $editLocale, 'Vision 2038') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Halaman Visi</label>
                                    <input type="text" name="vision_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_title', $editLocale, 'Musashi 100th Year Vision') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Sub-Judul Header Halaman</label>
                                <input type="text" name="vision_header_sub_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_header_sub', $editLocale, 'Break Barriers and Go on Adventures! Navigating our transformative journey toward our centenary anniversary in 2038.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Slogan Headline Utama</label>
                                <input type="text" name="vision_headline_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_headline', $editLocale, 'Break Barriers and Go on Adventures!') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Filosofi Pembuka Visi</label>
                                <textarea name="vision_sub_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('vision_sub', $editLocale, 'According to Musashi\'s philosophy of "a world where the earth and people coexist in prosperity and harmony," each of us becomes an adventurer as we create a path forward into the future.') }}</textarea>
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Narasi Visi 2038 Lengkap</label>
                                <textarea name="vision_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('vision_desc', $editLocale, 'Looking to the year 2038, the 100th anniversary of Musashi Seimitsu Industry\'s founding, we will break free of limitations and perceived barriers to create new value that is not an extension of the present.') }}</textarea>
                            </div>
                        </div>

                        <!-- 5B. 3 Pilar Trajectory Visi Menuju 2038 -->
                        <div class="space-y-4">
                            <span class="text-xs font-mono font-bold text-slate-800 block uppercase">🚀 3 Pilar Trajektori Visi Menuju 2038 (Vision Trajectory Cards)</span>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Pilar 1 -->
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Pilar 01: Drivetrain Electrification</span>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Pilar</label>
                                        <input type="text" name="vision_pillar1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_pillar1_title', $editLocale, 'Drivetrain Electrification') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Narasi</label>
                                        <textarea name="vision_pillar1_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('vision_pillar1_desc', $editLocale, 'Transitioning from conventional mechanical transmission into integrated 3-in-1 e-Axle propulsion, hybrid planetary reducers, and high-energy-density capacitor storage modules.') }}</textarea>
                                    </div>
                                </div>

                                <!-- Pilar 2 -->
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Pilar 02: AI & Smart Monozukuri</span>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Pilar</label>
                                        <input type="text" name="vision_pillar2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_pillar2_title', $editLocale, 'AI & Smart Monozukuri') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Narasi</label>
                                        <textarea name="vision_pillar2_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('vision_pillar2_desc', $editLocale, 'Pioneering fully automated forging lines, digital twin simulation, robotic handling, and real-time AI optical inspection to eliminate defects and raise operator safety.') }}</textarea>
                                    </div>
                                </div>

                                <!-- Pilar 3 -->
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                    <span class="text-[10px] font-mono font-bold text-emerald-700 uppercase block">Pilar 03: Carbon Neutrality</span>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Pilar</label>
                                        <input type="text" name="vision_pillar3_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_pillar3_title', $editLocale, 'Carbon Neutrality') }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Narasi</label>
                                        <textarea name="vision_pillar3_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('vision_pillar3_desc', $editLocale, 'Operating Indonesian plants with 100% clean power, zero process scrap to landfill, and creating circular economy value with Astra Group and international stakeholders.') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5C. Kotak Komitmen Sosial 100 Tahun (Callout Box) -->
                        <div class="p-4 rounded-xl bg-slate-900 text-white border border-slate-800 space-y-4">
                            <div class="flex items-center justify-between pb-2 border-b border-slate-800">
                                <span class="text-xs font-mono font-bold text-amber-400 block uppercase">✨ Kotak Komitmen Sosial (100 Years of Trust Callout)</span>
                                <span class="text-[10px] font-mono text-slate-400">Tampil di Bawah Halaman Global Vision</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-mono text-amber-300 uppercase block mb-1 font-bold">Badge Komitmen</label>
                                    <input type="text" name="vision_callout_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_callout_badge', $editLocale, '100 Years of Trust') }}" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-xs text-white">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-amber-300 uppercase block mb-1 font-bold">Judul Komitmen</label>
                                    <input type="text" name="vision_callout_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_callout_title', $editLocale, 'An Essential Company Expected by Society') }}" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-xs text-white font-semibold">
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-mono text-slate-300 uppercase block mb-1 font-bold">Isi Narasi Komitmen Harapan Masyarakat</label>
                                <textarea name="vision_callout_desc_{{ $editLocale }}" rows="2" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-xs text-white leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('vision_callout_desc', $editLocale, 'We will not be bound by conventional precedent. We strive to be an enterprise whose presence makes society healthier, more sustainable, and brimming with human potential.') }}</textarea>
                            </div>

                            <div>
                                <label class="text-[10px] font-mono text-slate-300 uppercase block mb-1 font-bold">Teks Tombol Aksi</label>
                                <input type="text" name="vision_callout_btn_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('vision_callout_btn', $editLocale, 'Learn About Our Journey →') }}" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-xs text-white">
                            </div>
                        </div>
                    </div>

                        <!-- Action Toolbar Sub-Tab 4 -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                            <button type="button" @click="profileSubTab = 'philosophy'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                <span>← Kembali ke 3. Philosophy</span>
                            </button>
                            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer flex items-center gap-1.5">
                                    <span>💾 Simpan Visi Global</span>
                                </button>
                                <button type="button" @click="profileSubTab = 'outline'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                    <span>Lanjut ke 5. Company Outline →</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    
                    <!-- ============================================== -->
                    <!-- SUB-TAB 5: COMPANY OUTLINE (GARIS BESAR & STAT)-->
                    <!-- ============================================== -->
                    <div x-show="profileSubTab === 'outline' || profileSubTab === 'all'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        <!-- 3. Garis Besar Perusahaan (Company Outline) & Fast Facts Statistik -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">5. Garis Besar Perusahaan (Company Outline) & Statistik</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Tampil di Landing Page & Halaman Company Outline</span>
                        </div>

                        <!-- 3A. 4 Angka Statistik Utama di Landing Page -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                            <span class="text-xs font-mono font-bold text-emerald-700 block uppercase">📊 4 Indikator Statistik Utama Landing Page (Fast Facts)</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">1. Tahun Pendirian (Angka)</label>
                                    <input type="text" name="outline_established_stat" value="{{ \App\Models\LandingPageSetting::get('outline_established_stat', '1996', false) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-mono font-bold">
                                    <label class="text-[9px] font-mono text-slate-500 uppercase block mt-1">Label Teks</label>
                                    <input type="text" name="outline_established_stat_label_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_established_stat_label', $editLocale, __('messages.company_stats.established')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1 text-xs text-black mt-0.5">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">2. Jumlah Karyawan (Angka)</label>
                                    <input type="text" name="outline_employees_stat" value="{{ \App\Models\LandingPageSetting::get('outline_employees_stat', '1,637+', false) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-mono font-bold">
                                    <label class="text-[9px] font-mono text-slate-500 uppercase block mt-1">Label Teks</label>
                                    <input type="text" name="outline_employees_stat_label_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_employees_stat_label', $editLocale, __('messages.company_stats.workforce')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1 text-xs text-black mt-0.5">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">3. Total Luas Pabrik (Angka)</label>
                                    <input type="text" name="outline_plant_area_stat" value="{{ \App\Models\LandingPageSetting::get('outline_plant_area_stat', '115,000 m²', false) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-mono font-bold">
                                    <label class="text-[9px] font-mono text-slate-500 uppercase block mt-1">Label Teks</label>
                                    <input type="text" name="outline_plant_area_stat_label_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant_area_stat_label', $editLocale, __('messages.company_stats.plant_area')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1 text-xs text-black mt-0.5">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-700 uppercase block mb-1 font-bold">4. Skala Penjualan (Angka)</label>
                                    <input type="text" name="outline_sales_stat" value="{{ \App\Models\LandingPageSetting::get('outline_sales_stat', 'IDR 2.8T+', false) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-mono font-bold">
                                    <label class="text-[9px] font-mono text-slate-500 uppercase block mt-1">Label Teks</label>
                                    <input type="text" name="outline_sales_stat_label_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_sales_stat_label', $editLocale, __('messages.company_stats.sales_scale')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1 text-xs text-black mt-0.5">
                                </div>
                            </div>
                        </div>

                        <!-- 3B. Data Spesifikasi Lengkap Perusahaan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nama Resmi Perusahaan (Global)</label>
                                <input type="text" name="outline_company_name" value="{{ \App\Models\LandingPageSetting::get('outline_company_name', 'PT Musashi Auto Parts Indonesia (MAP-IN)', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Presiden Direktur (Global)</label>
                                <input type="text" name="outline_president_director" value="{{ \App\Models\LandingPageSetting::get('outline_president_director', 'Mr. Asep Nugraha', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Waktu Pendirian (Established)</label>
                                <input type="text" name="outline_established_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_established', $editLocale, 'March 1996 (Commenced Commercial Production)') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Modal Dasar (Capitalization)</label>
                                <input type="text" name="outline_capital" value="{{ \App\Models\LandingPageSetting::get('outline_capital', 'USD 14,000,000', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Rasio Saham Musashi Jepang (%)</label>
                                <input type="text" name="outline_investment_japan" value="{{ \App\Models\LandingPageSetting::get('outline_investment_japan', '80%', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Rasio Saham Astra Honda Motor (%)</label>
                                <input type="text" name="outline_investment_indo" value="{{ \App\Models\LandingPageSetting::get('outline_investment_indo', '20%', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Jumlah Karyawan Lengkap (Employees Description)</label>
                                <input type="text" name="outline_employees_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_employees', $editLocale, '1,637 Persons (Cikarang: 1,194 • Karawang: 443)') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Total Luas Pabrik (Plant Area)</label>
                                <input type="text" name="outline_plant_area_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant_area', $editLocale, '115,000 m² (Cikarang & Karawang)') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>

                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Lokasi Pabrik 1 - Cikarang (Head Office)</label>
                                <input type="text" name="outline_plant1_info_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant1_info', $editLocale, 'EJIP Industrial Park Plot 3J-2, Cikarang Selatan, Bekasi (55,000 m²)') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Lokasi Pabrik 2 - Karawang Plant</label>
                                <input type="text" name="outline_plant2_info_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('outline_plant2_info', $editLocale, 'Suryacipta City of Industry Kav 1-36 BC, Ciampel, Karawang (60,000 m²)') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>

                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ruang Lingkup Bisnis (Business Content)</label>
                                <textarea name="outline_business_content_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('outline_business_content', $editLocale, 'Manufacture and Sale of Two-Wheel & Four-Wheel Engine, Transmission, Camshaft, Differential, and e-Axle Electric Powertrain Components.') }}</textarea>
                            </div>
                        </div>
                    </div>

                        <!-- Action Toolbar Sub-Tab 5 -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                            <button type="button" @click="profileSubTab = 'vision'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                <span>← Kembali ke 4. Global Vision</span>
                            </button>
                            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer flex items-center gap-1.5">
                                    <span>💾 Simpan Garis Besar Perusahaan</span>
                                </button>
                                <button type="button" @click="profileSubTab = 'directors'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                    <span>Lanjut ke 6. Board of Directors →</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    
                    <!-- ============================================== -->
                    <!-- SUB-TAB 6: BOARD OF DIRECTORS (BOD) & 7 KARTU  -->
                    <!-- ============================================== -->
                    <div x-show="profileSubTab === 'directors' || profileSubTab === 'all'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        
                        <!-- 6A. Tampilan Seksi Direksi di Landing Page (#directors) & Halaman Publik -->
                        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                                    <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">6A. Pengaturan Seksi Direksi Landing Page (#directors)</h4>
                                </div>
                                <span class="text-[10px] font-mono text-slate-400">Tampil di Landing Page & /company/board-of-directors</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Seksi Direksi</label>
                                    <input type="text" name="bod_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('bod_badge', $editLocale, __('messages.nav.bod')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Headline Direksi</label>
                                    <input type="text" name="bod_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('bod_title', $editLocale, __('messages.bod_section.title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                                </div>
                            </div>

                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Narasi Seksi Direksi</label>
                                <textarea name="bod_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('bod_desc', $editLocale, __('messages.bod_section.desc')) }}</textarea>
                            </div>

                            <!-- 6B. Akses Manajemen Anggota Dewan Direksi -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 pb-2 border-b border-slate-200">
                                    <div>
                                        <span class="text-xs font-mono font-bold text-slate-900 block uppercase">👥 Anggota Dewan Direksi Terdaftar</span>
                                        <span class="text-[11px] text-slate-500">Total saat ini: <strong class="text-musashi-red">{{ count($directorsList) }} Direktur</strong> aktif</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="currentTab = 'directors'; showCreateDirector = true; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-3.5 py-1.5 rounded-lg text-xs font-bold text-white bg-musashi-red hover:bg-musashi-darkred shadow-xs cursor-pointer flex items-center gap-1">
                                            <span>+ Tambah Direktur</span>
                                        </button>
                                        <button type="button" @click="currentTab = 'directors'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold text-slate-700 bg-white border border-slate-300 hover:bg-slate-100 cursor-pointer flex items-center gap-1">
                                            <span>Buka Kelola Lengkap →</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Mini preview grid of current directors -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2.5 pt-1">
                                    @foreach($directorsList->take(6) as $d)
                                        <div class="p-2.5 bg-white rounded-xl border border-slate-200 flex items-center gap-3">
                                            @if($d->photo)
                                                <img src="{{ asset($d->photo) }}" alt="{{ $d->name }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0 bg-slate-100 border border-slate-200">
                                            @else
                                                <div class="w-10 h-10 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 font-bold text-xs flex-shrink-0">
                                                    BOD
                                                </div>
                                            @endif
                                            <div class="min-w-0 flex-1">
                                                <div class="text-xs font-bold text-black truncate">{{ $d->name }}</div>
                                                <div class="text-[10px] text-slate-500 truncate">{{ $d->position }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- 6C. Tampilan 7 Kartu Overview Perusahaan di Landing Page (#company) -->
                        <!-- 4. Tampilan 7 Kartu Overview Perusahaan di Landing Page (#company) -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-5">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">4. Tampilan 7 Kartu Profil di Landing Page (#company)</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Sesuai Navigasi & Menu Dropdown</span>
                        </div>

                        <div>
                            <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Seksi Company</label>
                            <input type="text" name="company_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_badge', $editLocale, __('messages.nav.company')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pt-2">
                            <!-- Card 1 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Kartu 1: About Us</span>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Kartu</label>
                                    <input type="text" name="company_card1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card1_title', $editLocale, __('messages.nav.about_us')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Singkat</label>
                                    <textarea name="company_card1_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('company_card1_desc', $editLocale, 'Profil lengkap PT Musashi Auto Parts Indonesia, sejarah pendirian, pabrik Cikarang & Karawang, serta sinergi Monozukuri terpadu.') }}</textarea>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Kartu 2: Corporate Message</span>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Kartu</label>
                                    <input type="text" name="company_card2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card2_title', $editLocale, __('messages.nav.corporate_message')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Singkat</label>
                                    <textarea name="company_card2_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('company_card2_desc', $editLocale, 'Pesan resmi Presiden Direktur mengenai komitmen mutu, keselamatan kerja tanpa kompromi, dan keberlanjutan mobilitas masa depan.') }}</textarea>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Kartu 3: Philosophy</span>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Kartu</label>
                                    <input type="text" name="company_card3_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card3_title', $editLocale, __('messages.nav.philosophy')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Singkat</label>
                                    <textarea name="company_card3_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('company_card3_desc', $editLocale, 'Filosofi Musashi: Menembus batas dan melangkah ke petualangan baru! Harmoni antara manusia, kendaraan, dan bumi.') }}</textarea>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Kartu 4: Global Vision</span>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Kartu</label>
                                    <input type="text" name="company_card4_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card4_title', $editLocale, __('messages.nav.global_vision')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Singkat</label>
                                    <textarea name="company_card4_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('company_card4_desc', $editLocale, 'Visi 100 Tahun Musashi Group (2038): Inovasi teknologi ramah lingkungan, elektrifikasi e-Axle, dan kontribusi masyarakat global.') }}</textarea>
                                </div>
                            </div>

                            <!-- Card 5 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Kartu 5: Company Outline</span>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Kartu</label>
                                    <input type="text" name="company_card5_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card5_title', $editLocale, __('messages.nav.company_outline')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Singkat</label>
                                    <textarea name="company_card5_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('company_card5_desc', $editLocale, 'Legalitas, data modal, struktur kepemilikan saham, luas area Cikarang & Karawang, serta sertifikasi standar mutu otomotif internasional.') }}</textarea>
                                </div>
                            </div>

                            <!-- Card 6 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Kartu 6: Board Of Director</span>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Kartu</label>
                                    <input type="text" name="company_card6_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card6_title', $editLocale, __('messages.nav.bod')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Singkat</label>
                                    <textarea name="company_card6_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('company_card6_desc', $editLocale, 'Jajaran Dewan Direksi yang memimpin operasional, inovasi teknologi, dan tata kelola perusahaan berkelanjutan.') }}</textarea>
                                </div>
                            </div>

                            <!-- Card 7 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2 md:col-span-2 lg:col-span-3">
                                <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">Kartu 7: Global Network</span>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Judul Kartu</label>
                                        <input type="text" name="company_card7_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card7_title', $editLocale, __('messages.nav.network')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-1">Deskripsi Singkat</label>
                                        <textarea name="company_card7_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('company_card7_desc', $editLocale, 'Dua pabrik utama di Cikarang (Head Office) dan Karawang Plant, terkoneksi dengan lebih dari 30 fasilitas global Musashi Group di seluruh dunia.') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- Action Toolbar Sub-Tab 6 -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                            <button type="button" @click="profileSubTab = 'outline'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                <span>← Kembali ke 5. Company Outline</span>
                            </button>
                            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer flex items-center gap-1.5">
                                    <span>💾 Simpan Direksi & Kartu Profil</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== -->
                    <!-- SUB-TAB 7: JARINGAN GLOBAL (GLOBAL NETWORK)    -->
                    <!-- ============================================== -->
                    <div x-show="profileSubTab === 'network' || profileSubTab === 'all'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                        
                        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                            
                            <!-- Header Title Box -->
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                                    <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">7. Jaringan Global & Domestik (Global & Domestic Network)</h4>
                                </div>
                                <span class="text-[10px] font-mono text-slate-400">Tampil di Halaman /company/network & Kartu Landing Page #company-network</span>
                            </div>

                            <!-- 7A. Pengaturan Kartu di Landing Page (#company-network) -->
                            <div class="p-5 rounded-2xl bg-gradient-to-br from-red-50/60 to-slate-50 border border-red-200/80 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-mono font-bold text-musashi-red uppercase flex items-center gap-2">
                                        <svg class="w-4 h-4 text-musashi-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                                        <span>7A. Tampilan Kartu Jaringan Global di Landing Page (#company-network)</span>
                                    </span>
                                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-red-100 text-musashi-red font-bold">Kartu #7 Landing Page</span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Kartu (#company-network)</label>
                                        <input type="text" name="company_card7_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card7_title', $editLocale, __('messages.nav.network')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol Link Kartu</label>
                                        <input type="text" name="company_card7_btn_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('company_card7_btn_text', $editLocale, __('messages.common.read_more')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Ringkasan Kartu di Landing Page</label>
                                    <textarea name="company_card7_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('company_card7_desc', $editLocale, 'Dua pabrik utama di Cikarang (Head Office) dan Karawang Plant, terkoneksi dengan lebih dari 30 fasilitas global Musashi Group di seluruh dunia.') }}</textarea>
                                </div>
                            </div>

                            <!-- 7B. Header Banner Halaman Lengkap (/company/network) -->
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                                <span class="text-xs font-mono font-bold text-musashi-red uppercase block">
                                    🏷️ 7B. Header Banner Halaman Jaringan Global (/company/network)
                                </span>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Header Banner</label>
                                        <input type="text" name="network_hero_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_hero_badge', $editLocale, 'Global Operations') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Halaman (H1)</label>
                                        <input type="text" name="network_hero_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_hero_title', $editLocale, 'Global & Domestic Network') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Sub-Headline Halaman</label>
                                    <textarea name="network_hero_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('network_hero_desc', $editLocale, 'A connected ecosystem of 35 production plants in 14 countries delivering uniform precision and localized supply assurance.') }}</textarea>
                                </div>
                            </div>

                            <!-- 7C. Judul Sub-Wilayah (4 Tab Wilayah) -->
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                                <span class="text-xs font-mono font-bold text-musashi-red uppercase block">
                                    🌐 7C. Judul & Subtitle 4 Wilayah Jaringan
                                </span>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Indonesia -->
                                    <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                        <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">🇮🇩 Wilayah 1: Indonesia</span>
                                        <div>
                                            <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Badge / Sub-judul</label>
                                            <input type="text" name="network_indo_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_indo_badge', $editLocale, 'Domestic Production Network') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                        </div>
                                        <div>
                                            <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Judul Wilayah</label>
                                            <input type="text" name="network_indo_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_indo_title', $editLocale, 'Indonesia Operating Plants') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                        </div>
                                    </div>

                                    <!-- Japan -->
                                    <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                        <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">🇯🇵 Wilayah 2: Japan (HQ)</span>
                                        <div>
                                            <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Badge / Sub-judul</label>
                                            <input type="text" name="network_japan_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_japan_badge', $editLocale, 'Global Headquarters & Japanese Facilities') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                        </div>
                                        <div>
                                            <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Judul Wilayah</label>
                                            <input type="text" name="network_japan_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_japan_title', $editLocale, 'Japan Network') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                        </div>
                                    </div>

                                    <!-- Europe -->
                                    <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                        <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">🇪🇺 Wilayah 3: Europe</span>
                                        <div>
                                            <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Badge / Sub-judul</label>
                                            <input type="text" name="network_europe_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_europe_badge', $editLocale, 'European Manufacturing') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                        </div>
                                        <div>
                                            <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Judul Wilayah</label>
                                            <input type="text" name="network_europe_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_europe_title', $editLocale, 'Europe Network') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                        </div>
                                    </div>

                                    <!-- Asia & Americas -->
                                    <div class="p-3.5 bg-white rounded-xl border border-slate-200 space-y-2">
                                        <span class="text-[10px] font-mono font-bold text-musashi-red uppercase block">🌏 Wilayah 4: Asia & Americas</span>
                                        <div>
                                            <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Badge / Sub-judul</label>
                                            <input type="text" name="network_asia_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_asia_badge', $editLocale, 'Global Reach') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                        </div>
                                        <div>
                                            <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Judul Wilayah</label>
                                            <input type="text" name="network_asia_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('network_asia_title', $editLocale, 'Asia & The Americas') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-semibold">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 7D. Manajemen Fasilitas Pabrik (Lengkap Tambah, Edit, Hapus) -->
                            <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-5">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                                    <div>
                                        <span class="text-xs font-mono font-bold text-musashi-red uppercase block">
                                            🏭 7D. Daftar Fasilitas & Pabrik Global (Bisa Edit, Tambah & Hapus)
                                        </span>
                                        <span class="text-[11px] text-slate-500 mt-0.5 block">
                                            Total <strong class="text-black" x-text="networkFacilities.length"></strong> fasilitas pabrik terdaftar. Anda dapat mengubah teks, menghapus, atau menambahkan fasilitas baru.
                                        </span>
                                    </div>

                                    <!-- Tombol Tambah Fasilitas Baru -->
                                    <button type="button" 
                                            @click="showAddFacilityModal = true"
                                            class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm transition-all flex items-center gap-1.5 cursor-pointer self-start sm:self-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        <span>+ Tambah Pabrik / Fasilitas</span>
                                    </button>
                                </div>

                                <!-- Filter Tab Wilayah -->
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-[11px] font-mono text-slate-500 font-bold mr-1">Filter Wilayah:</span>
                                    <button type="button" 
                                            @click="networkRegionFilter = 'all'"
                                            :class="networkRegionFilter === 'all' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                                            class="px-3 py-1 rounded-lg text-xs font-mono font-semibold transition-colors cursor-pointer">
                                        Semua (<span x-text="networkFacilities.length"></span>)
                                    </button>
                                    <button type="button" 
                                            @click="networkRegionFilter = 'indonesia'"
                                            :class="networkRegionFilter === 'indonesia' ? 'bg-musashi-red text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                                            class="px-3 py-1 rounded-lg text-xs font-mono font-semibold transition-colors cursor-pointer">
                                        Indonesia (<span x-text="networkFacilities.filter(f => f.region === 'indonesia').length"></span>)
                                    </button>
                                    <button type="button" 
                                            @click="networkRegionFilter = 'japan'"
                                            :class="networkRegionFilter === 'japan' ? 'bg-musashi-red text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                                            class="px-3 py-1 rounded-lg text-xs font-mono font-semibold transition-colors cursor-pointer">
                                        Japan (<span x-text="networkFacilities.filter(f => f.region === 'japan').length"></span>)
                                    </button>
                                    <button type="button" 
                                            @click="networkRegionFilter = 'europe'"
                                            :class="networkRegionFilter === 'europe' ? 'bg-musashi-red text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                                            class="px-3 py-1 rounded-lg text-xs font-mono font-semibold transition-colors cursor-pointer">
                                        Europe (<span x-text="networkFacilities.filter(f => f.region === 'europe').length"></span>)
                                    </button>
                                    <button type="button" 
                                            @click="networkRegionFilter = 'asia'"
                                            :class="networkRegionFilter === 'asia' ? 'bg-musashi-red text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                                            class="px-3 py-1 rounded-lg text-xs font-mono font-semibold transition-colors cursor-pointer">
                                        Asia & Americas (<span x-text="networkFacilities.filter(f => f.region === 'asia').length"></span>)
                                    </button>
                                </div>

                                <!-- Hidden input yang dikirim ke backend -->
                                <input type="hidden" name="network_facilities_json" :value="JSON.stringify(networkFacilities)">

                                <!-- Daftar Kartu Fasilitas yang Bisa Diedit & Dihapus -->
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <template x-for="(fac, fIdx) in networkFacilities" :key="fac.id || fIdx">
                                        <div x-show="networkRegionFilter === 'all' || networkRegionFilter === fac.region" 
                                             class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:border-musashi-red/40 hover:shadow-sm transition-all space-y-3 relative group">
                                            
                                            <!-- Top Card Bar: Region + Hapus Button -->
                                            <div class="flex items-center justify-between gap-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="w-5 h-5 rounded-md bg-slate-900 text-white font-mono text-[10px] font-bold flex items-center justify-center" x-text="'#' + (fIdx + 1)"></span>
                                                    <select x-model="fac.region" class="text-[11px] font-mono font-bold bg-white border border-slate-300 rounded-lg px-2 py-1 text-slate-800">
                                                        <option value="indonesia">🇮🇩 Indonesia</option>
                                                        <option value="japan">🇯🇵 Japan (HQ)</option>
                                                        <option value="europe">🇪🇺 Europe</option>
                                                        <option value="asia">🌏 Asia & Americas</option>
                                                    </select>
                                                </div>

                                                <!-- Tombol Hapus Fasilitas -->
                                                <button type="button" 
                                                        @click="if(confirm('Yakin ingin menghapus fasilitas: ' + fac.name + '?')) { networkFacilities.splice(fIdx, 1); }"
                                                        class="px-2.5 py-1 rounded-lg text-[11px] font-mono font-bold text-red-600 hover:text-white bg-red-50 hover:bg-red-600 border border-red-200 transition-colors flex items-center gap-1 cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </div>

                                            <!-- Form Edit Inline -->
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                                <div class="sm:col-span-2">
                                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Nama Pabrik / Fasilitas *</label>
                                                    <input type="text" x-model="fac.name" required class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-bold">
                                                </div>

                                                <div>
                                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Badge / Tipe Pabrik</label>
                                                    <input type="text" x-model="fac.badge" placeholder="Contoh: Plant 1 - Head Office" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                                </div>

                                                <div>
                                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Tahun Berdiri (Est)</label>
                                                    <input type="text" x-model="fac.est" placeholder="Contoh: Established Jan 1996" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                                </div>

                                                <div class="sm:col-span-2">
                                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Alamat Lengkap</label>
                                                    <textarea x-model="fac.address" rows="2" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black"></textarea>
                                                </div>

                                                <div>
                                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Nomor Telepon</label>
                                                    <input type="text" x-model="fac.phone" placeholder="+62-21-..." class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black font-mono">
                                                </div>

                                                <div>
                                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Luas Area & Karyawan / Info</label>
                                                    <input type="text" x-model="fac.stats" placeholder="Land Area: 55,000 m²..." class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                                </div>

                                                <div class="sm:col-span-2">
                                                    <label class="text-[10px] font-mono text-slate-600 uppercase font-bold block mb-0.5">Lingkup Produksi (Production Scope)</label>
                                                    <input type="text" x-model="fac.scope" placeholder="2W & 4W Transmission Gear, Camshaft..." class="w-full bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-black">
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Action Toolbar Sub-Tab 7 -->
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
                                <button type="button" @click="profileSubTab = 'directors'; window.scrollTo({top: 0, behavior: 'smooth'})" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors cursor-pointer flex items-center gap-1.5">
                                    <span>← Kembali ke 6. Board of Directors & Kartu</span>
                                </button>
                                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer flex items-center gap-1.5">
                                        <span>💾 Simpan Semua Jaringan Global & Profil</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Fasilitas Pabrik Baru -->
                    <div x-show="showAddFacilityModal" style="display: none;" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
                        <div @click.away="showAddFacilityModal = false" class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-7 space-y-4 shadow-2xl max-h-[90vh] overflow-y-auto">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                                <h4 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                                    <span>➕ Tambah Pabrik / Fasilitas Global</span>
                                </h4>
                                <button type="button" @click="showAddFacilityModal = false" class="text-slate-400 hover:text-black text-xl font-bold">&times;</button>
                            </div>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Wilayah (Region) *</label>
                                    <select x-model="newFacility.region" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                                        <option value="indonesia">🇮🇩 Indonesia (Pabrik Domestik)</option>
                                        <option value="japan">🇯🇵 Japan (HQ & Fasilitas Jepang)</option>
                                        <option value="europe">🇪🇺 Europe (Fasilitas Eropa)</option>
                                        <option value="asia">🌏 Asia & Americas (Asia & Amerika)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nama Pabrik / Fasilitas *</label>
                                    <input type="text" x-model="newFacility.name" placeholder="Misal: PT Musashi Auto Parts Indonesia - Cikarang" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge / Label Tipe</label>
                                        <input type="text" x-model="newFacility.badge" placeholder="Misal: Plant 3 / Germany HQ" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Tahun Berdiri (Est)</label>
                                        <input type="text" x-model="newFacility.est" placeholder="Misal: Established Jan 2024" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Alamat Lengkap *</label>
                                    <textarea x-model="newFacility.address" rows="2" placeholder="Tuliskan alamat lengkap lokasi pabrik..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black"></textarea>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nomor Telepon</label>
                                        <input type="text" x-model="newFacility.phone" placeholder="+62-21-..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Luas Area & Karyawan</label>
                                        <input type="text" x-model="newFacility.stats" placeholder="Land Area: ... • Workforce: ..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Lingkup Produksi (Production Scope)</label>
                                    <input type="text" x-model="newFacility.scope" placeholder="Misal: 2W & 4W Transmission Gear, EV Powertrain..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                            </div>

                            <div class="pt-3 border-t border-slate-200 flex justify-end gap-2">
                                <button type="button" @click="showAddFacilityModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 cursor-pointer">Batal</button>
                                <button type="button" 
                                        @click="
                                            if(!newFacility.name || !newFacility.name.trim()) { alert('Silakan isi Nama Pabrik terlebih dahulu!'); return; }
                                            networkFacilities.unshift({
                                                id: 'fac_' + Date.now(),
                                                region: newFacility.region,
                                                badge: newFacility.badge || 'Plant',
                                                name: newFacility.name,
                                                est: newFacility.est || '',
                                                address: newFacility.address || '',
                                                phone: newFacility.phone || '',
                                                scope: newFacility.scope || '',
                                                stats: newFacility.stats || ''
                                            });
                                            newFacility = { region: 'indonesia', badge: '', name: '', est: '', address: '', phone: '', scope: '', stats: '' };
                                            showAddFacilityModal = false;
                                        "
                                        class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer">
                                    + Tambahkan ke Daftar
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="flex justify-end pt-4 border-t border-slate-200">
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md cursor-pointer flex items-center justify-center gap-2">
                            <span>💾 Simpan Semua Profil Perusahaan</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- ========================================== -->
            <!-- TAB 4: HERO VISUAL SLIDER & VIDEO         -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'hero'" class="space-y-6">
                <form action="{{ route('superadmin.hero.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_lang" value="{{ $editLocale }}">

                    <!-- Action Header Bar -->
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase bg-red-100 text-musashi-red border border-red-200">
                                    Bahasa Aktif: {{ strtoupper($editLocale) }}
                                </span>
                                <span class="text-xs text-slate-400 font-mono">({{ count($heroSlides) }} Slide Terdaftar)</span>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900">Hero Visual Slider & Upload Video Landing Page</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Kelola banner berjalan paling atas di landing page. Anda dapat meng-upload video (.mp4/.webm) atau gambar, dan menyesuaikan teks dalam 3 bahasa.</p>
                        </div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <button type="submit" name="action" value="add_slide" class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-xs flex items-center gap-1.5 cursor-pointer">
                                <span>➕ Tambah Slide Baru</span>
                            </button>
                            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md flex items-center gap-1.5 cursor-pointer">
                                <span>💾 Simpan Hero Slider</span>
                            </button>
                        </div>
                    </div>

                    <!-- Slide Cards List -->
                    <div class="space-y-6">
                        @foreach($heroSlides as $sIdx => $slide)
                            @php
                                $sId = $slide['id'] ?? ($sIdx + 1);
                                $mediaUrl = $slide['media_url'] ?? '';
                                $isVideo = ($slide['media_type'] ?? '') === 'video' || preg_match('/\.(mp4|webm|ogg|mov)$/i', $mediaUrl);
                                $isActive = !isset($slide['is_active']) || $slide['is_active'];
                                $showGoFarBeyond = !empty($slide['show_gofarbeyond']);
                            @endphp
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden transition-all hover:border-slate-300">
                                <input type="hidden" name="slides[{{ $sIdx }}][id]" value="{{ $sId }}">
                                <input type="hidden" name="slides[{{ $sIdx }}][media_type]" value="{{ $isVideo ? 'video' : 'image' }}">

                                <!-- Slide Card Header -->
                                <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-200 flex flex-wrap items-center justify-between gap-3">
                                    <div class="flex items-center gap-3">
                                        <span class="w-7 h-7 rounded-lg bg-slate-900 text-white font-mono text-xs font-bold flex items-center justify-center">
                                            #{{ $sIdx + 1 }}
                                        </span>
                                        <div>
                                            <h4 class="font-bold text-sm text-slate-900">
                                                {{ $slide['headline_' . $editLocale] ?? $slide['headline_id'] ?? 'Slide #' . ($sIdx + 1) }}
                                            </h4>
                                            <span class="text-[11px] font-mono text-slate-500">{{ $slide['badge'] ?? 'Musashi Innovation' }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <!-- Active Toggle -->
                                        <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-700">
                                            <input type="checkbox" name="slides[{{ $sIdx }}][is_active]" value="1" {{ $isActive ? 'checked' : '' }} class="rounded border-slate-300 text-musashi-red focus:ring-musashi-red">
                                            <span>Aktif di Landing Page</span>
                                        </label>

                                        <!-- Delete Button if more than 1 slide -->
                                        @if(count($heroSlides) > 1)
                                            <button 
                                                type="button" 
                                                @click="if(confirm('Yakin ingin menghapus Slide #{{ $sIdx + 1 }} ini?')) { $refs.deleteSlideInput.value = '{{ $sId }}'; $refs.deleteSlideForm.submit(); }"
                                                class="text-xs text-red-600 hover:text-red-700 hover:bg-red-50 px-2.5 py-1 rounded-lg border border-red-200 transition-colors">
                                                🗑️ Hapus
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- Slide Card Body -->
                                <div class="p-6 grid grid-cols-1 lg:grid-cols-12 gap-6">
                                    
                                    <!-- Left: Media File (Video or Image) -->
                                    <div class="lg:col-span-5 space-y-4">
                                        <div class="flex items-center justify-between">
                                            <label class="text-[11px] font-mono text-slate-700 uppercase font-bold">Media Background:</label>
                                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-full font-bold {{ $isVideo ? 'bg-purple-100 text-purple-700 border border-purple-200' : 'bg-blue-100 text-blue-700 border border-blue-200' }}">
                                                {{ $isVideo ? '🎥 FORMAT VIDEO' : '🖼️ FORMAT FOTO' }}
                                            </span>
                                        </div>

                                        <!-- Live Preview Box -->
                                        <div class="relative h-44 rounded-xl overflow-hidden bg-slate-950 border border-slate-200 shadow-inner group flex items-center justify-center">
                                            @if($mediaUrl)
                                                @if($isVideo)
                                                    <video controls muted class="w-full h-full object-cover">
                                                        <source src="{{ asset($mediaUrl) }}">
                                                    </video>
                                                @else
                                                    <img src="{{ asset($mediaUrl) }}" alt="" class="w-full h-full object-cover">
                                                @endif
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-500 text-xs font-mono">
                                                    Belum ada media
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Upload Input for Video / Image -->
                                        <div class="space-y-1.5">
                                            <label class="text-[11px] font-mono text-slate-600 font-bold block">
                                                Upload Video atau Foto Baru:
                                            </label>
                                            <input 
                                                type="file" 
                                                name="slide_media_{{ $sIdx }}" 
                                                accept="video/mp4,video/webm,video/ogg,video/quicktime,image/*" 
                                                class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-800 hover:file:bg-slate-200 border border-slate-200 rounded-xl p-1 bg-slate-50/50">
                                            <p class="text-[10px] text-slate-400 font-mono">
                                                💡 Unggah file video (.mp4 / .webm) untuk latar video bergerak, atau foto (.jpg / .png / .webp).
                                            </p>
                                        </div>

                                        <!-- URL / Path Field -->
                                        <div>
                                            <label class="text-[11px] font-mono text-slate-600 font-bold block mb-1">
                                                Path / URL Media:
                                            </label>
                                            <input 
                                                type="text" 
                                                name="slides[{{ $sIdx }}][media_url]" 
                                                value="{{ $mediaUrl }}" 
                                                placeholder="/videos/hero/clip.mp4 atau /images/hero/..."
                                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-mono text-black">
                                        </div>
                                    </div>

                                    <!-- Right: Text Content & Links in Active Language -->
                                    <div class="lg:col-span-7 space-y-4">
                                        
                                        <!-- Badge & Headline -->
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <div>
                                                <label class="text-[11px] font-mono text-slate-700 uppercase font-bold block mb-1">Badge Kategori</label>
                                                <input 
                                                    type="text" 
                                                    name="slides[{{ $sIdx }}][badge]" 
                                                    value="{{ $slide['badge'] ?? '' }}" 
                                                    placeholder="Energy Solutions"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-black">
                                            </div>
                                            <div class="sm:col-span-2">
                                                <label class="text-[11px] font-mono text-slate-700 uppercase font-bold block mb-1">
                                                    Headline Utama ({{ strtoupper($editLocale) }})
                                                </label>
                                                <input 
                                                    type="text" 
                                                    name="slides[{{ $sIdx }}][headline_{{ $editLocale }}]" 
                                                    value="{{ $slide['headline_' . $editLocale] ?? '' }}" 
                                                    placeholder="Judul besar banner"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-black">
                                            </div>
                                        </div>

                                        <!-- Subtitle -->
                                        <div>
                                            <label class="text-[11px] font-mono text-slate-700 uppercase font-bold block mb-1">
                                                Sub-Headline ({{ strtoupper($editLocale) }})
                                            </label>
                                            <input 
                                                type="text" 
                                                name="slides[{{ $sIdx }}][subtitle_{{ $editLocale }}]" 
                                                value="{{ $slide['subtitle_' . $editLocale] ?? '' }}" 
                                                placeholder="Sub-headline teks pendukung"
                                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-black">
                                        </div>

                                        <!-- Description -->
                                        <div>
                                            <label class="text-[11px] font-mono text-slate-700 uppercase font-bold block mb-1">
                                                Deskripsi / Keterangan Tambahan ({{ strtoupper($editLocale) }})
                                            </label>
                                            <textarea 
                                                name="slides[{{ $sIdx }}][description_{{ $editLocale }}]" 
                                                rows="2" 
                                                placeholder="Deskripsi singkat atau catatan karya AI"
                                                class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs text-black leading-relaxed">{{ $slide['description_' . $editLocale] ?? '' }}</textarea>
                                        </div>

                                        <!-- CTA Button Text & Link -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div>
                                                <label class="text-[11px] font-mono text-slate-700 uppercase font-bold block mb-1">
                                                    Teks Tombol Aksi ({{ strtoupper($editLocale) }})
                                                </label>
                                                <input 
                                                    type="text" 
                                                    name="slides[{{ $sIdx }}][cta_text_{{ $editLocale }}]" 
                                                    value="{{ $slide['cta_text_' . $editLocale] ?? '' }}" 
                                                    placeholder="Contoh: FILOSOFI MUSASHI →"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-black">
                                            </div>
                                            <div>
                                                <label class="text-[11px] font-mono text-slate-700 uppercase font-bold block mb-1">
                                                    Link Tujuan Tombol
                                                </label>
                                                <input 
                                                    type="text" 
                                                    name="slides[{{ $sIdx }}][cta_link]" 
                                                    value="{{ $slide['cta_link'] ?? '' }}" 
                                                    placeholder="Contoh: /company/philosophy"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-black font-mono">
                                            </div>
                                        </div>

                                        <!-- GO FAR BEYOND Logo Option -->
                                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                                            <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-800">
                                                <input 
                                                    type="checkbox" 
                                                    name="slides[{{ $sIdx }}][show_gofarbeyond]" 
                                                    value="1" 
                                                    {{ $showGoFarBeyond ? 'checked' : '' }} 
                                                    class="rounded border-slate-300 text-musashi-red focus:ring-musashi-red">
                                                <span>Tampilkan Kotak Logo "GO FAR BEYOND" (Seperti di Slide 2)</span>
                                            </label>
                                        </div>

                                        <!-- Hidden inputs for preserving other languages -->
                                        @foreach(['id', 'en', 'ja'] as $otherLang)
                                            @if($otherLang !== $editLocale)
                                                <input type="hidden" name="slides[{{ $sIdx }}][headline_{{ $otherLang }}]" value="{{ $slide['headline_' . $otherLang] ?? '' }}">
                                                <input type="hidden" name="slides[{{ $sIdx }}][subtitle_{{ $otherLang }}]" value="{{ $slide['subtitle_' . $otherLang] ?? '' }}">
                                                <input type="hidden" name="slides[{{ $sIdx }}][description_{{ $otherLang }}]" value="{{ $slide['description_' . $otherLang] ?? '' }}">
                                                <input type="hidden" name="slides[{{ $sIdx }}][cta_text_{{ $otherLang }}]" value="{{ $slide['cta_text_' . $otherLang] ?? '' }}">
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Announcement Bar Settings -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <h4 class="font-bold text-sm text-slate-900 uppercase font-mono">Top Announcement Bar (Banner Berjalan Atas)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Status Bar</label>
                                <select name="announcement_bar_enabled" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                    <option value="1" {{ \App\Models\LandingPageSetting::get('announcement_bar_enabled', '0', false) === '1' ? 'selected' : '' }}>Aktif (Tampilkan)</option>
                                    <option value="0" {{ \App\Models\LandingPageSetting::get('announcement_bar_enabled', '0', false) === '0' ? 'selected' : '' }}>Nonaktif (Sembunyikan)</option>
                                </select>
                            </div>
                            <div class="md:col-span-3">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Pengumuman ({{ strtoupper($editLocale) }})</label>
                                <input type="text" name="announcement_bar_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('announcement_bar_text', $editLocale, 'Selamat datang di Portal Resmi PT. Musashi Auto Parts Indonesia.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <button type="submit" name="action" value="add_slide" class="px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-xs flex items-center gap-2 cursor-pointer">
                            <span>➕ Tambah Slide Hero Baru</span>
                        </button>
                        <button type="submit" class="px-8 py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md flex items-center gap-2 cursor-pointer">
                            <span>💾 Simpan Semua Hero Settings</span>
                        </button>
                    </div>
                </form>

                <!-- Hidden form for deleting a single slide -->
                <form x-ref="deleteSlideForm" action="{{ route('superadmin.hero.deleteSlide') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="slide_id" x-ref="deleteSlideInput" value="">
                    <input type="hidden" name="redirect_lang" value="{{ $editLocale }}">
                </form>
            </div>

            <!-- ========================================== -->
            <!-- TAB 5: BISNIS & 4 PILAR GLOBAL            -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'pillars'" class="space-y-6" x-data="{ pillarSubTab: 'cards' }">
                <form action="{{ route('superadmin.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_tab" value="pillars">
                    <input type="hidden" name="redirect_lang" :value="editLocale">

                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-red-50 text-musashi-red border border-red-200 uppercase">Our Business CMS</span>
                                <span class="text-xs font-mono text-slate-400">#business & sub-pages</span>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900">Bisnis & 4 Pilar Global Kami</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Kelola kartu di Landing Page ("Our Business") dan seluruh isi halaman lengkap masing-masing pilar.</p>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm transition-all cursor-pointer">
                            💾 Simpan Perubahan Bisnis
                        </button>
                    </div>

                    <!-- Subtab Navigation for Business Pillar Control -->
                    <div class="bg-white p-2 rounded-2xl border border-slate-200 shadow-xs flex flex-wrap gap-1.5 text-xs font-bold">
                        <button 
                            type="button" 
                            @click="pillarSubTab = 'cards'" 
                            :class="pillarSubTab === 'cards' ? 'bg-musashi-red text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" 
                            class="px-4 py-2.5 rounded-xl transition-all cursor-pointer flex items-center gap-2">
                            <span>🎯 4 Kartu Landing Page</span>
                        </button>
                        <button 
                            type="button" 
                            @click="pillarSubTab = 'mobility'" 
                            :class="pillarSubTab === 'mobility' ? 'bg-musashi-red text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" 
                            class="px-4 py-2.5 rounded-xl transition-all cursor-pointer flex items-center gap-2">
                            <span>⚡ 01. Mobility (/mobility)</span>
                        </button>
                        <button 
                            type="button" 
                            @click="pillarSubTab = 'industry'" 
                            :class="pillarSubTab === 'industry' ? 'bg-musashi-red text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" 
                            class="px-4 py-2.5 rounded-xl transition-all cursor-pointer flex items-center gap-2">
                            <span>🏭 02. Industry (/industry)</span>
                        </button>
                        <button 
                            type="button" 
                            @click="pillarSubTab = 'energy'" 
                            :class="pillarSubTab === 'energy' ? 'bg-musashi-red text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" 
                            class="px-4 py-2.5 rounded-xl transition-all cursor-pointer flex items-center gap-2">
                            <span>🔋 03. Energy (/energy)</span>
                        </button>
                        <button 
                            type="button" 
                            @click="pillarSubTab = 'wellbeing'" 
                            :class="pillarSubTab === 'wellbeing' ? 'bg-musashi-red text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" 
                            class="px-4 py-2.5 rounded-xl transition-all cursor-pointer flex items-center gap-2">
                            <span>🌱 04. Well-being (/well-being)</span>
                        </button>
                        <button 
                            type="button" 
                            @click="pillarSubTab = 'technoinnov'" 
                            :class="pillarSubTab === 'technoinnov' ? 'bg-musashi-red text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" 
                            class="px-4 py-2.5 rounded-xl transition-all cursor-pointer flex items-center gap-2">
                            <span>🔬 Tech & Innovation</span>
                        </button>
                    </div>

                    <!-- ============================================================ -->
                    <!-- SUBTAB 1: 4 KARTU LANDING PAGE (OUR BUSINESS)                -->
                    <!-- ============================================================ -->
                    <div x-show="pillarSubTab === 'cards'" class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">★</span>
                                Header Section Bisnis & 4 Pilar Utama
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Kategori (Teks Merah)</label>
                                    <input type="text" name="pillars_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillars_badge', $editLocale, __('messages.pillars.badge')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black" placeholder="Contoh: BISNIS & 4 PILAR UTAMA">
                                    <span class="text-[10px] text-slate-400 mt-1 block">Teks label merah di atas judul section.</span>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Section</label>
                                    <input type="text" name="pillars_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillars_title', $editLocale, __('messages.pillars.title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                    <span class="text-[10px] text-slate-400 mt-1 block">Teks judul besar section di landing page.</span>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Sub-Judul / Deskripsi</label>
                                    <input type="text" name="pillars_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillars_subtitle', $editLocale, __('messages.pillars.subtitle')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black" placeholder="Deskripsi ringkas section">
                                    <span class="text-[10px] text-slate-400 mt-1 block">Deskripsi di bawah judul utama.</span>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol Lihat Semua</label>
                                    <input type="text" name="pillars_view_all_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillars_view_all_text', $editLocale, $editLocale === 'ja' ? 'すべてのピラーを見る' : ($editLocale === 'id' ? 'Lihat Semua Pilar' : 'Explore All Pillars')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black" placeholder="Lihat Semua Pilar">
                                    <span class="text-[10px] text-slate-400 mt-1 block">Tombol pojok kanan atas section.</span>
                                </div>
                            </div>
                        </div>

                        <!-- 4 Domain Cards Grid on Landing Page -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Card 1: Mobility -->
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                                    <h5 class="font-bold text-sm text-musashi-red font-mono uppercase">01. Kartu Mobility</h5>
                                    <a href="{{ route('business.mobility') }}" target="_blank" class="text-[10px] text-slate-500 hover:text-musashi-red">Lihat Halaman ↗</a>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Pojok Kiri</label>
                                        <input type="text" name="pillar1_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar1_badge', $editLocale, $editLocale === 'ja' ? '01. モビリティ' : ($editLocale === 'id' ? '01. Mobilitas' : '01. Mobility')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Pill Subtitle Bawah</label>
                                        <input type="text" name="pillar1_pill_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar1_pill', $editLocale, $editLocale === 'ja' ? '電動化イニシアティブ' : ($editLocale === 'id' ? 'Inisiatif Elektrifikasi' : 'Electrification Initiative')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Kartu</label>
                                    <input type="text" name="pillar1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar1_title', $editLocale, __('messages.pillars.mobility_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul / Tagline Kartu</label>
                                    <input type="text" name="pillar1_desc_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar1_desc', $editLocale, __('messages.pillars.mobility_desc')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol</label>
                                        <input type="text" name="pillar1_btn_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar1_btn_text', $editLocale, __('messages.pillars.read_more')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Target Link</label>
                                        <input type="text" name="pillar1_link" value="{{ \App\Models\LandingPageSetting::get('pillar1_link', route('business.mobility'), false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Foto Background Kartu</label>
                                    <input type="file" name="pillar1_image_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:font-semibold">
                                    <span class="text-[10px] text-slate-400 mt-1 block">Saat ini: {{ \App\Models\LandingPageSetting::get('pillar1_image', 'images/business/p-product01-1117x719.jpg', false) }}</span>
                                </div>
                            </div>

                            <!-- Card 2: Industry -->
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                                    <h5 class="font-bold text-sm text-musashi-red font-mono uppercase">02. Kartu Industry</h5>
                                    <a href="{{ route('business.industry') }}" target="_blank" class="text-[10px] text-slate-500 hover:text-musashi-red">Lihat Halaman ↗</a>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Pojok Kiri</label>
                                        <input type="text" name="pillar2_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar2_badge', $editLocale, $editLocale === 'ja' ? '02. インダストリー' : ($editLocale === 'id' ? '02. Industri 4.0' : '02. Industry 4.0')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Pill Subtitle Bawah</label>
                                        <input type="text" name="pillar2_pill_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar2_pill', $editLocale, $editLocale === 'ja' ? 'スマートモノづくり' : ($editLocale === 'id' ? 'Evolusi Monozukuri' : 'Monozukuri Evolution')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Kartu</label>
                                    <input type="text" name="pillar2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar2_title', $editLocale, __('messages.pillars.industry_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul / Tagline Kartu</label>
                                    <input type="text" name="pillar2_desc_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar2_desc', $editLocale, __('messages.pillars.industry_desc')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol</label>
                                        <input type="text" name="pillar2_btn_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar2_btn_text', $editLocale, __('messages.pillars.read_more')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Target Link</label>
                                        <input type="text" name="pillar2_link" value="{{ \App\Models\LandingPageSetting::get('pillar2_link', route('business.industry'), false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Foto Background Kartu</label>
                                    <input type="file" name="pillar2_image_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:font-semibold">
                                    <span class="text-[10px] text-slate-400 mt-1 block">Saat ini: {{ \App\Models\LandingPageSetting::get('pillar2_image', 'images/business/industry-2-1117x642.jpg', false) }}</span>
                                </div>
                            </div>

                            <!-- Card 3: Energy -->
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                                    <h5 class="font-bold text-sm text-musashi-red font-mono uppercase">03. Kartu Energy</h5>
                                    <a href="{{ route('business.energy') }}" target="_blank" class="text-[10px] text-slate-500 hover:text-musashi-red">Lihat Halaman ↗</a>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Pojok Kiri</label>
                                        <input type="text" name="pillar3_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar3_badge', $editLocale, $editLocale === 'ja' ? '03. エネルギー' : ($editLocale === 'id' ? '03. Solusi Energi' : '03. Energy Solutions')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Pill Subtitle Bawah</label>
                                        <input type="text" name="pillar3_pill_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar3_pill', $editLocale, $editLocale === 'ja' ? '次世代バッテリー・BMS' : ($editLocale === 'id' ? 'BMS & Baterai Hibrida' : 'BMS & Energy Storage')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Kartu</label>
                                    <input type="text" name="pillar3_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar3_title', $editLocale, __('messages.pillars.energy_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul / Tagline Kartu</label>
                                    <input type="text" name="pillar3_desc_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar3_desc', $editLocale, __('messages.pillars.energy_desc')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol</label>
                                        <input type="text" name="pillar3_btn_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar3_btn_text', $editLocale, __('messages.pillars.read_more')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Target Link</label>
                                        <input type="text" name="pillar3_link" value="{{ \App\Models\LandingPageSetting::get('pillar3_link', route('business.energy'), false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Foto Background Kartu</label>
                                    <input type="file" name="pillar3_image_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:font-semibold">
                                    <span class="text-[10px] text-slate-400 mt-1 block">Saat ini: {{ \App\Models\LandingPageSetting::get('pillar3_image', 'images/business/energi-1117x560.jpg', false) }}</span>
                                </div>
                            </div>

                            <!-- Card 4: Well-being -->
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                                    <h5 class="font-bold text-sm text-musashi-red font-mono uppercase">04. Kartu Well-being</h5>
                                    <a href="{{ route('business.wellbeing') }}" target="_blank" class="text-[10px] text-slate-500 hover:text-musashi-red">Lihat Halaman ↗</a>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Pojok Kiri</label>
                                        <input type="text" name="pillar4_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar4_badge', $editLocale, $editLocale === 'ja' ? '04. ウェルビーイング' : ($editLocale === 'id' ? '04. Kesejahteraan Sosial' : '04. Social Well-being')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Pill Subtitle Bawah</label>
                                        <input type="text" name="pillar4_pill_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar4_pill', $editLocale, $editLocale === 'ja' ? '地域共生と社会貢献' : ($editLocale === 'id' ? 'Harmonisasi & Komunitas' : 'Community & Harmony')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Kartu</label>
                                    <input type="text" name="pillar4_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar4_title', $editLocale, __('messages.pillars.wellbeing_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul / Tagline Kartu</label>
                                    <input type="text" name="pillar4_desc_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar4_desc', $editLocale, __('messages.pillars.wellbeing_desc')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol</label>
                                        <input type="text" name="pillar4_btn_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar4_btn_text', $editLocale, __('messages.pillars.read_more')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Target Link</label>
                                        <input type="text" name="pillar4_link" value="{{ \App\Models\LandingPageSetting::get('pillar4_link', route('business.wellbeing'), false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Foto Background Kartu</label>
                                    <input type="file" name="pillar4_image_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:font-semibold">
                                    <span class="text-[10px] text-slate-400 mt-1 block">Saat ini: {{ \App\Models\LandingPageSetting::get('pillar4_image', 'images/business/well-being2-1117x556.jpg', false) }}</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ============================================================ -->
                    <!-- SUBTAB 2: HALAMAN LENGKAP 01. MOBILITY (/mobility)           -->
                    <!-- ============================================================ -->
                    <div x-show="pillarSubTab === 'mobility'" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div>
                                <h4 class="font-bold text-sm text-slate-900 uppercase font-mono">Konten Halaman Lengkap: 01. Mobility</h4>
                                <p class="text-xs text-slate-500">Tampil saat pengunjung mengklik 'Read More' pada kartu Mobility (URL: /mobility atau /business/mobility).</p>
                            </div>
                            <a href="{{ route('business.mobility') }}" target="_blank" class="text-xs font-bold text-musashi-red hover:underline">🔗 Buka Halaman ↗</a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Halaman</label>
                                <input type="text" name="pillar_mobility_page_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_mobility_page_title', $editLocale, 'Initiatives in electrification') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Seksi Konten</label>
                                <input type="text" name="pillar_mobility_sec_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_mobility_sec_title', $editLocale, 'Leading the EV Era with Precision Gears & Reduction Units') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul / Lead Paragraf</label>
                                <input type="text" name="pillar_mobility_page_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_mobility_page_subtitle', $editLocale, 'Not only precision parts, but we also keep creating products truly highly valuable in society') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Narasi Paragraf Lengkap (Sesuai Situs Resmi Musashi)</label>
                                <textarea name="pillar_mobility_page_content_{{ $editLocale }}" rows="7" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('pillar_mobility_page_content', $editLocale, "In recent years the EV market has grown rapidly.\nWhile global competition for development is increasing, the trend of outsourcing by automobile manufacturers is expanding. New opportunities for us are arising from more manufacturers or development projects and shorter development cycles. Differential assembly gears, our flagship product, and gears used for the reduction mechanism play the important role for EV. An increase in demand for these products is anticipated.\n\nAs a manufacturer dedicated to gears for mobility, the technology and knowledge accumulated for long time is a great advantage for us in the era of electrification. We also focus on developing reduction units for EVs by combining differential assembly gears and reduction gears. Based on the key device for the era of EV, we strive to make a further leap forward.") }}</textarea>
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Foto Unggulan Halaman Mobility</label>
                                <input type="file" name="pillar_mobility_page_image_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:font-semibold">
                                <span class="text-[10px] text-slate-400 mt-1 block">Default: images/business/p-product01-933x601.jpg</span>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================================ -->
                    <!-- SUBTAB 3: HALAMAN LENGKAP 02. INDUSTRY (/industry)           -->
                    <!-- ============================================================ -->
                    <div x-show="pillarSubTab === 'industry'" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div>
                                <h4 class="font-bold text-sm text-slate-900 uppercase font-mono">Konten Halaman Lengkap: 02. Industry 4.0</h4>
                                <p class="text-xs text-slate-500">Tampil saat pengunjung mengklik 'Read More' pada kartu Industry (URL: /industry atau /business/industry).</p>
                            </div>
                            <a href="{{ route('business.industry') }}" target="_blank" class="text-xs font-bold text-musashi-red hover:underline">🔗 Buka Halaman ↗</a>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Halaman</label>
                                <input type="text" name="pillar_industry_page_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_industry_page_title', $editLocale, 'Industry 4.0 -Evolution of Monozukuri') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>

                            <!-- Bagian 1: AI Visual Inspection System -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-musashi-red uppercase block">SEKSI 01: AI VISUAL INSPECTION SYSTEM</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Seksi 01</label>
                                    <input type="text" name="pillar_industry_sec1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_industry_sec1_title', $editLocale, 'AI Visual Inspection System') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Narasi Seksi 01</label>
                                    <textarea name="pillar_industry_sec1_content_{{ $editLocale }}" rows="5" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('pillar_industry_sec1_content', $editLocale, "Musashi is working on the transformation of manufacturing leading a new era. To grasp a chance to expand new markets resulting from Industry 4.0, we bring a smart factory into reality. Tools & Machinery provides a new answer to every need in manufacturing on the floor by utilizing our 'weapon' of the accumulated technology of fabricating unique equipment, prototypes, jigs, dies and cutting tools.\n\nManual transfer or visual inspection is a long-hour routine process requiring high load in production. Under the slogan 'human jobs for humans', Musashi AI is working on Monozukuri innovation by implementing AI in production to release people from high-load routine work.") }}</textarea>
                                </div>
                            </div>

                            <!-- Bagian 2: Autonomous Moving Robot -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-musashi-red uppercase block">SEKSI 02: AUTONOMOUS MOVING ROBOT</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Seksi 02</label>
                                    <input type="text" name="pillar_industry_sec2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_industry_sec2_title', $editLocale, 'Autonomous Moving Robot') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Narasi Seksi 02</label>
                                    <textarea name="pillar_industry_sec2_content_{{ $editLocale }}" rows="5" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('pillar_industry_sec2_content', $editLocale, "Based with our 'human jobs for humans', we are innovating manufacturing by integrating AI into production processes. Our products are delivered to customers through the process of transfer, machining, and inspection.\n\nMachining is a core of 'Monozukuri' that values are added by human technology and judgment. The process of transfer and visual inspection, on the other hand, is a long-hour and high-load routine work. Human beings, however, are naturally creative. By automating repetitive tasks, we can enable people to focus on innovation and continue developing their work. We are committed to creating an environment that allows individuals to engage in meaningful and creative roles. We aim to keep providing our group plants as well as global manufacturers with a wide range of technologies.") }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================================ -->
                    <!-- SUBTAB 4: HALAMAN LENGKAP 03. ENERGY (/energy)               -->
                    <!-- ============================================================ -->
                    <div x-show="pillarSubTab === 'energy'" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div>
                                <h4 class="font-bold text-sm text-slate-900 uppercase font-mono">Konten Halaman Lengkap: 03. Energy</h4>
                                <p class="text-xs text-slate-500">Tampil saat pengunjung mengklik 'Read More' pada kartu Energy (URL: /energy atau /business/energy).</p>
                            </div>
                            <a href="{{ route('business.energy') }}" target="_blank" class="text-xs font-bold text-musashi-red hover:underline">🔗 Buka Halaman ↗</a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Halaman</label>
                                <input type="text" name="pillar_energy_page_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_energy_page_title', $editLocale, 'Energy Solution') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Seksi Konten</label>
                                <input type="text" name="pillar_energy_sec_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_energy_sec_title', $editLocale, 'Advanced Development and Manufacturing of Lithium-Ion Capacitors') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul / Slogan Energi</label>
                                <input type="text" name="pillar_energy_page_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_energy_page_subtitle', $editLocale, 'Applying technologies developed for automobility in various fields. We create energy - livelihood of the people barriers and go on adventures!') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Narasi Paragraf Lengkap</label>
                                <textarea name="pillar_energy_page_content_{{ $editLocale }}" rows="5" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('pillar_energy_page_content', $editLocale, "Musashi Energy Solutions Co., Ltd. thoroughly develops and manufactures lithium iron capacitors. Our products range from backup power systems to auxiliary power sources for fuel cell vehicles, contributing to the advancement of a future energy society.") }}</textarea>
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Foto Unggulan Halaman Energy</label>
                                <input type="file" name="pillar_energy_page_image_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:font-semibold">
                                <span class="text-[10px] text-slate-400 mt-1 block">Default: images/business/energy-975x387.png</span>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================================ -->
                    <!-- SUBTAB 5: HALAMAN LENGKAP 04. WELL-BEING (/well-being)       -->
                    <!-- ============================================================ -->
                    <div x-show="pillarSubTab === 'wellbeing'" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div>
                                <h4 class="font-bold text-sm text-slate-900 uppercase font-mono">Konten Halaman Lengkap: 04. Well-being</h4>
                                <p class="text-xs text-slate-500">Tampil saat pengunjung mengklik 'Read More' pada kartu Well-being (URL: /well-being atau /business/well-being).</p>
                            </div>
                            <a href="{{ route('business.wellbeing') }}" target="_blank" class="text-xs font-bold text-musashi-red hover:underline">🔗 Buka Halaman ↗</a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Halaman</label>
                                <input type="text" name="pillar_wellbeing_page_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_wellbeing_page_title', $editLocale, 'Well-being') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Seksi Konten</label>
                                <input type="text" name="pillar_wellbeing_sec_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_wellbeing_sec_title', $editLocale, 'Sustainable Business Models Contributing to Societal Well-being') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul / Tagline Halaman</label>
                                <input type="text" name="pillar_wellbeing_page_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('pillar_wellbeing_page_subtitle', $editLocale, 'Musashi\'s new business enriches people\'s lives and solves local social issues') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Narasi Paragraf Lengkap</label>
                                <textarea name="pillar_wellbeing_page_content_{{ $editLocale }}" rows="5" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('pillar_wellbeing_page_content', $editLocale, "The only condition we set to launch a new business is it should be a sustainable business model that contributes to the well-being of society. We produce startup projects proactively, including 'Agritrio' founded in 2017 as part of our new business creation program to solve farmers' issues, and 'icuco' to visualize child caring concerns of families and caretakers.\n\nFocusing on the functional ingredients of plants yielded in the soil of the East Mikawa region, our bio business includes M Lab which undertakes collaborative research with universities, Plant Bio Factory for production based on such research projects, and Waphyto which offers inner and outer care products based on phytochemical therapy. Contributing to people's health, our business will develop to support a life of 100 years.") }}</textarea>
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Foto Unggulan Halaman Well-being</label>
                                <input type="file" name="pillar_wellbeing_page_image_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:font-semibold">
                                <span class="text-[10px] text-slate-400 mt-1 block">Default: images/business/well-being4-481x687.jpg</span>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================================ -->
                    <!-- SUBTAB 6: HALAMAN NAVBAR TECHNOLOGY & INNOVATION             -->
                    <!-- ============================================================ -->
                    <div x-show="pillarSubTab === 'technoinnov'" class="space-y-6">
                        
                        <!-- Technology Page Settings -->
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <div>
                                    <h4 class="font-bold text-sm text-slate-900 uppercase font-mono">Halaman /business/technology</h4>
                                    <p class="text-xs text-slate-500">Tampil saat pengunjung mengklik menu Business -> Technology di navbar.</p>
                                </div>
                                <a href="{{ route('business.technology') }}" target="_blank" class="text-xs font-bold text-musashi-red hover:underline">🔗 Buka Halaman ↗</a>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Halaman</label>
                                    <input type="text" name="tech_page_main_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_page_main_title', $editLocale, 'Technology') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul Pengantar</label>
                                    <input type="text" name="tech_page_main_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_page_main_subtitle', $editLocale, 'Recognizing the needs of our customers, we continue to develop original and innovative technologies that enrich lives and support a sustainable future.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                </div>
                            </div>

                            <!-- 3 Tech Pillars Details -->
                            <div class="space-y-4 pt-2">
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                    <span class="text-xs font-mono font-bold text-musashi-red uppercase">01. Product Development Capability</span>
                                    <input type="text" name="tech_p1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_p1_title', $editLocale, '01. Product development Capability') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                                    <input type="text" name="tech_p1_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_p1_subtitle', $editLocale, 'Providing Solutions with Leading-Edge Technologies') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    <textarea name="tech_p1_content_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('tech_p1_content', $editLocale, "The strength of 'Monozukuri' carved out in a history of more than 80 years Musashi's strengths include solid technical capabilities which have been carved out in a history of more than 80 years, know-how owned by manufacturing on the floor, and global development in 35 production plants in 14 countries. Also, collaborations with partners connected through open innovations bring out businesses with new technologies which can contribute to the development of a rich global society which humans and the environment are in harmony.") }}</textarea>
                                </div>

                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                    <span class="text-xs font-mono font-bold text-musashi-red uppercase">02. Integrated Production System</span>
                                    <input type="text" name="tech_p2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_p2_title', $editLocale, '02. Integrated Production System') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                                    <input type="text" name="tech_p2_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_p2_subtitle', $editLocale, 'Centered on Forging and Precision Processing Technology through high quality and low cost globally') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    <textarea name="tech_p2_content_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('tech_p2_content', $editLocale, "The Musashi Group has established an integrated production system that seamlessly combines forging, lathing, heat treatment, finishing, and assembly. This system enables us to implement Kaizen activities from a perspective of total optimization, helping us to enhance our strengths and address our weaknesses. As a result, we are able to produce high-quality, cost-effective products that meet customer needs. Our group companies share technologies and expertise, leveraging these as a competitive advantage in the global market.") }}</textarea>
                                </div>

                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                    <span class="text-xs font-mono font-bold text-musashi-red uppercase">03. Support Technology</span>
                                    <input type="text" name="tech_p3_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_p3_title', $editLocale, '03. Support Technology') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-bold">
                                    <input type="text" name="tech_p3_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_p3_subtitle', $editLocale, 'Supporting the Integrated Production System through In-House Manufacturing and Know-How') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    <textarea name="tech_p3_content_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('tech_p3_content', $editLocale, "By accumulating technology and expertise through our integrated production system, Musashi has developed top-tier support technology that sets us apart from others. This accumulated know-how allows us to maintain the highest standards and differentiate ourselves in the industry.") }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Innovation Page Settings -->
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <div>
                                    <h4 class="font-bold text-sm text-slate-900 uppercase font-mono">Halaman /business/innovation</h4>
                                    <p class="text-xs text-slate-500">Tampil saat pengunjung mengklik menu Business -> Innovation di navbar.</p>
                                </div>
                                <a href="{{ route('business.innovation') }}" target="_blank" class="text-xs font-bold text-musashi-red hover:underline">🔗 Buka Halaman ↗</a>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Halaman</label>
                                    <input type="text" name="innov_page_main_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_page_main_title', $editLocale, 'Innovation') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Seksi Inovasi</label>
                                    <input type="text" name="innov_sec_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_sec_title', $editLocale, 'Open Innovation Network') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                </div>
                                <div class="col-span-full">
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Subjudul Pengantar</label>
                                    <input type="text" name="innov_page_main_subtitle_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_page_main_subtitle', $editLocale, 'Leveraging our internal capabilities and external collaborations, we are development of innovation to solve the societal challenges of today and tomorrow.') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                </div>
                                <div class="col-span-full">
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Narasi Terbuka (SDGs & Inovasi)</label>
                                    <textarea name="innov_sec_content_{{ $editLocale }}" rows="5" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('innov_sec_content', $editLocale, "In addition to our core business, we are committed to contributing to the achievement of the Sustainable Development Goals (SDGs) across a broad spectrum. We promote Industry 4.0 through advanced AI technology development and are dedicated to creating and expanding new businesses in areas such as energy solutions, industrial evolution, agriculture, and biotechnology. This is achieved through the development of open innovation networks.") }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Bottom Floating Save Bar -->
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-8 py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-lg hover:shadow-xl transition-all cursor-pointer">
                            💾 Simpan Seluruh Pengaturan Bisnis & Pilar
                        </button>
                    </div>
                </form>
            </div>

            <!-- ========================================== -->
            <!-- TAB 6: PRODUK & EV KATALOG                -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'products'" class="space-y-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Katalog Produk & EV Powertrain</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Kelola komponen transmisi, e-Axle, dan tandai produk unggulan untuk landing page.</p>
                    </div>
                    <button 
                        @click="showCreateProduct = !showCreateProduct" 
                        type="button" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span x-text="showCreateProduct ? 'Tutup Formulir' : '+ Tambah Produk Baru'"></span>
                    </button>
                </div>

                <!-- Pengaturan Tampilan Header Seksi Produk Landing Page (#products) -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                    <form action="{{ route('superadmin.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="redirect_tab" value="products">
                        <input type="hidden" name="redirect_lang" :value="editLocale">

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">Pengaturan Header Seksi Produk di Landing Page (#products)</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Bahasa Aktif: <strong class="uppercase text-musashi-red" x-text="editLocale"></strong></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Seksi Produk</label>
                                <input type="text" name="products_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('products_badge', $editLocale, __('messages.nav.product')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black" placeholder="Contoh: PRODUK UNGGULAN">
                                <span class="text-[10px] text-slate-400 mt-1 block">Badge kecil di atas headline seksi produk.</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Seksi Produk</label>
                                <input type="text" name="products_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('products_title', $editLocale, __('messages.products_section.title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold" placeholder="Contoh: Katalog Komponen Otomotif & EV">
                                <span class="text-[10px] text-slate-400 mt-1 block">Headline besar seksi produk.</span>
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Pengantar Seksi Produk</label>
                                <textarea name="products_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('products_desc', $editLocale, __('messages.products_section.desc')) }}</textarea>
                                <span class="text-[10px] text-slate-400 mt-1 block">Paragraf pengantar yang tampil di bawah judul produk.</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol Lihat Semua Produk</label>
                                <input type="text" name="products_view_all_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('products_view_all_text', $editLocale, __('messages.products_section.view_all')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black" placeholder="Contoh: Buka Katalog Lengkap">
                                <span class="text-[10px] text-slate-400 mt-1 block">Teks tombol pojok kanan seksi produk.</span>
                            </div>
                        </div>

                        <div class="flex justify-end pt-1">
                            <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm cursor-pointer">
                                💾 Simpan Header Produk
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Form Tambah Produk -->
                <div x-show="showCreateProduct" x-transition class="bg-white border-2 border-red-200 rounded-2xl p-6 sm:p-8 shadow-md">
                    <form action="{{ route('superadmin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nama Produk *</label>
                                <input type="text" name="name" required placeholder="Contoh: Compact e-Axle Electric Drive Unit" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Kategori Produk *</label>
                                <input type="text" name="category" required placeholder="Contoh: EV / Future Mobility atau 2-Wheel" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                        </div>
                        <div>
                            <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Produk *</label>
                            <textarea name="description" rows="3" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black"></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1.5 font-bold flex items-center justify-between">
                                    <span>Upload Foto Produk (Bisa 1 s/d 10+ Foto) *</span>
                                    <span class="text-musashi-red text-[10px] font-bold">Multi-Upload Didukung</span>
                                </label>
                                <input type="file" 
                                       multiple 
                                       accept="image/*" 
                                       @change="async (e) => {
                                           isCompressingPhotos = true;
                                           const files = Array.from(e.target.files || []);
                                           for (const f of files) {
                                               const res = await window.compressFileToDataUrl(f);
                                               if (res) createProductPhotos.push(res);
                                           }
                                           e.target.value = '';
                                           isCompressingPhotos = false;
                                       }"
                                       class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-musashi-red hover:file:bg-red-100 cursor-pointer border border-slate-200 rounded-xl p-1.5 bg-white">
                                <span class="text-[10px] text-slate-500 block mt-1.5">
                                    💡 <strong>Tips:</strong> Anda bisa memilih <strong>1, 3, 5, bahkan 10 foto sekaligus</strong>. Foto pertama (#1) otomatis menjadi cover utama, dan foto lainnya menjadi galeri produk.
                                </span>

                                <!-- Loading / Optimizing Indicator -->
                                <div x-show="isCompressingPhotos" style="display: none;" class="mt-2 text-xs font-mono text-musashi-red flex items-center gap-1.5 animate-pulse">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                    <span>Memproses & mengoptimalkan foto...</span>
                                </div>

                                <!-- Preview Grid with Red 'X' Delete Button on Top Right -->
                                <div x-show="createProductPhotos.length > 0" class="mt-3 p-3.5 bg-red-50/50 border border-red-200/80 rounded-2xl space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-mono text-slate-800 uppercase font-bold flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-musashi-red" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>
                                            <span>Foto Terpilih (<span x-text="createProductPhotos.length"></span> Foto) — Klik <span class="text-musashi-red font-bold">X</span> untuk menghapus:</span>
                                        </span>
                                        <button type="button" @click="createProductPhotos = []" class="text-[10px] text-red-600 hover:text-red-800 font-mono font-bold hover:underline">Hapus Semua</button>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <template x-for="(pic, idx) in createProductPhotos" :key="idx">
                                            <div class="relative w-20 h-20 rounded-xl overflow-visible border-2 border-slate-300 bg-white shadow-xs group">
                                                <div class="w-full h-full rounded-[10px] overflow-hidden">
                                                    <img :src="pic" class="w-full h-full object-cover">
                                                </div>
                                                <!-- Red Circle 'X' Button on Top Right -->
                                                <button type="button" 
                                                        @click="createProductPhotos.splice(idx, 1)" 
                                                        title="Hapus / batalkan foto ini"
                                                        class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-115 cursor-pointer border-2 border-white z-20">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                                <span class="absolute bottom-0 inset-x-0 bg-black/80 text-white text-[9px] font-mono text-center py-0.5 rounded-b-[9px]" x-text="idx === 0 ? '#1 Cover' : '#' + (idx + 1)"></span>
                                                <input type="hidden" name="new_data_images[]" :value="pic">
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="is_featured" value="1" checked class="rounded border-slate-300 text-musashi-red">
                                    <span class="text-xs font-bold text-slate-900">Tampilkan sebagai Produk Unggulan di Landing Page</span>
                                </label>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
                            <button type="button" @click="showCreateProduct = false; createProductPhotos = [];" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600">Batal</button>
                            <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm">Simpan Produk</button>
                        </div>
                    </form>
                </div>

                <!-- Products Table -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-[11px] font-mono uppercase text-slate-500 border-b border-slate-200">
                                <tr>
                                    <th class="py-3 px-4">Foto Galeri</th>
                                    <th class="py-3 px-4">Nama Produk</th>
                                    <th class="py-3 px-4">Kategori</th>
                                    <th class="py-3 px-4 text-center">Status Featured</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($productsList as $prod)
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="py-3 px-4 w-24">
                                            <div class="relative inline-block">
                                                <img src="{{ asset($prod->image) }}" alt="" class="w-14 h-11 object-cover rounded-lg border border-slate-200">
                                                @if(count($prod->all_images) > 1)
                                                    <span class="absolute -bottom-1 -right-1 px-1.5 py-0.5 rounded-full text-[9px] font-mono font-bold bg-slate-900 text-white shadow-xs">
                                                        +{{ count($prod->all_images) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 font-bold text-slate-900">{{ $prod->name }}</td>
                                        <td class="py-3 px-4 text-slate-600 font-mono">{{ $prod->category }}</td>
                                        <td class="py-3 px-4 text-center">
                                            <form action="{{ route('superadmin.product.toggle', $prod) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase {{ $prod->is_featured ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-slate-100 text-slate-500' }}">
                                                    {{ $prod->is_featured ? '★ Featured' : 'Standar' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="py-3 px-4 text-right space-x-1 whitespace-nowrap">
                                            <button 
                                                @click="editingProduct = JSON.parse(JSON.stringify({{ json_encode($prod) }})); editProductNewPhotos = [];" 
                                                class="px-2.5 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors">
                                                Edit
                                            </button>
                                            <form action="{{ route('superadmin.products.destroy', $prod) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2.5 py-1 rounded bg-red-50 text-red-700 font-bold hover:bg-red-100">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Edit Produk -->
                <div x-show="editingProduct !== null" style="display: none;" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
                    <div @click.away="editingProduct = null; editProductNewPhotos = [];" class="bg-white rounded-2xl max-w-xl w-full p-6 sm:p-8 space-y-5 max-h-[90vh] overflow-y-auto shadow-2xl">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                            <h4 class="text-base font-extrabold text-slate-900">Edit Produk & Galeri EV</h4>
                            <button @click="editingProduct = null; editProductNewPhotos = [];" class="text-slate-400 hover:text-black text-xl font-bold">&times;</button>
                        </div>
                        <template x-if="editingProduct">
                            <form :action="'/SuperadminMusashi/products/' + editingProduct.id + '/update'" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nama Produk *</label>
                                        <input type="text" name="name" :value="editingProduct.name" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Kategori *</label>
                                        <input type="text" name="category" :value="editingProduct.category" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Produk *</label>
                                    <textarea name="description" rows="3" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black" x-text="editingProduct.description"></textarea>
                                </div>

                                <!-- Hidden input to submit updated list of retained existing photos -->
                                <input type="hidden" name="has_existing_images_list" value="1">
                                <input type="hidden" name="existing_images_json" :value="JSON.stringify(editingProduct.all_images || [])">

                                <!-- Current Photos in Edit Modal with Red 'X' Delete Button -->
                                <div x-show="editingProduct.all_images && editingProduct.all_images.length" class="p-3.5 bg-slate-50 border border-slate-200 rounded-xl space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-mono text-slate-700 uppercase font-bold block">
                                            Foto Saat Ini Terpasang (<span x-text="editingProduct.all_images.length"></span> Foto):
                                        </span>
                                        <span class="text-[10px] text-slate-500 font-mono">
                                            💡 Klik tanda <strong class="text-red-600 font-bold">X merah</strong> pada foto untuk menghapus foto itu
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <template x-for="(pic, pidx) in editingProduct.all_images" :key="pidx">
                                            <div class="relative w-20 h-20 rounded-xl overflow-visible border-2 border-slate-200 bg-white shadow-xs group">
                                                <div class="w-full h-full rounded-[10px] overflow-hidden bg-slate-100 flex items-center justify-center">
                                                    <img :src="pic" 
                                                         class="w-full h-full object-cover"
                                                         onerror="this.onerror=null; this.src='/images/products/product-transmission-gear.jpg'; this.classList.add('opacity-40');">
                                                </div>
                                                <!-- Red Circle 'X' Button on Top Right -->
                                                <button type="button" 
                                                        @click="editingProduct.all_images.splice(pidx, 1)" 
                                                        title="Hapus foto ini dari produk"
                                                        class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-115 cursor-pointer border-2 border-white z-20">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                                <span class="absolute bottom-0 inset-x-0 bg-black/75 text-white text-[9px] font-mono text-center py-0.5 rounded-b-[9px]" x-text="pidx === 0 ? '#1 Cover' : '#' + (pidx + 1)"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold flex items-center justify-between">
                                            <span>Upload / Tambah Foto Baru (Bisa Banyak)</span>
                                            <span class="text-musashi-red text-[10px] font-bold">Multi-Upload</span>
                                        </label>
                                        <input type="file" 
                                               multiple 
                                               accept="image/*" 
                                               @change="async (e) => {
                                                   isCompressingPhotos = true;
                                                   const files = Array.from(e.target.files || []);
                                                   for (const f of files) {
                                                       const res = await window.compressFileToDataUrl(f);
                                                       if (res) editProductNewPhotos.push(res);
                                                   }
                                                   e.target.value = '';
                                                   isCompressingPhotos = false;
                                               }"
                                               class="w-full text-xs text-slate-500 border border-slate-200 rounded-xl p-1 bg-white file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-musashi-red hover:file:bg-red-100 cursor-pointer">
                                        <span class="text-[10px] text-slate-400 block mt-1">
                                            Bisa pilih beberapa foto sekaligus (hingga 10 foto).
                                        </span>

                                        <!-- Loading indicator -->
                                        <div x-show="isCompressingPhotos" style="display: none;" class="mt-1.5 text-xs font-mono text-musashi-red flex items-center gap-1.5 animate-pulse">
                                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                            <span>Memproses & mengoptimalkan foto baru...</span>
                                        </div>

                                        <!-- Preview of Newly Added Photos with 'X' button -->
                                        <div x-show="editProductNewPhotos.length > 0" class="mt-2.5 p-3 bg-red-50/60 border border-red-200 rounded-xl space-y-2">
                                            <div class="flex items-center justify-between">
                                                <span class="text-[11px] font-mono text-slate-800 uppercase font-bold flex items-center gap-1">
                                                    <span class="text-musashi-red">+ Foto Baru yang Dipilih</span> (<span x-text="editProductNewPhotos.length"></span> foto) — Klik tanda <span class="text-musashi-red font-bold">X</span> untuk membatalkan:
                                                </span>
                                                <button type="button" @click="editProductNewPhotos = []" class="text-[10px] text-red-600 hover:text-red-800 font-mono font-bold hover:underline">Batalkan Semua</button>
                                            </div>
                                            <div class="flex flex-wrap gap-3">
                                                <template x-for="(npic, nidx) in editProductNewPhotos" :key="'new_prod_'+nidx">
                                                    <div class="relative w-20 h-20 rounded-xl overflow-visible border-2 border-red-300 bg-white shadow-xs group">
                                                        <div class="w-full h-full rounded-[10px] overflow-hidden">
                                                            <img :src="npic" class="w-full h-full object-cover">
                                                        </div>
                                                        <!-- Delete 'X' Button on Top Right -->
                                                        <button type="button" 
                                                                @click="editProductNewPhotos.splice(nidx, 1)" 
                                                                title="Batalkan foto baru ini"
                                                                class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-115 cursor-pointer border-2 border-white z-20">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                        </button>
                                                        <span class="absolute bottom-0 inset-x-0 bg-red-600/90 text-white text-[8px] font-mono text-center py-0.5 rounded-b-[9px]">Baru</span>
                                                        <input type="hidden" name="new_data_images[]" :value="npic">
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" name="is_featured" value="1" :checked="editingProduct.is_featured" class="rounded border-slate-300 text-musashi-red">
                                            <span class="text-xs font-bold text-slate-900">Tampilkan di Landing Page (Featured)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-slate-200 flex justify-end gap-2">
                                    <button type="button" @click="editingProduct = null; editProductNewPhotos = [];" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">Batal</button>
                                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred">Simpan Perubahan</button>
                                </div>
                            </form>
                        </template>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 7: DEWAN DIREKSI (BOD)                -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'directors'" class="space-y-6">
                <!-- Action Header Bar -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Dewan Direksi (Board of Directors)</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Kelola pimpinan PT Musashi Auto Parts Indonesia yang tampil di halaman Board of Directors dan seksi Direksi Landing Page.</p>
                    </div>
                    <button 
                        @click="showCreateDirector = !showCreateDirector" 
                        type="button" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span x-text="showCreateDirector ? 'Tutup Formulir' : '+ Tambah Direktur'"></span>
                    </button>
                </div>

                <!-- 1. Pengaturan Header Seksi Dewan Direksi Landing Page (#directors) & Halaman Publik -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                    <form action="{{ route('superadmin.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="redirect_tab" value="directors">
                        <input type="hidden" name="redirect_lang" :value="editLocale">

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-musashi-red"></span>
                                <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">1. Pengaturan Tampilan Seksi Direksi di Landing Page (#directors)</h4>
                            </div>
                            <span class="text-[10px] font-mono text-slate-400">Bahasa Aktif: <strong class="uppercase text-musashi-red" x-text="editLocale"></strong></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Seksi Direksi</label>
                                <input type="text" name="bod_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('bod_badge', $editLocale, __('messages.nav.bod')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Headline Direksi</label>
                                <input type="text" name="bod_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('bod_title', $editLocale, __('messages.bod_section.title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-semibold">
                            </div>
                        </div>

                        <div>
                            <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Narasi Seksi Direksi</label>
                            <textarea name="bod_desc_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('bod_desc', $editLocale, __('messages.bod_section.desc')) }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm">
                                💾 Simpan Judul Seksi Direksi
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 2. Form Tambah Direktur Baru -->
                <div x-show="showCreateDirector" x-transition class="bg-white border-2 border-red-200 rounded-2xl p-6 sm:p-8 shadow-md">
                    <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-100">
                        <span class="w-2.5 h-2.5 rounded-full bg-musashi-red"></span>
                        <h4 class="font-extrabold text-sm text-slate-900 uppercase font-mono">Form Tambah Direktur Baru</h4>
                    </div>
                    <form action="{{ route('superadmin.directors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="redirect_lang" :value="editLocale">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nama Lengkap *</label>
                                <input type="text" name="name" required placeholder="Contoh: Asep Nugraha" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Jabatan / Title *</label>
                                <input type="text" name="title" required placeholder="Contoh: President Director" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                        </div>
                        <div>
                            <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Biografi Singkat</label>
                            <textarea name="bio" rows="3" placeholder="Deskripsi dedikasi kepemimpinan dan latar belakang eksekutif..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black"></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Foto Direktur (PNG / JPG)</label>
                                <input type="file" name="photo" accept="image/*" class="w-full text-xs text-slate-500">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nomor Urutan Tampil</label>
                                <input type="number" name="order" value="{{ $directorsList->count() + 1 }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                            </div>
                        </div>
                        <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
                            <button type="button" @click="showCreateDirector = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600">Batal</button>
                            <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred">Simpan Direktur</button>
                        </div>
                    </form>
                </div>

                <!-- 3. Daftar Dewan Direksi -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($directorsList as $dir)
                        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs flex flex-col justify-between hover:border-slate-300 transition-all">
                            <div>
                                <div class="flex items-center gap-4 mb-3">
                                    <img src="{{ asset($dir->photo) }}" alt="{{ $dir->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-slate-200 flex-shrink-0">
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-sm text-slate-900 truncate">{{ $dir->name }}</h4>
                                        <span class="text-xs text-musashi-red font-medium block truncate">{{ $dir->title }}</span>
                                        <span class="text-[10px] text-slate-400 font-mono">Urutan: #{{ $dir->order }}</span>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-600 line-clamp-3 mb-4 leading-relaxed">{{ $dir->bio }}</p>
                            </div>
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                                <span class="text-[10px] font-mono text-slate-400">ID: {{ $dir->id }}</span>
                                <div class="flex items-center gap-2">
                                    <button 
                                        @click="editingDirector = JSON.parse(atob('{{ base64_encode(json_encode($dir)) }}'))" 
                                        class="text-xs text-slate-700 hover:text-black font-semibold px-2.5 py-1 rounded bg-slate-100 hover:bg-slate-200 transition-colors">
                                        Edit
                                    </button>
                                    <form action="{{ route('superadmin.directors.destroy', $dir) }}" method="POST" onsubmit="return confirm('Hapus direktur {{ $dir->name }} dari daftar?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="redirect_lang" :value="editLocale">
                                        <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-semibold px-2.5 py-1 rounded bg-red-50 hover:bg-red-100 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white rounded-2xl p-12 text-center border border-slate-200">
                            <p class="text-xs text-slate-400 font-mono">Belum ada direktur terdaftar. Klik '+ Tambah Direktur' untuk menambahkan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Modal Edit Direktur -->
                <div x-show="editingDirector !== null" style="display: none;" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
                    <div @click.away="editingDirector = null" class="bg-white rounded-2xl max-w-xl w-full p-6 sm:p-8 space-y-5 max-h-[90vh] overflow-y-auto shadow-2xl">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                            <h4 class="text-base font-extrabold text-slate-900">Edit Dewan Direksi</h4>
                            <button @click="editingDirector = null" class="text-slate-400 hover:text-black text-xl font-bold">&times;</button>
                        </div>
                        <template x-if="editingDirector">
                            <form :action="'/SuperadminMusashi/directors/' + editingDirector.id + '/update'" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <input type="hidden" name="redirect_lang" :value="editLocale">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nama Lengkap *</label>
                                        <input type="text" name="name" :value="editingDirector.name" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Jabatan / Title *</label>
                                        <input type="text" name="title" :value="editingDirector.title" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Biografi Singkat</label>
                                    <textarea name="bio" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black" x-text="editingDirector.bio"></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Ganti Foto (Opsional)</label>
                                        <input type="file" name="photo" accept="image/*" class="w-full text-xs text-slate-500">
                                    </div>
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nomor Urutan Tampil</label>
                                        <input type="number" name="order" :value="editingDirector.order" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-slate-200 flex justify-end gap-2">
                                    <button type="button" @click="editingDirector = null" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">Batal</button>
                                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred">Simpan Perubahan</button>
                                </div>
                            </form>
                        </template>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB: TEKNOLOGI & SMART MONOZUKURI         -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'technology'" class="space-y-6">
                <form action="{{ route('superadmin.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_tab" value="technology">
                    <input type="hidden" name="redirect_lang" :value="editLocale">

                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-red-50 text-musashi-red border border-red-200 uppercase">Landing Page Section #4</span>
                                <span class="text-xs font-mono text-slate-400">#technology</span>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900">Teknologi & Smart Monozukuri</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Kelola narasi riset manufaktur, pilar inovasi, tombol navigasi, dan visual fasilitas pabrik.</p>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm transition-all cursor-pointer">
                            💾 Simpan Teknologi
                        </button>
                    </div>

                    <!-- 1. Header & Headline Narasi -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">1</span>
                                Header & Narasi Utama Teknologi
                            </h4>
                            <span class="text-[11px] font-mono text-slate-400">Bahasa aktif: <span class="font-bold text-slate-700 uppercase" x-text="editLocale"></span></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Kategori</label>
                                <input type="text" name="tech_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_badge', $editLocale, __('messages.nav.technology')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                <span class="text-[10px] text-slate-400 mt-1 block">Tampil di pill badge atas (misal: "TEKNOLOGI & MONOZUKURI")</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Seksi</label>
                                <input type="text" name="tech_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_title', $editLocale, __('messages.tech_section.title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                <span class="text-[10px] text-slate-400 mt-1 block">Headline besar seksi (misal: "Tantangan untuk Monozukuri Baru")</span>
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Narasi Utama</label>
                                <textarea name="tech_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('tech_desc', $editLocale, __('messages.tech_section.desc')) }}</textarea>
                                <span class="text-[10px] text-slate-400 mt-1 block">Paragraf pengantar filosofi rekayasa presisi Musashi.</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Dua Pilar Teknologi & Keunggulan -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">2</span>
                                3 Pilar Inti Rekayasa & Manufaktur
                            </h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Pillar 1 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-musashi-red block">PILAR 01: PRODUCT DEVELOPMENT</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar 1</label>
                                    <input type="text" name="tech_pillar1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_pillar1_title', $editLocale, __('messages.tech_section.pillar1_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Pilar 1</label>
                                    <textarea name="tech_pillar1_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('tech_pillar1_desc', $editLocale, __('messages.tech_section.pillar1_desc')) }}</textarea>
                                </div>
                            </div>

                            <!-- Pillar 2 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-musashi-red block">PILAR 02: INTEGRATED PRODUCTION</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar 2</label>
                                    <input type="text" name="tech_pillar2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_pillar2_title', $editLocale, __('messages.tech_section.pillar2_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Pilar 2</label>
                                    <textarea name="tech_pillar2_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('tech_pillar2_desc', $editLocale, __('messages.tech_section.pillar2_desc')) }}</textarea>
                                </div>
                            </div>

                            <!-- Pillar 3 -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-musashi-red block">PILAR 03: SUPPORT TECHNOLOGY</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar 3</label>
                                    <input type="text" name="tech_pillar3_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_pillar3_title', $editLocale, __('messages.tech_section.pillar3_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Pilar 3</label>
                                    <textarea name="tech_pillar3_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('tech_pillar3_desc', $editLocale, __('messages.tech_section.pillar3_desc')) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Tombol Aksi (Call To Action) Teknologi -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">3</span>
                                Tombol Navigasi Seksi Teknologi
                            </h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-slate-700 block">TOMBOL TEKNOLOGI (KE HALAMAN TEKNOLOGI)</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol (Bahasa: {{ strtoupper($editLocale) }})</label>
                                    <input type="text" name="tech_btn1_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_btn1_text', $editLocale, __('messages.tech_section.btn_tech')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Target URL / Link</label>
                                    <input type="text" name="tech_btn1_link" value="{{ \App\Models\LandingPageSetting::get('tech_btn1_link', route('business.technology'), false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Visual Galeri Fasilitas Pabrik & Multi-Foto Slider (Teknologi) -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-6"
                         x-data="{
                             techImages: {{ json_encode($techGalleryImages ?? \App\Models\LandingPageSetting::getTechGalleryImages()) }},
                             removeTechImage(index) {
                                 this.techImages.splice(index, 1);
                             }
                         }">
                        <input type="hidden" name="tech_gallery_submitted" value="1">
                        <template x-for="(img, idx) in techImages" :key="idx">
                            <input type="hidden" name="tech_gallery_existing[]" :value="img">
                        </template>

                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div>
                                <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">4</span>
                                    Galeri Foto Fasilitas & Rekayasa Teknologi (Multi-Foto Slider)
                                </h4>
                                <p class="text-xs text-slate-500 mt-1">
                                    Foto di bawah ini tampil utuh dan dapat digeser/diswipe ke kanan pada halaman <span class="font-semibold text-slate-700">/business/technology</span> dan di landing page.
                                </p>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-mono font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                Total: <span x-text="techImages.length"></span> Foto
                            </span>
                        </div>

                        <!-- Badge & Headline Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Pabrik</label>
                                <input type="text" name="tech_plants_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_plants_badge', $editLocale, __('messages.tech_section.plants_badge')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Sub-Badge Area</label>
                                <input type="text" name="tech_space_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_space_badge', $editLocale, __('messages.tech_section.space_badge')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Headline Kartu Fasilitas</label>
                                <input type="text" name="tech_plants_headline_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('tech_plants_headline', $editLocale, __('messages.tech_section.plants_headline')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                        </div>

                        <!-- Existing Gallery Images Grid -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-[11px] font-mono text-slate-700 uppercase font-bold">
                                    Daftar Foto Galeri Slider Teknologi (Bisa Digeser/Scroll)
                                </label>
                                <span class="text-[10px] text-slate-400">Klik icon sampah untuk menghapus foto</span>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <template x-for="(img, idx) in techImages" :key="idx">
                                    <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shadow-xs hover:border-slate-300 transition-all">
                                        <div class="aspect-[16/10] bg-slate-200 relative overflow-hidden">
                                            <img :src="img.startsWith('http') || img.startsWith('/') ? img : '/' + img" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Tech Gallery Image">
                                            <div class="absolute top-2 left-2 px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-black/70 text-white backdrop-blur-xs flex items-center gap-1">
                                                <span x-text="'#' + (idx + 1)"></span>
                                                <span x-show="idx === 0" class="text-amber-300 text-[9px] font-bold">★ Utama</span>
                                            </div>
                                            <button type="button" @click="removeTechImage(idx)" class="absolute top-2 right-2 p-1.5 rounded-lg bg-red-600/90 text-white hover:bg-red-700 shadow-sm transition-colors cursor-pointer" title="Hapus foto dari galeri">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                        <div class="p-2.5 bg-white border-t border-slate-100">
                                            <p class="text-[10px] font-mono text-slate-500 truncate" x-text="img"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div x-show="techImages.length === 0" class="p-6 text-center rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-500 text-xs">
                                Belum ada foto galeri teknologi. Silakan tambahkan foto baru di bawah.
                            </div>
                        </div>

                        <!-- Upload Multi-Image Box -->
                        <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block font-bold">
                                        + Tambah Beberapa Gambar Sekaligus (Multi-Upload)
                                    </label>
                                    <p class="text-[10px] text-slate-500 mt-0.5">
                                        Pilih 1, 2, 3, atau lebih foto sekaligus (JPG, PNG, WEBP). Foto baru otomatis ditambahkan ke galeri slider teknologi.
                                    </p>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-musashi-red/10 text-musashi-red border border-musashi-red/20">
                                    Multi-File Upload
                                </span>
                            </div>
                            <input type="file" name="tech_gallery_new_files[]" multiple accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-musashi-red file:text-white hover:file:bg-musashi-darkred cursor-pointer">
                        </div>
                    </div>

                    <!-- 5. Seksi Inovasi (Open Innovation Landing Page) -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">5</span>
                                Pengaturan Seksi Inovasi (Open Innovation)
                            </h4>
                            <span class="text-[11px] font-mono text-slate-400">Landing Page Seksi 5</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Kategori Inovasi</label>
                                <input type="text" name="innov_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_badge', $editLocale, __('messages.innovation_section.badge')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Seksi Inovasi</label>
                                <input type="text" name="innov_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_title', $editLocale, __('messages.innovation_section.title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Narasi Inovasi</label>
                                <textarea name="innov_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('innov_desc', $editLocale, __('messages.innovation_section.desc')) }}</textarea>
                            </div>
                        </div>

                        <!-- 3 Pilar Inovasi -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-musashi-red block">INOVASI 01: AI & SMART FACTORY</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar 1</label>
                                    <input type="text" name="innov_pillar1_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_pillar1_title', $editLocale, __('messages.innovation_section.pillar1_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Pilar 1</label>
                                    <textarea name="innov_pillar1_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('innov_pillar1_desc', $editLocale, __('messages.innovation_section.pillar1_desc')) }}</textarea>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-musashi-red block">INOVASI 02: ENERGY & CAPACITOR</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar 2</label>
                                    <input type="text" name="innov_pillar2_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_pillar2_title', $editLocale, __('messages.innovation_section.pillar2_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Pilar 2</label>
                                    <textarea name="innov_pillar2_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('innov_pillar2_desc', $editLocale, __('messages.innovation_section.pillar2_desc')) }}</textarea>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-musashi-red block">INOVASI 03: GLOBAL CO-CREATION & SDGS</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar 3</label>
                                    <input type="text" name="innov_pillar3_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_pillar3_title', $editLocale, __('messages.innovation_section.pillar3_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Pilar 3</label>
                                    <textarea name="innov_pillar3_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('innov_pillar3_desc', $editLocale, __('messages.innovation_section.pillar3_desc')) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi Inovasi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-slate-700 block">TOMBOL INOVASI (KE HALAMAN INOVASI)</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol</label>
                                    <input type="text" name="innov_btn_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_btn_text', $editLocale, __('messages.innovation_section.btn_innov')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Target URL</label>
                                    <input type="text" name="innov_btn_link" value="{{ \App\Models\LandingPageSetting::get('innov_btn_link', route('business.innovation'), false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black font-mono">
                                </div>
                            </div>
                        </div>

                        <!-- Visual Kartu Inovasi & Multi-Foto Galeri Slider -->
                        <div class="space-y-6 pt-2"
                             x-data="{
                                 innovImages: {{ json_encode($innovGalleryImages ?? \App\Models\LandingPageSetting::getInnovGalleryImages()) }},
                                 removeInnovImage(index) {
                                     this.innovImages.splice(index, 1);
                                 }
                             }">
                            <input type="hidden" name="innov_gallery_submitted" value="1">
                            <template x-for="(img, idx) in innovImages" :key="idx">
                                <input type="hidden" name="innov_gallery_existing[]" :value="img">
                            </template>

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <div>
                                    <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                        <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">5B</span>
                                        Galeri Foto Inovasi & Energi Terbarukan (Multi-Foto Slider)
                                    </h4>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Foto di bawah ini tampil utuh dan dapat digeser/diswipe ke kanan pada halaman <span class="font-semibold text-slate-700">/business/innovation</span> dan di landing page.
                                    </p>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-xs font-mono font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    Total: <span x-text="innovImages.length"></span> Foto
                                </span>
                            </div>

                            <!-- Badge & Headline Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Inovasi</label>
                                    <input type="text" name="innov_card_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_card_badge', $editLocale, __('messages.innovation_section.card_badge')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Sub-Badge SDGs</label>
                                    <input type="text" name="innov_card_space_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_card_space_badge', $editLocale, __('messages.innovation_section.card_space_badge')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                </div>
                                <div class="col-span-full">
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Headline Kartu Inovasi</label>
                                    <input type="text" name="innov_card_headline_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('innov_card_headline', $editLocale, __('messages.innovation_section.card_headline')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                                </div>
                            </div>

                            <!-- Existing Gallery Images Grid -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-[11px] font-mono text-slate-700 uppercase font-bold">
                                        Daftar Foto Galeri Slider Inovasi (Bisa Digeser/Scroll)
                                    </label>
                                    <span class="text-[10px] text-slate-400">Klik icon sampah untuk menghapus foto</span>
                                </div>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    <template x-for="(img, idx) in innovImages" :key="idx">
                                        <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shadow-xs hover:border-slate-300 transition-all">
                                            <div class="aspect-[16/10] bg-slate-200 relative overflow-hidden">
                                                <img :src="img.startsWith('http') || img.startsWith('/') ? img : '/' + img" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Innovation Gallery Image">
                                                <div class="absolute top-2 left-2 px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-black/70 text-white backdrop-blur-xs flex items-center gap-1">
                                                    <span x-text="'#' + (idx + 1)"></span>
                                                    <span x-show="idx === 0" class="text-amber-300 text-[9px] font-bold">★ Utama</span>
                                                </div>
                                                <button type="button" @click="removeInnovImage(idx)" class="absolute top-2 right-2 p-1.5 rounded-lg bg-red-600/90 text-white hover:bg-red-700 shadow-sm transition-colors cursor-pointer" title="Hapus foto dari galeri">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </div>
                                            <div class="p-2.5 bg-white border-t border-slate-100">
                                                <p class="text-[10px] font-mono text-slate-500 truncate" x-text="img"></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <div x-show="innovImages.length === 0" class="p-6 text-center rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-500 text-xs">
                                    Belum ada foto galeri inovasi. Silakan tambahkan foto baru di bawah.
                                </div>
                            </div>

                            <!-- Upload Multi-Image Box -->
                            <div class="p-5 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-[11px] font-mono text-slate-700 uppercase block font-bold">
                                            + Tambah Beberapa Gambar Inovasi Sekaligus (Multi-Upload)
                                        </label>
                                        <p class="text-[10px] text-slate-500 mt-0.5">
                                            Pilih 1, 2, 3, atau lebih foto sekaligus (JPG, PNG, WEBP). Foto baru otomatis ditambahkan ke galeri slider inovasi.
                                        </p>
                                    </div>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-musashi-red/10 text-musashi-red border border-musashi-red/20">
                                        Multi-File Upload
                                    </span>
                                </div>
                                <input type="file" name="innov_gallery_new_files[]" multiple accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-musashi-red file:text-white hover:file:bg-musashi-darkred cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md cursor-pointer transition-all">
                            💾 Simpan Semua Pengaturan Teknologi
                        </button>
                    </div>
                </form>
            </div>

            <!-- ========================================== -->
            <!-- TAB: KEBERLANJUTAN & ESG                   -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'sustainability'" class="space-y-6">
                <form action="{{ route('superadmin.update') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_tab" value="sustainability">
                    <input type="hidden" name="redirect_lang" :value="editLocale">

                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase">Landing Page Section #8</span>
                                <span class="text-xs font-mono text-slate-400">#sustainability</span>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900">Keberlanjutan & Inisiatif ESG</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Kelola komitmen netralitas karbon, efisiensi energi hijau, dan kontribusi sosial perusahaan.</p>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm transition-all cursor-pointer">
                            💾 Simpan ESG & Keberlanjutan
                        </button>
                    </div>

                    <!-- 1. Header & Headline Narasi ESG -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold">1</span>
                                Header & Visi Keberlanjutan
                            </h4>
                            <span class="text-[11px] font-mono text-slate-400">Bahasa aktif: <span class="font-bold text-slate-700 uppercase" x-text="editLocale"></span></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Badge Seksi</label>
                                <input type="text" name="sustainability_badge_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('sustainability_badge', $editLocale, __('messages.nav.sustainability')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Utama Seksi</label>
                                <input type="text" name="sustainability_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('sustainability_title', $editLocale, __('messages.sustainability_section.title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi Visi Keberlanjutan</label>
                                <textarea name="sustainability_desc_{{ $editLocale }}" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black leading-relaxed">{{ \App\Models\LandingPageSetting::getForLocale('sustainability_desc', $editLocale, __('messages.sustainability_section.desc')) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Tiga Pilar Lingkungan (3 ESG Pillars) -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold">2</span>
                                Tiga Pilar Aksi Lingkungan & Sosial (ESG)
                            </h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Pilar Carbon -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-emerald-700 block">🌿 01. NETRALITAS KARBON</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar</label>
                                    <input type="text" name="sustainability_carbon_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('sustainability_carbon_title', $editLocale, __('messages.sustainability_section.carbon_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi</label>
                                    <textarea name="sustainability_carbon_desc_{{ $editLocale }}" rows="4" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('sustainability_carbon_desc', $editLocale, __('messages.sustainability_section.carbon_desc')) }}</textarea>
                                </div>
                            </div>

                            <!-- Pilar Circular / Waste -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-emerald-700 block">♻️ 02. REDUKSI LIMBAH & DAUR ULANG</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar</label>
                                    <input type="text" name="sustainability_waste_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('sustainability_waste_title', $editLocale, __('messages.sustainability_section.waste_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi</label>
                                    <textarea name="sustainability_waste_desc_{{ $editLocale }}" rows="4" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('sustainability_waste_desc', $editLocale, __('messages.sustainability_section.waste_desc')) }}</textarea>
                                </div>
                            </div>

                            <!-- Pilar Community -->
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                                <span class="text-xs font-mono font-bold text-emerald-700 block">🤝 03. SOSIAL & MASYARAKAT</span>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Pilar</label>
                                    <input type="text" name="sustainability_community_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('sustainability_community_title', $editLocale, __('messages.sustainability_section.community_title')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">
                                </div>
                                <div>
                                    <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Deskripsi</label>
                                    <textarea name="sustainability_community_desc_{{ $editLocale }}" rows="4" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('sustainability_community_desc', $editLocale, __('messages.sustainability_section.community_desc')) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Tombol Laporan Keberlanjutan -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold">3</span>
                                Tombol Tautan Laporan Keberlanjutan
                            </h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Tombol (Bahasa: {{ strtoupper($editLocale) }})</label>
                                <input type="text" name="sustainability_btn_text_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('sustainability_btn_text', $editLocale, __('messages.sustainability_section.btn_report')) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Target URL Laporan</label>
                                <input type="text" name="sustainability_btn_link" value="{{ \App\Models\LandingPageSetting::get('sustainability_btn_link', route('sustainability.index'), false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-mono">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-emerald-700 hover:bg-emerald-800 shadow-md cursor-pointer transition-all">
                            💾 Simpan Semua Pengaturan Keberlanjutan
                        </button>
                    </div>
                </form>
            </div>

            <!-- ========================================== -->
            <!-- TAB: PENGATURAN FOOTER & KONTAK PABRIK    -->
            <!-- ========================================== -->
            <div x-show="currentTab === 'footer'" class="space-y-6">
                <form action="{{ route('superadmin.update') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_tab" value="footer">
                    <input type="hidden" name="redirect_lang" :value="editLocale">

                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-800 border border-slate-300 uppercase">Footer Website Global</span>
                                <span class="text-xs font-mono text-slate-400">footer.blade.php</span>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900">Pengaturan Footer & Kontak Pabrik</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Kelola alamat pabrik Cikarang & Karawang, nomor telepon, tautan media sosial, serta hak cipta.</p>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-sm transition-all cursor-pointer">
                            💾 Simpan Footer
                        </button>
                    </div>

                    <!-- 1. Cikarang Plant (Head Office) -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">1</span>
                                Cikarang Plant (Kantor Pusat)
                            </h4>
                            <span class="text-[11px] font-mono text-slate-400">Bahasa aktif: <span class="font-bold text-slate-700 uppercase" x-text="editLocale"></span></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Fasilitas</label>
                                <input type="text" name="footer_cikarang_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('footer_cikarang_title', $editLocale, 'Cikarang Plant (Head Office)') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Alamat Baris 1</label>
                                <input type="text" name="footer_cikarang_address_1_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('footer_cikarang_address_1', $editLocale, 'EJIP Industrial Park Plot 3J-2 Cikarang Selatan') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Alamat Baris 2 (Kota & Kode Pos)</label>
                                <input type="text" name="footer_cikarang_address_2_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('footer_cikarang_address_2', $editLocale, 'Bekasi 17550, Indonesia') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Nomor Telepon Kantor (Global)</label>
                                <input type="text" name="footer_cikarang_phone" value="{{ \App\Models\LandingPageSetting::get('footer_cikarang_phone', '+62-21-8970866', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-mono">
                                <span class="text-[10px] text-slate-400 mt-1 block">Tampil di format: Phone : +62-21-8970866</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Karawang Plant -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">2</span>
                                Karawang Plant
                            </h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Judul Fasilitas</label>
                                <input type="text" name="footer_karawang_title_{{ $editLocale }}" value="{{ \App\Models\LandingPageSetting::getForLocale('footer_karawang_title', $editLocale, 'Karawang Plant') }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            </div>
                            <div class="col-span-full">
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Alamat Lengkap Karawang</label>
                                <textarea name="footer_karawang_address_{{ $editLocale }}" rows="2" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">{{ \App\Models\LandingPageSetting::getForLocale('footer_karawang_address', $editLocale, 'Suryacipta City of Industry Jl. Surya Madya Kav 1-36 BC, Desa Kutanegara Kec. Ciampel, Karawang 41361, Indonesia') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Social Media & External Links (Follow Us) -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">3</span>
                                Media Sosial & Tautan Luar (Follow Us)
                            </h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">YouTube Channel URL</label>
                                <input type="text" name="social_youtube" value="{{ \App\Models\LandingPageSetting::get('social_youtube', 'https://youtube.com/@musashi_career?si=9gEY_ceAFkpI7Jnq', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-mono">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">LinkedIn Company URL</label>
                                <input type="text" name="social_linkedin" value="{{ \App\Models\LandingPageSetting::get('social_linkedin', 'https://www.linkedin.com/company/musashi-auto-parts-indonesia/', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-mono">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Instagram URL</label>
                                <input type="text" name="social_instagram" value="{{ \App\Models\LandingPageSetting::get('social_instagram', 'https://www.instagram.com/careermusashi.id?dlrf=MTBvZnMzcGR0dDNvMQ%3D%3D', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-mono">
                            </div>
                            <div>
                                <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Website Resmi Global URL</label>
                                <input type="text" name="social_website" value="{{ \App\Models\LandingPageSetting::get('social_website', 'https://www.musashi.co.id/', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black font-mono">
                            </div>
                        </div>
                    </div>

                    <!-- 4. Copyright & Hak Cipta -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4">
                        <div class="border-b border-slate-100 pb-3">
                            <h4 class="font-bold text-sm text-slate-900 uppercase font-mono flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-red-50 text-musashi-red flex items-center justify-center text-xs font-bold">4</span>
                                Teks Hak Cipta (Copyright Notice)
                            </h4>
                        </div>

                        <div>
                            <label class="text-[11px] font-mono text-slate-700 uppercase block mb-1 font-bold">Teks Copyright</label>
                            <input type="text" name="footer_copyright" value="{{ \App\Models\LandingPageSetting::get('footer_copyright', '©2024 PT. Musashi Auto Parts Indonesia All rights reserved', false) }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-black">
                            <span class="text-[10px] text-slate-400 mt-1 block">Tampil di bagian bawah footer halaman resmi.</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-musashi-red hover:bg-musashi-darkred shadow-md cursor-pointer transition-all">
                            💾 Simpan Semua Pengaturan Footer
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <script>
        window.compressFileToDataUrl = function(file) {
            return new Promise((resolve) => {
                if (!file || !file.type.startsWith('image/')) {
                    resolve(null);
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const maxDim = 1200;
                        let w = img.width;
                        let h = img.height;
                        if (w > maxDim || h > maxDim) {
                            if (w > h) {
                                h = Math.round((h * maxDim) / w);
                                w = maxDim;
                            } else {
                                w = Math.round((w * maxDim) / h);
                                h = maxDim;
                            }
                        }
                        const canvas = document.createElement('canvas');
                        canvas.width = w;
                        canvas.height = h;
                        const ctx = canvas.getContext('2d');
                        ctx.fillStyle = '#ffffff';
                        ctx.fillRect(0, 0, w, h);
                        ctx.drawImage(img, 0, 0, w, h);
                        const dataUrl = canvas.toDataURL('image/jpeg', 0.82);
                        resolve(dataUrl);
                    };
                    img.onerror = function() {
                        resolve(e.target.result);
                    };
                    img.src = e.target.result;
                };
                reader.onerror = function() {
                    resolve(null);
                };
                reader.readAsDataURL(file);
            });
        };
    </script>
</body>
</html>
