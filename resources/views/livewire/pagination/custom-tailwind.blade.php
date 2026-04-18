@if ($paginator->hasPages())
    <div class="pagination flex justify-center">
        <nav aria-label="Page navigation">
            <ul class="inline-flex flex-wrap items-center gap-2 rounded-full bg-stone-50/95 px-2 py-2 shadow-sm shadow-stone-900/5 backdrop-blur dark:border dark:border-slate-800 dark:bg-slate-900/85 dark:shadow-slate-950/30">

                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);
                @endphp

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="flex h-9 items-center justify-center rounded-full px-4 text-sm leading-tight text-stone-400 dark:bg-transparent dark:text-slate-600">Previous</span>
                    </li>
                @else
                    <li>
                        <button wire:click="previousPage" wire:loading.attr="disabled"
                            class="flex h-9 items-center justify-center rounded-full border border-transparent px-4 text-sm leading-tight text-stone-600 transition hover:bg-stone-100 hover:text-stone-900 dark:border-transparent dark:bg-transparent dark:text-slate-300 dark:hover:border-slate-700 dark:hover:bg-slate-800 dark:hover:text-cyan-300">
                            Previous
                        </button>
                    </li>
                @endif

                {{-- Loop Halaman --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <li>
                            <span class="flex h-9 min-w-9 items-center justify-center rounded-full bg-amber-50 px-3 text-sm font-semibold text-amber-800 shadow-sm shadow-amber-100/80 dark:border-transparent dark:bg-cyan-400 dark:text-slate-950 dark:shadow-cyan-400/20">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                                class="flex h-9 min-w-9 items-center justify-center rounded-full border border-transparent px-3 text-sm text-stone-600 transition hover:bg-stone-100 hover:text-stone-900 dark:border-transparent dark:bg-transparent dark:text-slate-300 dark:hover:border-slate-700 dark:hover:bg-slate-800 dark:hover:text-cyan-300">
                                {{ $page }}
                            </button>
                        </li>
                    @endif
                @endfor

                {{-- Titik-titik dan halaman terakhir --}}
                @if ($end < $last - 1)
                    <li><span class="flex h-9 min-w-9 items-center justify-center px-1 text-sm text-stone-500 dark:text-slate-400">...</span></li>
                @endif

                @if ($end < $last)
                    <li>
                        <button wire:click="gotoPage({{ $last }})" wire:loading.attr="disabled"
                            class="flex h-9 min-w-9 items-center justify-center rounded-full border border-transparent px-3 text-sm text-stone-600 transition hover:bg-stone-100 hover:text-stone-900 dark:border-transparent dark:bg-transparent dark:text-slate-300 dark:hover:border-slate-700 dark:hover:bg-slate-800 dark:hover:text-cyan-300">
                            {{ $last }}
                        </button>
                    </li>
                @endif

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button wire:click="nextPage" wire:loading.attr="disabled"
                            class="flex h-9 items-center justify-center rounded-full border border-transparent px-4 text-sm leading-tight text-stone-600 transition hover:bg-stone-100 hover:text-stone-900 dark:border-transparent dark:bg-transparent dark:text-slate-300 dark:hover:border-slate-700 dark:hover:bg-slate-800 dark:hover:text-cyan-300">
                            Next
                        </button>
                    </li>
                @else
                    <li>
                        <span class="flex h-9 items-center justify-center rounded-full px-4 text-sm leading-tight text-stone-400 dark:bg-transparent dark:text-slate-600">
                            Next
                        </span>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
@endif
