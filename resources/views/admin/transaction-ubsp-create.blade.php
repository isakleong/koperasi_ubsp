@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/flatpickr/flatpickr.css"/>
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
                        <form action="{{ route('admin.account_category.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="transactionDate">Tanggal Transaksi</label>
                                <input type="text" class="form-control dob-picker" placeholder="Hari-Bulan-Tahun" id="transactionDate" name="transactionDate" />
                                @error('transactionDate')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="alert alert-primary mb-3" role="alert">
                                <div>
                                    <h6 class="mb-0">Akun Debit</h6>
                                </div>
                                <div id="rowDebit">
                                    <div class="row m-2 p-2">
                                        <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                            <label class="form-label">Akun</label>
                                            <select class="choices form-select" name="accountID[]"><option value="" selected disabled>---Pilih Akun---</option>  
                                                @foreach ($account as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('accountID[]')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                            <label class="form-label">D / K</label>
                                            <select class="form-select" id="kind" aria-label="kind"
                                                name="kind">
                                                <option selected>--- Pilih D / K ---</option>
                                                <option value="D" {{ old('kind') == 'D' ? 'selected' : '' }}>Debit
                                                </option>
                                                <option value="K" {{ old('kind') == 'K' ? 'selected' : '' }}>Kredit
                                                </option>
                                            </select>
                                            @error('kind')
                                                <p class="mt-1" style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                            <label class="form-label">Total</label>
                                            <input type="text" class="form-control amountInputDebit" name="amountDebit[]" required value="{{ old('amountDebit[]') }}" />
                                            @error('amountDebit[]')
                                                <p class="mt-1" style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                            <button class="btn btn-danger mt-4 deleteRowDebit" style="display: none;">
                                                <i class="bx bx-x me-1"></i>
                                                <span class="align-middle">Hapus</span>
                                            </button>
                                        </div>
                                        <hr style="border-top: dotted 1px;"/>
                                    </div>
                                </div>

                                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                    <h6>Total Debit:</h6>
                                    <h6 class="totalDebit" id="totalDebit">0.00</h6>
                                </div>
                                

                                <div class="text-end">
                                    <button class="btn btn-primary" id="addRowDebit">
                                        <i class="bx bx-plus me-1"></i>
                                        <span class="align-middle">Tambah Akun Debit</span>
                                    </button>
                                </div>
                            </div>

                            <div class="alert alert-primary" role="alert">
                                <div>
                                    <h6>Akun Kredit</h6>
                                </div>
                                <div id="rowKredit">
                                    <div class="row m-2 p-2">
                                        <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                            <label class="form-label">Akun</label>
                                            <select class="choices form-select" name="accountID[]"><option value="" selected disabled>---Pilih Akun---</option>  
                                                @foreach ($account as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('accountID[]')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                            <label class="form-label">D / K</label>
                                            <select class="form-select" id="kind" aria-label="kind"
                                                name="kind">
                                                <option selected>--- Pilih D / K ---</option>
                                                <option value="D" {{ old('kind') == 'D' ? 'selected' : '' }}>Debit
                                                </option>
                                                <option value="K" {{ old('kind') == 'K' ? 'selected' : '' }}>Kredit
                                                </option>
                                            </select>
                                            @error('kind')
                                                <p class="mt-1" style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                            <label class="form-label">Total</label>
                                            <input type="text" class="form-control amountInputKredit" name="amountKredit[]" required value="{{ old('amountKredit[]') }}" />
                                            @error('amountKredit[]')
                                                <p class="mt-1" style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                            <button class="btn btn-danger mt-4 deleteRowKredit" style="display: none;">
                                                <i class="bx bx-x me-1"></i>
                                                <span class="align-middle">Hapus</span>
                                            </button>
                                        </div>
                                        <hr style="border-top: dotted 1px;"/>
                                    </div>
                                </div>

                                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                    <h6>Total Kredit:</h6>
                                    <h6 class="totalKredit" id="totalKredit">0.00</h6>
                                </div>
                                

                                <div class="text-end">
                                    <button class="btn btn-primary" id="addRowKredit">
                                        <i class="bx bx-plus me-1"></i>
                                        <span class="align-middle">Tambah Akun Kredit</span>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="description"
                                        name="description"placeholder="" required
                                        value="{{ old('description') }}" />
                                    <label for="name">Keterangan</label>
                                </div>
                                @error('description')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    name="active" checked />
                                <label class="form-check-label" for="flexSwitchCheckChecked">Aktif?</label>
                            </div>
                            <div id="overlay">
                                <div id="lottie-loading"></div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary show_confirm">Tambah
                                    Kategori</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.amountInputDebit').forEach(function(input) {
                new AutoNumeric(input, {
                    currencySymbol: 'Rp ',
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    emptyInputBehavior: "zero",
                    watchExternalChanges: true
                });
            });

            document.querySelectorAll('.amountInputKredit').forEach(function(input) {
                new AutoNumeric(input, {
                    currencySymbol: 'Rp ',
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    emptyInputBehavior: "zero",
                    watchExternalChanges: true
                });
            });

            new AutoNumeric('.totalDebit', {
                currencySymbol: 'Rp ',
                digitGroupSeparator: ',',
                decimalCharacter: '.',
                emptyInputBehavior: "zero",
                watchExternalChanges: true
            });

            new AutoNumeric('.totalKredit', {
                currencySymbol: 'Rp ',
                digitGroupSeparator: ',',
                decimalCharacter: '.',
                emptyInputBehavior: "zero",
                watchExternalChanges: true
            });

            function updateTotal(kind) {
                if(kind == 'debit') {
                    var totalDebit = 0;
                    var debitInput = document.querySelectorAll('.amountInputDebit');
                    debitInput.forEach(function(item) {
                        var val = AutoNumeric.getNumericString(item);
                        totalDebit += parseFloat(val);
                    });
                    document.getElementById("totalDebit").textContent = totalDebit;
                    new AutoNumeric('.totalDebit', {
                        currencySymbol: 'Rp ',
                        digitGroupSeparator: ',',
                        decimalCharacter: '.',
                        emptyInputBehavior: "zero",
                        watchExternalChanges: true
                    });
                } else {
                    var totalKredit = 0;
                    var kreditInput = document.querySelectorAll('.amountInputKredit');
                    kreditInput.forEach(function(item) {
                        var val = AutoNumeric.getNumericString(item);
                        totalKredit += parseFloat(val);
                    });
                    document.getElementById("totalKredit").textContent = totalKredit;
                    new AutoNumeric('.totalKredit', {
                        currencySymbol: 'Rp ',
                        digitGroupSeparator: ',',
                        decimalCharacter: '.',
                        emptyInputBehavior: "zero",
                        watchExternalChanges: true
                    });
                }
            }

            document.addEventListener('input', function(event) {
                if (event.target.classList.contains('amountInputDebit')) {
                    updateTotal('debit');
                } else if(event.target.classList.contains('amountInputKredit')) {
                    updateTotal('kredit');
                }
            });

            $("#addRowDebit").click(function(event) {
                event.preventDefault();

                const newRow = $("#rowDebit .row:first").clone(true);
                newRow.find(".deleteRowDebit").show();
                newRow.find('.amountInputDebit').val('').removeAttr('id');
                newRow.find('.amountInputDebit').each(function() {
                    new AutoNumeric(this, {
                        currencySymbol: 'Rp ',
                        digitGroupSeparator: ',',
                        decimalCharacter: '.',
                        emptyInputBehavior: "zero",
                        watchExternalChanges: true
                    });
                });
                
                $("#rowDebit").append(newRow);
            });

            $("#addRowKredit").click(function(event) {
                event.preventDefault();

                const newRow = $("#rowKredit .row:first").clone(true);
                newRow.find(".deleteRowKredit").show();
                newRow.find('.amountInputKredit').val('').removeAttr('id');
                newRow.find('.amountInputKredit').each(function() {
                    new AutoNumeric(this, {
                        currencySymbol: 'Rp ',
                        digitGroupSeparator: ',',
                        decimalCharacter: '.',
                        emptyInputBehavior: "zero",
                        watchExternalChanges: true
                    });
                });
                
                $("#rowKredit").append(newRow);
            });

            $("#rowDebit").on("click", ".deleteRowDebit", function(event) {
                const row = $(this).closest(".row");
                row.remove();
                updateTotal('debit');
            });

            $("#rowKredit").on("click", ".deleteRowKredit", function(event) {
                const row = $(this).closest(".row");
                row.remove();
                updateTotal('kredit');
            });
        });

        $(document).ready(function() {
            $(".dob-picker").flatpickr({
                monthSelectorType: "static",
                dateFormat: "d-m-Y"
            });
            $('.show_confirm').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                var item = $('input[name="name"]').val();
                if(item === "") {
                    item = "(Nama Kategori Belum Diisi)";
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin menambahkan kategori akun ' + item + '?</p>',
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
        });

        @if ($message = session('errors'))
            Swal.fire({
                title: 'Error',
                html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Data kategori akun belum diisi secara lengkap. Silahkan dicek kembali.</p>',
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
