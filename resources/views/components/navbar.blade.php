<header 
    x-data="{ 
        mobileMenuOpen: false, 
        companyOpen: false, 
        businessOpen: false, 
        langOpen: false,
        mobileCompanyOpen: false,
        mobileBusinessOpen: false,
        mobileLangOpen: false
    }"
    :class="scrolled ? 'bg-black/95 shadow-xl py-3 backdrop-blur-md border-b border-white/10' : 'bg-black/85 py-3.5 sm:py-4 shadow-lg backdrop-blur-sm border-b border-white/10'"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-300">

    <div class="max-w-7xl 2xl:max-w-[1536px] 3xl:max-w-[1780px] mx-auto px-3.5 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-2 sm:gap-4">
            
            <!-- Left: White Saturn Ring Logo + PT. Musashi Auto Parts Indonesia -->
            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group focus:outline-none">
                    <!-- Saturn Orbit Logo in Pure White -->
                    <div class="w-7 h-7 xs:w-8 xs:h-8 sm:w-9 sm:h-9 flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset(\App\Models\LandingPageSetting::get('navbar_logo', 'images/business/musashi-white-logo.png', false)) }}" alt="PT. Musashi Auto Parts Indonesia" class="w-7 h-7 xs:w-8 xs:h-8 sm:w-9 sm:h-9 object-contain transform group-hover:scale-105 transition-transform duration-200">
                    </div>
                    <!-- Brand Typography: 2-line break on mobile matching reference design, single line on desktop -->
                    @php
                        $brandTitle = \App\Models\LandingPageSetting::getForLocale('navbar_brand_title', app()->getLocale(), 'PT. Musashi Auto Parts Indonesia');
                        $brandHtml = preg_replace(
                            '/^(PT\.?\s+Musashi\s+Auto)\s+(Parts\s+Indonesia)$/iu',
                            '<span class="block sm:inline">$1</span><span class="hidden sm:inline"> </span><span class="block sm:inline">$2</span>',
                            e($brandTitle)
                        );
                    @endphp
                    <span class="text-white font-bold text-xs xs:text-sm sm:text-base md:text-lg tracking-tight font-sans leading-tight">
                        {!! $brandHtml !!}
                    </span>
                </a>
            </div>

            <!-- Middle / Right: Main Navigation (Desktop) matching musashi.co.id exactly -->
            <nav class="hidden lg:flex items-center space-x-5 xl:space-x-8 2xl:space-x-10 whitespace-nowrap font-sans text-sm xl:text-[15px] 2xl:text-base font-medium text-white">

                <!-- 1. Company (Dropdown) -->
                <div class="relative" @click.away="companyOpen = false">
                    <button 
                        @click="companyOpen = !companyOpen; businessOpen = false; langOpen = false"
                        type="button" 
                        class="flex items-center gap-1.5 py-2 text-white hover:text-white/80 transition-colors focus:outline-none cursor-pointer {{ request()->routeIs('company.*') ? 'font-semibold text-white' : '' }}"
                        aria-expanded="false"
                        :aria-expanded="companyOpen.toString()">
                        <span>{{ \App\Models\LandingPageSetting::getForLocale('nav_company', app()->getLocale(), __('messages.nav.company')) }}</span>
                        <!-- Small triangle arrow flipping ▼ to ▲ -->
                        <svg class="w-2.5 h-2.5 transition-transform duration-200 fill-current opacity-90" :class="companyOpen ? 'rotate-180' : ''" viewBox="0 0 10 6">
                            <path d="M0 0l5 6 5-6z"/>
                        </svg>
                    </button>

                    <!-- Exact Black Dropdown Box for Company matching Screenshot 2 -->
                    <div 
                        x-show="companyOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        style="display: none;"
                        class="absolute left-0 mt-1 w-56 bg-black text-white shadow-2xl py-2 border border-white/10 z-50">
                        
                        <a href="{{ route('home') }}#company-about" @click="companyOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_about_us', app()->getLocale(), __('messages.nav.about_us')) }}
                        </a>
                        <a href="{{ route('home') }}#company-message" @click="companyOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_corporate_message', app()->getLocale(), __('messages.nav.corporate_message')) }}
                        </a>
                        <a href="{{ route('home') }}#company-philosophy" @click="companyOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_philosophy', app()->getLocale(), __('messages.nav.philosophy')) }}
                        </a>
                        <a href="{{ route('home') }}#company-vision" @click="companyOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_global_vision', app()->getLocale(), __('messages.nav.global_vision')) }}
                        </a>
                        <a href="{{ route('home') }}#company-outline" @click="companyOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_company_outline', app()->getLocale(), __('messages.nav.company_outline')) }}
                        </a>
                        <a href="{{ route('home') }}#company-bod" @click="companyOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_bod', app()->getLocale(), __('messages.nav.bod')) }}
                        </a>
                        <a href="{{ route('home') }}#company-network" @click="companyOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_network', app()->getLocale(), __('messages.nav.network')) }}
                        </a>
                    </div>
                </div>

                <!-- 2. Product (Scrolls to #products on Landing Page) -->
                <a href="{{ route('home') }}#products" 
                   class="py-2 text-white hover:text-white/80 transition-colors font-medium">
                    {{ \App\Models\LandingPageSetting::getForLocale('nav_product', app()->getLocale(), __('messages.nav.product')) }}
                </a>

                <!-- 3. Business (Dropdown & Direct Link to #business) -->
                <div class="relative group" @click.away="businessOpen = false" @mouseenter="businessOpen = true" @mouseleave="businessOpen = false">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}#business" 
                           class="py-2 text-white hover:text-white/80 transition-colors font-medium">
                            <span>{{ \App\Models\LandingPageSetting::getForLocale('nav_business', app()->getLocale(), __('messages.nav.business')) }}</span>
                        </a>
                        <button 
                            @click="businessOpen = !businessOpen; companyOpen = false; langOpen = false"
                            type="button" 
                            class="p-2 text-white hover:text-white/80 transition-colors focus:outline-none cursor-pointer"
                            aria-expanded="false"
                            :aria-expanded="businessOpen.toString()"
                            aria-label="Toggle Business Dropdown">
                            <!-- Small triangle arrow flipping ▼ to ▲ -->
                            <svg class="w-2.5 h-2.5 transition-transform duration-200 fill-current opacity-90" :class="businessOpen ? 'rotate-180' : ''" viewBox="0 0 10 6">
                                <path d="M0 0l5 6 5-6z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Exact Black Dropdown Box for Business -->
                    <div 
                        x-show="businessOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        style="display: none;"
                        class="absolute left-0 mt-1 w-52 bg-black text-white shadow-2xl py-2 border border-white/10 z-50">
                        
                        <a href="{{ route('home') }}#business" @click="businessOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_core_competence', app()->getLocale(), __('messages.nav.core_competence')) }}
                        </a>
                        <a href="{{ route('home') }}#technology" @click="businessOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_technology', app()->getLocale(), __('messages.nav.technology')) }}
                        </a>
                        <a href="{{ route('home') }}#innovation" @click="businessOpen = false" class="block px-5 py-2 text-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors">
                            {{ \App\Models\LandingPageSetting::getForLocale('nav_innovation', app()->getLocale(), __('messages.nav.innovation')) }}
                        </a>
                    </div>
                </div>

                <!-- 4. News (Scrolls to #news on Landing Page) -->
                <a href="{{ route('home') }}#news" 
                   class="py-2 text-white hover:text-white/80 transition-colors font-medium">
                    {{ \App\Models\LandingPageSetting::getForLocale('nav_news', app()->getLocale(), __('messages.nav.news')) }}
                </a>

                <!-- 5. Sustainability (Scrolls to #sustainability on Landing Page) -->
                <a href="{{ route('home') }}#sustainability" 
                   class="py-2 text-white hover:text-white/80 transition-colors font-medium">
                    {{ \App\Models\LandingPageSetting::getForLocale('nav_sustainability', app()->getLocale(), __('messages.nav.sustainability')) }}
                </a>

                <!-- 6. Careers (At the far right / paling ujung, opens career link) -->
                <a href="{{ \App\Models\LandingPageSetting::get('nav_careers_link', 'https://career.musashi.co.id/', false) }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="py-2 text-white hover:text-white/80 transition-colors font-medium">
                    {{ \App\Models\LandingPageSetting::getForLocale('nav_careers', app()->getLocale(), __('messages.nav.careers')) }}
                </a>

            </nav>

            <!-- Far Right: Language Switcher (Desktop) in Clean Dark Pill -->
            <div class="hidden lg:flex items-center gap-3">
                <div class="relative" @click.away="langOpen = false">
                    <button 
                        @click="langOpen = !langOpen; companyOpen = false; businessOpen = false"
                        type="button" 
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/30 hover:border-white/70 bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur-sm transition-colors cursor-pointer"
                        aria-label="Pilih Bahasa">
                        <svg class="w-3.5 h-3.5 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        <span class="uppercase tracking-wider font-mono text-[11px]">
                            @if(app()->getLocale() === 'ja') JP @elseif(app()->getLocale() === 'id') ID @else EN @endif
                        </span>
                        <svg class="w-2.5 h-2.5 fill-current opacity-70 ml-0.5" viewBox="0 0 10 6">
                            <path d="M0 0l5 6 5-6z"/>
                        </svg>
                    </button>

                    <!-- Language Selection Dropdown -->
                    <div 
                        x-show="langOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                        style="display: none;"
                        class="absolute right-0 mt-2 w-44 bg-black border border-white/20 shadow-2xl p-1.5 z-50">
                        
                        <a href="{{ route('locale.switch', 'id') }}" 
                           class="flex items-center justify-between px-3 py-2 text-xs font-medium transition-colors {{ app()->getLocale() === 'id' ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            <span>Indonesia</span>
                            @if(app()->getLocale() === 'id') <span class="text-white font-bold">✓</span> @endif
                        </a>

                        <a href="{{ route('locale.switch', 'en') }}" 
                           class="flex items-center justify-between px-3 py-2 text-xs font-medium transition-colors {{ app()->getLocale() === 'en' ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            <span>English</span>
                            @if(app()->getLocale() === 'en') <span class="text-white font-bold">✓</span> @endif
                        </a>

                        <a href="{{ route('locale.switch', 'ja') }}" 
                           class="flex items-center justify-between px-3 py-2 text-xs font-medium transition-colors {{ app()->getLocale() === 'ja' ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            <span>日本語</span>
                            @if(app()->getLocale() === 'ja') <span class="text-white font-bold">✓</span> @endif
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Controls (Hamburger + Language) -->
            <div class="flex items-center gap-1.5 xs:gap-2 lg:hidden flex-shrink-0">
                <!-- Mobile Language Switcher -->
                <div class="relative" @click.away="mobileLangOpen = false">
                    <button 
                        @click="mobileLangOpen = !mobileLangOpen"
                        type="button" 
                        class="px-2 xs:px-2.5 py-1 xs:py-1.5 rounded-full text-white border border-white/30 hover:bg-white/10 flex items-center gap-1 text-[11px] xs:text-xs font-semibold"
                        aria-label="Pilih Bahasa">
                        <svg class="w-3 h-3 xs:w-3.5 xs:h-3.5 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        <span class="uppercase text-[10px] xs:text-[11px] font-mono">{{ app()->getLocale() === 'ja' ? 'JP' : (app()->getLocale() === 'id' ? 'ID' : 'EN') }}</span>
                    </button>

                    <div 
                        x-show="mobileLangOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        style="display: none;"
                        class="absolute right-0 mt-2 w-36 xs:w-40 bg-black border border-white/20 shadow-2xl p-1.5 z-50">
                        <a href="{{ route('locale.switch', 'id') }}" class="block px-3 py-1.5 text-xs text-white hover:bg-white/15">Indonesia</a>
                        <a href="{{ route('locale.switch', 'en') }}" class="block px-3 py-1.5 text-xs text-white hover:bg-white/15">English</a>
                        <a href="{{ route('locale.switch', 'ja') }}" class="block px-3 py-1.5 text-xs text-white hover:bg-white/15">日本語</a>
                    </div>
                </div>

                <!-- Hamburger Button -->
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen" 
                    type="button" 
                    class="p-1.5 xs:p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none transition-colors"
                    aria-label="Buka Menu">
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5 xs:w-6 xs:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" style="display: none;" class="w-5 h-5 xs:w-6 xs:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Drawer Menu (Solid Black matching dark navbar) -->
    <div 
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        style="display: none;"
        class="lg:hidden bg-black/95 backdrop-blur-xl border-b border-white/15 max-h-[85vh] overflow-y-auto px-4 pt-3 pb-6 shadow-2xl text-white">
        
        <div class="space-y-1 text-sm font-medium">
            <!-- 1. Mobile Company (Accordion) -->
            <div>
                <button 
                    @click="mobileCompanyOpen = !mobileCompanyOpen"
                    type="button"
                    class="w-full flex items-center justify-between px-3 py-2.5 text-white hover:bg-white/10 transition-colors">
                    <span>{{ \App\Models\LandingPageSetting::getForLocale('nav_company', app()->getLocale(), __('messages.nav.company')) }}</span>
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 fill-current opacity-80" :class="mobileCompanyOpen ? 'rotate-180' : ''" viewBox="0 0 10 6">
                        <path d="M0 0l5 6 5-6z"/>
                    </svg>
                </button>

                <div x-show="mobileCompanyOpen" x-collapse style="display: none;" class="pl-4 pr-2 py-1 space-y-1 bg-white/5 my-1 border-l-2 border-white/20">
                    <a href="{{ route('home') }}#company-about" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_about_us', app()->getLocale(), __('messages.nav.about_us')) }}</a>
                    <a href="{{ route('home') }}#company-message" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_corporate_message', app()->getLocale(), __('messages.nav.corporate_message')) }}</a>
                    <a href="{{ route('home') }}#company-philosophy" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_philosophy', app()->getLocale(), __('messages.nav.philosophy')) }}</a>
                    <a href="{{ route('home') }}#company-vision" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_global_vision', app()->getLocale(), __('messages.nav.global_vision')) }}</a>
                    <a href="{{ route('home') }}#company-outline" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_company_outline', app()->getLocale(), __('messages.nav.company_outline')) }}</a>
                    <a href="{{ route('home') }}#company-bod" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_bod', app()->getLocale(), __('messages.nav.bod')) }}</a>
                    <a href="{{ route('home') }}#company-network" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_network', app()->getLocale(), __('messages.nav.network')) }}</a>
                </div>
            </div>

            <!-- 2. Mobile Product -->
            <a href="{{ route('home') }}#products" @click="mobileMenuOpen = false" class="block px-3 py-2.5 text-white hover:bg-white/10 transition-colors">
                {{ \App\Models\LandingPageSetting::getForLocale('nav_product', app()->getLocale(), __('messages.nav.product')) }}
            </a>

            <!-- 3. Mobile Business (Accordion & Direct Link to #business) -->
            <div>
                <div class="w-full flex items-center justify-between text-white hover:bg-white/10 transition-colors">
                    <a href="{{ route('home') }}#business" @click="mobileMenuOpen = false" class="px-3 py-2.5 flex-1 font-medium text-white hover:text-white/80">
                        {{ \App\Models\LandingPageSetting::getForLocale('nav_business', app()->getLocale(), __('messages.nav.business')) }}
                    </a>
                    <button 
                        @click="mobileBusinessOpen = !mobileBusinessOpen" 
                        type="button" 
                        class="px-3 py-2.5 focus:outline-none" 
                        aria-label="Toggle Business Menu">
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 fill-current opacity-80" :class="mobileBusinessOpen ? 'rotate-180' : ''" viewBox="0 0 10 6">
                            <path d="M0 0l5 6 5-6z"/>
                        </svg>
                    </button>
                </div>

                <div x-show="mobileBusinessOpen" x-collapse style="display: none;" class="pl-4 pr-2 py-1 space-y-1 bg-white/5 my-1 border-l-2 border-white/20">
                    <a href="{{ route('home') }}#business" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_core_competence', app()->getLocale(), __('messages.nav.core_competence')) }}</a>
                    <a href="{{ route('home') }}#technology" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_technology', app()->getLocale(), __('messages.nav.technology')) }}</a>
                    <a href="{{ route('home') }}#innovation" @click="mobileMenuOpen = false" class="block px-3 py-1.5 text-xs text-white/90 hover:text-white">{{ \App\Models\LandingPageSetting::getForLocale('nav_innovation', app()->getLocale(), __('messages.nav.innovation')) }}</a>
                </div>
            </div>

            <!-- 4. Mobile News -->
            <a href="{{ route('home') }}#news" @click="mobileMenuOpen = false" class="block px-3 py-2.5 text-white hover:bg-white/10 transition-colors">
                {{ \App\Models\LandingPageSetting::getForLocale('nav_news', app()->getLocale(), __('messages.nav.news')) }}
            </a>

            <!-- 5. Mobile Sustainability -->
            <a href="{{ route('home') }}#sustainability" @click="mobileMenuOpen = false" class="block px-3 py-2.5 text-white hover:bg-white/10 transition-colors">
                {{ \App\Models\LandingPageSetting::getForLocale('nav_sustainability', app()->getLocale(), __('messages.nav.sustainability')) }}
            </a>

            <!-- 6. Mobile Careers -->
            <a href="{{ \App\Models\LandingPageSetting::get('nav_careers_link', 'https://career.musashi.co.id/', false) }}" target="_blank" rel="noopener noreferrer" class="block px-3 py-2.5 text-white hover:bg-white/10 transition-colors font-semibold">
                {{ \App\Models\LandingPageSetting::getForLocale('nav_careers', app()->getLocale(), __('messages.nav.careers')) }} ↗
            </a>
        </div>
    </div>
</header>
