@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Login
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h3>Selamat Datang, {{ ucfirst($user->fname) }}</h3>
        </div>

        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon purple mb-2">
                                                <i class="iconly-boldWallet"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="font-extrabold mb-1">Total Saldo Tabungan</h6>
                                            <h6 class="font-extrabold mb-0">Rp {{ number_format($saldoTabungan) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldWallet"></i>
                                        </div>
                                        <div class="name ms-4">
                                            <h6 class="font-extrabold mb-1">Saldo Pokok</h6>
                                            <h6 class="font-extrabold mb-0">Rp {{ number_format($saldoPokok) }}</h6>
                                        </div>
                                    </div>
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldWallet"></i>
                                        </div>
                                        <div class="name ms-4">
                                            <h6 class="font-extrabold mb-1">Saldo Wajib</h6>
                                            <h6 class="font-extrabold mb-0">Rp {{ number_format($saldoWajib) }}</h6>
                                        </div>
                                    </div>
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldWallet"></i>
                                        </div>
                                        <div class="name ms-4">
                                            <h6 class="font-extrabold mb-1">Saldo Sukarela</h6>
                                            <h6 class="font-extrabold mb-0">Rp {{ number_format($saldoSukarela) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2">
                                                <i class="iconly-boldTicket"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="font-extrabold mb-1">Sisa Tagihan Pinjaman</h6>
                                            <h6 class="font-extrabold mb-0">Rp {{ number_format($saldoSisaKredit) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldTicket"></i>
                                        </div>
                                        <div class="name ms-4">
                                            <h6 class="font-extrabold mb-1">Total Pinjaman</h6>
                                            <h6 class="font-extrabold mb-0">Rp {{ number_format($totalKredit) }}</h6>
                                        </div>
                                    </div>
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldTicket"></i>
                                        </div>
                                        <div class="name ms-4">
                                            <h6 class="font-extrabold mb-1">Angsuran (Per Bulan)</h6>
                                            <h6 class="font-extrabold mb-0">Rp {{ number_format($pokokPinjaman) }}</h6>
                                        </div>
                                    </div>
                                    {{-- <div class="recent-message d-flex px-4 py-3">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldTicket"></i>
                                        </div>
                                        <div class="name ms-4">
                                            <h6 class="font-extrabold mb-1">Tagihan + Denda</h6>
                                            <h6 class="font-extrabold mb-0">Rp 150,000 + Rp 0</h6>
                                        </div>
                                    </div> --}}
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldTicket"></i>
                                        </div>
                                        <div class="name ms-4">
                                            <h6 class="font-extrabold mb-1">Dibayar</h6>
                                            <h6 class="font-extrabold mb-0">Rp {{ number_format($totalKredit - $saldoSisaKredit) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="display: none;">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaksi Tabungan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use xlink:href="/main/assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Pokok</h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-europe"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-success" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use xlink:href="/main/assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Wajib</h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-america"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-success" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use xlink:href="/main/assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Sukarela</h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-india"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="display: none;">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Tabungan</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="display: none;">
                        {{-- <div class="card">
                            <div class="card-header">
                                <h4>Transaksi Tabungan</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-transaksi-tabungan"></div>
                            </div>
                        </div> --}}
                        <div class="card border-left-primary shadow py-2">
                            <div class="card-header">
                                <form id="transaksiTabunganForm">
                                    <div class="row">
                                        <div class="col-6 mb-1">
                                            <h4>Transaksi Tabungan</h4>
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="col-lg-2 mb-1">
                                            <div class="form-floating">
                                                <select class="form-select" name="days" id="rangeMostViewsByPage">
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="thisweek">This week</option>
                                                <option value="thismonth" selected>This month</option>
                                                <option value="thisyear">This year</option>
                                                <option value="lastweek">Last week</option>
                                                <option value="lastmonth">Last month</option>
                                                <option value="lastyear">Last year</option>
    
                                                </select>
                                                <label for="rangeMostViewsByPage">Range</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-1">
                                            <div class="form-floating">
                                                <input type="text" name="count" class="form-control" id="floatingCount" placeholder="Count" value="10">
                                                <label for="floatingCount">Count</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-1">
                                            <button class='btn btn-outline-primary' id="applyFilterTransaksiTabungan">Apply Filter</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-lg-12 mb-1" id="errorTransaksiTabungan" style='display: none;'>
                                        <h6 class="font-extrabold mb-3">Error</h6>
                                        <button class='btn btn-primary' id="retryTransaksiTabungan">Retry</button>
                                    </div>
                                </div>
                            </div>
    
                            <div class="card-body text-center">
                                <div id="loaderTransaksiTabungan" style='display: none;'>
                                    <img src="/lte/assets/images/svg-loaders/audio.svg" class="me-4" style="width: 3rem;" alt="audio"/>
                                </div>
                                <div id="chart-transaksi-tabungan"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('vendorJS')
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>
    @if ($user->status == 2)
        <script src="/main/assets/static/js/pages/dashboard.js"></script>
    @endif
@endsection
