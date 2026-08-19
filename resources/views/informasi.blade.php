{{--
    ================================================================
    HALAMAN INFORMASI WEB: resources/views/informasi.blade.php
    ================================================================
    Halaman artikel informatif tentang website Sertifikasi Elektronik.
    Layout rapi dengan tipografi yang jelas, menggunakan struktur artikel
    yang mudah dibaca (readable typography, proper line-height, hierarchy).

    Konten mencakup:
    1. Apa itu Sertifikasi Elektronik?
    2. Dasar Hukum
    3. Manfaat
    4. Prosedur Singkat
    5. Persyaratan Dokumen
    6. FAQ
    ================================================================
--}}
@extends('layouts.app')

@section('title', 'Informasi Web')
@section('meta_description', 'Pelajari tentang Sertifikasi Elektronik: definisi, dasar hukum, manfaat, prosedur pengajuan, dan persyaratan dokumen yang diperlukan.')

@section('content')

{{-- ================================================================
    HERO SECTION INFORMASI
================================================================ --}}
<section class="bg-gradient-to-r from-slate-800 to-slate-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Tombol Kembali di Pojok Kiri --}}
        <div class="mb-4">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white rounded-xl text-xs font-semibold border border-white/10 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <div class="max-w-4xl mx-auto text-center">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-blue-300 text-xs font-semibold px-4 py-2 rounded-full mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Panduan & Informasi
            </div>

            {{-- Judul Halaman --}}
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 leading-tight">
                Informasi Layanan<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-cyan-300">
                    Sertifikasi Elektronik
                </span>
            </h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto leading-relaxed">
                Panduan lengkap tentang layanan sertifikasi elektronik: definisi, prosedur, persyaratan, dan informasi lainnya.
            </p>
        </div>
    </div>
</section>

{{-- ================================================================
    KONTEN UTAMA ARTIKEL
================================================================ --}}
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- ============================================================
                KOLOM KIRI: DAFTAR ISI / NAVIGASI ARTIKEL (Sticky)
            ============================================================ --}}
            <aside class="lg:w-64 shrink-0">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 lg:sticky lg:top-24">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest mb-4" data-i18n="toc_title">Daftar Isi</h3>
                    <nav class="space-y-2">
                        <a href="#dasar-hukum" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">1</span>
                            <span data-i18n="toc_1">Dasar Hukum</span>
                        </a>
                        <a href="#prosedur" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">2</span>
                            <span data-i18n="toc_2">Prosedur Pengajuan</span>
                        </a>
                        <a href="#persyaratan" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">3</span>
                            <span data-i18n="toc_3">Persyaratan Dokumen</span>
                        </a>
                        <a href="#sop" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">4</span>
                            <span>SOP Layanan</span>
                        </a>
                        <a href="#berita" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">5</span>
                            <span>Berita & Pengumuman</span>
                        </a>
                        <a href="#faq" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">6</span>
                            <span data-i18n="toc_4">FAQ</span>
                        </a>
                    </nav>

                    {{-- CTA di sidebar --}}
                    <div class="mt-6 pt-6 border-t border-slate-100 space-y-3">
                        <a href="{{ route('penerbitan') }}"
                            class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-blue-700 text-white text-sm font-semibold rounded-xl hover:bg-blue-800 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Ajukan Penerbitan
                        </a>
                        <a href="{{ route('pembaruan') }}"
                            class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Ajukan Pembaruan
                        </a>
                    </div>
                </div>
            </aside>

            {{-- ============================================================
                KOLOM KANAN: KONTEN ARTIKEL UTAMA
            ============================================================ --}}
            <main class="flex-1 min-w-0">
                <div class="space-y-8">



                    {{-- ===== SECTION 2: Dasar Hukum ===== --}}
                    <article id="dasar-hukum" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 scroll-mt-24">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800" data-i18n="toc_1">Dasar Hukum</h2>
                        </div>

                        <p class="text-slate-600 leading-relaxed text-base mb-5">
                            Layanan Sertifikasi Elektronik ini diselenggarakan berdasarkan peraturan perundang-undangan yang berlaku di Indonesia:
                        </p>

                        <div class="space-y-3">
                            @foreach([
                                ['label' => 'UU No. 11 Tahun 2008', 'desc' => 'Undang-Undang Informasi dan Transaksi Elektronik (ITE) yang mengatur tanda tangan dan sertifikat elektronik.'],
                                ['label' => 'UU No. 19 Tahun 2016', 'desc' => 'Perubahan atas UU ITE yang memperkuat ketentuan mengenai sertifikasi elektronik.'],
                                ['label' => 'PP No. 71 Tahun 2019', 'desc' => 'Peraturan Pemerintah tentang Penyelenggaraan Sistem dan Transaksi Elektronik.'],
                                ['label' => 'Permenkominfo No. 11 Tahun 2018', 'desc' => 'Penyelenggaraan Sertifikasi Elektronik oleh Penyelenggara Sertifikasi Elektronik Indonesia.'],
                            ] as $hukum)
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-amber-50 border border-amber-100">
                                <div class="w-7 h-7 bg-amber-200 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-amber-800">{{ $hukum['label'] }}</div>
                                    <div class="text-sm text-amber-700 mt-0.5 leading-relaxed">{{ $hukum['desc'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </article>



                    {{-- ===== SECTION 4: Prosedur Pengajuan ===== --}}
                    <article id="prosedur" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 scroll-mt-24">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800" data-i18n="toc_2">Prosedur Pengajuan</h2>
                        </div>

                        <div class="space-y-4">
                            @foreach([
                                ['num' => '1', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi data diri dan unggah dokumen pendukung yang diperlukan.'],
                                ['num' => '2', 'title' => 'Verifikasi Admin', 'desc' => 'Admin akan memeriksa kelengkapan dan keabsahan dokumen Anda.'],
                                ['num' => '3', 'title' => 'Update Status', 'desc' => 'Setelah pengajuan, informasi status tentang perkembangan sertifikasi elektronik akan diperbarui.'],
                                ['num' => '4', 'title' => 'Notifikasi Selesai', 'desc' => 'Sistem akan mengirimkan notifikasi kepada pemohon bahwa proses telah selesai.'],
                            ] as $step)
                            <div class="flex gap-5">
                                <div class="flex flex-col items-center">
                                    <div class="w-9 h-9 bg-indigo-600 text-white rounded-full flex items-center justify-center text-sm font-bold shrink-0">
                                        {{ $step['num'] }}
                                    </div>
                                    @if(!$loop->last)
                                        <div class="w-0.5 flex-1 bg-indigo-100 mt-2 mb-0"></div>
                                    @endif
                                </div>
                                <div class="pb-6 {{ $loop->last ? 'pb-0' : '' }}">
                                    <h4 class="font-bold text-slate-800 mb-1 text-base">{{ $step['title'] }}</h4>
                                    <p class="text-slate-600 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </article>

                    {{-- ===== SECTION 5: Persyaratan Dokumen ===== --}}
                    <article id="persyaratan" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 scroll-mt-24">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-800" data-i18n="toc_3">Persyaratan Dokumen</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Persyaratan dokumen berlaku sama untuk pengajuan Penerbitan Baru maupun Pembaruan Sertifikat</p>
                            </div>
                        </div>

                        <p class="text-slate-600 leading-relaxed text-base mb-5">
                            Berikut adalah berkas persyaratan dan kelengkapan data yang wajib dipersiapkan sebelum mengisi formulir pengajuan Penerbitan Baru maupun Pembaruan Sertifikat Elektronik:
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach([
                                ['label' => 'Surat Permohonan', 'desc' => 'Surat permohonan resmi pengajuan sertifikat elektronik yang telah ditandatangani pemohon (Format: PDF • Maksimal 10MB).'],
                                ['label' => 'Surat Rekomendasi Unit Kerja', 'desc' => 'Surat rekomendasi resmi dari pimpinan Unit Kerja / Instansi terkait (Format: PDF • Maksimal 10MB).'],
                                ['label' => 'Foto KTP Asli', 'desc' => 'Foto atau scan e-KTP asli yang jelas, terbaca, dan tidak terpotong (Format: JPG, JPEG, atau PNG • Maksimal 10MB).'],
                                ['label' => 'NIK & NIP Pegawai', 'desc' => '16 digit Nomor Induk Kependudukan (NIK) dan 18 digit Nomor Induk Pegawai (NIP) aktif pemohon.'],
                                ['label' => 'Email & Nomor Telepon WhatsApp', 'desc' => 'Alamat email aktif serta nomor telepon WhatsApp yang dapat dihubungi untuk verifikasi data dan pengiriman notifikasi status.'],
                                ['label' => 'Unit Kerja & Jabatan', 'desc' => 'Nama Instansi / Unit Kerja dan Jabatan resmi pemohon saat ini.'],
                                ['label' => 'Alasan Pengajuan', 'desc' => 'Penjelasan singkat dan jelas mengenai keperluan atau alasan pengajuan sertifikat elektronik.'],
                            ] as $syarat)
                            <div class="flex items-start gap-3.5 p-4 rounded-xl bg-blue-50 border border-blue-100 hover:bg-blue-50/80 transition-all hover:shadow-xs {{ $loop->last && $loop->count % 2 !== 0 ? 'md:col-span-2' : '' }}">
                                <div class="w-7 h-7 bg-blue-200 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="text-sm font-bold text-blue-900">{{ $syarat['label'] }}</div>
                                    <div class="text-xs text-blue-700 mt-1 leading-relaxed">{{ $syarat['desc'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </article>

                    {{-- ===== SECTION: Standar Operasional Prosedur (SOP) ===== --}}
                    <article id="sop" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 scroll-mt-24">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-800">Standar Operasional Prosedur (SOP)</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Dokumen panduan resmi prosedur pengajuan Sertifikat Elektronik</p>
                            </div>
                        </div>

                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            Berikut adalah dokumen resmi Standar Operasional Prosedur (SOP) untuk layanan Penerbitan dan Pembaruan Sertifikat Elektronik.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Card SOP 1: SOP Penerbitan --}}
                            <div class="bg-gradient-to-br from-blue-50 to-slate-50 border border-blue-100 rounded-2xl p-6 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center font-black text-xs shrink-0 shadow-xs">
                                            PDF
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-sm">SOP Penerbitan Sertifikat Elektronik</h3>
                                            <span class="inline-block px-2.5 py-0.5 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-full mt-0.5">Penerbitan Baru</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                        Panduan teknis dan alur operasional resmi untuk pengajuan penerbitan sertifikat elektronik baru.
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 pt-3 border-t border-slate-200/60">
                                    <button type="button" onclick="openPdfModal('{{ asset('templates/SOP PENERBITAN SERTIFIKAT ELEKTRONIK.pdf') }}', 'SOP Penerbitan Sertifikat Elektronik')"
                                        class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-xl text-xs font-semibold transition-colors shadow-xs cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>Lihat SOP</span>
                                    </button>
                                    <a href="{{ asset('templates/SOP PENERBITAN SERTIFIKAT ELEKTRONIK.pdf') }}" download
                                        class="inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-semibold transition-colors shadow-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span>Unduh</span>
                                    </a>
                                </div>
                            </div>

                            {{-- Card SOP 2: SOP Pembaruan --}}
                            <div class="bg-gradient-to-br from-indigo-50 to-slate-50 border border-indigo-100 rounded-2xl p-6 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center font-black text-xs shrink-0 shadow-xs">
                                            PDF
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-sm">SOP Pembaruan Sertifikat Elektronik</h3>
                                            <span class="inline-block px-2.5 py-0.5 bg-indigo-100 text-indigo-700 text-[10px] font-bold rounded-full mt-0.5">Pembaruan / Perpanjangan</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                        Panduan teknis dan alur operasional resmi untuk pengajuan pembaruan atau perpanjangan masa berlaku sertifikat elektronik.
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 pt-3 border-t border-slate-200/60">
                                    <button type="button" onclick="openPdfModal('{{ asset('templates/SOP PEMBAHARUAN SERTIFIKAT ELEKTRONIK.pdf') }}', 'SOP Pembaruan Sertifikat Elektronik')"
                                        class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-indigo-700 hover:bg-indigo-800 text-white rounded-xl text-xs font-semibold transition-colors shadow-xs cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>Lihat SOP</span>
                                    </button>
                                    <a href="{{ asset('templates/SOP PEMBAHARUAN SERTIFIKAT ELEKTRONIK.pdf') }}" download
                                        class="inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-semibold transition-colors shadow-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span>Unduh</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                    {{-- ===== SECTION 5: BERITA & PENGUMUMAN ===== --}}
                    <article id="berita" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 scroll-mt-24">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-800">Berita & Pengumuman</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Informasi terbaru seputar sertifikasi elektronik Pemkab Mamasa</p>
                            </div>
                        </div>

                        {{-- Grid Berita (Kiri Kanan 2-2) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="public-berita-grid">
                            @forelse($beritaData ?? [] as $item)
                                @php
                                    $imgSrc = $item->gambar ? asset('storage/' . $item->gambar) : null;
                                @endphp
                                <div class="public-berita-card bg-slate-50/70 border border-slate-200 rounded-2xl overflow-hidden flex flex-col justify-between hover:border-amber-300 hover:shadow-md transition-all duration-200 group"
                                    data-kategori="{{ $item->kategori }}">
                                    
                                    {{-- Thumbnail / Header Gambar --}}
                                    @if($imgSrc)
                                        <div class="h-44 w-full overflow-hidden bg-slate-200 relative">
                                            <img src="{{ $imgSrc }}" alt="{{ $item->judul }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            <div class="absolute top-3 left-3">
                                                @if($item->kategori === 'Pengumuman')
                                                    <span class="px-2.5 py-1 bg-amber-500 text-white font-bold text-[10px] rounded-full shadow-xs">
                                                        Pengumuman
                                                    </span>
                                                @else
                                                    <span class="px-2.5 py-1 bg-blue-600 text-white font-bold text-[10px] rounded-full shadow-xs">
                                                        Berita
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="h-28 bg-gradient-to-r {{ $item->kategori === 'Pengumuman' ? 'from-amber-500 to-amber-600' : 'from-blue-600 to-indigo-700' }} p-4 flex items-center justify-between text-white relative">
                                            <div class="flex items-center gap-2">
                                                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">
                                                    {{ $item->kategori === 'Pengumuman' ? '📢' : '📰' }}
                                                </div>
                                                <span class="px-2.5 py-0.5 bg-white/20 text-white font-bold text-[11px] rounded-full backdrop-blur-xs">
                                                    {{ $item->kategori }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Konten Ringkas Kartu --}}
                                    <div class="p-5 flex-1 flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center justify-between gap-2 text-[11px] text-slate-400 font-semibold mb-2">
                                                <span>{{ $item->penulis }}</span>
                                                <span>{{ $item->formatted_date }}</span>
                                            </div>

                                            <h3 class="font-extrabold text-slate-900 text-sm leading-snug group-hover:text-amber-700 transition-colors line-clamp-2 mb-2">
                                                {{ $item->judul }}
                                            </h3>

                                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-3 mb-4">
                                                {{ $item->ringkasan }}
                                            </p>
                                        </div>

                                        {{-- Tombol Buka Modal Detail --}}
                                        <div class="pt-3 border-t border-slate-200/60">
                                            <button type="button" onclick="openBacaBeritaModal({{ json_encode($item) }})"
                                                class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-white hover:bg-amber-50 text-amber-700 hover:text-amber-800 border border-slate-200 hover:border-amber-200 rounded-xl text-xs font-bold transition-all duration-200 shadow-2xs group-hover:shadow-xs cursor-pointer">
                                                <span>Baca Selengkapnya</span>
                                                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            @empty
                                <div class="col-span-1 md:col-span-2 p-8 text-center bg-slate-50 border border-dashed border-slate-200 rounded-2xl text-slate-400 text-xs">
                                    Belum ada berita atau pengumuman yang dipublikasikan saat ini.
                                </div>
                            @endforelse
                        </div>
                    </article>

                    {{-- ===== SECTION 6: FAQ ===== --}}
                    <article id="faq" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 scroll-mt-24">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-cyan-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800">Pertanyaan Umum (FAQ)</h2>
                        </div>

                        {{-- Accordion FAQ --}}
                        <div class="space-y-3" id="faq-accordion">
                            @foreach([
                                ['q' => 'Berapa lama proses penerbitan sertifikat?', 'a' => 'Proses verifikasi membutuhkan 1 x 24 jam kerja. Setelah dokumen dinyatakan lengkap dan valid, sertifikat akan diterbitkan dalam 1-3 hari kerja dan dikirimkan ke WhatsApp Anda.'],
                                ['q' => 'Apakah sertifikat elektronik ini diakui secara hukum?', 'a' => 'Ya. Sertifikat elektronik yang kami terbitkan memiliki dasar hukum yang kuat berdasarkan UU ITE No. 11 Tahun 2008 dan perubahannya, serta PP No. 71 Tahun 2019.'],
                                ['q' => 'Berapa masa berlaku sertifikat elektronik?', 'a' => 'Masa berlaku sertifikat elektronik umumnya adalah 2 (dua) tahun sejak tanggal penerbitan. Anda dapat mengajukan pembaruan sebelum atau setelah masa berlaku habis.'],
                                ['q' => 'Apakah bisa mengajukan untuk lebih dari satu sertifikat?', 'a' => 'Ya, pengajuan dapat dilakukan untuk setiap kebutuhan yang berbeda. Setiap pengajuan akan diproses secara terpisah dengan nomor sertifikat yang unik.'],
                                ['q' => 'Bagaimana jika dokumen saya ditolak?', 'a' => 'Jika dokumen ditolak, Anda akan mendapatkan notifikasi via WhatsApp yang menjelaskan alasan penolakan beserta panduan untuk memperbaiki dan mengajukan ulang.'],
                                ['q' => 'Apakah ada biaya untuk pengajuan sertifikat?', 'a' => 'Informasi mengenai biaya layanan dapat dikonfirmasi melalui admin. Hubungi helpdesk melalui WhatsApp untuk informasi lebih lanjut.'],
                            ] as $index => $faq)
                            <div class="border border-slate-200 rounded-xl overflow-hidden faq-item">
                                <button
                                    class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-slate-50 transition-colors duration-200 faq-trigger"
                                    aria-expanded="false">
                                    <span class="font-semibold text-slate-800 text-sm pr-4">{{ $faq['q'] }}</span>
                                    <svg class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-300 faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-5 pb-4">
                                    <p class="text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">{{ $faq['a'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </article>

                </div>
            </main>
        </div>
    </div>
</section>

{{-- ================================================================
    MODAL PREVIEW PDF SOP
================================================================ --}}
<div id="modal-pdf-viewer" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-pdf-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closePdfModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-slate-200">
            <div class="bg-slate-900 px-6 py-4 flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center font-black text-xs shrink-0">PDF</div>
                    <h3 class="text-sm font-bold truncate text-white" id="modal-pdf-title">Dokumen SOP</h3>
                </div>
                <div class="flex items-center gap-2">
                    <a id="btn-modal-pdf-download" href="#" download class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold transition-colors flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Unduh File</span>
                    </a>
                    <button type="button" onclick="closePdfModal()" class="text-slate-400 hover:text-white p-1.5 rounded-lg hover:bg-slate-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-2 bg-slate-100 h-[75vh]">
                <iframe id="iframe-pdf" src="" class="w-full h-full rounded-xl border border-slate-200 bg-white" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

{{-- ================================================================
    MODAL BACA BERITA LENGKAP (IN-BROWSER NEWS READER)
================================================================ --}}
<div id="modal-baca-berita" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/70 backdrop-blur-xs transition-opacity duration-200 p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full flex flex-col max-h-[90vh] shadow-2xl border border-slate-100 transform transition-all animate-fade-in overflow-hidden">
        
        {{-- Header Modal --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center gap-2">
                <span id="modal-berita-kategori" class="px-2.5 py-0.5 rounded-full text-xs font-bold"></span>
                <span id="modal-berita-tanggal" class="text-xs text-slate-500 font-medium"></span>
            </div>
            <button type="button" onclick="closeBacaBeritaModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-200/60 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Konten Modal (Scrollable) --}}
        <div class="p-6 overflow-y-auto space-y-4 flex-1">
            <div id="modal-berita-img-container" class="hidden rounded-xl overflow-hidden max-h-72 w-full bg-slate-100 border border-slate-200">
                <img id="modal-berita-img" src="" alt="Thumbnail" class="w-full h-full object-cover">
            </div>

            <h2 id="modal-berita-judul" class="text-xl sm:text-2xl font-black text-slate-900 leading-snug"></h2>

            <div class="flex items-center gap-2 text-xs text-slate-500 pb-3 border-b border-slate-100">
                <span class="font-semibold text-slate-700">Ditulis oleh:</span>
                <span id="modal-berita-penulis"></span>
            </div>

            <div id="modal-berita-ringkasan" class="p-4 bg-amber-50/70 border border-amber-200/80 rounded-xl text-xs text-slate-800 italic leading-relaxed font-medium"></div>

            <div id="modal-berita-konten" class="text-sm text-slate-700 leading-relaxed space-y-3 whitespace-pre-line pt-2"></div>
        </div>

        {{-- Footer Modal --}}
        <div class="px-6 py-3.5 border-t border-slate-100 bg-slate-50 flex items-center justify-end">
            <button type="button" onclick="closeBacaBeritaModal()"
                class="px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs rounded-xl shadow-xs cursor-pointer">
                Tutup
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ------------------------------------------------------------------
    // MODAL PREVIEW PDF SOP
    // ------------------------------------------------------------------
    function openPdfModal(pdfUrl, title) {
        const modal = document.getElementById('modal-pdf-viewer');
        const iframe = document.getElementById('iframe-pdf');
        const titleEl = document.getElementById('modal-pdf-title');
        const downloadBtn = document.getElementById('btn-modal-pdf-download');

        if (modal && iframe) {
            titleEl.textContent = title;
            iframe.src = pdfUrl;
            downloadBtn.href = pdfUrl;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closePdfModal() {
        const modal = document.getElementById('modal-pdf-viewer');
        const iframe = document.getElementById('iframe-pdf');
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            if (iframe) iframe.src = '';
        }
    }

    // ------------------------------------------------------------------
    // MODAL BACA BERITA & FILTER HANDLERS
    // ------------------------------------------------------------------
    function openBacaBeritaModal(item) {
        const modal = document.getElementById('modal-baca-berita');
        if (!modal) return;

        document.getElementById('modal-berita-judul').textContent = item.judul || '';
        document.getElementById('modal-berita-tanggal').textContent = item.formatted_date || '';
        document.getElementById('modal-berita-penulis').textContent = item.penulis || 'Admin Diskominfo Mamasa';
        document.getElementById('modal-berita-ringkasan').textContent = item.ringkasan || '';
        document.getElementById('modal-berita-konten').textContent = item.konten || '';

        const katBadge = document.getElementById('modal-berita-kategori');
        if (katBadge) {
            katBadge.textContent = item.kategori === 'Pengumuman' ? 'Pengumuman' : 'Berita';
            katBadge.className = item.kategori === 'Pengumuman' 
                ? 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800' 
                : 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800';
        }

        const imgContainer = document.getElementById('modal-berita-img-container');
        const imgEl = document.getElementById('modal-berita-img');
        if (item.gambar) {
            imgEl.src = "{{ asset('storage') }}/" + item.gambar;
            imgContainer.classList.remove('hidden');
        } else {
            imgContainer.classList.add('hidden');
            imgEl.src = '';
        }

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeBacaBeritaModal() {
        const modal = document.getElementById('modal-baca-berita');
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    // ------------------------------------------------------------------
    // FAQ ACCORDION
    // Mengontrol expand/collapse pertanyaan FAQ.
    // ------------------------------------------------------------------
    document.querySelectorAll('.faq-trigger').forEach(trigger => {
        trigger.addEventListener('click', () => {
            const item = trigger.closest('.faq-item');
            const content = item.querySelector('.faq-content');
            const icon = trigger.querySelector('.faq-icon');
            const isOpen = !content.classList.contains('hidden');

            // Tutup semua item lain
            document.querySelectorAll('.faq-item').forEach(otherItem => {
                const otherContent = otherItem.querySelector('.faq-content');
                const otherIcon = otherItem.querySelector('.faq-icon');
                const otherTrigger = otherItem.querySelector('.faq-trigger');
                otherContent.classList.add('hidden');
                otherIcon.style.transform = 'rotate(0deg)';
                otherTrigger.setAttribute('aria-expanded', 'false');
            });

            // Buka item yang diklik (jika sebelumnya tertutup)
            if (!isOpen) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
                trigger.setAttribute('aria-expanded', 'true');
            }
        });
    });
</script>
@endpush
