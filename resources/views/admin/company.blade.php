@extends('layout.admin.main')

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Profile UBSP</span>
        </h4>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Data Profile UBSP</h5>
                @if (count($company) == 0)
                    <a href="/admin/company/create" class="btn btn-primary">Tambah Data</a>
                @else
                    <a class="btn btn-primary disabled" onclick="return false;" style="cursor: not-allowed; pointer-events: all !important;">Tambah Data</a>
                @endif

            </div>

            <div class="card shadow-lg h-100 m-5">
                <div class="card-body">
                    @foreach ($company as $item)
                        @if ($item->logo != "")
                            <td><img class="img-fluid d-flex mx-auto my-4 rounded" src="/{{ $item->logo }}" width="30%"></td>    
                        @else
                            <td>-</td>
                        @endif

                        <div class="d-grid col-lg-12 mx-auto text-center">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            Alamat<p class="card-text">{{ $item->address }}</p>
                            Email<p class="card-text">{{ $item->email }}</p>
                            No Telepon<p class="card-text">{{ $item->phone }}</p>
                            Whatsapp<p class="card-text">{{ $item->whatsapp }}</p>
                            <a href="{{ route('admin.company.edit', $item->id) }}" class="btn btn-primary"><span class="tf-icons bx bxs-edit-alt me-1"></span>Edit Profile</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('vendorJS')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert2.js"></script>

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
