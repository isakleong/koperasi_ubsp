@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Pengajuan Kredit
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h3>Ubah Password</h3>
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
                                <form action="{{ route('password-update') }}" method="post">
                                    @csrf
                                    <label for="current_password" class="form-label">Password Lama</label>
                                    <div class="input-group mb-3">
                                        <input name="current_password" type="password" value="{{ old('current_password') }}" class="input form-control" id="current_password" placeholder="Password Lama" required/>
                                        <span class="input-group-text" onclick="currentPasswordToggle();">
                                            <i class="fas fa-eye" id="show_eye_current"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye_current"></i>
                                        </span>
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label for="password" class="form-label">Password Lama</label>
                                    <div class="input-group mb-3">
                                        <input name="password" type="password" value="{{ old('password') }}" class="input form-control" id="password" placeholder="Password Baru" required/>
                                        <span class="input-group-text" onclick="passwordToggle();">
                                            <i class="fas fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                        </span>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <div class="input-group mb-3">
                                        <input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="input form-control" id="password_confirmation" placeholder="Konfirmasi Password Baru" required/>
                                        <span class="input-group-text" onclick="passwordConfirmationToggle();">
                                            <i class="fas fa-eye" id="show_eye_confirm"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye_confirm"></i>
                                        </span>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
        
                                    <div class="form-group my-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-block shadow-lg mt-3 btn-primary show_confirm">Ubah Password</button>
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
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    <script>
        function currentPasswordToggle() {
            var x = document.getElementById("current_password");
            var show_eye = document.getElementById("show_eye_current");
            var hide_eye = document.getElementById("hide_eye_current");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function passwordToggle() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function passwordConfirmationToggle() {
            var x = document.getElementById("password_confirmation");
            var show_eye = document.getElementById("show_eye_confirm");
            var hide_eye = document.getElementById("hide_eye_confirm");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        $(document).ready(function() {
            $('.show_confirm').click(function(event) {
                event.preventDefault();

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Ubah password?',
                    text: "Pastikan password lama yang diinput sudah sesuai dengan password yang tersimpan di database.",
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
@endsection

@endsection
