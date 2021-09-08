@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lt;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lt;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="this-page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&gt;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
  nav {
    display: inline-block;
    width: 100px;
    margin-right: 50px;
    position: absolute;
    right: 80px;
    top: 20px;
  }
  ul {
    display: inline-block;
    width: 100px;
    margin: 0;
    padding: 0;
  }
  .pagination {
    display: flex;
  }
  .page-item {
    display: inline-block;
    width: 20px;
    text-align: center;
    border: solid 1px #c0c0c0;
  }

  .page-link {
    display: inline-block;
    width: 100%;
    height: 100%;
    text-decoration: none;
    color: black;
  }
  .page-item .this-page-link {
    display: inline-block;
    width: 100%;
    text-decoration: none;
    color: white;
    background-color: black;
  }
</style>
