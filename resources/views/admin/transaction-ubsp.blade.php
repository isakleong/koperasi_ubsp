@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="/vendor/flatpickr/flatpickr.css" />
    <link rel="stylesheet" type="text/css" href="/vendor/swiper/swiper.css" />
    <link rel="stylesheet" type="text/css" href="/vendor/swiper/ui-carousel.css" />
    <style>
        body.dt-print-view h1 {
            text-align: center;
            margin: 1em;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }


        #lottie-loading {
            position: absolute;
            width: 25%;
            height: 25%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <style>
        #customCard {
            border: none;
            border-radius: 12px;
            color: #fff;
            /* background-image: linear-gradient(to right top, #0D41E1, #0C63E7, #0A85ED, #09A6F3, #07C8F9); */
            /* background-image: linear-gradient(to right top, #545AA7, #6F00FF, #5A4FCF, #6050DC, #7B68EE);
            background-image: linear-gradient(to right top, #696eff, #545AA7, #6F00FF, #5A4FCF, #8364e8, #6050DC, #7B68EE);
            background-image: linear-gradient(to right top, #831bea, #8a1bd9, #a827e4, #6F00FF, #8364e8, #7B68EE, #c4a0f6); */
            background-image: linear-gradient(to right top, #831bea, #8364e8, #7B68EE, #a07bfc);
        }

        #customCardBorder {
            border-top-left-radius: 30px !important;
            border-top-right-radius: 30px !important;
            border: none;
            border-radius: 6px;
            /* background-color: blue; */
            color: #fff;
            /* background-image: linear-gradient(to right top, #0a33b1, #094eb7, #086abc, #0784c2, #05a1c8); */
            /* background-image: linear-gradient(to right top, #2E2787, #000f89, #002387, #1D428A, #1C39BB); */
            background-image: linear-gradient(to right top, #ad5af7, #c4a0f6);
        }
    </style>
@endsection

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Transaksi UBSP</span>
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header text-end">
                        <a href="/admin/transaction/ubsp/create" class="btn btn-primary">Tambah Data</a>
                    </div>

                    <div class="card-body p-0">
                        <form action="{{ route('admin.filter.transaction.ubsp') }}" method="GET"
                            onsubmit="return validateForm()">
                            @csrf
                            <div class="row align-items-end mx-3 mb-3">
                                <div class="col-xl-4 col-12 mb-3">
                                    <label for="startDate">Tanggal Awal</label>
                                    <input type="text" class="form-control dob-picker" placeholder="Hari-Bulan-Tahun"
                                        id="startDate" name="startDate" />
                                    @error('startDate')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-xl-4 col-12 mb-3">
                                    <label for="endDate">Tanggal Akhir</label>
                                    <input type="text" class="form-control dob-picker" placeholder="Hari-Bulan-Tahun"
                                        id="endDate" name="endDate" />
                                    @error('endDate')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-xl-3 col-12 mb-3">
                                    <label>Periode</label>
                                    <select class="form-select" id="period" aria-label="period" name="period">
                                        <option selected>--- Pilih Periode ---</option>
                                        <option value="date">Tanggal</option>
                                        <option value="today">Hari ini</option>
                                        <option value="week">Minggu ini</option>
                                        <option value="month">Bulan ini</option>
                                        <option value="year">Tahun ini</option>
                                        <option value="yesterday">Kemarin</option>
                                        <option value="lastweek">Minggu Lalu</option>
                                        <option value="lastmonth">Bulan Lalu</option>
                                        <option value="lastyear">Tahun Lalu</option>
                                    </select>
                                </div>
                                <div class="col-xl-1 col-12 mb-3 text-end">
                                    <button class="btn rounded-pill btn-icon btn-outline-dark" type="submit"><span
                                            class="tf-icons bx bx-search"></span></button>
                                </div>
                            </div>
                        </form>

                        @if (count($transaction) == 0)
                            <div class="container-xxl container-p-y text-center">
                                <div class="misc-wrapper">
                                    <div class="mb-4">
                                        <img src="/administrator/assets/img/illustrations/not-found.jpg"
                                            alt="page-misc-error-light" width="500" class="img-fluid"
                                            data-app-dark-img="illustrations/page-misc-error-dark.png"
                                            data-app-light-img="illustrations/page-misc-error-light.png" />
                                    </div>
                                    <h5 class="mb-4 mx-2">Tidak ada daftar transaksi UBSP.</h5>
                                </div>
                            </div>
                        @else
                            <h5 class="text-center">Daftar Transaksi UBSP</h5>
                            @php
                                $i = ($transaction->currentPage() - 1) * $transaction->perPage() + 1;
                            @endphp

                            <div class="container-xxl container-p-y">
                                <form action="" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari..." aria-label="Cari..." aria-describedby="button-addon2" />
                                        <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari</button>
                                      </div>
                                </form>
                            </div>
                            
                            @foreach ($transaction as $item)
                                <div class="mb-4">
                                    <div class="container-fluid">
                                        <div class="p-3" id="customCard">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4><span
                                                        class="badge badge-center rounded-pill bg-white text-black p-3">{{ $i++ }}</span>
                                                </h4>
                                                <h5 class="text-white">
                                                    {{ \Carbon\Carbon::parse($item->transactionDate)->format('d-m-Y') }}
                                                </h5>
                                            </div>
                                            <h5 class="text-white px-2 mt-3">{{ $item->docId }}</h5>
                                            <h5 class="text-white px-2 mt-3">{{ $item->notes }}</h5>

                                            <div class="row">
                                                <div class="col-xl-6 mb-3">
                                                    <div class="card">
                                                        <h5 class="card-header">Debit</h5>
                                                        <div class="card-body">
                                                            <ul class="timeline">
                                                                @php
                                                                    $tempTotalDebit = 0.0;
                                                                @endphp
                                                                @foreach ($item->debitDetail as $detail)
                                                                    @php
                                                                        $tempTotalDebit += $detail->total;
                                                                    @endphp
                                                                    <li
                                                                        class="timeline-item pb-4 timeline-item-info border-left-dashed">
                                                                        <span
                                                                            class="timeline-indicator-advanced timeline-indicator-primary">
                                                                            <i class='bx bxs-card'></i>
                                                                        </span>
                                                                        <div class="timeline-event">
                                                                            <div class="timeline-header">
                                                                                <h6 class="mb-0">
                                                                                    {{ $detail->account->accountNo }} -
                                                                                    {{ $detail->account->name }}</h6>
                                                                                <span>Rp
                                                                                    {{ number_format($detail->total, 2, '.', ',') }}</span>
                                                                            </div>
                                                                            <div class="timeline-header">
                                                                                <h6 class="mb-2">
                                                                                    {{ $detail->notes }}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                                <li class="timeline-end-indicator">
                                                                    <span>
                                                                        <i class="bx bx-check-circle"></i>
                                                                        Total Debit : <span>Rp
                                                                            {{ number_format($tempTotalDebit, 2, '.', ',') }}</span>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 mb-3">
                                                    <div class="card">
                                                        <h5 class="card-header">Kredit</h5>
                                                        <div class="card-body">
                                                            <ul class="timeline">
                                                                @php
                                                                    $tempTotalKredit = 0.0;
                                                                @endphp
                                                                @foreach ($item->creditDetail as $detail)
                                                                    @php
                                                                        $tempTotalKredit += $detail->total;
                                                                    @endphp
                                                                    <li
                                                                        class="timeline-item pb-4 timeline-item-info border-left-dashed">
                                                                        <span
                                                                            class="timeline-indicator-advanced timeline-indicator-primary">
                                                                            <i class='bx bxs-card'></i>
                                                                        </span>
                                                                        <div class="timeline-event">
                                                                            <div class="timeline-header">
                                                                                <h6 class="mb-0">
                                                                                    {{ $detail->account->accountNo }} -
                                                                                    {{ $detail->account->name }}</h6>
                                                                                <span>Rp
                                                                                    {{ number_format($detail->total, 2, '.', ',') }}</span>
                                                                            </div>
                                                                            <div class="timeline-header">
                                                                                <h6 class="mb-2">
                                                                                    {{ $detail->notes }}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                                <li class="timeline-end-indicator">
                                                                    <span>
                                                                        <i class="bx bx-check-circle"></i>
                                                                        Total Kredit : <span>Rp
                                                                            {{ number_format($tempTotalKredit, 2, '.', ',') }}</span>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if (count($item->transactionImage) > 0)
                                                <div class="d-grid col-lg-6 mx-auto">
                                                    <button type="button" class="btn rounded-pill btn-light text-black btn-lg" data-bs-toggle="modal" data-bs-target="#modalTransactionImage">
                                                        <span class="tf-icons bx bxs-image-alt me-1"></span>Lihat Bukti
                                                    </button>
                                                </div>
                                                <div class="modal fade" id="modalTransactionImage" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalScrollableTitle">Bukti Transaksi</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col mb-3">
                                                                    <div class="col-md-12 mb-4">
                                                                        <div class="swiper" id="swiper-3d-cube-effect">
                                                                            <div class="swiper-wrapper">
                                                                              @foreach ($item->transactionImage as $img)
                                                                                  <div class="swiper-slide" style="background-image:url(/{{ $img->image }})"></div>    
                                                                              @endforeach
                                                                            </div>
                                                                            <div class="swiper-pagination"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="p-4 mt-4" id="customCardBorder">
                                                <div class="text-center">
                                                    @if ($tempTotalDebit == $tempTotalKredit && $item->totalDebit == $item->totalKredit)
                                                        <h4 class="cardholder text-white m-0">Rp
                                                            {{ number_format($item->totalDebit, 2, '.', ',') }}</h4>
                                                    @else
                                                        <h4 class="cardholder text-white m-0">ERROR (Tidak Seimbang)</h4>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div id="overlay">
                                    <div id="lottie-loading"></div>
                                </div> --}}
                            @endforeach

                            <div class="container-xxl container-p-y">
                                {{$transaction->links()}}
                            </div>

                            {{-- <table class="table caption-top table-sm table-bordered table-hover table-striped"
                                id="table1" style="width: 100%">
                                <caption>
                                    <h5 class="text-center">Daftar Transaksi UBSP</h5>
                                </caption>
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">#ID</th>
                                        <th rowspan="3">Tanggal</th>
                                        <th colspan="2">Akun</th>
                                        <th colspan="2">Total</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($transaction as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->docId }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->transactionDate)->format('d-m-Y') }}</td>
                                            <td>
                                                @foreach ($item->debitDetail as $detail)
                                                    {{ $detail->account->name }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($item->creditDetail as $detail)
                                                    {{ $detail->account->name }}
                                                @endforeach
                                            </td>
                                            <td>{{ $item->totalDebit }}</td>
                                            <td>{{ $item->totalKredit }}</td>
                                            <td>{{ $item->notes }}</td>
                                            <td>
                                                <a href="{{ route('admin.account_category.edit', $item->id) }}"
                                                    class="btn icon btn-sm btn-primary d-inline-block m-1"
                                                    data-bs-toggle="tooltip" title="Edit"><i
                                                        class="bx bxs-pencil"></i></a>
                                                <form action="{{ route('admin.account_category.destroy', $item->id) }}"
                                                    method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip"
                                                    title="Hapus">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn icon btn-sm btn-danger show_confirm"><i
                                                            class="bx bxs-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div id="overlay">
                                            <div id="lottie-loading"></div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table> --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('vendorJS')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert2.js"></script>
    <script src="/vendor/lottie/lottie.min.js"></script>
    <script src="/vendor/flatpickr/flatpickr.js"></script>
    <script src="/vendor/moment/moment.min.js"></script>
    <script src="/vendor/swiper/swiper.js"></script>

    <script src="/vendor/datatable/js/datatables.min.js"></script>
    <script src="/vendor/datatable/js/pdfmake.min.js"></script>
    <script src="/vendor/datatable/js/vfs_fonts.js"></script>

    <script>
        $('#modalTransactionImage').on('shown.bs.modal', function () {
            const swiper = new Swiper('.swiper', {
                effect: "cube",
                grabCursor: !0, 
                cubeEffect: {
                    shadow: !0,
                    slideShadows: !0,
                    shadowScale: .94,
                    shadowOffset: 20
                },
                pagination: {
                    el: ".swiper-pagination"
                }
            });
        });
    </script>

    <script>
        function validateForm() {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;

            if (startDate.trim() === '' || endDate.trim() === '') {
                Swal.fire({
                    title: '',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Tanggal Akhir tidak boleh sebelum Tanggal Awal</p>',
                    showCloseButton: true,
                    focusConfirm: false,
                    didOpen: () => {
                        var animation = lottie.loadAnimation({
                            container: document.getElementById('lottie-container'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: '/assets/animations/info.json',
                            rendererSettings: {
                                preserveAspectRatio: 'xMidYMid slice'
                            }
                        });
                    },
                    didClose: () => {
                        // Scroll the page back to its original position
                        // window.scrollTo(0, document.documentElement.dataset.scrollY || 0);
                    }
                });
                return false;
            }
            return true;
        }


        $(document).ready(function() {

            $(".dob-picker").flatpickr({
                monthSelectorType: "static",
                dateFormat: "d-m-Y"
            });

            $('.dob-picker').change(function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                if (startDate && endDate) {
                    var parsedStartDate = moment(startDate, 'DD-MM-YYYY');
                    var parsedEndDate = moment(endDate, 'DD-MM-YYYY');

                    if (parsedEndDate.isBefore(parsedStartDate)) {
                        Swal.fire({
                            title: '',
                            html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                                '<p class="mt-2">Tanggal Akhir tidak boleh sebelum Tanggal Awal</p>',
                            showCloseButton: true,
                            focusConfirm: false,
                            didOpen: () => {
                                var animation = lottie.loadAnimation({
                                    container: document.getElementById(
                                        'lottie-container'),
                                    renderer: 'svg',
                                    loop: true,
                                    autoplay: true,
                                    path: '/assets/animations/info.json',
                                    rendererSettings: {
                                        preserveAspectRatio: 'xMidYMid slice'
                                    }
                                });
                            }
                        });

                        $('#startDate').val('');
                        $('#endDate').val('');
                        return;
                    }

                    $('#period').val('date');
                }
            });

            $('#period').change(function() {
                var period = $(this).val();
                var startDatePicker = flatpickr('#startDate', {
                    dateFormat: "d-m-Y"
                });
                var endDatePicker = flatpickr('#endDate', {
                    dateFormat: "d-m-Y"
                });
                var today = moment();
                var startOfWeek = moment().startOf('week');
                var endOfWeek = moment().endOf('week');

                switch (period) {
                    case 'date':
                        startDatePicker.setDate('');
                        endDatePicker.setDate('');
                        break;
                    case 'today':
                        startDatePicker.setDate(today.toDate());
                        endDatePicker.setDate(today.toDate());
                        break;
                    case 'week':
                        startDatePicker.setDate(startOfWeek.toDate());
                        endDatePicker.setDate(endOfWeek.toDate());
                        break;
                    case 'month':
                        startDatePicker.setDate(today.startOf('month').toDate());
                        endDatePicker.setDate(today.endOf('month').toDate());
                        break;
                    case 'year':
                        startDatePicker.setDate(today.startOf('year').toDate());
                        endDatePicker.setDate(today.endOf('year').toDate());
                        break;
                    case 'yesterday':
                        startDatePicker.setDate(today.subtract(1, 'days').toDate());
                        endDatePicker.setDate(today.toDate());
                        break;
                    case 'lastweek':
                        startDatePicker.setDate(startOfWeek.subtract(1, 'week').toDate());
                        endDatePicker.setDate(endOfWeek.subtract(1, 'week').toDate());
                        break;
                    case 'lastmonth':
                        startDatePicker.setDate(today.startOf('month').subtract(1, 'month').toDate());
                        endDatePicker.setDate(today.endOf('month').subtract(1, 'month').toDate());
                        break;
                    case 'lastyear':
                        startDatePicker.setDate(today.startOf('year').subtract(1, 'year').toDate());
                        endDatePicker.setDate(today.endOf('year').subtract(1, 'millisecond').toDate());
                        break;
                }
            });


            $('form').submit(function() {
                $(':submit', this).prop('disabled', true);

                var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-loading'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: '/assets/animations/loading.json',
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid slice'
                    }
                });
                $('#overlay').show();
                $('body, html').css('overflow', 'hidden');
                return true;
            });

            function showResultDialog(type) {
                Swal.fire({
                    title: type === 'success' ? 'Berhasil' : 'Error',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">' + (type === 'success' ? "{{ Session::get('success') }}" :
                            "{{ Session::get('errorData') }}") + '</p>',
                    showCloseButton: true,
                    focusConfirm: false,
                    didOpen: () => {
                        var animation = lottie.loadAnimation({
                            container: document.getElementById('lottie-container'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: type === 'success' ? '/assets/animations/success.json' :
                                '/assets/animations/error.json',
                            rendererSettings: {
                                preserveAspectRatio: 'xMidYMid slice'
                            }
                        });
                    }
                });
            }

            @if ($message = session('errorData'))
                showResultDialog('error');
            @endif

            @if ($message = session('success'))
                showResultDialog('success');
            @endif
        });
    </script>
@endsection
