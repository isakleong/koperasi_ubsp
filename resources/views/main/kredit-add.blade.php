@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Pengajuan Kredit
@endsection

@section('vendorCSS')
<link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
<link rel="stylesheet" href="/main/assets/compiled/css/kredit.css">

<style>
    h6.labelResultSimulasi {
        color: #000000;
    }
</style>

@endsection

@section('content')
@include('sweetalert::alert')
<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Pengajuan Kredit</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        @if ($cntActiveLoan == 0)
                            <div class="card-header">
                                <h4>Data Pengajuan Kredit</h4>
                            </div>
                        @endif
                        <div class="card-body">
                            @if ($cntActiveLoan > 0)
                                <div class="col-md-12 col-12 text-center">
                                    <img src="/main/assets/compiled/png/not_allowed.jpg" width="50%" alt="Logo">
                                </div>
                                <h6 class="text-center mt-3">Mohon maaf, Anda belum dapat mengajukan kredit karena masih ada kredit yang belum disetujui atau kredit yang belum lunas.</h6>
                            @else
                                <form action="{{route('store.kredit')}}" class="form form-vertical" id="formSimulasiKredit" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="tenor">Lama Pinjaman (Bulan)</label>
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" id="tenor" name="tenor">
                                                                <option>-- Pilih Lama Pinjaman --</option>
                                                                <option>3 bulan</option>
                                                                <option>6 bulan</option>
                                                                <option>12 bulan</option>
                                                                <option>24 bulan</option>
                                                                <option>36 bulan</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="nominal">Nominal</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Nominal" id="nominal" name="nominal"/>
                                                        <div class="form-control-icon"><i class="bi bi-cash"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="rates">Bunga Per Tahun</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Bunga" id="rates" value="0.5" name="rates" readonly />
                                                        {{-- <div class="form-control-icon">
                                                            <i class="bi bi-percent"></i>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center">
                                                <button id="hitungSimulasi" type="button" class="btn btn-primary mb-3 mt-3 simulasi" data-bs-toggle="modal" data-bs-target="#hasilSimulasi">Hitung Simulasi</button>
                                            </div>
                                            
                                            <div class="modal fade" id="hasilSimulasi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Simulasi Kredit</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6 class="labelResultSimulasi">Total Kredit</h6>
                                                            <p id="hasilTotalKredit">Rp 0</p>

                                                            <h6 class="labelResultSimulasi">Suku Bunga (Per Tahun)</h6>
                                                            <p id="hasilRates">0%</p>

                                                            <h6 class="labelResultSimulasi">Lama Angsuran</h6>
                                                            <p id="hasilTenor">0</p>

                                                            <div class="divider">
                                                                <div class="divider-text" style="font-weight: bold; color:#000000;">Rincian Angsuran (Per Bulan)</div>
                                                            </div>

                                                            <h6 class="labelResultSimulasi">Angsuran Pokok</h6>
                                                            <p id="hasilAngsuranPokok">Rp 0</p>

                                                            <h6 class="labelResultSimulasi">Angsuran Bunga</h6>
                                                            <p id="hasilBungaPerBulan">Rp 0</p>

                                                            <h6 class="labelResultSimulasi">Total Angsuran Yang Dibayar</h6>
                                                            <p id="hasilTotalAngsuran">Rp 0</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="notes">Tujuan Pinjaman</label>
                                                    <div class="position-relative">
                                                        <textarea class="form-control" id="notes" rows="3" name="notes" value="{{old('notes')}}"></textarea>
                                                        <div class="form-control-icon"><i class="bi bi-info-square-fill"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1 show_confirm">Ajukan</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('vendorJS')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
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

            function handleSimulasiResult(data) {
                var arr = data.split('|');

                $("#hasilTotalKredit").text(arr[0]);
                $("#hasilRates").text(arr[1]);
                $("#hasilTenor").text(arr[2]);

                $("#hasilAngsuranPokok").text("Rp " + format(arr[3]));
                $("#hasilBungaPerBulan").text("Rp " + format(arr[4]));
                $("#hasilTotalAngsuran").text("Rp " + format(arr[5]));
            }

            $('#hitungSimulasi').on('click',function(e){
                e.preventDefault();
                
                var formData = $('#formSimulasiKredit').serialize();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "/simulasi/kredit",
                    type:"POST",
                    data: formData,
                    success: handleSimulasiResult,
                    // success:function(response){
                    // },
                    error: function(response) {
                        // alert('error');
                    },
                });
            });

            $(function(){
                // $("#nominal").keyup(function(e){
                //     $(this).val(format($(this).val()));
                // });

                new AutoNumeric('#nominal', {
                    currencySymbol: "Rp ",
                    // decimalCharacter: '.',
                    decimalPlaces:0,
                    digitGroupSeparator: ",",
                });
                /*new AutoNumeric('#interest_rate', 'percentageEU2dec');*/
                new AutoNumeric('#rates', {
                    decimalCharacter: ".",
                    digitGroupSeparator: ",",
                    decimalCharacterAlternative:',',
                    currencySymbol: '%',
                    currencySymbolPlacement: AutoNumeric.options.currencySymbolPlacement.suffix,
                    maximumValue: '100.00',
                    minimumValue:'0.00'
                });
                
                // $('#frmloan').submit(function(event) {
                //     event.preventDefault();
                //     var data = $(this).serialize();
                //     var href = $(this).attr('action');
                //     $.post(href, data, function(response) {
                //         $('#card-result').empty().html(response).show();
                //         $('#card-form').hide();
                //         $('html,body').animate({scrollTop: (parseInt($('section.main-section').offset().top) - $('div.header').outerHeight()) + 'px' }, 'fast');

                //         $('#btnrecalculate').click(function(event){
                //             $('#card-result').hide();
                //             $('#card-form').show();
                //             $('html,body').animate({scrollTop: (parseInt($('section.main-section').offset().top) - $('div.header').outerHeight()) + 'px' }, 'fast');
                //         });
                //     });
                // });
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