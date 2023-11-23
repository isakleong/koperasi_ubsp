@extends('layout.main')

@section('title') Sistem Akuntansi UBSP - Pengajuan Tabungan @endsection

@section('vendorCSS')
<link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
@endsection


@section('content')
<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Pengajuan Tabungan</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title">Vertical Form with Icons</h4>
                    </div> --}}
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Jenis Tabungan</label>
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="basicSelect">
                                                            <option>-- Pilih Simpanan --</option>
                                                            <option>Pokok</option>
                                                          <option>Wajib</option>
                                                          <option>Sukarela</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="email-id-icon">Nominal</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control"
                                                        placeholder="Nominal" id="email-id-icon" />
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-cash-coin"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="mobile-id-icon">Keterangan</label>
                                                <div class="position-relative">
                                                    <textarea
                                                        class="form-control"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3"
                                                    ></textarea>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-info-square-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="mobile-id-icon">Jenis Pembayaran</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipe-pembayaran" id="tipe-cash" value="cash" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Cash
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipe-pembayaran" id="tipe-transfer" value="transfer">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Transfer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" id="bukti-trf" style="display: none;">
                                            <div class="form-group has-icon-left">
                                                <label for="mobile-id-icon">Bukti Pembayaran</label>
                                                <div class="position-relative">
                                                    <input type="file" class="image-exif-filepond" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                                Simpan
                                            </button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">
                                                Reset
                                            </button>
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
            var selectedValue = $('input[name="tipe-pembayaran"]:checked').val();
            
            if(selectedValue == 'transfer') {
                $('#bukti-trf').show();
            } else {
                $('#bukti-trf').hide();
            }
        });
    });
</script>
@endsection
