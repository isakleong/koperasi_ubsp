@foreach ($transaction as $item)
    <table>
        <thead>
            <tr>
                <th>No Akun</th>
                <th>Nama Akun</th>
                <th>No Anggota</th>
                <th>Nama Anggota</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item->debitDetail as $detail)
                <tr>
                    <td>{{ $detail->account->accountNo }}</td>
                    <td>{{ $detail->account->name }}</td>
                    <td>{{ $item->memberId }}</td>
                    <td>{{ $item->memberId }}</td>
                    <td class="text-end">Rp {{ number_format($detail->total, 2, '.', ',') }}</td>
                    <td></td>
                </tr>
            @endforeach
            @foreach ($item->creditDetail as $detail)
                <tr>
                    <td>{{ $detail->account->accountNo }}</td>
                    <td>{{ $detail->account->name }}</td>
                    <td>{{ $item->memberId }}</td>
                    <td>{{ $item->memberId }}</td>
                    <td></td>
                    <td class="text-end">Rp {{ number_format($detail->total, 2, '.', ',') }}</td>
                </tr>
            @endforeach
            <tr class>
                <td colspan="4"><span><strong>Sub Total</strong></span></td>
                <td ><span><strong>Rp {{ number_format($item->totalDebit, 2, '.', ',') }}</strong></span></td>
                <td><span><strong>Rp {{ number_format($item->totalKredit, 2, '.', ',') }}</strong></span></td>
            </tr>
        </tbody>
    </table>
@endforeach