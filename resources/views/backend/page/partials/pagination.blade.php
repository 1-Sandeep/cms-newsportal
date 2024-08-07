@if ($pages->count() > 0)
    <div class="d-flex justify-content-between mx-2">

        <div>
            Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }}
        </div>

        @if ($pages->hasPages())
            <div class="mx-2 d-flex justify-content-between">
                <ul class="pagination">
                    @if ($pages->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $pages->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    @foreach ($pages->getUrlRange(1, $pages->lastPage()) as $page => $url)
                        @if ($page == $pages->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($pages->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $pages->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    @else
        <div class="alert alert-info">
            No pages available.
        </div>
    </div>
@endif
