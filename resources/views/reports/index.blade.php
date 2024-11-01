<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" sizes="32x32" href="{{ asset('report/assets/images/favicon.png') }}" type="image/x-icon">

    <title>Sistem Pemantauan Lahan Sawah</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Leaflet JS CDN -->
    <!-- CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        vintegrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@v0.74.0/dist/L.Control.Locate.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('report/assets/css/style.css') }}">
</head>

<style>
    .toast-container {
        z-index: 1050;
        position: fixed;
        top: 1rem;
        /* Adjust top distance from the top of the viewport */
        left: 50%;
        transform: translateX(-50%);
        /* Center horizontally */
    }

    .toast-custom {
        border-radius: 0.375rem;
        /* Optional: for rounded corners */
    }

    .toast-body {
        font-size: 1rem;
        /* Adjust font size if needed */
        text-align: justify;
        /* Justify text */
        text-align-last: center;
        /* Center last line */
    }
</style>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img class="img" src="{{ asset('report/assets/images/logo-font-white.png') }}" alt="">
            </a>
            <a class="login_button" href="{{ route('login') }}">Login</a>
        </div>
    </nav>
    <!-- NAVBAR END -->


    <!-- Toast Notification -->
    @if (session('success'))
        <div class="toast-container p-3">
            <div id="statusToast" class="toast toast-custom" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header toast-custom">
                    <strong class="me-auto">Pemberitahuan</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <div class="container bordered-container center-content">
        <div class="row center-content">
            <div class="col center-content">
                <div class="content center-content">
                    <!-- JUDUL -->
                    <div class="head">
                        <h1 class="title"><b>Sistem Pemantauan Lahan Sawah</b></h1>
                    </div>

                    <div class="section">
                        <p class="description text-indent">
                            <b>SIPALAH</b><i> (Sistem Pemantauan Lahan Sawah)</i> merupakan sebuah platform berbasis web
                            yang dirancang untuk membantu pemangku kepentingan dalam mengawasi dan memantau lahan
                            pertanian secara efisien.
                        </p>

                        <p class="description text-indent">Platform ini merupakan sarana bagi masyarakat untuk
                            berpartisipasi aktif melakukan pengendalian alih fungsi lahan dari pertanian ke
                            non-pertanian.

                            Informasi yang dikumpulkan akan menjadi masukan bagi instansi terkait dalam rangka mengambil
                            kebijakan mengenai pemanfaatan lahan pertanian di wilayah Kapanewon Kasihan.</p>
                    </div>
                    <!-- END JUDUL -->

                    <!-- FORM -->
                    <form action="{{ route('reports.store') }}" method="POST" class="needs-validation"
                        enctype="multipart/form-data" novalidate">
                        @csrf

                        <div class="section">
                            <h2 class="attribute required">Bentuk Perubahan Lahan</h2>
                            <p class="description">Silahkan pilih jenis perubahan yang terjadi pada lokasi lahan
                                pertanian:</p>

                            <!--Perubahan-->
                            <input type="radio" id="radioInput1" class="radio" name="perubahan"
                                value="Pertanian Menjadi Bangunan" required>
                            <div class="radio">
                                <label class="radiolabel" for="radioInput1">Pertanian Menjadi Bangunan</label>
                            </div>

                            <input type="radio" id="radioInput2" class="radio" name="perubahan"
                                value="Pertanian Menjadi Timbunan" required>
                            <div class="radio">
                                <label class="radiolabel" for="radioInput2">Pertanian Ditimbun Pondasi</label>
                            </div>

                            <input type="radio" id="radioInput3" class="radio" name="perubahan" value="Lainnya"
                                required>

                            <div class="radio">
                                <label class="radiolabel" for="radioInput3">Perubahan Lainnya...</label>
                            </div>
                            <div id="lainnyaInput" style="display: none;">
                                <input type="text" id="lainnyaText" name="lainnya_text" class="input inputText"
                                    placeholder="Sebutkan perubahan lainnya" value="">
                            </div>

                        </div>

                        <!-- BAGIAN PETA -->
                        <div class="section">
                            <h2 class="attribute required">Koordinat Lokasi Lahan yang Beralihfungsi</h2>
                            <p class="description">Klik pada peta icon lokasi alih fungsi lahan
                                pertanian. Hidupkan
                                <i>"GPS Location"</i>
                            </p>
                            <p class="description">Keterangan Peta:</p>
                            <ol class="description">
                                <li>Kuning (Kawasan Wilayah Kapanewon Kasihan)</li>
                                <li>Hijau (Kawasan Lahan Pertanian Persawah)</li>
                            </ol>
                            <div class="map-container" id="mapContainer">
                                <p class="description">Peta Lahan Pertanian</p>
                                <div id="map"></div>
                                <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.0/dist/L.Control.Locate.min.js" charset="utf-8">
                                </script>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                <input type="text" name="latitude" id="latitude" placeholder="Latitude" readonly
                                    required>

                                <input type="text" name="longitude" id="longitude" placeholder="Longitude"
                                    readonly required>

                            </div>
                        </div>
                        <!-- PETA END  -->

                        <div class="section">
                            <h2 class="attribute required">Foto Lahan yang Mengalami Alih Fungsi</h2>
                            <p class="description">Silahkan masukan foto yang menampilkan perubahan yang terjadi pada
                                lahan
                                pertanian tersebut. Silahkan masukkan foto minimal 1 dan maksimal 3 foto yang diambil
                                melalui
                                gallery penyimpanan.</p>
                            <div class="photoContainer" id="photoContainer"></div>
                            <div class="boxphoto">
                                <label class="labelFile" for="foto">Pilih file foto.</label>
                            </div>
                            <input class="file" type="file" name="foto[]" id="foto" accept="image/*"
                                multiple>

                            <!-- Tampilan thumbnail foto -->
                            <div id="thumbnail-container"></div>

                            <!-- Tampilan nama file -->
                            <div id="file-name-container"></div>
                        </div>

                        <!-- Keterangan -->
                        <div class="section">
                            <h2 class="attribute">Keterangan Tambahan</h2>
                            <label class="keterangan" for="keterangan">Silahkan isi jika terdapat informasi lain yang
                                ingin disampaikan.</label>
                            <textarea name="keterangan" id="keterangan" cols="40" rows="10" wrap="hard"
                                placeholder="Tambahkan keterangan tambahan" value=""></textarea>
                        </div>

                        <!-- Identitas Pelapor -->
                        <div class="section">
                            <h2 class="attribute">Identitas Pelapor</h2>
                            <p class="description">Identitas Anda digunakan untuk melengkapi laporan, dan Anda hanya
                                akan dihubungi
                                jika ada hal yang perlu dikonfirmasi atau ditindaklanjuti.</p>

                        </div>
                        <div class="section section-identitas">

                            <!-- Nama Pelapor -->
                            <label class="keterangan required" for="nama_pelapor">Nama Pelapor</label>
                            <input class="input" type="text" name="nama_pelapor" id="nama_pelapor"
                                placeholder="Nama Anda..." value="" required>

                            <!-- No HP -->
                            <label class="keterangan required" for="noHp">Nomor yang dapat dihubungi</label>
                            <input class="input" type="tel" name="nohp" id="nohp"
                                pattern="^(\+62|62|0)8[1-9][0-9]{6,9}$" placeholder="08xxxxxxx" value=""
                                required>

                            <!-- Alamat-->
                            <label class="keterangan required" for="alamat">Alamat:</label>
                            <input class="input" type="text" name="alamat" id="alamat"
                                placeholder="Kalurahan, Dusun" value="" required></input>

                            <!-- Email -->
                            <label class="keterangan required" for="alamat">Email:</label>
                            <input class="input" type="email" name="email" id="email"
                                placeholder="Email valid" value="" required>
                            <br>
                        </div>

                        <!-- Status -->
                        <div class="section" style="display: none;">
                            <input type="text" name="status" value="pending">
                        </div>

                        <div class="section">
                            <input class="submit" type="submit" value="Kirim Laporan">
                        </div>
                    </form>
                    <!-- END FORM -->

                    <!-- FOOTER -->
                    <div class="footer">
                        <img src="{{ asset('report/assets/images/logo-kab-bantul.png') }}" alt="">
                        <h6 style="margin-top: 8px;"> BPP Kapanewon Kasihan</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->


    <!-- SCRIPT JS -->
    <!-- SCRIPT BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.0/dist/L.Control.Locate.min.js" charset="utf-8">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastEl = document.getElementById('statusToast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 3000 // Hide after 5 seconds
                });

                toast.show();
            }
        });
    </script>

    <script>
        function showInformanForm() {
            var checkbox = document.getElementById("checkboxID");
            var sectionIdentitas = document.querySelector(".section-identitas");

            if (checkbox.checked) {
                sectionIdentitas.style.display = "block";
                enableInputs(sectionIdentitas);
            } else {
                sectionIdentitas.style.display = "none";
                disableInputs(sectionIdentitas);
            }
        }

        function enableInputs(parentElement) {
            var inputs = parentElement.querySelectorAll(".input");
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
            }
        }

        function disableInputs(parentElement) {
            var inputs = parentElement.querySelectorAll(".input");
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = true;
            }
        }
    </script>

    <script>
        var radioInput1 = document.getElementById("radioInput1");
        var radioInput2 = document.getElementById("radioInput2");
        var radioInput3 = document.getElementById("radioInput3");
        var lainnyaInput = document.getElementById("lainnyaInput");

        radioInput1.addEventListener("change", toggleInput);
        radioInput2.addEventListener("change", toggleInput);
        radioInput3.addEventListener("change", toggleInput);

        function toggleInput() {
            if (radioInput3.checked) {
                lainnyaInput.style.display = "block";
            } else {
                lainnyaInput.style.display = "none";
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fotoInput = document.getElementById('foto');
            const thumbnailContainer = document.getElementById('thumbnail-container');
            const fileNameContainer = document.getElementById('file-name-container');

            fotoInput.addEventListener('change', function() {
                thumbnailContainer.innerHTML = ''; // Bersihkan kontainer thumbnail saat pemilihan ulang
                fileNameContainer.innerHTML = ''; // Bersihkan kontainer nama file saat pemilihan ulang

                for (let i = 0; i < fotoInput.files.length; i++) {
                    const file = fotoInput.files[i];

                    // Tampilkan thumbnail
                    const thumbnail = document.createElement('img');
                    thumbnail.src = URL.createObjectURL(file);
                    thumbnail.style.margin = '10px 0px 0 30px'; // Gap antar thumbnail
                    thumbnail.style.maxWidth = '100px'; // Sesuaikan ukuran sesuai kebutuhan
                    thumbnail.style.maxHeight = '100px'; // Sesuaikan ukuran sesuai kebutuhan
                    thumbnailContainer.appendChild(thumbnail);

                    // Tampilkan nama file
                    const fileName = document.createElement('p');
                    fileName.textContent = file.name;
                    fileNameContainer.appendChild(fileName);
                }
            });
        });
    </script>

    <script>
        let lastScrollTop = 0;
        const navbar = document.getElementsByClassName("navbar")[0]; // Access the first element with the class 'navbar'

        window.addEventListener("scroll", function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // Scroll down - hide navbar
                navbar.style.top = "-100px"; // Adjust this value based on your navbar's height
            } else if (scrollTop === 0) {
                // Scroll to top - show navbar
                navbar.style.top = "0";
            }

            lastScrollTop = scrollTop;
        });
    </script>

    <script>
        var map = L.map('map').setView([-7.6713, 110.358], 13);

        // Tambahkan berbagai tile layer
        var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var peta2 = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }); // Satellite

        var peta3 = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }); // Hybrid

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
                            "<b>ID: 1</b><br><b>Desa:</b> Ngestiharjo <br><b> Kapanewon: </b>Kasihan");
                        break;
                    case 2:
                        layer.bindPopup(
                            "<b>ID: 2</b><br><b>Desa:</b> Tirtonirmolo <br><b> Kapanewon: </b>Kasihan");
                        break;
                    case 3:
                        layer.bindPopup(
                            "<b>ID: 3</b><br><b>Desa:</b> Bangunjiwo <br><b> Kapanewon: </b>Kasihan");
                        break;
                    case 4:
                        layer.bindPopup(
                            "<b>ID: 4</b><br><b>Desa:</b> Tamantirto <br><b> Kapanewon: </b>Kasihan");
                        break;
                    default:
                        layer.bindPopup(
                            "<div style='text-align: center;'><b>KETERANGAN</b></div>" +
                            "<br><b>ID:</b> " + feature.properties.id +
                            "<br><b>Kategori:</b> " + feature.properties.kategori +
                            "<br><b>Lokasi:</b> " + feature.properties.lokasi +
                            "<br><b>Jenis:</b> " + feature.properties.jenis +
                            "<br><b>Luas (ha):</b> " + feature.properties.luas_ha
                        );
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

        // Menambahkan kontrol lokasi
        var locateControl = L.control.locate({
            position: 'topleft', // Atur posisi tombol "My Location"
            drawCircle: true, // Gambar lingkaran akurasi
            follow: true, // Aktifkan mode "follow" ketika lokasi ditemukan
            setView: true, // Setel tampilan peta ke lokasi yang ditemukan
            keepCurrentZoomLevel: false, // Biarkan zoom level tetap
            flyTo: true,
            markerStyle: {
                weight: 2,
                fillColor: 'blue',
                color: 'blue',
                opacity: 0.7,
                fillOpacity: 0.7
            },
            icon: 'fa fa-map-marker', // Ikona tombol "My Location"
            iconLoading: 'fa fa-spinner fa-spin', // Ikona yang ditampilkan saat mencari lokasi
            circleStyle: {
                fillColor: '#8e9aaf',
                fillOpacity: 0.2,
                stroke: false,
                clickable: false
            },
            metric: false, // Menampilkan satuan metrik
            strings: {
                title: "Show me where I am", // Label tombol "My Location"
                popup: "You are within {distance} {unit} from this point", // Popup yang muncul saat lokasi ditemukan
                outsideMapBoundsMsg: "You seem to be located outside the boundaries of the map" // Pesan jika lokasi diluar batas peta
            },

            locateOptions: {
                enableHighAccuracy: true // Menggunakan akurasi tinggi
            }
        }).addTo(map);

        // Event yang terjadi ketika lokasi ditemukan
        map.on('locationfound', function(e) {
            // Ambil latitude dan longitude dari objek e
            var lat = e.latitude;
            var lng = e.longitude;

            // Masukkan latitude dan longitude ke dalam input type text
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Event yang terjadi jika mencari lokasi gagal
        map.on('locationerror', function(e) {
            alert("Failed to locate your position: " + e.message);
        });

        var customMarker; // Variabel untuk menyimpan marker yang dapat digeser

        // Event yang terjadi ketika lokasi ditemukan
        map.on('locationfound', function(e) {
            // Ambil latitude dan longitude dari objek e
            var lat = e.latitude;
            var lng = e.longitude;

            // Masukkan latitude dan longitude ke dalam input type text
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Hapus marker yang ada jika sudah ada
            if (customMarker) {
                map.removeLayer(customMarker);
            }

            // Buat marker yang dapat digeser dan tambahkan ke peta
            customMarker = L.marker([lat, lng], {
                draggable: true // Aktifkan fitur drag-and-drop
            }).addTo(map);

            // Event yang terjadi saat marker digeser
            customMarker.on('dragend', function(event) {
                var marker = event.target;
                var position = marker.getLatLng();

                // Ambil latitude dan longitude dari marker yang digeser
                var lat = position.lat;
                var lng = position.lng;

                // Masukkan latitude dan longitude ke dalam input type text
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            });

            // Posisikan peta ke lokasi yang baru ditemukan
            map.setView([lat, lng], 14);
        })
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
                        popupAnchor: [1, -34], // Titik di mana popup muncul relatif terhadap icon
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
