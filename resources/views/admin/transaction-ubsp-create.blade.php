@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/administrator/libs/select2/select2.min.css" />
    <link rel="stylesheet" href="/administrator/libs/select2/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

    {{-- <link href="/vendor/filepond/css/filepond.css" rel="stylesheet" />
    <link rel='stylesheet' href='/vendor/filepond/css/filepond-plugin-image-preview.min.css'>
    <link rel='stylesheet' href='/vendor/filepond/css/filepond-plugin-file-poster.css'> --}}

    {{-- alternatif 2 --}}
    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">

    <style>
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

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #566a7f;
        }
    </style>

    <style>
        .filepond--drop-label {
            color: #4c4e53;
        }

        .filepond--label-action {
            text-decoration-color: #babdc0;
        }

        .filepond--panel-root {
            border-radius: 2em;
            background-color: #f3e9fa;
        }

        .filepond--item-panel {
            background-color: #595e68;
        }

        .filepond--drip-blob {
            background-color: #7f8a9a;
        }
    </style>
@endsection

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Transaksi UBSP / </span> Tambah Data
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Transaksi UBSP</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.transaction.ubsp.store') }}" method="post"
                            enctype="multipart/form-data">
                            {{-- <form id="company_form" method="POST"> --}}
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label>Tanggal Transaksi</label>
                                <input type="text" class="form-control dob-picker" placeholder="Hari-Bulan-Tahun"
                                    id="transactionDate" name="transactionDate" required
                                    value="{{ old('transactionDate') }}" />
                                @error('transactionDate')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-xl-12">
                                    <div class="alert alert-primary mb-3" role="alert">
                                        <div>
                                            <h6>Akun Debit</h6>
                                        </div>
                                        <div id="rowDebit">
                                            <div class="row mb-3 mx-1 p-1"
                                                style="background-color: #f8f8ff; border-radius: 16px;">
                                                <div class="col-lg-4 col-xl-4 col-12 mb-2">
                                                    <label>Akun</label>
                                                    <select class="choices form-select select2 debitAccount" name="debitAccountID[]">
                                                        <option></option>
                                                        @foreach ($account as $item)
                                                            <option value="{{ $item->accountNo }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('debitAccountID[]')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-4 col-xl-4 col-12 mb-2">
                                                    <label>Total</label>
                                                    <input type="text" class="form-control amountInputDebit"
                                                        name="amountDebit[]" required value="{{ old('amountDebit[]') }}" />
                                                    @error('amountDebit[]')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-4 col-xl-3 col-12 mb-2">
                                                    <label>Keterangan</label>
                                                    <input type="text" class="form-control notesInputDebit"
                                                        name="notesDebit[]" value="{{ old('notesDebit[]') }}" />
                                                    @error('notesDebit[]')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-2">
                                                    <button class="btn btn-icon btn-sm btn-label-danger btn-remove mt-4 deleteRowDebit"
                                                        style="display: none;">
                                                        {{-- <i class="bx bx-x me-1"></i> --}}
                                                        {{-- <span class="align-middle">Hapus</span> --}}

                                                        <span class="tf-icons bx bx-trash bx-flashing-hover"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 col-lg-6 col-xl-2 col-12 mb-0">
                                            <h6>Total Debit:</h6>
                                            <h6 class="totalDebit" id="totalDebit">0.00</h6>
                                        </div>
                                        <div class="text-end">
                                            <button class="btn btn-outline-primary" id="addRowDebit">
                                                <i class="bx bx-plus me-1"></i>
                                                <span class="align-middle">Tambah Akun Debit</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-12">
                                    <div class="alert alert-primary" role="alert">
                                        <div>
                                            <h6>Akun Kredit</h6>
                                        </div>
                                        <div id="rowKredit">
                                            <div class="row mb-3 mx-1 p-1"
                                                style="background-color: #f8f8ff; border-radius: 16px;">
                                                <div class="col-lg-4 col-xl-4 col-12 mb-2">
                                                    <label>Akun</label>
                                                    <select class="choices form-select select2 kreditAccount"
                                                        name="kreditAccountID[]">
                                                        <option></option>
                                                        @foreach ($account as $item)
                                                            <option value="{{ $item->accountNo }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kreditAccountID[]')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-4 col-xl-4 col-12 mb-2">
                                                    <label>Total</label>
                                                    <input type="text" class="form-control amountInputKredit"
                                                        name="amountKredit[]" required
                                                        value="{{ old('amountKredit[]') }}" />
                                                    @error('amountKredit[]')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-4 col-xl-3 col-12 mb-2">
                                                    <label>Keterangan</label>
                                                    <input type="text" class="form-control notesInputKredit"
                                                        name="notesKredit[]" value="{{ old('notesKredit[]') }}" />
                                                    @error('notesKredit[]')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-2">
                                                    <button class="btn btn-label-danger mt-4 deleteRowKredit"
                                                        style="display: none;">
                                                        {{-- <i class="bx bx-x me-1"></i> --}}
                                                        <span class="align-middle">Hapus</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                            <h6>Total Kredit:</h6>
                                            <h6 class="totalKredit" id="totalKredit">0.00</h6>
                                        </div>


                                        <div class="text-end">
                                            <button class="btn btn-outline-primary" id="addRowKredit">
                                                <i class="bx bx-plus me-1"></i>
                                                <span class="align-middle">Tambah Akun Kredit</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="description"
                                        name="description"placeholder="" value="{{ old('description') }}" />
                                    <label>Keterangan</label>
                                </div>
                                @error('description')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="divider divider-dashed">
                                <div class="divider-text" style="font-size: 1rem;">Bukti Transaksi</div>
                            </div>
                            {{-- <div class="mb-3">
                                <input type="file" name="image" id='image' class='p-5' multiple data-allow-reorder="true"
                                data-max-file-size="3MB" data-max-files="4" accept="image/*">
                            </div> --}}

                            <div class="mb-3">
                                <input type="file" class="image-resize-filepond" name="image[]" id="image" accept="image/*" multiple >

                                {{-- <input type="file" class="multiple-files-filepond" multiple name="image[]" id="image"> --}}

                                @error('image')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="overlay">
                                <div id="lottie-loading"></div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary show_confirm" id="company_form_btn">Tambah
                                    Transaksi</button>
                            </div>
                        </form>
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
    <script src="/vendor/autonumeric/autonumeric.min.js"></script>
    <script src="/administrator/libs/select2/select2-bootstrap.bundle.min.js"></script>
    <script src="/administrator/libs/select2/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <script src="/administrator/assets/js/account-transaction.js"></script>
    
    {{-- <script src="/vendor/filepond/js/filepond.js"></script>
    <script src="/vendor/filepond/js/filepond-plugin-file-poster.js"></script>
    <script src="/vendor/filepond/js/filepond-plugin-image-preview.js"></script>
    <script src='/vendor/filepond/js/filepond-plugin-file-encode.min.js'></script>
    <script src='/vendor/filepond/js/filepond-plugin-file-validate-size.min.js'></script>
    <script src="/vendor/filepond/js/filepond-plugin-file-validate-type.js"></script>
    <script src='/vendor/filepond/js/filepond-plugin-image-exif-orientation.min.js'></script> --}}

    {{-- alternatif 2 --}}
    <script src="/main/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script src="/main/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="/main/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script src="/main/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="/main/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
    <script src="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="/main/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="/main/assets/extensions/filepond/filepond.js"></script>
    <script src="/main/assets/static/js/pages/filepond.js"></script>

    {{-- <script>
        FilePond.registerPlugin(
            // encodes the file as base64 data
            FilePondPluginFileEncode,

            // validates the size of the file
            FilePondPluginFileValidateSize,

            FilePondPluginFileValidateType,

            // corrects mobile image orientation
            FilePondPluginImageExifOrientation,

            FilePondPluginFilePoster,

            // previews dropped images
            FilePondPluginImagePreview
        )
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');
    
        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: ['image/*']
        });
    </script> --}}

    <script>
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

        @if ($message = session('errors'))
            Swal.fire({
                title: 'Error',
                html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                    '<p class="mt-2">Data transaksi UBSP belum diisi secara lengkap. Silahkan dicek kembali.</p>',
                showCloseButton: true,
                focusConfirm: false,
                didOpen: () => {
                    var animation = lottie.loadAnimation({
                        container: document.getElementById('lottie-container'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '/assets/animations/error.json',
                        rendererSettings: {
                            preserveAspectRatio: 'xMidYMid slice'
                        }
                    });
                }
            });
        @endif
    </script>
@endsection
