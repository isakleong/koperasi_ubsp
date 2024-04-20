@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/flatpickr/flatpickr.css" />
@endsection

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Jurnal Harian</span>
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    {{-- <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Laporan Jurnal</h5>
                        <a href="/admin/journal/create" class="btn btn-primary">Input Jurnal</a>
                    </div> --}}

                    <div class="card-body">
                        <form action="{{ route('admin.filter.journal') }}" method="GET"
                            onsubmit="return validateForm()">
                            @csrf
                            <div class="row align-items-end mb-3">
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
                                    <h5 class="mb-4 mx-2">Laporan Jurnal Harian belum tersedia, pastikan sudah menginput semua data transaksi.</h5>
                                </div>
                            </div>
                        @else
                            <div class="btn-group" id="dropdown-icon-demo">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-file-blank me-1"></i> Export Data
                            </button>
                            <ul class="dropdown-menu">
                                <form action="{{ route('admin.export.journal') }}" method="post">
                                    @csrf
                                    <li>
                                        <button type="submit" name="action" class="dropdown-item d-flex align-items-center" value="pdf"><i class="bx bx-chevron-right scaleX-n1-rtl"></i>PDF</button>
                                    </li>
                                    <li>
                                        <button type="submit" name="action" class="dropdown-item d-flex align-items-center" value="excel"><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Excel</button>
                                    </li>
                                    <li>
                                        <button type="submit" name="action" class="dropdown-item d-flex align-items-center" value="print"><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Print</button>
                                    </li>
                                </form>
                            </ul>
                          </div>

                            <h5 class="text-center mb-4">Laporan Jurnal Harian - Sistem Akuntansi UBSP</h5>

                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="mb-0">Periode Awal</h5>
                                    <p>{{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}</p>
                                    <h5 class="mb-0">Periode Akhir</h5>
                                    <p>{{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>
                                </div>
                                <div>
                                    <h5 class="mb-0">Total Debit</h5>
                                    <p>Rp {{ number_format($totalDebit, 2, '.', ',') }}</p>
                                    <h5 class="mb-0">Total Kredit</h5>
                                    <p>Rp {{ number_format($totalCredit, 2, '.', ',') }}</p>
                                </div>
                            </div>
                        
                            @foreach ($transaction as $item)
                                <div class="bg-label-primary p-3 mb-3" style="border-radius: 12px 12px 12px 12px;">
                                    <p class="mb-0 text-black"><strong>{{ $item->docId }}</strong></p>

                                    <div class="d-flex justify-content-between text-black">
                                        @if (strtolower($item->kind) == 'others')
                                        <p class="mb-0"><strong>Transaksi Internal UBSP</strong></p>
                                        @elseif (strtolower($item->kind) == 'pokok')
                                            <p class="mb-0"><strong>Transaksi Simpanan Pokok</strong></p>
                                        @elseif (strtolower($item->kind) == 'wajib')
                                            <p class="mb-0"><strong>Transaksi Simpanan Wajib</strong></p>
                                        @elseif (strtolower($item->kind) == 'sukarela')
                                            <p class="mb-0"><strong>Transaksi Simpanan Sukarela</strong></p>
                                        @elseif (strtolower($item->kind) == 'sibuhar')
                                            <p class="mb-0"><strong>Transaksi Simpanan Sibuhar</strong></p>
                                        @endif

                                        <p class="mb-0"><strong>{{ \Carbon\Carbon::parse($item->transactionDate)->format('d-m-Y') }}</strong></p>
                                    </div>

                                    @if ($item->notes == null)
                                        <span class="mb-0 text-black"><strong>Keterangan : -</strong></span>
                                    @else
                                        <span class="mb-0 text-black"><strong>Keterangan : {{ $item->notes }}</strong></span>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover table-striped table-bordered ml-2 mt-2 mb-2 table-light" id="table1" style="width: 100%">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th>No Akun</th>
                                                    <th>Nama Akun</th>
                                                    <th>No Anggota</th>
                                                    <th>Nama Anggota</th>
                                                    <th>Keterangan</th>
                                                    <th>Debit</th>
                                                    <th>Kredit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($item->debitDetail as $detail)
                                                    <tr>
                                                        <td>{{ $detail->account->accountNo }}</td>
                                                        <td>{{ $detail->account->name }}</td>
                                                        <td>{{ $item->memberId }}</td>
                                                        <td>{{ $item->memberId }}</td>
                                                        <td>{{ $item->notes }}</td>
                                                        <td class="text-end">Rp {{ number_format($detail->total, 2, '.', ',') }}</td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($item->creditDetail as $detail)
                                                    <tr>
                                                        <td>{{ $detail->account->accountNo }}</td>
                                                        <td>{{ $detail->account->name }}</td>
                                                        <td>{{ $item->memberId }}</td>
                                                        <td>{{ $item->memberId }}</td>
                                                        <td>{{ $item->notes }}</td>
                                                        <td></td>
                                                        <td class="text-end">Rp {{ number_format($detail->total, 2, '.', ',') }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="table-group-divider">
                                                    <td colspan="5" class="bg-label-secondary text-end"><span class="mb-0 text-black"><strong>Sub Total</strong></span></td>
                                                    <td class="bg-label-secondary text-end"><span class="mb-0 text-black"><strong>Rp {{ number_format($item->totalDebit, 2, '.', ',') }}</strong></span></td>
                                                    <td class="bg-label-secondary text-end"><span class="mb-0 text-black"><strong>Rp {{ number_format($item->totalKredit, 2, '.', ',') }}</strong></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- <table class="table table-sm table-hover table-bordered mb-4" id="table1" style="width: 100%">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>No Akun</th>
                                            <th>Nama Akun</th>
                                            <th>No Anggota</th>
                                            <th>Nama Anggota</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->debitDetail as $detail)
                                            <tr>
                                                <td>{{ $detail->account->accountNo }}</td>
                                                <td>{{ $detail->account->name }}</td>
                                                <td>{{ $item->memberId }}</td>
                                                <td>{{ $item->memberId }}</td>
                                                <td class="text-end">Rp {{ number_format($detail->total, 2, '.', ',') }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        @foreach ($item->creditDetail as $detail)
                                            <tr>
                                                <td>{{ $detail->account->accountNo }}</td>
                                                <td>{{ $detail->account->name }}</td>
                                                <td>{{ $item->memberId }}</td>
                                                <td>{{ $item->memberId }}</td>
                                                <td></td>
                                                <td class="text-end">Rp {{ number_format($detail->total, 2, '.', ',') }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-group-divider">
                                            <td colspan="4" class="bg-label-primary text-end"><span class="mb-0 text-black"><strong>Sub Total</strong></span></td>
                                            <td class="bg-label-primary text-end"><span class="mb-0 text-black"><strong>Rp {{ number_format($item->totalDebit, 2, '.', ',') }}</strong></span></td>
                                            <td class="bg-label-primary text-end"><span class="mb-0 text-black"><strong>Rp {{ number_format($item->totalKredit, 2, '.', ',') }}</strong></span></td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                            @endforeach
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

            $('.show_confirm').click(function(event) {
                event.preventDefault();

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Hapus Data?',
                    text: '',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, hapus',
                    denyButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });
        });
    </script>

    <script>
        @if ($message = session('errorData'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                // text: '',
                text: '{{ Session::get('errorData') }}',
            })
        @endif
    </script>
@endsection
