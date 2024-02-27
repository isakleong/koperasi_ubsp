<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ public_path('bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <title>Laporan Anggota UBSP</title>

    {{-- <style>
        @page {
            margin: 120px 30px;
        }
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            color: gray;
            text-align: center;
        }
        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            color: gray;
            text-align: center;
            line-height: 10px;
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }
        main {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }
        table {
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .page-break {
            page-break-after: always;
        }
    </style> --}}

</head>
<body>
    <div class="container">
        <table class="table table-striped table-bordered table-sm mt-3">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Alamat</th>
                <th scope="col">Alamat Kerja</th>
                <th scope="col">Email</th>
                <th scope="col">No HP</th>
                <th scope="col">Ibu Kandung</th>
                <th scope="col">Tanggal Gabung</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($dataReport as $item)
                    <tr>
                        @php
                            $dateTime = new DateTime($item->birthdate);
                            $formattedDate = $dateTime->format('d-m-Y');
                        @endphp
                        <th scope="row">{{$i++}}</th>
                        <td>{{$item->fname}} {{$item->lname}}</td>
                        <td>{{$item->birthplace}}</td>
                        <td>{{$formattedDate}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->workAddress}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->mothername}}</td>
                        <td>{{$item->mothername}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
    </div>
</body>
</html>