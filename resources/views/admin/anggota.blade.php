@extends('layout.admin.main')

@section('vendorCSS')
    <style>
        #customCard {
            border: none;
            border-radius: 12px;
            color: #fff;
            background-image: linear-gradient(to right top, #0D41E1, #0C63E7, #0A85ED, #09A6F3, #07C8F9);
        }

        #customCardBorder {
            border-top-left-radius: 30px !important;
            border-top-right-radius: 30px !important;
            border: none;
            border-radius: 6px;
            background-color: blue;
            color: #fff;
            background-image: linear-gradient(to right top, #0a33b1, #094eb7, #086abc, #0784c2, #05a1c8);
        }

        .bgCard:hover {
            /* transform: scale(1.02); */
            opacity: 0.75;
        }
    </style>
@endsection

@section('content')
    {{-- @include('sweetalert::alert') --}}
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            {{-- <span class="text-muted fw-light">Anggota /</span> Pagination and breadcrumbs --}}
            <span class="fw-light">Beranda Anggota
        </h4>

        <div class="row">
            {{-- kartu --}}
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-6 mb-4 bgCard">
                        <a href="/admin/user/create">
                            <div class="container-fluid">
                                <div class="p-3" id="customCard">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="/administrator/assets/img/icons/multiple_user.png" width="50" />
                                        <span><i class='bx bxs-message-square-add' style="font-size: 3em;"></i></span>
                                    </div>
                                    {{-- <div class="px-2 number mt-3 d-flex justify-content-between align-items-center">
                                    <span>Tambah Anggota</span>
                                </div> --}}
                                    <div class="p-4 mt-4" id="customCardBorder">
                                        {{-- <div class="d-flex justify-content-between align-items-center">
                                        <span class="cardholder">Tambah Anggota</span>
                                    </div> --}}
                                        <div class="text-center">
                                            <span class="cardholder">Tambah Anggota</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 mb-4 bgCard">
                        <a href="/admin/user">
                            <div class="container-fluid">
                                <div class="p-3" id="customCard">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <img src="/administrator/assets/img/icons/multiple_user.png" width="50" />
                                        <span><i class='bx bxs-message-square-edit' style="font-size: 3em;"></i></span>
                                    </div>
                                    <div class="p-4 mt-4" id="customCardBorder">
                                        <div class="text-center">
                                            <span class="cardholder">Edit Anggota</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('vendorJS')
<script src="/administrator/js/jquery.min.js"></script>
<script src="/vendor/sweetalert/sweetalert.all.js"></script>

<script>
    @if ($message = session('success'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Success',
            // text: '{{ Session::get('errors') }}',
        })
    @endif
</script>
    
@endsection
