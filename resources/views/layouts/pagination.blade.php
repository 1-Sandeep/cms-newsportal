<div class="mx-2">
    @if ($data->count() > 0)
        <div class="d-flex justify-content-between">
            <div>
                Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }}
            </div>
            <div>
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @else
        <div>No entries found</div>
    @endif
</div>
