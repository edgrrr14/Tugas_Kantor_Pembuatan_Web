{{--
    ================================================================
    HALAMAN FORM PEMBARUAN: resources/views/pembaruan.blade.php
    ================================================================
    Halaman pengajuan pembaruan/perpanjangan dengan surat rekomendasi.
    Desain konsisten dengan halaman Penerbitan (white card, shadow tipis,
    background abu-abu muda). Field yang tersedia:
    - Nama Lengkap
    - Nomor Sertifikat Lama
    - Email
    - Upload Surat Rekomendasi Permohonan Pembaruan
    ================================================================
--}}
@extends('layouts.app')

@section('title', 'Form Pembaruan Sertifikat')
@section('meta_description', 'Ajukan pembaruan atau perpanjangan sertifikat elektronik Anda yang sudah ada. Isi formulir dengan data yang benar dan unggah surat rekomendasi permohonan pembaruan sertifikat elektronik.')

@section('content')

{{-- ================================================================
    WRAPPER HALAMAN
================================================================ --}}
<div class="min-h-screen bg-slate-100 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Tombol Kembali di Pojok Kiri Atas --}}
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 text-slate-700 hover:text-indigo-700 rounded-xl text-xs font-semibold border border-slate-200 shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        {{-- ============================================================
            FLASH MESSAGE (Pesan Sukses)
        ============================================================ --}}
        @if (session('success'))
            <div id="flash-message"
                class="flex items-start gap-4 bg-green-50 border border-green-200 text-green-800 rounded-2xl p-5 mb-8 shadow-sm">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="font-semibold text-sm">Pengajuan Berhasil Dikirim!</div>
                    <div class="text-sm mt-0.5 text-green-700">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        {{-- ============================================================
            CARD UTAMA FORM PEMBARUAN
        ============================================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- Header Card: Warna indigo/purple untuk membedakan dari form penerbitan --}}
            <div class="bg-gradient-to-r from-indigo-700 to-indigo-800 px-8 py-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white" data-i18n="form_pembaruan_head">Formulir Pembaruan & Perpanjangan Sertifikat</h1>
                        <p class="text-indigo-200 text-sm mt-0.5" data-i18n="form_pembaruan_sub">Layanan Perpanjangan Masa Berlaku Sertifikat Elektronik</p>
                    </div>
                </div>
            </div>

            {{-- Informasi panduan --}}
            <div class="bg-indigo-50 border-b border-indigo-100 px-8 py-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-indigo-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-indigo-700 text-sm leading-relaxed">
                        Formulir ini diperuntukkan bagi pemegang Sertifikat Elektronik yang mengajukan perpanjangan masa berlaku atau pembaruan data.
                        Mohon melengkapi data identitas diri serta melampirkan berkas persyaratan secara lengkap.
                        Tanda <span class="text-red-500 font-semibold">*</span> menunjukkan kolom yang wajib diisi.
                    </p>
                </div>
            </div>

            {{-- ============================================================
                FORM PEMBARUAN
            ============================================================ --}}
            <form action="{{ route('pembaruan.store') }}" method="POST" enctype="multipart/form-data"
                id="form-pembaruan" class="p-8" novalidate>

                {{-- CSRF Token --}}
                @csrf

                <div class="space-y-6">

                    {{-- ===== BARIS 1: Nama Lengkap & NIK (2 kolom) ===== --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Field: Nama Lengkap --}}
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-semibold text-slate-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                value="{{ old('nama_lengkap') }}"
                                placeholder="Masukkan nama lengkap pemegang sertifikat"
                                autocomplete="name"
                                class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                    {{ $errors->has('nama_lengkap') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}"
                            >
                            @error('nama_lengkap')
                                <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Field: NIK --}}
                        <div>
                            <label for="nik" class="block text-sm font-semibold text-slate-700 mb-2">
                                NIK <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="nik"
                                name="nik"
                                value="{{ old('nik') }}"
                                placeholder="16 digit NIK (KTP)"
                                maxlength="16"
                                autocomplete="off"
                                class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 font-mono tracking-wider
                                    {{ $errors->has('nik') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}"
                            >
                            @error('nik')
                                <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- ===== BARIS 2: Email & Nomor Telepon (2 kolom) ===== --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Field: Alamat Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                                Alamat Email <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="contoh@email.com"
                                autocomplete="email"
                                class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                    {{ $errors->has('email') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}"
                            >
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Field: Nomor Telepon --}}
                        <div>
                            <label for="no_telepon" class="block text-sm font-semibold text-slate-700 mb-2">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="no_telepon"
                                name="no_telepon"
                                value="{{ old('no_telepon') }}"
                                placeholder="081234567890"
                                autocomplete="tel"
                                class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 font-mono tracking-wider
                                    {{ $errors->has('no_telepon') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}"
                            >
                            @error('no_telepon')
                                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- ===== BARIS 3: NIP & Unit Kerja (2 kolom) ===== --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Field: NIP --}}
                        <div>
                            <label for="nip" class="block text-sm font-semibold text-slate-700 mb-2">
                                NIP <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="nip"
                                name="nip"
                                value="{{ old('nip') }}"
                                placeholder="18 digit NIP"
                                maxlength="18"
                                autocomplete="off"
                                class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 font-mono tracking-wider
                                    {{ $errors->has('nip') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}"
                            >
                            @error('nip')
                                <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Field: Unit Kerja --}}
                        <div>
                            <label for="instansi" class="block text-sm font-semibold text-slate-700 mb-2">
                                Unit Kerja <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="instansi"
                                name="instansi"
                                value="{{ old('instansi') }}"
                                placeholder="Nama Unit Kerja"
                                autocomplete="organization"
                                class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                    {{ $errors->has('instansi') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}"
                            >
                            @error('instansi')
                                <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- ===== BARIS 4: Jabatan (full width) ===== --}}
                    <div>
                        <label for="jabatan" class="block text-sm font-semibold text-slate-700 mb-2">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="jabatan"
                            name="jabatan"
                            value="{{ old('jabatan') }}"
                            placeholder="Kepala Dinas Pertanian"
                            autocomplete="organization-title"
                            class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                {{ $errors->has('jabatan') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}"
                        >
                        @error('jabatan')
                            <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- ===== BARIS 4: Alasan Pengajuan Pembaruan (full width) ===== --}}
                    <div>
                        <label for="alasan" class="block text-sm font-semibold text-slate-700 mb-2">
                            Alasan Pengajuan Pembaruan <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="alasan"
                            name="alasan"
                            rows="4"
                            placeholder="Jelaskan alasan Anda mengajukan pembaruan/perpanjangan sertifikat ini secara singkat dan jelas"
                            class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 resize-none leading-relaxed
                                {{ $errors->has('alasan') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}"
                        >{{ old('alasan') }}</textarea>
                        {{-- Counter karakter --}}
                        <div class="flex justify-between items-center mt-1">
                            @error('alasan')
                                <p class="text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @else
                                <span></span>
                            @enderror
                            <span id="char-count-alasan" class="text-xs text-slate-400 ml-auto">0 / 2000</span>
                        </div>
                    </div>

                    {{-- ===== FIELD 3: Upload Dokumen Pendukung (3 File Wajib) ===== --}}
                    <div class="space-y-4 pt-2">
                        <div class="border-b border-slate-200 pb-2">
                            <h3 class="text-sm font-bold text-slate-800">Unggah Dokumen Pendukung <span class="text-red-500">*</span></h3>
                            <p class="text-xs text-slate-500 mt-0.5">Semua 3 dokumen di bawah ini wajib diunggah sebelum dapat mengirim permohonan pembaruan.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            {{-- 1. Surat Permohonan --}}
                            <div>
                                <label for="surat_permohonan" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    1. Surat Permohonan <span class="text-red-500">*</span>
                                </label>
                                <div id="upload-zone-permohonan"
                                    class="relative border-2 border-dashed rounded-xl p-4 text-center cursor-pointer transition-all duration-300
                                    {{ $errors->has('surat_permohonan') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-slate-50 hover:border-indigo-400 hover:bg-indigo-50' }}"
                                    onclick="document.getElementById('surat_permohonan').click()">
                                    <div class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-2 shadow-xs">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div id="upload-text-permohonan">
                                        <p class="text-xs font-semibold text-slate-700">Surat Permohonan</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Format: PDF &bull; Maks 10MB</p>
                                    </div>
                                    <input type="file" id="surat_permohonan" name="surat_permohonan" accept=".pdf" class="hidden" required>
                                </div>
                                @error('surat_permohonan')
                                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- 2. Surat Rekomendasi Unit Kerja --}}
                            <div>
                                <label for="surat_rekomendasi" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    2. Rekomendasi Unit Kerja <span class="text-red-500">*</span>
                                </label>
                                <div id="upload-zone-rekomendasi"
                                    class="relative border-2 border-dashed rounded-xl p-4 text-center cursor-pointer transition-all duration-300
                                    {{ $errors->has('surat_rekomendasi') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-slate-50 hover:border-indigo-400 hover:bg-indigo-50' }}"
                                    onclick="document.getElementById('surat_rekomendasi').click()">
                                    <div class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-2 shadow-xs">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div id="upload-text-rekomendasi">
                                        <p class="text-xs font-semibold text-slate-700">Rekomendasi Unit Kerja</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Format: PDF &bull; Maks 10MB</p>
                                    </div>
                                    <input type="file" id="surat_rekomendasi" name="surat_rekomendasi" accept=".pdf" class="hidden" required>
                                </div>
                                @error('surat_rekomendasi')
                                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- 3. Foto KTP --}}
                            <div>
                                <label for="foto_ktp" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    3. Foto KTP <span class="text-red-500">*</span>
                                </label>
                                <div id="upload-zone-ktp"
                                    class="relative border-2 border-dashed rounded-xl p-4 text-center cursor-pointer transition-all duration-300
                                    {{ $errors->has('foto_ktp') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-slate-50 hover:border-indigo-400 hover:bg-indigo-50' }}"
                                    onclick="document.getElementById('foto_ktp').click()">
                                    <div class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-2 shadow-xs">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div id="upload-text-ktp">
                                        <p class="text-xs font-semibold text-slate-700">Foto KTP</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">JPG, JPEG, PNG &bull; Maks 10MB</p>
                                    </div>
                                    <input type="file" id="foto_ktp" name="foto_ktp" accept=".jpg,.jpeg,.png" class="hidden" required>
                                </div>
                                @error('foto_ktp')
                                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- ===== GARIS PEMISAH ===== --}}
                    <div class="border-t border-slate-100 my-2"></div>

                    {{-- ===== PERNYATAAN PERSETUJUAN ===== --}}
                    <div>
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="persetujuan" name="persetujuan" required
                                class="mt-0.5 w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500 cursor-pointer transition-colors duration-200 {{ $errors->has('persetujuan') ? 'border-red-500 ring-1 ring-red-500' : 'border-slate-300' }}">
                            <label for="persetujuan" class="text-sm text-slate-600 leading-relaxed cursor-pointer">
                                Saya menyatakan bahwa data yang saya masukkan adalah
                                <strong class="text-slate-800">benar dan sertifikat ini adalah milik saya</strong>.
                                Saya menyetujui <a href="{{ route('informasi') }}" class="text-indigo-600 hover:underline">syarat dan ketentuan</a> yang berlaku.
                            </label>
                        </div>
                        @error('persetujuan')
                            <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- ===== TOMBOL SUBMIT ===== --}}
                    <div class="pt-2">
                        <button type="submit" id="btn-submit-pembaruan"
                            class="w-full flex items-center justify-center gap-3 px-8 py-4 bg-indigo-700 hover:bg-indigo-800 active:bg-indigo-900 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-indigo-300/50 hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <svg id="icon-submit-pembaruan" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <svg id="icon-loading-pembaruan" class="w-5 h-5 hidden animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span id="text-submit-pembaruan">Kirim Pengajuan Pembaruan</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>

        {{-- ============================================================
            LINK KE FORM PENERBITAN (Cross-promotion)
        ============================================================ --}}
        <div class="mt-6 bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 text-sm text-slate-700">
                Belum punya sertifikat sebelumnya? 
                <a href="{{ route('penerbitan') }}" class="font-semibold text-blue-600 hover:text-blue-700 hover:underline ml-1">
                    Ajukan Penerbitan Sertifikat Baru &rarr;
                </a>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    // ------------------------------------------------------------------
    // KARAKTER COUNTER untuk textarea Alasan Pengajuan
    // ------------------------------------------------------------------
    const textareaAlasan = document.getElementById('alasan');
    const charCountAlasan = document.getElementById('char-count-alasan');

    if (textareaAlasan && charCountAlasan) {
        charCountAlasan.textContent = `${textareaAlasan.value.length} / 2000`;
        textareaAlasan.addEventListener('input', () => {
            const len = textareaAlasan.value.length;
            charCountAlasan.textContent = `${len} / 2000`;
            charCountAlasan.className = len > 1800
                ? 'text-xs text-amber-500 ml-auto font-semibold'
                : 'text-xs text-slate-400 ml-auto';
        });
    }

    // ------------------------------------------------------------------
    // FILE UPLOAD PREVIEW untuk 3 dokumen
    // ------------------------------------------------------------------
    function setupFileUpload(inputId, zoneId, textId) {
        const input = document.getElementById(inputId);
        const zone = document.getElementById(zoneId);
        const text = document.getElementById(textId);
        if (!input || !zone || !text) return;

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const size = file.size > 1024 * 1024
                    ? `${(file.size / 1024 / 1024).toFixed(2)} MB`
                    : `${(file.size / 1024).toFixed(1)} KB`;

                zone.classList.remove('border-slate-300', 'bg-slate-50', 'hover:border-indigo-400', 'hover:bg-indigo-50');
                zone.classList.add('border-green-400', 'bg-green-50');
                text.innerHTML = `
                    <p class="text-xs font-bold text-green-700">✓ File Dipilih</p>
                    <p class="text-[11px] text-green-600 truncate max-w-[150px] mx-auto mt-0.5" title="${file.name}">${file.name}</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">${size}</p>
                `;
            }
        });

        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            zone.classList.add('border-indigo-400', 'bg-indigo-50');
        });

        zone.addEventListener('dragleave', () => {
            if (!input.files.length) {
                zone.classList.remove('border-indigo-400', 'bg-indigo-50');
            }
        });

        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            if (e.dataTransfer.files.length) {
                input.files = e.dataTransfer.files;
                input.dispatchEvent(new Event('change'));
            }
        });
    }

    setupFileUpload('surat_permohonan', 'upload-zone-permohonan', 'upload-text-permohonan');
    setupFileUpload('surat_rekomendasi', 'upload-zone-rekomendasi', 'upload-text-rekomendasi');
    setupFileUpload('foto_ktp', 'upload-zone-ktp', 'upload-text-ktp');

    // ------------------------------------------------------------------
    // LOADING STATE pada Tombol Submit
    // ------------------------------------------------------------------
    const formPembaruan = document.getElementById('form-pembaruan');
    const btnSubmitPembaruan = document.getElementById('btn-submit-pembaruan');
    const iconSubmitPembaruan = document.getElementById('icon-submit-pembaruan');
    const iconLoadingPembaruan = document.getElementById('icon-loading-pembaruan');
    const textSubmitPembaruan = document.getElementById('text-submit-pembaruan');

    if (formPembaruan && btnSubmitPembaruan) {
        formPembaruan.addEventListener('submit', () => {
            setTimeout(() => {
                if (formPembaruan.checkValidity()) {
                    btnSubmitPembaruan.disabled = true;
                    btnSubmitPembaruan.classList.add('opacity-75', 'cursor-not-allowed');
                    iconSubmitPembaruan.classList.add('hidden');
                    iconLoadingPembaruan.classList.remove('hidden');
                    textSubmitPembaruan.textContent = 'Mengirim...';
                }
            }, 10);
        });
    }
</script>
@endpush
