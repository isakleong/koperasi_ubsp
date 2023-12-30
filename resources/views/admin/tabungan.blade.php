@extends('layout.admin.main')

@section('vendorCSS')
    <style>
        #customCard {
            border: none;
            border-radius: 12px;
            color: #fff;
            background-image: linear-gradient(to right top, #0D41E1, #0C63E7, #0A85ED, #09A6F3, #07C8F9);
        }

        #customCardBorder {
            border-top-left-radius: 30px !important;
            border-top-right-radius: 30px !important;
            border: none;
            border-radius: 6px;
            background-color: blue;
            color: #fff;
            background-image: linear-gradient(to right top, #0a33b1, #094eb7, #086abc, #0784c2, #05a1c8);
        }

        .bgCard:hover {
            /* transform: scale(1.02); */
            opacity: 0.75;
        }
    </style>
@endsection

@section('navbar')
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo align-items-center">
                    <img width="60" src="/main/assets/static/images/logo/UBSP-logos_transparent.png" alt="Logo">
                </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Dashboards">Dashboard</div>
                </a>
            </li>
            <!-- End of Dashboards -->

            <!-- Master Data -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">master data</span></li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-group"></i>
                    <div data-i18n="Basic">Anggota</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/account_category" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-category"></i>
                    <div data-i18n="Basic">Kategori Akun</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/account" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-archive"></i>
                    <div data-i18n="Basic">Daftar Akun</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Extended UI">Pengaturan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="/admin/company" class="menu-link">
                            <div data-i18n="Perfect Scrollbar">Profile UBSP</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/config" class="menu-link">
                            <div data-i18n="Text Divider">Konfigurasi Data</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End of Master Data -->

            <!-- Transaction Data -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">transaksi</span></li>
            <li class="menu-item">
                <a href="/admin/menu/simpanan" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-donate-heart"></i>
                    <div data-i18n="Basic">Simpanan</div>
                </a>
            </li>
            <li class="menu-item active">
                <a href="/admin/menu/tabungan" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-wallet"></i>
                    <div data-i18n="Basic">Tabungan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/kredit" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                    <div data-i18n="Basic">Kredit</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/angsuran" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-money"></i>
                    <div data-i18n="Basic">Angsuran</div>
                </a>
            </li>
            
            <!-- End of Transaction Data -->

            <!-- Report Data -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">laporan</span></li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book-open"></i>
                    <div data-i18n="Basic">Jurnal Harian</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                    <div data-i18n="Basic">Buku Besar</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-chart"></i>
                    <div data-i18n="Basic">Neraca Saldo</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-line-chart"></i>
                    <div data-i18n="Basic">Laba Rugi</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-network-chart"></i>
                    <div data-i18n="Basic">Neraca</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-coin-stack"></i>
                    <div data-i18n="Basic">Hutang</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
                    <div data-i18n="Basic">Piutang</div>
                </a>
            </li>
            <!-- End of Transaction Data -->

        </ul>
    </aside>
    <!-- / Menu -->
@endsection

@section('content')
    {{-- @include('sweetalert::alert') --}}
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Beranda Tabungan
        </h4>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-6 mb-5 bgCard">
                        <a href="/admin/simpanan/setoran">
                            <div class="container-fluid">
                                <div class="p-3" id="customCard">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class='bx bxs-wallet' style="font-size: 3em;"></i></span>
                                        <span><i class='bx bxs-chevrons-right' style="font-size: 3em;"></i></span>
                                    </div>
                                    <div class="px-2 number mt-3 d-flex justify-content-between align-items-center">
                                        <span>Setoran Tabungan</span>
                                    </div>
                                    <div class="p-4 mt-4" id="customCardBorder">
                                        <div class="text-center">
                                            <span class="cardholder">Tambah Setoran</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 mb-5 bgCard">
                        <a href="/admin/simpanan/setoran/review">
                            <div class="container-fluid">
                                <div class="p-3" id="customCard">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class='bx bxs-wallet' style="font-size: 3em;"></i></span>
                                        <span><i class='bx bxs-message-square-edit' style="font-size: 3em;"></i></span>
                                    </div>
                                    <div class="px-2 number mt-3 d-flex justify-content-between align-items-center">
                                        <span>Pengajuan Tabungan</span>
                                    </div>
                                    <div class="p-4 mt-4" id="customCardBorder">
                                        <div class="text-center">
                                            <span class="cardholder">Review Pengajuan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 mb-5 bgCard">
                        <a href="/admin/simpanan/create">
                            <div class="container-fluid">
                                <div class="p-3" id="customCard">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class='bx bxs-wallet' style="font-size: 3em;"></i></span>
                                        <span><i class='bx bxs-chevrons-left' style="font-size: 3em;"></i></span>
                                    </div>
                                    <div class="px-2 number mt-3 d-flex justify-content-between align-items-center">
                                        <span>Penarikan Tabungan</span>
                                    </div>
                                    <div class="p-4 mt-4" id="customCardBorder">
                                        <div class="text-center">
                                            <span class="cardholder">Tambah Penarikan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 mb-5 bgCard">
                        <a href="/admin/user">
                            <div class="container-fluid">
                                <div class="p-3" id="customCard">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class='bx bxs-wallet' style="font-size: 3em;"></i></span>
                                        <span><i class='bx bxs-message-square-edit' style="font-size: 3em;"></i></span>
                                    </div>
                                    <div class="px-2 number mt-3 d-flex justify-content-between align-items-center">
                                        <span>Penarikan Tabungan</span>
                                    </div>
                                    <div class="p-4 mt-4" id="customCardBorder">
                                        <div class="text-center">
                                            <span class="cardholder">Edit Penarikan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
