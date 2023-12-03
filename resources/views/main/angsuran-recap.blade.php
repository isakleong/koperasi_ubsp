@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Rekap Angsuran
@endsection

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/table-datatable.css">
    <link rel="stylesheet" href="/main/assets/extensions/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/extra-component-comment.css">
    <style>
        table tbody tr td {
          text-align: left;
          vertical-align: middle;
        }

        table tbody tr td:nth-child(2):before {
          content: ":";
          display: inline-block;
          padding-left:10px; 
          margin-right:10px; 
        }

        .circles {
            display: flex;
        }
        .circle-with-text {
            background: linear-gradient(#9733EE, #DA22FF);
            justify-content: center;
            align-items: center;
            border-radius: 100%;
            text-align: center;
            /* margin: 5px 20px; */
            font-size: 18px;
            padding: 15px;
            display: flex;
            height: 160px;
            width: 160px;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h3>Data Kredit</h3>
            <table cellpadding="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td>Total Kredit</td>
                    <td>{{ $arrDataHeader[0]["totalKredit"] }}</td>
                  </tr>
                  <tr>
                    <td>Suku Bunga (Per Tahun)</td>
                    <td>{{ $arrDataHeader[0]["rates"] }}%</td>
                  </tr>
                  <tr>
                    <td>Lama Angsuran</td>
                    <td>{{ $arrDataHeader[0]["tenor"] }} bulan</td>
                  </tr>
                  <tr>
                    <td>Angsuran Pokok</td>
                    <td>{{ $arrDataHeader[0]["baseCicilan"] }}</td>
                  </tr>
                  <tr>
                    <td>Angsuran Bunga</td>
                    <td>{{ $arrDataHeader[0]["monthlyRates"] }}</td>
                  </tr>
                  <tr>
                    <td>Total Angsuran (Per Bulan)</td>
                    <td>{{ $arrDataHeader[0]["monthlyCicilan"] }}</td>
                  </tr>
                </tbody>    
            </table>
        </div>
        <div class="page-content">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Angsuran</h4>
                </div>
                <div class="card-body">
                    @foreach ($loanDetailData as $item)
                        <div class="comment">
                            <div class="comment-header">
                                <div class="pr-50">
                                    <div class="circles">
                                        <div class="circle-with-text">
                                            Angsuran<br>Ke {{ $item->indexCicilan+1 }}
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6>Tanggal Jatuh Tempo</h6>
                                            <p>{{ $item->dueDate }}</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6>Tanggal Bayar</h6>
                                            <p>{{ $item->transactionDate }}</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6>Total Angsuran</h6>
                                            <p>{{ $item->total }}</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6>Denda</h6>
                                            <p>{{ $item->charges }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <a href="{{ route('add.angsuran') }}" class="btn icon icon-left btn-primary me-2 text-nowrap" >Bayar Angsuran</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="{{ route('add.angsuran') }}" class="btn icon icon-left btn-warning me-2 text-nowrap" >Detail Pembayaran</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendorJS')
<script src="/main/assets/extensions/flatpickr/flatpickr.min.js"></script>
<script src="/main/assets/static/js/pages/date-picker.js"></script>
@endsection
