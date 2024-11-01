<!DOCTYPE html>
<html>
<head>
    <title>Status Laporan Anda Telah Diupdate</title>
</head>
<body>
    <h1>Status Laporan Anda</h1>
    <p>Halo, {{ $report->nama_pelapor }}!</p>
    <p>Laporan Anda dengan ID: {{ $report->id }}</p> <!-- Fixed this line -->
    <p>Terkait perubahan lahan telah {{ $status == 'approved' ? 'disetujui' : 'ditolak' }}.</p>
    
    @if ($status === 'rejected')
        <p>Mohon maaf, laporan Anda tidak dapat kami setujui saat ini. Silakan hubungi kami jika Anda ingin mengetahui alasan lebih lanjut.</p>
    @endif

    <p>Terima kasih telah menggunakan layanan kami.</p>
</body>
</html>
