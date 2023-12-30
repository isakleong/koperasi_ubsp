<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/main/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">

    <link rel="stylesheet" href="/main/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/animation.css">
    <!-- uncomment for dark mode -->
    <!-- <link rel="stylesheet" href="/main/assets/compiled/css/app-dark.css"> -->
    <link rel="stylesheet" href="/main/assets/compiled/css/iconly.css">
    <link rel="stylesheet"
        href="/main/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">

    @yield('vendorCSS')

</head>

<body class="d-flex flex-column h-100">
    <!-- uncomment for dark mode -->
    <!-- <script src="/main/assets/static/js/initTheme.js"></script> -->
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.html"><img src="/main/assets/static/images/logo/UBSP-logos_transparent.png" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="/main/assets/compiled/jpg/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">{{ ucfirst($user->fname) . ' ' . ucfirst($user->lname) }}</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Anggota</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="/logout">Keluar</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item">
                                <a href="/" class="menu-link">
                                    <span><i class="bi bi-house-door-fill"></i> Beranda</span>
                                </a>
                            </li>

                            <li class="menu-item active has-sub">
                                <a href="#" class="menu-link">
                                    <span><i class="fas fa-wallet"></i> Simpanan</span>
                                </a>
                                <div class="submenu">
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                            <li class="submenu-item">
                                                <a href="{{ route('add.simpanan') }}" class="submenu-link">Pengajuan</a>
                                            </li>
                                            <li class="submenu-item">
                                                <a href="{{ route('recap.simpanan') }}" class="submenu-link">Rekap Simpanan</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>

                            <li class="menu-item active has-sub">
                                <a href="#" class="menu-link">
                                    {{-- <span><i class="bi bi-collection-fill"></i> Tabungan</span> --}}
                                    
                                    <span><i class="fas fa-piggy-bank"></i> Tabungan</span>
                                </a>
                                <div class="submenu">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                            <li class="submenu-item">
                                                <a href="{{ route('add.tabungan') }}" class="submenu-link">Pengajuan</a>
                                            </li>
                                            <li class="submenu-item">
                                                <a href="{{ route('recap.tabungan') }}" class="submenu-link">Rekap Tabungan</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>

                            <li class="menu-item has-sub">
                                <a href="#" class="menu-link">
                                    <span><i class="fas fa-coins"></i> Kredit</span>
                                </a>
                                <div class="submenu">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                            <li class="submenu-item">
                                                <a href="{{ route('add.kredit') }}" class="submenu-link">Pengajuan</a>
                                            </li>
                                            <li class="submenu-item">
                                                <a href="{{ route('recap.kredit') }}" class="submenu-link">Rekap Kredit</a>
                                            </li>
                                            <li class="submenu-item">
                                                <a href="{{ route('recap.angsuran') }}" class="submenu-link">Angsuran</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>

                            <li class="menu-item active has-sub">
                                <a href="#" class="menu-link">
                                    <span><i class="bi bi-file-person-fill"></i> Pengaturan</span>
                                </a>
                                <div class="submenu">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                            <li class="submenu-item">
                                                <a href="{{ route('edit.profile') }}" class="submenu-link">Ubah Data Diri</a>
                                            </li>
                                            <li class="submenu-item">
                                                <a href="{{ route('edit.password') }}" class="submenu-link">Ubah Password</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>

            @if ($user->status == 1)
                <div class="content-wrapper container">
                    <div class="page-heading">
                        <h3>Selamat Datang, {{ ucfirst($user->fname) }}</h3>
                    </div>
            
                    <div class="pulse d-flex align-items-center justify-content-center mt-5">Akun Anda sedang ditinjau oleh kami. Setelah disetujui, Anda dapat mengakses seluruh fitur di Sistem Akuntansi UBSP</div>
                </div>
            @elseif ($user->status == 0)
                @if (Route::currentRouteName() == 'user.activation')
                    @yield('content')
                @else
                    <div class="content-wrapper container">
                        <div class="page-heading">
                            <h3>Selamat Datang, {{ ucfirst($user->fname) }}</h3>
                        </div>
                
                        <div class="pulse mt-5 text-center">
                            <p>Anda belum terdaftar sebagai anggota Sistem Akuntansi UBSP.</p>
                            <p>Silahkan menyelesaikan proses pendaftaran anggota dengan membayar simpanan pokok. Tekan tombol dibawah ini untuk melanjutkan proses pendaftaran.</p>
                            <a href="{{ route('user.activation') }}" class="btn btn-primary mt-3">Selesaikan Pendaftaran</a>
                        </div>
                    </div>
                @endif
            @else
                @yield('content') @endif

            {{-- <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-end">
                            <p>2023 &copy; Sistem Akuntansi UBSP</p>
                        </div>
                    </div>
                </div>
            </footer> --}}

            <footer id="sticky-at-bottom"
        class="footer mt-auto py-3">
    <div class="container">
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-end">
                <p>2023 &copy; Sistem Akuntansi UBSP</p>
            </div>
        </div>
    </div>
    </footer>


    </div>
    </div>

    <!-- uncomment for dark mode -->
    <!-- <script src="/main/assets/static/js/components/dark.js"></script> -->
    <script src="/main/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="/main/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="/main/assets/compiled/js/app.js"></script>

    <script src="/main/assets/extensions/apexcharts/apexcharts.min.js"></script>

    @yield('vendorJS')
    </body>

</html>
