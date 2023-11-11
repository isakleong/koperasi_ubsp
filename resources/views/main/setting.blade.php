@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Pengajuan Kredit
@endsection

@section('vendorCSS')
<link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
@endsection

@section('content')

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Pengaturan</h3>
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
    
                                <h3 class="mt-3">Regan Reinaldo</h3>
                                <p class="text-small">Anggota</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="index.html" method="POST">
                                <div id="register-section1" class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="fname">Nama Depan</label>
                                                    <input type="text" id="fname" class="form-control"
                                                        placeholder="Nama Depan" name="fname">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="lname">Nama Belakang</label>
                                                    <input type="text" id="lname" class="form-control"
                                                        placeholder="Nama Belakang" name="lname">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="birthplace">Tempat Lahir</label>
                                                    <input type="text" id="birthplace" class="form-control"
                                                        placeholder="Tempat Lahir" name="birthdate">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="birthdate">Tanggal Lahir</label>
                                                    <input type="date" class="form-control mb-3" name="birthdate">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="address">Alamat Tinggal</label>
                                                    <input type="text" id="address" class="form-control"
                                                        name="address" placeholder="Alamat Tinggal">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="work-address">Alamat Kerja</label>
                                                    <input type="email" id="work-address" class="form-control"
                                                        name="work-address" placeholder="Alamat Kerja">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control"
                                                        name="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone-number">No Hp</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                                        <input type="text" class="form-control" placeholder="No Hp"
                                                            aria-label="No Hp" aria-describedby="basic-addon1" name="phone-number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="ktp">Foto KTP</label>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="kk">Foto KK</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="confirm-password">Konfirmasi Password</label>
                                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Konfirmasi Password">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="mothername">Nama Ibu Kandung</label>
                                                    <input type="text" class="form-control" id="mothername" name="mothername" placeholder="Nama Ibu Kandung">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="ktp">Foto KTP</label>
                                                    <input type="file" class="image-exif-filepond" name="ktp">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="kk">Foto Kartu Keluarga</label>
                                                    <input type="file" class="image-preview-filepond" name="kk">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </form>
                            {{-- <form action="#" method="get">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="John Doe">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" value="john.doe@example.net">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" value="083xxxxxxxxx">
                                </div>
                                <div class="form-group">
                                    <label for="birthday" class="form-label">Birthday</label>
                                    <input type="date" name="birthday" id="birthday" class="form-control" placeholder="Your Birthday">
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@section('vendorJS')
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
    
@endsection
    
@endsection