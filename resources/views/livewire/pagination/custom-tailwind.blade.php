@if ($paginator->hasPages())
    <div class="pagination flex justify-between">

        {{-- Help text --}}
        <span class="text-sm text-gray-700 dark:text-gray-400 hidden md:block md:mr-4 lg:mr-0">
            Showing 
            <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() }}</span> 
            to 
            <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->lastItem() }}</span> 
            of 
            <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span> 
            Entries
        </span>

        {{-- Buttons --}}
        <nav aria-label="Page navigation">
            <ul class="inline-flex -space-x-px text-sm">

                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);
                @endphp

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-gray-100 border border-gray-300 rounded-s-lg">Previous</span>
                    </li>
                @else
                    <li>
                        <button wire:click="previousPage" wire:loading.attr="disabled"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 rounded-s-lg">
                            Previous
                        </button>
                    </li>
                @endif

                {{-- Loop Halaman --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <li>
                            <span class="flex items-center justify-center px-3 h-8 text-blue-600 border border-blue-400 bg-blue-50 font-semibold">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                                class="flex items-center justify-center px-3 h-8 text-gray-600 bg-white border border-gray-300 hover:bg-gray-100">
                                {{ $page }}
                            </button>
                        </li>
                    @endif
                @endfor

                {{-- Titik-titik dan halaman terakhir --}}
                @if ($end < $last - 1)
                    <li><span class="flex items-center justify-center px-3 h-8 text-gray-600 bg-white border border-gray-300 hover:bg-gray-100">...</span></li>
                @endif

                @if ($end < $last)
                    <li>
                        <button wire:click="gotoPage({{ $last }})" wire:loading.attr="disabled"
                            class="lex items-center justify-center px-3 h-8 text-gray-600 bg-white border border-gray-300 hover:bg-gray-100">
                            {{ $last }}
                        </button>
                    </li>
                @endif

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button wire:click="nextPage" wire:loading.attr="disabled"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100">
                            Next
                        </button>
                    </li>
                @else
                    <li>
                        <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-gray-100 border border-gray-300 rounded-e-lg">
                            Next
                        </span>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
@endif
