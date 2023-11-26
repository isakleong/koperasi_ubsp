@extends('layout.main')

@section('title') Sistem Akuntansi UBSP - Pengajuan Simpanan @endsection

@section('vendorCSS')
<link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
@endsection


@section('content')
<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Pengajuan Simpanan</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Simpanan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{route('store.simpanan')}}" class="form form-vertical" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Jenis Simpanan</label>
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="basicSelect" name="kind">
                                                            <option>-- Pilih Simpanan --</option>
                                                          <option>Simpanan Wajib</option>
                                                          <option>Simpanan Sukarela</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                @error('kind')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="nominal">Nominal</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Nominal" id="nominal" name="nominal" />
                                                    <div class="form-control-icon"><i class="bi bi-cash"></i></div>
                                                </div>
                                                @error('nominal')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="notes">Keterangan (opsional)</label>
                                                <div class="position-relative">
                                                    <textarea class="form-control" id="notes" rows="3" name="notes"></textarea>
                                                    <div class="form-control-icon"><i class="bi bi-info-square-fill"></i></div>
                                                </div>
                                                @error('notes')
                                                    <p style="color: red">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="method">Jenis Pembayaran</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="method" id="cash" value="cash" checked>
                                                    <label class="form-check-label" for="cash">
                                                        Cash
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="method" id="transfer" value="transfer">
                                                    <label class="form-check-label" for="transfer">
                                                        Transfer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" id="bukti-trf" style="display: none;">
                                            <div class="form-group has-icon-left">
                                                <label for="mobile-id-icon">Bukti Pembayaran</label>
                                                <div class="position-relative">
                                                    <input type="file" class="image-exif-filepond" name="image" accept="image/*"/>
                                                </div>
                                            </div>
                                            @error('image')
                                                <p style="color: red">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Ajukan</button>
                                            <button type="reset"class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
<script src="/main/assets/masking/dist/jquery.mask.js"></script>
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

<script>
    $(document).ready(function () {
        $('input[type="radio"]').on('change', function () {
            // Get the selected value
            var selectedValue = $('input[name="method"]:checked').val();
            
            if(selectedValue == 'transfer') {
                $('#bukti-trf').show();
            } else {
                $('#bukti-trf').hide();
            }
        });

        $('select').on('change', function() {
            var data = $(this).val();
            if(data.toLowerCase() == "simpanan wajib") {
                $("#nominal").val("50,000");
                $("#nominal").prop("readonly", true);
            } else if(data.toLowerCase() == "simpanan sukarela") {
                $("#nominal").val("");
                $("#nominal").prop("readonly", false);
            } else {
                $("#nominal").val("");
                $("#nominal").prop("readonly", false);
            }
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
@endsection