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
                        <h1 class="text-xl font-bold text-white">Form Pembaruan Sertifikat</h1>
                        <p class="text-indigo-200 text-sm mt-0.5">Perpanjangan / Pembaruan Sertifikat Elektronik</p>
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
                        Formulir ini digunakan untuk <strong>memperbarui</strong> sertifikat yang sudah ada atau yang akan habis masa berlakunya.
                        Siapkan <strong>surat rekomendasi permohonan pembaruan sertifikat elektronik</strong> sebelum mengisi formulir ini.
                        Tanda <span class="text-red-500 font-semibold">*</span> menandakan field yang wajib diisi.
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

                    {{-- ===== BARIS 3: Instansi (full width) ===== --}}
                    <div>
                        <label for="instansi" class="block text-sm font-semibold text-slate-700 mb-2">
                            Instansi <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="instansi"
                            name="instansi"
                            value="{{ old('instansi') }}"
                            placeholder="Nama Instansi"
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

                    {{-- ===== FIELD 3: Upload Surat Rekomendasi ===== --}}
                    <div>
                        <label for="bukti_sertifikat" class="block text-sm font-semibold text-slate-700 mb-2">
                            Surat Rekomendasi Permohonan Pembaruan Sertifikat Elektronik <span class="text-red-500">*</span>
                        </label>

                        {{-- Area Drop Zone --}}
                        <div id="upload-zone-pembaruan"
                            class="relative border-2 border-dashed rounded-xl p-8 text-center cursor-pointer transition-all duration-300
                            {{ $errors->has('bukti_sertifikat') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-slate-50 hover:border-indigo-400 hover:bg-indigo-50' }}"
                            onclick="document.getElementById('bukti_sertifikat').click()">

                            {{-- Ikon Upload --}}
                            <div class="w-14 h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                                <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>

                            <div id="upload-text-pembaruan">
                                <p class="text-sm font-semibold text-slate-600">Unggah Surat Rekomendasi</p>
                                <p class="text-xs text-slate-400 mt-1">Klik untuk memilih atau seret file ke sini</p>
                                <p class="text-xs text-slate-400 mt-2">Format: PDF &bull; Maks: 10MB</p>
                            </div>

                            {{-- Input file tersembunyi --}}
                            <input
                                type="file"
                                id="bukti_sertifikat"
                                name="bukti_sertifikat"
                                accept=".pdf"
                                class="hidden"
                            >
                        </div>

                        @error('bukti_sertifikat')
                            <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
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

        {{-- Helpdesk info --}}
        <div class="mt-4 text-center">
            <p class="text-sm text-slate-500">
                Butuh bantuan? Hubungi kami melalui
                <a href="https://wa.me/6282312293928?text=Halo%2C%20saya%20butuh%20bantuan%20terkait%20form%20pembaruan%20sertifikat."
                    target="_blank" rel="noopener noreferrer"
                    class="text-green-600 font-semibold hover:text-green-700 hover:underline">
                    WhatsApp Admin
                </a>
            </p>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    // ------------------------------------------------------------------
    // FILE UPLOAD PREVIEW untuk Surat Rekomendasi
    // ------------------------------------------------------------------
    const inputBukti = document.getElementById('bukti_sertifikat');
    const uploadTextPembaruan = document.getElementById('upload-text-pembaruan');
    const uploadZonePembaruan = document.getElementById('upload-zone-pembaruan');

    if (inputBukti) {
        inputBukti.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const size = file.size > 1024 * 1024
                    ? `${(file.size / 1024 / 1024).toFixed(2)} MB`
                    : `${(file.size / 1024).toFixed(1)} KB`;

                uploadZonePembaruan.classList.remove('border-slate-300', 'bg-slate-50', 'hover:border-indigo-400', 'hover:bg-indigo-50');
                uploadZonePembaruan.classList.add('border-green-400', 'bg-green-50');
                uploadTextPembaruan.innerHTML = `
                    <p class="text-sm font-semibold text-green-700">✓ File dipilih</p>
                    <p class="text-xs text-green-600 mt-1">${file.name}</p>
                    <p class="text-xs text-slate-400 mt-1">${size}</p>
                    <p class="text-xs text-indigo-500 mt-2 hover:underline cursor-pointer">Klik untuk mengganti file</p>
                `;
            }
        });

        // Drag & Drop
        uploadZonePembaruan.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZonePembaruan.classList.add('border-indigo-400', 'bg-indigo-50');
        });

        uploadZonePembaruan.addEventListener('dragleave', () => {
            if (!inputBukti.files.length) {
                uploadZonePembaruan.classList.remove('border-indigo-400', 'bg-indigo-50');
            }
        });

        uploadZonePembaruan.addEventListener('drop', (e) => {
            e.preventDefault();
            inputBukti.files = e.dataTransfer.files;
            inputBukti.dispatchEvent(new Event('change'));
        });
    }

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
