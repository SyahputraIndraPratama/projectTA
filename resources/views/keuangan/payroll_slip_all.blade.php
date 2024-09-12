<x-cetak-css></x-cetak-css>

<body>
    <div style="margin-bottom: 0; margin-top: 40px; text-align:center" id="judul">
        <h2>RINCIAN GAJI PEGAWAI BULAN : {{ strtoupper(Fungsi::bulanindo($month)) }} {{ $year }}</h2>
        <p for=""></p>
    </div>

    <div id="judul2">
        <h4></h4>
    </div>

    {{-- <center><h2>@yield('title')</h2></center> --}}


    <br>
    <table width="99%" id="tableBiasa">
        <tr>
            <th>
                NO
            </th>
            <th>
                NAMA
            </th>
            <th>
                JABATAN
            </th>
            <th>
                GAJI POKOK
            </th>
            <th>
                TUNJANGAN
            </th>
            <th>
                BPJS
            </th>
            <th>
                Pajak
            </th>
            <th>
                JUMLAH DITERIMA
            </th>
        </tr>
        @php
            $total = 0;
        @endphp
        @forelse ($datas as $data)
            <tr>
                <td align="center">
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $data->pegawai ? $data->pegawai->nama : '-' }}
                </td>
                <td>
                    {{ $data->nama_jabatan }}
                </td>
                <td align="center">{{ formatRupiah($data->pegawai->gaji_pokok) }}</td>
                <td align="center">{{ formatRupiah($data->pegawai->tunjangan) }}</td>
                <td align="center">{{ formatRupiah($data->bpjs) }}</td>
                <td align="center">{{ formatRupiah($data->pajak) }}</td>
                @php
                    $jumlah = 0;
                    $jumlah = $data->pegawai->gaji_pokok + $data->pegawai->tunjangan - $data->bpjs - $data->tunjangan;
                    $total += $jumlah;
                @endphp
                <td>{{ formatRupiah($jumlah) }}</td>
            </tr>

        @empty

        @endforelse

        <tr>
            <td colspan="7">
                Total
            </td>
            <td colspan="3">
                {{ formatRupiah($total) }}
            </td>
        </tr>
    </table>


    <br>
    <br>
    <table width="100%" class="table table-light" id="tablettd">
        <tr>
            <th width="80%">
                <!-- Content for the first column -->
            </th>
            <th width="20%" align="center">
                <center>
                    MENGETAHUI <br>
                    <br><br><br>

                    Atasan
                </center>
            </th>
            <th width="3%"></th>
        </tr>
        <!-- Add more rows and content as needed -->
    </table>

</body>

</html>
