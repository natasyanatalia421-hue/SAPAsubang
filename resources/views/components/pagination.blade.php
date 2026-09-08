@if ($paginator->hasPages())
<nav class="flex items-center justify-between text-sm" role="navigation">
    <div class="text-gray-500 text-xs">
        Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
    </div>
    <div class="flex items-center gap-1">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1.5 rounded-lg text-gray-300 bg-gray-50 text-xs">‹ Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-1.5 rounded-lg text-gray-600 hover:bg-gray-100 text-xs transition-colors">‹ Prev</a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 py-1 text-gray-400 text-xs">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1.5 rounded-lg bg-indigo-600 text-white text-xs font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-gray-600 hover:bg-gray-100 text-xs transition-colors">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-1.5 rounded-lg text-gray-600 hover:bg-gray-100 text-xs transition-colors">Next ›</a>
        @else
            <span class="px-3 py-1.5 rounded-lg text-gray-300 bg-gray-50 text-xs">Next ›</span>
        @endif
    </div>
</nav>
@endif
