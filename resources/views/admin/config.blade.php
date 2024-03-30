@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
@endsection

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Konfigurasi Data</span>
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Konfigurasi</h5>
                        {{-- <a href="/admin/company/create" class="btn btn-primary">Tambah Konfigurasi</a> --}}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-pills mb-3" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#simpanan"
                                                aria-controls="simpanan" aria-selected="true">
                                                Simpanan
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                data-bs-target="#kredit"
                                                aria-controls="navs-pills-top-profile" aria-selected="false">
                                                Kredit
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                data-bs-target="#lainnya"
                                                aria-controls="navs-pills-top-messages" aria-selected="false">
                                                Lainnya
                                            </button>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="simpanan" role="tabpanel">
                                            <table class="table table-sm table-bordered table-hover table-striped" id="table1" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Nilai</th>
                                                        <th>Deskripsi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($config as $item)
                                                        @if (strtolower($item->kind) == "simpanan")
                                                            <tr>
                                                                <td>{{ $item->name }}</td>
                                                                <td>
                                                                    @if (is_numeric($item->value))
                                                                        <span class="autonumeric">{{ $item->value }}</span>
                                                                    @else
                                                                        {{ $item->value }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->desc }}</td>
                                                                <td>
                                                                    <a href="{{ route('admin.config.edit', $item->id) }}"
                                                                        class="btn icon btn-sm btn-primary d-inline-block m-1"
                                                                        data-bs-toggle="tooltip" title="Edit"><i class="bx bxs-pencil"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="kredit" role="tabpanel">
                                            <table class="table table-sm table-bordered table-hover table-striped" id="table1" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Nilai</th>
                                                        <th>Deskripsi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($config as $item)
                                                        @if (strtolower($item->kind) == "kredit")
                                                            <tr>
                                                                <td>{{ $item->name }}</td>
                                                                <td>
                                                                    @if (is_numeric($item->value))
                                                                        <span class="autonumeric">{{ $item->value }}</span>
                                                                    @else
                                                                        {{ $item->value }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->desc }}</td>
                                                                <td>
                                                                    <a href="{{ route('admin.config.edit', $item->id) }}"
                                                                        class="btn icon btn-sm btn-primary d-inline-block m-1"
                                                                        data-bs-toggle="tooltip" title="Edit"><i class="bx bxs-pencil"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="lainnya" role="tabpanel">
                                            <table class="table table-sm table-bordered table-hover table-striped" id="table1" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Nilai</th>
                                                        <th>Deskripsi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($config as $item)
                                                        @if (strtolower($item->kind) == "other")
                                                            <tr>
                                                                <td>{{ $item->name }}</td>
                                                                <td>
                                                                    @if (is_numeric($item->value))
                                                                        <span class="autonumeric">{{ $item->value }}</span>
                                                                    @else
                                                                        {{ $item->value }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->desc }}</td>
                                                                <td>
                                                                    <a href="{{ route('admin.config.edit', $item->id) }}"
                                                                        class="btn icon btn-sm btn-primary d-inline-block m-1"
                                                                        data-bs-toggle="tooltip" title="Edit"><i class="bx bxs-pencil"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="/vendor/sweetalert/sweetalert2.js"></script>
    <script src="/vendor/autonumeric/autonumeric.min.js"></script>

    {{-- <script>
        // Initialize AutoNumeric on the element with the 'autonumeric' class
        var autoNumericElement = document.querySelector('.autonumeric');
        var autoNumeric = new AutoNumeric(autoNumericElement);
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                responsive: true
            });


            $('.autonumeric').each(function() {
                new AutoNumeric(this, {
                    digitGroupSeparator: ',',
                    decimalPlaces: '0',
                    emptyInputBehavior: "zero",
                    watchExternalChanges: true
                });
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
                    customClass: {
                        confirmButton: "btn btn-primary",
                        denyButton: "btn btn-danger"
                    },
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
