@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">

    <style>
        #customCard {
            border: none;
            border-radius: 12px;
            color: #fff;
            background-image: linear-gradient(to right top, #0D41E1, #0C63E7, #0A85ED, #09A6F3, #07C8F9);
        }

        #customCardBorder {
            border-top-left-radius: 30px !important;
            border-top-right-radius: 30px !important;
            border: none;
            border-radius: 6px;
            background-color: blue;
            color: #fff;
            background-image: linear-gradient(to right top, #0a33b1, #094eb7, #086abc, #0784c2, #05a1c8);
        }

        .bgCard:hover {
            /* transform: scale(1.02); */
            opacity: 0.75;
        }
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
                        <a href="extended-ui-text-divider.html" class="menu-link">
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
                    <i class="menu-icon tf-icons bx bx-donate-heart"></i>
                    <div data-i18n="Basic">Simpanan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/tabungan" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-wallet"></i>
                    <div data-i18n="Basic">Tabungan</div>
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
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-chevrons-right"></i>
                    <div data-i18n="Basic">Pemasukan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-chevrons-left"></i>
                    <div data-i18n="Basic">Pengeluaran</div>
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
    {{-- @include('sweetalert::alert') --}}
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Beranda Anggota /</span> Tambah Anggota
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Formulir Anggota Baru</h5>
                        {{-- <small class="text-muted float-end">Sistem Akuntansi UBSP</small> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder=""
                                        oninput=capitalizeName(this) required value="{{ old('fname') }}" />
                                    <label for="fname">Nama Depan</label>
                                </div>
                                @error('fname')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder=""
                                        oninput=capitalizeName(this) required value="{{ old('lname') }}" />
                                    <label for="lname">Nama Belakang</label>
                                </div>
                                @error('lname')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="birthplace" name="birthplace"
                                        placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('birthplace') }}" />
                                    <label for="birthplace">Tempat Lahir</label>
                                </div>
                                @error('birthplace')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control mb-3" id="birthdate" name="birthdate"
                                        required value="{{ old('birthdate') }}">
                                    <label for="birthdate">Tanggal Lahir</label>
                                </div>
                                @error('birthdate')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('address') }}" />
                                    <label for="address">Alamat Tinggal</label>
                                </div>
                                @error('address')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="workAddress" name="workAddress"
                                        placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('workAddress') }}" />
                                    <label for="workAddress">Alamat Kerja</label>
                                </div>
                                @error('workAddress')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="" required value="{{ old('email') }}" />
                                    <label for="email">Email</label>
                                </div>
                                @error('email')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('phone') }}" />
                                    <label for="phone">No Hp</label>
                                </div>
                                @error('phone')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="mothername" name="mothername"
                                        placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('mothername') }}" />
                                    <label for="mothername">Nama Ibu Kandung</label>
                                </div>
                                @error('mothername')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="ktp">Foto KTP</label>
                                    <input type="file" class="image-resize-filepond" name="ktp" accept="image/*">
                                </div>
                                @error('ktp')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="kk">Foto Kartu Keluarga</label>
                                    <input type="file" class="image-preview-filepond" name="kk"
                                        accept="image/*">
                                </div>
                                @error('kk')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="divider divider-warning">
                                <div class="divider-text">Settingan Awal</div>
                            </div>

                            <div class="mb-3">
                                <label>Default Password</label>
                                <input type="text" readonly class="form-control-plaintext" id="defaultPassword"
                                    name="password" value="Ubsp.123" />
                            </div>

                            <div class="mb-3">
                                <label>Simpanan Pokok</label>
                                <input type="text" readonly class="form-control-plaintext" id="nominal"
                                    name="nominal" value="Rp 100,000" />
                            </div>

                            <div class="divider divider-warning">
                                <div class="divider-text"></div>
                            </div>

                            <div class="col-md mb-3">
                                <label class="">Jenis Pembayaran</small>
                                    <div class="form-check mt-3 mb-2">
                                        <input name="method" class="form-check-input" type="radio" value="cash"
                                            id="cash" {{ old('method') == 'cash' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="cash"> Cash </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="method" class="form-check-input" type="radio" value="transfer"
                                            id="transfer" {{ old('method') == 'transfer' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="transfer"> Transfer </label>
                                    </div>
                                    @error('method')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                            </div>

                            <div class="mb-3" id="bukti-trf" style="display: none;">
                                <div class="form-group has-icon-left">
                                    <label for="image">Bukti Pembayaran</label>
                                    <div class="position-relative">
                                        <input type="file" class="image-exif-filepond" name="simpanan"
                                            accept="image/*" />
                                    </div>
                                </div>
                                @error('simpanan')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-lg btn-primary show_confirm">Simpan</button>
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
            var selectedValue = $('input[name="method"]:checked').val();

            if (selectedValue == 'transfer') {
                $('#bukti-trf').show();
            } else {
                $('#bukti-trf').hide();
            }

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

            $('input[type="radio"]').on('change', function() {
                // Get the selected value
                var selectedValue = $('input[name="method"]:checked').val();

                if (selectedValue == 'transfer') {
                    $('#bukti-trf').show();
                } else {
                    $('#bukti-trf').hide();
                }
            });
        });
    </script>

    <script>
        @if ($message = session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Formulir anggota baru belum diisi secara lengkap',
                // text: '{{ Session::get('errors') }}',
            })
        @endif
    </script>
@endsection
