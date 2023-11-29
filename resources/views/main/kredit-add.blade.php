@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Pengajuan Kredit
@endsection

@section('vendorCSS')
<link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
{{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
@endsection

@section('content')

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Pengajuan Kredit</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center flex-column">
                                <h3 class="mt-3 text-center">Simulasi Kredit</h3>
                                <form class="form form-vertical" id="formSimulasiKredit">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="tenor">Lama Pinjaman (Bulan)</label>
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" id="tenor" name="tenor" id="tenor">
                                                                <option>-- Pilih Lama Pinjaman --</option>
                                                                <option>1</option>
                                                                <option>3</option>
                                                                <option>6</option>
                                                                <option>12</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="nominal">Jumlah Pinjaman</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Nominal" id="nominal" name="nominal"/>
                                                        <div class="form-control-icon"><i class="bi bi-cash"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="rates">Bunga Per Tahun</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Bunga" id="rates" value="0,5" name="rates" disabled />
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-12 d-flex justify-content-center">
                                                <button class="btn btn-primary me-1 mb-1 simulasi">Hitung</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('profile-update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div id="register-section1" class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="fname">Nama Depan</label>
                                                    <input type="text" id="fname" class="form-control" placeholder="Nama Depan" name="fname" value="{{$user->fname}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="lname">Nama Belakang</label>
                                                    <input type="text" id="lname" class="form-control" placeholder="Nama Belakang" name="lname" value="{{$user->lname}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="birthplace">Tempat Lahir</label>
                                                    <input type="text" id="birthplace" class="form-control" placeholder="Tempat Lahir" name="birthdate" value="{{$user->birthplace}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="birthdate">Tanggal Lahir</label>
                                                    <input type="date" class="form-control mb-3" name="birthdate" value="{{$user->birthdate}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="address">Alamat Tinggal</label>
                                                    <input type="text" id="address" class="form-control" name="address" placeholder="Alamat Tinggal" value="{{$user->address}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="work-address">Alamat Kerja</label>
                                                    <input type="text" id="work-address" class="form-control" name="workAddress" placeholder="Alamat Kerja" value="{{$user->workAddress}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="{{$user->email}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone-number">No Hp</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                                        <input type="text" class="form-control" placeholder="No Hp" aria-label="No Hp" aria-describedby="basic-addon1" name="phone" value="{{$user->phone}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="mothername">Nama Ibu Kandung</label>
                                                    <input type="text" class="form-control" id="mothername" name="mothername" placeholder="Nama Ibu Kandung" value="{{$user->mothername}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="ktp">Foto KTP</label>
                                                    <img src="/{{$user->ktp}}" alt="" class="img-preview img-fluid mb-3 mt-3 col-4 d-block"> 
                                                    <input type="file" class="image-exif-filepond" name="ktp">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="kk">Foto Kartu Keluarga</label>
                                                    <img src="/{{$user->kk}}" alt="" class="img-preview img-fluid mb-3 mt-3 col-4 d-block"> 
                                                    <input type="file" class="image-preview-filepond" name="kk">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block shadow-lg mt-3">SIMPAN</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
    </div>
</div>
@endsection

@section('vendorJS')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="/main/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script src="/main/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="/main/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script
        src="/main/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="/main/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
    <script src="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="/main/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="/main/assets/extensions/filepond/filepond.js"></script>
    <script src="/main/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="/main/assets/static/js/pages/filepond.js"></script>

    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    <script>
        $(document).ready(function(){
            $('.show_confirm').click(function(event) {
                event.preventDefault();

                var form =  $(this).closest("form");

                Swal.fire({
                    title: 'Ajukan kredit?',
                    text: "Setiap pengajuan data kredit akan direview oleh admin terlebih dahulu.",
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, ajukan',
                    denyButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $('.simulasi').click(function(event) {
                event.preventDefault();

                var formData = $('#formSimulasiKredit').serialize();

                // var tenor = $("#tenor").val();
                // var nominal = $("#nominal").val();

                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    url: "{{ route('simulasi.kredit') }}",
                    // data: language_selected,
                    data: formData
                })
                .done(function(data){
                    console.log('done');
                })
                .fail(function() {
                    alert( formData );
                });

                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });

                // $.ajax({
                //     headers: {
                //     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //     },
                //     type: 'POST',
                //     url: "{{ route('simulasi.kredit') }}",
                //     data:{tenor:tenor, nominal:nominal},
                //     success: function (data) {
                //         console.log(data);
                //     },
                //     error: function (data) {
                //         console.error('Error:', data);
                //     }
                // });
            });  

            // $(function(){
            //     $("#nominal").keyup(function(e){
            //         $(this).val(format($(this).val()));
            //     });
            // });

            // var format = function(num) {
            //     var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            //     if(str.indexOf(".") > 0) {
            //         parts = str.split(".");
            //         str = parts[0];
            //     }
            //     str = str.split("").reverse();
            //     for(var j = 0, len = str.length; j < len; j++) {
            //         if(str[j] != ",") {
            //         output.push(str[j]);
            //         if(i%3 == 0 && j < (len - 1)) {
            //             output.push(",");
            //         }
            //         i++;
            //         }
            //     }
            //     formatted = output.reverse().join("");
            //     return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
            // };


        });
    </script>
@endsection