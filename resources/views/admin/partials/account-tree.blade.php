<!-- resources/views/_account_row.blade.php -->

<tr>
    <td>{{ $account->accountNo }}</td>
    {{-- @if ($account->depth == 0)
        <td>{{ $account->name }}</td>
    @else
        <td style="padding-left: {{ $account->depth * 20 }}px">{{ $account->name }}</td>
    @endif --}}
    <td style="padding-left: {{ $account->depth * 20 }}px">{{ $account->name }}</td>
    <td>{{ $account->category->name }}</td>
    <!-- Add other columns as needed -->
    <td><a href="/edit/{{ $account->id }}">Edit</a></td>
</tr>

@if ($account->children->isNotEmpty())
    @foreach ($account->children as $child)
        @include('admin.partials.account-tree', ['account' => $child])
    @endforeach
@endif
