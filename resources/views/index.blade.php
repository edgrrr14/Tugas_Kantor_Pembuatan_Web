{{--
    ================================================================
    HALAMAN LANDING PAGE: resources/views/index.blade.php
    ================================================================
    Halaman utama yang menampilkan:
    1. Section Hero dengan judul, subjudul, dan CTA
    2. Section Grid Menu 4 Kartu (Penerbitan, Pembaruan, Informasi, Helpdesk)
    3. Section Fitur Unggulan
    4. Section Alur Proses
    ================================================================
--}}
@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Portal resmi Sertifikasi Elektronik. Urus penerbitan dan pembaruan sertifikat digital Anda dengan mudah, cepat, dan aman.')

@section('content')



{{-- ================================================================
    SECTION 2: GRID MENU UTAMA (4 KARTU)
    Empat kartu menu yang responsif, masing-masing mengarah ke
    fungsi utama website.
================================================================ --}}
<section id="menu-utama" class="pt-10 pb-14 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ============================================================
            FLASH MESSAGE (Pesan Sukses)
        ============================================================ --}}
        @if (session('success'))
            <div id="flash-message" class="max-w-3xl mx-auto flex items-start gap-4 bg-green-50 border border-green-200 text-green-800 rounded-2xl p-5 mb-10 shadow-sm transition-all duration-500 relative">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 pr-8">
                    <div class="font-semibold text-sm">Pengajuan Berhasil Dikirim!</div>
                    <div class="text-sm mt-0.5 text-green-700">{{ session('success') }}</div>
                </div>
                <button onclick="document.getElementById('flash-message').style.display='none'" class="absolute top-4 right-4 text-green-600 hover:text-green-800 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Header section: Judul utama Portal Sertifikasi Elektronik --}}
        <div class="text-center mb-12">
            {{-- Logo Kabupaten Mamasa --}}
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo-mamasa.png') }}" alt="Logo Kabupaten Mamasa" class="h-28 sm:h-32 w-auto object-contain drop-shadow-md hover:scale-105 transition-transform duration-300">
            </div>
            {{-- Identitas Pemerintah --}}
            <div class="inline-block px-4 py-1.5 bg-blue-50 border border-blue-100 text-blue-800 rounded-full text-xs sm:text-sm font-bold uppercase tracking-wider mb-3" data-i18n="hero_title_2">
                Pemerintah Kabupaten Mamasa
            </div>
            {{-- Judul utama H1 --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-800 mb-3 leading-tight">
                Portal <span class="text-blue-700" data-i18n="hero_title_1">Sertifikasi Elektronik</span>
            </h1>
            <p class="text-slate-500 text-base max-w-xl mx-auto leading-relaxed" data-i18n="hero_desc">
                Layanan penerbitan dan pembaruan sertifikat digital <strong class="text-slate-700">Pemerintah Kabupaten Mamasa</strong> yang <strong class="text-slate-700">cepat, aman, dan terpercaya</strong>.
            </p>
        </div>

        {{-- Grid 4 Kartu Menu --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- ===== KARTU 1: FORM PENERBITAN ===== --}}
            <a href="{{ route('penerbitan') }}" id="card-penerbitan"
                class="group bg-white rounded-2xl p-7 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-blue-100 hover:-translate-y-2 transition-all duration-300 cursor-pointer flex flex-col">

                {{-- Ikon --}}
                <div class="w-14 h-14 bg-blue-50 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center mb-5 transition-colors duration-300">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>

                {{-- Konten --}}
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-blue-700 transition-colors duration-200" data-i18n="penerbitan">
                        Form Penerbitan
                    </h3>
                    <p class="text-slate-500 text-sm leading-relaxed" data-i18n="card_penerbitan_desc">
                        Ajukan permohonan penerbitan sertifikat elektronik baru untuk pertama kali.
                    </p>
                </div>

                {{-- CTA Arrow --}}
                <div class="flex items-center gap-2 mt-6 text-blue-600 text-sm font-semibold group-hover:gap-3 transition-all duration-200">
                    <span data-i18n="card_penerbitan_btn">Mulai Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            {{-- ===== KARTU 2: FORM PEMBARUAN ===== --}}
            <a href="{{ route('pembaruan') }}" id="card-pembaruan"
                class="group bg-white rounded-2xl p-7 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-indigo-100 hover:-translate-y-2 transition-all duration-300 cursor-pointer flex flex-col">

                {{-- Ikon --}}
                <div class="w-14 h-14 bg-indigo-50 group-hover:bg-indigo-100 rounded-2xl flex items-center justify-center mb-5 transition-colors duration-300">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>

                {{-- Konten --}}
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-indigo-700 transition-colors duration-200" data-i18n="pembaruan">
                        Form Pembaruan
                    </h3>
                    <p class="text-slate-500 text-sm leading-relaxed" data-i18n="card_pembaruan_desc">
                        Perbarui atau perpanjang sertifikat elektronik Anda yang sudah ada atau akan habis masa berlakunya.
                    </p>
                </div>

                {{-- CTA Arrow --}}
                <div class="flex items-center gap-2 mt-6 text-indigo-600 text-sm font-semibold group-hover:gap-3 transition-all duration-200">
                    <span data-i18n="card_pembaruan_btn">Perbarui Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            {{-- ===== KARTU 3: INFORMASI WEB ===== --}}
            <a href="{{ route('informasi') }}" id="card-informasi"
                class="group bg-white rounded-2xl p-7 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-cyan-100 hover:-translate-y-2 transition-all duration-300 cursor-pointer flex flex-col">

                {{-- Ikon --}}
                <div class="w-14 h-14 bg-cyan-50 group-hover:bg-cyan-100 rounded-2xl flex items-center justify-center mb-5 transition-colors duration-300">
                    <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                {{-- Konten --}}
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-cyan-700 transition-colors duration-200" data-i18n="informasi">
                        Informasi Web
                    </h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Pelajari tentang apa itu sertifikasi elektronik dan bagaimana prosedur pengajuannya.
                    </p>
                </div>

                {{-- CTA Arrow --}}
                <div class="flex items-center gap-2 mt-6 text-cyan-600 text-sm font-semibold group-hover:gap-3 transition-all duration-200">
                    Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            {{-- ===== KARTU 4: HELPDESK WHATSAPP ===== --}}
            <button type="button" id="btn-open-helpdesk"
                class="group text-left bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-7 shadow-sm hover:shadow-xl hover:shadow-green-200 hover:-translate-y-2 transition-all duration-300 cursor-pointer flex flex-col focus:outline-none focus:ring-4 focus:ring-green-300">

                {{-- Ikon --}}
                <div class="w-14 h-14 bg-white/20 group-hover:bg-white/30 rounded-2xl flex items-center justify-center mb-5 transition-colors duration-300">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                </div>

                {{-- Konten --}}
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-white mb-2">Helpdesk</h3>
                    <p class="text-green-100 text-sm leading-relaxed">
                        Butuh bantuan? Isi formulir pertanyaan untuk terhubung langsung dengan WA Admin.
                    </p>
                </div>

                {{-- CTA --}}
                <div class="flex items-center gap-2 mt-6 text-white text-sm font-semibold group-hover:gap-3 transition-all duration-200">
                    Buka Helpdesk
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </button>

        </div>

        {{-- Card Baru: Download Persyaratan / Surat Rekomendasi --}}
        <div class="mt-12 flex justify-center">
            <button id="btn-download-persyaratan" 
                class="group flex items-center gap-4 bg-white hover:bg-slate-50 border border-slate-200 rounded-2xl p-5 max-w-xl w-full shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer text-left focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <div class="w-12 h-12 bg-indigo-50 group-hover:bg-indigo-100 rounded-xl flex items-center justify-center shrink-0 transition-colors duration-300">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-slate-800 font-bold text-sm mb-1 group-hover:text-indigo-700 transition-colors duration-200">
                        Unduh Persyaratan & Templat
                    </h4>
                    <p class="text-slate-500 text-xs leading-relaxed">
                        Dapatkan dokumen templat surat permohonan & rekomendasi untuk pengajuan penerbitan dan pembaruan.
                    </p>
                </div>
                <div class="text-slate-400 group-hover:text-indigo-600 transition-colors duration-200 mr-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </button>
        </div>

    </div>
</section>

{{-- ================================================================
    SECTION 4: ALUR PROSES
    Timeline alur proses pengajuan sertifikat.
================================================================ --}}
<section id="alur-proses" class="py-20 bg-gradient-to-br from-blue-700 to-blue-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mt-2" data-i18n="flow_title">Alur Proses Pengajuan</h2>
            <p class="text-blue-100 mt-4 text-base" data-i18n="flow_subtitle">Hanya 4 langkah mudah untuk mendapatkan sertifikat elektronik Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative">
            {{-- Garis penghubung (hanya desktop) --}}
            <div class="hidden lg:block absolute top-10 left-[12.5%] right-[12.5%] h-0.5 bg-blue-500/50 z-0"></div>

            @foreach([
                ['step' => '01', 'key' => 'flow_1', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi data diri dan unggah dokumen pendukung yang diperlukan.', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                ['step' => '02', 'key' => 'flow_2', 'title' => 'Verifikasi Admin', 'desc' => 'Tim admin kami akan memeriksa kelengkapan dan keabsahan dokumen Anda.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                ['step' => '03', 'key' => 'flow_3', 'title' => 'Update Status', 'desc' => 'Setelah pengajuan, informasi status tentang perkembangan sertifikasi elektronik akan diperbarui.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['step' => '04', 'key' => 'flow_4', 'title' => 'Notifikasi Selesai', 'desc' => 'Sistem akan mengirimkan notifikasi kepada pemohon bahwa proses telah selesai.', 'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
            ] as $index => $step)
            <div class="relative z-10 text-center">
                <div class="w-20 h-20 bg-white border-2 border-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-300">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}" />
                    </svg>
                </div>
                <div class="text-xs font-bold text-blue-300 uppercase tracking-widest mb-2">Langkah {{ $step['step'] }}</div>
                <h4 class="font-bold text-white mb-2" data-i18n="{{ $step['key'] }}_title">{{ $step['title'] }}</h4>
                <p class="text-blue-100 text-sm leading-relaxed" data-i18n="{{ $step['key'] }}_desc">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>

    </div>
</section>

@if(session('whatsapp_url'))
    <script>
        // Membuka tab WhatsApp Admin secara otomatis dengan isi pengajuan lengkap setelah form disubmit
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.open("{!! session('whatsapp_url') !!}", "_blank");
            }, 600);
        });
    </script>
@endif

{{-- ================================================================
    MODAL DOWNLOAD PERSYARATAN (DROPDOWN PENERBITAN & PEMBARUAN)
================================================================ --}}
<div id="modal-download" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    {{-- Backdrop blur --}}
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" id="close-modal-backdrop"></div>

        {{-- Centering helper --}}
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        {{-- Modal Content --}}
        <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-100">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-indigo-700 to-indigo-800 px-6 py-4 flex items-center justify-between text-white">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-base font-bold" id="modal-title">Unduh Dokumen Persyaratan</h3>
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6">
                {{-- Dropdown Pemilihan Kategori Pengajuan --}}
                <div class="mb-6">
                    <label for="select-kategori-dokumen" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Pilih Kategori Dokumen Pengajuan:
                    </label>
                    <div class="relative">
                        <select id="select-kategori-dokumen" onchange="switchDokumenKategori(this.value)"
                            class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-300 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all cursor-pointer shadow-xs appearance-none">
                            <option value="penerbitan" selected>📄 Dokumen Persyaratan Penerbitan</option>
                            <option value="pembaruan">🔄 Dokumen Persyaratan Pembaruan</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi Panduan Singkat --}}
                <p class="text-slate-600 text-xs leading-relaxed mb-4" id="text-kategori-desc">
                    Silakan unduh dokumen templat permohonan & rekomendasi penerbitan baru di bawah ini:
                </p>

                {{-- Container 1: Dokumen Penerbitan --}}
                <div id="container-penerbitan" class="space-y-3">
                    @forelse($dokumenPenerbitan ?? [] as $item)
                        @php
                            $downloadUrl = str_starts_with($item->file_path, 'templates/') 
                                ? asset($item->file_path) 
                                : asset('storage/' . $item->file_path);
                            $ext = strtoupper($item->tipe_file ?? 'DOCX');
                        @endphp
                        <a href="{{ $downloadUrl }}" download
                            class="flex items-center gap-4 p-4 border border-slate-200 hover:border-blue-500 hover:bg-blue-50/30 rounded-xl transition-all duration-200 group">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center shrink-0 font-extrabold text-xs">
                                @if(in_array(strtolower($item->tipe_file), ['pdf']))
                                    <span class="text-red-600">PDF</span>
                                @else
                                    <span>DOCX</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-bold text-slate-800 group-hover:text-blue-700 transition-colors truncate">
                                    {{ $item->nama_dokumen }}
                                </div>
                                <div class="text-xs text-slate-400 mt-0.5 leading-tight">
                                    {{ $item->deskripsi ?? 'Format ' . $ext . ' • Wajib diisi' }}
                                </div>
                            </div>
                            <div class="text-slate-400 group-hover:text-blue-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 bg-slate-50 rounded-xl text-center text-slate-400 text-xs font-semibold border border-dashed border-slate-200">
                            Belum ada dokumen syarat penerbitan yang diunggah.
                        </div>
                    @endforelse
                </div>

                {{-- Container 2: Dokumen Pembaruan --}}
                <div id="container-pembaruan" class="space-y-3 hidden">
                    @forelse($dokumenPembaruan ?? [] as $item)
                        @php
                            $downloadUrl = str_starts_with($item->file_path, 'templates/') 
                                ? asset($item->file_path) 
                                : asset('storage/' . $item->file_path);
                            $ext = strtoupper($item->tipe_file ?? 'DOCX');
                        @endphp
                        <a href="{{ $downloadUrl }}" download
                            class="flex items-center gap-4 p-4 border border-slate-200 hover:border-indigo-500 hover:bg-indigo-50/30 rounded-xl transition-all duration-200 group">
                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center shrink-0 font-extrabold text-xs">
                                @if(in_array(strtolower($item->tipe_file), ['pdf']))
                                    <span class="text-red-600">PDF</span>
                                @else
                                    <span>DOCX</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-bold text-slate-800 group-hover:text-indigo-700 transition-colors truncate">
                                    {{ $item->nama_dokumen }}
                                </div>
                                <div class="text-xs text-slate-400 mt-0.5 leading-tight">
                                    {{ $item->deskripsi ?? 'Format ' . $ext . ' • Wajib diisi' }}
                                </div>
                            </div>
                            <div class="text-slate-400 group-hover:text-indigo-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 bg-slate-50 rounded-xl text-center text-slate-400 text-xs font-semibold border border-dashed border-slate-200">
                            Belum ada dokumen syarat pembaruan yang diunggah.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Footer --}}
            <div class="bg-slate-50 px-6 py-4 flex justify-end rounded-b-2xl border-t border-slate-100">
                <button type="button" id="btn-close-modal-footer" 
                    class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold text-sm rounded-xl transition-all duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ================================================================
    MODAL HELPDESK INPUT PERTANYAAN
================================================================ --}}
<div id="modal-helpdesk" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-helpdesk-title" role="dialog" aria-modal="true">
    {{-- Backdrop blur --}}
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" id="close-helpdesk-backdrop"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        {{-- Modal Content --}}
        <div class="relative inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-100">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-emerald-600 to-green-600 px-6 py-5 flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold" id="modal-helpdesk-title">Layanan Helpdesk Admin</h3>
                        <p class="text-xs text-green-100">Lengkapi data untuk terhubung langsung via WhatsApp</p>
                    </div>
                </div>
                <button type="button" id="btn-close-helpdesk" class="text-white/80 hover:text-white p-1.5 rounded-xl hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Form Body --}}
            <form id="form-helpdesk-wa" class="p-6 space-y-4">
                <div id="helpdesk-error-alert" class="hidden p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600 font-semibold">
                    Mohon lengkapi seluruh field formulir sebelum mengirim ke WhatsApp.
                </div>

                {{-- Nama Lengkap --}}
                <div>
                    <label for="helpdesk_nama" class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="helpdesk_nama" placeholder="Masukkan nama sesuai KTP" required
                        class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                {{-- NIP & NIK (2 kolom) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="helpdesk_nip" class="block text-xs font-bold text-slate-700 mb-1">
                            NIP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="helpdesk_nip" placeholder="18 digit NIP" maxlength="18" required
                            class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                    <div>
                        <label for="helpdesk_nik" class="block text-xs font-bold text-slate-700 mb-1">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="helpdesk_nik" placeholder="16 digit NIK" maxlength="16" required
                            class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                </div>

                {{-- Asal Unit Kerja --}}
                <div>
                    <label for="helpdesk_unit_kerja" class="block text-xs font-bold text-slate-700 mb-1">
                        Asal Unit Kerja / OPD <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="helpdesk_unit_kerja" placeholder="Contoh: Dinas Kesehatan / Bagian Umum" required
                        class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                {{-- Keterangan Permintaan / Pertanyaan --}}
                <div>
                    <label for="helpdesk_keterangan" class="block text-xs font-bold text-slate-700 mb-1">
                        Keterangan Permintaan / Pertanyaan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="helpdesk_keterangan" rows="3" placeholder="Tuliskan kendala atau pertanyaan yang ingin Anda sampaikan secara rinci..." required
                        class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 leading-relaxed"></textarea>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit" id="btn-submit-helpdesk-wa"
                        class="w-full flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white font-bold text-xs rounded-xl shadow-md transition-all duration-200 cursor-pointer disabled:opacity-70 disabled:cursor-not-allowed">
                        <svg id="icon-wa-helpdesk" class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        <svg id="icon-spin-helpdesk" class="w-4 h-4 hidden animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span id="text-submit-helpdesk-wa">Kirim Pertanyaan ke WA Admin</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle Kategori Dokumen Persyaratan (Penerbitan vs Pembaruan)
    function switchDokumenKategori(kategori) {
        const containerPenerbitan = document.getElementById('container-penerbitan');
        const containerPembaruan  = document.getElementById('container-pembaruan');
        const textDesc            = document.getElementById('text-kategori-desc');

        if (kategori === 'pembaruan') {
            if (containerPenerbitan) containerPenerbitan.classList.add('hidden');
            if (containerPembaruan)  containerPembaruan.classList.remove('hidden');
            if (textDesc) textDesc.textContent = 'Silakan unduh dokumen templat permohonan & rekomendasi pembaruan sertifikat di bawah ini:';
        } else {
            if (containerPembaruan)  containerPembaruan.classList.add('hidden');
            if (containerPenerbitan) containerPenerbitan.classList.remove('hidden');
            if (textDesc) textDesc.textContent = 'Silakan unduh dokumen templat permohonan & rekomendasi penerbitan baru di bawah ini:';
        }
    }

    // Modal Download Logic
    const btnDownload = document.getElementById('btn-download-persyaratan');
    const modalDownload = document.getElementById('modal-download');
    const btnCloseModalFooter = document.getElementById('btn-close-modal-footer');
    const closeModalBackdrop = document.getElementById('close-modal-backdrop');

    if (btnDownload && modalDownload) {
        const toggleModal = (show) => {
            if (show) {
                modalDownload.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                modalDownload.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        };

        btnDownload.addEventListener('click', () => toggleModal(true));
        if (btnCloseModalFooter) btnCloseModalFooter.addEventListener('click', () => toggleModal(false));
        if (closeModalBackdrop) closeModalBackdrop.addEventListener('click', () => toggleModal(false));
    }

    // Modal Helpdesk Logic
    const btnOpenHelpdesk = document.getElementById('btn-open-helpdesk');
    const modalHelpdesk = document.getElementById('modal-helpdesk');
    const btnCloseHelpdesk = document.getElementById('btn-close-helpdesk');
    const closeHelpdeskBackdrop = document.getElementById('close-helpdesk-backdrop');
    const formHelpdeskWa = document.getElementById('form-helpdesk-wa');
    const helpdeskAlert = document.getElementById('helpdesk-error-alert');

    if (btnOpenHelpdesk && modalHelpdesk) {
        const toggleHelpdeskModal = (show) => {
            if (show) {
                modalHelpdesk.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                modalHelpdesk.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        };

        btnOpenHelpdesk.addEventListener('click', () => toggleHelpdeskModal(true));
        if (btnCloseHelpdesk) btnCloseHelpdesk.addEventListener('click', () => toggleHelpdeskModal(false));
        if (closeHelpdeskBackdrop) closeHelpdeskBackdrop.addEventListener('click', () => toggleHelpdeskModal(false));

        if (formHelpdeskWa) {
            formHelpdeskWa.addEventListener('submit', async (e) => {
                e.preventDefault();
                const nama = document.getElementById('helpdesk_nama').value.trim();
                const nip = document.getElementById('helpdesk_nip').value.trim();
                const nik = document.getElementById('helpdesk_nik').value.trim();
                const unitKerja = document.getElementById('helpdesk_unit_kerja').value.trim();
                const keterangan = document.getElementById('helpdesk_keterangan').value.trim();

                const btnSubmit = document.getElementById('btn-submit-helpdesk-wa');
                const iconWa = document.getElementById('icon-wa-helpdesk');
                const iconSpin = document.getElementById('icon-spin-helpdesk');
                const textSubmit = document.getElementById('text-submit-helpdesk-wa');

                if (!nama || !nip || !nik || !unitKerja || !keterangan) {
                    if (helpdeskAlert) helpdeskAlert.classList.remove('hidden');
                    return;
                }

                if (helpdeskAlert) helpdeskAlert.classList.add('hidden');

                // Tampilkan indikator loading saat tombol ditekan
                if (btnSubmit) btnSubmit.disabled = true;
                if (iconWa) iconWa.classList.add('hidden');
                if (iconSpin) iconSpin.classList.remove('hidden');
                if (textSubmit) textSubmit.textContent = 'Menyimpan data & membuka WA...';

                // Simpan ke database MySQL via AJAX persis saat tombol ditekan
                try {
                    await fetch('{{ route("helpdesk.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            nama: nama,
                            nip: nip,
                            nik: nik,
                            unit_kerja: unitKerja,
                            keterangan: keterangan
                        })
                    });
                } catch (err) {
                    console.error('Error storing helpdesk entry:', err);
                }

                // Susun pesan dan buka WhatsApp
                const message = `Halo Admin, saya membutuhkan bantuan terkait Sertifikasi Elektronik.\n\nBerikut Data Pemohon:\n• Nama: ${nama}\n• NIP: ${nip}\n• NIK: ${nik}\n• Unit Kerja: ${unitKerja}\n\nKeterangan / Pertanyaan:\n${keterangan}`;

                const waUrl = `https://wa.me/6282312293928?text=${encodeURIComponent(message)}`;
                window.open(waUrl, '_blank');

                // Reset state tombol & form
                if (btnSubmit) btnSubmit.disabled = false;
                if (iconWa) iconWa.classList.remove('hidden');
                if (iconSpin) iconSpin.classList.add('hidden');
                if (textSubmit) textSubmit.textContent = 'Kirim Pertanyaan ke WA Admin';

                toggleHelpdeskModal(false);
                formHelpdeskWa.reset();
            });
        }
    }
</script>
@endpush

@endsection
