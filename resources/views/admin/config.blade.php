@extends('layout.admin.main')

@section('navbar')
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo align-items-center">
                    <img width="60" src="/main/assets/static/images/logo/UBSP-logos_transparent.png" alt="Logo">
                </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Dashboards">Dashboard</div>
                </a>
            </li>
            <!-- End of Dashboards -->

            <!-- Master Data -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">master data</span></li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-group"></i>
                    <div data-i18n="Basic">Anggota</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/account_category" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-category"></i>
                    <div data-i18n="Basic">Kategori Akun</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/account" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-archive"></i>
                    <div data-i18n="Basic">Daftar Akun</div>
                </a>
            </li>
            <li class="menu-item active open">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Extended UI">Pengaturan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="/admin/company" class="menu-link">
                            <div data-i18n="Perfect Scrollbar">Profile UBSP</div>
                        </a>
                    </li>
                    <li class="menu-item active">
                        <a href="/admin/config" class="menu-link">
                            <div data-i18n="Text Divider">Konfigurasi Data</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End of Master Data -->

            <!-- Transaction Data -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">transaksi</span></li>
            <li class="menu-item">
                <a href="/admin/menu/simpanan" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-wallet"></i>
                    <div data-i18n="Basic">Simpanan</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="/admin/menu/kredit" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                    <div data-i18n="Basic">Kredit</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/angsuran" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-money"></i>
                    <div data-i18n="Basic">Angsuran</div>
                </a>
            </li>

            <!-- End of Transaction Data -->

            <!-- Report Data -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">laporan</span></li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book-open"></i>
                    <div data-i18n="Basic">Jurnal Harian</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                    <div data-i18n="Basic">Buku Besar</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-chart"></i>
                    <div data-i18n="Basic">Neraca Saldo</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-line-chart"></i>
                    <div data-i18n="Basic">Laba Rugi</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-network-chart"></i>
                    <div data-i18n="Basic">Neraca</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-coin-stack"></i>
                    <div data-i18n="Basic">Hutang</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
                    <div data-i18n="Basic">Piutang</div>
                </a>
            </li>
            <!-- End of Transaction Data -->

        </ul>
    </aside>
    <!-- / Menu -->
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
                                            <table class="table table-striped" id="table1" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Nilai</th>
                                                        <th>Deskripsi</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($config as $item)
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
                                                            @if ($item->active == '1')
                                                                <td><span class="badge bg-success">Aktif</span></td>
                                                            @else
                                                                <td><span class="badge bg-danger">Tidak Aktif</span></td>
                                                            @endif
                                                            <td>
                                                                <a href="{{ route('admin.config.edit', $item->id) }}"
                                                                    class="btn icon btn-sm btn-primary d-inline-block m-1"
                                                                    data-bs-toggle="tooltip" title="Edit"><i class="bx bxs-pencil"></i></a>
                                                                {{-- <form action="{{ route('admin.company.destroy', $item->id) }}"
                                                                    method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip"
                                                                    title="Hapus">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn icon btn-sm btn-danger show_confirm"><i
                                                                            class="bx bxs-trash"></i></button>
                                                                </form> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="kredit" role="tabpanel">
                                            <table class="table table-striped" id="table1" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Nilai</th>
                                                        <th>Deskripsi</th>
                                                        <th>Status</th>
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
                                                                @if ($item->active == '1')
                                                                    <td><span class="badge bg-success">Aktif</span></td>
                                                                @else
                                                                    <td><span class="badge bg-danger">Tidak Aktif</span></td>
                                                                @endif
                                                                <td>
                                                                    <a href="{{ route('admin.config.edit', $item->id) }}"
                                                                        class="btn icon btn-sm btn-primary d-inline-block m-1"
                                                                        data-bs-toggle="tooltip" title="Edit"><i class="bx bxs-pencil"></i></a>
                                                                    {{-- <form action="{{ route('admin.company.destroy', $item->id) }}"
                                                                        method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip"
                                                                        title="Hapus">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn icon btn-sm btn-danger show_confirm"><i
                                                                                class="bx bxs-trash"></i></button>
                                                                    </form> --}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="lainnya" role="tabpanel">
                                            <table class="table table-striped" id="tableOther" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Nilai</th>
                                                        <th>Deskripsi</th>
                                                        <th>Status</th>
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
                                                                @if ($item->active == '1')
                                                                    <td><span class="badge bg-success">Aktif</span></td>
                                                                @else
                                                                    <td><span class="badge bg-danger">Tidak Aktif</span></td>
                                                                @endif
                                                                <td>
                                                                    <a href="{{ route('admin.config.edit', $item->id) }}"
                                                                        class="btn icon btn-sm btn-primary d-inline-block m-1"
                                                                        data-bs-toggle="tooltip" title="Edit"><i class="bx bxs-pencil"></i></a>
                                                                    {{-- <form action="{{ route('admin.company.destroy', $item->id) }}"
                                                                        method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip"
                                                                        title="Hapus">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn icon btn-sm btn-danger show_confirm"><i
                                                                                class="bx bxs-trash"></i></button>
                                                                    </form> --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="/vendor/datatable/js/datatables.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>
    <script src="https://unpkg.com/autonumeric"></script>

    {{-- <script>
        // Initialize AutoNumeric on the element with the 'autonumeric' class
        var autoNumericElement = document.querySelector('.autonumeric');
        var autoNumeric = new AutoNumeric(autoNumericElement);
    </script> --}}

    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable({
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
