@extends('layout.admin.main')

@section('vendorCSS')
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
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
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
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="" required value="{{ old('fname') }}" />
                                    <label for="fname">Nama Depan</label>
                                </div>
                                @error('fname')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="" required value="{{ old('lname') }}" />
                                    <label for="lname">Nama Belakang</label>
                                </div>
                                @error('lname')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="birthplace" name="birthplace"
                                        placeholder="" required
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
                                        placeholder="" required
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
                                        placeholder="" required
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
                                        placeholder="" required
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

    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert2.js"></script>
    <script src="/vendor/lottie/lottie.min.js"></script>

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
                var item = $('input[name="fname"]').val() + ' ' +$('input[name="lname"]').val();
                if(item.trim() === "") {
                    item = "(Nama Anggota Belum Diisi)";
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin menambahkan anggota ' + item + '?</p>',
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
