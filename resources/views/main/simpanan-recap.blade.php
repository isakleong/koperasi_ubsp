@extends('layout.main')

@section('title')
    Sistem Akuntansi UBSP - Rekap Tabungan
@endsection

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="/main/assets/compiled/css/table-datatable.css">
    <link rel="stylesheet" href="/main/assets/extensions/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
@include('sweetalert::alert')
    <div class="content-wrapper container">
        {{-- <div class="page-heading">
            <h3>Rekap Simpanan</h3>
            <input type="date" class="form-control flatpickr-range mb-3" placeholder="Pilih periode tanggal...">
        </div> --}}

        <div class="page-heading">
            <h3>Rekap Simpanan</h3>
            <form method="post" action="{{ route('filter.recap.simpanan') }}">
                @csrf
                <label for="startDate">Tanggal Awal :</label>
                {{-- <input type="date" name="startDate" id="startDate" required> --}}
                <input placeholder="Pilih tanggal awal" type="text" id="startDate" class="form-control datepicker mb-3" name="startDate" required>
                
                <label for="endDate">Tanggal Akhir :</label>
                {{-- <input type="date" name="endDate" id="endDate" required> --}}
                <input placeholder="Pilih tanggal akhir" type="text" id="endDate" class="form-control datepicker mb-3" name="endDate" required>
            
                <button type="submit" class="btn btn-primary me-1 mb-1">Cari</button>
            </form>
        </div>

        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                            {{-- <table class="table table-striped"> --}}
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis Simpanan</th>
                                        <th>Nominal</th>
                                        <th>Keterangan</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Status</th>
                                        <th>Tanggal Persetujuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactionData as $item)
                                        <tr>
                                            <td>{{$item->transactionDate}}</td>
                                            <td>{{ucfirst($item->kind)}}</td>
                                            <td>{{$item->total}}</td>
                                            @if ($item->notes != null)
                                                <td>{{$item->notes}}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @if ($item->method == 1)
                                                <td>Transfer</td>   
                                            @else
                                                <td>Cash</td>
                                            @endif

                                            @if ($item->method == 1)
                                                <td><img src="/{{$item->image}}" alt="" class="img-fluid" width="100"></td>
                                            @else
                                                <td>-</td>
                                            @endif

                                            

                                            @if ($item->status == 1)
                                                <td>
                                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                                </td>
                                            @elseif ($item->status == 2)
                                                <td>
                                                    <span class="badge bg-success">Disetujui</span>
                                                </td>
                                            @elseif ($item->status == 3)
                                                <td>
                                                    <span class="badge bg-danger">Ditolak</span>
                                                </td>
                                            @endif
                                            <td>{{$item->approvedOn}}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $transaction->links() }} --}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('vendorJS')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script src="/main/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="/main/assets/static/js/pages/simple-datatables.js"></script>

<script src="/main/assets/extensions/flatpickr/flatpickr.min.js"></script>
<script src="/main/assets/static/js/pages/date-picker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="/vendor/sweetalert/sweetalert.all.js"></script>

<script type="text/javascript">
    $(function(){
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
@endsection
