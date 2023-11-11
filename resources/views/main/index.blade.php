@extends('layout.main')

@section('title') Sistem Akuntansi UBSP - Login @endsection

@section('content')
<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Beranda Anggota</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldWallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-extrabold mb-1">Total Saldo Tabungan</h6>
                                        <h6 class="font-extrabold mb-0">Rp 6,750,000</h6>
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
                                        <h6 class="font-extrabold mb-0">Rp 5,250,000</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldWallet"></i>
                                    </div>
                                    <div class="name ms-4">
                                        <h6 class="font-extrabold mb-1">Saldo Wajib</h6>
                                        <h6 class="font-extrabold mb-0">Rp 500,000</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldWallet"></i>
                                    </div>
                                    <div class="name ms-4">
                                        <h6 class="font-extrabold mb-1">Saldo Sukarela</h6>
                                        <h6 class="font-extrabold mb-0">Rp 1,000,000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div
                                        class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldTicket"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-extrabold mb-1">Sisa Kredit</h6>
                                        <h6 class="font-extrabold mb-0">Rp 1,650,000</h6>
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
                                        <h6 class="font-extrabold mb-1">Pokok Pinjaman</h6>
                                        <h6 class="font-extrabold mb-0">Rp 150,000</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldTicket"></i>
                                    </div>
                                    <div class="name ms-4">
                                        <h6 class="font-extrabold mb-1">Tagihan + Denda</h6>
                                        <h6 class="font-extrabold mb-0">Rp 150,000 + Rp 0</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldTicket"></i>
                                    </div>
                                    <div class="name ms-4">
                                        <h6 class="font-extrabold mb-1">Dibayar</h6>
                                        <h6 class="font-extrabold mb-0">Rp 1,500,000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
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
                                            <use
                                                xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
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
                                            <use
                                                xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
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
                                            <use
                                                xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Tabungan</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-visitors-profile"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kontribusi Tabungan Sukarela</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('vendorJS')
<script src="/main/assets/static/js/pages/dashboard.js"></script>
@endsection