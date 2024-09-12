<!DOCTYPE html>
<html>

<head>
    <title>PT. Djileena Sukses Makmur</title>
</head>

<body>
    <h1>Halo {{ $application->name }},</h1>
    <p>Selamat anda dinyatakan lulus administrasi. Kemudian langkah selanjutnya lakukan interview yang telah
        dijadwalkan. Berikut adalah detailnya:</p>
    <p><strong>Tempat:</strong> {{ $interviewDetails['alamat'] }}</p>
    <p><strong>Tanggal & Waktu:</strong> {{ \Carbon\Carbon::parse($interviewDetails['tanggal'])->format('d M Y, H:i') }}
    </p>
    <p><strong>PIC:</strong> {{ $interviewDetails['pic'] }}</p>
    <p><strong>No Telp PIC:</strong> {{ $interviewDetails['telp'] }}</p>

    <p>Semoga sukses dalam interview Anda!</p>
</body>

</html>
