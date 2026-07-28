<?php

namespace App\Http\Controllers;

use App\Models\Penerbitan;
use App\Models\Pembaruan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (!Auth::check()) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Silakan login terlebih dahulu untuk mengakses dashboard admin.']);
        }

        $penerbitanData = Penerbitan::latest()->get();
        $pembaruanData  = Pembaruan::latest()->get();

        // Total metrik utama real
        $totalPenerbitan = $penerbitanData->count();
        $totalPembaruan  = $pembaruanData->count();
        $totalSelesai    = $penerbitanData->where('status', 'Disetujui')->count() + $pembaruanData->where('status', 'Disetujui')->count();

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
            'statusDisetujui'   => $statusDisetujui,
            'statusPending'     => $statusPending,
            'statusDitolak'     => $statusDitolak,
            'monthlyPenerbitan' => $monthlyPenerbitan,
            'monthlyPembaruan'  => $monthlyPembaruan,
            'currentYear'       => $currentYear,
        ];

        return view('admin.dashboard', compact('penerbitanData', 'pembaruanData', 'stats'));
    }

    /**
     * Mengubah status pengajuan Penerbitan pada database MySQL.
     */
    public function updateStatusPenerbitan(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

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
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak,Pending',
        ]);

        $pembaruan = Pembaruan::findOrFail($id);
        $pembaruan->update(['status' => $request->status]);

        return back()->with('success', 'Status pengajuan pembaruan berhasil diubah menjadi: ' . $request->status);
    }

    /**
     * Ekspor data Penerbitan dari database MySQL ke Excel (format CSV).
     */
    public function exportPenerbitanCSV()
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

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
            fputcsv($file, ['No', 'Nama Lengkap', 'NIK', 'NIP', 'Email', 'No Telepon', 'Instansi', 'Jabatan', 'Alasan', 'Status', 'Tanggal Pengajuan']);

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
                    $row->status,
                    $row->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
