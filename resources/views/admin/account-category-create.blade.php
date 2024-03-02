@extends('layout.admin.main')

@section('content')
    {{-- @include('sweetalert::alert') --}}
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
                                        name="name"placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('name') }}" />
                                    <label for="name">Nama Kategori</label>
                                </div>
                                @error('name')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="normalBalance" class="form-label">Saldo Normal</label>
                                <select class="form-select" id="normalBalance" aria-label="normalBalance"
                                    name="normalBalance">
                                    <option selected>--- Pilih Saldo Normal ---</option>
                                    <option value="D" {{ old('normalBalance') == 'D' ? 'selected' : '' }}>Debit
                                    </option>
                                    <option value="K" {{ old('normalBalance') == 'K' ? 'selected' : '' }}>Kredit
                                    </option>
                                </select>
                                @error('normalBalance')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    name="active" checked />
                                <label class="form-check-label" for="flexSwitchCheckChecked">Aktif?</label>
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
        @if ($message = session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data kategori akun belum diisi secara lengkap. Silahkan dicek kembali.',
                // text: '{{ Session::get('errors') }}',
            })
        @endif
    </script>
@endsection
