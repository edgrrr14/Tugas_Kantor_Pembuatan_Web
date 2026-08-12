<?php

namespace App\Http\Controllers;

use App\Models\Penerbitan;
use App\Models\Pembaruan;
use App\Models\Helpdesk;
use App\Models\DokumenSyarat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * AdminController
 *
 * Mengontrol autentikasi admin dan pengelolaan data dashboard admin via Database MySQL.
 */
class AdminController extends Controller
{
    /**
     * Menampilkan form Login Admin.
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Memproses autentikasi Login Admin menggunakan database MySQL.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success_auth', 'Selamat datang kembali, Admin!');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['login_error' => 'Email atau password admin salah!']);
    }

    /**
     * Memproses Logout Admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Admin berhasil logout.');
    }

    /**
     * Menampilkan Dashboard Utama Admin dengan Data Real dari MySQL.
     */
    public function dashboard()
    {
        $penerbitanData    = Penerbitan::latest()->get();
        $pembaruanData     = Pembaruan::latest()->get();
        $helpdeskData      = Helpdesk::latest()->get();
        $dokumenSyaratData = DokumenSyarat::latest()->get();

        // Total metrik utama real
        $totalPenerbitan = $penerbitanData->count();
        $totalPembaruan  = $pembaruanData->count();
        $totalSelesai    = $penerbitanData->where('status', 'Disetujui')->count() + $pembaruanData->where('status', 'Disetujui')->count();

        // Helpdesk Stats
        $totalHelpdesk   = $helpdeskData->count();
        $helpdeskHariIni = Helpdesk::whereDate('created_at', date('Y-m-d'))->count();
        $helpdeskBaru    = $helpdeskData->where('status', 'Baru')->count();

        // Distribusi Status Real
        $statusDisetujui = $totalSelesai;
        $statusPending   = $penerbitanData->where('status', 'Pending')->count() + $pembaruanData->where('status', 'Pending')->count();
        $statusDitolak   = $penerbitanData->where('status', 'Ditolak')->count() + $pembaruanData->where('status', 'Ditolak')->count();

        // Hitung data tren per bulan (Jan - Des) tahun berjalan dari database MySQL
        $currentYear = (int) date('Y');
        $monthlyPenerbitan = [];
        $monthlyPembaruan  = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyPenerbitan[] = Penerbitan::whereYear('created_at', $currentYear)->whereMonth('created_at', $m)->count();
            $monthlyPembaruan[]  = Pembaruan::whereYear('created_at', $currentYear)->whereMonth('created_at', $m)->count();
        }

        $stats = [
            'totalPenerbitan'   => $totalPenerbitan,
            'totalPembaruan'    => $totalPembaruan,
            'totalSelesai'      => $totalSelesai,
            'totalHelpdesk'     => $totalHelpdesk,
            'helpdeskHariIni'   => $helpdeskHariIni,
            'helpdeskBaru'      => $helpdeskBaru,
            'statusDisetujui'   => $statusDisetujui,
            'statusPending'     => $statusPending,
            'statusDitolak'     => $statusDitolak,
            'monthlyPenerbitan' => $monthlyPenerbitan,
            'monthlyPembaruan'  => $monthlyPembaruan,
            'currentYear'       => $currentYear,
        ];

        return view('admin.dashboard', compact('penerbitanData', 'pembaruanData', 'helpdeskData', 'dokumenSyaratData', 'stats'));
    }

    /**
     * Mengubah status pengajuan Penerbitan pada database MySQL.
     */
    public function updateStatusPenerbitan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak,Pending',
        ]);

        $penerbitan = Penerbitan::findOrFail($id);
        $penerbitan->update(['status' => $request->status]);

        return back()->with('active_tab', 'penerbitan')->with('success', 'Status pengajuan penerbitan berhasil diubah menjadi: ' . $request->status);
    }

    /**
     * Mengubah status pengajuan Pembaruan pada database MySQL.
     */
    public function updateStatusPembaruan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak,Pending',
        ]);

        $pembaruan = Pembaruan::findOrFail($id);
        $pembaruan->update(['status' => $request->status]);

        return back()->with('active_tab', 'pembaruan')->with('success', 'Status pengajuan pembaruan berhasil diubah menjadi: ' . $request->status);
    }

    /**
     * Mengubah status entri Helpdesk pada database MySQL.
     */
    public function updateStatusHelpdesk(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Baru,Sudah Direspons,Selesai',
        ]);

        $helpdesk = Helpdesk::findOrFail($id);
        $helpdesk->update(['status' => $request->status]);

        return back()->with('active_tab', 'helpdesk')->with('success', 'Status helpdesk berhasil diubah menjadi: ' . $request->status);
    }

    /**
     * Menghapus entri Helpdesk.
     */
    public function destroyHelpdesk($id)
    {
        $helpdesk = Helpdesk::findOrFail($id);
        $helpdesk->delete();

        return back()->with('active_tab', 'helpdesk')->with('success', 'Data pertanyaan helpdesk berhasil dihapus.');
    }

    // =============================================================
    // KELOLA DOKUMEN SYARAT (PENERBITAN & PEMBARUAN)
    // =============================================================

    /**
     * Menyimpan Dokumen Syarat Baru (Upload File Templat Syarat).
     */
    public function storeDokumenSyarat(Request $request)
    {
        $request->validate([
            'kategori'     => 'required|in:penerbitan,pembaruan',
            'nama_dokumen' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string|max:1000',
            'file_dokumen' => 'required|file|mimes:docx,doc,pdf,zip,rar|max:10240',
        ], [
            'kategori.required'     => 'Kategori dokumen wajib dipilih.',
            'nama_dokumen.required' => 'Nama dokumen wajib diisi.',
            'file_dokumen.required' => 'File dokumen wajib diunggah.',
            'file_dokumen.mimes'    => 'Format file harus berupa DOCX, DOC, PDF, ZIP, atau RAR.',
            'file_dokumen.max'      => 'Ukuran file tidak boleh lebih dari 10MB.',
        ]);

        $file = $request->file('file_dokumen');
        $filePath = $file->store('dokumen_syarat', 'public');
        $tipeFile = strtolower($file->getClientOriginalExtension());

        DokumenSyarat::create([
            'kategori'     => $request->kategori,
            'nama_dokumen' => $request->nama_dokumen,
            'deskripsi'    => $request->deskripsi,
            'file_path'    => $filePath,
            'tipe_file'    => $tipeFile,
        ]);

        return back()->with('active_tab', 'dokumen_syarat')->with('success', 'Dokumen syarat baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui Dokumen Syarat yang Sudah Ada.
     */
    public function updateDokumenSyarat(Request $request, $id)
    {
        $dokumen = DokumenSyarat::findOrFail($id);

        $request->validate([
            'kategori'     => 'required|in:penerbitan,pembaruan',
            'nama_dokumen' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string|max:1000',
            'file_dokumen' => 'nullable|file|mimes:docx,doc,pdf,zip,rar|max:10240',
        ], [
            'kategori.required'     => 'Kategori dokumen wajib dipilih.',
            'nama_dokumen.required' => 'Nama dokumen wajib diisi.',
            'file_dokumen.mimes'    => 'Format file harus berupa DOCX, DOC, PDF, ZIP, atau RAR.',
            'file_dokumen.max'      => 'Ukuran file tidak boleh lebih dari 10MB.',
        ]);

        $updateData = [
            'kategori'     => $request->kategori,
            'nama_dokumen' => $request->nama_dokumen,
            'deskripsi'    => $request->deskripsi,
        ];

        if ($request->hasFile('file_dokumen')) {
            // Hapus file lama jika disimpan di storage public
            if ($dokumen->file_path && !str_starts_with($dokumen->file_path, 'templates/')) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file_dokumen');
            $filePath = $file->store('dokumen_syarat', 'public');
            $tipeFile = strtolower($file->getClientOriginalExtension());

            $updateData['file_path'] = $filePath;
            $updateData['tipe_file'] = $tipeFile;
        }

        $dokumen->update($updateData);

        return back()->with('active_tab', 'dokumen_syarat')->with('success', 'Dokumen syarat berhasil diperbarui!');
    }

    /**
     * Menghapus Dokumen Syarat.
     */
    public function destroyDokumenSyarat($id)
    {
        $dokumen = DokumenSyarat::findOrFail($id);

        if ($dokumen->file_path && !str_starts_with($dokumen->file_path, 'templates/')) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return back()->with('active_tab', 'dokumen_syarat')->with('success', 'Dokumen syarat berhasil dihapus.');
    }

    /**
     * Ekspor data Penerbitan dari database MySQL ke Excel (format CSV).
     */
    public function exportPenerbitanCSV()
    {
        $data = Penerbitan::latest()->get();

        $filename = 'laporan_penerbitan_sertifikat_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM untuk kompatibilitas Excel Bahasa Indonesia
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Judul Kolom
            fputcsv($file, ['No', 'Nama Lengkap', 'NIK', 'NIP', 'Email', 'No Telepon', 'Unit Kerja', 'Jabatan', 'Alasan', 'Surat Permohonan', 'Surat Rekomendasi', 'Foto KTP', 'Status', 'Tanggal Pengajuan']);

            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->nama_lengkap,
                    "\t" . $row->nik, // Prefiks tab agar Excel tidak merusak format teks angka
                    "\t" . $row->nip,
                    $row->email,
                    "\t" . ($row->no_telepon ?? '-'),
                    $row->instansi,
                    $row->jabatan,
                    $row->alasan,
                    $row->surat_permohonan ? asset('storage/' . $row->surat_permohonan) : ($row->dokumen ? asset('storage/' . $row->dokumen) : '-'),
                    $row->surat_rekomendasi ? asset('storage/' . $row->surat_rekomendasi) : '-',
                    $row->foto_ktp ? asset('storage/' . $row->foto_ktp) : '-',
                    $row->status,
                    $row->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Ekspor data Pembaruan dari database MySQL ke Excel (format CSV).
     */
    public function exportPembaruanCSV()
    {
        $data = Pembaruan::latest()->get();

        $filename = 'laporan_pembaruan_sertifikat_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM untuk kompatibilitas Excel Bahasa Indonesia
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Judul Kolom
            fputcsv($file, ['No', 'Nama Lengkap', 'NIK', 'NIP', 'Email', 'No Telepon', 'Unit Kerja', 'Jabatan', 'Alasan Pengajuan', 'Surat Permohonan', 'Surat Rekomendasi', 'Foto KTP', 'Status', 'Tanggal Pengajuan']);

            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->nama_lengkap,
                    "\t" . ($row->nik ?? '-'),
                    "\t" . ($row->nip ?? '-'),
                    $row->email,
                    "\t" . ($row->no_telepon ?? '-'),
                    $row->instansi ?? '-',
                    $row->jabatan ?? '-',
                    $row->alasan ?? '-',
                    $row->surat_permohonan ? asset('storage/' . $row->surat_permohonan) : '-',
                    $row->surat_rekomendasi ? asset('storage/' . $row->surat_rekomendasi) : '-',
                    $row->foto_ktp ? asset('storage/' . $row->foto_ktp) : '-',
                    $row->status,
                    $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Ekspor data Helpdesk dari database MySQL ke Excel (format CSV).
     */
    public function exportHelpdeskCSV()
    {
        $data = Helpdesk::latest()->get();

        $filename = 'laporan_pertanyaan_helpdesk_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM untuk kompatibilitas Excel Bahasa Indonesia
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Judul Kolom
            fputcsv($file, ['No', 'Nama Pemohon', 'NIP', 'NIK', 'Unit Kerja / OPD', 'Pertanyaan / Keterangan', 'Status', 'Tanggal Masuk']);

            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->nama,
                    "\t" . $row->nip,
                    "\t" . $row->nik,
                    $row->unit_kerja,
                    $row->keterangan,
                    $row->status,
                    $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Memproses penggantian password akun Admin.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => [
                'required',
                'string',
                'min:8',
                'max:12',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#^()_+\-=\[\]{};\':"\\\\|,.<>\/?]/',
                'confirmed',
            ],
        ], [
            'password_lama.required'  => 'Password lama wajib diisi.',
            'password_baru.required'  => 'Password baru wajib diisi.',
            'password_baru.min'       => 'Password baru minimal harus 8 karakter.',
            'password_baru.max'       => 'Password baru maksimal 12 karakter.',
            'password_baru.regex'     => 'Password baru wajib berupa kombinasi huruf besar (A-Z), huruf kecil (a-z), angka (0-9), dan simbol/karakter khusus (misal: @, !, #, $, %).',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama yang Anda masukkan tidak sesuai!']);
        }

        $user->update([
            'password' => Hash::make($request->password_baru),
        ]);

        return back()->with('success', 'Password akun Administrator berhasil diperbarui! Gunakan password baru untuk login berikutnya.');
    }

    // =============================================================
    // FITUR LUPA PASSWORD ADMIN VIA OTP WHATSAPP
    // =============================================================

    /**
     * Menampilkan Form Step 1: Request OTP Lupa Password.
     */
    public function showForgotPassword()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.lupa-password', ['step' => 1]);
    }

    /**
     * Memproses permintaan Kode OTP & Membuat URL Pengiriman ke WhatsApp Admin.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.exists'   => 'Alamat email admin tidak terdaftar dalam sistem.',
        ]);

        // Generate 6 digit angka OTP acak
        $otpCode = (string) random_int(100000, 999999);

        // Simpan/Replace data OTP di database MySQL (kadaluarsa 5 menit)
        DB::table('admin_password_otps')->where('email', $request->email)->delete();
        DB::table('admin_password_otps')->insert([
            'email'       => $request->email,
            'otp_code'    => $otpCode,
            'expires_at'  => Carbon::now()->addMinutes(5),
            'is_verified' => false,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        // Nomor WA Admin Helpdesk resmi
        $adminWaNumber = '6282312293928';

        // Format Pesan WhatsApp OTP
        $waMessage = "Halo Admin, berikut adalah *Kode OTP Reset Password* akun Administrator Sertifikasi Elektronik Kabupaten Mamasa:\n\n"
            . "🔑 *KODE OTP: {$otpCode}*\n\n"
            . "⚠️ Kode ini berlaku selama *5 menit*. Mohon jangan bagikan kode ini kepada siapa pun.";

        $waUrl = 'https://wa.me/' . $adminWaNumber . '?text=' . urlencode($waMessage);

        // Simpan state di session
        session([
            'reset_email' => $request->email,
            'wa_otp_url'  => $waUrl,
            'otp_sent'    => true,
        ]);

        return redirect()->route('admin.verify_otp_view')
            ->with('success', 'Kode OTP 6-digit telah dibuat! Silakan klik tombol "Buka WhatsApp Admin" untuk menerima kode.');
    }

    /**
     * Menampilkan Form Step 2: Verifikasi Kode OTP.
     */
    public function showVerifyOtp()
    {
        if (!session('reset_email')) {
            return redirect()->route('admin.forgot_password')->withErrors(['email' => 'Silakan masukkan email Anda terlebih dahulu.']);
        }

        return view('admin.lupa-password', ['step' => 2, 'email' => session('reset_email')]);
    }

    /**
     * Memvalidasi Kode OTP 6-digit.
     */
    public function verifyOtp(Request $request)
    {
        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('admin.forgot_password');
        }

        $request->validate([
            'otp_code' => 'required|string|size:6',
        ], [
            'otp_code.required' => 'Kode OTP 6-digit wajib diisi.',
            'otp_code.size'     => 'Kode OTP harus terdiri dari 6 digit angka.',
        ]);

        $otpRecord = DB::table('admin_password_otps')
            ->where('email', $email)
            ->where('is_verified', false)
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp_error' => 'Kode OTP tidak ditemukan atau sudah pernah digunakan. Silakan minta OTP baru.']);
        }

        if (Carbon::now()->isAfter($otpRecord->expires_at)) {
            return back()->withErrors(['otp_error' => 'Kode OTP telah kadaluarsa (lebih dari 5 menit). Silakan klik "Kirim Ulang OTP".']);
        }

        if ($otpRecord->otp_code !== trim($request->otp_code)) {
            return back()->withErrors(['otp_error' => 'Kode OTP 6-digit yang Anda masukkan salah. Periksa kembali WhatsApp Admin.']);
        }

        // OTP Valid -> Tandai terverifikasi
        DB::table('admin_password_otps')
            ->where('id', $otpRecord->id)
            ->update([
                'is_verified' => true,
                'updated_at'  => Carbon::now(),
            ]);

        session(['otp_verified' => true]);

        return redirect()->route('admin.reset_password_view')
            ->with('success', 'Verifikasi OTP Berhasil! Silakan buat password baru untuk akun Administrator Anda.');
    }

    /**
     * Menampilkan Form Step 3: Input Password Baru.
     */
    public function showResetPassword()
    {
        if (!session('reset_email') || !session('otp_verified')) {
            return redirect()->route('admin.forgot_password')->withErrors(['email' => 'Sesi verifikasi telah berakhir. Silakan ulangi proses dari awal.']);
        }

        return view('admin.lupa-password', ['step' => 3, 'email' => session('reset_email')]);
    }

    /**
     * Memproses Pengubahan Password Baru setelah OTP terverifikasi.
     */
    public function resetPassword(Request $request)
    {
        $email = session('reset_email');
        if (!$email || !session('otp_verified')) {
            return redirect()->route('admin.forgot_password');
        }

        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'max:12',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#^()_+\-=\[\]{};\':"\\\\|,.<>\/?]/',
                'confirmed',
            ],
        ], [
            'password.required'  => 'Password baru wajib diisi.',
            'password.min'       => 'Password baru minimal 8 karakter.',
            'password.max'       => 'Password baru maksimal 12 karakter.',
            'password.regex'     => 'Password baru wajib kombinasi huruf besar (A-Z), huruf kecil (a-z), angka (0-9), dan simbol/karakter khusus.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('admin.forgot_password')->withErrors(['email' => 'Akun admin tidak ditemukan.']);
        }

        // Update password baru di database
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus data OTP dan sesi
        DB::table('admin_password_otps')->where('email', $email)->delete();
        session()->forget(['reset_email', 'otp_verified', 'wa_otp_url', 'otp_sent']);

        return redirect()->route('admin.login')
            ->with('success_auth', 'Password Admin berhasil di-reset! Silakan masuk menggunakan password baru Anda.');
    }
}
