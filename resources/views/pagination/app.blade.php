@if ($paginator->hasPages())
    <div class="pagination-wrap">
        <nav role="navigation" aria-label="Pagination" class="pagination-nav">
            @if ($paginator->onFirstPage())
                <span class="pagination-nav__btn pagination-nav__btn--disabled">«</span>
            @else
                <a class="pagination-nav__btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a>
            @endif
            <span class="pagination-nav__meta">
                Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
            </span>
            @if ($paginator->hasMorePages())
                <a class="pagination-nav__btn" href="{{ $paginator->nextPageUrl() }}" rel="next">»</a>
            @else
                <span class="pagination-nav__btn pagination-nav__btn--disabled">»</span>
            @endif
        </nav>
    </div>
@endif
