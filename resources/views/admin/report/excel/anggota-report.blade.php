<table>
    <thead>
        <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Alamat Kerja</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Ibu Kandung</th>
        <th>Tanggal Gabung</th>
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
                <th>{{$i++}}</th>
                <td>{{$item->fname}} {{$item->lname}}</td>
                <td>{{$item->birthplace}}</td>
                <td>{{$formattedDate}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->workAddress}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->mothername}}</td>
                @php
                    $formattedDate = "";
                    if($item->registDate != null) {
                        $dateTime = new DateTime($item->registDate);
                        $formattedDate = $dateTime->format('d-m-Y');
                    }
                @endphp
                <td>{{$formattedDate}}</td>
            </tr>
        @endforeach
    </tbody>
</table> 