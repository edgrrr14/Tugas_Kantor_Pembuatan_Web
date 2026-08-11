@extends('layouts.app')

@section('title', 'Dashboard Utama Admin')

@push('styles')
<style>
    /* Styling khusus cetak (PDF) */
    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        /* Sembunyikan sidebar, tombol-tombol filter, header, dan elemen navigasi */
        aside, #main-sidebar, nav, button, #btn-export-excel, #btn-export-pdf, #search-filter-container, #floating-logout, .z-40, footer, .no-print {
            display: none !important;
        }
        /* Lebarkan konten utama */
        main, #main-content-area {
            margin-left: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        .tab-panel-content {
            display: block !important;
        }
        /* Tampilkan judul laporan khusus cetak */
        #print-report-header {
            display: block !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-slate-100 flex flex-col md:flex-row">

    {{-- ================================================================
        SIDEBAR NAVIGASI ADMIN (Kiri)
    ================================================================ --}}
    <aside id="main-sidebar" class="w-full md:w-64 bg-slate-900 text-slate-300 flex flex-col shrink-0 border-r border-slate-800 no-print">
        
        {{-- Header Sidebar: Logo --}}
        <div class="px-6 py-6 border-b border-slate-800 bg-slate-950 flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <div>
                <h1 class="font-bold text-white text-sm leading-tight">Admin Portal</h1>
                <span class="text-xs text-indigo-400 font-medium">Sertifikasi Elektronik</span>
            </div>
        </div>

        {{-- Profil Singkat --}}
        <div class="px-6 py-5 border-b border-slate-800/60 bg-slate-900/50 flex flex-col gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-slate-700 rounded-full flex items-center justify-center font-bold text-white border border-slate-600 shrink-0">
                    AD
                </div>
                <div class="overflow-hidden">
                    <span class="block text-sm font-semibold text-slate-200 truncate">Administrator</span>
                    <span class="block text-xs text-slate-500 truncate">admin@sertifikasiel.go.id</span>
                </div>
            </div>
            <button type="button" onclick="openGantiPasswordModal()" 
                class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-slate-800 hover:bg-slate-700 text-indigo-300 hover:text-white rounded-xl text-xs font-bold transition-all duration-200 border border-slate-700/80 cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 0121 9z" />
                </svg>
                <span>Ganti Password Admin</span>
            </button>
        </div>

        {{-- Navigasi Menu/Tab --}}
        <nav class="flex-1 px-4 py-6 space-y-1">
            <button onclick="switchTab('penerbitan')" id="tab-btn-penerbitan"
                class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-left transition-all duration-200 cursor-pointer hover:bg-slate-800 hover:text-white bg-slate-800 text-white">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>1. Dashboard Penerbitan</span>
            </button>

            <button onclick="switchTab('pembaruan')" id="tab-btn-pembaruan"
                class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-left transition-all duration-200 cursor-pointer hover:bg-slate-800 hover:text-white text-slate-400">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>2. Dashboard Pembaruan</span>
            </button>

            <button onclick="switchTab('helpdesk')" id="tab-btn-helpdesk"
                class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-left transition-all duration-200 cursor-pointer hover:bg-slate-800 hover:text-white text-slate-400">
                <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <div class="flex items-center justify-between flex-1">
                    <span>3. Pertanyaan Helpdesk</span>
                    @if(($stats['helpdeskBaru'] ?? 0) > 0)
                        <span class="px-2 py-0.5 bg-emerald-500 text-white font-bold text-[10px] rounded-full animate-pulse">{{ $stats['helpdeskBaru'] }} Baru</span>
                    @endif
                </div>
            </button>

            <button onclick="switchTab('statistik')" id="tab-btn-statistik"
                class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-left transition-all duration-200 cursor-pointer hover:bg-slate-800 hover:text-white text-slate-400">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span>4. Infografis & Statistik</span>
            </button>

            <button onclick="switchTab('dokumen_syarat')" id="tab-btn-dokumen_syarat"
                class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-left transition-all duration-200 cursor-pointer hover:bg-slate-800 hover:text-white text-slate-400">
                <svg class="w-5 h-5 shrink-0 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>5. Kelola Dokumen Syarat</span>
            </button>
        </nav>
    </aside>

    {{-- ================================================================
        KONTEN UTAMA DASHBOARD (Kanan)
    ================================================================ --}}
    <main id="main-content-area" class="flex-1 p-6 md:p-8 overflow-x-hidden">

        {{-- Header khusus cetak laporan PDF --}}
        <div id="print-report-header" class="hidden mb-8 border-b-2 border-black pb-4 text-center">
            <h1 class="text-2xl font-bold uppercase tracking-wider">Laporan Pengajuan Sertifikasi Elektronik</h1>
            <p class="text-sm text-slate-600 mt-1">Dicetak pada tanggal: {{ date('d F Y H:i:s') }}</p>
        </div>

        {{-- Header Dashboard (Aktif hanya di browser) --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 no-print">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800" id="current-title-section">Dashboard Penerbitan</h2>
                <p class="text-slate-500 text-sm mt-1">Kelola permohonan sertifikat elektronik masuk secara real-time.</p>
            </div>
        </div>

        {{-- Tombol Logout Admin Melayang di Pojok Kanan Atas (Floating) --}}
        <div id="floating-logout" class="fixed top-4 right-4 sm:top-6 sm:right-6 z-40 no-print">
            <button type="button" onclick="openLogoutModal()" 
                class="group flex items-center gap-2 px-3.5 py-2 sm:px-4 sm:py-2.5 bg-white/95 hover:bg-rose-50 border border-slate-200 hover:border-rose-300 text-rose-600 font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer backdrop-blur-md">
                <div class="w-7 h-7 bg-rose-100 group-hover:bg-rose-600 group-hover:text-white text-rose-600 rounded-xl flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <span class="text-xs tracking-wide">Logout Sesi Admin</span>
            </button>
        </div>

        {{-- ============================================================
            TAB PANEL 1: DASHBOARD PENERBITAN (ACTIVE BY DEFAULT)
        ============================================================ --}}
        <div id="panel-penerbitan" class="tab-panel space-y-6">
            
            {{-- Filter & Ekspor Bar --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-4 no-print" id="search-filter-container">
                <div class="flex flex-wrap items-center gap-3 flex-1">
                    {{-- Pencarian Nama --}}
                    <div class="relative min-w-[200px] flex-1 sm:flex-none">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" id="penerbitan-search-input" onkeyup="filterPenerbitanTable()"
                            placeholder="Cari nama..."
                            class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-slate-300 transition-all duration-200">
                    </div>

                    {{-- Filter Waktu (Range Tanggal) --}}
                    <div class="flex items-center gap-2">
                        <input type="date" id="penerbitan-start-date" onchange="filterPenerbitanTable()"
                            class="px-3 py-2.5 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-slate-300 transition-all duration-200 text-slate-600 bg-white">
                        <span class="text-slate-400 text-xs font-semibold">s/d</span>
                        <input type="date" id="penerbitan-end-date" onchange="filterPenerbitanTable()"
                            class="px-3 py-2.5 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-slate-300 transition-all duration-200 text-slate-600 bg-white">
                    </div>

                    {{-- Reset --}}
                    <button onclick="resetFilters()" 
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs rounded-xl transition-all duration-200 shrink-0 cursor-pointer focus:outline-none">
                        Reset
                    </button>
                </div>
                
                <div class="flex items-center gap-2.5 shrink-0">
                    <a href="{{ route('admin.export.penerbitan.csv') }}" id="btn-export-excel"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Ekspor Excel (CSV)</span>
                    </a>
                    
                    <button onclick="window.print()" id="btn-export-pdf"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        <span>Cetak Laporan / PDF</span>
                    </button>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-3 no-print">
                    <h3 class="font-bold text-slate-800 text-base">Semua Laporan Masuk (Penerbitan)</h3>
                    
                    {{-- Filter Status & Urutkan --}}
                    <div class="flex flex-wrap items-center gap-3">
                        {{-- Dropdown Filter Status --}}
                        <div class="flex items-center gap-2">
                            <label for="penerbitan-status-filter" class="text-xs font-semibold text-slate-500">Status:</label>
                            <select id="penerbitan-status-filter" onchange="filterPenerbitanTable()"
                                class="px-3 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 cursor-pointer">
                                <option value="all">Semua Status</option>
                                <option value="Pending">● Pending</option>
                                <option value="Disetujui">✓ Disetujui</option>
                                <option value="Ditolak">✕ Ditolak</option>
                            </select>
                        </div>

                        {{-- Dropdown Sorting --}}
                        <div class="flex items-center gap-2">
                            <label for="penerbitan-sort-select" class="text-xs font-semibold text-slate-500">Urutkan:</label>
                            <select id="penerbitan-sort-select" onchange="sortPenerbitanTable()"
                                class="px-3 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 cursor-pointer">
                                <option value="terbaru">Terbaru (Waktu)</option>
                                <option value="abjad">Nama (Abjad A-Z)</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse" id="table-penerbitan">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                                <th class="p-4 w-12 text-center">No</th>
                                <th class="p-4">Pemohon</th>
                                <th class="p-4">NIK</th>
                                <th class="p-4">NIP</th>
                                <th class="p-4">Kontak & Unit Kerja</th>
                                <th class="p-4">Jabatan</th>
                                <th class="p-4">Alasan Pengajuan</th>
                                <th class="p-4">Waktu Pengajuan</th>
                                <th class="p-4 text-center">Dokumen Pendukung</th>
                                <th class="p-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($penerbitanData as $index => $item)
                            <tr class="hover:bg-slate-50/50 transition-colors row-penerbitan" data-date="{{ date('Y-m-d', strtotime($item['created_at'])) }}" data-timestamp="{{ strtotime($item['created_at']) }}" data-status="{{ $item['status'] }}">
                                <td class="p-4 text-center text-slate-400 font-mono">{{ $index + 1 }}</td>
                                <td class="p-4 font-bold text-slate-900 nama-pemohon">{{ $item['nama_lengkap'] }}</td>
                                <td class="p-4 font-mono text-slate-600 text-xs">{{ $item['nik'] }}</td>
                                <td class="p-4 font-mono text-slate-600 text-xs">{{ $item['nip'] }}</td>
                                <td class="p-4 text-xs space-y-1">
                                    <div class="font-semibold text-slate-900">{{ $item['email'] }}</div>
                                    <div class="text-slate-400 font-mono text-[11px]">{{ $item['no_telepon'] ?? '-' }}</div>
                                    <div class="text-slate-400 font-medium">{{ $item['instansi'] }}</div>
                                </td>
                                <td class="p-4 text-xs font-semibold text-slate-600">{{ $item['jabatan'] }}</td>
                                <td class="p-4 text-xs max-w-[210px]">
                                    @if(!empty($item['alasan']))
                                        <button type="button" 
                                            onclick="openDetailAlasanModal({{ json_encode($item['nama_lengkap']) }}, 'Penerbitan Sertifikat', {{ json_encode($item['alasan']) }})"
                                            class="group w-full text-left p-2.5 bg-slate-50 hover:bg-indigo-50/80 border border-slate-200/90 hover:border-indigo-300 rounded-xl transition-all duration-200 cursor-pointer shadow-2xs hover:shadow-xs">
                                            <p class="text-slate-700 text-[11px] leading-relaxed line-clamp-2 font-normal">
                                                {{ $item['alasan'] }}
                                            </p>
                                            <span class="inline-flex items-center gap-1 text-[10px] font-bold text-indigo-600 group-hover:text-indigo-700 mt-1">
                                                <span>Klik untuk detail lengkap</span>
                                                <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </span>
                                        </button>
                                    @else
                                        <span class="text-slate-400 font-medium text-xs">-</span>
                                    @endif
                                </td>
                                <td class="p-4 text-xs text-slate-400 font-mono">{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="p-4">
                                    <div class="flex flex-wrap gap-1.5 justify-center">
                                        @if(!empty($item['surat_permohonan']))
                                            <a href="{{ asset('storage/' . $item['surat_permohonan']) }}" target="_blank"
                                                title="Surat Permohonan"
                                                class="inline-flex items-center gap-1 text-[11px] text-blue-700 font-semibold bg-blue-50 hover:bg-blue-100 border border-blue-200 px-2 py-1 rounded-md transition-colors">
                                                <svg class="w-3 h-3 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <span>Permohonan</span>
                                            </a>
                                        @endif

                                        @if(!empty($item['surat_rekomendasi']))
                                            <a href="{{ asset('storage/' . $item['surat_rekomendasi']) }}" target="_blank"
                                                title="Surat Rekomendasi Unit Kerja"
                                                class="inline-flex items-center gap-1 text-[11px] text-purple-700 font-semibold bg-purple-50 hover:bg-purple-100 border border-purple-200 px-2 py-1 rounded-md transition-colors">
                                                <svg class="w-3 h-3 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span>Rekomendasi</span>
                                            </a>
                                        @endif

                                        @if(!empty($item['foto_ktp']))
                                            <a href="{{ asset('storage/' . $item['foto_ktp']) }}" target="_blank"
                                                title="Foto KTP"
                                                class="inline-flex items-center gap-1 text-[11px] text-emerald-700 font-semibold bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-2 py-1 rounded-md transition-colors">
                                                <svg class="w-3 h-3 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>Foto KTP</span>
                                            </a>
                                        @endif

                                        @if(empty($item['surat_permohonan']) && empty($item['surat_rekomendasi']) && empty($item['foto_ktp']) && !empty($item['dokumen']))
                                            <a href="{{ asset('storage/' . $item['dokumen']) }}" target="_blank"
                                                class="inline-flex items-center gap-1 text-[11px] text-slate-700 font-semibold bg-slate-100 hover:bg-slate-200 px-2 py-1 rounded-md transition-colors">
                                                <span>Dokumen Legacy</span>
                                            </a>
                                        @endif

                                        @if(empty($item['surat_permohonan']) && empty($item['surat_rekomendasi']) && empty($item['foto_ktp']) && empty($item['dokumen']))
                                            <span class="text-xs text-slate-400 font-medium">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.penerbitan.status', $item['id']) }}" method="POST" class="inline-block">
                                        @csrf
                                        <div class="relative inline-flex items-center">
                                            <select name="status" onchange="this.form.submit()"
                                                class="appearance-none pl-3.5 pr-7 py-1.5 rounded-full text-xs font-bold border focus:outline-none focus:ring-2 cursor-pointer transition-all duration-200 shadow-xs
                                                    {{ $item['status'] === 'Disetujui' ? 'bg-green-100 text-green-700 border-green-300 focus:ring-green-400' : '' }}
                                                    {{ $item['status'] === 'Ditolak' ? 'bg-rose-100 text-rose-700 border-rose-300 focus:ring-rose-400' : '' }}
                                                    {{ $item['status'] === 'Pending' ? 'bg-amber-100 text-amber-700 border-amber-300 focus:ring-amber-400' : '' }}">
                                                <option value="Pending" {{ $item['status'] === 'Pending' ? 'selected' : '' }}>● Pending</option>
                                                <option value="Disetujui" {{ $item['status'] === 'Disetujui' ? 'selected' : '' }}>✓ Disetujui</option>
                                                <option value="Ditolak" {{ $item['status'] === 'Ditolak' ? 'selected' : '' }}>✕ Ditolak</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5">
                                                <svg class="w-3 h-3 {{ $item['status'] === 'Disetujui' ? 'text-green-700' : ($item['status'] === 'Ditolak' ? 'text-rose-700' : 'text-amber-700') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="p-8 text-center text-slate-400">Tidak ada data laporan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ============================================================
            TAB PANEL 2: DASHBOARD PEMBARUAN
        ============================================================ --}}
        <div id="panel-pembaruan" class="tab-panel space-y-6 hidden">
            
            {{-- Filter Bar Tab Pembaruan --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-4 no-print">
                <div class="flex flex-wrap items-center gap-3 flex-1">
                    {{-- Pencarian Nama --}}
                    <div class="relative min-w-[200px] flex-1 sm:flex-none">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" id="pembaruan-search-input" onkeyup="filterPembaruanTable()"
                            placeholder="Cari nama..."
                            class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-slate-300 transition-all duration-200">
                    </div>

                    {{-- Filter Waktu (Range Tanggal) --}}
                    <div class="flex items-center gap-2">
                        <input type="date" id="pembaruan-start-date" onchange="filterPembaruanTable()"
                            class="px-3 py-2.5 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-slate-300 transition-all duration-200 text-slate-600 bg-white">
                        <span class="text-slate-400 text-xs font-semibold">s/d</span>
                        <input type="date" id="pembaruan-end-date" onchange="filterPembaruanTable()"
                            class="px-3 py-2.5 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-slate-300 transition-all duration-200 text-slate-600 bg-white">
                    </div>

                    {{-- Reset --}}
                    <button onclick="resetPembaruanFilters()" 
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs rounded-xl transition-all duration-200 shrink-0 cursor-pointer focus:outline-none">
                        Reset
                    </button>
                </div>

                <div class="flex items-center gap-2.5 shrink-0">
                    <a href="{{ route('admin.export.pembaruan.csv') }}" id="btn-export-pembaruan-excel"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Ekspor Excel (CSV)</span>
                    </a>
                    
                    <button onclick="window.print()" id="btn-export-pembaruan-pdf"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        <span>Cetak Laporan / PDF</span>
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-3 no-print">
                    <div>
                        <h3 class="font-bold text-slate-800 text-base">Data Form Pembaruan User</h3>
                        <p class="text-xs text-slate-500 mt-1">Verifikasi kelengkapan dokumen surat rekomendasi untuk permohonan perpanjangan sertifikat.</p>
                    </div>

                    {{-- Controls (Filter Status & Urutkan) --}}
                    <div class="flex flex-wrap items-center gap-3">
                        {{-- Dropdown Filter Status --}}
                        <div class="flex items-center gap-2">
                            <label for="pembaruan-status-filter" class="text-xs font-semibold text-slate-500">Status:</label>
                            <select id="pembaruan-status-filter" onchange="filterPembaruanTable()"
                                class="px-3 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 cursor-pointer">
                                <option value="all">Semua Status</option>
                                <option value="Pending">● Pending</option>
                                <option value="Disetujui">✓ Disetujui</option>
                                <option value="Ditolak">✕ Ditolak</option>
                            </select>
                        </div>

                        {{-- Dropdown Sorting --}}
                        <div class="flex items-center gap-2">
                            <label for="pembaruan-sort-select" class="text-xs font-semibold text-slate-500">Urutkan:</label>
                            <select id="pembaruan-sort-select" onchange="sortPembaruanTable()"
                                class="px-3 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 cursor-pointer">
                                <option value="terbaru">Terbaru (Waktu)</option>
                                <option value="abjad">Nama (Abjad A-Z)</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse" id="table-pembaruan">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                                <th class="p-4 w-12 text-center">No</th>
                                <th class="p-4">Pemohon</th>
                                <th class="p-4">NIK</th>
                                <th class="p-4">NIP</th>
                                <th class="p-4">Kontak & Unit Kerja</th>
                                <th class="p-4">Jabatan</th>
                                <th class="p-4">Alasan Pengajuan</th>
                                <th class="p-4">Waktu Pengajuan</th>
                                <th class="p-4 text-center">Dokumen Pendukung</th>
                                <th class="p-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($pembaruanData as $index => $item)
                            <tr class="hover:bg-slate-50/50 transition-colors row-pembaruan" data-date="{{ date('Y-m-d', strtotime($item['created_at'])) }}" data-timestamp="{{ strtotime($item['created_at']) }}" data-status="{{ $item['status'] }}">
                                <td class="p-4 text-center text-slate-400 font-mono">{{ $index + 1 }}</td>
                                <td class="p-4 font-bold text-slate-900 nama-pemohon">{{ $item['nama_lengkap'] }}</td>
                                <td class="p-4 font-mono text-slate-600 text-xs">{{ $item['nik'] ?? '-' }}</td>
                                <td class="p-4 font-mono text-slate-600 text-xs">{{ $item['nip'] ?? '-' }}</td>
                                <td class="p-4 text-xs space-y-1">
                                    <div class="font-semibold text-slate-900">{{ $item['email'] }}</div>
                                    <div class="text-slate-400 font-mono text-[11px]">{{ $item['no_telepon'] ?? '-' }}</div>
                                    <div class="text-slate-400 font-medium">{{ $item['instansi'] ?? '-' }}</div>
                                </td>
                                <td class="p-4 text-xs font-semibold text-slate-600">{{ $item['jabatan'] ?? '-' }}</td>
                                <td class="p-4 text-xs max-w-[210px]">
                                    @if(!empty($item['alasan']))
                                        <button type="button" 
                                            onclick="openDetailAlasanModal({{ json_encode($item['nama_lengkap']) }}, 'Pembaruan Sertifikat', {{ json_encode($item['alasan']) }})"
                                            class="group w-full text-left p-2.5 bg-slate-50 hover:bg-indigo-50/80 border border-slate-200/90 hover:border-indigo-300 rounded-xl transition-all duration-200 cursor-pointer shadow-2xs hover:shadow-xs">
                                            <p class="text-slate-700 text-[11px] leading-relaxed line-clamp-2 font-normal">
                                                {{ $item['alasan'] }}
                                            </p>
                                            <span class="inline-flex items-center gap-1 text-[10px] font-bold text-indigo-600 group-hover:text-indigo-700 mt-1">
                                                <span>Klik untuk detail lengkap</span>
                                                <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </span>
                                        </button>
                                    @else
                                        <span class="text-slate-400 font-medium text-xs">-</span>
                                    @endif
                                </td>
                                <td class="p-4 text-xs text-slate-400 font-mono">{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="p-4">
                                    <div class="flex flex-wrap gap-1.5 justify-center">
                                        @if(!empty($item['surat_permohonan']))
                                            <a href="{{ asset('storage/' . $item['surat_permohonan']) }}" target="_blank"
                                                title="Surat Permohonan"
                                                class="inline-flex items-center gap-1 text-[11px] text-blue-700 font-semibold bg-blue-50 hover:bg-blue-100 border border-blue-200 px-2 py-1 rounded-md transition-colors">
                                                <svg class="w-3 h-3 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <span>Permohonan</span>
                                            </a>
                                        @endif

                                        @if(!empty($item['surat_rekomendasi']))
                                            <a href="{{ asset('storage/' . $item['surat_rekomendasi']) }}" target="_blank"
                                                title="Surat Rekomendasi Unit Kerja"
                                                class="inline-flex items-center gap-1 text-[11px] text-purple-700 font-semibold bg-purple-50 hover:bg-purple-100 border border-purple-200 px-2 py-1 rounded-md transition-colors">
                                                <svg class="w-3 h-3 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span>Rekomendasi</span>
                                            </a>
                                        @endif

                                        @if(!empty($item['foto_ktp']))
                                            <a href="{{ asset('storage/' . $item['foto_ktp']) }}" target="_blank"
                                                title="Foto KTP"
                                                class="inline-flex items-center gap-1 text-[11px] text-emerald-700 font-semibold bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-2 py-1 rounded-md transition-colors">
                                                <svg class="w-3 h-3 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>Foto KTP</span>
                                            </a>
                                        @endif

                                        @if(empty($item['surat_permohonan']) && empty($item['surat_rekomendasi']) && empty($item['foto_ktp']))
                                            <span class="text-xs text-slate-400 font-medium">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.pembaruan.status', $item['id']) }}" method="POST" class="inline-block">
                                        @csrf
                                        <div class="relative inline-flex items-center">
                                            <select name="status" onchange="this.form.submit()"
                                                class="appearance-none pl-3.5 pr-7 py-1.5 rounded-full text-xs font-bold border focus:outline-none focus:ring-2 cursor-pointer transition-all duration-200 shadow-xs
                                                    {{ $item['status'] === 'Disetujui' ? 'bg-green-100 text-green-700 border-green-300 focus:ring-green-400' : '' }}
                                                    {{ $item['status'] === 'Ditolak' ? 'bg-rose-100 text-rose-700 border-rose-300 focus:ring-rose-400' : '' }}
                                                    {{ $item['status'] === 'Pending' ? 'bg-amber-100 text-amber-700 border-amber-300 focus:ring-amber-400' : '' }}">
                                                <option value="Pending" {{ $item['status'] === 'Pending' ? 'selected' : '' }}>● Pending</option>
                                                <option value="Disetujui" {{ $item['status'] === 'Disetujui' ? 'selected' : '' }}>✓ Disetujui</option>
                                                <option value="Ditolak" {{ $item['status'] === 'Ditolak' ? 'selected' : '' }}>✕ Ditolak</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5">
                                                <svg class="w-3 h-3 {{ $item['status'] === 'Disetujui' ? 'text-green-700' : ($item['status'] === 'Ditolak' ? 'text-rose-700' : 'text-amber-700') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="p-8 text-center text-slate-400">Tidak ada data pembaruan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ============================================================
            TAB PANEL 3: DASHBOARD PERTANYAAN HELPDESK
        ============================================================ --}}
        <div id="panel-helpdesk" class="tab-panel space-y-6 hidden">
            
            {{-- Stat Header Bar Helpdesk --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 font-bold shrink-0">
                        💬
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pertanyaan Helpdesk</span>
                        <span class="block text-xl font-black text-slate-800 font-mono mt-0.5">{{ $stats['totalHelpdesk'] ?? 0 }}</span>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 font-bold shrink-0">
                        📅
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Pertanyaan Hari Ini</span>
                        <span class="block text-xl font-black text-slate-800 font-mono mt-0.5">{{ $stats['helpdeskHariIni'] ?? 0 }}</span>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 font-bold shrink-0">
                        ⚡
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Status Belum Direspons</span>
                        <span class="block text-xl font-black text-amber-600 font-mono mt-0.5">{{ $stats['helpdeskBaru'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            {{-- Table Card Helpdesk --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-3 no-print">
                    <div>
                        <h3 class="font-bold text-slate-800 text-base">Daftar Pertanyaan User (Diurutkan dari Terbaru)</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pertanyaan dan masukan user yang masuk melalui formulir Helpdesk.</p>
                    </div>

                    {{-- Search & Export Controls Helpdesk --}}
                    <div class="flex flex-wrap items-center gap-2.5">
                        <div class="relative min-w-[200px]">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input type="text" id="helpdesk-search-input" onkeyup="filterHelpdeskTable()"
                                placeholder="Cari nama, NIP, atau OPD..."
                                class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <a href="{{ route('admin.export.helpdesk.csv') }}" id="btn-export-helpdesk-excel"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Ekspor Excel (CSV)</span>
                        </a>
                        
                        <button onclick="window.print()" id="btn-export-helpdesk-pdf"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            <span>Cetak Laporan / PDF</span>
                        </button>
                    </div>
                </div>

                {{-- Table Body Helpdesk --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse" id="table-helpdesk">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase tracking-wider text-[11px]">
                                <th class="p-4 w-12 text-center">No</th>
                                <th class="p-4 w-36">Waktu Pengajuan</th>
                                <th class="p-4">Nama Pemohon</th>
                                <th class="p-4">NIP & NIK</th>
                                <th class="p-4">Unit Kerja / OPD</th>
                                <th class="p-4 min-w-[250px]">Keterangan / Pertanyaan</th>
                                <th class="p-4 w-36 text-center">Status</th>
                                <th class="p-4 w-40 text-center no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($helpdeskData as $index => $item)
                            <tr class="hover:bg-slate-50/80 transition-colors row-helpdesk">
                                <td class="p-4 text-center font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="p-4 whitespace-nowrap font-mono text-[11px] text-slate-500">
                                    {{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="p-4 font-bold text-slate-900 nama-pemohon">
                                    {{ $item->nama }}
                                </td>
                                <td class="p-4 font-mono text-[11px] text-slate-600">
                                    <div class="font-semibold text-slate-800">NIP: {{ $item->nip }}</div>
                                    <div class="text-slate-400 text-[10px]">NIK: {{ $item->nik }}</div>
                                </td>
                                <td class="p-4 text-slate-700 font-medium">
                                    {{ $item->unit_kerja }}
                                </td>
                                <td class="p-4">
                                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-slate-800 text-xs leading-relaxed max-w-md">
                                        "{{ $item->keterangan }}"
                                    </div>
                                </td>
                                <td class="p-4 text-center">
                                    @if($item->status == 'Baru')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full font-bold text-[10px]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                            Baru
                                        </span>
                                    @elseif($item->status == 'Sudah Direspons')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded-full font-bold text-[10px]">
                                            ✓ Sudah Direspons
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full font-bold text-[10px]">
                                            ✓ Selesai
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 no-print">
                                    <div class="flex flex-col gap-2 items-center">
                                        {{-- Form Update Status --}}
                                        <form action="{{ route('admin.helpdesk.status', $item->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()"
                                                class="w-full px-2 py-1.5 bg-white border border-slate-200 rounded-lg text-[11px] font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 cursor-pointer">
                                                <option value="Baru" {{ $item->status == 'Baru' ? 'selected' : '' }}>● Baru</option>
                                                <option value="Sudah Direspons" {{ $item->status == 'Sudah Direspons' ? 'selected' : '' }}>✓ Sudah Direspons</option>
                                                <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>✓ Selesai</option>
                                            </select>
                                        </form>

                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.helpdesk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data pertanyaan helpdesk ini?');" class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full px-2 py-1 bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 rounded-lg text-[10px] font-bold transition-colors cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-slate-400">Belum ada pertanyaan helpdesk yang dikirim oleh pengguna.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ============================================================
            TAB PANEL 3: INFOGRAFIS & STATISTIK
        ============================================================ --}}
        <div id="panel-statistik" class="tab-panel space-y-6 hidden">
            
            {{-- Filter Bar Infografis (Bulanan vs Tahunan) --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                
                {{-- Mode Switcher Buttons --}}
                <div class="flex flex-wrap items-center gap-2 bg-slate-100 p-1.5 rounded-xl self-start md:self-auto">
                    <button type="button" id="btn-view-keseluruhan" onclick="setInfografisMode('keseluruhan')"
                        class="px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 bg-white text-indigo-700 shadow-sm cursor-pointer">
                        🌐 Semua Waktu
                    </button>
                    <button type="button" id="btn-view-tahunan" onclick="setInfografisMode('tahunan')"
                        class="px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 text-slate-600 hover:text-slate-900 cursor-pointer">
                        📊 Tampilan Tahunan
                    </button>
                    <button type="button" id="btn-view-bulanan" onclick="setInfografisMode('bulanan')"
                        class="px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 text-slate-600 hover:text-slate-900 cursor-pointer">
                        📅 Tampilan Bulanan
                    </button>
                </div>

                {{-- Select Filters (Tahun & Bulan) --}}
                <div class="flex flex-wrap items-center gap-3">
                    
                    {{-- Select Tahun (Tersembunyi di Mode Semua Waktu) --}}
                    <div id="wrapper-filter-tahun" class="hidden items-center gap-2">
                        <label for="filter-tahun-info" class="text-xs font-semibold text-slate-500">Tahun:</label>
                        <select id="filter-tahun-info" onchange="updateInfografisData()"
                            class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all cursor-pointer">
                            <option value="2026" selected>2026</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>

                    {{-- Select Bulan (Aktif hanya di Mode Bulanan) --}}
                    <div id="wrapper-filter-bulan" class="hidden items-center gap-2">
                        <label for="filter-bulan-info" class="text-xs font-semibold text-slate-500">Bulan:</label>
                        <select id="filter-bulan-info" onchange="updateInfografisData()"
                            class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all cursor-pointer">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7" selected>Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                </div>

            </div>

            {{-- Grid Metric Card --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                
                {{-- Metric 1: Total Penerbitan --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-slate-400 font-semibold text-xs uppercase tracking-wider">Statistik Total Penerbitan</span>
                        <span id="metric-total-penerbitan" class="block text-2xl font-black text-slate-800 mt-1 font-mono">{{ $stats['totalPenerbitan'] ?? 0 }}</span>
                    </div>
                </div>

                {{-- Metric 2: Total Pembaruan --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-slate-400 font-semibold text-xs uppercase tracking-wider">Statistik Total Pembaruan</span>
                        <span id="metric-total-pembaruan" class="block text-2xl font-black text-slate-800 mt-1 font-mono">{{ $stats['totalPembaruan'] ?? 0 }}</span>
                    </div>
                </div>

                {{-- Metric 3: Monitoring Data Selesai --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-slate-400 font-semibold text-xs uppercase tracking-wider">Monitoring Data Selesai</span>
                        <span id="metric-total-selesai" class="block text-2xl font-black text-slate-800 mt-1 font-mono">{{ $stats['totalSelesai'] ?? 0 }}</span>
                        <span class="text-xs text-emerald-600 font-bold block mt-0.5">Selesai terbit & dikirim</span>
                    </div>
                </div>

            </div>

            {{-- Grid Grafik Visualisasi --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- Chart 1: Tren Pengajuan --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 id="chart-title-tren" class="font-bold text-slate-800 text-sm mb-4">Tren Pengajuan Bulanan (2026)</h4>
                    <div class="h-64 relative">
                        <canvas id="chart-bulanan"></canvas>
                    </div>
                </div>

                {{-- Chart 2: Perbandingan Status --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-800 text-sm mb-4">Distribusi Status Permohonan</h4>
                    <div class="h-64 relative flex justify-center">
                        <canvas id="chart-status"></canvas>
                    </div>
                </div>

            </div>

        </div>

        {{-- ============================================================
            TAB PANEL 5: KELOLA DOKUMEN SYARAT (PENERBITAN & PEMBARUAN)
        ============================================================ --}}
        <div id="panel-dokumen_syarat" class="tab-panel space-y-6 hidden">
            
            {{-- Header Action Bar --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4 no-print">
                <div>
                    <h3 class="font-bold text-slate-800 text-base">Kelola Dokumen Persyaratan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Unggah, perbarui, atau hapus dokumen templat formulir rekomendasi dan surat permohonan untuk Penerbitan dan Pembaruan.</p>
                </div>
                
                <button type="button" onclick="openTambahDokumenModal()"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-sm hover:shadow-indigo-200 cursor-pointer shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Dokumen Syarat</span>
                </button>
            </div>

            {{-- Grid 2 Kolom: Dokumen Penerbitan & Dokumen Pembaruan --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- KOLOM 1: PENERBITAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-5 border-b border-slate-100 bg-blue-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center font-bold text-xs shrink-0">
                                📄
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Dokumen Syarat Penerbitan</h4>
                                <span class="text-[11px] text-blue-600 font-medium">Templat untuk Pengajuan Baru</span>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-extrabold rounded-full">
                            {{ $dokumenSyaratData->where('kategori', 'penerbitan')->count() }} File
                        </span>
                    </div>

                    <div class="p-5 space-y-3 flex-1">
                        @forelse($dokumenSyaratData->where('kategori', 'penerbitan') as $doc)
                            @php
                                $fileUrl = str_starts_with($doc->file_path, 'templates/') 
                                    ? asset($doc->file_path) 
                                    : asset('storage/' . $doc->file_path);
                            @endphp
                            <div class="p-4 border border-slate-200 rounded-xl hover:border-blue-300 transition-all flex items-start justify-between gap-3 bg-slate-50/30">
                                <div class="flex items-start gap-3 flex-1 min-w-0">
                                    <div class="w-9 h-9 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center font-black text-xs shrink-0 mt-0.5">
                                        {{ strtoupper($doc->tipe_file ?? 'DOCX') }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h5 class="font-bold text-slate-800 text-xs truncate" title="{{ $doc->nama_dokumen }}">{{ $doc->nama_dokumen }}</h5>
                                        <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-2">{{ $doc->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                        <div class="mt-2 flex items-center gap-3">
                                            <a href="{{ $fileUrl }}" target="_blank" download
                                                class="inline-flex items-center gap-1 text-[11px] text-blue-600 font-bold hover:underline">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                <span>Unduh / Preview</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-1 shrink-0">
                                    <button type="button" onclick="openEditDokumenModal({{ json_encode($doc) }})"
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit Dokumen">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <form action="{{ route('admin.dokumen_syarat.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen syarat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus Dokumen">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slate-400 text-xs border border-dashed border-slate-200 rounded-xl">
                                Belum ada dokumen syarat penerbitan.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- KOLOM 2: PEMBARUAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-5 border-b border-slate-100 bg-indigo-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 bg-indigo-100 text-indigo-700 rounded-lg flex items-center justify-center font-bold text-xs shrink-0">
                                🔄
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Dokumen Syarat Pembaruan</h4>
                                <span class="text-[11px] text-indigo-600 font-medium">Templat untuk Perpanjangan / Pembaruan</span>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 bg-indigo-100 text-indigo-800 text-xs font-extrabold rounded-full">
                            {{ $dokumenSyaratData->where('kategori', 'pembaruan')->count() }} File
                        </span>
                    </div>

                    <div class="p-5 space-y-3 flex-1">
                        @forelse($dokumenSyaratData->where('kategori', 'pembaruan') as $doc)
                            @php
                                $fileUrl = str_starts_with($doc->file_path, 'templates/') 
                                    ? asset($doc->file_path) 
                                    : asset('storage/' . $doc->file_path);
                            @endphp
                            <div class="p-4 border border-slate-200 rounded-xl hover:border-indigo-300 transition-all flex items-start justify-between gap-3 bg-slate-50/30">
                                <div class="flex items-start gap-3 flex-1 min-w-0">
                                    <div class="w-9 h-9 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center font-black text-xs shrink-0 mt-0.5">
                                        {{ strtoupper($doc->tipe_file ?? 'DOCX') }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h5 class="font-bold text-slate-800 text-xs truncate" title="{{ $doc->nama_dokumen }}">{{ $doc->nama_dokumen }}</h5>
                                        <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-2">{{ $doc->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                        <div class="mt-2 flex items-center gap-3">
                                            <a href="{{ $fileUrl }}" target="_blank" download
                                                class="inline-flex items-center gap-1 text-[11px] text-indigo-600 font-bold hover:underline">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                <span>Unduh / Preview</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-1 shrink-0">
                                    <button type="button" onclick="openEditDokumenModal({{ json_encode($doc) }})"
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit Dokumen">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <form action="{{ route('admin.dokumen_syarat.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen syarat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus Dokumen">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slate-400 text-xs border border-dashed border-slate-200 rounded-xl">
                                Belum ada dokumen syarat pembaruan.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>

    </main>

</div>

{{-- ================================================================
    MODAL KONFIRMASI LOGOUT ADMIN
================================================================ --}}
<div id="logout-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/60 backdrop-blur-xs transition-opacity duration-200 no-print">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform transition-all animate-fade-in mx-4">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center text-rose-600 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-800">Konfirmasi Logout</h3>
            </div>
        </div>

        <div class="py-4">
            <p class="text-sm text-slate-600 leading-relaxed">
                Apakah Anda yakin ingin keluar dari sesi Administrator? Anda harus memasukkan email & password kembali untuk mengakses dashboard admin.
            </p>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <button type="button" onclick="closeLogoutModal()" 
                class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all duration-200 cursor-pointer">
                Batal
            </button>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                    class="px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-md hover:shadow-rose-200 cursor-pointer">
                    Ya, Logout Sesi
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ================================================================
    MODAL TAMBAH DOKUMEN SYARAT
================================================================ --}}
<div id="modal-tambah-dokumen" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/60 backdrop-blur-xs transition-opacity duration-200 no-print">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 transform transition-all animate-fade-in mx-4">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <h3 class="text-base font-extrabold text-slate-800">Tambah Dokumen Syarat Baru</h3>
            <button type="button" onclick="closeTambahDokumenModal()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.dokumen_syarat.store') }}" method="POST" enctype="multipart/form-data" class="py-4 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Dokumen <span class="text-red-500">*</span></label>
                <select name="kategori" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 font-bold focus:ring-2 focus:ring-indigo-500">
                    <option value="penerbitan">📄 Dokumen Persyaratan Penerbitan</option>
                    <option value="pembaruan">🔄 Dokumen Persyaratan Pembaruan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Dokumen <span class="text-red-500">*</span></label>
                <input type="text" name="nama_dokumen" placeholder="Contoh: Formulir Rekomendasi (.docx)" required
                    class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Dokumen / Petunjuk</label>
                <textarea name="deskripsi" rows="3" placeholder="Contoh: Format Microsoft Word • Wajib diisi untuk pengajuan"
                    class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">File Dokumen Templat <span class="text-red-500">*</span></label>
                <input type="file" name="file_dokumen" accept=".docx,.doc,.pdf,.zip,.rar" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs text-slate-700 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                <span class="text-[11px] text-slate-400 mt-1 block">Format: DOCX, DOC, PDF, ZIP, RAR. Maksimal 10MB.</span>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeTambahDokumenModal()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md">
                    Simpan Dokumen
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ================================================================
    MODAL EDIT DOKUMEN SYARAT
================================================================ --}}
<div id="modal-edit-dokumen" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/60 backdrop-blur-xs transition-opacity duration-200 no-print">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 transform transition-all animate-fade-in mx-4">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <h3 class="text-base font-extrabold text-slate-800">Edit Dokumen Syarat</h3>
            <button type="button" onclick="closeEditDokumenModal()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="form-edit-dokumen" method="POST" enctype="multipart/form-data" class="py-4 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Dokumen <span class="text-red-500">*</span></label>
                <select name="kategori" id="edit_dokumen_kategori" required class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 font-bold focus:ring-2 focus:ring-indigo-500">
                    <option value="penerbitan">📄 Dokumen Persyaratan Penerbitan</option>
                    <option value="pembaruan">🔄 Dokumen Persyaratan Pembaruan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Dokumen <span class="text-red-500">*</span></label>
                <input type="text" name="nama_dokumen" id="edit_dokumen_nama" required
                    class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Dokumen / Petunjuk</label>
                <textarea name="deskripsi" id="edit_dokumen_deskripsi" rows="3"
                    class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Ganti File Dokumen (Opsional)</label>
                <input type="file" name="file_dokumen" accept=".docx,.doc,.pdf,.zip,.rar"
                    class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs text-slate-700 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                <span class="text-[11px] text-slate-400 mt-1 block">Biarkan kosong jika tidak ingin mengganti file. Format: DOCX, DOC, PDF, ZIP, RAR.</span>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEditDokumenModal()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ================================================================
    MODAL DETAIL ALASAN PENGAJUAN
================================================================ --}}
<div id="modal-detail-alasan" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/60 backdrop-blur-xs transition-opacity duration-200 no-print">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 transform transition-all animate-fade-in mx-4">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-800">Detail Alasan Pengajuan</h3>
                    <span id="detail-alasan-kategori" class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200"></span>
                </div>
            </div>
            <button type="button" onclick="closeDetailAlasanModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="py-4 space-y-3">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Nama Pemohon</span>
                <span id="detail-alasan-pemohon" class="text-sm font-bold text-slate-900 block mt-0.5"></span>
            </div>

            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Isi Alasan Pengajuan Lengkap</span>
                <div id="detail-alasan-content" class="p-4 bg-slate-50 border border-slate-200/90 rounded-xl text-slate-800 text-xs leading-relaxed max-h-64 overflow-y-auto whitespace-pre-line font-medium shadow-inner">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end pt-4 border-t border-slate-100">
            <button type="button" onclick="closeDetailAlasanModal()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all duration-200 shadow-md cursor-pointer">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- ================================================================
    MODAL GANTI PASSWORD ADMIN
================================================================ --}}
<div id="modal-ganti-password" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/60 backdrop-blur-xs transition-opacity duration-200 no-print">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform transition-all animate-fade-in mx-4">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center font-bold shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 0121 9z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-800">Ganti Password Admin</h3>
                    <p class="text-[11px] text-slate-500">Perbarui kata sandi akun Administrator secara berkala</p>
                </div>
            </div>
            <button type="button" onclick="closeGantiPasswordModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.change_password') }}" method="POST" class="py-4 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Password Saat Ini <span class="text-red-500">*</span></label>
                <input type="password" name="password_lama" required placeholder="Masukkan password lama Anda"
                    class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 focus:ring-2 focus:ring-indigo-500">
                @error('password_lama')
                    <span class="text-[11px] text-red-500 mt-1 block font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Password Baru <span class="text-red-500">*</span></label>
                <input type="password" name="password_baru" required placeholder="Minimal 8-12 karakter (huruf, angka, simbol)"
                    class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 focus:ring-2 focus:ring-indigo-500">
                @error('password_baru')
                    <span class="text-[11px] text-red-500 mt-1 block font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                <input type="password" name="password_baru_confirmation" required placeholder="Ulangi password baru Anda"
                    class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-[11px] text-amber-800 leading-relaxed font-medium">
                <span class="font-bold block mb-1">🔒 Ketentuan Kata Sandi:</span>
                • Panjang <strong>8 - 12 karakter</strong>.<br>
                • Wajib gabungan <strong>Huruf Besar (A-Z)</strong>, <strong>Huruf Kecil (a-z)</strong>, <strong>Angka (0-9)</strong>, dan <strong>Simbol (@, !, #, $, %)</strong>.
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeGantiPasswordModal()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all duration-200">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md transition-all duration-200 cursor-pointer">
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
{{-- Load Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // ------------------------------------------------------------------
    // LOGOUT & GANTI PASSWORD MODAL HANDLERS
    // ------------------------------------------------------------------
    function openLogoutModal() {
        document.getElementById('logout-modal').classList.remove('hidden');
    }

    function openGantiPasswordModal() {
        document.getElementById('modal-ganti-password').classList.remove('hidden');
    }

    function closeGantiPasswordModal() {
        document.getElementById('modal-ganti-password').classList.add('hidden');
    }

    // ------------------------------------------------------------------
    // DETAIL ALASAN MODAL HANDLER
    // ------------------------------------------------------------------
    function openDetailAlasanModal(pemohon, kategori, alasan) {
        document.getElementById('detail-alasan-pemohon').textContent = pemohon || '-';
        document.getElementById('detail-alasan-kategori').textContent = kategori || 'Pengajuan';
        document.getElementById('detail-alasan-content').textContent = alasan || '-';
        document.getElementById('modal-detail-alasan').classList.remove('hidden');
    }

    function closeDetailAlasanModal() {
        document.getElementById('modal-detail-alasan').classList.add('hidden');
    }

    function closeLogoutModal() {
        document.getElementById('logout-modal').classList.add('hidden');
    }

    // ------------------------------------------------------------------
    // DOKUMEN SYARAT MODALS HANDLER
    // ------------------------------------------------------------------
    function openTambahDokumenModal() {
        document.getElementById('modal-tambah-dokumen').classList.remove('hidden');
    }

    function closeTambahDokumenModal() {
        document.getElementById('modal-tambah-dokumen').classList.add('hidden');
    }

    function openEditDokumenModal(doc) {
        const form = document.getElementById('form-edit-dokumen');
        form.action = "{{ url('/admin/dokumen-syarat') }}/" + doc.id;
        document.getElementById('edit_dokumen_kategori').value = doc.kategori;
        document.getElementById('edit_dokumen_nama').value = doc.nama_dokumen;
        document.getElementById('edit_dokumen_deskripsi').value = doc.deskripsi || '';
        document.getElementById('modal-edit-dokumen').classList.remove('hidden');
    }

    function closeEditDokumenModal() {
        document.getElementById('modal-edit-dokumen').classList.add('hidden');
    }

    // ------------------------------------------------------------------
    // TAB NAVIGATION SWITCHER
    // ------------------------------------------------------------------
    function switchTab(tabId) {
        if (!document.getElementById('panel-' + tabId)) return;

        // Sembunyikan semua panel
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.add('hidden');
        });

        // Hapus style aktif dari semua tombol
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-slate-800', 'text-white');
            btn.classList.add('text-slate-400');
        });

        // Tampilkan panel terpilih
        document.getElementById('panel-' + tabId).classList.remove('hidden');

        // Buat tombol panel terpilih menjadi aktif
        const activeBtn = document.getElementById('tab-btn-' + tabId);
        if (activeBtn) {
            activeBtn.classList.remove('text-slate-400');
            activeBtn.classList.add('bg-slate-800', 'text-white');
        }

        // Simpan status tab aktif di localStorage & URL hash
        try {
            localStorage.setItem('admin_active_tab', tabId);
            if (history.replaceState) {
                history.replaceState(null, null, '#' + tabId);
            } else {
                window.location.hash = tabId;
            }
        } catch (e) {}

        // Update Title Section
        const titles = {
            'penerbitan': 'Dashboard Penerbitan',
            'pembaruan': 'Dashboard Pembaruan',
            'helpdesk': 'Dashboard Pertanyaan Helpdesk',
            'statistik': 'Menu Infografis & Statistik',
            'dokumen_syarat': 'Kelola Dokumen Persyaratan'
        };
        const titleEl = document.getElementById('current-title-section');
        if (titleEl && titles[tabId]) {
            titleEl.textContent = titles[tabId];
        }

        // Jika pindah ke tab infografis/statistik, trigger update data & chart resize
        if (tabId === 'statistik' && typeof updateInfografisData === 'function') {
            updateInfografisData();
        }
    }

    // ------------------------------------------------------------------
    // LIVE SEARCH, STATUS & RANGE DATE FILTER untuk Tab Penerbitan
    // ------------------------------------------------------------------
    function filterPenerbitanTable() {
        const searchInput = document.getElementById('penerbitan-search-input');
        const statusSelect = document.getElementById('penerbitan-status-filter');
        const startDateInput = document.getElementById('penerbitan-start-date');
        const endDateInput = document.getElementById('penerbitan-end-date');
        
        const searchFilter = searchInput ? searchInput.value.toLowerCase() : "";
        const statusFilter = statusSelect ? statusSelect.value : "all";
        const startDate = startDateInput ? startDateInput.value : "";
        const endDate = endDateInput ? endDateInput.value : "";
        
        const rows = document.querySelectorAll('.row-penerbitan');

        rows.forEach(row => {
            const namaEl = row.querySelector('.nama-pemohon');
            const rowDate = row.getAttribute('data-date');
            const rowStatus = row.getAttribute('data-status');
            
            let matchesSearch = true;
            let matchesStatus = true;
            let matchesDate = true;
            
            if (namaEl) {
                const text = namaEl.textContent || namaEl.innerText;
                matchesSearch = text.toLowerCase().indexOf(searchFilter) > -1;
            }

            if (statusFilter !== 'all') {
                matchesStatus = (rowStatus === statusFilter);
            }
            
            if (startDate && endDate) {
                matchesDate = (rowDate >= startDate && rowDate <= endDate);
            } else if (startDate) {
                matchesDate = (rowDate === startDate);
            } else if (endDate) {
                matchesDate = (rowDate <= endDate);
            }
            
            if (matchesSearch && matchesStatus && matchesDate) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function resetFilters() {
        if (document.getElementById('penerbitan-search-input')) document.getElementById('penerbitan-search-input').value = "";
        if (document.getElementById('penerbitan-status-filter')) document.getElementById('penerbitan-status-filter').value = "all";
        if (document.getElementById('penerbitan-start-date')) document.getElementById('penerbitan-start-date').value = "";
        if (document.getElementById('penerbitan-end-date')) document.getElementById('penerbitan-end-date').value = "";
        filterPenerbitanTable();
    }

    function sortPenerbitanTable() {
        const select = document.getElementById('penerbitan-sort-select');
        const sortBy = select.value;
        const tbody = document.querySelector('#table-penerbitan tbody');
        const rows = Array.from(tbody.querySelectorAll('.row-penerbitan'));

        rows.sort((a, b) => {
            if (sortBy === 'terbaru') {
                const timeA = parseInt(a.getAttribute('data-timestamp'));
                const timeB = parseInt(b.getAttribute('data-timestamp'));
                return timeB - timeA;
            } else if (sortBy === 'abjad') {
                const nameA = a.querySelector('.nama-pemohon').textContent.trim().toLowerCase();
                const nameB = b.querySelector('.nama-pemohon').textContent.trim().toLowerCase();
                return nameA.localeCompare(nameB);
            }
            return 0;
        });

        rows.forEach(row => tbody.appendChild(row));
    }

    // ------------------------------------------------------------------
    // LIVE SEARCH, STATUS & RANGE DATE FILTER untuk Tab Pembaruan
    // ------------------------------------------------------------------
    function filterPembaruanTable() {
        const searchInput = document.getElementById('pembaruan-search-input');
        const statusSelect = document.getElementById('pembaruan-status-filter');
        const startDateInput = document.getElementById('pembaruan-start-date');
        const endDateInput = document.getElementById('pembaruan-end-date');
        
        const searchFilter = searchInput ? searchInput.value.toLowerCase() : "";
        const statusFilter = statusSelect ? statusSelect.value : "all";
        const startDate = startDateInput ? startDateInput.value : "";
        const endDate = endDateInput ? endDateInput.value : "";
        
        const rows = document.querySelectorAll('.row-pembaruan');

        rows.forEach(row => {
            const namaEl = row.querySelector('.nama-pemohon');
            const rowDate = row.getAttribute('data-date');
            const rowStatus = row.getAttribute('data-status');
            
            let matchesSearch = true;
            let matchesStatus = true;
            let matchesDate = true;
            
            if (namaEl) {
                const text = namaEl.textContent || namaEl.innerText;
                matchesSearch = text.toLowerCase().indexOf(searchFilter) > -1;
            }

            if (statusFilter !== 'all') {
                matchesStatus = (rowStatus === statusFilter);
            }
            
            if (startDate && endDate) {
                matchesDate = (rowDate >= startDate && rowDate <= endDate);
            } else if (startDate) {
                matchesDate = (rowDate === startDate);
            } else if (endDate) {
                matchesDate = (rowDate <= endDate);
            }
            
            if (matchesSearch && matchesStatus && matchesDate) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function resetPembaruanFilters() {
        if (document.getElementById('pembaruan-search-input')) document.getElementById('pembaruan-search-input').value = "";
        if (document.getElementById('pembaruan-status-filter')) document.getElementById('pembaruan-status-filter').value = "all";
        if (document.getElementById('pembaruan-start-date')) document.getElementById('pembaruan-start-date').value = "";
        if (document.getElementById('pembaruan-end-date')) document.getElementById('pembaruan-end-date').value = "";
        filterPembaruanTable();
    }

    function filterHelpdeskTable() {
        const input = document.getElementById('helpdesk-search-input');
        const filter = input ? input.value.toLowerCase() : '';
        const rows = document.querySelectorAll('#table-helpdesk tbody .row-helpdesk');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function sortPembaruanTable() {
        const select = document.getElementById('pembaruan-sort-select');
        const sortBy = select.value;
        const tbody = document.querySelector('#table-pembaruan tbody');
        const rows = Array.from(tbody.querySelectorAll('.row-pembaruan'));

        rows.sort((a, b) => {
            if (sortBy === 'terbaru') {
                const timeA = parseInt(a.getAttribute('data-timestamp'));
                const timeB = parseInt(b.getAttribute('data-timestamp'));
                return timeB - timeA;
            } else if (sortBy === 'abjad') {
                const nameA = a.querySelector('.nama-pemohon').textContent.trim().toLowerCase();
                const nameB = b.querySelector('.nama-pemohon').textContent.trim().toLowerCase();
                return nameA.localeCompare(nameB);
            }
            return 0;
        });

        rows.forEach(row => tbody.appendChild(row));
    }

    // ------------------------------------------------------------------
    // CHART.JS INTEGRATION & DYNAMIC MODE SWITCHING (Keseluruhan / Tahunan / Bulanan)
    // ------------------------------------------------------------------
    // ------------------------------------------------------------------
    // CHART.JS INTEGRATION & DYNAMIC TIME FILTERING (Real MySQL Data)
    // ------------------------------------------------------------------
    let currentInfografisMode = 'keseluruhan';
    let chartBulananInstance = null;
    let chartStatusInstance = null;

    // Real Records from Database MySQL
    const realPenerbitan = @json($penerbitanData ?? []);
    const realPembaruan  = @json($pembaruanData ?? []);

    function parseRecordDate(dateStr) {
        if (!dateStr) return null;
        const d = new Date(dateStr);
        return isNaN(d.getTime()) ? null : d;
    }

    function setInfografisMode(mode) {
        currentInfografisMode = mode;
        const btnKeseluruhan = document.getElementById('btn-view-keseluruhan');
        const btnTahunan     = document.getElementById('btn-view-tahunan');
        const btnBulanan     = document.getElementById('btn-view-bulanan');

        const wrapperTahun = document.getElementById('wrapper-filter-tahun');
        const wrapperBulan = document.getElementById('wrapper-filter-bulan');

        // Reset button active styles
        [btnKeseluruhan, btnTahunan, btnBulanan].forEach(btn => {
            if (btn) btn.className = "px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 text-slate-600 hover:text-slate-900 cursor-pointer";
        });

        if (mode === 'keseluruhan') {
            if (btnKeseluruhan) btnKeseluruhan.className = "px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 bg-white text-indigo-700 shadow-sm cursor-pointer";
            if (wrapperTahun) wrapperTahun.style.display = "none";
            if (wrapperBulan) wrapperBulan.style.display = "none";
        } else if (mode === 'tahunan') {
            if (btnTahunan) btnTahunan.className = "px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 bg-white text-indigo-700 shadow-sm cursor-pointer";
            if (wrapperTahun) wrapperTahun.style.display = "flex";
            if (wrapperBulan) wrapperBulan.style.display = "none";
        } else if (mode === 'bulanan') {
            if (btnBulanan) btnBulanan.className = "px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 bg-white text-indigo-700 shadow-sm cursor-pointer";
            if (wrapperTahun) wrapperTahun.style.display = "flex";
            if (wrapperBulan) wrapperBulan.style.display = "flex";
        }

        updateInfografisData();
    }

    function updateInfografisData() {
        const selectedYear  = parseInt(document.getElementById('filter-tahun-info').value) || 2026;
        const selectedMonth = parseInt(document.getElementById('filter-bulan-info').value) || 7;

        let penerbitanFiltered = [];
        let pembaruanFiltered  = [];
        let labels = [];
        let penerbitanChartData = [];
        let pembaruanChartData  = [];
        let titleText = "";

        if (currentInfografisMode === 'keseluruhan') {
            titleText = "Tren Pengajuan Keseluruhan Waktu (Total Kumulatif)";
            const yearsList = [2023, 2024, 2025, 2026];
            labels = yearsList.map(y => y.toString());

            penerbitanFiltered = realPenerbitan;
            pembaruanFiltered  = realPembaruan;

            penerbitanChartData = yearsList.map(y => {
                return realPenerbitan.filter(i => {
                    const d = parseRecordDate(i.created_at);
                    return d && d.getFullYear() === y;
                }).length;
            });

            pembaruanChartData = yearsList.map(y => {
                return realPembaruan.filter(i => {
                    const d = parseRecordDate(i.created_at);
                    return d && d.getFullYear() === y;
                }).length;
            });

        } else if (currentInfografisMode === 'tahunan') {
            titleText = `Tren Pengajuan Bulanan (Tahun ${selectedYear})`;
            labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            penerbitanFiltered = realPenerbitan.filter(i => {
                const d = parseRecordDate(i.created_at);
                return d && d.getFullYear() === selectedYear;
            });

            pembaruanFiltered = realPembaruan.filter(i => {
                const d = parseRecordDate(i.created_at);
                return d && d.getFullYear() === selectedYear;
            });

            for (let m = 0; m < 12; m++) {
                penerbitanChartData.push(
                    penerbitanFiltered.filter(i => {
                        const d = parseRecordDate(i.created_at);
                        return d && d.getMonth() === m;
                    }).length
                );
                pembaruanChartData.push(
                    pembaruanFiltered.filter(i => {
                        const d = parseRecordDate(i.created_at);
                        return d && d.getMonth() === m;
                    }).length
                );
            }

        } else if (currentInfografisMode === 'bulanan') {
            const monthNames = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            titleText = `Tren Mingguan di Bulan ${monthNames[selectedMonth]} (${selectedYear})`;
            labels = ['Minggu 1 (Tgl 1-7)', 'Minggu 2 (Tgl 8-14)', 'Minggu 3 (Tgl 15-21)', 'Minggu 4+ (Tgl 22-31)'];

            penerbitanFiltered = realPenerbitan.filter(i => {
                const d = parseRecordDate(i.created_at);
                return d && d.getFullYear() === selectedYear && (d.getMonth() + 1) === selectedMonth;
            });

            pembaruanFiltered = realPembaruan.filter(i => {
                const d = parseRecordDate(i.created_at);
                return d && d.getFullYear() === selectedYear && (d.getMonth() + 1) === selectedMonth;
            });

            penerbitanChartData = [
                penerbitanFiltered.filter(i => parseRecordDate(i.created_at).getDate() <= 7).length,
                penerbitanFiltered.filter(i => { const date = parseRecordDate(i.created_at).getDate(); return date >= 8 && date <= 14; }).length,
                penerbitanFiltered.filter(i => { const date = parseRecordDate(i.created_at).getDate(); return date >= 15 && date <= 21; }).length,
                penerbitanFiltered.filter(i => parseRecordDate(i.created_at).getDate() >= 22).length,
            ];

            pembaruanChartData = [
                pembaruanFiltered.filter(i => parseRecordDate(i.created_at).getDate() <= 7).length,
                pembaruanFiltered.filter(i => { const date = parseRecordDate(i.created_at).getDate(); return date >= 8 && date <= 14; }).length,
                pembaruanFiltered.filter(i => { const date = parseRecordDate(i.created_at).getDate(); return date >= 15 && date <= 21; }).length,
                pembaruanFiltered.filter(i => parseRecordDate(i.created_at).getDate() >= 22).length,
            ];
        }

        // Metrik Ringkasan Real
        const totalPen = penerbitanFiltered.length;
        const totalPem = pembaruanFiltered.length;

        const countDisetujui = penerbitanFiltered.filter(i => i.status === 'Disetujui').length + pembaruanFiltered.filter(i => i.status === 'Disetujui').length;
        const countPending   = penerbitanFiltered.filter(i => i.status === 'Pending').length + pembaruanFiltered.filter(i => i.status === 'Pending').length;
        const countDitolak   = penerbitanFiltered.filter(i => i.status === 'Ditolak').length + pembaruanFiltered.filter(i => i.status === 'Ditolak').length;

        // Update Text & Metric Card UI
        const elTitle = document.getElementById('chart-title-tren');
        const elPen   = document.getElementById('metric-total-penerbitan');
        const elPem   = document.getElementById('metric-total-pembaruan');
        const elSel   = document.getElementById('metric-total-selesai');

        if (elTitle) elTitle.textContent = titleText;
        if (elPen)   elPen.textContent   = totalPen;
        if (elPem)   elPem.textContent   = totalPem;
        if (elSel)   elSel.textContent   = countDisetujui;

        // Update Chart Batang (Tren)
        if (chartBulananInstance) {
            chartBulananInstance.data.labels = labels;
            chartBulananInstance.data.datasets[0].data = penerbitanChartData;
            chartBulananInstance.data.datasets[1].data = pembaruanChartData;
            chartBulananInstance.update();
        }

        // Update Chart Donat (Status)
        if (chartStatusInstance) {
            chartStatusInstance.data.datasets[0].data = [countDisetujui, countPending, countDitolak];
            chartStatusInstance.update();
        }
    }

    // Update dynamic theme colors for Chart.js
    function updateChartTheme() {
        const isHC = document.documentElement.classList.contains('high-contrast');
        const textColor = isHC ? '#ffffff' : '#475569';
        const gridColor = isHC ? 'rgba(255, 255, 255, 0.25)' : 'rgba(226, 232, 240, 0.8)';

        if (chartBulananInstance) {
            chartBulananInstance.options.plugins.legend.labels.color = textColor;
            if (chartBulananInstance.options.scales.x) {
                chartBulananInstance.options.scales.x.ticks.color = textColor;
                chartBulananInstance.options.scales.x.grid.color = gridColor;
            }
            if (chartBulananInstance.options.scales.y) {
                chartBulananInstance.options.scales.y.ticks.color = textColor;
                chartBulananInstance.options.scales.y.grid.color = gridColor;
            }
            chartBulananInstance.update();
        }

        if (chartStatusInstance) {
            chartStatusInstance.options.plugins.legend.labels.color = textColor;
            chartStatusInstance.update();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const isHC = document.documentElement.classList.contains('high-contrast');
        const textColor = isHC ? '#ffffff' : '#475569';
        const gridColor = isHC ? 'rgba(255, 255, 255, 0.25)' : 'rgba(226, 232, 240, 0.8)';

        // 1. Chart Bulanan / Tren (Bar Chart)
        const ctxBulanan = document.getElementById('chart-bulanan').getContext('2d');
        chartBulananInstance = new Chart(ctxBulanan, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Penerbitan',
                        data: [],
                        backgroundColor: '#4f46e5',
                        borderRadius: 6
                    },
                    {
                        label: 'Pembaruan',
                        data: [],
                        backgroundColor: '#c084fc',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor,
                            font: { weight: 'bold' }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: textColor, font: { weight: 'bold' } },
                        grid: { color: gridColor }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: textColor,
                            font: { weight: 'bold' }
                        },
                        grid: { color: gridColor }
                    }
                }
            }
        });

        // 2. Chart Perbandingan Status (Doughnut Chart)
        const ctxStatus = document.getElementById('chart-status').getContext('2d');
        chartStatusInstance = new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Disetujui', 'Pending', 'Ditolak'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: [
                        '#10b981', // emerald-500
                        '#f59e0b', // amber-500
                        '#f43f5e'  // rose-500
                    ],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor,
                            font: { weight: 'bold' }
                        }
                    }
                }
            }
        });

        // Inisialisasi awal ke mode keseluruhan waktu
        setInfografisMode('keseluruhan');

        // Restore tab aktif dari session Laravel, URL Hash, atau localStorage
        const sessionActiveTab = "{{ session('active_tab') }}";
        const urlHashTab = window.location.hash ? window.location.hash.replace('#', '') : '';
        const storedTab = localStorage.getItem('admin_active_tab');

        const activeTabToLoad = sessionActiveTab || urlHashTab || storedTab;
        if (activeTabToLoad && document.getElementById('panel-' + activeTabToLoad)) {
            switchTab(activeTabToLoad);
        }

        @if($errors->has('password_lama') || $errors->has('password_baru'))
            openGantiPasswordModal();
        @endif

        // Observer untuk merespon perubahan class high-contrast secara real-time
        const observer = new MutationObserver(() => {
            updateChartTheme();
        });
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
    });
</script>
@endpush
