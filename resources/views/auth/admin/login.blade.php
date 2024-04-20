<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="/administrator/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/administrator/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="/administrator/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/administrator/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/administrator/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/administrator/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/administrator/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/administrator/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="/administrator/assets/vendor/js/helpers.js"></script>
    <script src="/administrator/assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="/assets/images/bg-login.svg" class="img-fluid" alt="Login image" width="700">
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-4 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-5">
                        <a href="/admin/login" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="/assets/images/logo.svg" alt="Logo" width="200">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <h4 class="mb-2">Sistem Akuntansi UBSP</h4>
                    <p class="mb-4">Selamat datang, Admin! 👋</p>

                    <form id="formAuthentication" class="mb-3" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Username</label>
                            <input type="text" class="form-control" id="email" name="username"
                                placeholder="Masukkan username" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                        </div>

                        <div class="divider my-4">
                            <div class="divider-text">© <script>document.write(new Date().getFullYear());</script> Sistem Akuntansi UBSP</div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>


    {{-- <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img width="60" src="/main/assets/static/images/logo/UBSP-logos_transparent.png"
                                        alt="Logo">
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Sistem Akuntansi UBSP</h4>
                        <p class="mb-4">Selamat datang, Admin! 👋</p>

                        <form id="formAuthentication" class="mb-3" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Username</label>
                                <input type="text" class="form-control" id="email" name="username"
                                    placeholder="Masukkan username" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="/administrator/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/administrator/assets/vendor/libs/popper/popper.js"></script>
    <script src="/administrator/assets/vendor/js/bootstrap.js"></script>
    <script src="/administrator/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/administrator/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/administrator/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
