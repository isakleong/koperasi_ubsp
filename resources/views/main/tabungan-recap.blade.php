@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Rekap Tabungan
@endsection

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/table-datatable.css">
    <link rel="stylesheet" href="/main/assets/extensions/flatpickr/flatpickr.min.css">
@endsection

@section('content')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h3>Rekap Tabungan</h3>
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
                                        <th>Jenis Tabungan</th>
                                        <th>Nominal</th>
                                        <th>Keterangan</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>05-11-2023</td>
                                        <td>Simpanan Sukarela</td>
                                        <td>50,000</td>
                                        <td>Sumbangan</td>
                                        <td>Transfer</td>
                                        <td>
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>28-10-2023</td>
                                        <td>Simpanan Pokok</td>
                                        <td>375,000</td>
                                        <td></td>
                                        <td>Transfer</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>07-10-2023</td>
                                        <td>Simpanan Wajib</td>
                                        <td>100,000</td>
                                        <td>Setor wajib</td>
                                        <td>Cash</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>14-02-2023</td>
                                        <td>Simpanan Pokok</td>
                                        <td>100,000</td>
                                        <td></td>
                                        <td>Cash</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>06-02-2023</td>
                                        <td>Simpanan Wajib</td>
                                        <td>45,000</td>
                                        <td>Setoran wajib</td>
                                        <td>Cash</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>31-01-2023</td>
                                        <td>Simpanan Pokok</td>
                                        <td>100,000</td>
                                        <td>Menabung</td>
                                        <td>Cash</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>26-01-2023</td>
                                        <td>Simpanan Pokok</td>
                                        <td>750,000</td>
                                        <td>tabung</td>
                                        <td>Cash</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>06-01-2023</td>
                                        <td>Simpanan Wajib</td>
                                        <td>45,000</td>
                                        <td>Setoran awal</td>
                                        <td>Cash</td>
                                        <td>
                                            <span class="badge bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>05-01-2023</td>
                                        <td>Simpanan Pokok</td>
                                        <td>750,000</td>
                                        <td>Menabung</td>
                                        <td>Cash</td>
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
