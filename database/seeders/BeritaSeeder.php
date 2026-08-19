<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'judul'        => 'Sosialisasi dan Asistensi Penerapan Tanda Tangan Elektronik di Lingkup Pemkab Mamasa',
                'kategori'     => 'Berita',
                'ringkasan'    => 'Dinas Komunikasi Informatika dan Persandian Kabupaten Mamasa menggelar bimbingan teknis integrasi sertifikat elektronik bagi seluruh OPD.',
                'konten'       => "Dinas Komunikasi Informatika dan Persandian Kabupaten Mamasa secara berkelanjutan melaksanakan pendampingan teknis dan asistensi penerbitan Sertifikat Elektronik bagi Aparatur Sipil Negara (ASN) di seluruh Organisasi Perangkat Daerah (OPD).\n\nKegiatan ini bertujuan untuk mempercepat transformasi digital tata kelola pemerintahan, memastikan validitas dokumen kedinasan, serta meningkatkan efisiensi dan keamanan administrasi birokrasi di Kabupaten Mamasa sesuai standar Balai Sertifikasi Elektronik (BSrE) BSSN.",
                'penulis'      => 'Admin Diskominfo Mamasa',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2)->format('Y-m-d'),
            ],
            [
                'judul'        => 'Pemberitahuan Prosedur Pembaruan Masa Berlaku Sertifikat Elektronik ASN',
                'kategori'     => 'Pengumuman',
                'ringkasan'    => 'Bagi ASN pemegang sertifikat elektronik yang masa berlakunya akan berakhir, diimbau untuk segera mengajukan permohonan pembaruan.',
                'konten'       => "Diberitahukan kepada seluruh Pejabat Struktural dan Fungsional di lingkungan Pemerintah Kabupaten Mamasa pemegang Sertifikat Elektronik bahwa masa berlaku sertifikat elektronik adalah 2 (dua) tahun sejak tanggal penerbitan.\n\nUntuk menghindari kendala dalam penandatanganan dokumen kedinasan digital, pemohon diharapkan mengajukan permohonan pembaruan paling lambat 30 hari sebelum masa berlaku habis melalui portal resmi ini pada menu Formulir Pembaruan.",
                'penulis'      => 'Admin Diskominfo Mamasa',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5)->format('Y-m-d'),
            ],
            [
                'judul'        => 'Peningkatan Keamanan Dokumen Administrasi Pemerintahan Berbasis Digital',
                'kategori'     => 'Berita',
                'ringkasan'    => 'Pemerintah Kabupaten Mamasa terus memperkuat implementasi Sistem Pemerintahan Berbasis Elektronik (SPBE) melalui pemanfaatan sertifikat elektronik resmi.',
                'konten'       => "Pemanfaatan tanda tangan elektronik tersertifikasi menjamin aspek kerahasiaan, keaslian (autentisitas), dan nir-penyangkalan (non-repudiation) pada dokumen naskah dinas elektronik.\n\nKepala Dinas Komunikasi Informatika dan Persandian Kabupaten Mamasa mengimbau seluruh instansi agar aktif memanfaatkan layanan sertifikasi elektronik dalam proses surat-menyurat dan pelayanan publik guna mewujudkan tata kelola pemerintahan yang bersih, transparan, dan akuntabel.",
                'penulis'      => 'Admin Diskominfo Mamasa',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10)->format('Y-m-d'),
            ],
            [
                'judul'        => 'Jadwal Pemeliharaan Sistem dan Layanan Verifikasi Berkas Pengajuan',
                'kategori'     => 'Pengumuman',
                'ringkasan'    => 'Informasi jadwal operasional verifikasi berkas dan penanganan helpdesk layanan sertifikasi elektronik.',
                'konten'       => "Layanan verifikasi berkas pengajuan Penerbitan dan Pembaruan Sertifikat Elektronik dilayani pada hari kerja (Senin - Jumat, pukul 08.00 - 16.00 WITA).\n\nPengajuan yang masuk di luar jam kerja atau hari libur akan diverifikasi pada hari kerja berikutnya. Apabila terdapat pertanyaan atau kendala teknis, pemohon dapat mengirimkan pertanyaan melalui formulir Helpdesk atau menghubungi kontak resmi Diskominfo Mamasa.",
                'penulis'      => 'Admin Diskominfo Mamasa',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(14)->format('Y-m-d'),
            ],
        ];

        foreach ($items as $item) {
            $slug = Str::slug($item['judul']);
            Berita::updateOrCreate(
                ['slug' => $slug],
                [
                    'judul'        => $item['judul'],
                    'kategori'     => $item['kategori'],
                    'ringkasan'    => $item['ringkasan'],
                    'konten'       => $item['konten'],
                    'penulis'      => $item['penulis'],
                    'is_published' => $item['is_published'],
                    'published_at' => $item['published_at'],
                ]
            );
        }
    }
}
