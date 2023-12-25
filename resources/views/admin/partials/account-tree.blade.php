<!-- resources/views/partials/account-table.blade.php -->

@foreach($nodes as $node)
    <tr>
        <td style="padding-left: {{ $indent * 20 }}px;">
            {{ $node->name }}
        </td>
        <td>
            {{ $node->category->name }}
        </td>
    </tr>

    @if(count($node->children) > 0)
        @include('admin.partials.account-tree', ['nodes' => $node->children, 'indent' => $indent + 1])
    @endif
@endforeach
