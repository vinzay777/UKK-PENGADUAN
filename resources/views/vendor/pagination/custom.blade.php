@if ($paginator->hasPages())
<nav class="flex flex-wrap items-center gap-1">

    {{-- Prev --}}
    @if ($paginator->onFirstPage())
        <span class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed text-sm">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"
           class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition text-sm">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
        </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 text-sm">…</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm font-semibold">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                       class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition text-sm font-medium">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
           class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition text-sm">
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
        </a>
    @else
        <span class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed text-sm">
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
        </span>
    @endif

</nav>
@endif
