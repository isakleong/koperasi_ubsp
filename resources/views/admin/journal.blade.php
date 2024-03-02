@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/flatpickr/flatpickr.css"/>
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
                        <h5 class="mb-0">Laporan Jurnal</h5>
                        <a href="/admin/journal/create" class="btn btn-primary">Input Jurnal</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.account_category.store') }}" method="post">
                            @csrf
                            <div class="row d-flex justify-content-between align-items-end">
                                <div class="col-md-3 col-12 mb-3">
                                    <label for="startDate" class="form-label">Tanggal Awal</label>
                                    <input type="text" class="form-control dob-picker" placeholder="Hari-Bulan-Tahun" id="startDate" name="startDate" />
                                    @error('startDate')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-12 mb-3">
                                    <label for="endDate" class="form-label">Tanggal Akhir</label>
                                    <input type="text" class="form-control dob-picker" placeholder="Hari-Bulan-Tahun" id="endDate" name="endDate" />
                                    @error('endDate')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-12 mb-3">
                                    <label for="normalBalance" class="form-label">Periode</label>
                                    <select class="form-select" id="normalBalance" aria-label="normalBalance"
                                        name="normalBalance">
                                        <option selected>--- Pilih Periode ---</option>
                                        <option value="D">Tanggal</option>
                                        <option value="D">Hari ini</option>
                                        <option value="D">Minggu ini</option>
                                        <option value="D">Bulan ini</option>
                                        <option value="D">Tahun ini</option>
                                        <option value="D">Kemarin</option>
                                        <option value="D">Minggu Lalu</option>
                                        <option value="D">Bulan Lalu</option>
                                        <option value="D">Tahun Lalu</option>
                                    </select>
                                    @error('normalBalance')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-12 mb-3">
                                    <a href="/admin/account_category/create" class="btn btn-primary">Cari Data</a>
                                </div>
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
    <script src="/vendor/flatpickr/flatpickr.js"></script>

    <script>
        $(document).ready(function() {
            $(".dob-picker").flatpickr({
                monthSelectorType: "static",
                dateFormat: "d-m-Y"
            });

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
