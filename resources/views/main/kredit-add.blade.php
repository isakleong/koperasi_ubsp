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
@include('sweetalert::alert')
    <div class="content-wrapper container">
        <div class="page-heading">
            <h3>Pengajuan Kredit</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Kredit</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{route('store.kredit')}}" class="form form-vertical" method="post">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Lama Angsuran</label>
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" id="tenor" name="tenor">
                                                                <option>-- Pilih Lama Angsuran --</option>
                                                                <option>1 bulan</option>
                                                                <option>3 bulan</option>
                                                                <option>6 bulan</option>
                                                                <option>1 tahun</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="nominal">Nominal</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Nominal" id="nominal" name="nominal" value="{{old('nominal')}}" />
                                                        <div class="form-control-icon"><i class="bi bi-cash"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="rates">Bunga</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Bunga" id="rates" value="0,5" name="rates" value="{{old('rates')}}" disabled />
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-outline-primary simulasi mt-3" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Simulasi Angsuran</button>
                                                        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Simulasi Angsuran</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                                                                    </div>
                                                                    <div class="modal-body text-start">
                                                                        <h6>Total Kredit</h6>
                                                                        <p id="simulasiTotalKredit">Rp 0</p>
                                                                        <h6>Suku Bunga</h6>
                                                                        <p id="simulasiBunga">0,5%</p>
                                                                        <h6>Lama Angsuran (dalam bulan)</h6>
                                                                        <p id="simulasiTenor">0</p>
                                                                        <h6>Angsuran Pokok (per bulan)</h6>
                                                                        <p id="simulasiAngsuranPokok">Rp 0</p>
                                                                        <h6>Bunga Kredit (per bulan)</h6>
                                                                        <p id="simulasiBungaPerBulan">Rp 0</p>
                                                                        <h6>Total bunga yang harus dibayar</h6>
                                                                        <p id="simulasiTotalBungaPerBulan">Rp 0</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="notes">Tujuan Kredit</label>
                                                    <div class="position-relative">
                                                        <textarea class="form-control" id="notes" rows="3" name="notes" value="{{old('notes')}}"></textarea>
                                                        <div class="form-control-icon"><i class="bi bi-info-square-fill"></i></div>
                                                    </div>
                                                    @error('notes')
                                                        <p style="color: red">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1 show_confirm">Ajukan</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
@endsection

@section('vendorJS')
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
            $("#simulasiTenor").text("0");

            //validate lama angsuran
            var lamaAngsuran = $('#tenor').val();
            var tenor = 0;
            var arrTenor = lamaAngsuran.split(' ');
            if (arrTenor.length == 2) {
                if (arrTenor[1].toLowerCase() == 'bulan') {
                    tenor = arrTenor[0];
                    $("#simulasiTenor").text(tenor);
                } else if (arrTenor[1].toLowerCase() == 'tahun') {
                    tenor = arrTenor[0] * 12;
                    $("#simulasiTenor").text(tenor);
                } else {
                    //invalid
                    alert('Lama Angsuran tidak valid');
                }
            } else {
                //invalid
                alert('Lama Angsuran belum dipilih');
            }

            //validate total pinjaman
            var nominalData = $("#nominal").val();
            var totalPinjaman = 0;
            if(nominalData == "") {
                alert("Nominal belum diisi")
            } else {
                totalPinjaman = nominalData;
                $("#simulasiTotalKredit").text("Rp "+totalPinjaman);
            }

            //hitung angsuran pokok per bulan
            var angsuranPokok = ((totalPinjaman.replace(/,/g, '')) / tenor);
            $("#simulasiAngsuranPokok").text("Rp "+format(Math.ceil(angsuranPokok)));

            //hitung bunga per bulan
            var bungaPerBulan = ((totalPinjaman.replace(/,/g, '')) * 0.5 / 100) / 12;
            $("#simulasiBungaPerBulan").text("Rp "+format(Math.ceil(bungaPerBulan)));

            //hitung total bunga yang harus dibayar
            var totalBungaPerBulan = Math.ceil(bungaPerBulan) * tenor;
            $("#simulasiTotalBungaPerBulan").text("Rp "+format(Math.ceil(totalBungaPerBulan)));
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
    </script>
@endsection
