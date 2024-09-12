<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 595px;
            /* A4 size width in pixels */
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .address {
            font-size: 16px;
            text-align: left;
            margin-bottom: 20px;
        }

        .subtitle {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .employee-data {
            margin-bottom: 20px;
        }

        .employee-data p {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .info-data p strong {
            width: 120px;
            margin-right: 10px;
        }

        .info-data p span {
            flex-grow: 1;
        }

        .employee-data p strong {
            width: 400px;
        }

        .employee-data p span {
            flex-grow: 1;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .signature p {
            margin: 0;
        }

        .signature p span {
            font-weight: bold;
        }

        .text-red {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="company-name">HUMAN RESOURCE MANAGEMENT SYSTEM</h1>
        </div>
        <br>
        <br>

        @php
            $total = 0;
        @endphp
        @foreach ($datas as $data)
            @if ($data)
                <div class="subtitle">Slip Gaji Karyawan</div>
                <hr>

                <div class="employee-data">
                    <p><strong>Bulan</strong> <span style="margin-left: 190px">:&nbsp;&nbsp; {{ strtoupper(Fungsi::bulanindo($month)) }}
                            {{ $year }}</span></p>
                    <p><strong>Nama</strong> <span style="margin-left: 191px">:&nbsp;&nbsp;
                            {{ $data->pegawai ? $data->pegawai->nama : 'Data tidak ditemukan' }}</span></p>
                    <p><strong>Jabatan</strong> <span style="margin-left: 175px">:&nbsp;&nbsp; {{ $data->nama_jabatan }}
                            {{ $data->nama_bagian }}</span></p>
                    <p><strong>Gaji Pokok</strong> <span style="margin-left: 153px">:&nbsp;&nbsp;
                            {{ formatRupiah($data->pegawai->gaji_pokok) }}</span></p>
                    <p><strong>Tunjangan</strong> <span style="margin-left: 155px">:&nbsp;&nbsp;
                            {{ formatRupiah($data->pegawai->tunjangan) }}</span></p>
                    @php
                        $jumlah = 0;
                        $jumlah = $data->pegawai->gaji_pokok + $data->pegawai->tunjangan;
                        $total += $jumlah;
                    @endphp
                    <p><strong class="text-red">BPJS</strong><span style="margin-left: 200px">:&nbsp;&nbsp;</span><span class="text-red"> - {{ formatRupiah($data->bpjs) }}</span></p>
                    <p style="margin-left: 242px;"><span>:&nbsp;&nbsp;
                            @php
                                $hasil = '-';
                                $bpjs = $jumlah;
                                if ($data->bpjs > 0) {
                                    $bpjs = $jumlah - $data->bpjs;
                                    $hasil = formatRupiah($bpjs);
                                }
                            @endphp
                            {{ $hasil }}
                        </span>
                    </p>
                    <p><strong class="text-red">Pajak</strong><span style="margin-left: 200px">:&nbsp;&nbsp;</span><span class="text-red"> - {{ formatRupiah($data->pajak) }}</span></p>
                    <p style="margin-left: 242px;"><span>:&nbsp;&nbsp;
                            @php
                                $hasil = '-';
                                if ($data->pajak > 0) {
                                    $hasil = formatRupiah($bpjs - $data->pajak);
                                }
                            @endphp
                            {{ $hasil }}
                        </span>
                    </p>
                    <br>
                    <hr>
                    <p><strong>Diterima</strong> <span style="margin-left: 175px">:&nbsp;&nbsp;<strong>{{ formatRupiah($data->pegawai->gaji_pokok + $data->pegawai->tunjangan - $data->bpjs - $data->pajak) }}</strong></span></p>
                </div>
            @else
                <p>Data payroll tidak ditemukan.</p>
            @endif
        @endforeach

        <div class="footer">
            <div class="signature">
                <p>
                    Dibuat oleh,<br><br><br><br><br>
                    <span>Admin Keuangan</span>
                </p>
                <p>
                    Mengetahui,<br><br><br><br><br>
                    <span>Atasan</span>
                </p>
            </div>
            <br><br><br><br>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
