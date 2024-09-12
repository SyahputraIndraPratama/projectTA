<x-cetak-css></x-cetak-css>
<style>
    .page-break {
        page-break-after: always;
    }

    #tablettd,
    table#tablettd,
    table#tablettd tr,
    table#tablettd thead,
    table#tablettd th {
        border: 0px solid white;
        border-collapse: collapse;
        margin: 1px;
        height: 1px;
    }

    #tablettd tr td {
        border: 0px solid white;
        border-collapse: collapse;
        margin: 1px;
    }
</style>

<body>
    @foreach ($datasCetak as $datas)
        <x-cetak-kop></x-cetak-kop>

        <div style="margin-bottom: 0;text-align:center" id="judul">
            <h2>RINCIAN HR BULAN {{ strtoupper(Fungsi::bulanindo($month)) }} {{ $year }}</h2>
            <p for=""></p>
        </div>

        <div id="judul2">
            <h4></h4>
        </div>

        {{-- <center><h2>@yield('title')</h2></center> --}}


        <br>
        <table width="99%" border="0" style="margin-left:200px;padding:10px">
            <tr>
                <td width="200px">NAMA</td>
                <td width="10px">:</td>
                <td>{{ $datas->pegawai ? $datas->pegawai->nama : 'Data tidak ditemukan' }}</td>
            </tr>

            <tr>
                <td width="100px">GAJI POKOK </td>
                <td width="10px">:</td>
                <td>{{ formatRupiah($datas->gaji_pokok) }}</td>
            </tr>

            <tr>
                <td width="100px">TUNJANGAN MASA KERJA</td>
                <td width="10px">:</td>
                <td>{{ formatRupiah($datas->tunjangan) }}</td>
            </tr>

            @php
                $jumlah = 0;
                $jumlah = $datas->gaji_pokok + $datas->tunjangan;
            @endphp
            {{-- <tr>
            <td width="100px">TUNJANGAN JABATAN</td>
            <td width="10px">:</td>
            <td>{{$datas->pegawai?$datas->pegawai->nama:'Data tidak ditemukan'}}</td>
        </tr> --}}



            <tr>
                <td width="100px">JUMLAH</td>
                <td width="10px">:</td>
                <td>{{ formatRupiah($jumlah) }}</td>
            </tr>


            <tr>
                <td width="100px" style="color: red; width: 40px;">BPJS
                    {{-- : {{ Fungsi::rupiah($datas->simkoperasi) }} --}}
                </td>
                <td width="10px">:</td>
                <td>
                    <span style="">
                        <span style="border-bottom: 0px solid black; color: red; width: 40px;margin-top: 10px;">
                            - {{ formatRupiah($datas->simkoperasi) }}
                        </span>
                </td>
            </tr>
            <tr>
                <td width="100px">
                    {{-- KOPERASI --}}
                    {{-- : {{ Fungsi::rupiah($datas->simkoperasi) }} --}}
                </td>
                <td width="10px">:</td>
                <td>
                    @php
                        $hasilakhir = $jumlah;
                        $hasil = '-';
                        $bpjs = $jumlah;
                        if ($datas->bpjs > 0) {
                            $bpjs = $jumlah - $datas->bpjs;
                            $hasil = formatRupiah($bpjs);
                            $hasilakhir = $hasil;
                        }
                    @endphp
                    {{ $hasil }}
                </td>
            </tr>
            <tr>
                <td width="100px" style="color: red; width: 40px;">Pajak
                    {{-- : {{ Fungsi::rupiah($datas->simkoperasi) }} --}}
                </td>
                <td width="10px">:</td>
                <td>
                    <span style="">
                        <span style="border-bottom: 0px solid black; color: red; width: 40px;margin-top: 10px;">
                            - {{ formatRupiah($datas->dansos) }}
                        </span>
                </td>
            </tr>
            <tr>
                <td width="100px">
                    {{-- DANSOS : {{ Fungsi::rupiah($datas->dansos) }} --}}
                </td>
                <td width="10px">:</td>
                <td>
                    @php
                        $hasil = '-';
                        if ($datas->pajak > 0) {
                            $hasil = formatRupiah($bpjs - $datas->pajak);
                            $hasilakhir = $hasil;
                        }
                    @endphp
                    {{ $hasil }}
                </td>
            </tr>
            <tr>
                <td width="100px"><strong>DITERIMA</strong></td>
                <td width="10px"><strong>:</strong></td>
                <td><strong>{{ $hasilakhir }}</strong></td>
            </tr>
        </table>

        <table width="80%" class="table table-light" id="tablettd">
            <tr>
                <th width="60%">
                    <!-- Content for the first column -->
                </th>
                <th width="20%" align="center">
                    <center>
                        MENGETAHUI <br>
                        KEPALA SEKOLAH SMP
                        <br><br><br>
                        <br>
                        <br>
                        <br>

                        LENI AMALIA.SE
                    </center>
                </th>
                <th width="3%"></th>
            </tr>
            <!-- Add more rows and content as needed -->
        </table>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>

</html>
