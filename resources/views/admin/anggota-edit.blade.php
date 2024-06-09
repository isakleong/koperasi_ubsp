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
    </style>
@endsection

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Beranda Anggota /</span> Edit Anggota
        </h4>

        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bxs-user-check bx-sm"></i>
                                </span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $cntActive }}</h4>
                        </div>
                        <h5>Aktif</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger">
                                    <i class="bx bxs-user-x bx-sm"></i>
                                </span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $cntTerminate }}</h4>
                        </div>
                        <h5>Non Aktif</h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-info">
                                    <i class="bx bxs-user-detail bx-sm"></i>
                                </span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $cntNotverify }}</h4>
                        </div>
                        <h5>Belum Verifikasi</h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class='bx bxs-user bx-sm'></i>
                                </span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $cntNotacc }}</h4>
                        </div>
                        <h5 class="mb-1">Belum Disetujui</h5>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Anggota UBSP</h5>
                        {{-- <a class="btn btn-primary" href="{{route('users.index',['download'=>'pdf'])}}">Download PDF</a> --}}

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalCenter">Ekspor Data</button>

                        <!-- Modal Export -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Ekspor Data Anggota</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.export.user') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md">
                                                    <p class="fw-medium">Status Anggota</p>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input" type="checkbox" value="2"
                                                            id="export-option-1" name="status[]" checked />
                                                        <label class="form-check-label" for="export-option-1"> Aktif
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" value="3"
                                                            id="export-option-2" name="status[]" checked />
                                                        <label class="form-check-label" for="export-option-2"> Non Aktif
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" value="0"
                                                            id="export-option-3" name="status[]" checked />
                                                        <label class="form-check-label" for="export-option-3"> Belum
                                                            Verifikasi </label>
                                                    </div>
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            id="export-option-4" name="status[]" checked />
                                                        <label class="form-check-label" for="export-option-4"> Belum
                                                            Disetujui
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" value="4"
                                                            id="export-option-5" name="status[]" checked />
                                                        <label class="form-check-label" for="export-option-4"> Ditolak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-primary" name="action"
                                                value="excel">Excel</button>
                                            <button type="submit" class="btn btn-outline-primary" name="action"
                                                value="pdf">PDF</button>

                                            {{-- <a type="button" class="btn btn-outline-primary" href="{{ route('admin.user.index', ['export' => 'excel']) }}"><span class="tf-icons bx bxs-file me-1" style='color:#279a1b'></span>Excel</a>
                                            <a type="button" class="btn btn-outline-primary" href="{{ route('admin.user.index', ['download' => 'pdf']) }}"><span class="tf-icons bx bxs-file-pdf me-1" style='color:#ff0000'></span>PDF</a> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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

                        <div class="row">
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

                                <div class="col-lg-6">
                                    <div class="card shadow-lg bg-transparent border {{ $borderClass }} mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->memberId }}</h5>
                                            <h5 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->fname . ' ' . $item->lname }}</h5>
                                            <input type="hidden" id="memberId" value="{{ $item->memberId }}">
                                            <div class="mt-3">
                                                <div class="d-grid gap-3 col-lg-12">
                                                    {{-- <a href="{{ route('admin.user.edit', $item->id) }}" type="button" class="btn btn-primary">Edit Data</a> --}}
                                                    {{-- <a href="{{ route('admin.user.edit', $item->id) }}" type="button" class="btn btn-primary">Lihat Detail</a> --}}
    
                                                    <button type="button" id="modalTrigger" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalScrollable{{ $item->id }}">Lihat
                                                        Detail</button>
    
                                                    <!-- Modal Detail -->
                                                    <div class="modal fade" id="modalScrollable{{ $item->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="modalScrollableTitle{{ $item->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="modalScrollableTitle{{ $item->id }}">Detail
                                                                        Anggota</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <a href="{{ route('admin.user.edit', $item->id) }}"
                                                                        type="button" class="btn btn-outline-primary">Edit
                                                                        Data</a>
                                                                    <p class="text-end">
                                                                        @php
                                                                            $date = new DateTime($item->registDate);
                                                                            echo $date->format('d-m-Y H:i');
                                                                        @endphp
                                                                    </p>
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
                                                                            <tr>
                                                                                <td>NIK</td>
                                                                                <td>{{ $item->nik }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Foto KTP</td>
                                                                                <td><img style="width: 60px;"
                                                                                        src="/{{ $item->ktp }}"
                                                                                        alt=""
                                                                                        class="img-fluid mb-3 mt-3 col-4 d-block">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Foto KK</td>
                                                                                <td><img style="width: 60px;"
                                                                                        src="/{{ $item->kk }}"
                                                                                        alt=""
                                                                                        class="img-fluid mb-3 mt-3 col-4 d-block">
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    {{-- <button type="button" class="btn btn-outline-danger">Tolak</button> --}}
                                                                    {{-- <button type="button" class="btn btn-primary">Terima</button> --}}
    
                                                                    @if ($item->status == 0)
                                                                        <form
                                                                            action="{{ route('verification.send', $item->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="user_id"
                                                                                value="{{ $item->id }}">
                                                                            <button type="submit"
                                                                                class="col-12 btn btn-primary">Verifikasi
                                                                                Ulang</button>
                                                                        </form>
                                                                    @elseif ($item->status == 1)
                                                                        <form
                                                                            action="{{ route('admin.reject.user', $item->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="col-12 btn btn-outline-danger show_confirm_reject">Tolak</button>
                                                                        </form>
                                                                        <form
                                                                            action="{{ route('admin.acc.user', $item->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="col-12 btn btn-primary show_confirm_acc">Terima</button>
                                                                        </form>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
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
    <script src="/vendor/jquery/jquery.min.js"></script>

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

    <script src="/vendor/sweetalert/sweetalert2.js"></script>
    <script src="/vendor/lottie/lottie.min.js"></script>

    <script>
        $(document).ready(function() {
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

            $('.show_confirm_reject').click(function(event) {
                event.preventDefault();

                $('.modal').modal('hide');

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin menolak anggota?</p>',
                    confirmButtonText: 'Ya, Tambah',
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

            $('.show_confirm_acc').click(function(event) {
                event.preventDefault();

                $('.modal').modal('hide');

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin menerima anggota?</p>',
                    confirmButtonText: 'Ya, Tambah',
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
