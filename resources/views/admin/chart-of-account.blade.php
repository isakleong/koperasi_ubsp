@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
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
@endsection

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Daftar Akun</span>
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Akun</h5>
                        <a href="/admin/account/create" class="btn btn-primary">Tambah Data</a>
                    </div>

                    <div class="card-body">
                        @if (count($account) == 0)
                            <div class="container-xxl container-p-y text-center">
                                <div class="misc-wrapper">
                                    <div class="mb-4">
                                        <img src="/administrator/assets/img/illustrations/not-found.jpg"
                                            alt="page-misc-error-light" width="500" class="img-fluid"
                                            data-app-dark-img="illustrations/page-misc-error-dark.png"
                                            data-app-light-img="illustrations/page-misc-error-light.png" />
                                    </div>
                                    <h5 class="mb-4 mx-2">Tidak ada daftar akun.</h5>
                                </div>
                            </div>
                        @else
                            <table class="table caption-top table-sm table-bordered table-hover table-striped" id="table1" style="width: 100%">
                                <caption><h5 class="text-center">Daftar Akun</h5></caption>
                                <thead>
                                    <tr>
                                        <th>Kode Akun</th>
                                        <th>Nama Akun</th>
                                        <th>Kategori</th>
                                        <th>Saldo Normal</th>
                                        <th>Saldo</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <!-- Add other columns as needed -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($account as $rootNode)
                                        @include('admin.partials.account-tree', ['account' => $rootNode])
                                    @endforeach
                                </tbody>
                            </table>
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

    <script src="/vendor/datatable/js/datatables.min.js"></script>
    <script src="/vendor/datatable/js/pdfmake.min.js"></script>
    <script src="/vendor/datatable/js/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            var table = new DataTable('#table1', {
                responsive: true,
                language: {
                    search: 'Cari : ',
                    zeroRecords: 'Kategori Akun tidak ditemukan',
                    infoEmpty: 'Menampilkan 0 data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    lengthMenu: '_MENU_ per halaman'
                }
            });
            new DataTable.Buttons(table, {
                buttons: [
                {
                    extend: 'collection',
                    text: 'Ekspor Data',
                    className: 'custom-html-collection',
                    buttons: [
                        {
                            extend: 'pdfHtml5',
                            title: 'Laporan Daftar Akun \nSistem Akuntansi UBSP',
                            exportOptions: {
                                columns: [0, 1, 2, 3],
                            },
                            customize: function(doc) {
                                doc.content[2].table.widths =Array(doc.content[2].table.body[0].length + 1).join('*').split('');
                                doc.defaultStyle.alignment = 'center';
                                doc.styles.tableHeader.alignment = 'center';
                            },
                            pageSize: 'A4',
                        },
                        {
                            extend: 'excel',
                            autoFilter: true,
                            title: 'Laporan Daftar Akun - Sistem Akuntansi UBSP',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                var range = calculateRange(sheet); // Calculate the range of cells with values
                                $('row:first c', sheet).attr('s', '22');
                                $('row', sheet).each(function(index) {
                                    if (index >= range.startRow && index <= range.endRow) {
                                        $(this).find('c').each(function() {
                                            var columnIndex = parseInt($(this).attr('r').replace(/\D/g, ''), 10);
                                            if (columnIndex >= range.startColumn && columnIndex <= range.endColumn) {
                                                // Exclude Cell A1 (merged to D1) and Cell A2 (merged to D2) from being bordered
                                                var row = parseInt($(this).attr('r').match(/\d+/), 10);
                                                if (!((row === 1 && columnIndex <= 3) || (row === 2 && columnIndex <= 3))) {
                                                    $(this).attr('s', '25'); // Apply border style to other cells
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Laporan Daftar Akun<br/>Sistem Akuntansi UBSP',
                            messageTop: 'Daftar Akun',
                            messageBottom: 'Daftar Akun',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        }
                    ]
                }
            ]
            });
            table
                .buttons(0, null)
                .container()
                .prependTo(table.table().container());

            function calculateRange(sheet) {
                var range = { startRow: 2, startColumn: 0, endRow: 0, endColumn: 0 }; // Start from A3
                $('row', sheet).each(function(index) {
                    var cellsWithData = $(this).find('c[r]');
                    if (cellsWithData.length > 0) {
                        range.endRow = index;
                        cellsWithData.each(function() {
                            var columnIndex = parseInt($(this).attr('r').replace(/\D/g, ''), 10);
                            range.endColumn = Math.max(range.endColumn, columnIndex);
                        });
                    }
                });
                return range;
            }

            const registerDeleteItemHandlers = () => {
                $('.show_confirm').click(function(event) {
                    event.preventDefault();
                    var form = $(this).closest("form");
                    var item = $(this).closest("tr").find("td:eq(2)").text();

                    Swal.fire({
                        title: 'Konfirmasi',
                        html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                            '<p class="mt-2">Apakah Anda yakin ingin menghapus akun ' + item + '?</p>',
                        confirmButtonText: 'Ya, Hapus',
                        denyButtonText: 'Batal',
                        customClass: {
                            confirmButton: "btn btn-primary",
                            denyButton: "btn btn-danger"
                        },
                        showDenyButton: true,
                        showCloseButton: true,
                        focusConfirm: false,
                        didOpen: () => {
                            var animation = lottie.loadAnimation({
                                container: document.getElementById('lottie-container'),
                                renderer: 'svg',
                                loop: true,
                                autoplay: true,
                                path: '/assets/animations/confirm.json',
                                rendererSettings: {
                                    preserveAspectRatio: 'xMidYMid slice'
                                }
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            };

            registerDeleteItemHandlers();

            $("#table1").on("draw.dt", function () {
                registerDeleteItemHandlers();
            });

            table.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
                registerDeleteItemHandlers();
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
                          '<p class="mt-2">' + (type === 'success' ? "{{ Session::get('success') }}" : "{{ Session::get('errorData') }}") + '</p>',
                    showCloseButton: true,
                    focusConfirm: false,
                    didOpen: () => {
                        var animation = lottie.loadAnimation({
                            container: document.getElementById('lottie-container'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: type === 'success' ? '/assets/animations/success.json' : '/assets/animations/error.json',
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
