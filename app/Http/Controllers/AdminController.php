<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * AdminController
 *
 * Mengontrol autentikasi admin (dummy) dan pengelolaan data dashboard admin.
 * Menggunakan data session untuk kelola status agar terasa hidup sebelum database diintegrasikan.
 */
class AdminController extends Controller
{
    /**
     * Menampilkan form Login Admin.
     */
    public function login(Request $request)
    {
        // Jika sudah login, langsung ke dashboard
        if ($request->session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Memproses autentikasi Login Admin (Dummy).
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');

        // Kredensial Dummy
        if ($credentials['email'] === 'admin@sertifikasiel.go.id' && $credentials['password'] === 'admin123') {
            $request->session()->put('admin_logged_in', true);
            $this->initializeMockData($request); // Inisialisasi data laporan pertama kali
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
        $request->session()->forget('admin_logged_in');
        return redirect()->route('home')->with('success', 'Admin berhasil logout.');
    }

    /**
     * Menampilkan Dashboard Utama Admin.
     */
    public function dashboard(Request $request)
    {
        // Cek autentikasi manual
        if (!$request->session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Silakan login terlebih dahulu untuk mengakses dashboard admin.']);
        }

        // Pastikan mock data siap
        $this->initializeMockData($request);

        $penerbitanData = $request->session()->get('admin_penerbitan_data');
        $pembaruanData = $request->session()->get('admin_pembaruan_data');

        return view('admin.dashboard', compact('penerbitanData', 'pembaruanData'));
    }

    /**
     * Mengubah status pengajuan Penerbitan.
     */
    public function updateStatusPenerbitan(Request $request, $id)
    {
        if (!$request->session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak,Pending',
        ]);

        $this->initializeMockData($request);
        $data = $request->session()->get('admin_penerbitan_data');

        foreach ($data as &$item) {
            if ($item['id'] == $id) {
                $item['status'] = $request->status;
                break;
            }
        }

        $request->session()->put('admin_penerbitan_data', $data);

        return back()->with('success', 'Status pengajuan penerbitan berhasil diubah menjadi: ' . $request->status);
    }

    /**
     * Mengubah status pengajuan Pembaruan.
     */
    public function updateStatusPembaruan(Request $request, $id)
    {
        if (!$request->session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak,Pending',
        ]);

        $this->initializeMockData($request);
        $data = $request->session()->get('admin_pembaruan_data');

        foreach ($data as &$item) {
            if ($item['id'] == $id) {
                $item['status'] = $request->status;
                break;
            }
        }

        $request->session()->put('admin_pembaruan_data', $data);

        return back()->with('success', 'Status pengajuan pembaruan berhasil diubah menjadi: ' . $request->status);
    }

    /**
     * Ekspor data Penerbitan ke Excel (format CSV).
     */
    public function exportPenerbitanCSV(Request $request)
    {
        if (!$request->session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $this->initializeMockData($request);
        $data = $request->session()->get('admin_penerbitan_data');

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
                    $row['nama_lengkap'],
                    "\t" . $row['nik'], // Prefiks tab agar Excel tidak merusak format teks angka
                    "\t" . $row['nip'],
                    $row['email'],
                    "\t" . ($row['no_telepon'] ?? '-'),
                    $row['instansi'],
                    $row['jabatan'],
                    $row['alasan'],
                    $row['status'],
                    $row['created_at'],
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Inisialisasi data tiruan di session.
     */
    private function initializeMockData(Request $request)
    {
        if (!$request->session()->has('admin_penerbitan_data')) {
            $request->session()->put('admin_penerbitan_data', [
                [
                    'id' => 1,
                    'nama_lengkap' => 'Ahmad Fauzi',
                    'nik' => '3273012345670001',
                    'nip' => '198503122010011002',
                    'email' => 'ahmad.fauzi@bandung.go.id',
                    'no_telepon' => '081234567801',
                    'instansi' => 'Dinas Komunikasi dan Informatika',
                    'jabatan' => 'Kepala Seksi Infrastruktur Teknologi',
                    'alasan' => 'Dibutuhkan untuk penandatanganan surat keputusan dinas secara elektronik.',
                    'dokumen' => 'surat_rekomendasi_ahmad.pdf',
                    'status' => 'Pending',
                    'created_at' => '2026-07-14 14:32:00',
                ],
                [
                    'id' => 2,
                    'nama_lengkap' => 'Rina Kartika',
                    'nik' => '3273059876540003',
                    'nip' => '199008242015032001',
                    'email' => 'rina.kartika@dinkes.go.id',
                    'no_telepon' => '081234567802',
                    'instansi' => 'Dinas Kesehatan Kota',
                    'jabatan' => 'Kepala Sub Bagian Kepegawaian',
                    'alasan' => 'Penandatanganan elektronik dokumen kepegawaian dan surat izin praktek tenaga kesehatan.',
                    'dokumen' => 'surat_rekomendasi_rina.pdf',
                    'status' => 'Pending',
                    'created_at' => '2026-07-13 09:15:00',
                ],
                [
                    'id' => 3,
                    'nama_lengkap' => 'Budi Santoso',
                    'nik' => '3273024567890002',
                    'nip' => '197811052003121004',
                    'email' => 'budi.santoso@bappeda.go.id',
                    'no_telepon' => '081234567803',
                    'instansi' => 'Badan Perencanaan Pembangunan Daerah',
                    'jabatan' => 'Perencana Ahli Madya',
                    'alasan' => 'Penandatanganan dokumen rencana pembangunan daerah dan evaluasi kerja tahunan.',
                    'dokumen' => 'surat_rekomendasi_budi.pdf',
                    'status' => 'Disetujui',
                    'created_at' => '2026-07-11 11:20:00',
                ],
                [
                    'id' => 4,
                    'nama_lengkap' => 'Siti Aminah',
                    'nik' => '3273091234560004',
                    'nip' => '199304152019082003',
                    'email' => 'siti.aminah@dinsos.go.id',
                    'no_telepon' => '081234567804',
                    'instansi' => 'Dinas Sosial',
                    'jabatan' => 'Pekerja Sosial Ahli Pertama',
                    'alasan' => 'Dibutuhkan untuk penandatanganan surat rekomendasi bantuan sosial daerah.',
                    'dokumen' => 'surat_rekomendasi_siti.pdf',
                    'status' => 'Ditolak',
                    'created_at' => '2026-07-10 16:45:00',
                ],
            ]);
        }

        if (!$request->session()->has('admin_pembaruan_data')) {
            $request->session()->put('admin_pembaruan_data', [
                [
                    'id' => 1,
                    'nama_lengkap' => 'Joko Widodo Susilo',
                    'nik' => '3273019876540005',
                    'email' => 'joko.ws@disdik.go.id',
                    'no_telepon' => '081234567801',
                    'instansi' => 'Dinas Pendidikan',
                    'bukti_sertifikat' => 'rekomendasi_pembaruan_joko.pdf',
                    'status' => 'Pending',
                    'created_at' => '2026-07-14 16:10:00',
                ],
                [
                    'id' => 2,
                    'nama_lengkap' => 'Dewi Lestari',
                    'nik' => '3273051234560007',
                    'email' => 'dewi.lestari@setda.go.id',
                    'no_telepon' => '081234567802',
                    'instansi' => 'Sekretariat Daerah',
                    'bukti_sertifikat' => 'rekomendasi_pembaruan_dewi.pdf',
                    'status' => 'Pending',
                    'created_at' => '2026-07-13 11:30:00',
                ],
                [
                    'id' => 3,
                    'nama_lengkap' => 'Hendri Pratama',
                    'nik' => '3273026543210009',
                    'email' => 'hendri.pratama@dispar.go.id',
                    'no_telepon' => '081234567803',
                    'instansi' => 'Dinas Kebudayaan dan Pariwisata',
                    'bukti_sertifikat' => 'rekomendasi_pembaruan_hendri.pdf',
                    'status' => 'Disetujui',
                    'created_at' => '2026-07-12 10:00:00',
                ],
                [
                    'id' => 4,
                    'nama_lengkap' => 'Bambang Wijaya',
                    'nik' => '3273087654320011',
                    'email' => 'bambang.w@diskop.go.id',
                    'no_telepon' => '081298765432',
                    'instansi' => 'Dinas Koperasi dan UMKM',
                    'bukti_sertifikat' => 'rekomendasi_pembaruan_bambang.pdf',
                    'status' => 'Pending',
                    'created_at' => '2026-07-15 08:30:00',
                ],
            ]);
        } else {
            // Pastikan data dummy Pending baru juga tersimpan pada session yang sedang berjalan
            $existingPembaruan = $request->session()->get('admin_pembaruan_data');
            $hasItem4 = false;
            foreach ($existingPembaruan as $item) {
                if (isset($item['id']) && $item['id'] == 4) {
                    $hasItem4 = true;
                    break;
                }
            }
            if (!$hasItem4) {
                $existingPembaruan[] = [
                    'id' => 4,
                    'nama_lengkap' => 'Bambang Wijaya',
                    'nik' => '3273087654320011',
                    'email' => 'bambang.w@diskop.go.id',
                    'no_telepon' => '081298765432',
                    'instansi' => 'Dinas Koperasi dan UMKM',
                    'bukti_sertifikat' => 'rekomendasi_pembaruan_bambang.pdf',
                    'status' => 'Pending',
                    'created_at' => '2026-07-15 08:30:00',
                ];
                $request->session()->put('admin_pembaruan_data', $existingPembaruan);
            }
        }
    }
}
