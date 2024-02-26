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
            <li class="menu-item active">
                <a href="/admin/journal" class="menu-link">
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>
    <script src="https://unpkg.com/autonumeric"></script>

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
