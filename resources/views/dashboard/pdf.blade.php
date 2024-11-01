<html>
<head>
    <title> Laporan </title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #ccc;
        }

        .rangkasurat {
            width: 980px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            overflow-x: auto;
        }

        .tengah {
            text-align: center;
            line-height: 1.2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Atur gambar agar tidak terlalu besar */
        img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }

        /* Tentukan lebar khusus untuk beberapa kolom agar lebih konsisten */
        td:nth-child(1),
        td:nth-child(3),
        td:nth-child(4),
        td:nth-child(7),
        td:nth-child(10),
        td:nth-child(11) {
            width: 80px;
        }

        td:nth-child(5) {
            width: 120px;
        }

        td:nth-child(6),
        td:nth-child(8) {
            width: 150px;
        }

        td:nth-child(12) {
            width: 120px;
        }
    </style>
</head>

<body>
    <div class="rangkasurat">
        <table width="100%">
            <tr>
                {{-- <td><img src="{{ asset("dash/assets/img/logo-kab-bantul.png") }}" width="140px"></td> --}}
                <td class="tengah">
                    <h2>PEMERINTAH KABUPATEN BANTUL</h2>
                    <h1>KAPANEWON KASIHAN</h1>
                    <b>JL. Madukismo No. 252, Tirtonirmolo, Kasihan, Bantul, Yogyakarta, 55184</b>
                    <br>
                    <b>Email: kec.kasihan@bantulkab.go.id   Website: https://kec-kasihan.bantulkab.go.id
                    </b>
                </td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Laporan</th>
                    <th>Perubahan</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Foto</th>
                    <th>Keterangan</th>
                    <th>Nama Pelapor</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->perubahan }}</td>
                        <td>{{ $report->latitude }}</td>
                        <td>{{ $report->longitude }}</td>
                        <td>
                            @if ($report->foto)
                                @php
                                    $photos = json_decode($report->foto, true); // Decode JSON menjadi array
                                @endphp
                                @foreach ($photos as $photo)
                                    @php
                                        // Ganti karakter escape \/ dengan /
                                        $photoPath = str_replace('\/', '/', $photo);
                                        $localPath = storage_path('app/public/' . $photoPath);
                                        if (file_exists($localPath)) {
                                            $imageData = base64_encode(file_get_contents($localPath));
                                            $extension = pathinfo($localPath, PATHINFO_EXTENSION);
                                            $src = 'data:image/' . $extension . ';base64,' . $imageData;
                                        } else {
                                            $src = '';
                                        }
                                    @endphp
                                    @if ($src)
                                        <img src="{{ $src }}" alt="Foto">
                                    @else
                                        Tidak ada foto
                                    @endif
                                @endforeach
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                        <td>{{ $report->keterangan }}</td>
                        <td>{{ $report->nama_pelapor }}</td>
                        <td>{{ $report->email }}</td>
                        <td>{{ $report->nohp }}</td>
                        <td>{{ $report->alamat }}</td>
                        <td>{{ $report->status }}</td>
                        <td>{{ $report->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
