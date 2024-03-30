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
            <span class="text-muted fw-light">Beranda Anggota /</span> Edit Anggota
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Anggota UBSP</h5>
                    </div>

                    <div class="card-body">
                        <div class="mt-3">
                            <form action="{{ route('admin.user.update', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            placeholder="" value="{{ old('fname', $user->fname) }}" />
                                        <label for="fname">Nama Depan</label>
                                    </div>
                                    @error('fname')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lname" name="lname"
                                            placeholder="" value="{{ old('lname', $user->lname) }}" />
                                        <label for="lname">Nama Belakang</label>
                                    </div>
                                    @error('lname')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="birthplace" name="birthplace"
                                            placeholder="" value="{{ old('birthplace', $user->birthplace) }}" />
                                        <label for="birthplace">Tempat Lahir</label>
                                    </div>
                                    @error('birthplace')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control mb-3" id="birthdate" name="birthdate"
                                            value="{{ old('birthdate', $user->birthdate) }}">
                                        <label for="birthdate">Tanggal Lahir</label>
                                    </div>
                                    @error('birthdate')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="" value="{{ old('address', $user->address) }}" />
                                        <label for="address">Alamat Tinggal</label>
                                    </div>
                                    @error('address')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="" value="{{ old('email', $user->email) }}" />
                                        <label for="email">Email</label>
                                    </div>
                                    @error('email')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="workAddress" name="workAddress"
                                            placeholder="" value="{{ old('workAddress', $user->workAddress) }}" />
                                        <label for="workAddress">Alamat Kerja</label>
                                    </div>
                                    @error('workAddress')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="" value="{{ old('phone', $user->phone) }}" />
                                        <label for="phone">No Hp</label>
                                    </div>
                                    @error('phone')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="mothername" name="mothername"
                                            placeholder="" value="{{ old('mothername', $user->mothername) }}" />
                                        <label for="mothername">Nama Ibu Kandung</label>
                                    </div>
                                    @error('mothername')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="ktp">Foto KTP</label>
                                        @if ($user->ktp != '')
                                            <img style="width: 220px;" src="/{{ $user->ktp }}" alt=""
                                                class="img-fluid mb-3 mt-3 col-4 d-block">
                                        @else
                                            <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                        @endif
                                    </div>
                                    @error('ktp')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="file" class="image-resize-filepond" name="ktp"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="ktp">Foto KK</label>
                                        @if ($user->kk != '')
                                            <img style="width: 220px;" src="/{{ $user->kk }}" alt=""
                                                class="img-fluid mb-3 mt-3 col-4 d-block">
                                        @else
                                            <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                        @endif
                                    </div>
                                    @error('kk')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="file" class="image-preview-filepond" name="kk"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="divider divider-warning">
                                    <div class="divider-text">Data Simpanan Pokok</div>
                                </div>
                                <div class="mb-3">
                                    <label>Simpanan Pokok</label>
                                    <p>{{ $userAccount->balance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal Bayar</label>
                                    <p>{{ $transaction['transactionDate'] }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Jenis Pembayaran</label>
                                    @if ($transaction['method'] == 1)
                                        <p>Cash</p>
                                    @else
                                        <p>Transfer</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="ktp">Bukti Pembayaran</label>
                                        @if ($transaction['image'] != '')
                                            <img style="width: 220px;" src="/{{ $transaction['image'] }}" alt=""
                                                class="img-fluid mb-3 mt-3 col-4 d-block">
                                        @else
                                            <p>-</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="divider divider-warning">
                                    <div class="divider-text"></div>
                                </div>

                                {{-- ubah pembayaran --}}
                                <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">Ubah Data Pembayaran</button>
                                <div class="collapse mb-3" id="collapseExample">
                                    <div class="p-3 border">
                                        <label class="">Jenis Pembayaran</label>
                                        @if ($transaction['method'] == 1)
                                            <input type="hidden" name="currentMethod" value="1">
                                        @else
                                            <input type="hidden" name="currentMethod" value="2">
                                        @endif

                                        <div class="form-check mt-3 mb-2">
                                            <input name="method" class="form-check-input" type="radio" value="cash"
                                                id="cash" {{ old('method') == 'cash' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="cash"> Cash </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="method" class="form-check-input" type="radio"
                                                value="transfer" id="transfer"
                                                {{ old('method') == 'transfer' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="transfer"> Transfer </label>
                                        </div>
                                        @error('method')
                                            <p class="mt-1" style="color: red">{{ $message }}</p>
                                        @enderror

                                        <div id="bukti-trf" style="display: none;">
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
                                    </div>
                                </div>
                                <div id="overlay">
                                    <div id="lottie-loading"></div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary show_confirm">Update Data</button>
                                </div>
                            </form>
                        </div>
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

    <script src="/vendor/sweetalert/sweetalert2.js"></script>
    <script src="/vendor/lottie/lottie.min.js"></script>

    <script>
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
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin mengubah data anggota?</p>',
                    confirmButtonText: 'Ya, Ubah',
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
                text: 'Perubahan data anggota belum diisi secara lengkap',
                // text: '{{ Session::get('errors') }}',
            })
        @endif
    </script>
@endsection
