@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/administrator/libs/select2/select2.min.css" />
    <link rel="stylesheet" href="/administrator/libs/select2/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
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
                        {{-- <form action="{{ route('admin.ubsp.transaction.store') }}" method="post"> --}}
                        <form id="company_form" method="POST">
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
                                            <div class="row mb-3 mx-1 p-1" style="background-color: #f8f8ff; border-radius: 16px;">
                                                <div class="col-lg-6 col-xl-5 col-12 mb-2">
                                                    <label>Akun</label>
                                                    <select class="choices form-select select2 debitAccount"
                                                        name="debitAccountID[]">
                                                        <option></option>
                                                        @foreach ($account as $item)
                                                            <option value="{{ $item }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('debitAccountID[]')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    {{-- @foreach($errors->get('debitAccountID.0') as $error)
                                                        <p style="color: red">{{ $error }}</p>
                                                    @endforeach --}}
                                                </div>

                                                <div class="col-lg-6 col-xl-5 col-12 mb-2">
                                                    <label>Total</label>
                                                    <input type="text" class="form-control amountInputDebit"
                                                        name="amountDebit[]" required value="{{ old('amountDebit[]') }}" />
                                                    @error('amountDebit[]')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-2">
                                                    <button class="btn btn-label-danger mt-4 deleteRowDebit"
                                                        style="display: none;">
                                                        <i class="bx bx-x me-1"></i>
                                                        <span class="align-middle">Hapus</span>
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
                                            <div class="row mb-3 mx-1 p-1" style="background-color: #f8f8ff; border-radius: 16px;">
                                                <div class="col-lg-6 col-xl-5 col-12 mb-2">
                                                    <label>Akun</label>
                                                    <select class="choices form-select select2 kreditAccount"
                                                        name="kreditAccountID[]">
                                                        <option></option>
                                                        @foreach ($account as $item)
                                                            <option value="{{ $item }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kreditAccountID[]')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>


                                                <div class="col-lg-6 col-xl-5 col-12 mb-2">
                                                    <label>Total</label>
                                                    <input type="text" class="form-control amountInputKredit"
                                                        name="amountKredit[]" required
                                                        value="{{ old('amountKredit[]') }}" />
                                                    @error('amountKredit[]')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-2">
                                                    <button class="btn btn-label-danger mt-4 deleteRowKredit"
                                                        style="display: none;">
                                                        <i class="bx bx-x me-1"></i>
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
                                        name="description"placeholder="" required value="{{ old('description') }}" />
                                    <label>Keterangan</label>
                                </div>
                                @error('description')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div id="overlay">
                                <div id="lottie-loading"></div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary show_confirm" id="company_form_btn">Tambah Transaksi</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.debitAccount').forEach(function(input) {
                $(input).select2({
                    placeholder: 'Pilih Akun Debit',
                    allowClear: true,
                    theme: 'bootstrap-5',
                    width: '100%',
                });
            });

            document.querySelectorAll('.kreditAccount').forEach(function(input) {
                $(input).select2({
                    placeholder: 'Pilih Akun Kredit',
                    allowClear: true,
                    theme: 'bootstrap-5',
                    width: '100%',
                });
            });

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
                if (kind == 'debit') {
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
                } else if (event.target.classList.contains('amountInputKredit')) {
                    updateTotal('kredit');
                }
            });

            //event handler (prevent duplicate accountID in debit and kredit)
            $('select[name="debitAccountID[]"]').change(function() {
                var selectedAccountId = $(this).val();
                var isDuplicate = checkDuplicateAccount(selectedAccountId,
                    'select[name="kreditAccountID[]"]');
                if (isDuplicate) {
                    Swal.fire({
                        title: 'Info',
                        html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                            '<p class="mt-2">Nomor akun yang sama tidak dapat dipilih di bagian debit dan kredit.</p>',
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
                        }
                    });
                    $(this).val('');
                }
            });

            $('select[name="kreditAccountID[]"]').change(function() {
                var selectedAccountId = $(this).val();
                var isDuplicate = checkDuplicateAccount(selectedAccountId,
                    'select[name="debitAccountID[]"]');
                if (isDuplicate) {
                    Swal.fire({
                        title: 'Info',
                        html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                            '<p class="mt-2">Nomor akun yang sama tidak dapat dipilih di bagian debit dan kredit.</p>',
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
                        }
                    });
                    $(this).val('');
                }
            });

            function checkDuplicateAccount(selectedAccountId, otherSectionSelector) {
                var isDuplicate = false;
                $(otherSectionSelector).each(function() {
                    if($(this).val() != '') {
                        if ($(this).val() == selectedAccountId) {
                            isDuplicate = true;
                            return false;
                        }
                    }
                });
                return isDuplicate;
            }
            //event handler (prevent duplicate accountID in debit and kredit)

            $("#addRowDebit").click(function(event) {
                event.preventDefault();

                //destroy select2
                // https://stackoverflow.com/questions/39142484/multiple-clone-not-working-when-append-in-select-2
                $("#rowDebit .row:first").find('.debitAccount').select2('destroy');

                const newRow = $("#rowDebit .row:first").clone();
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

                $('.debitAccount').select2({
                    placeholder: 'Pilih Akun Debit',
                    allowClear: true,
                    theme: 'bootstrap-5',
                    width: '100%',
                });
            });

            $("#addRowKredit").click(function(event) {
                event.preventDefault();

                $("#rowKredit .row:first").find('.kreditAccount').select2('destroy');

                const newRow = $("#rowKredit .row:first").clone();
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

                $('.kreditAccount').select2({
                    placeholder: 'Pilih Akun Kredit',
                    allowClear: true,
                    theme: 'bootstrap-5',
                    width: '100%',
                });
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
                if (item === "") {
                    item = "(Nama Kategori Belum Diisi)";
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin menambahkan transaksi?</p>',
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
                        // form.submit();
                        let formz = $('#company_form')[0];
                        let data = new FormData(formz);

                        $.ajax({
                            url: "{{ route('admin.ubsp.transaction.store') }}",
                            type: "POST",
                            data: data,
                            dataType: "JSON",
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                console.log('masuk success');
                                if (response.errors) {
                                    // Show validation errors
                                    var errorMsg = '';
                                    $.each(response.errors, function (field, errors) {
                                        $.each(errors, function (index, error) {
                                            errorMsg += error + '<br>';
                                        });
                                        // Show validation error messages next to corresponding input fields
                                        $('[name="' + field + '"]').after('<p class="mt-1" style="color: red">' + errors[0] + '</p>');
                                    });
                                } else {
                                    iziToast.success({
                                        message: response.success,
                                        position: 'topRight'
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log('masuk error');
                                iziToast.error({
                                    message: 'An error occurred: ' + error,
                                    position: 'topRight'
                                });
                            }
                        });

                        
                        // $.ajax({
                        //     headers: {
                        //         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        //     },
                        //     url: "{{ route('admin.ubsp.transaction.store') }}",
                        //     type: "POST",
                        //     data : data,
                        //     dataType:"JSON",
                        //     processData : false,
                        //     contentType:false,
                        //     success: function(response) {
                        //         console.log('masuk success');
                        //         if (response.errors) {
                        //             var errorMsg = '';
                        //             $.each(response.errors, function(field, errors) {
                        //                 $.each(errors, function(index, error) {
                        //                     errorMsg += error + '<br>';
                        //                 });
                        //             });
                        //             iziToast.error({
                        //                 message: errorMsg,
                        //                 position: 'topRight'
                        //             });
                                    
                        //         } else {
                        //             iziToast.success({
                        //                 message: response.success,
                        //                 position: 'topRight'
                        //             });
                        //         }           
                        //     },
                        //     error: function(xhr, status, error) {
                        //         console.log('masuk error');
                        //         console.log(error);
                        //         iziToast.error({
                        //             message: 'An error occurred: ' + error,
                        //             position: 'topRight'
                        //         });
                        //     }
                        // });
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
