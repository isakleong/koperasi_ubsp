@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
    
    <link rel="stylesheet" href="/vendor/bs-stepper/css/bs-stepper.css">
    {{-- <link rel="stylesheet" href="/vendor/bs-stepper/css/theme-default.css"> --}}

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
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
@livewireStyles

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
                        {{-- <div class="bs-stepper wizard-numbered mt-2">
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#account-details">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label mt-1">
                                            <span class="bs-stepper-title">Account Details</span>
                                            <span class="bs-stepper-subtitle">Setup Account Details</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="bx bx-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#personal-info">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label mt-1">
                                            <span class="bs-stepper-title">Personal Info</span>
                                            <span class="bs-stepper-subtitle">Add personal info</span>
                                        </span>

                                    </button>
                                </div>
                                <div class="line">
                                    <i class="bx bx-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#social-links">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label mt-1">
                                            <span class="bs-stepper-title">Social Links</span>
                                            <span class="bs-stepper-subtitle">Add social links</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <form onSubmit="return false">
                                    <!-- Account Details -->
                                    <div id="account-details" class="content">
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">Account Details</h6>
                                            <small>Enter Your Account Details.</small>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="username">Username</label>
                                                <input type="text" id="username" class="form-control"
                                                    placeholder="johndoe" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email" class="form-control"
                                                    placeholder="john.doe@email.com" aria-label="john.doe" />
                                            </div>
                                            <div class="col-sm-6 form-password-toggle">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password" class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="password2" />
                                                    <span class="input-group-text cursor-pointer" id="password2"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 form-password-toggle">
                                                <label class="form-label" for="confirm-password">Confirm
                                                    Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="confirm-password" class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="confirm-password2" />
                                                    <span class="input-group-text cursor-pointer"
                                                        id="confirm-password2"><i class="bx bx-hide"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <button class="btn btn-label-secondary btn-prev" disabled>
                                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-primary btn-next">
                                                    <span
                                                        class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Personal Info -->
                                    <div id="personal-info" class="content">
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">Personal Info</h6>
                                            <small>Enter Your Personal Info.</small>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="first-name">First Name</label>
                                                <input type="text" id="first-name" class="form-control"
                                                    placeholder="John" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="last-name">Last Name</label>
                                                <input type="text" id="last-name" class="form-control"
                                                    placeholder="Doe" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="country">Country</label>
                                                <select class="select2" id="country">
                                                    <option label=" "></option>
                                                    <option>UK</option>
                                                    <option>USA</option>
                                                    <option>Spain</option>
                                                    <option>France</option>
                                                    <option>Italy</option>
                                                    <option>Australia</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="language">Language</label>
                                                <select class="selectpicker w-auto" id="language"
                                                    data-style="btn-transparent" data-icon-base="bx"
                                                    data-tick-icon="bx-check text-white" multiple>
                                                    <option>English</option>
                                                    <option>French</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <button class="btn btn-primary btn-prev">
                                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-primary btn-next">
                                                    <span
                                                        class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Social Links -->
                                    <div id="social-links" class="content">
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">Social Links</h6>
                                            <small>Enter Your Social Links.</small>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="twitter">Twitter</label>
                                                <input type="text" id="twitter" class="form-control"
                                                    placeholder="https://twitter.com/abc" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="facebook">Facebook</label>
                                                <input type="text" id="facebook" class="form-control"
                                                    placeholder="https://facebook.com/abc" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="google">Google+</label>
                                                <input type="text" id="google" class="form-control"
                                                    placeholder="https://plus.google.com/abc" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="linkedin">LinkedIn</label>
                                                <input type="text" id="linkedin" class="form-control"
                                                    placeholder="https://linkedin.com/abc" />
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <button class="btn btn-primary btn-prev">
                                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-success btn-submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> --}}

                        <livewire:user-register-wizard />

                        {{-- @if (isset($configuration) && count($configuration) == 2)
                        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
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
                                <div id="lottie-loading"></div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary show_confirm">Tambah Anggota</button>
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
                        @endif --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

{{-- @livewireScripts --}}
@section('vendorJS')
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

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert2.js"></script>
    <script src="/vendor/lottie/lottie.min.js"></script>

    <script src="/vendor/bs-stepper/js/bs-stepper.js"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            console.log("yes loaded");
    // Reinitialize Filepond
    FilePond.parse(document.body);
});

    </script>

    <script>
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

            $('.show_confirm').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                var item = $('input[name="fname"]').val() + ' ' + $('input[name="lname"]').val();
                if (item.trim() === "") {
                    item = "(Nama Anggota Belum Diisi)";
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin menambahkan anggota ' + item +
                        '?</p>',
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

            @if ($message = session('errors'))
                Swal.fire({
                    title: 'Error',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Formulir anggota baru belum diisi secara lengkap. Silahkan dicek kembali.</p>',
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
        });
    </script>
@endsection
@livewireScripts
