<!-- resources/views/_account_row.blade.php -->

<tr>
    <td style="padding-left: {{ $account->depth * 20 }}px">{{ $account->name }}</td>
    <td>{{ $account->categoryID }}</td>
    <!-- Add other columns as needed -->
    <td><a href="/edit/{{ $account->id }}">Edit</a></td>
</tr>

@if ($account->children->isNotEmpty())
    @foreach ($account->children as $child)
        @include('admin.partials.account-tree', ['account' => $child])
    @endforeach
@endif