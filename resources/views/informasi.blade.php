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
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest mb-4">Daftar Isi</h3>
                    <nav class="space-y-2">
                        <a href="#dasar-hukum" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">1</span>
                            Dasar Hukum
                        </a>
                        <a href="#prosedur" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">2</span>
                            Prosedur Pengajuan
                        </a>
                        <a href="#persyaratan" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">3</span>
                            Persyaratan Dokumen
                        </a>
                        <a href="#faq" class="flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 py-1 transition-colors duration-200">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold shrink-0">4</span>
                            FAQ
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
                            <h2 class="text-xl font-bold text-slate-800">Dasar Hukum</h2>
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
                            <h2 class="text-xl font-bold text-slate-800">Prosedur Pengajuan</h2>
                        </div>

                        <div class="space-y-4">
                            @foreach([
                                ['num' => '1', 'title' => 'Persiapkan Dokumen', 'desc' => 'Siapkan dokumen identitas (KTP/NIK), foto diri terbaru, dan dokumen pendukung lainnya sesuai jenis pengajuan.'],
                                ['num' => '2', 'title' => 'Isi Formulir Online', 'desc' => 'Akses formulir pengajuan melalui menu "Form Penerbitan" atau "Form Pembaruan". Isi semua field dan unggah dokumen yang diperlukan.'],
                                ['num' => '3', 'title' => 'Verifikasi Admin & Update Status', 'desc' => 'Setelah pengajuan dikirim, tim admin akan memverifikasi dokumen. Informasi status tentang perkembangan sertifikasi elektronik akan selalu diperbarui.'],
                                ['num' => '4', 'title' => 'Notifikasi Selesai', 'desc' => 'Sistem akan mengirimkan notifikasi kepada user atau pemohon bahwa seluruh proses permohonan telah selesai.'],
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
                            <div class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800">Persyaratan Dokumen</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            {{-- Untuk Penerbitan Baru --}}
                            <div class="bg-blue-50 rounded-xl border border-blue-100 p-5">
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <h4 class="font-bold text-blue-800 text-sm">Penerbitan Baru</h4>
                                </div>
                                <ul class="space-y-2.5">
                                    @foreach([
                                        'Kartu Tanda Penduduk (KTP) yang masih berlaku',
                                        'Nomor Induk Kependudukan (NIK)',
                                        'Nomor Induk Pegawai (NIP)',
                                        'Alamat email aktif',
                                        'Surat keterangan dari instansi/perusahaan',
                                        'Dokumen pendukung sesuai kebutuhan (PDF, maks 10MB)',
                                    ] as $item)
                                    <li class="flex items-start gap-2 text-sm text-blue-700">
                                        <svg class="w-4 h-4 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $item }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Untuk Pembaruan --}}
                            <div class="bg-indigo-50 rounded-xl border border-indigo-100 p-5">
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    <h4 class="font-bold text-indigo-800 text-sm">Pembaruan Sertifikat</h4>
                                </div>
                                <ul class="space-y-2.5">
                                    @foreach([
                                        'Nama lengkap pemegang sertifikat',
                                        'Nomor Induk Kependudukan (NIK)',
                                        'Alamat email aktif yang terdaftar',
                                        'Surat rekomendasi permohonan pembaruan (PDF, maks 10MB)',
                                    ] as $item)
                                    <li class="flex items-start gap-2 text-sm text-indigo-700">
                                        <svg class="w-4 h-4 text-indigo-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $item }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
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
                                ['q' => 'Apakah ada biaya untuk pengajuan sertifikat?', 'a' => 'Informasi mengenai biaya layanan dapat dikonfirmasi melalui tim admin kami. Hubungi helpdesk melalui WhatsApp untuk informasi lebih lanjut.'],
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

                    {{-- ===== CTA BAWAH ===== --}}
                    <div class="bg-gradient-to-r from-blue-700 to-blue-800 rounded-2xl p-8 text-center">
                        <h3 class="text-xl font-bold text-white mb-2">Butuh Bantuan Lebih Lanjut?</h3>
                        <p class="text-blue-200 text-sm mb-6">Jika Anda memiliki pertanyaan lain seputar sertifikasi elektronik, jangan ragu untuk menghubungi kami.</p>
                        <div class="flex justify-center">
                            <a href="https://wa.me/6282312293928?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20sertifikasi%20elektronik."
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-md shadow-green-950/20 hover:shadow-lg text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Tanya Admin
                            </a>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
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
