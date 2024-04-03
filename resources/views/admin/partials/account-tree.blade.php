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
    <td>{{ $account->normalBalance }}</td>
    <td>{{ $account->balance }}</td>
    <td>{{ $account->description }}</td>
    @if ($account->active == '1')
        <td><span class="badge bg-success">Active</span></td>
    @else
        <td><span class="badge bg-danger">Inactive</span></td>
    @endif
    <td>
        <a href="{{ route('admin.account.edit', $account->id) }}"
            class="btn icon btn-sm btn-primary d-inline-block m-1"
            data-bs-toggle="tooltip" title="Edit"><i
                class="bx bxs-pencil"></i></a>
        <form action="{{ route('admin.account.destroy', $account->id) }}"
            method="POST" class="d-inline-block m-1" data-bs-toggle="tooltip"
            title="Hapus">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="btn icon btn-sm btn-danger show_confirm"><i
                    class="bx bxs-trash"></i></button>
        </form>
    </td>
</tr>

@if ($account->children->isNotEmpty())
    @foreach ($account->children as $child)
        @include('admin.partials.account-tree', ['account' => $child])
    @endforeach
@endif
