@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Pengajuan Kredit
@endsection

@section('vendorCSS')
<link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
<link rel="stylesheet" href="/main/assets/compiled/css/kredit.css">
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

                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pengajuan Kredit</h4>
                            <p>Silahkan pilih menu Simulasi Kredit atau Pengajuan Kredit</p>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="creditForm">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="cardSimulasi">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cardSimulasiCollapse" aria-expanded="false" aria-controls="cardSimulasiCollapse">
                                            Simulasi Kredit
                                        </button>
                                    </h2>
                                    <div id="cardSimulasiCollapse" class="accordion-collapse collapse" aria-labelledby="cardSimulasi" data-bs-parent="#creditForm">
                                        <div class="accordion-body">
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
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="cardCredit">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cardCreditCollapse" aria-expanded="false" aria-controls="cardCreditCollapse">
                                            Pengajuan Kredit
                                        </button>
                                    </h2>
                                    <div id="cardCreditCollapse" class="accordion-collapse collapse" aria-labelledby="cardCredit" data-bs-parent="#creditForm">
                                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4" hidden>
                    <div class="loan-simulation-res">
                        <div class="sum">
                            <div class="sum-left">
                                <p>Angsuran Cicilan per Bulan (Rp)</p>
                                <p id="installment" class="pinstallment">3.383.334,00</p>
                            </div>
                            <div class="sum-right">
                                <h2>TOTAL ANGSURAN PER BULAN</h2>
                                <table class="installment-sum" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>Nominal (Rp)</td>
                                        <td>120.000.000,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jangka Waktu (Bulan)</td>
                                        <td>36 Bulan</td>
                                    </tr>
                                    <tr>
                                        <td>Suku bunga per Tahun</td>
                                        <td>0.50%</td>
                                    </tr>
                                    <tr>
                                        <td>Tipe Bunga yang Digunakan </td>
                                        <td>Flat</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="res-table">
                            <table class="rate-table">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Angsuran Bunga</th>
                                        <th>Angsuran Pokok</th>
                                        <th>Total Angsuran</th>
                                        <th>Sisa Pinjaman</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Jan 2023</td>
                                        <td>0,00</td>
                                        <td>0,00</td>
                                        <td>0,00</td>
                                        <td>120.000.000,00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>116.666.666,00</td>
                                    </tr>
                                    <tr>
                                        <td>Mar 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>113.333.332,00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>109.999.998,00</td>
                                    </tr>
                                    <tr>
                                        <td>May 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>106.666.664,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>103.333.330,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>99.999.996,00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>96.666.662,00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>93.333.328,00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>89.999.994,00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>86.666.660,00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 2023</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>83.333.326,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jan 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>79.999.992,00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>76.666.658,00</td>
                                    </tr>
                                    <tr>
                                        <td>Mar 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>73.333.324,00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>69.999.990,00</td>
                                    </tr>
                                    <tr>
                                        <td>May 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>66.666.656,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>63.333.322,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>59.999.988,00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>56.666.654,00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>53.333.320,00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>49.999.986,00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>46.666.652,00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 2024</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>43.333.318,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jan 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>39.999.984,00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>36.666.650,00</td>
                                    </tr>
                                    <tr>
                                        <td>Mar 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>33.333.316,00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>29.999.982,00</td>
                                    </tr>
                                    <tr>
                                        <td>May 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>26.666.648,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>23.333.314,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>19.999.980,00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>16.666.646,00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>13.333.312,00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>9.999.978,00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>6.666.644,00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 2025</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>3.333.310,00</td>
                                    </tr>
                                    <tr>
                                        <td>Jan 2026</td>
                                        <td>50.000,00</td>
                                        <td>3.333.334,00</td>
                                        <td>3.383.334,00</td>
                                        <td>-24,00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>TOTAL</th>
                                        <th>1.800.000,00</th>
                                        <th>120.000.024,00</th>
                                        <th>121.800.024,00</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="text-center">
                            <p class="fbuttons">
                                <button onclick="window.location='https://universalbpr.co.id/pinjaman/formulir';" type="button" class="button button-otr">Ajukan Sekarang</button>
                                <button id="btnrecalculate" type="button" class="button button-inverse">Hitung Ulang</button></p>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-lg-12">
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
                    // maximumValue: '100.00',
                    // minimumValue:'0.00'
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