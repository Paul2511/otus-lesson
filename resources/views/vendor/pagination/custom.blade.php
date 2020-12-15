@if ($paginator->hasPages())
    <nav aria-label="Page navigation ">
    <ul class="pagination pagination-primary pull-right">

        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">← {{ __('messages._paginate.previous') }}</span></li>
        @else
            <li><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">← {{ __('messages._paginate.previous') }}</a></li>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('messages._paginate.next') }} →</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">{{ __('messages._paginate.next') }} →</span></li>
        @endif
    </ul>
    </nav>
@endif 