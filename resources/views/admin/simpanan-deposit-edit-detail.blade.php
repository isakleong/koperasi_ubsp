@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Beranda Simpanan / Review Pengajuan</span> / Edit Pengajuan
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Pengajuan Simpanan</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.account_category.update', $transaction->docId) }}" method="post">
                            @csrf
                            @method('PUT')

                            @if ($transaction->kind != 'pokok')
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="kind">Jenis Simpanan</label>
                                        <select class="choices form-select" id="kind" name="kind">
                                            <option></option>
                                            <option value="wajib"
                                                {{ (old('kind') ?: $transaction->kind) == 'wajib' ? 'selected' : '' }}>
                                                Simpanan Wajib</option>
                                            <option value="sukarela"
                                                {{ (old('kind') ?: $transaction->kind) == 'sukarela' ? 'selected' : '' }}>
                                                Simpanan Sukarela</option>
                                        </select>
                                    </div>
                                    @error('kind')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="memberId">Anggota</label>
                                    <select class="choices form-select" id="memberId" name="memberId">
                                        <option></option>
                                        @foreach ($member as $item)
                                            <option value="{{ $item->memberId }}"
                                                {{ old('memberId') == $item->memberId || $transaction->userAccount->memberId == $item->memberId ? 'selected' : '' }}>
                                                {{ $item->fname }} {{ $item->lname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('memberId')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nominal" name="nominal"
                                        placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('nominal', $transaction->total) }}" />
                                    <label for="nominal">Nominal</label>
                                </div>
                                @error('nominal')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="notes">Keterangan (Opsional)</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes" placeholder=""
                                        required>{{ old('notes', $transaction->notes) }}</textarea>
                                </div>
                                @error('notes')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md mb-3">
                                <label class="">Jenis Pembayaran</small>
                                    <div class="form-check mt-3 mb-2">
                                        <input name="method" class="form-check-input" type="radio" value="cash"
                                            id="cash"
                                            {{ old('method') == 'cash' || $transaction->method == '2' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="cash"> Cash </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="method" class="form-check-input" type="radio" value="transfer"
                                            id="transfer"
                                            {{ old('method') == 'transfer' || $transaction->method == '1' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="transfer"> Transfer </label>
                                    </div>
                                    @error('method')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    @if ($transaction->image != '')
                                        <img style="width: 220px;" src="/{{ $transaction->image }}" alt=""
                                            class="img-fluid mb-3 mt-3 col-4 d-block">
                                    @else
                                        <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                    @endif
                                </div>
                                @error('image')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-3" id="bukti-trf" style="display: none;">
                                <div class="form-group has-icon-left">
                                    <label for="image">Bukti Pembayaran</label>
                                    <div class="position-relative">
                                        <input type="file" class="image-exif-filepond" name="image"
                                            accept="image/*" />
                                    </div>
                                </div>
                                @error('image')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-block btn-lg btn-primary show_confirm">Update Data</button>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-block btn-lg btn-primary show_confirm">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('vendorJS')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/main/assets/masking/dist/jquery.mask.js"></script>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    <script>
        $(document).ready(function() {
            $("#kind").select2({
                placeholder: 'Pilih Jenis Simpanan',
                allowClear: true,
                theme: 'bootstrap-5',
                width: '100%',
            });

            $("#memberId").select2({
                placeholder: 'Pilih Anggota',
                allowClear: true,
                theme: 'bootstrap-5',
                width: '100%',
            });

            var selectedValue = $('input[name="method"]:checked').val();

            if (selectedValue == 'transfer') {
                $('#bukti-trf').show();
            } else {
                $('#bukti-trf').hide();
            }

            $('.show_confirm').click(function(event) {
                event.preventDefault();

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Simpan Data?',
                    text: '',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, simpan',
                    denyButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $('input[type="radio"]').on('change', function() {
                // Get the selected value
                var selectedValue = $('input[name="method"]:checked').val();

                if (selectedValue == 'transfer') {
                    $('#bukti-trf').show();
                } else {
                    $('#bukti-trf').hide();
                }
            });

            $('#kind').on('change', function() {
                var data = $(this).val();
                if (data.toLowerCase() == "wajib") {
                    $("#nominal").val("50,000");
                    $("#nominal").prop("readonly", true);
                } else if (data.toLowerCase() == "sukarela") {
                    $("#nominal").val("");
                    $("#nominal").prop("readonly", false);
                } else {
                    $("#nominal").val("");
                    $("#nominal").prop("readonly", false);
                }
            });

            $(function() {
                $("#nominal").keyup(function(e) {
                    $(this).val(format($(this).val()));
                });
            });

            var format = function(num) {
                var str = num.toString().replace("", ""),
                    parts = false,
                    output = [],
                    i = 1,
                    formatted = null;
                if (str.indexOf(".") > 0) {
                    parts = str.split(".");
                    str = parts[0];
                }
                str = str.split("").reverse();
                for (var j = 0, len = str.length; j < len; j++) {
                    if (str[j] != ",") {
                        output.push(str[j]);
                        if (i % 3 == 0 && j < (len - 1)) {
                            output.push(",");
                        }
                        i++;
                    }
                }
                formatted = output.reverse().join("");
                return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
            };
        });
    </script>
@endsection
