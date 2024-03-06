@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css" />
@endsection

@section('content')
    {{-- @include('sweetalert::alert') --}}
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Beranda Simpanan /</span> Review Pengajuan
        </h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4 bg-gradient-primary">
                    <div class="card-body">
                        <div class="row justify-content-between mb-3">
                            <div
                                class="col-md-12 col-lg-7 col-xl-12 col-xxl-7 text-center text-lg-start text-xl-center text-xxl-start order-1  order-lg-0 order-xl-1 order-xxl-0">
                                <h4 class="card-title text-white text-nowrap">Data Per Anggota</h4>
                                <p class="card-text text-white">Rekapitulasi data simpanan masing-masing anggota UBSP</p>
                            </div>
                            <span class="col-md-12 col-lg-5 col-xl-12 col-xxl-5 text-center mx-auto mx-md-0 mb-2"><img
                                    src="/administrator/assets/img/illustrations/review-simpanan.png"
                                    class="w-75 m-2"></span>
                        </div>

                        <a href="{{ route('admin.recap.simpanan') }}" class="btn btn-white text-primary w-100 fw-medium shadow-sm">Lihat Rekap</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card mb-4 bg-gradient-warning">
                    <div class="card-body">
                        <div class="row justify-content-between mb-3">
                            <div
                                class="col-md-12 col-lg-7 col-xl-12 col-xxl-7 text-center text-lg-start text-xl-center text-xxl-start order-1  order-lg-0 order-xl-1 order-xxl-0">
                                <h4 class="card-title text-white text-nowrap">Pengajuan Simpanan</h4>
                                <p class="card-text text-white">Konfirmasi pengajuan data simpanan (selain simpanan pokok) anggota UBSP</p>
                            </div>
                            <span class="col-md-12 col-lg-5 col-xl-12 col-xxl-5 text-center mx-auto mx-md-0 mb-2"><img
                                    src="/administrator/assets/img/illustrations/approval.png" class="w-75 m-2"></span>
                        </div>
                        <button class="btn btn-white text-warning w-100 fw-medium shadow-sm"
                            data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Lihat Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('vendorJS')
    <script src="/vendor/jquery/jquery.min.js"></script>

    <script type="text/javascript" src="/vendor/datatable/js/datatables.min.js"></script>

    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable({
                responsive: true
            });

            // var table = $('#table1').DataTable({
            //     responsive: true,
            //     processing: true,
            //     serverSide: true,
            //     ajax: {
            //         url: '/admin/coba', // Replace with your Laravel API endpoint
            //         type: 'GET',
            //     },
            //     columns: [
            //         { data: 'column1', name: 'column1' },
            //         { data: 'column2', name: 'column2' },
            //         // Add more columns as needed
            //     ],
            // });

            const registerDeleteItemHandlers = () => {
                $('.show_confirm').click(function(event) {
                    var form = $(this).closest("form");
                    var name = $(this).data("name");
                    event.preventDefault();
                    Swal.fire({
                        title: 'Delete the data?',
                        text: "If you delete this, it will be gone forever.",
                        icon: 'question',
                        showDenyButton: true,
                        confirmButtonText: 'Yes, delete',
                        denyButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        } else if (result.isDenied) {
                            // Swal.fire('Changes are not saved', '', 'info');
                        }
                    });
                });
            };

            registerDeleteItemHandlers();

            $("#table1").on("draw.dt", function() {
                registerDeleteItemHandlers();
            });

            table.on('responsive-display', function(e, datatable, row, showHide, update) {
                // console.log('Details for row '+row.index()+' '+(showHide ? 'shown' : 'hidden'));
                registerDeleteItemHandlers();
            });

            $('.show_confirm').click(function(event) {
                event.preventDefault();

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Simpan Data?',
                    text: '',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, simpan',
                    denyButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $(function() {
                $("#nominal").keyup(function(e) {
                    $(this).val(format($(this).val()));
                });
            });

            var format = function(num) {
                var str = num.toString().replace("", ""),
                    parts = false,
                    output = [],
                    i = 1,
                    formatted = null;
                if (str.indexOf(".") > 0) {
                    parts = str.split(".");
                    str = parts[0];
                }
                str = str.split("").reverse();
                for (var j = 0, len = str.length; j < len; j++) {
                    if (str[j] != ",") {
                        output.push(str[j]);
                        if (i % 3 == 0 && j < (len - 1)) {
                            output.push(",");
                        }
                        i++;
                    }
                }
                formatted = output.reverse().join("");
                return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
            };
        });
    </script>

    <script>
        @if ($message = session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Formulir setoran simpanan belum diisi secara lengkap',
                // text: '{{ Session::get('errors') }}',
            })
        @endif

        @if ($message = session('warning'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ Session::get('warning') }}',
            })
        @endif
    </script>
@endsection
