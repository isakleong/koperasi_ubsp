@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" type="text/css" href="/vendor/datatable/css/datatables.min.css"/>
@endsection

@section('content')
    {{-- @include('sweetalert::alert') --}}
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Beranda Simpanan /</span> Review Pengajuan
        </h4>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4 bg-gradient-primary">
                    <div class="card-body">
                      <div class="row justify-content-between mb-3">
                        <div class="col-md-12 col-lg-7 col-xl-12 col-xxl-7 text-center text-lg-start text-xl-center text-xxl-start order-1  order-lg-0 order-xl-1 order-xxl-0">
                          <h4 class="card-title text-white text-nowrap">Data Per Anggota</h4>
                          <p class="card-text text-white">Rekapitulasi data simpanan anggota UBSP</p>
                        </div>
                        <span class="col-md-12 col-lg-5 col-xl-12 col-xxl-5 text-center mx-auto mx-md-0 mb-2"><img src="/administrator/assets/img/illustrations/review-simpanan.png" class="w-75 m-2"></span>
                      </div>
                      <button class="btn btn-white text-primary w-100 fw-medium shadow-sm" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Lihat Rekap</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card mb-4 bg-gradient-warning">
                    <div class="card-body">
                      <div class="row justify-content-between mb-3">
                        <div class="col-md-12 col-lg-7 col-xl-12 col-xxl-7 text-center text-lg-start text-xl-center text-xxl-start order-1  order-lg-0 order-xl-1 order-xxl-0">
                          <h4 class="card-title text-white text-nowrap">Pengajuan Simpanan</h4>
                          <p class="card-text text-white">Konfirmasi data simpanan anggota UBSP</p>
                        </div>
                        <span class="col-md-12 col-lg-5 col-xl-12 col-xxl-5 text-center mx-auto mx-md-0 mb-2"><img src="/administrator/assets/img/illustrations/approval.png" class="w-75 m-2"></span>
                      </div>
                      <button class="btn btn-white text-warning w-100 fw-medium shadow-sm" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Lihat Data</button>
                    </div>
                </div>
            </div>
            
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Pengajuan Simpanan</h5>
                        {{-- <small class="text-muted float-end">Sistem Akuntansi UBSP</small> --}}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Anggota</th>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Bayar</th>
                                    <th>Bukti</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($transaction as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->fname}} {{$item->lname}}</td>
                                        <td>{{$item->kind}}</td>
                                        <td>{{$item->total}}</td>
                                        <td>{{$item->transactionDate}}</td>
                                        @if ($item->method=='1')
                                            <td>Transfer</td>
                                        @else
                                            <td>Cash</td>
                                        @endif
                                        
                                        @if ($item->method='1')
                                            <td><img src="/{{ $item->image }}" alt="" class="img-fluid" width="100"></td>
                                        @else
                                            <td>-</td>
                                        @endif

                                        <td>{{$item->notes}}</td>

                                        @if ($item->status=='3')
                                            <td><span class="badge bg-danger">Ditolak</span></td>
                                        @elseif ($item->status=='2')
                                            <td><span class="badge bg-success">Disetujui</span></td>
                                        @else
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.detail.review.simpanan.deposit', $item->transactionDocId) }}" class="btn icon btn-sm btn-primary d-inline-block m-1" data-bs-toggle="tooltip" title="Edit"><i class="bx bxs-pencil"></i></a>
                                            <form action="{{ route('admin.detail.review.simpanan.deposit', $item->transactionDocId) }}" method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip" title="Delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn icon btn-sm btn-danger show_confirm"><i class="bx bxs-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- <form action="{{ route('admin.store.simpanan.deposit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="kind">Jenis Simpanan</label>
                                    <select class="choices form-select" id="kind" name="kind">
                                        <option></option>
                                        <option value="wajib" {{ old('kind') == 'wajib' ? 'selected' : '' }}>Simpanan Wajib</option>
                                        <option value="sukarela" {{ old('kind') == 'sukarela' ? 'selected' : '' }}>Simpanan Sukarela</option>
                                    </select>
                                </div>
                                @error('kind')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="memberId">Anggota</label>
                                    <select class="choices form-select" id="memberId" name="memberId">
                                        <option></option>
                                      @foreach ($member as $item)
                                            <option value="{{ $item->memberId }}" {{ old('memberId') == $item->memberId ? 'selected' : '' }}>{{ $item->fname }} {{ $item->lname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('memberId')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nominal" name="nominal" placeholder="" required value="{{ old('nominal') }}" />
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
                                        oninput=capitalizeName(this) required>{{ old('notes') }}</textarea>
                                </div>
                                @error('notes')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md mb-3">
                                <label class="">Jenis Pembayaran</small>
                                    <div class="form-check mt-3 mb-2">
                                        <input name="method" class="form-check-input" type="radio" value="cash"
                                            id="cash" {{ old('method') == 'cash' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="cash"> Cash </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="method" class="form-check-input" type="radio" value="transfer"
                                            id="transfer" {{ old('method') == 'transfer' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="transfer"> Transfer </label>
                                    </div>
                                    @error('method')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                            </div>

                            <div class="mb-3" id="bukti-trf" style="display: none;">
                                <div class="form-group has-icon-left">
                                    <label for="image">Bukti Pembayaran</label>
                                    <div class="position-relative">
                                        <input type="file" class="image-exif-filepond" name="simpanan"
                                            accept="image/*" />
                                    </div>
                                </div>
                                @error('simpanan')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-lg btn-primary show_confirm">Simpan</button>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('vendorJS')
    <script src="/vendor/jquery/jquery.min.js"></script>

    <script type="text/javascript" src="/vendor/datatable/js/datatables.min.js"></script>

    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable({
                responsive: true
            });

            // var table = $('#table1').DataTable({
            //     responsive: true,
            //     processing: true,
            //     serverSide: true,
            //     ajax: {
            //         url: '/admin/coba', // Replace with your Laravel API endpoint
            //         type: 'GET',
            //     },
            //     columns: [
            //         { data: 'column1', name: 'column1' },
            //         { data: 'column2', name: 'column2' },
            //         // Add more columns as needed
            //     ],
            // });

            const registerDeleteItemHandlers = () => {
                $('.show_confirm').click(function(event) {
                    var form =  $(this).closest("form");
                    var name = $(this).data("name");
                    event.preventDefault();
                    Swal.fire({
                    title: 'Delete the data?',
                    text: "If you delete this, it will be gone forever.",
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Yes, delete',
                    denyButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        } else if (result.isDenied) {
                            // Swal.fire('Changes are not saved', '', 'info');
                        }
                    });
                });
            };

            registerDeleteItemHandlers();

            $("#table1").on("draw.dt", function () {
                registerDeleteItemHandlers();
            });

            table.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
                // console.log('Details for row '+row.index()+' '+(showHide ? 'shown' : 'hidden'));
                registerDeleteItemHandlers();
            });

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

    <script>
        @if ($message = session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Formulir setoran simpanan belum diisi secara lengkap',
                // text: '{{ Session::get('errors') }}',
            })
        @endif

        @if ($message = session('warning'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ Session::get('warning') }}',
            })
        @endif
    </script>
@endsection
