<main>
    <style>
        html {
            font-size: 15px;
        }

        body {
            font-family: sans-serif;
            font-size: 1em;
            line-height: 1.4;
            color: #444;
        }

        main {
            max-width: 1000px;
            margin: 0 auto;
        }

        .table-wrapper {
            overflow: auto;
        }

        .text-center {
            text-align: center;
        }

        .table-siswa,
        .table-date {
            border-collapse: collapse;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .table-siswa td {
            border: 1px solid silver;
            position: relative;
            padding: 5px;
        }

        .td-date .date {
            display: inline-block;
            width: 25px;
        }

        .label-checkbox {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 100%;
            display: block;
            /* vertical-align: middle; */
            background: #cecece;
        }

        .label-checkbox:hover {
            background: #bff8ff;
        }

        .label-checkbox input {
            margin: 0;
            -webkit-appearance: none;
            height: 100%;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            width: 100%;
            border: 0;
            cursor: pointer;
            outline: none;
        }

        .label-checkbox.active,
        .label-checkbox.active input,
        .label-checkbox input:checked {
            background: #2196F3;
        }

        .label-checkbox.active::before {
            content: "✓";
            display: block;
            position: absolute;
            z-index: 5;
            color: #fff;
            top: 15%;
            left: 35%;
        }


        .box-color {
            display: inline-block;
            width: 1em;
            height: 1em;
            vertical-align: middle;
        }

        .box-color.pending {
            background: #FF8C00;
        }

        .box-color.approve {
            background: #3CB371;
        }

        .box-color.rejected {
            background: #B22222;
        }
    </style>

    <br><br>

    <h2 class="text-center">
        Laporan Pembayaran Upah<br>
        Berdasarkan Data Keseluruhan
    </h2>
    <br>

    <div class="table-wrapper">

        <table class="table-siswa">
            <thead>
                <tr>
                    <td>No.</td>
                    <td>
                        <center>Date
                    </td>
                    <td>
                        <center>Transaction ID
                    </td>
                    <td>
                        <center>QR Code
                    </td>
                    <td>
                        <center>Employee
                    </td>
                    <td>
                        <center>Total
                    </td>
                    <td>
                        <center>Time
                    </td>
                </tr>
            </thead>
            <tbody class="table-body-content">
                @foreach ($payroll as $row)
                    <?php
                    // Potongan Alpha
                    $alfa = ($row->pegawai->jabatan->gaji_pokok / 26) * $row->alpha;
                    
                    $gaji = $row->pegawai->jabatan->gaji_pokok;
                    $tunjangan = $row->pegawai->jabatan->tunjangan;
                    
                    // penghasilan bruto setahun
                    $bruto_setahun = $gaji + $tunjangan * 12;
                    
                    // dikurangi biaya jabatan
                    $jabatan = 0.05 * $bruto_setahun;
                    
                    $netto = $bruto_setahun - $jabatan;
                    
                    $pkp = 54000000 - $netto;
                    
                    $lapis_pertama = 0.05 * 50000000;
                    
                    $pph = $lapis_pertama / 12;
                    ?>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <center>{{ date('F d, Y', strtotime($row->tgl_payroll)) }}
                        </td>
                        <td>
                            <center>{{ $row->kode_payroll }}
                        </td>
                        <td>
                            <center><img src="{{ asset('storage/admin/qr_code/' . $row->qr_code) }}" width="80">
                        </td>
                        <td>
                            <center>{{ $row->pegawai->nama }}
                        </td>
                        <td>
                            <center><b>Rp.
                                    {{ number_format($row->pegawai->jabatan->gaji_pokok + $row->pegawai->jabatan->tunjangan - $row->bpjs - $row->pajak, 0, ',', '.') }}</b>
                        </td>
                        <td>
                            <center>{{ date('h:i:s A', strtotime($row->waktu_payroll)) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>

    <h3>Keterangan :</h3>
    <p>
        Ini adalah data yang valid yang sudah tergenerate oleh sistem. Jika ada kesalahan silahkan hubungi dept IT.
    </p>

    <div class="col-md-12">
        <div class="invoice-bottom-total">
            <div class="col-sm-8 no-padding">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="add-box">
                    <h4>Diketahui Oleh:</h4>
                    <!--<img src="" width="200" alt="">
                    <h4>Melissa Grey<br>-->
                    HR/GA Director</h4>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</main>
