@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Rekap Kredit
@endsection

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/table-datatable.css">
    <link rel="stylesheet" href="/main/assets/extensions/flatpickr/flatpickr.min.css">
@endsection

@section('content')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h3>Rekap Kredit</h3>
            <input type="date" class="form-control flatpickr-range mb-3" placeholder="Pilih periode tanggal...">
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Lama Angsuran</th>
                                        <th>Nominal</th>
                                        <th>Bunga</th>
                                        <th>Tujuan Pinjaman</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>28-10-2023</td>
                                        <td>1 Bulan</td>
                                        <td>Rp 650,000</td>
                                        <td>0,5%</td>
                                        <td>Beli mesin</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>22-01-2023</td>
                                        <td>3 Bulan</td>
                                        <td>Rp 1,200,000</td>
                                        <td>0,5%</td>
                                        <td>Renovasi rumah</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Nathaniel</td>
                                        <td>mi.Duis@diam.edu</td>
                                        <td>(012165) 76278</td>
                                        <td>Grumo Appula</td>
                                        <td>
                                            <span class="badge bg-danger">Inactive</span>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('vendorJS')
<script src="/main/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="/main/assets/static/js/pages/simple-datatables.js"></script>

<script src="/main/assets/extensions/flatpickr/flatpickr.min.js"></script>
<script src="/main/assets/static/js/pages/date-picker.js"></script>
@endsection
