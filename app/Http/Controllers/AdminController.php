<?php

namespace App\Http\Controllers;

use App\Models\Penerbitan;
use App\Models\Pembaruan;
use App\Models\Helpdesk;
use App\Models\DokumenSyarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return back()->with('success', 'Status pengajuan penerbitan berhasil diubah menjadi: ' . $request->status);
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

        return back()->with('success', 'Status pengajuan pembaruan berhasil diubah menjadi: ' . $request->status);
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

        return back()->with('success', 'Status helpdesk berhasil diubah menjadi: ' . $request->status);
    }

    /**
     * Menghapus entri Helpdesk.
     */
    public function destroyHelpdesk($id)
    {
        $helpdesk = Helpdesk::findOrFail($id);
        $helpdesk->delete();

        return back()->with('success', 'Data pertanyaan helpdesk berhasil dihapus.');
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

        return back()->with('success', 'Dokumen syarat baru berhasil ditambahkan!');
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

        return back()->with('success', 'Dokumen syarat berhasil diperbarui!');
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

        return back()->with('success', 'Dokumen syarat berhasil dihapus.');
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
}
