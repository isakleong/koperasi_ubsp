@extends('layout.admin.main')

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Kategori Akun / </span> Edit Kategori
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Kategori Akun</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.account_category.update', $accountCategory->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="" required
                                        value="{{ old('name', $accountCategory->name) }}" />
                                    <label for="name">Nama Kategori</label>
                                </div>
                                @error('name')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="orderNumber" name="orderNumber" placeholder="" required value="{{ old('orderNumber', $accountCategory->orderNumber) }}" min="0" />
                                    <label for="name">Urutan Prioritas</label>
                                </div>
                                @error('orderNumber')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    name="active" {{ $accountCategory->active == '1' ? 'checked' : '' }} />
                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary show_confirm">Update
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

                Swal.fire({
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin mengubah data kategori akun?</p>',
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
        });
    </script>
@endsection
