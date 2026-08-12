<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pertanyaan Helpdesk</title>
    <style>
        @page {
            margin: 1.5cm 1.5cm 1.5cm 1.5cm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            line-height: 1.4;
        }
        /* Kop Surat Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #0f172a;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header-table td {
            vertical-align: middle;
        }
        .logo {
            width: 70px;
            height: auto;
        }
        .header-text {
            text-align: center;
        }
        .header-text h3 {
            margin: 0;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            color: #0f172a;
            letter-spacing: 0.5px;
        }
        .header-text h2 {
            margin: 2px 0;
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
            color: #047857;
            letter-spacing: 0.5px;
        }
        .header-text p {
            margin: 2px 0 0 0;
            font-size: 9px;
            color: #475569;
        }

        /* Judul Laporan */
        .report-title {
            text-align: center;
            margin-bottom: 15px;
        }
        .report-title h1 {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            color: #0f172a;
            margin: 0 0 4px 0;
            text-decoration: underline;
        }
        .report-title p {
            font-size: 10px;
            color: #64748b;
            margin: 0;
        }

        /* Ringkasan Metadata */
        .meta-summary {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        .meta-summary td {
            font-size: 10px;
            padding: 4px 8px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .meta-summary strong {
            color: #0f172a;
        }

        /* Tabel Data Full */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th {
            background-color: #047857;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 6px;
            border: 1px solid #047857;
            text-align: left;
        }
        .data-table th.center {
            text-align: center;
        }
        .data-table td {
            font-size: 9.5px;
            padding: 7px 6px;
            border: 1px solid #cbd5e1;
            vertical-align: top;
        }
        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .data-table td.center {
            text-align: center;
        }

        /* Status Badge */
        .badge {
            display: inline-block;
            padding: 3px 7px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 4px;
            text-align: center;
        }
        .badge-baru {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }
        .badge-direspons {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        .badge-selesai {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        /* Tanda Tangan */
        .ttd-container {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .ttd-right {
            float: right;
            width: 230px;
            text-align: center;
        }
        .ttd-space {
            height: 55px;
        }
    </style>
</head>
<body>

    {{-- Kop Surat Header --}}
    <table class="header-table">
        <tr>
            <td style="width: 12%; text-align: center;">
                @if(file_exists(public_path('images/logo-mamasa.png')))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-mamasa.png'))) }}" class="logo" alt="Logo Mamasa">
                @endif
            </td>
            <td class="header-text" style="width: 88%;">
                <h3>PEMERINTAH KABUPATEN MAMASA</h3>
                <h2>DINAS KOMUNIKASI, INFORMATIKA, PERSANDIAN DAN STATISTIK</h2>
                <p>Jl. Poros Mamasa - Polewali, Kompleks Perkantoran Bupati Mamasa, Sulawesi Barat</p>
                <p>Website: sertifikasi.mamasakab.go.id | Email: kominfo@mamasakab.go.id</p>
            </td>
        </tr>
    </table>

    {{-- Judul Laporan --}}
    <div class="report-title">
        <h1>LAPORAN PERTANYAAN & KONSULTASI HELPDESK</h1>
        <p>Tanggal Cetak: {{ date('d F Y H:i:s') }} WITA | Dicetak Oleh: Admin Portal</p>
    </div>

    {{-- Ringkasan Metadata --}}
    <table class="meta-summary">
        <tr>
            <td><strong>Total Pertanyaan:</strong> {{ $data->count() }} Data</td>
            <td><strong>Baru:</strong> {{ $data->where('status', 'Baru')->count() }}</td>
            <td><strong>Direspons:</strong> {{ $data->where('status', 'Sudah Direspons')->count() }}</td>
            <td><strong>Selesai:</strong> {{ $data->where('status', 'Selesai')->count() }}</td>
        </tr>
    </table>

    {{-- Tabel Data Full --}}
    <table class="data-table">
        <thead>
            <tr>
                <th class="center" style="width: 4%;">No</th>
                <th style="width: 18%;">Nama Pemohon</th>
                <th style="width: 18%;">NIP / NIK</th>
                <th style="width: 20%;">Unit Kerja / OPD</th>
                <th style="width: 23%;">Pertanyaan / Keterangan Kendala</th>
                <th class="center" style="width: 8%;">Status</th>
                <th class="center" style="width: 9%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $row)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td><strong>{{ $row->nama }}</strong></td>
                <td>
                    NIP: {{ $row->nip ?? '-' }}<br>
                    NIK: {{ $row->nik ?? '-' }}
                </td>
                <td><strong>{{ $row->unit_kerja ?? '-' }}</strong></td>
                <td>{{ $row->keterangan ?? '-' }}</td>
                <td class="center">
                    @if($row->status === 'Selesai')
                        <span class="badge badge-selesai">Selesai</span>
                    @elseif($row->status === 'Sudah Direspons')
                        <span class="badge badge-direspons">Direspons</span>
                    @else
                        <span class="badge badge-baru">Baru</span>
                    @endif
                </td>
                <td class="center">{{ $row->created_at ? $row->created_at->format('d/m/Y H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="center" style="padding: 20px; color: #94a3b8;">Tidak ada data pertanyaan helpdesk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tanda Tangan Admin --}}
    <div class="ttd-container">
        <div class="ttd-right">
            <p>Mamasa, {{ date('d F Y') }}</p>
            <p><strong>Admin Pengelola Sertifikasi</strong></p>
            <div class="ttd-space"></div>
            <p><u><strong>ADMIN DISKOMINFO MAMASA</strong></u></p>
            <p style="font-size: 8.5px; color: #64748b;">NIP. 19850412 201001 1 012</p>
        </div>
        <div style="clear: both;"></div>
    </div>

</body>
</html>
