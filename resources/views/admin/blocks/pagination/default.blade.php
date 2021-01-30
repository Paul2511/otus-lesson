@if ($paginator->hasPages())
    <div class="card-tools">
        <ul class="pagination pagination-sm">
            @if ($paginator->onFirstPage())
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="#" class="page-link aria-hidden=">&lsaquo;</a>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled page-item" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active page-item" aria-current="page"><a  href="#" class="page-link">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link"  aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="#" class="page-link" aria-hidden="true">&rsaquo;</a>
                </li>
            @endif
        </ul>
    </div>
@endif
