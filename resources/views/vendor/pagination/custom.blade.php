@if ($paginator->hasPages())


    {{-- <nav>
        <ul class="pagination"> --}}
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        {{-- <a href="#" class="rounded disabled" aria-label="@lang('pagination.previous')">&laquo;</a> --}}
        {{--
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li> --}}
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" tabindex="-1"
                aria-label="@lang('pagination.previous')">
                <i class="fa-solid fa-angles-left"></i>
            </a>
        </li>
        {{-- <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li> --}}
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item active">
                <a class="page-link" href="javascript:void(0)">{{ $element }}</a>
            </li>
            {{-- <a class="rounded disabled" aria-disabled="true">{{ $element }}</a> --}}

            {{-- <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li> --}}
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    {{-- <a href="#" class="active rounded">{{ $page }}</a> --}}
                    {{-- <li class="active" aria-current="page"><span>{{ $page }}</span></li> --}}
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <i class="fa-solid fa-angles-right"></i>
            </a>
        </li>
        {{-- </ul> --}}
        {{-- <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"
            class="rounded">&raquo;</a> --}}
        {{-- <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> --}}
    @else
        {{-- <a href="#" rel="next" aria-disabled="true" aria-label="@lang('pagination.next')"
            class="disabled rounded">&raquo;</a> --}}
        {{-- <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li> --}}
    @endif
    {{-- </ul>
    </nav> --}}
@endif
