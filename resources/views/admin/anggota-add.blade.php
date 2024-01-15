@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">

    <link rel="stylesheet" href="/vendor/sweetalert/sweetalert2.css">

    <style>
        /* body, html {
            height: 100%;
            margin: 0;
            overflow: auto;
        } */

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


        #lottie-container {
            position: absolute;
            width: 25%;
            height: 25%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
                    @if (isset($configuration) && count($configuration) == 2)
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Formulir Anggota Baru</h5>
                        {{-- <small class="text-muted float-end">Sistem Akuntansi UBSP</small> --}}
                    </div>
                    @endif
                    <div class="card-body">
                        @if (isset($configuration) && count($configuration) == 2)
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
                                        placeholder="" oninput=validateNumberInput(this) required
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
                                    <input type="file" class="image-resize-filepond" name="ktp" id="ktp" accept="image/*">
                                </div>
                                @error('ktp')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="kk">Foto Kartu Keluarga</label>
                                    <input type="file" class="image-preview-filepond" name="kk" id="kk"
                                        accept="image/*">
                                </div>
                                @error('kk')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="alert alert-primary" role="alert">
                                <div>
                                    <label>Default Password</label>
                                    <input type="text" readonly class="form-control-plaintext" id="defaultPassword"
                                        name="password" value="{{ $configuration[0]->value }}" />
                                </div>
                                <div>
                                    <label>Simpanan Pokok</label>
                                    <input type="text" readonly class="form-control-plaintext" id="nominal"
                                        name="nominal" value="Rp {{ number_format($configuration[1]->value) }}" />
                                </div>
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

                            <div id="overlay">
                                <div id="lottie-container"></div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-lg btn-primary show_confirm">Tambah Anggota</button>
                            </div>
                        </form>
                        @else
                        <div class="container-xxl container-p-y text-center">
                            <div class="misc-wrapper">
                                <div class="mb-4">
                                    <img src="/administrator/assets/img/illustrations/not-found.jpg" alt="page-misc-error-light"
                                        width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png"
                                        data-app-light-img="illustrations/page-misc-error-light.png" />
                                </div>
                                
                                <h5 class="mb-4 mx-2">Konfigurasi anggota UBSP tidak ditemukan, silahkan melakukan setting terlebih dahulu.</h5>
                            </div>
                        </div>
                        @endif
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

    <script src="/administrator/js/jquery.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert2.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lottie-web@5.12.2/build/player/lottie.min.js"></script>

    <script>
        //capitalize input
        function capitalizeName(input) {
            const name = input.value.toLowerCase();
            const words = name.split(' ');
            const capitalizedWords = words.map(word => word.charAt(0).toUpperCase() + word.slice(1));
            input.value = capitalizedWords.join(' ');
        }
        //end of capitalize input

        function validateNumberInput(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        $(document).ready(function() {
            var selectedValue = $('input[name="method"]:checked').val();

            if (selectedValue == 'transfer') {
                $('#bukti-trf').show();
            } else {
                $('#bukti-trf').hide();
            }

            var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-container'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: '/administrator/assets/lottie/loading.json',
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid meet'
                    }
                });

                $('#overlay').show();

                $('body, html').css('overflow', 'hidden');

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

                // Swal.fire({
                //     title: "Question!",
                //     text: " You clicked the button!",
                //     icon: "question",
                //     customClass: {
                //         confirmButton: "btn btn-primary"
                //     },
                //     buttonsStyling: !1
                // });
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

            $('form').submit(function() {
                // Disable the submit button
                $(':submit', this).prop('disabled', true);

                var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-container'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: '/administrator/assets/lottie/loading.json',
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid meet'
                    }
                });

                $('#overlay').show();

                $('body, html').css('overflow', 'hidden');

                // hideLoadingOverlay();

                return true;
            });

            // function hideLoadingOverlay() {
            //     $('#overlay').hide();
            //     $('body, html').css('overflow', 'auto');
            // }
        });
    </script>

    <script>
        @if ($message = session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Formulir anggota baru belum diisi secara lengkap. Silahkan dicek kembali.',
                // text: '{{ Session::get('errors') }}',
            })
        @endif
    </script>
@endsection
