<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
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
        .card-login {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <main class="login">
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card-login col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
                            style="border-radius: 20px;">
                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('reports.index') }}" class="logo d-flex align-items-center w-auto">
                                    <img class=" max-height: 100px; margin-right: 6px;"src="{{ asset('dash/assets/img/logo-font-dark.png') }}" alt="">
                                </a>
                            </div>

                            <div class="card card-login mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login</br>Your Account</h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>

                                    <!-- Login Form -->
                                    <form class="row g-3 needs-validation" novalidate method="POST"
                                        action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i
                                                        class="bi bi-envelope"></i></span>
                                                <input type="email" name="email" class="form-control" id="yourEmail"
                                                    required>
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i
                                                        class="bi bi-lock"></i></span>
                                                <input type="password" name="password" class="form-control"
                                                    id="yourPassword" required>
                                                <div class="invalid-feedback">Please enter your password!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                    </form>
                                    <!-- End Login Form -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

    <!-- SweetAlert Alerts -->
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ $errors->first() }}'
            });
        </script>
    @endif

    @if (session('status'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('status') }}'
            });
        </script>
    @endif

    <!-- Template Main JS File -->
    <script src="{{ asset('dash/assets/js/main.js') }}"></script>
</body>

</html>
