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
                                                            <select class="form-select" id="tenor" name="tenor">
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
                                                        <input type="text" class="form-control" placeholder="Bunga" id="rates" value="0,5" name="rates" />
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary me-1 mb-1 simulasi">Hitung Simulasi</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Kredit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.kredit') }}" method="POST">
                                @csrf
                                <div id="register-section1" class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Lama Pinjaman (Bulan)</label>
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" id="tenor" name="tenor">
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
                                                    <label for="nominal">Nominal</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Nominal" id="nominal" name="nominal" value="{{old('nominal')}}" />
                                                        <div class="form-control-icon"><i class="bi bi-cash"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="rates">Bunga Per Tahun</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Bunga" id="rates" value="0,5" name="rates" value="{{old('rates')}}" readonly />
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-percent"></i>
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

            $('#formSimulasiKredit').on('submit',function(e){
                e.preventDefault();
                
                var formData = $('#formSimulasiKredit').serialize();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "/simulasi/kredit",
                    type:"POST",
                    data: formData,
                    // data:{
                    //     "_token": "{{ csrf_token() }}",
                    //     tenor:tenor,
                    //     nominal:nominal,
                    // },
                    success:function(response){
                        console.log(response);
                    },
                    error: function(response) {
                        alert('error');
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