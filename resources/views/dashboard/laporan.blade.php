<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('dash/assets/img/favicon - Copy.png') }}" rel="icon">
    <link href="{{ asset('dash/assets/img/favicon - Copy.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files via CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.bubble.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-datatables/1.1.8/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('dash/assets/css/style.css') }}" rel="stylesheet">

    <style>
        .status-container {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: bold;
        }

        .bg-success {
            background-color: #28a745;
            color: white;
        }

        .bg-danger {
            background-color: #dc3545;
            color: white;
        }

        .bg-warning {
            background-color: #ffc107;
            color: black;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center justify-content-center">
                <img src="{{ asset('dash/assets/img/logo-kab-bantul.png') }}" alt="">
                <span class="d-none d-lg-block">SIPALAH</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        @if ($user->foto_profile)
                            <img src="{{ route('profile.picture', ['filename' => basename($user->foto_profile)]) }}"
                                alt="Profile" class="rounded-circle">
                        @else
                            <p>No profile picture</p>
                        @endif
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ $user->username }}</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ $user->username }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.profile') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item d-flex align-items-center" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>


                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Menu</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Laporan</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard.laporan') }}" class="active">
                            <i class="bi bi-circle"></i><span>Daftar Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.laporan.validasi') }}">
                            <i class="bi bi-circle"></i><span>Validasi</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-map"></i><span>Pemetaan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard.peta') }}">
                            <i class="bi bi-circle"></i><span>Peta Lahan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.peta.pemetaan') }}">
                            <i class="bi bi-circle"></i><span>Pemetaan</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Charts Nav -->

            <li class="nav-heading">Settings</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard.profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <form id="logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout').submit();">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </form>

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tabel Laporan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Laporan</li>
                    <li class="breadcrumb-item active">Tabel Laporan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col">

                    <!-- Search Input dan Tombol Unduh -->
                    <div class="d-flex justify-content-between mb-3">
                        <input id="searchInput" type="text" class="form-control w-25"
                            placeholder="Cari disini..." onkeyup="searchTable()">

                        <!-- Tombol di sebelah kanan (end) -->
                        <div class="ml-auto">
                            <button class="btn btn-primary" onclick="exportTableToCSV('laporan.csv')">Unduh
                                CSV</button>
                            <a class="btn btn-primary ms-2" href="{{ route('export.pdf') }}" role="button"
                                target="_blank">Unduh PDF</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body table-responsive">
                            <h5 class="card-title">Laporan Alih Fungsi Lahan</h5>

                            @if (session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Table with hoverable rows -->
                            <table id="reportsTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID Laporan</th>
                                        <th scope="col">Perubahan</th>
                                        <th scope="col">Latitude</th>
                                        <th scope="col">Longitude</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Nama Pelapor</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No HP</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Waktu</th>

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
                                                        $photoUrls = array_map(function ($photo) {
                                                            return asset('storage/' . str_replace('\/', '/', $photo));
                                                        }, $photos);
                                                    @endphp
                                                    @if (count($photoUrls) > 0)
                                                        <button class="btn btn-primary btn-sm"
                                                            data-image-urls="{{ json_encode($photoUrls) }}"
                                                            onclick="showModal(this)">
                                                            Foto ({{ count($photoUrls) }})
                                                        </button>
                                                    @else
                                                        Tidak ada foto
                                                    @endif
                                                @else
                                                    Tidak ada foto
                                                @endif
                                            </td>

                                            <td>{{ $report->keterangan }}</td>
                                            <td>{{ $report->nama_pelapor }}</td>
                                            <td>{{ $report->email }}</td>
                                            <td>{{ $report->nohp }}</td>
                                            <td>{{ $report->alamat }}</td>
                                            <td class="status">
                                                <span
                                                    class="
                                                    status-container 
                                                    {{ $report->status == 'approved' ? 'bg-success' : ($report->status == 'rejected' ? 'bg-danger' : ($report->status == 'pending' ? 'bg-warning' : '')) }}">
                                                    {{ ucfirst($report->status) }}
                                                </span>
                                            </td>

                                            <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-end">
                        <ul class="pagination">
                            <li class="page-item {{ $reports->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $reports->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $reports->lastPage(); $i++)
                                <li class="page-item {{ $i == $reports->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $reports->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ !$reports->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $reports->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- End Main -->

    <!-- Modal dengan Carousel -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Ukuran modal bisa disesuaikan -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselPhotos" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carouselInner">
                            <!-- Gambar akan diisi melalui JavaScript -->
                        </div>
                        <!-- Kontrol Carousel -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPhotos"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPhotos"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            <strong><span>Balai Penyuluhan Pertanian Kapanewon Kasihan</span></strong>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@1.1.8/dist/simple-datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.6.0/tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/PHPMailer/PHPMailer@6.6.4/src/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dash/assets/js/main.js') }}"></script>

    <!-- JavaScript -->

    <!-- Alert -->
    <script>
        // Fungsi untuk menyembunyikan alert setelah 5 detik (5000 ms)
        setTimeout(function() {
            var alertElement = document.getElementById('success-alert');
            if (alertElement) {
                alertElement.style.transition = "opacity 0.5s ease"; // Tambahkan efek transisi
                alertElement.style.opacity = 0; // Buat alert tidak terlihat

                setTimeout(function() {
                    alertElement.style.display =
                        'none'; // Hilangkan elemen dari tampilan setelah efek transisi
                }, 500); // Waktu transisi sebelum benar-benar dihilangkan
            }
        }, 5000); // Hilang setelah 5 detik
    </script>

    <!-- Modal Foto dan Carousel -->
    <script>
        function showModal(button) {
            // Ambil URL gambar dari atribut data-image-urls
            const imageUrls = JSON.parse(button.getAttribute('data-image-urls'));
            console.log("Image URLs:", imageUrls); // Untuk debugging

            const carouselInner = document.getElementById('carouselInner');
            carouselInner.innerHTML = ''; // Kosongkan konten sebelumnya

            if (imageUrls.length === 0) {
                carouselInner.innerHTML =
                    '<div class="carousel-item active"><img src="" class="d-block w-100" alt="Tidak ada foto"></div>';
            } else {
                imageUrls.forEach((url, index) => {
                    const div = document.createElement('div');
                    div.classList.add('carousel-item');
                    if (index === 0) {
                        div.classList.add('active');
                    }

                    const img = document.createElement('img');
                    img.src = url;
                    img.classList.add('d-block', 'w-100');
                    img.alt = `Foto ${index + 1}`;

                    div.appendChild(img);
                    carouselInner.appendChild(div);
                });
            }

            // Tampilkan atau sembunyikan kontrol carousel berdasarkan jumlah gambar
            const prevButton = document.querySelector('.carousel-control-prev');
            const nextButton = document.querySelector('.carousel-control-next');
            if (imageUrls.length > 1) {
                prevButton.style.display = 'block';
                nextButton.style.display = 'block';
            } else {
                prevButton.style.display = 'none';
                nextButton.style.display = 'none';
            }

            // Inisialisasi dan tampilkan modal
            const myModal = new bootstrap.Modal(document.getElementById('photoModal'));
            myModal.show();
        }
    </script>

    <script>
        // Fungsi untuk pencarian di tabel
        function searchTable() {
            const input = document.getElementById("searchInput").value.toUpperCase();
            const table = document.getElementById("reportsTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        const textValue = td[j].textContent || td[j].innerText;
                        if (textValue.toUpperCase().indexOf(input) > -1) {
                            match = true;
                            break;
                        }
                    }
                }

                tr[i].style.display = match ? "" : "none";
            }
        }


        // Fungsi untuk mengunduh tabel sebagai CSV
        function exportTableToCSV(filename) {
            const csv = [];
            const rows = document.querySelectorAll("#reportsTable tr"); // Periksa #reportsTable

            for (let i = 0; i < rows.length; i++) {
                const row = [];
                const cols = rows[i].querySelectorAll("td, th");

                for (let j = 0; j < cols.length; j++) {
                    let colText = cols[j].innerText.trim(); // Menghilangkan spasi berlebih
                    // Bungkus nilai dalam tanda kutip jika mengandung koma atau tanda kutip
                    if (colText.includes(",") || colText.includes("\"")) {
                        colText = `"${colText.replace(/"/g, '""')}"`; // Escape tanda kutip ganda
                    }
                    row.push(colText); // Tambahkan nilai kolom ke dalam baris
                }

                csv.push(row.join(",")); // Gabungkan setiap kolom dengan koma
            }

            // Buat dan unduh file CSV
            downloadCSV(csv.join("\n"), filename);
        }

        function downloadCSV(csv, filename) {
            const csvFile = new Blob([csv], {
                type: "text/csv"
            });
            const downloadLink = document.createElement("a");

            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";

            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    </script>
</body>

</html>
