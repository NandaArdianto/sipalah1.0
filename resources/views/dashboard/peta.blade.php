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

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet" />

    <!-- Load Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.browser.print/dist/leaflet.browser.print.min.css" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('dash/assets/css/style.css') }}" rel="stylesheet">

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
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Laporan</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
            </li><!-- End Tables Nav -->

            <li class="nav-item">
                <a class="nav-link " data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-map"></i><span>Pemetaan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard.peta') }}" class="active">
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

            <li class="nav-item">
                <a class="nav-link collapsed" href="#"
                    onclick="event.preventDefault(); 
                  document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Login Page Nav -->
            <!-- Form Logout (Tersembunyi) -->
            <form id="logout-form" action="#" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Peta Lahan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Pemetaan</li>
                    <li class="breadcrumb-item active">Peta Lahan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Peta Lahan</h5>

                        <!-- Tambahkan elemen div dengan ID map -->
                        <div id="map" style="height: 600px;"></div>

                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            <strong><span>Balai Penyuluhan Pertanian Kapanewon Kasihan</span></strong>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Script for Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load Leaflet JS dan Plugin setelah halaman dimuat -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.browser.print/dist/leaflet.browser.print.min.js"></script>


    <!-- Script Utama -->
    <script src="{{ asset('dash/assets/js/main.js') }}"></script>

    <script>
        // Inisiasi peta Leaflet
        var map = L.map('map').setView([-7.7650, 110.358], 13);

        // Tambahkan berbagai tile layer
        var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }); // Street

        var peta2 = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }); // Satellite

        var peta3 = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map); // Hybrid

        var geojsonLayer = L.geoJSON(null, {
            style: function(feature) {
                // Cek apakah id ada dalam daftar [1, 2, 3, 4]
                if ([1, 2, 3, 4].includes(feature.properties.id)) {
                    return {
                        color: "yellow", // Warna garis tepi (border)
                        fillColor: "white", // Warna isi poligon
                        weight: 0.9, // Ketebalan garis tepi
                        fillOpacity: 0 // Keburaman isi poligon
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
        function loadGeoJson() {
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
        loadGeoJson();

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


        // Inisialisasi Leaflet Browser Print Plugin
        L.control.browserPrint({
            title: 'Peta Lahan Pertanian Kapanewon Kasihan',
            documentTitle: 'Peta Lahan Pertanian',
            printLayer: geojsonLayer, // Layer yang akan dicetak
            closePopupsOnPrint: true
        }).addTo(map);
    </script>

</body>

</html>
