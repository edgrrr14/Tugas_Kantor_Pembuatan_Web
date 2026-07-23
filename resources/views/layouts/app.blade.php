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
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800">

    {{-- Tombol Login Admin Melayang di Pojok Kanan Atas (Tampil hanya di Beranda utama saat belum login) --}}
    @if(request()->routeIs('home') && !session()->has('admin_logged_in'))
        <div class="fixed top-4 right-4 z-40">
            <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl shadow-sm text-xs font-semibold text-slate-600 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span>Login Admin</span>
            </a>
        </div>
    @endif

    {{-- Navbar dihapus sesuai permintaan --}}
    <nav id="main-navbar" class="hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- LOGO & NAMA WEBSITE (Kiri) --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    {{-- Ikon sertifikat sebagai logo --}}
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-blue-300 transition-shadow duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-blue-800 text-base leading-tight block">Sertifikasi Elektronik</span>
                        <span class="text-slate-500 text-xs leading-tight block">Portal Resmi</span>
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
                    <a href="https://wa.me/628123456789?text=Halo%2C%20saya%20membutuhkan%20bantuan%20terkait%20Sertifikasi%20Elektronik."
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
                <a href="https://wa.me/628123456789?text=Halo%2C%20saya%20membutuhkan%20bantuan%20terkait%20Sertifikasi%20Elektronik."
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
    <main>
        @yield('content')
    </main>

    {{-- ============================================================
        FOOTER GLOBAL (Hidden on Admin Routes)
    ============================================================ --}}
    @if(!request()->is('admin*'))
    <footer class="bg-slate-900 text-slate-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

                {{-- Kolom 1: Logo & Deskripsi --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <span class="text-white font-bold">Sertifikasi Elektronik</span>
                    </div>
                    <p class="text-sm leading-relaxed">
                        Portal resmi layanan sertifikasi elektronik yang cepat, aman, dan dapat diandalkan untuk kebutuhan Anda.
                    </p>
                </div>

                {{-- Kolom 2: Tautan Cepat --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors duration-200">Beranda</a></li>
                        <li><a href="{{ route('penerbitan') }}" class="hover:text-blue-400 transition-colors duration-200">Form Penerbitan</a></li>
                        <li><a href="{{ route('pembaruan') }}" class="hover:text-blue-400 transition-colors duration-200">Form Pembaruan</a></li>
                        <li><a href="{{ route('informasi') }}" class="hover:text-blue-400 transition-colors duration-200">Informasi Web</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Kontak --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Bantuan</h4>
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
                <p>&copy; {{ date('Y') }} Sertifikasi Elektronik &mdash; Portal Resmi Sertifikasi Elektronik. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
    @endif

    {{-- ============================================================
        JAVASCRIPT GLOBAL
    ============================================================ --}}
    <script>
        // ----------------------------------------------------------
        // Mobile Menu Toggle
        // Mengontrol buka/tutup menu hamburger di tampilan mobile.
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
        // Pesan sukses/error akan otomatis menghilang setelah 5 detik.
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
    </script>

    {{-- Script tambahan per halaman (opsional) --}}
    @stack('scripts')
</body>

</html>
