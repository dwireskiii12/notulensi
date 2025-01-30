<style>
    /* Pagination Container */
    .pagination-container {
        margin: 100px auto;
        text-align: center;
    }

    /* Pagination Styles */
    .pagination {
        position: relative;
        display: inline-block;
    }

    .pagination a {
        display: inline-block;
        color: #2c3e50;
        text-decoration: none;
        font-size: 1.2rem;
        padding: 8px 16px 10px;
        position: relative;
    }

    .pagination a:before {
        z-index: -1;
        position: absolute;
        height: 100%;
        width: 100%;
        content: "";
        top: 0;
        left: 0;
        background-color: #2c3e50;
        border-radius: 24px;
        transform: scale(0);
        transition: all 0.2s;
    }

    .pagination a:hover {
        color: #fff;
        background-color: #6c5ce7; /* Warna ungu untuk hover */
        border-color: #6c5ce7; /* Warna border untuk hover */
    }

    .pagination a:hover:before {
        transform: scale(1);
    }

    .pagination a.pagination-active {
        color: #fff;
        background-color: #6c5ce7; /* Warna ungu untuk aktif */
        border-color: #6c5ce7; /* Warna border untuk aktif */
    }

    .pagination a.pagination-active:before {
        transform: scale(1);
    }

    .pagination-newer {
        margin-right: 50px;
    }

    .pagination-older {
        margin-left: 50px;
    }
</style>

@if ($paginator->hasPages())
    <nav class="pagination-container d-flex justify-content-center align-items-center" aria-label="Page navigation">
        {{-- Show results information --}}


        {{-- Pagination Links --}}
        <div class="pagination-links">
            <div class="pagination">
                {{-- Link to previous page --}}
                @if ($paginator->onFirstPage())
                    <a class="pagination-newer disabled" href="#">PREV</a>
                @else
                    <a class="pagination-newer" href="{{ $paginator->previousPageUrl() }}">PREV</a>
                @endif

                {{-- Loop through each page --}}
                <span class="pagination-inner">
                    @foreach ($elements as $element)
                        {{-- If the element is a string (like ...) --}}
                        @if (is_string($element))
                            <span>{{ $element }}</span>
                        @endif

                        {{-- If the element is an array of pages --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                {{-- Add pagination-active class for the current page --}}
                                <a class="{{ $page == $paginator->currentPage() ? 'pagination-active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                            @endforeach
                        @endif
                    @endforeach
                </span>

                {{-- Link to next page --}}
                @if ($paginator->hasMorePages())
                    <a class="pagination-older" href="{{ $paginator->nextPageUrl() }}">NEXT</a>
                @else
                    <a class="pagination-older disabled" href="#">NEXT</a>
                @endif
            </div>
        </div>
    </nav>
@endif
