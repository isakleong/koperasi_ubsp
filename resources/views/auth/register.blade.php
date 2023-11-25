<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Akuntansi UBSP</title>



    <link rel="shortcut icon" href="/main/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">
    <link rel="stylesheet" href="/main/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/auth.css">

    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">

    <style>
        .hidden {
            display: none;
        }
        .circular-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .circular-btn i {
            line-height: 1; /* Ensures proper vertical alignment */
            
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo text-center">
                        <a href="/"><img src="/main/assets/static/images/logo/UBSP-logos_transparent.png"
                                alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Daftar</h1>
                    <p class="auth-subtitle mb-5">Yuk, jadi anggota Sistem Akuntansi UBSP!</p>

                    <form id="formRegister" action="register" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div id="register-section5" class="hidden">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary mb-3 circular-btn" id="btnBack4"><i class="bi bi-arrow-left"></i></button>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="nominal">Nominal Simpanan Pokok</label>
                                            <input type="text" id="nominal" class="form-control" placeholder="Nominal Simpanan Pokok" name="nominal" value="100,000" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="simpanan">Bukti Pembayaran</label>
                                            <input type="file" class="image-exif-filepond" name="simpanan" accept="image/*">
                                        </div>
                                    </div>
                                    

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary me-1 mb-1" id="btnContinue4">Lanjutkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="register-section3" class="hidden">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary mb-3 circular-btn" id="btnBack2"><i class="bi bi-arrow-left"></i></button>
                                <div class="row">
                                    <div class="col-md-12 col-12 text-center">
                                        <img src="/main/assets/compiled/png/simpanan_pokok.png" width="55%" alt="Logo">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary btn-block shadow-lg mt-1" id="openSimpanan">Buka Simpanan Pokok</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-outline-primary btn-block shadow-lg mt-1" id="skipSimpanan">Nanti Saja</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="register-section1" class="card-content">
                            <div class="card-body">
                                <a href="{{route('login')}}" class="btn btn-primary mb-3 circular-btn" role="button"><i class="bi bi-arrow-left"></i></a>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="fname">Nama Depan</label>
                                            <input type="text" id="fname" class="form-control" placeholder="Nama Depan" name="fname" value="{{old('fname')}}">
                                            <p id="fname-check" style="color: red; display: none;">Nama Depan harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="lname">Nama Belakang</label>
                                            <input type="text" id="lname" class="form-control" placeholder="Nama Belakang" name="lname" value="{{old('lname')}}">
                                            <p id="lname-check" style="color: red; display: none;">Nama Belakang harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="birthplace">Tempat Lahir</label>
                                            <input type="text" id="birthplace" class="form-control" placeholder="Tempat Lahir" name="birthplace" value="{{old('birthplace')}}">
                                            <p id="birthplace-check" style="color: red; display: none;">Tempat Lahir harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="birthdate">Tanggal Lahir</label>
                                            <input type="date" class="form-control mb-3" id="birthdate" name="birthdate" value="{{old('birthdate')}}">
                                            <p id="birthdate-check" style="color: red; display: none;">Tanggal Lahir harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address">Alamat Tinggal</label>
                                            <input type="text" id="address" class="form-control" name="address" placeholder="Alamat Tinggal" value="{{old('address')}}">
                                            <p id="address-check" style="color: red; display: none;">Alamat Tinggal harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="workAddress">Alamat Kerja</label>
                                            <input type="text" id="workAddress" class="form-control" name="workAddress" placeholder="Alamat Kerja" value="{{old('workAddress')}}">
                                            <p id="workAddress-check" style="color: red; display: none;">Alamat Kerja harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                                            <p id="email-check" style="color: red; display: none;">Email harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="phone-number">No Hp</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">+62</span>
                                                <input type="text" class="form-control" placeholder="No Hp" aria-label="No Hp" aria-describedby="basic-addon1" id="phone" name="phone" value="{{old('phone')}}">
                                            </div>
                                            <p id="phone-check" style="color: red; display: none;">No HP harus diisi</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary me-1 mb-1" id="btnContinue">Lanjutkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="register-section2" class="hidden">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary mb-3 circular-btn" id="btnBack"><i class="bi bi-arrow-left"></i></button>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="kk">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            <p id="password-check" style="color: red; display: none;">Password harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="confirmPassword">Konfirmasi Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Konfirmasi Password">
                                            <p id="confirmPassword-check" style="color: red; display: none;">Konfirmasi password harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="mothername">Nama Ibu Kandung</label>
                                            <input type="text" class="form-control" id="mothername" name="mothername" placeholder="Nama Ibu Kandung" value="{{old('mothername')}}">
                                            <p id="mothername-check" style="color: red; display: none;">Nama Ibu Kandung harus diisi</p>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary me-1 mb-1" id="btnContinue2">Lanjutkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="register-section4" class="hidden">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary mb-3 circular-btn" id="btnBack3"><i class="bi bi-arrow-left"></i></button>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="ktp">Foto KTP</label>
                                            <input type="file" class="image-resize-filepond" name="ktp" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="kk">Foto Kartu Keluarga</label>
                                            <input type="file" class="image-preview-filepond" name="kk" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Daftar</button>
                            </div>
                            <div class="text-center mt-5 text-lg fs-4">
                                <p class='text-gray-600'>Sudah punya akun? <a href="{{route('login')}}" class="font-bold">Masuk</a></p>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script src="/main/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
<script src="/main/assets/extensions/filepond/filepond.js"></script>
<script src="/main/assets/extensions/toastify-js/src/toastify.js"></script>
<script src="/main/assets/static/js/pages/filepond.js"></script>

<script src="/vendor/sweetalert/sweetalert.all.js"></script>

<script>
    $(document).ready(function() {
        //onchange
        // $("#fname").keyup(function () {
        //     validateData("fname");
        // });
        // $("#lname").keyup(function () {
        //     validateData("lname");
        // });
        // $("#birthplace").keyup(function () {
        //     validateData("birthplace");
        // });
        // $("#birthdate").keyup(function () {
        //     validateData("birthdate"); 
        // });    
        // $("#birthdate").change(function () {
        //     validateData("birthdate");
        // });
        // $("#address").keyup(function () {
        //     validateData("address");
        // });
        // $("#workAddress").keyup(function () {
        //     validateData("workAddress");
        // });
        // $("#email").keyup(function () {
        //     validateData("email");
        // });
        // $("#phone").keyup(function () {
        //     validateData("phone");
        // });
        // $("#password").keyup(function () {
        //     validateData("password");
        // });
        // $("#confirmPassword").keyup(function () {
        //     validateData("confirmPassword");
        // });
        // $("#mothername").keyup(function () {
        //     validateData("mothername");
        // });

        //prevent enter submit button
        $("#formRegister").on("keypress", function (event) { 
            var keyPressed = event.keyCode || event.which; 
            if (keyPressed === 13) { 
                event.preventDefault();
                return false; 
            } 
        }); 

        function validateData(type) {
            if (type == "fname") {
                let dataValue = $("#fname").val();
                if (dataValue.length == "") {
                    $("#fname-check").show();
                    return 0;
                } else {
                    $("#fname-check").hide();
                    return 1;              
                }
            } else if (type == "lname") {
                let dataValue = $("#lname").val();
                if (dataValue.length == "") {
                    $("#lname-check").show();
                    return 0;
                } else {
                    $("#lname-check").hide();
                    return 1;
                }
            } else if (type == "birthplace") {
                let dataValue = $("#birthplace").val();
                if (dataValue.length == "") {
                    $("#birthplace-check").show();
                    return 0;
                } else {
                    $("#birthplace-check").hide();
                    return 1;
                }
            } else if (type == "birthdate") {
                let dataValue = $("#birthdate").val();
                if (dataValue.length == "") {
                    $("#birthdate-check").show();
                    return 0;
                } else {
                    $("#birthdate-check").hide();
                    return 1;
                }
            } else if (type == "address") {
                let dataValue = $("#address").val();
                if (dataValue.length == "") {
                    $("#address-check").show();
                    return 0;
                } else {
                    $("#address-check").hide();
                    return 1;
                }
            } else if (type == "workAddress") {
                let dataValue = $("#workAddress").val();
                if (dataValue.length == "") {
                    $("#workAddress-check").show();
                    return 0;
                } else {
                    $("#workAddress-check").hide();
                    return 1;
                }
            } else if (type == "email") {
                let dataValue = $("#email").val();
                if (dataValue.length == "") {
                    $("#email-check").text("Email harus diisi");
                    $("#email-check").show();
                    return 0;
                } else {
                    $("#email-check").hide();
                    let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
                    if (regex.test(dataValue)) {
                        $("#email-check").hide();
                        return 1;
                    } else {
                        $("#email-check").text("Email tidak valid");
                        $("#email-check").show();
                        return 0;
                    }
                }
            } else if (type == "phone") {
                let dataValue = $("#phone").val();
                if (dataValue.length == "") {
                    $("#phone-check").show();
                    return 0;
                } else {
                    let regex = /^[8]\d{8,11}$/;
                    if (regex.test(dataValue)) {
                        $("#phone-check").hide();
                        return 1;
                    } else {
                        $("#phone-check").text("No Hp tidak valid");
                        $("#phone-check").show();
                        return 0;
                    }
                }
            } else if(type == "password") {
                let dataValue = $("#password").val();
                if (dataValue.length == "") {
                    $("#password-check").show();
                    return 0;
                }

                if (dataValue.length < 8) {
                    $("#password-check").text("Minimal panjang password adalah 8");
                    $("#password-check").show();
                    return 0;
                } else {
                    $("#password-check").hide();
                    return 1;
                }
            } else if(type == "confirmPassword") {
                let dataValue = $("#confirmPassword").val();
                if (dataValue.length == "") {
                    $("#confirmPassword-check").show();
                    return 0;
                } else {
                    $("#confirmPassword-check").hide();

                    let confirmPasswordValue = $("#confirmPassword").val();
                    let passwordValue = $("#password").val();
                    if (passwordValue != confirmPasswordValue) {
                        $("#confirmPassword-check").text("Konfirmasi password tidak sesuai");
                        $("#confirmPassword-check").show();
                        return 0;
                    } else {
                        $("#confirmPassword-check").hide();
                        return 1;
                    }

                    
                    return 1;
                }
            } else if(type == "mothername") {
                let dataValue = $("#mothername").val();
                if (dataValue.length == "") {
                    $("#mothername-check").show();
                    return 0;
                } else {
                    $("#mothername-check").hide();
                    return 1;
                }
            }
        }

        function validateDataSection(params) {
            if(params == '1') {
                let isValid = 0;

                isValid += validateData('fname');
                isValid += validateData('lname');
                isValid += validateData('birthplace');
                isValid += validateData('birthdate');
                isValid += validateData('address');
                isValid += validateData('workAddress');
                isValid += validateData('email');
                isValid += validateData('phone');

                return isValid;
            } else {
                let isValid = 0;

                isValid += validateData('password');
                isValid += validateData('confirmPassword');
                isValid += validateData('mothername');

                return isValid;
            }
        }

        $("#btnContinue").click(function() {
            let validateData = validateDataSection('1');
            if(validateData == 8){
                $("#register-section1").hide();
                $("#register-section2").show();
            }
        });

        $("#btnContinue2").click(function() {
            let validateData = validateDataSection('2');
            if(validateData == 3){
                $("#register-section2").hide();
                $("#register-section3").show();
            }
        });

        $("#btnContinue3").click(function() {
            $("#register-section3").hide();
            $("#register-section4").show();
        });

        $("#btnContinue4").click(function() {
            $("#register-section5").hide();
            $("#register-section4").show();
        });

        $("#btnBack").click(function() {
            $("#register-section2").hide();
            $("#register-section1").show();
        });

        $("#btnBack2").click(function() {
            $("#register-section3").hide();
            $("#register-section2").show();
        });

        $("#btnBack3").click(function() {
            $("#register-section4").hide();
            $("#register-section3").show();
        });

        $("#btnBack4 ").click(function() {
            $("#register-section5").hide();
            $("#register-section3").show();
        });

        $("#openSimpanan").click(function() {
            $("#register-section3").hide();
            $("#register-section5").show();
        });

        $("#skipSimpanan").click(function(event) {
            event.preventDefault();
            Swal.fire({
            title: 'Lewati Buka Simpanan?',
            text: 'Simpanan pokok harus dibayarkan saat pertama kali menjadi anggota UBSP. Anda dapat melewati ini, namun ingat bahwa akun Anda belum bisa diaktifkan selama belum membayar simpanan pokok.',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Ya, lewati',
            denyButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#register-section3").hide();
                    $("#register-section4").show();
                }
            });
        });

        $(function(){
            $("#nominal").keyup(function(e){
                $(this).val(format($(this).val()));
            });
        });

        var format = function(num) {
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
                }
            }
            formatted = output.reverse().join("");
            return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };
    });
</script>

</html>
