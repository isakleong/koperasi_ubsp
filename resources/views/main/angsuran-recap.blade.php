@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Rekap Angsuran
@endsection

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/table-datatable.css">
    <link rel="stylesheet" href="/main/assets/extensions/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/extra-component-comment.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
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
            /* font-size: 18px; */
            padding: 15px;
            display: flex;
            height: 110px;
            width: 110px;
            color: #fff;
        }

        .timeline-with-icons {
            border-left: 3px solid hsl(0, 0%, 90%);
            position: relative;
            list-style: none;
        }

        .timeline-with-icons .timeline-item {
            position: relative;
        }

        .timeline-with-icons .timeline-item:after {
            position: absolute;
            display: block;
            top: 0;
        }

        .timeline-with-icons .timeline-icon {
            position: absolute;
            left: -48px;
            background-color: hsl(217, 88.2%, 90%);
            color: hsl(217, 88.8%, 35.1%);
            border-radius: 50%;
            height: 31px;
            width: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-tabs .nav-item .nav-link {
            background-color:lavender;
            color: #000;
        }

        .nav-tabs .nav-item .nav-link.active {
            color: white;
            background: linear-gradient(#4e54c8, #8f94fb );
        }

        /* .btn {
            flex: 1 1 auto;
            margin: 10px;
            padding: 30px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
        } */
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

        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="justified-tab-0" data-bs-toggle="tab" href="#justified-tabpanel-0" role="tab" aria-controls="justified-tabpanel-0" aria-selected="true">Mendatang</a>
              </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="justified-tab-1" data-bs-toggle="tab" href="#justified-tabpanel-1" role="tab" aria-controls="justified-tabpanel-1" aria-selected="true">Pending</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="justified-tab-2" data-bs-toggle="tab" href="#justified-tabpanel-2" role="tab" aria-controls="justified-tabpanel-2" aria-selected="false">Disetujui</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="justified-tab-3" data-bs-toggle="tab" href="#justified-tabpanel-3" role="tab" aria-controls="justified-tabpanel-3" aria-selected="false">Ditolak</a>
            </li>
        </ul>
        <div class="tab-content pt-5" id="tab-content">
            <div class="tab-pane active" id="justified-tabpanel-0" role="tabpanel" aria-labelledby="justified-tab-0">
                <div class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Angsuran Mendatang</h4>
                        </div>
                        <div class="card-body">
                            <section class="p-2">
                                <ul class="timeline-with-icons">
                                    @php
                                        $cntUpcomingData = 0;
                                    @endphp
                                    @foreach ($loanDetailData as $item)
                                        @if ($item->status == 0)
                                            @php
                                                $cntUpcomingData++;
                                            @endphp
                                            <li class="timeline-item mb-5">                        
                                                <span class="timeline-icon">
                                                <i class="fas fa-money-bill-wave text-primary fa-sm fa-fw"></i>
                                                </span>
                                                <h5 class="fw-bold">Angsuran Ke {{ $item->indexCicilan+1 }}</h5>
                                                <p class="text-muted fw-bold mb-0">Jatuh Tempo</p>
                                                <p class="mb-1">{{ $item->dueDate }}</p>
                                                <p class="text-muted fw-bold mb-0">Total Angsuran</p>
                                                <p class="mb-1">{{ $item->total }}</p>
                                                <p class="text-muted fw-bold mb-0">Total Denda</p>
                                                <p class="mb-1">{{ $item->charges }}</p>
                                                <div class="col-lg-12 mb-3">
                                                    <button id="hitungSimulasi" type="button" class="btn btn-primary simulasi" data-bs-toggle="modal" data-bs-target="#bayarAngsuran">Bayar Angsuran</button>
                                                </div>
                                                
                                                <div class="modal fade" id="bayarAngsuran" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Bayar Angsuran</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form form-vertical" >
                                                                    @csrf
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="mobile-id-icon">Jenis Pembayaran</label>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="tipe-pembayaran" id="tipe-cash" value="cash" checked>
                                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                                            Cash
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="tipe-pembayaran" id="tipe-transfer" value="transfer">
                                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                                            Transfer
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12" id="bukti-trf" style="display: none;">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="mobile-id-icon">Bukti Pembayaran</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="file" class="image-exif-filepond" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 d-flex justify-content-end">
                                                                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                                                                    Simpan
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif    
                                    @endforeach
                                </ul>
                                @if ($cntUpcomingData == 0)
                                    <div class="col-md-12 col-12 text-center">
                                        <img src="/main/assets/compiled/png/bg_empty.jpg" width="50%" alt="Logo">
                                    </div>
                                    <h6 class="text-center mt-3">Tidak ada data angsuran mendatang.</h6>
                                @endif
                            </section>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="justified-tabpanel-1" role="tabpanel" aria-labelledby="justified-tab-1">
                <div class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Riwayat Angsuran</h4>
                            <h4 class="card-title">(Menunggu ACC)</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $cntPendingData = 0;
                            @endphp
                            @foreach ($loanDetailData as $item)
                                @if ($item->status == 1)
                                    @php
                                        $cntPendingData++;
                                    @endphp
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
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            @if ($cntPendingData == 0)
                                <div class="col-md-12 col-12 text-center">
                                    <img src="/main/assets/compiled/png/bg_empty.jpg" width="50%" alt="Logo">
                                </div>
                                <h6 class="text-center mt-3">Tidak ada pengajuan data angsuran yang belum diproses.</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="justified-tabpanel-2" role="tabpanel" aria-labelledby="justified-tab-2">
                <div class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Riwayat Angsuran</h4>
                            <h4 class="card-title">(Sudah ACC)</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $cntAccData = 0;
                            @endphp
                            @foreach ($loanDetailData as $item)
                                @if ($item->status == 2)
                                    @php
                                        $cntAccData++;
                                    @endphp
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
                                                    <div class="col-lg-12">
                                                        <h6>Disetujui pada {{ $item->charges }}</h6>
                                                    </div>
                                                </div>
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
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            @if ($cntAccData == 0)
                                <div class="col-md-12 col-12 text-center">
                                    <img src="/main/assets/compiled/png/bg_empty.jpg" width="50%" alt="Logo">
                                </div>
                                <h6 class="text-center mt-3">Tidak ada pengajuan data angsuran yang diterima.</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                <div class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Riwayat Angsuran</h4>
                            <h4 class="card-title">(Gagal ACC)</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $cntRejectData = 0;
                            @endphp
                            @foreach ($loanDetailData as $item)
                                @if ($item->status == 3)
                                    @php
                                        $cntRejectData++;
                                    @endphp
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
                                                    <div class="col-lg-12">
                                                        <h6>Ditolak pada {{ $item->charges }}</h6>
                                                    </div>
                                                </div>
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
                                                asdas
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            
                            @if ($cntRejectData == 0)
                            <div class="col-md-12 col-12 text-center">
                                <img src="/main/assets/compiled/png/bg_empty.jpg" width="50%" alt="Logo">
                            </div>
                            <h6 class="text-center mt-3">Tidak ada pengajuan data angsuran yang ditolak.</h6>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendorJS')
<script src="/main/assets/extensions/flatpickr/flatpickr.min.js"></script>
<script src="/main/assets/static/js/pages/date-picker.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
</script>
<script src="/main/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
</script>
<script src="/main/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
<script
    src="/main/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
</script>
<script src="/main/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
<script src="/main/assets/extensions/filepond/filepond.js"></script>
<script src="/main/assets/extensions/toastify-js/src/toastify.js"></script>
<script src="/main/assets/static/js/pages/filepond.js"></script>

<script>
    $(document).ready(function () {
        $('input[type="radio"]').on('change', function () {
            // Get the selected value
            var selectedValue = $('input[name="tipe-pembayaran"]:checked').val();
            
            if(selectedValue == 'transfer') {
                $('#bukti-trf').show();
            } else {
                $('#bukti-trf').hide();
            }
        });
    });
</script>
@endsection
