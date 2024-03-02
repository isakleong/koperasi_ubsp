@extends('layout.admin.main')

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Jurnal Harian</span>
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Transaksi Jurnal</h5>
                        {{-- <a href="/admin/account_category/create" class="btn btn-primary">Tambah Data</a> --}}
                    </div>

                    <div class="card-body">
                        {{-- <form action="{{ route('admin.account_category.store') }}" method="post">
                            @csrf                           
                            <div class="text-end">
                                <button type="submit" class="btn btn-lg btn-primary show_confirm">Tambah
                                    Kategori</button>
                            </div>
                        </form> --}}

                        <form action="{{ route('admin.journal.store') }}" method="post">
                            @csrf
                            <div class="row border border-2 m-2 mb-3 p-2">
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
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="description[]" value="{{ old('description[]') }}" />
                                    @error('description[]')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                    <label class="form-label">Debit</label>
                                    <input type="text" class="form-control debit" name="debit[]" required value="{{ old('debit[]') }}" />
                                    @error('debit[]')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                    <label class="form-label">Kredit</label>
                                    <input type="text" class="form-control kredit" name="kredit[]" required value="{{ old('debit[]') }}" />
                                    @error('kredit[]')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row border border-2 m-2 mb-3 p-2 data-repeater">
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
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="description[]" value="{{ old('description[]') }}"/>
                                    @error('description[]')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                    <label class="form-label">Debit</label>
                                    <input type="text" class="form-control debit" name="debit[]" required value="{{ old('debit[]') }}"/>
                                    @error('debit[]')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                    <label class="form-label">Kredit</label>
                                    <input type="text" class="form-control kredit" name="kredit[]" required value="{{ old('kredit[]') }}"/>
                                    @error('kredit[]')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                    <button class="btn btn-danger mt-4 data-repeater-delete">
                                    <i class="bx bx-x me-1"></i>
                                    <span class="align-middle">Delete</span>
                                    </button>
                                </div>
                            </div>
                           
                            <div>
                                <div class="row">
                                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0"></div>
                                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0"></div>
                                    
                                    <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                        <label class="form-label">Total Debit:</label>
                                        <span class="totalDebit" id="totalDebit">0</span>
                                    </div>
                            
                                    <!-- Total Kredit for the current group -->
                                    <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                        <label class="form-label">Total Kredit:</label>
                                        <span class="totalKredit" id="totalKredit">0</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary mb-3 data-repeater-create">
                                    <i class="bx bx-plus me-1"></i>
                                    <span class="align-middle">Tambah</span>
                                </button>
                                <button type="submit" class="btn btn-primary float-end show_confirm">Simpan</button>
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
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>
    <script src="/vendor/autonumeric/autonumeric.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.debit').forEach(function(input) {
                new AutoNumeric(input, {
                    currencySymbol: 'Rp ',
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    emptyInputBehavior: "zero",
                    watchExternalChanges: true
                });
            });

            document.querySelectorAll('.kredit').forEach(function(input) {
                new AutoNumeric(input, {
                    currencySymbol: 'Rp ',
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    emptyInputBehavior: "zero",
                    watchExternalChanges: true
                });
            });

            function updateTotal() {
                var totalDebit = 0;
                var totalKredit = 0;

                var debitInput = document.querySelectorAll('.debit');
                var kreditInput = document.querySelectorAll('.kredit');

                debitInput.forEach(function(item) {
                    // Use `unformat` method to get the numeric value
                    var val = AutoNumeric.getNumericString(item);
                    totalDebit += parseFloat(val);
                });

                kreditInput.forEach(function(item) {
                    // Use `unformat` method to get the numeric value
                    var val = AutoNumeric.getNumericString(item);
                    totalKredit += parseFloat(val);
                });

                document.getElementById("totalDebit").textContent = totalDebit.toFixed(2);
                document.getElementById("totalKredit").textContent = totalKredit.toFixed(2);
            }

            document.addEventListener('input', function(event) {
                if (event.target.classList.contains('debit') || event.target.classList.contains('kredit')) {
                    updateTotal();
                }
            });

            $('.data-repeater-delete').hide();
            $('.data-repeater-create').click(function(event) {
                event.preventDefault();

                var $parent = $(this).parent().parent();
                var $dataRepeaters = $parent.find(".data-repeater");

                // Clone the last data repeater form
                var $newForm = $dataRepeaters.last().clone().find('input, textarea').val('').end();

                // Find the input elements within the cloned element and initialize AutoNumeric
                $newForm.find('.debit').each(function() {
                    new AutoNumeric(this, {
                        currencySymbol: 'Rp ',
                        digitGroupSeparator: ',',
                        decimalCharacter: '.',
                        emptyInputBehavior: "zero",
                        watchExternalChanges: true
                    });
                });

                $newForm.find('.kredit').each(function() {
                    new AutoNumeric(this, {
                        currencySymbol: 'Rp ',
                        digitGroupSeparator: ',',
                        decimalCharacter: '.',
                        emptyInputBehavior: "zero",
                        watchExternalChanges: true
                    });
                });

                // Insert the new form before the current button's parent
                $newForm.insertBefore($(this).parent()).removeClass("data-repeater");

                // Show delete button only if there are more than or equal to 2 forms
                if ($dataRepeaters.length >= 1) {
                    $newForm.find(".data-repeater-delete").show();
                }

                // Attach click event to delete button
                $newForm.find(".data-repeater-delete").click(function(e) {
                    $(this).parent().parent().remove();
                    updateTotal();
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
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
        });
    </script>

    <script>
        @if ($message = session('errorData'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                // text: '',
                text: 'Formulir anggota baru belum diisi secara lengkap. Silahkan dicek kembali.',
            })
        @endif
    </script>
@endsection
