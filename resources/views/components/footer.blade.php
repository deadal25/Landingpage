<footer class="bg-black text-white font-sans pt-12 sm:pt-14 pb-12 relative overflow-hidden" x-data="{}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Main Top Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 pb-12 border-b border-white/10">
            
            <!-- Left Column: Logo + Company Name + Address matching Image 1 -->
            <div class="md:col-span-6 lg:col-span-6 space-y-3">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset(\App\Models\LandingPageSetting::get('navbar_logo', 'images/business/musashi-white-logo.png', false)) }}" alt="PT. Musashi Auto Parts Indonesia" class="h-8 w-auto object-contain">
                    <h3 class="text-white font-bold text-lg sm:text-xl tracking-tight font-sans">
                        {{ \App\Models\LandingPageSetting::getForLocale('navbar_brand_title', app()->getLocale(), 'PT. Musashi Auto Parts Indonesia') }}
                    </h3>
                </div>

                <div class="text-xs sm:text-sm text-white/85 leading-relaxed font-normal pt-1 space-y-0.5">
                    <p class="font-bold text-white">{{ \App\Models\LandingPageSetting::get('footer_cikarang_title', 'Cikarang Plant (Head Office)') }}</p>
                    <p>{{ \App\Models\LandingPageSetting::get('footer_cikarang_address_1', 'EJIP Industrial Park Plot 3J-2 Cikarang Selatan') }}</p>
                    <p>{{ \App\Models\LandingPageSetting::get('footer_cikarang_address_2', 'Bekasi 17550, Indonesia') }}</p>
                    <p>Phone : {{ \App\Models\LandingPageSetting::get('footer_cikarang_phone', '+62-21-8970866', false) }}</p>
                </div>

                <div class="text-xs sm:text-sm text-white/85 leading-relaxed font-normal pt-2 space-y-0.5">
                    <p class="font-bold text-white">{{ \App\Models\LandingPageSetting::get('footer_karawang_title', 'Karawang Plant') }}</p>
                    <p>{{ \App\Models\LandingPageSetting::get('footer_karawang_address', 'Suryacipta City of Industry Jl. Surya Madya Kav 1-36 BC, Desa Kutanegara Kec. Ciampel, Karawang 41361, Indonesia') }}</p>
                </div>
            </div>

            <!-- Column: Company -->
            <div class="md:col-span-2 lg:col-span-2">
                <h4 class="text-white font-bold text-base mb-3 font-sans">
                    {{ \App\Models\LandingPageSetting::getForLocale('nav_company', app()->getLocale(), __('messages.nav.company')) }}
                </h4>
                <ul class="space-y-2 text-xs sm:text-sm text-white/75">
                    <li>
                        <a href="{{ route('home') }}#company-about" class="hover:text-white transition-colors">{{ \App\Models\LandingPageSetting::getForLocale('nav_about_us', app()->getLocale(), __('messages.nav.about_us')) }}</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#news" class="hover:text-white transition-colors">{{ \App\Models\LandingPageSetting::getForLocale('nav_news', app()->getLocale(), __('messages.nav.news')) }}</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#sustainability" class="hover:text-white transition-colors">{{ \App\Models\LandingPageSetting::getForLocale('nav_sustainability', app()->getLocale(), __('messages.nav.sustainability')) }}</a>
                    </li>
                    <li>
                        <a href="{{ \App\Models\LandingPageSetting::get('nav_careers_link', 'https://career.musashi.co.id/', false) }}" target="_blank" rel="noopener" class="hover:text-white transition-colors">{{ \App\Models\LandingPageSetting::getForLocale('nav_careers', app()->getLocale(), __('messages.nav.careers')) }}</a>
                    </li>
                </ul>
            </div>

            <!-- Column: Product -->
            <div class="md:col-span-2 lg:col-span-2">
                <h4 class="text-white font-bold text-base mb-3 font-sans">
                    <a href="{{ route('home') }}#products" class="hover:text-white transition-colors">{{ \App\Models\LandingPageSetting::getForLocale('nav_product', app()->getLocale(), __('messages.nav.product')) }}</a>
                </h4>
            </div>

            <!-- Column: Business -->
            <div class="md:col-span-2 lg:col-span-2">
                <h4 class="text-white font-bold text-base mb-3 font-sans">
                    {{ \App\Models\LandingPageSetting::getForLocale('nav_business', app()->getLocale(), __('messages.nav.business')) }}
                </h4>
                <ul class="space-y-2 text-xs sm:text-sm text-white/75">
                    <li>
                        <a href="{{ route('home') }}#technology" class="hover:text-white transition-colors">{{ \App\Models\LandingPageSetting::getForLocale('nav_technology', app()->getLocale(), __('messages.nav.technology')) }}</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#innovation" class="hover:text-white transition-colors">{{ \App\Models\LandingPageSetting::getForLocale('nav_innovation', app()->getLocale(), __('messages.nav.innovation')) }}</a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Bottom Row matching Image: Follow us, Copyright, and Scroll-to-top button -->
        <div class="pt-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            
            <!-- Left: Follow us -->
            <div class="text-xs sm:text-sm text-white/90 pl-14 sm:pl-16 md:pl-20 2xl:pl-0">
                <div class="flex items-center gap-3">
                    <span class="font-normal text-white">Follow us :</span>
                    <!-- YouTube -->
                    <a href="{{ \App\Models\LandingPageSetting::get('social_youtube', 'https://youtube.com/@musashi_career?si=9gEY_ceAFkpI7Jnq', false) }}" target="_blank" rel="noopener" class="text-white hover:text-red-500 transition-colors" aria-label="YouTube">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <!-- LinkedIn -->
                    <a href="{{ \App\Models\LandingPageSetting::get('social_linkedin', 'https://www.linkedin.com/company/musashi-auto-parts-indonesia/', false) }}" target="_blank" rel="noopener" class="text-white hover:text-blue-400 transition-colors" aria-label="LinkedIn">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76a1.64 1.64 0 1 0 0-3.28 1.64 1.64 0 0 0 0 3.28m1.39 9.74v-8.37H5.07v8.37h2.78z"/></svg>
                    </a>
                    <!-- Instagram -->
                    <a href="{{ \App\Models\LandingPageSetting::get('social_instagram', 'https://www.instagram.com/careermusashi.id?dlrf=MTBvZnMzcGR0dDNvMQ%3D%3D', false) }}" target="_blank" rel="noopener" class="text-white hover:text-pink-400 transition-colors" aria-label="Instagram">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <!-- Globe / Website -->
                    <a href="{{ \App\Models\LandingPageSetting::get('social_website', 'https://www.musashi.co.id/', false) }}" target="_blank" rel="noopener" class="text-white hover:text-emerald-400 transition-colors" aria-label="Official Website">
                        <svg class="w-4 h-4 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Center: Copyright matching Image 1 -->
            <div class="text-xs text-white/80 font-normal">
                {{ \App\Models\LandingPageSetting::get('footer_copyright', '©2024 PT. Musashi Auto Parts Indonesia All rights reserved', false) }}
            </div>

            <!-- Far Right: Scroll to top circular button matching Image 1 -->
            <div class="self-end md:self-center">
                <button 
                    @click="window.scrollTo({ top: 0, behavior: 'smooth' })" 
                    type="button" 
                    class="w-11 h-11 rounded-full border border-white/60 hover:border-white text-white flex items-center justify-center hover:bg-white/15 transition-all shadow-lg focus:outline-none group cursor-pointer"
                    aria-label="Scroll to top">
                    <svg class="w-5 h-5 text-white stroke-[2.5] transform group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
                    </svg>
                </button>
            </div>

        </div>

    </div>
</footer>
