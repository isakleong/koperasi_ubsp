@foreach ($users as $item)
    @php
        $borderClass = '';

        // Check the status and set the border class accordingly
        if ($item->status == 3) {
            $borderClass = 'border-danger';
        } elseif ($item->status == 2) {
            $borderClass = 'border-success';
        } elseif ($item->status == 1) {
            $borderClass = 'border-warning';
        } elseif ($item->status == 0) {
            $borderClass = 'border-info';
        }
    @endphp
    <div class="card shadow-lg bg-transparent border {{ $borderClass }} mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $item->fname . ' ' . $item->lname }}</h5>
            <input type="hidden" class="memberId" value="{{ $item->memberId }}">
            <div class="mt-3">
                <a href="/admin/anggota/edit/{{ $item->memberId }}" type="button" class="btn btn-primary">Edit Data</a>
            </div>
        </div>
    </div>
@endforeach
{{ $users->links() }}
