{{--
    ================================================================
    LAYOUT UTAMA: resources/views/layouts/app.blade.php
    ================================================================
    Layout ini berfungsi sebagai template dasar (master layout) yang
    diwarisi oleh semua halaman. Mengandung:
    - Head section (meta, title, Vite assets)
    - Navbar global
    - Slot konten utama (@yield('content'))
    - Footer global
    - Script global
    ================================================================
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    {{-- Meta dasar --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF Token untuk keamanan form POST --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <meta name="description" content="@yield('meta_description', 'Portal resmi Sertifikasi Elektronik - Layanan penerbitan dan pembaruan sertifikat digital yang cepat, aman, dan terpercaya.')">
    <meta name="keywords" content="sertifikasi elektronik, sertifikat digital, penerbitan sertifikat, pembaruan sertifikat">
    <meta name="author" content="Sertifikasi Elektronik">

    {{-- Open Graph untuk media sosial --}}
    <meta property="og:title" content="@yield('title', 'Sertifikasi Elektronik')">
    <meta property="og:description" content="@yield('meta_description', 'Portal resmi layanan sertifikasi elektronik.')">
    <meta property="og:type" content="website">

    {{-- Title dinamis per halaman --}}
    <title>@yield('title', 'Sertifikasi Elektronik') | Portal Resmi</title>

    {{-- Google Fonts: Inter untuk tipografi modern dan profesional --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Vite Assets (Tailwind CSS + App JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Style tambahan per halaman (opsional) --}}
    @stack('styles')

    {{-- Anti-Flicker Script Aksesibilitas (9 Spesifikasi) --}}
    <script>
        (function() {
            var doc = document.documentElement;
            var savedSize = localStorage.getItem('a11y_text_size');
            var savedSat = localStorage.getItem('a11y_sat');
            var savedHC = localStorage.getItem('a11y_high_contrast');
            var savedDyslexia = localStorage.getItem('a11y_dyslexia');
            var savedLineHeight = localStorage.getItem('a11y_line_height');
            var savedCursor = localStorage.getItem('a11y_large_cursor');
            var savedSpacing = localStorage.getItem('a11y_text_spacing');
            var savedUnderline = localStorage.getItem('a11y_underline');

            if (savedSize && savedSize !== '100') doc.style.fontSize = savedSize + '%';
            if (savedSat && savedSat !== 'normal') doc.classList.add('sat-' + savedSat);
            if (savedHC === '1') doc.classList.add('high-contrast');
            if (savedDyslexia === '1') doc.classList.add('dyslexia-mode');
            if (savedLineHeight === '1') doc.classList.add('line-height-mode');
            if (savedCursor === '1') doc.classList.add('large-cursor');
            if (savedSpacing === '1') doc.classList.add('text-spacing-mode');
            if (savedUnderline === '1') doc.classList.add('underline-links');
        })();
    </script>
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800">

    {{-- Skip link untuk pengguna keyboard & screen reader (Spesifikasi 1) --}}
    <a href="#main-content" class="skip-link" data-i18n="skip_content">Lompati ke Konten Utama</a>

    {{-- Tombol Login Admin Melayang di Pojok Kanan Atas (Tampil hanya di Beranda utama saat belum login) --}}
    @if(request()->routeIs('home') && !session()->has('admin_logged_in'))
        <div class="fixed top-4 right-4 z-40">
            <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl shadow-sm text-xs font-semibold text-slate-600 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span data-i18n="admin_login">Login Admin</span>
            </a>
        </div>
    @endif

    {{-- Navbar dihapus sesuai permintaan --}}
    <nav id="main-navbar" class="hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- LOGO & NAMA WEBSITE (Kiri) --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    {{-- Logo Kabupaten Mamasa --}}
                    <img src="{{ asset('images/logo-mamasa.png') }}" alt="Logo Kabupaten Mamasa" class="h-10 w-auto object-contain transition-transform group-hover:scale-105">
                    <div>
                        <span class="font-bold text-blue-800 text-base leading-tight block">Sertifikasi Elektronik</span>
                        <span class="text-slate-500 text-xs leading-tight block">Kabupaten Mamasa</span>
                    </div>
                </a>

                {{-- MENU NAVIGASI (Kanan) - Desktop --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('penerbitan') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('penerbitan') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        Penerbitan
                    </a>
                    <a href="{{ route('pembaruan') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('pembaruan') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        Pembaruan
                    </a>
                    <a href="{{ route('informasi') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('informasi') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        Informasi
                    </a>
                    {{-- Tombol Helpdesk di Navbar --}}
                    <a href="https://wa.me/6282312293928?text=Halo%2C%20saya%20membutuhkan%20bantuan%20terkait%20Sertifikasi%20Elektronik."
                        target="_blank" rel="noopener noreferrer"
                        class="ml-2 px-4 py-2 bg-blue-700 text-white rounded-lg text-sm font-medium hover:bg-blue-800 transition-all duration-200 flex items-center gap-2 shadow-sm hover:shadow-blue-200 hover:shadow-md">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Helpdesk
                    </a>
                </div>

                {{-- HAMBURGER MENU (Mobile) --}}
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors duration-200"
                    aria-label="Buka menu navigasi">
                    <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- MENU MOBILE (Dropdown) --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-100 bg-white">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200">Beranda</a>
                <a href="{{ route('penerbitan') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200">Form Penerbitan</a>
                <a href="{{ route('pembaruan') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200">Form Pembaruan</a>
                <a href="{{ route('informasi') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-200">Informasi</a>
                <a href="https://wa.me/6282312293928?text=Halo%2C%20saya%20membutuhkan%20bantuan%20terkait%20Sertifikasi%20Elektronik."
                    target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Helpdesk WhatsApp
                </a>
            </div>
        </div>
    </nav>

    {{-- ============================================================
        KONTEN UTAMA
        Area ini akan diisi oleh setiap halaman yang extends layout ini.
    ============================================================ --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- ============================================================
        FOOTER GLOBAL (Hidden on Admin Routes)
    ============================================================ --}}
    @if(!request()->is('admin*'))
    <footer class="bg-slate-900 text-slate-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

                {{-- Kolom 1: Logo, Deskripsi & Alamat --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo-mamasa.png') }}" alt="Logo Kabupaten Mamasa" class="h-10 w-auto object-contain">
                        <span class="text-white font-bold" data-i18n="hero_title_1">Sertifikasi Elektronik</span>
                    </div>
                    <p class="text-sm leading-relaxed mb-3" data-i18n="footer_desc">
                        Portal resmi layanan sertifikasi elektronik yang cepat, aman, dan dapat diandalkan untuk kebutuhan Anda.
                    </p>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        <strong class="text-slate-300 font-semibold">Alamat:</strong> Kantor Gabungan Dinas Lt. II, Jl. Demmatande, Kel. Mamasa, Kec. Mamasa 91362 Kabupaten Mamasa, Provinsi Sulawesi Barat
                    </p>
                </div>

                {{-- Kolom 2: Tautan Cepat --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider" data-i18n="footer_quick_links">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors duration-200" data-i18n="home">Beranda</a></li>
                        <li><a href="{{ route('penerbitan') }}" class="hover:text-blue-400 transition-colors duration-200" data-i18n="penerbitan">Form Penerbitan</a></li>
                        <li><a href="{{ route('pembaruan') }}" class="hover:text-blue-400 transition-colors duration-200" data-i18n="pembaruan">Form Pembaruan</a></li>
                        <li><a href="{{ route('informasi') }}" class="hover:text-blue-400 transition-colors duration-200" data-i18n="informasi">Informasi Web</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Kontak --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider" data-i18n="footer_help">Bantuan</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>admin@sertifikasiel.go.id</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            <a href="https://wa.me/6282312293928" target="_blank" rel="noopener noreferrer"
                                class="hover:text-green-400 transition-colors duration-200">WhatsApp Admin</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Garis pemisah & Copyright --}}
            <div class="border-t border-slate-800 pt-6 text-center text-xs">
                <p>&copy; {{ date('Y') }} <span data-i18n="footer_copy">Dinas Komunikasi Informatika dan Persandian &mdash; Portal Resmi Sertifikasi Elektronik. Seluruh hak cipta dilindungi.</span></p>
            </div>
        </div>
    </footer>
    @endif

    {{-- ============================================================
        WIDGET AKSESIBILITAS GLOBAL (A11Y TOOLBAR 9 FITUR)
    ============================================================ --}}
    <div id="a11y-widget-container" class="fixed bottom-6 left-6 z-50 font-sans">
        {{-- Live Announcer untuk Screen Reader --}}
        <div id="a11y-announcer" class="sr-only" aria-live="polite" aria-atomic="true"></div>

        {{-- Tombol Utama Floating Accessibility (Icon Orang Lingkaran Biru Pure Vector) --}}
        <button id="a11y-toggle-btn"
            aria-label="Buka Menu Aksesibilitas Website"
            aria-expanded="false"
            aria-controls="a11y-panel"
            class="group flex items-center justify-center w-14 h-14 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-full shadow-2xl transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-4 focus:ring-yellow-400 cursor-pointer p-0">
            <svg class="w-14 h-14" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="50" cy="50" r="48" fill="#2563eb" />
                <circle cx="50" cy="50" r="40" stroke="white" stroke-width="5.5" fill="none" />
                <circle cx="50" cy="27" r="7.5" fill="white" />
                <path d="M 24 41.5 C 38 37.5 62 37.5 76 41.5 C 62 43.5 38 43.5 24 41.5 Z" fill="white" />
                <path d="M 45 44 L 45 61 L 36 81 L 43 83 L 50 67 L 57 83 L 64 81 L 55 61 L 55 44 Z" fill="white" />
            </svg>
        </button>

        {{-- Panel Popover Menu Aksesibilitas 9 Fitur --}}
        <div id="a11y-panel"
            class="hidden absolute bottom-16 left-0 w-[92vw] sm:w-[480px] md:w-[540px] bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transition-all duration-300 z-50">
            
            {{-- Header Panel --}}
            <div class="bg-gradient-to-r from-blue-700 to-indigo-800 p-5 text-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-10 h-10" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <circle cx="50" cy="50" r="48" fill="#2563eb" />
                            <circle cx="50" cy="50" r="40" stroke="white" stroke-width="5.5" fill="none" />
                            <circle cx="50" cy="27" r="7.5" fill="white" />
                            <path d="M 24 41.5 C 38 37.5 62 37.5 76 41.5 C 62 43.5 38 43.5 24 41.5 Z" fill="white" />
                            <path d="M 45 44 L 45 61 L 36 81 L 43 83 L 50 67 L 57 83 L 64 81 L 55 61 L 55 44 Z" fill="white" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-base leading-tight" data-i18n="a11y_title">Fitur Aksesibilitas</h3>
                        <p class="text-xs text-blue-100" data-i18n="a11y_subtitle">Setelan alat bantu visual & penglihatan</p>
                    </div>
                </div>
                <button id="a11y-close-btn" aria-label="Tutup Menu Aksesibilitas" class="text-white/80 hover:text-white p-1.5 rounded-xl hover:bg-white/10 transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Body Panel (Grid 9 Fitur Spesifikasi) --}}
            <div class="p-4 grid grid-cols-2 sm:grid-cols-3 gap-2.5 max-h-[70vh] overflow-y-auto bg-slate-50/50">

                {{-- 1. Perbesar Teks --}}
                <button type="button" id="btn-increase-text"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-blue-50 group-hover:bg-blue-600 group-hover:text-white text-blue-700 rounded-xl flex items-center justify-center font-black text-sm mb-1.5 transition-colors">
                        A+
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Perbesar Teks</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Tambah ukuran font</span>
                    <span id="badge-text-size-inc" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">100%</span>
                </button>

                {{-- 2. Perkecil Teks --}}
                <button type="button" id="btn-decrease-text"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-blue-50 group-hover:bg-blue-600 group-hover:text-white text-blue-700 rounded-xl flex items-center justify-center font-black text-sm mb-1.5 transition-colors">
                        A-
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Perkecil Teks</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Kurangi ukuran font</span>
                    <span id="badge-text-size-dec" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Normal</span>
                </button>

                {{-- 3. Kejenuhan (Saturation) --}}
                <button type="button" id="btn-toggle-sat"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-indigo-50 group-hover:bg-indigo-600 group-hover:text-white text-indigo-600 rounded-xl flex items-center justify-center font-bold text-base mb-1.5 transition-colors">
                        🎨
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Kejenuhan</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Monokrom / Redup</span>
                    <span id="badge-sat-status" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Normal</span>
                </button>

                {{-- 4. Kontras+ (High Contrast) --}}
                <button type="button" id="btn-toggle-contrast"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-amber-50 group-hover:bg-amber-600 group-hover:text-white text-amber-600 rounded-xl flex items-center justify-center font-bold text-base mb-1.5 transition-colors">
                        🌓
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Kontras+</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Latar gelap & kontras</span>
                    <span id="badge-contrast-status" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Off</span>
                </button>

                {{-- 5. Ramah Disleksia --}}
                <button type="button" id="btn-toggle-dyslexia"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-purple-50 group-hover:bg-purple-600 group-hover:text-white text-purple-600 rounded-xl flex items-center justify-center font-bold text-base mb-1.5 transition-colors">
                        📖
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Ramah Disleksia</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Font khusus disleksia</span>
                    <span id="badge-dyslexia-status" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Off</span>
                </button>

                {{-- 6. Tinggi Garis (Line Height) --}}
                <button type="button" id="btn-toggle-line-height"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-emerald-50 group-hover:bg-emerald-600 group-hover:text-white text-emerald-600 rounded-xl flex items-center justify-center font-bold text-base mb-1.5 transition-colors">
                        ↕️
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Tinggi Garis</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Tambah spasi baris</span>
                    <span id="badge-line-height-status" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Normal</span>
                </button>

                {{-- 7. Kursor Besar (Large Cursor) --}}
                <button type="button" id="btn-toggle-cursor"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-rose-50 group-hover:bg-rose-600 group-hover:text-white text-rose-600 rounded-xl flex items-center justify-center font-bold text-base mb-1.5 transition-colors">
                        🖱️
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Kursor Besar</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Pointer menonjol</span>
                    <span id="badge-cursor-status" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Normal</span>
                </button>

                {{-- 8. Spasi Teks --}}
                <button type="button" id="btn-toggle-text-spacing"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-cyan-50 group-hover:bg-cyan-600 group-hover:text-white text-cyan-600 rounded-xl flex items-center justify-center font-bold text-base mb-1.5 transition-colors">
                        ↔️
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Spasi Teks</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Jarak huruf & kata</span>
                    <span id="badge-spacing-status" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Normal</span>
                </button>

                {{-- 9. Garis Bawahi Tautan --}}
                <button type="button" id="btn-toggle-underline"
                    class="flex flex-col items-center text-center p-3 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-2xl transition-all cursor-pointer group shadow-xs hover:shadow-md">
                    <div class="w-9 h-9 bg-teal-50 group-hover:bg-teal-600 group-hover:text-white text-teal-600 rounded-xl flex items-center justify-center font-bold text-base mb-1.5 transition-colors">
                        🔗
                    </div>
                    <span class="font-bold text-slate-800 text-xs mb-0.5">Garis Bawah Link</span>
                    <span class="text-[10px] text-slate-500 leading-tight">Tegaskan semua link</span>
                    <span id="badge-underline-status" class="mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Off</span>
                </button>

            </div>

            {{-- Footer Panel (Reset) --}}
            <div class="p-3.5 bg-slate-100 border-t border-slate-200 flex justify-between items-center text-xs">
                <span class="text-slate-500 font-medium text-[11px]">Tersimpan di browser</span>
                <button id="a11y-reset-btn" type="button" class="text-red-600 hover:text-red-800 font-bold underline cursor-pointer hover:scale-105 transition-all">
                    Reset Semua
                </button>
            </div>

        </div>
    </div>

    {{-- ============================================================
        JAVASCRIPT GLOBAL
    ============================================================ --}}
    <script>
        // ----------------------------------------------------------
        // Mobile Menu Toggle
        // ----------------------------------------------------------
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.contains('hidden');
                mobileMenu.classList.toggle('hidden', !isHidden);
                hamburgerIcon.classList.toggle('hidden', isHidden);
                closeIcon.classList.toggle('hidden', !isHidden);
            });
        }

        // ----------------------------------------------------------
        // Auto-hide Flash Message
        // ----------------------------------------------------------
        window.addEventListener('DOMContentLoaded', () => {
            const flashMsg = document.getElementById('flash-message');
            if (flashMsg) {
                setTimeout(() => {
                    flashMsg.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    flashMsg.style.opacity = '0';
                    flashMsg.style.transform = 'translateY(-10px)';
                    setTimeout(() => flashMsg.remove(), 500);
                }, 5000);
            }
        });

        // ----------------------------------------------------------
        // LOGIK WIDGET AKSESIBILITAS (9 FITUR SPESIFIKASI)
        // ----------------------------------------------------------
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('a11y-toggle-btn');
            const panel = document.getElementById('a11y-panel');
            const closeBtn = document.getElementById('a11y-close-btn');
            const resetBtn = document.getElementById('a11y-reset-btn');
            const announcer = document.getElementById('a11y-announcer');

            const htmlEl = document.documentElement;

            const announce = (msg) => {
                if (announcer) {
                    announcer.textContent = '';
                    setTimeout(() => { announcer.textContent = msg; }, 100);
                }
            };

            // Buka / Tutup Panel Aksesibilitas
            if (toggleBtn && panel) {
                toggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isHidden = panel.classList.contains('hidden');
                    if (isHidden) {
                        panel.classList.remove('hidden');
                        toggleBtn.setAttribute('aria-expanded', 'true');
                        announce('Menu aksesibilitas terbuka.');
                    } else {
                        panel.classList.add('hidden');
                        toggleBtn.setAttribute('aria-expanded', 'false');
                    }
                });

                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        panel.classList.add('hidden');
                        toggleBtn.setAttribute('aria-expanded', 'false');
                        announce('Menu aksesibilitas ditutup.');
                    });
                }

                document.addEventListener('click', (e) => {
                    if (!panel.contains(e.target) && !toggleBtn.contains(e.target)) {
                        panel.classList.add('hidden');
                        toggleBtn.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Helper Badge Updates
            const updateBadge = (elId, text, active = false) => {
                const badge = document.getElementById(elId);
                if (badge) {
                    badge.textContent = text;
                    if (active) {
                        badge.className = "mt-2 text-[10px] font-bold text-white bg-blue-600 px-2 py-0.5 rounded-md shadow-xs";
                    } else {
                        badge.className = "mt-2 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md";
                    }
                }
            };

            // 1 & 2. Perbesar & Perkecil Teks
            let currentFontSize = parseInt(localStorage.getItem('a11y_text_size') || '100');
            const updateFontSize = (newSize) => {
                currentFontSize = Math.min(Math.max(newSize, 80), 160);
                htmlEl.style.fontSize = currentFontSize === 100 ? '' : `${currentFontSize}%`;
                localStorage.setItem('a11y_text_size', currentFontSize.toString());
                updateBadge('badge-text-size-inc', `${currentFontSize}%`, currentFontSize > 100);
                updateBadge('badge-text-size-dec', currentFontSize < 100 ? `${currentFontSize}%` : 'Normal', currentFontSize < 100);
            };
            updateFontSize(currentFontSize);

            document.getElementById('btn-increase-text')?.addEventListener('click', () => {
                updateFontSize(currentFontSize + 10);
                announce(`Ukuran teks diperbesar ke ${currentFontSize} persen.`);
            });

            document.getElementById('btn-decrease-text')?.addEventListener('click', () => {
                updateFontSize(currentFontSize - 10);
                announce(`Ukuran teks diperkecil ke ${currentFontSize} persen.`);
            });

            // 3. Kejenuhan Warna (Saturation Cycle: normal -> monochrome -> low -> high -> normal)
            const satModes = ['normal', 'monochrome', 'low', 'high'];
            let currentSat = localStorage.getItem('a11y_sat') || 'normal';
            const applySat = (mode) => {
                htmlEl.classList.remove('sat-monochrome', 'sat-low', 'sat-high');
                if (mode !== 'normal') htmlEl.classList.add('sat-' + mode);
                localStorage.setItem('a11y_sat', mode);

                let label = 'Normal';
                if (mode === 'monochrome') label = 'Monokrom';
                if (mode === 'low') label = 'Redup';
                if (mode === 'high') label = 'Tinggi';
                updateBadge('badge-sat-status', label, mode !== 'normal');
            };
            applySat(currentSat);

            document.getElementById('btn-toggle-sat')?.addEventListener('click', () => {
                const nextIdx = (satModes.indexOf(currentSat) + 1) % satModes.length;
                currentSat = satModes[nextIdx];
                applySat(currentSat);
                announce(`Kejenuhan warna diatur ke ${currentSat}.`);
            });

            // 4. Kontras+ (High Contrast)
            let isHighContrast = localStorage.getItem('a11y_high_contrast') === '1';
            const applyContrast = (active) => {
                htmlEl.classList.toggle('high-contrast', active);
                localStorage.setItem('a11y_high_contrast', active ? '1' : '0');
                updateBadge('badge-contrast-status', active ? 'Aktif' : 'Off', active);
            };
            applyContrast(isHighContrast);

            document.getElementById('btn-toggle-contrast')?.addEventListener('click', () => {
                isHighContrast = !isHighContrast;
                applyContrast(isHighContrast);
                announce(isHighContrast ? 'Mode Kontras Tinggi diaktifkan.' : 'Mode Kontras Tinggi dinonaktifkan.');
            });

            // 5. Ramah Disleksia
            let isDyslexia = localStorage.getItem('a11y_dyslexia') === '1';
            const applyDyslexia = (active) => {
                htmlEl.classList.toggle('dyslexia-mode', active);
                localStorage.setItem('a11y_dyslexia', active ? '1' : '0');
                updateBadge('badge-dyslexia-status', active ? 'Aktif' : 'Off', active);
            };
            applyDyslexia(isDyslexia);

            document.getElementById('btn-toggle-dyslexia')?.addEventListener('click', () => {
                isDyslexia = !isDyslexia;
                applyDyslexia(isDyslexia);
                announce(isDyslexia ? 'Mode Ramah Disleksia diaktifkan.' : 'Mode Ramah Disleksia dinonaktifkan.');
            });

            // 6. Tinggi Garis (Line Height)
            let isLineHeight = localStorage.getItem('a11y_line_height') === '1';
            const applyLineHeight = (active) => {
                htmlEl.classList.toggle('line-height-mode', active);
                localStorage.setItem('a11y_line_height', active ? '1' : '0');
                updateBadge('badge-line-height-status', active ? 'Tinggi' : 'Normal', active);
            };
            applyLineHeight(isLineHeight);

            document.getElementById('btn-toggle-line-height')?.addEventListener('click', () => {
                isLineHeight = !isLineHeight;
                applyLineHeight(isLineHeight);
                announce(isLineHeight ? 'Spasi Tinggi Garis diaktifkan.' : 'Spasi Tinggi Garis dinonaktifkan.');
            });

            // 7. Kursor Besar (Large Cursor)
            let isLargeCursor = localStorage.getItem('a11y_large_cursor') === '1';
            const applyLargeCursor = (active) => {
                htmlEl.classList.toggle('large-cursor', active);
                localStorage.setItem('a11y_large_cursor', active ? '1' : '0');
                updateBadge('badge-cursor-status', active ? 'Besar' : 'Normal', active);
            };
            applyLargeCursor(isLargeCursor);

            document.getElementById('btn-toggle-cursor')?.addEventListener('click', () => {
                isLargeCursor = !isLargeCursor;
                applyLargeCursor(isLargeCursor);
                announce(isLargeCursor ? 'Kursor Besar diaktifkan.' : 'Kursor Besar dinonaktifkan.');
            });

            // 8. Spasi Teks
            let isTextSpacing = localStorage.getItem('a11y_text_spacing') === '1';
            const applyTextSpacing = (active) => {
                htmlEl.classList.toggle('text-spacing-mode', active);
                localStorage.setItem('a11y_text_spacing', active ? '1' : '0');
                updateBadge('badge-spacing-status', active ? 'Renggang' : 'Normal', active);
            };
            applyTextSpacing(isTextSpacing);

            document.getElementById('btn-toggle-text-spacing')?.addEventListener('click', () => {
                isTextSpacing = !isTextSpacing;
                applyTextSpacing(isTextSpacing);
                announce(isTextSpacing ? 'Spasi Teks Renggang diaktifkan.' : 'Spasi Teks dinonaktifkan.');
            });

            // 9. Garis Bawahi Tautan
            let isUnderline = localStorage.getItem('a11y_underline') === '1';
            const applyUnderline = (active) => {
                htmlEl.classList.toggle('underline-links', active);
                localStorage.setItem('a11y_underline', active ? '1' : '0');
                updateBadge('badge-underline-status', active ? 'Aktif' : 'Off', active);
            };
            applyUnderline(isUnderline);

            document.getElementById('btn-toggle-underline')?.addEventListener('click', () => {
                isUnderline = !isUnderline;
                applyUnderline(isUnderline);
                announce(isUnderline ? 'Garis Bawahi Tautan diaktifkan.' : 'Garis Bawahi Tautan dinonaktifkan.');
            });

            // Reset Semua Pengaturan
            resetBtn?.addEventListener('click', () => {
                updateFontSize(100);
                applySat('normal'); currentSat = 'normal';
                applyContrast(false); isHighContrast = false;
                applyDyslexia(false); isDyslexia = false;
                applyLineHeight(false); isLineHeight = false;
                applyLargeCursor(false); isLargeCursor = false;
                applyTextSpacing(false); isTextSpacing = false;
                applyUnderline(false); isUnderline = false;

                localStorage.removeItem('a11y_text_size');
                localStorage.removeItem('a11y_sat');
                localStorage.removeItem('a11y_high_contrast');
                localStorage.removeItem('a11y_dyslexia');
                localStorage.removeItem('a11y_line_height');
                localStorage.removeItem('a11y_large_cursor');
                localStorage.removeItem('a11y_text_spacing');
                localStorage.removeItem('a11y_underline');
                localStorage.removeItem('a11y_lang');

                announce('Semua 9 fitur aksesibilitas direset ke default.');
            });
        });
    </script>

    {{-- Script tambahan per halaman (opsional) --}}
    @stack('scripts')
</body>

</html>
