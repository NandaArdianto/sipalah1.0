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
                    </a><!-- End Profile Iamge Icon -->

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

                        <!-- Tombol Logout -->
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
                <a class="nav-link " href="{{ route('dashboard.profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

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

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if ($user->foto_profile)
                                <img src="{{ route('profile.picture', ['filename' => basename($user->foto_profile)]) }}"
                                    alt="Profile" width="100" height="100" class="rounded-circle">
                            @else
                                <p>No profile picture available.</p>
                            @endif
                            <h2>{{ $user->username }}</h2>
                            <h3>Admin</h3>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change
                                        Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->username }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('admin.updateProfilePicture') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                @if ($user->foto_profile)
                                                    <img src="{{ route('profile.picture', ['filename' => basename($user->foto_profile)]) }}"
                                                        alt="Profile" width="100" height="100">
                                                @else
                                                    <p>No profile picture available.</p>
                                                @endif

                                                <!-- Menampilkan URL di bawah gambar untuk debugging -->



                                                <div class="pt-2">
                                                    <label for="foto_profile" class="btn btn-primary btn-sm"
                                                        title="Upload new profile image">
                                                        <i class="bi bi-upload"></i> Upload
                                                    </label>
                                                    <input type="file" name="foto_profile" id="foto_profile"
                                                        class="d-none">

                                                    @if ($user->foto_profile)
                                                        <a href="{{ route('admin.removeProfilePicture') }}"
                                                            class="btn btn-danger btn-sm"
                                                            title="Remove my profile image">
                                                            <i class="bi bi-trash"></i> Remove
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control"
                                                    id="fullName" value="{{ $user->username }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email"
                                                class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control"
                                                    id="Email" value="{{ $user->email }}" readonly>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                    <!-- End Profile Edit Form -->

                                </div>


                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    @if (session('status'))
                                        <div class="alert alert-success">{{ session('status') }}</div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <!-- Change Password Form -->
                                    <form action="{{ route('change.password') }}" method="POST">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_password" type="password" class="form-control"
                                                    id="currentPassword" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password" type="password" class="form-control"
                                                    id="newPassword" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password_confirmation" type="password"
                                                    class="form-control" id="renewPassword" required>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>
                                    <!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
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

</body>

</html>
