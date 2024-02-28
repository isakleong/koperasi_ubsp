@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">

    <style>
        #loadingFilter {
            display: flex;
            justify-content: center;
        }
        /* table tbody tr td:nth-child(2)::before {
            content: "  : ";
        } */
    </style>
@endsection

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
            <li class="menu-item active">
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
            <li class="menu-item">
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
                    <li class="menu-item">
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
            <span class="text-muted fw-light">Beranda Anggota /</span> Edit Anggota
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Anggota UBSP</h5>
                        {{-- <a class="btn btn-primary" href="{{route('users.index',['download'=>'pdf'])}}">Download PDF</a> --}}
                        <a type="button" class="btn btn-primary" href="{{route('admin.user.index',['download'=>'pdf'])}}">Export PDF</a>
                        <a type="button" class="btn btn-primary" href="{{route('admin.user.index',['export'=>'excel'])}}">Export Excel</a>
                    </div>

                    <div class="card-body">
                        <form action="" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon-search31"><i
                                                class="bx bx-search"></i></span>
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder="Kata kunci..." aria-label="Kata kunci..."
                                            aria-describedby="basic-addon-search31"
                                            value="{{ isset($_GET['keyword']) ? $_GET['keyword'] : '' }}" />
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4 col-md-4 mb-4">
                                    <select id="filterStatus" class="form-select form-select" name="status">
                                        <option value="active" {{ Request::get('status') == 'active' ? 'selected' : '' }}>
                                            Aktif</option>
                                        <option value="non-active"
                                            {{ Request::get('status') == 'non-active' ? 'selected' : '' }}>Non Aktif
                                        </option>
                                        <option value="not-verified"
                                            {{ Request::get('status') == 'not-verified' ? 'selected' : '' }}>Belum
                                            Verifikasi</option>
                                        <option value="not-acc"
                                            {{ Request::get('status') == 'not-acc' ? 'selected' : '' }}>
                                            Belum Disetujui</option>
                                    </select>
                                </div>

                                <div class="col-12 col-sm-4 col-md-4 mb-4">
                                    <button type="submit" class="btn btn-primary">Cari Data</button>
                                </div>
                            </div>
                        </form>

                        <div id="loadingFilter" style="display: none;">
                            <img class="mb-5" src="/administrator/assets/img/icons/loading.gif" alt="Loading..." />
                        </div>

                        <div>
                            @forelse ($users as $item)
                                @php
                                    $borderClass = '';

                                    // Check the status and set the border class accordingly
                                    if ($item->status == 3) {
                                        $borderClass = 'border-danger';
                                    } elseif ($item->status == 2) {
                                        $borderClass = 'border-success';
                                    } elseif ($item->status == 1) {
                                        $borderClass = 'border-warning';
                                    } elseif ($item->status == 0) {
                                        $borderClass = 'border-info';
                                    }
                                @endphp
                                <div class="card shadow-lg bg-transparent border {{ $borderClass }} mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->fname . ' ' . $item->lname }}</h5>
                                        <input type="hidden" id="memberId" value="{{ $item->memberId }}">
                                        <div class="mt-3">
                                            <div class="d-grid gap-3 col-lg-12">
                                                {{-- <a href="{{ route('admin.user.edit', $item->id) }}" type="button" class="btn btn-primary">Edit Data</a> --}}
                                                {{-- <a href="{{ route('admin.user.edit', $item->id) }}" type="button" class="btn btn-primary">Lihat Detail</a> --}}

                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalScrollable{{$item->id}}">Lihat Detail</button>

                                                <!-- Modal Detail -->
                                                <div class="modal fade" id="modalScrollable{{$item->id}}" tabindex="-1" aria-labelledby="modalScrollableTitle{{$item->id}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle{{$item->id}}">Detail Anggota</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <a href="{{ route('admin.user.edit', $item->id) }}" type="button" class="btn btn-outline-primary">Edit Data</a>
                                                            <table class="table table-sm mt-3">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Nama Depan</td>
                                                                        <td>{{ $item->fname }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Nama Belakang</td>
                                                                        <td>{{ $item->lname }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tempat Lahir</td>
                                                                        <td>{{ $item->birthplace }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tanggal Lahir</td>
                                                                        <td>{{ $item->birthdate }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Alamat Tinggal</td>
                                                                        <td>{{ $item->address }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Alamat Kerja</td>
                                                                        <td>{{ $item->workAddress }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Email</td>
                                                                        <td>{{ $item->email }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>No HP</td>
                                                                        <td>{{ $item->phone }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Nama Ibu Kandung</td>
                                                                        <td>{{ $item->mothername }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{-- <button type="button" class="btn btn-outline-danger">Tolak</button> --}}
                                                            {{-- <button type="button" class="btn btn-primary">Terima</button> --}}

                                                            @if ($item->status == 0)
                                                                <a href="{{ route('verification.send', $item->id) }}" type="button"
                                                                    class="btn btn-primary">Verifikasi Ulang</a>
                                                            @elseif ($item->status == 1)
                                                            <form action="{{ route('admin.reject.user', $item->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="col-12 btn btn-outline-danger show_confirm_reject">Tolak</button>
                                                            </form>
                                                            <form action="{{ route('admin.acc.user', $item->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="col-12 btn btn-primary show_confirm_acc">Terima</button>
                                                            </form>
                                                            @else
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>

                                                {{-- @if ($item->status == 0)
                                                    <a href="{{ route('verification.send', $item->id) }}" type="button"
                                                        class="btn btn-primary">Verifikasi Ulang</a>
                                                @elseif ($item->status == 1)
                                                <form action="{{ route('admin.acc.user', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="col-12 btn btn-primary show_confirm_acc">Terima</button>
                                                </form>
                                                <form action="{{ route('admin.reject.user', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="col-12 btn btn-primary show_confirm_reject">Tolak</button>
                                                </form>
                                                @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="container-xxl container-p-y text-center">
                                    <div class="misc-wrapper">
                                        <div class="mb-4">
                                            <img src="/administrator/assets/img/illustrations/not-found.jpg"
                                                alt="page-misc-error-light" width="500" class="img-fluid"
                                                data-app-dark-img="illustrations/page-misc-error-dark.png"
                                                data-app-light-img="illustrations/page-misc-error-light.png" />
                                        </div>
                                        <h5 class="mb-4 mx-2">Tidak ada daftar anggota.</h5>
                                    </div>
                                </div>
                            @endforelse
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    

    
@endsection

@section('vendorJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

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

    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    <script>
        //capitalize input
        function capitalizeName(input) {
            const name = input.value.toLowerCase();
            const words = name.split(' ');
            const capitalizedWords = words.map(word => word.charAt(0).toUpperCase() + word.slice(1));
            input.value = capitalizedWords.join(' ');
        }
        //end of capitalize input

        $(document).ready(function() {
            // $('#openModalButton').on('click', function() {
            //     // Perform AJAX request before opening the modal
            //     var memberId = $('#memberId').val();
            //     var urlPath = '/admin/anggota/edit/' + memberId;
            //     alert(memberId);
            //     $.ajax({
            //         url: urlPath,
            //         type: 'GET',
            //         success: function(response) {
            //             // Assuming the response is successful, you can open the modal here
            //             $('#modalData').modal('show');
            //         },
            //         error: function(xhr, status, error) {
            //             // Handle error if the AJAX request fails
            //             console.error(xhr.responseText);
            //         }
            //     });
            // });

            $('.show_option').click(function(event) {
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

            $('.show_confirm_reject').click(function(event) {
                event.preventDefault();

                $('.modal').modal('hide');

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Tolak Anggota?',
                    text: '',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, tolak',
                    denyButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $('.show_confirm_acc').click(function(event) {
                event.preventDefault();

                $('.modal').modal('hide');

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Terima Anggota?',
                    text: '',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, terima',
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
@endsection
