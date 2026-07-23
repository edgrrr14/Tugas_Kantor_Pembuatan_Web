<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * CertificationController
 *
 * Controller utama untuk menangani semua logika halaman
 * pada website Sertifikasi Elektronik. Mencakup tampilan halaman (View),
 * penanganan form penerbitan, dan penanganan form pembaruan sertifikat.
 */
class CertificationController extends Controller
{
    // ===========================================================
    // BAGIAN 1: METODE TAMPILAN HALAMAN (VIEWS)
    // ===========================================================

    /**
     * Menampilkan halaman Landing Page / Beranda utama.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Menampilkan halaman Form Penerbitan Sertifikat.
     *
     * @return \Illuminate\View\View
     */
    public function penerbitan()
    {
        return view('penerbitan');
    }

    /**
     * Menampilkan halaman Form Pembaruan Sertifikat.
     *
     * @return \Illuminate\View\View
     */
    public function pembaruan()
    {
        return view('pembaruan');
    }

    /**
     * Menampilkan halaman Informasi Website.
     *
     * @return \Illuminate\View\View
     */
    public function informasi()
    {
        return view('informasi');
    }

    // ===========================================================
    // BAGIAN 2: METODE PENYIMPANAN DATA FORM
    // ===========================================================

    /**
     * Memproses dan menyimpan pengajuan Penerbitan Sertifikat baru.
     *
     * Alur proses:
     * 1. Validasi input dari user.
     * 2. Menyimpan file dokumen ke storage.
     * 3. (TODO) Simpan data ke database.
     * 4. (TODO) Kirim notifikasi WhatsApp ke admin.
     * 5. Redirect dengan pesan sukses.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePenerbitan(Request $request)
    {
        // -----------------------------------------------------------
        // STEP 1: VALIDASI INPUT
        // Validasi semua field yang dikirimkan dari form penerbitan.
        // -----------------------------------------------------------
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255|min:3',
            'nik'            => 'required|string|max:16|min:10',
            'nip'            => 'required|string|max:18|min:9',
            'email'          => 'required|email|max:255',
            'no_telepon'     => 'required|string|max:20',
            'instansi'       => 'required|string|max:255',
            'jabatan'        => 'required|string|max:255',
            'alasan'         => 'required|string|max:2000',
            'dokumen'        => 'required|file|mimes:pdf|max:10240', // Maks 10MB
            'persetujuan'    => 'accepted',
        ], [
            // Pesan validasi dalam Bahasa Indonesia
            'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min'       => 'Nama lengkap minimal 3 karakter.',
            'nik.required'           => 'NIK wajib diisi.',
            'nik.max'                => 'NIK tidak boleh lebih dari 16 karakter.',
            'nip.required'           => 'NIP wajib diisi.',
            'nip.min'                => 'NIP minimal 9 karakter.',
            'nip.max'                => 'NIP tidak boleh lebih dari 18 karakter.',
            'email.required'         => 'Alamat email wajib diisi.',
            'email.email'            => 'Format alamat email tidak valid.',
            'no_telepon.required'    => 'Nomor telepon wajib diisi.',
            'instansi.required'      => 'Nama Instansi wajib diisi.',
            'jabatan.required'       => 'Jabatan wajib diisi.',
            'alasan.required'        => 'Alasan pengajuan wajib diisi.',
            'dokumen.required'       => 'Dokumen pendukung wajib diunggah.',
            'dokumen.mimes'          => 'Format dokumen harus berupa PDF.',
            'dokumen.max'            => 'Ukuran dokumen tidak boleh lebih dari 10MB.',
            'persetujuan.accepted'   => 'Anda harus menyetujui pernyataan ini sebelum mengirim pengajuan.',
        ]);

        // -----------------------------------------------------------
        // STEP 2: UPLOAD FILE DOKUMEN
        // Simpan file ke direktori 'dokumen/penerbitan' di dalam storage.
        // File dapat diakses melalui Storage::url() atau link simbolis.
        // -----------------------------------------------------------
        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            // Nama file akan di-hash secara otomatis untuk keamanan
            $dokumenPath = $request->file('dokumen')->store('dokumen/penerbitan', 'public');
        }

        // -----------------------------------------------------------
        // STEP 3: SIMPAN DATA KE DATABASE
        //
        // TODO: Aktifkan kode berikut setelah menjalankan migrasi database.
        // Buat model: php artisan make:model PenerbitanSertifikat -m
        // -----------------------------------------------------------
        // $penerbitan = \App\Models\PenerbitanSertifikat::create([
        //     'nama_lengkap' => $validated['nama_lengkap'],
        //     'nik'          => $validated['nik'],
        //     'nip'          => $validated['nip'],
        //     'email'        => $validated['email'],
        //     'no_telepon'   => $validated['no_telepon'],
        //     'instansi'     => $validated['instansi'],
        //     'jabatan'      => $validated['jabatan'],
        //     'alasan'       => $validated['alasan'],
        //     'dokumen_path' => $dokumenPath,
        //     'status'       => 'pending', // Status default: menunggu review
        // ]);

        // -----------------------------------------------------------
        // STEP 4: NOTIFIKASI WHATSAPP KE ADMIN
        //
        // TODO: Integrasikan dengan API WhatsApp (misalnya: Fonnte, Wablas, Twilio).
        // Aktifkan setelah data berhasil disimpan ke database ($penerbitan dibuat).
        //
        // Contoh integrasi menggunakan service class WhatsAppService:
        // -----------------------------------------------------------
        // try {
        //     $nomorAdmin = config('app.whatsapp_admin_number'); // Simpan di .env & config/app.php
        //     $pesan = "📋 *Pengajuan Penerbitan Sertifikat Baru*\n\n"
        //            . "Nama     : {$validated['nama_lengkap']}\n"
        //            . "NIK      : {$validated['nik']}\n"
        //            . "Email    : {$validated['email']}\n"
        //            . "No Telp  : {$validated['no_telepon']}\n"
        //            . "Instansi : {$validated['instansi']}\n"
        //            . "Alasan   : {$validated['alasan']}\n\n"
        //            . "Silakan review pengajuan ini di dashboard admin.";
        //
        //     // Kirim via layanan pihak ketiga (contoh: Fonnte API)
        //     \App\Services\WhatsAppService::send($nomorAdmin, $pesan);
        // } catch (\Exception $e) {
        //     // Jangan hentikan proses jika notifikasi gagal, cukup log error-nya
        //     Log::error('Gagal mengirim notifikasi WhatsApp: ' . $e->getMessage());
        // }

        // Log aktivitas untuk audit trail
        Log::info('Pengajuan penerbitan baru', [
            'nama'       => $validated['nama_lengkap'],
            'email'      => $validated['email'],
            'no_telepon' => $validated['no_telepon'],
            'instansi'   => $validated['instansi'],
        ]);

        // -----------------------------------------------------------
        // STEP 5: REDIRECT DENGAN PESAN SUKSES
        // -----------------------------------------------------------
        return redirect()->route('home')
            ->with('success', 'Pengajuan penerbitan sertifikat Anda berhasil dikirim! Kami akan segera menghubungi Anda kembali.')
            ->with('whatsapp_url', 'https://wa.me/6282312293928?text=Form%20penerbitan%20telah%20diisi');
    }

    /**
     * Memproses dan menyimpan pengajuan Pembaruan Sertifikat.
     *
     * Alur proses:
     * 1. Validasi input dari user.
     * 2. Menyimpan file bukti sertifikat lama ke storage.
     * 3. (TODO) Simpan data ke database.
     * 4. (TODO) Kirim notifikasi WhatsApp ke admin.
     * 5. Redirect dengan pesan sukses.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePembaruan(Request $request)
    {
        // -----------------------------------------------------------
        // STEP 1: VALIDASI INPUT
        // -----------------------------------------------------------
        // STEP 1: VALIDASI DATA INPUT
        // Validasi field yang ada di form pembaruan sertifikat.
        // -----------------------------------------------------------
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255|min:3',
            'nik'              => 'required|numeric|digits:16',
            'email'            => 'required|email|max:255',
            'no_telepon'       => 'required|string|max:20',
            'instansi'         => 'required|string|max:255',
            'bukti_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // Maks 10MB
            'persetujuan'      => 'accepted',
        ], [
            // Pesan validasi dalam Bahasa Indonesia
            'nama_lengkap.required'     => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min'          => 'Nama lengkap minimal 3 karakter.',
            'nik.required'              => 'NIK wajib diisi.',
            'nik.numeric'               => 'NIK harus berupa angka 16 digit.',
            'nik.digits'                => 'NIK harus terdiri dari 16 digit.',
            'email.required'            => 'Alamat email wajib diisi.',
            'email.email'               => 'Format alamat email tidak valid.',
            'no_telepon.required'       => 'Nomor telepon wajib diisi.',
            'instansi.required'         => 'Instansi wajib diisi.',
            'bukti_sertifikat.required' => 'Surat rekomendasi permohonan pembaruan sertifikat elektronik wajib diunggah.',
            'bukti_sertifikat.mimes'    => 'Format file harus berupa PDF, JPG, JPEG, atau PNG.',
            'bukti_sertifikat.max'      => 'Ukuran file tidak boleh lebih dari 10MB.',
            'persetujuan.accepted'      => 'Anda harus menyetujui pernyataan ini sebelum mengirim pengajuan.',
        ]);

        // -----------------------------------------------------------
        // STEP 2: UPLOAD FILE SURAT REKOMENDASI
        // -----------------------------------------------------------
        $buktiPath = null;
        if ($request->hasFile('bukti_sertifikat')) {
            $buktiPath = $request->file('bukti_sertifikat')->store('dokumen/pembaruan', 'public');
        }

        // -----------------------------------------------------------
        // STEP 3: SIMPAN DATA KE DATABASE
        //
        // TODO: Aktifkan kode berikut setelah menjalankan migrasi database.
        // Buat model: php artisan make:model PembaruanSertifikat -m
        // -----------------------------------------------------------
        // $pembaruan = \App\Models\PembaruanSertifikat::create([
        //     'nama_lengkap'     => $validated['nama_lengkap'],
        //     'nik'              => $validated['nik'],
        //     'email'            => $validated['email'],
        //     'no_telepon'       => $validated['no_telepon'],
        //     'instansi'         => $validated['instansi'],
        //     'bukti_path'       => $buktiPath,
        //     'status'           => 'pending',
        // ]);

        // -----------------------------------------------------------
        // STEP 4: NOTIFIKASI WHATSAPP KE ADMIN
        //
        // TODO: Aktifkan setelah data disimpan ke database.
        // -----------------------------------------------------------
        // try {
        //     $nomorAdmin = config('app.whatsapp_admin_number');
        //     $pesan = "🔄 *Pengajuan Pembaruan Sertifikat*\n\n"
        //            . "Nama              : {$validated['nama_lengkap']}\n"
        //            . "NIK               : {$validated['nik']}\n"
        //            . "Email             : {$validated['email']}\n"
        //            . "No Telepon        : {$validated['no_telepon']}\n"
        //            . "Instansi          : {$validated['instansi']}\n\n"
        //            . "Silakan review pengajuan pembaruan ini di dashboard admin.";
        //
        //     \App\Services\WhatsAppService::send($nomorAdmin, $pesan);
        // } catch (\Exception $e) {
        //     Log::error('Gagal mengirim notifikasi WhatsApp: ' . $e->getMessage());
        // }

        Log::info('Pengajuan pembaruan baru', [
            'nama'       => $validated['nama_lengkap'],
            'nik'        => $validated['nik'],
            'email'      => $validated['email'],
            'no_telepon' => $validated['no_telepon'],
            'instansi'   => $validated['instansi'],
        ]);

        // -----------------------------------------------------------
        // STEP 5: REDIRECT DENGAN PESAN SUKSES
        // -----------------------------------------------------------
        return redirect()->route('home')
            ->with('success', 'Pengajuan pembaruan sertifikat Anda berhasil dikirim! Kami akan segera menghubungi Anda melalui email yang terdaftar.')
            ->with('whatsapp_url', 'https://wa.me/6282312293928?text=Form%20pembaruan%20telah%20diisi');
    }
}
