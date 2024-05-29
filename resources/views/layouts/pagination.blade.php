<div class="mx-2">
    @if ($posts->count() > 0)
        <div class="d-flex justify-content-between">
            <div>
                Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }}
            </div>
            <div>
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @else
        <div>No entries found</div>
    @endif
</div>
