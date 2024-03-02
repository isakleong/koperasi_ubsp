@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
@endsection

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Kategori Akun</span>
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Kategori Akun</h5>
                        <a href="/admin/account_category/create" class="btn btn-primary">Tambah Data</a>
                    </div>

                    <div class="card-body">
                        @if (count($category) == 0)
                            <div class="container-xxl container-p-y text-center">
                                <div class="misc-wrapper">
                                    <div class="mb-4">
                                        <img src="/administrator/assets/img/illustrations/not-found.jpg"
                                            alt="page-misc-error-light" width="500" class="img-fluid"
                                            data-app-dark-img="illustrations/page-misc-error-dark.png"
                                            data-app-light-img="illustrations/page-misc-error-light.png" />
                                    </div>
                                    <h5 class="mb-4 mx-2">Tidak ada daftar kategori akun.</h5>
                                </div>
                            </div>
                        @else
                            <table class="table table-sm table-bordered table-hover table-striped" id="table1" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Saldo Normal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($category as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->normalBalance }}</td>
                                            @if ($item->active == '1')
                                                <td><span class="badge bg-success">Active</span></td>
                                            @else
                                                <td><span class="badge bg-danger">Inactive</span></td>
                                            @endif
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
                    var form =  $(this).closest("form");
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

            $("#table1").on("draw.dt", function () {
                registerDeleteItemHandlers();
            });

            table.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
                // console.log('Details for row '+row.index()+' '+(showHide ? 'shown' : 'hidden'));
                registerDeleteItemHandlers();
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
