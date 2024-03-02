@extends('layout.admin.main')

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light text-muted">Konfigurasi Data / </span> Edit Konfigurasi
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Konfigurasi</h5>
                        {{-- <a href="/admin/company/create" class="btn btn-primary">Tambah Konfigurasi</a> --}}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.config.update', $config->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="" readonly value="{{ $config->name }}" style="cursor: not-allowed; pointer-events: all !important;" />
                                    <label for="name">Nama</label>
                                </div>
                                @error('name')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="desc" name="desc"
                                        placeholder="" required value="{{ old('desc', $config->desc) }}" />
                                    <label for="desc">Deskripsi</label>
                                </div>
                                @error('desc')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="value" name="value"
                                        placeholder="" required value="{{ old('value', $config->value) }}" />
                                    <label for="value">Nilai</label>
                                </div>
                                @error('value')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary show_confirm">Update
                                    Konfigurasi</button>
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
        $(document).ready(function() {
            $('.show_confirm').click(function(event) {
                event.preventDefault();

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Hapus Data?',
                    text: '',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, hapus',
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
                text: '{{ Session::get('errorData') }}',
            })
        @endif
    </script>
@endsection
