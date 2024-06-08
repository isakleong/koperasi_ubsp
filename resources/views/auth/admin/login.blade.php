<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="/administrator/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login - Sistem Akuntansi UBSP</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/administrator/assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/administrator/assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/administrator/assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/administrator/assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/administrator/assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/administrator/assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/administrator/assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/administrator/assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/administrator/assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/administrator/assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/administrator/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/administrator/assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/administrator/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/administrator/assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/administrator/assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="stylesheet" href="/administrator/assets/vendor/fonts/fonts.css" />
    <link rel="stylesheet" href="/administrator/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/administrator/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/administrator/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/administrator/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/administrator/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/administrator/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="/administrator/assets/vendor/js/helpers.js"></script>
    <script src="/administrator/assets/js/config.js"></script>
</head>

<body>
    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <div class="d-none d-lg-flex col-lg-6 col-xl-6 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="/assets/images/bg-login.svg" class="img-fluid" alt="Login image" width="700">
                </div>
            </div>

            <div class="d-flex col-12 col-lg-6 col-xl-6 align-items-center authentication-bg p-sm-4 p-4">
                <div class="w-px-400 mx-auto">
                    <div class="app-brand justify-content-center mb-5">
                        <span class="app-brand-logo demo">
                            <img src="/assets/images/logo.svg" alt="Logo" width="200">
                        </span>
                    </div>

                    <h4 class="mb-2">Selamat datang, Admin!</h4>

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
                            <button class="btn btn-primary d-grid w-100" type="submit">MASUK</button>
                        </div>

                        <div class="divider my-4">
                            <div class="divider-text">© <script>document.write(new Date().getFullYear());</script> Sistem Akuntansi UBSP</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/administrator/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/administrator/assets/vendor/libs/popper/popper.js"></script>
    <script src="/administrator/assets/vendor/js/bootstrap.js"></script>
    <script src="/administrator/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/administrator/assets/vendor/js/menu.js"></script>
    <script src="/administrator/assets/js/main.js"></script>
</body>
</html>
