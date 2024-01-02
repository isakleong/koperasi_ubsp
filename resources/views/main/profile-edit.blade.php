@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Pengajuan Kredit
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h3>Ubah Data Diri</h3>
        </div>
        <div class="page-content">
            <section class="section">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <div class="avatar avatar-2xl">
                                        <img src="/main/assets/compiled/jpg/1.jpg" alt="Avatar">
                                    </div>
                                    <h3 class="mt-3 text-center">{{ ucfirst($user->fname) . ' ' . ucfirst($user->lname) }}</h3>
                                    <p class="text-small text-center">Anggota sejak {{ Carbon\Carbon::parse($user->joinDate)->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('profile-update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div id="register-section1" class="card-content">
                                        <div class="card-body">
                                            <div class="alert alert-warning">
                                                Untuk mengubah foto KTP atau KK, Anda dapat : 
                                                <ul>
                                                    <li>Datang langsung ke kantor UBSP</li>
                                                    <li>Mengajukan via email ke {{ $company->email }}</li>
                                                    @if ($company->phone != null)
                                                    <li>Mengajukan via telepon ke {{ $company->phone }}</li>
                                                    @endif

                                                    @if ($company->whatsapp != null)
                                                    <li>Mengajukan via Whatsapp ke {{ $company->whatsapp }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fname">Nama Depan</label>
                                                        <input type="text" id="fname" class="form-control" placeholder="Nama Depan" name="fname" value="{{ old('fname', $user->fname) }}">
                                                    </div>
                                                    @error('fname')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="lname">Nama Belakang</label>
                                                        <input type="text" id="lname" class="form-control" placeholder="Nama Belakang" name="lname" value="{{ old('lname', $user->lname) }}">
                                                    </div>
                                                    @error('lname')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="birthplace">Tempat Lahir</label>
                                                        <input type="text" id="birthplace" class="form-control" placeholder="Tempat Lahir" name="birthplace" value="{{ old('birthplace', $user->birthplace) }}">
                                                    </div>
                                                    @error('birthplace')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="birthdate">Tanggal Lahir</label>
                                                        <input type="date" class="form-control mb-3" name="birthdate"
                                                        value="{{ old('birthdate', $user->birthdate) }}">
                                                    </div>
                                                    @error('birthdate')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="address">Alamat Tinggal</label>
                                                        <input type="text" id="address" class="form-control"
                                                            name="address" placeholder="Alamat Tinggal"
                                                            value="{{ old('address', $user->address) }}">
                                                    </div>
                                                    @error('address')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="work-address">Alamat Kerja</label>
                                                        <input type="text" id="work-address" class="form-control"
                                                            name="workAddress" placeholder="Alamat Kerja"
                                                            value="{{ old('workAddress', $user->workAddress) }}">
                                                    </div>
                                                    @error('workAddress')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="phone-number">No Hp</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">+62</span>
                                                            <input type="text" class="form-control" placeholder="No Hp"
                                                                aria-label="No Hp" aria-describedby="basic-addon1"
                                                                name="phone" value="{{ old('phone', $user->phone) }}">
                                                        </div>
                                                    </div>
                                                    @error('phone')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="mothername">Nama Ibu Kandung</label>
                                                        <input type="text" class="form-control" id="mothername"
                                                            name="mothername" placeholder="Nama Ibu Kandung"
                                                            value="{{ old('mothername', $user->mothername) }}">
                                                    </div>
                                                    @error('mothername')
                                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-primary btn-block shadow-lg mt-3 show_confirm">Ubah Data Diri</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@section('vendorJS')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    {{-- <script src="/vendor/sweetalert/sweetalert.all.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.show_confirm').click(function(event) {
                event.preventDefault();

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Ubah data diri?',
                    text: "Pastikan data diri yang diinput sudah benar.",
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, ubah',
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
            text: 'Mohon maaf, gagal mengubah data diri karena terdapat data yang belum diisi secara lengkap. Silahkan dicek kembali.',
            // text: '{{ Session::get('errors') }}',
        })
    @endif
</script>
@endsection

@endsection
