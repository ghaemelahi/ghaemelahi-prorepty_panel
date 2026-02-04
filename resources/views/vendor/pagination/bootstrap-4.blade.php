@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">

        {{-- قبلی --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">قبلی</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">قبلی</a>
            </li>
        @endif

        {{-- شماره صفحات --}}
        @foreach ($elements as $element)

            {{-- ... --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- لینک صفحات --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        @if ($page == $paginator->currentPage())
                            <span class="page-link">{{ $page }}</span>
                        @else
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    </li>
                @endforeach
            @endif

        @endforeach

        {{-- بعدی --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">بعدی</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">بعدی</span>
            </li>
        @endif

    </ul>
</nav>
@endif
