<?php

namespace App\Http\Controllers;

use App\Models\Penerbitan;
use App\Models\Pembaruan;
use App\Models\Helpdesk;
use App\Models\DokumenSyarat;
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
        $dokumenPenerbitan = DokumenSyarat::where('kategori', 'penerbitan')->latest()->get();
        $dokumenPembaruan  = DokumenSyarat::where('kategori', 'pembaruan')->latest()->get();

        return view('index', compact('dokumenPenerbitan', 'dokumenPembaruan'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePenerbitan(Request $request)
    {
        // -----------------------------------------------------------
        // STEP 1: VALIDASI INPUT
        // -----------------------------------------------------------
        $validated = $request->validate([
            'nama_lengkap'      => 'required|string|max:255|min:3',
            'nik'               => 'required|numeric|digits:16',
            'nip'               => 'required|numeric|digits:18',
            'email'             => 'required|email|max:255',
            'no_telepon'        => 'required|string|max:13|min:10',
            'instansi'          => 'required|string|max:255',
            'jabatan'           => 'required|string|max:255',
            'alasan'            => 'required|string|max:2000',
            'surat_permohonan'  => 'required|file|mimes:pdf|max:10240',
            'surat_rekomendasi' => 'required|file|mimes:pdf|max:10240',
            'foto_ktp'          => 'required|file|mimes:jpg,jpeg,png|max:10240',
            'persetujuan'       => 'accepted',
        ], [
            'nama_lengkap.required'     => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min'          => 'Nama lengkap minimal 3 karakter.',
            'nik.required'              => 'NIK wajib diisi.',
            'nik.numeric'               => 'NIK harus berupa angka 16 digit.',
            'nik.digits'                => 'NIK harus terdiri dari 16 digit.',
            'nip.required'              => 'NIP wajib diisi.',
            'nip.numeric'               => 'NIP harus berupa angka 18 digit.',
            'nip.digits'                => 'NIP harus terdiri dari 18 digit.',
            'email.required'            => 'Alamat email wajib diisi.',
            'email.email'               => 'Format alamat email tidak valid.',
            'no_telepon.required'       => 'Nomor telepon wajib diisi.',
            'no_telepon.max'            => 'Nomor telepon tidak boleh lebih dari 13 karakter.',
            'no_telepon.min'            => 'Nomor telepon tidak boleh kurang dari 10 karakter.',
            'instansi.required'         => 'Unit Kerja wajib diisi.',
            'jabatan.required'          => 'Jabatan wajib diisi.',
            'alasan.required'           => 'Alasan pengajuan wajib diisi.',
            'surat_permohonan.required' => 'Surat permohonan wajib diunggah.',
            'surat_permohonan.mimes'    => 'Format surat permohonan harus berupa PDF.',
            'surat_permohonan.max'      => 'Ukuran surat permohonan tidak boleh lebih dari 10MB.',
            'surat_rekomendasi.required'=> 'Surat rekomendasi unit kerja wajib diunggah.',
            'surat_rekomendasi.mimes'   => 'Format surat rekomendasi unit kerja harus berupa PDF.',
            'surat_rekomendasi.max'     => 'Ukuran surat rekomendasi unit kerja tidak boleh lebih dari 10MB.',
            'foto_ktp.required'         => 'Foto KTP wajib diunggah.',
            'foto_ktp.mimes'            => 'Format foto KTP harus berupa JPG, JPEG, atau PNG.',
            'foto_ktp.max'              => 'Ukuran foto KTP tidak boleh lebih dari 10MB.',
            'persetujuan.accepted'      => 'Anda harus menyetujui pernyataan ini sebelum mengirim pengajuan.',
        ]);

        // -----------------------------------------------------------
        // STEP 2: UPLOAD FILE DOKUMEN
        // -----------------------------------------------------------
        $suratPermohonanPath = $request->file('surat_permohonan')->store('dokumen/penerbitan/surat_permohonan', 'public');
        $suratRekomendasiPath = $request->file('surat_rekomendasi')->store('dokumen/penerbitan/surat_rekomendasi', 'public');
        $fotoKtpPath = $request->file('foto_ktp')->store('dokumen/penerbitan/foto_ktp', 'public');

        // -----------------------------------------------------------
        // STEP 3: SIMPAN DATA KE DATABASE MYSQL
        // -----------------------------------------------------------
        $penerbitan = Penerbitan::create([
            'nama_lengkap'      => $validated['nama_lengkap'],
            'nik'               => $validated['nik'],
            'nip'               => $validated['nip'],
            'email'             => $validated['email'],
            'no_telepon'        => $validated['no_telepon'],
            'instansi'          => $validated['instansi'],
            'jabatan'           => $validated['jabatan'],
            'alasan'            => $validated['alasan'],
            'surat_permohonan'  => $suratPermohonanPath,
            'surat_rekomendasi' => $suratRekomendasiPath,
            'foto_ktp'          => $fotoKtpPath,
            'dokumen'           => $suratPermohonanPath,
            'status'            => 'Pending',
        ]);

        $waMessage = "Halo Admin, terdapat *PENGAJUAN PENERBITAN SERTIFIKAT BARU*.\n\n"
            . "📋 *Data Pemohon:*\n"
            . "• Nama Lengkap: " . $validated['nama_lengkap'] . "\n"
            . "• NIK: " . $validated['nik'] . "\n"
            . "• NIP: " . $validated['nip'] . "\n"
            . "• Email: " . $validated['email'] . "\n"
            . "• No HP/WA: " . $validated['no_telepon'] . "\n"
            . "• Unit Kerja: " . $validated['instansi'] . "\n"
            . "• Jabatan: " . $validated['jabatan'] . "\n\n"
            . "📝 *Alasan Pengajuan:*\n" . $validated['alasan'] . "\n\n"
            . "Mohon untuk segera diperiksa dan diverifikasi melalui Dashboard Admin. Terima kasih.";

        $waUrl = 'https://wa.me/6282312293928?text=' . urlencode($waMessage);

        return redirect()->route('home')
            ->with('success', 'Pengajuan penerbitan sertifikat Anda berhasil dikirim! Kami akan segera menghubungi Anda kembali.')
            ->with('whatsapp_url', $waUrl);
    }

    /**
     * Memproses dan menyimpan pengajuan Pembaruan Sertifikat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePembaruan(Request $request)
    {
        // -----------------------------------------------------------
        // STEP 1: VALIDASI DATA INPUT
        // -----------------------------------------------------------
        $validated = $request->validate([
            'nama_lengkap'      => 'required|string|max:255|min:3',
            'nik'               => 'required|numeric|digits:16',
            'nip'               => 'required|numeric|digits:18',
            'email'             => 'required|email|max:255',
            'no_telepon'        => 'required|string|max:13|min:10',
            'instansi'          => 'required|string|max:255',
            'jabatan'           => 'required|string|max:255',
            'alasan'            => 'required|string|max:2000',
            'surat_permohonan'  => 'required|file|mimes:pdf|max:10240',
            'surat_rekomendasi' => 'required|file|mimes:pdf|max:10240',
            'foto_ktp'          => 'required|file|mimes:jpg,jpeg,png|max:10240',
            'persetujuan'       => 'accepted',
        ], [
            'nama_lengkap.required'     => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min'          => 'Nama lengkap minimal 3 karakter.',
            'nik.required'              => 'NIK wajib diisi.',
            'nik.numeric'               => 'NIK harus berupa angka 16 digit.',
            'nik.digits'                => 'NIK harus terdiri dari 16 digit.',
            'nip.required'              => 'NIP wajib diisi.',
            'nip.numeric'               => 'NIP harus berupa angka 18 digit.',
            'nip.digits'                => 'NIP harus terdiri dari 18 digit.',
            'email.required'            => 'Alamat email wajib diisi.',
            'email.email'               => 'Format alamat email tidak valid.',
            'no_telepon.required'       => 'Nomor telepon wajib diisi.',
            'no_telepon.max'            => 'Nomor telepon tidak boleh lebih dari 13 karakter.',
            'no_telepon.min'            => 'Nomor telepon tidak boleh kurang dari 10 karakter.',
            'instansi.required'         => 'Unit Kerja wajib diisi.',
            'jabatan.required'          => 'Jabatan wajib diisi.',
            'alasan.required'           => 'Alasan pengajuan wajib diisi.',
            'surat_permohonan.required' => 'Surat permohonan wajib diunggah.',
            'surat_permohonan.mimes'    => 'Format surat permohonan harus berupa PDF.',
            'surat_permohonan.max'      => 'Ukuran surat permohonan tidak boleh lebih dari 10MB.',
            'surat_rekomendasi.required'=> 'Surat rekomendasi unit kerja wajib diunggah.',
            'surat_rekomendasi.mimes'   => 'Format surat rekomendasi unit kerja harus berupa PDF.',
            'surat_rekomendasi.max'     => 'Ukuran surat rekomendasi unit kerja tidak boleh lebih dari 10MB.',
            'foto_ktp.required'         => 'Foto KTP wajib diunggah.',
            'foto_ktp.mimes'            => 'Format foto KTP harus berupa JPG, JPEG, atau PNG.',
            'foto_ktp.max'              => 'Ukuran foto KTP tidak boleh lebih dari 10MB.',
            'persetujuan.accepted'      => 'Anda harus menyetujui pernyataan ini sebelum mengirim pengajuan.',
        ]);

        // -----------------------------------------------------------
        // STEP 2: UPLOAD FILE DOKUMEN
        // -----------------------------------------------------------
        $suratPermohonanPath = $request->file('surat_permohonan')->store('dokumen/pembaruan/surat_permohonan', 'public');
        $suratRekomendasiPath = $request->file('surat_rekomendasi')->store('dokumen/pembaruan/surat_rekomendasi', 'public');
        $fotoKtpPath = $request->file('foto_ktp')->store('dokumen/pembaruan/foto_ktp', 'public');

        // -----------------------------------------------------------
        // STEP 3: SIMPAN DATA KE DATABASE MYSQL
        // -----------------------------------------------------------
        $pembaruan = Pembaruan::create([
            'nama_lengkap'      => $validated['nama_lengkap'],
            'nik'               => $validated['nik'],
            'nip'               => $validated['nip'],
            'email'             => $validated['email'],
            'no_telepon'        => $validated['no_telepon'],
            'instansi'          => $validated['instansi'],
            'jabatan'           => $validated['jabatan'],
            'alasan'            => $validated['alasan'],
            'surat_permohonan'  => $suratPermohonanPath,
            'surat_rekomendasi' => $suratRekomendasiPath,
            'foto_ktp'          => $fotoKtpPath,
            'status'            => 'Pending',
        ]);

        $waMessage = "Halo Admin, terdapat *PENGAJUAN PEMBARUAN SERTIFIKAT*.\n\n"
            . "📋 *Data Pemohon:*\n"
            . "• Nama Lengkap: " . $validated['nama_lengkap'] . "\n"
            . "• NIK: " . $validated['nik'] . "\n"
            . "• NIP: " . $validated['nip'] . "\n"
            . "• Email: " . $validated['email'] . "\n"
            . "• No HP/WA: " . $validated['no_telepon'] . "\n"
            . "• Unit Kerja: " . $validated['instansi'] . "\n"
            . "• Jabatan: " . $validated['jabatan'] . "\n\n"
            . "📝 *Alasan Pembaruan:*\n" . $validated['alasan'] . "\n\n"
            . "Mohon untuk segera diperiksa dan diverifikasi melalui Dashboard Admin. Terima kasih.";

        $waUrl = 'https://wa.me/6282312293928?text=' . urlencode($waMessage);

        return redirect()->route('home')
            ->with('success', 'Pengajuan pembaruan sertifikat Anda berhasil dikirim! Kami akan segera menghubungi Anda melalui email yang terdaftar.')
            ->with('whatsapp_url', $waUrl);
    }

    /**
     * Memproses dan menyimpan data pertanyaan helpdesk ke database.
     */
    public function storeHelpdesk(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'nip'        => 'required|string|max:18',
            'nik'        => 'required|string|max:16',
            'unit_kerja' => 'required|string|max:255',
            'keterangan' => 'required|string|max:3000',
        ]);

        $helpdesk = Helpdesk::create([
            'nama'       => $validated['nama'],
            'nip'        => $validated['nip'],
            'nik'        => $validated['nik'],
            'unit_kerja' => $validated['unit_kerja'],
            'keterangan' => $validated['keterangan'],
            'status'     => 'Baru',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pertanyaan Helpdesk berhasil disimpan ke database.',
            'data'    => $helpdesk,
        ]);
    }
}
