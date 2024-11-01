<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Dashboard</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="{{ asset('dash/assets/img/favicon - Copy.png') }}" rel="icon" />
    <link href="{{ asset('dash/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet" />

    <!-- Stylesheet Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('dash/assets/css/style.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center justify-content-center">
                <img src="{{ asset('dash//assets/img/logo-kab-bantul.png') }}" alt="Logo" />
                <span class="d-none d-lg-block">SIPALAH</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

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
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ $user->username }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.profile') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
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
                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Menu</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Laporan</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard.laporan') }}">
                            <i class="bi bi-circle"></i><span>Daftar Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.laporan.validasi') }}">
                            <i class="bi bi-circle"></i><span>Validasi</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Tables Nav -->

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
            </li>
            <!-- End Pemetaan -->

            <li class="nav-heading">Settings</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard.profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>
            <!-- End Profile Page Nav -->

            <!-- Tombol Logout -->
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



            <!-- End Login Page Nav -->
        </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-12">
                    <div class="row">
                        <!-- Card Laporan -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total laporan</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-folder"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $totalLaporan }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card Laporan -->

                        <!-- Card Bangunan -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Bangunan</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-house"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $laporanMenjadiBangunan }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card Bangunan -->

                        <!-- Card Timbunan -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Timbunan
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cone-striped"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $laporanMenjadiTimbunan }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card Timbunan -->

                        <!-- Card Lainnya -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Lainnya
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-question-octagon"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $laporanLainnya }}</h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card Lainnya -->

                        <!-- Peta -->
                        <!-- Tambahkan Stylesheet dan Script Leaflet -->
                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
                        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

                        <section class="section">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Peta Lahan dan Laporan</h5>
                                        <!-- Tambahkan elemen div dengan ID map -->
                                        <div id="map" style="height: 600px;"></div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Bar Chart -->
                        <section class="section">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Diagram Laporan</h5>
                                        <div style="height: 100%; width: 100%;">
                                            <canvas id="barChart"></canvas>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                const bulan = @json($chartData['bulan']); // Ambil bulan dari controller
                                                const dataMenjadiBangunan = @json($chartData['menjadi_bangunan']); // Data untuk 'Menjadi Bangunan'
                                                const dataMenjadiTimbunan = @json($chartData['menjadi_timbunan']); // Data untuk 'Menjadi Timbunan'
                                                const dataLainnya = @json($chartData['lainnya']); // Data untuk 'Lainnya'

                                                new Chart(document.querySelector('#barChart'), {
                                                    type: 'bar',
                                                    data: {
                                                        labels: bulan,
                                                        datasets: [{
                                                                label: 'Menjadi Bangunan',
                                                                data: dataMenjadiBangunan,
                                                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                                                borderColor: 'rgb(255, 99, 132)',
                                                                borderWidth: 1,
                                                                barThickness: 25, // Set a fixed bar thickness
                                                                maxBarThickness: 30 // Set the maximum thickness
                                                            },
                                                            {
                                                                label: 'Menjadi Timbunan',
                                                                data: dataMenjadiTimbunan,
                                                                backgroundColor: 'rgba(255, 159, 64, 0.5)',
                                                                borderColor: 'rgb(255, 159, 64)',
                                                                borderWidth: 1,
                                                                barThickness: 25, // Set a fixed bar thickness
                                                                maxBarThickness: 30 // Set the maximum thickness
                                                            },
                                                            {
                                                                label: 'Lainnya',
                                                                data: dataLainnya,
                                                                backgroundColor: 'rgba(255, 255, 0, 0.5)',
                                                                borderColor: 'rgba(255, 255, 0)',
                                                                borderWidth: 1,
                                                                barThickness: 25, // Set a fixed bar thickness
                                                                maxBarThickness: 30 // Set the maximum thickness
                                                            }
                                                        ]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                                title: {
                                                                    display: true,
                                                                    text: 'Jumlah Laporan',
                                                                    font: {
                                                                        size: 16,
                                                                        weight: 'bold',
                                                                    }
                                                                },
                                                                ticks: {
                                                                    min: 0, // Minimum value on the y-axis
                                                                    max: 999, // Maximum value on the y-axis
                                                                    stepSize: 1, // Interval between ticks
                                                                    callback: function(value) {
                                                                        return value; // Display values as is
                                                                    }
                                                                },
                                                                grid: {
                                                                    color: 'rgba(200, 200, 200, 0.5)' // Customize grid color
                                                                }
                                                            },
                                                            x: {
                                                                title: {
                                                                    display: true,
                                                                    text: 'Bulan',
                                                                    font: {
                                                                        size: 16,
                                                                        weight: 'bold'
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End Bar Chart -->

                    </div>
                </div>
                <!-- End Left side columns -->
            </div>
        </section>
    </main>
    <!-- End #main -->

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

    <!-- jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dash/assets/js/main.js') }}"></script>

    <script>
        // Inisiasi peta Leaflet
        var map = L.map('map').setView([-7.7650, 110.358], 13);

        // Tambahkan berbagai tile layer
        var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map); // Street

        var peta2 = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }); // Satellite

        var peta3 = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }); // Hybrid

        // Definisikan ikon marker untuk setiap status
        var redIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var yellowIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var greenIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Layer for GeoJSON
        var geojsonLayer = L.geoJSON(null, {
            style: function(feature) {
                // Cek apakah id ada dalam daftar [1, 2, 3, 4]
                if ([1, 2, 3, 4].includes(feature.properties.id)) {
                    return {
                        color: "black", // Warna garis tepi (border)
                        fillColor: "yellow", // Warna isi poligon
                        weight: 0.9, // Ketebalan garis tepi
                        fillOpacity: 0.3 // Keburaman isi poligon
                    };
                } else {
                    return {
                        color: "darkgreen", // Warna garis batas untuk sawah
                        fillColor: "lightgreen", // Warna isi poligon untuk sawah
                        weight: 1, // Ketebalan garis tepi
                        fillOpacity: 0.9 // Tingkat keburaman (opacity) isi poligon untuk sawah
                    };
                }
            },
            onEachFeature: function(feature, layer) {
                // Cek berdasarkan id di feature.properties
                switch (feature.properties.id) {
                    case 1:
                        layer.bindPopup(
                            "<div style='text-align: center;'><b>KETERANGAN</b></div>" +
                            "<b>Desa:</b> Ngestiharjo <br><b> Kapanewon: </b>Kasihan");
                        break;
                    case 2:
                        layer.bindPopup(
                            "<div style='text-align: center;'><b>KETERANGAN</b></div>" +
                            "<b>Desa:</b> Tirtonirmolo <br><b> Kapanewon: </b>Kasihan");
                        break;
                    case 3:
                        layer.bindPopup(
                            "<div style='text-align: center;'><b>KETERANGAN</b></div>" +
                            "<b>Desa:</b> Bangunjiwo <br><b> Kapanewon: </b>Kasihan");
                        break;
                    case 4:
                        layer.bindPopup(
                            "<div style='text-align: center;'><b>KETERANGAN</b></div>" +
                            "<b>Desa:</b> Tamantirto <br><b> Kapanewon: </b>Kasihan");
                        break;
                    default:
                        layer.bindPopup(
                            "<div style='text-align: center;'><b>KETERANGAN</b></div>" +
                            "<b>ID:</b> " + feature.properties.id +
                            "<br><b>Kategori:</b> " + feature.properties.kategori +
                            "<br><b>Lokasi:</b> " + feature.properties.lokasi +
                            "<br><b>Jenis:</b> " + feature.properties.jenis +
                            "<br><b>Luas (ha):</b> " + feature.properties.luas_ha);
                        break;
                }
            }
        }).addTo(map);

        // Function to load GeoJSON data
        function getGeoJson() {
            $.getJSON('{{ route('geojson.get') }}', function(data) {
                console.log("Loaded GeoJSON data:", data);
                geojsonLayer.addData(data);

                // Menyesuaikan tampilan peta setelah data dimuat
                map.fitBounds(geojsonLayer.getBounds());
            }).fail(function(jqXHR, textStatus, errorThrown) {
                Swal.fire('Error', 'Error loading GeoJSON data: ' + textStatus, 'error');
                console.error("Error loading GeoJSON data:", textStatus, errorThrown);
            });
        }
        // Call the function to load GeoJSON
        getGeoJson();

        // Add the layer control to the map
        var baseLayers = {
            "Street": peta1,
            "Satellite": peta2,
            "Hybrid": peta3
        };

        var overlays = {
            "Lahan Pertanian": geojsonLayer
        };

        // Add layer control to the map
        L.control.layers(baseLayers, overlays).addTo(map);
    </script>

    <script>
        // Mengambil data dari endpoint
        fetch('/get/reports')
            .then(response => response.json())
            .then(reports => {
                // Menambahkan marker untuk setiap koordinat
                reports.forEach(function(report) {
                    let iconUrl;

                    // Tentukan URL icon berdasarkan status
                    switch (report.status) {
                        case 'approved':
                            iconUrl =
                                'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png'; // Ganti dengan path icon approved
                            break;
                        case 'pending':
                            iconUrl =
                                'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png'; // Ganti dengan path icon pending
                            break;
                        case 'rejected':
                            iconUrl =
                                'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png'; // Ganti dengan path icon rejected
                            break;
                        default:
                            iconUrl =
                                'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png'; // Ganti dengan path icon default
                    }

                    // Buat icon Leaflet
                    const markerIcon = L.icon({
                        iconUrl: iconUrl,
                        iconSize: [20, 30], // Ukuran icon
                        iconAnchor: [12, 41], // Titik yang digunakan untuk menempatkan marker
                        popupAnchor: [1, -40], // Titik di mana popup muncul relatif terhadap icon
                    });

                    // Tambahkan marker ke peta
                    L.marker([report.latitude, report.longitude], {
                            icon: markerIcon
                        })
                        .addTo(map)
                        .bindPopup('<b>ID: </b>' + report.id + '<br><b>Perubahan: </b>' + report.perubahan +
                            '<br><b>Status: </b>' + report.status);
                });
            })
            .catch(error => console.error('Error fetching coordinates:', error));
    </script>
</body>

</html>
