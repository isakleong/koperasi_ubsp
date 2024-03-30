@extends('layout.admin.main')

@section('vendorCSS')
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
            <span class="text-muted fw-light">Kategori Akun / </span> Tambah Kategori
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Kategori Akun</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.account_category.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name"
                                        name="name"placeholder="" required
                                        value="{{ old('name') }}" />
                                    <label for="name">Nama Kategori</label>
                                </div>
                                @error('name')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="orderNumber" name="orderNumber" placeholder="" required value="{{ old('orderNumber') }}" min="0" />
                                    <label for="name">Urutan Prioritas</label>
                                </div>
                                @error('orderNumber')
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

    <script>
        $(document).ready(function() {
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
