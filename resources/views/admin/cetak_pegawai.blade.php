<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Pegawai per Tanggal {{ $formattedTanggal }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>No HP</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach ($data as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->jenis_kelamin }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->jabatan->nama_jabatan ?? 'Tidak Ada' }}</td>
                    <td>{{ formatrupiah($row->gaji_pokok) }}</td>
                    <td>{{ formatrupiah($row->tunjangan) }}</td>
                    <td>{{ $row->no_hp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
