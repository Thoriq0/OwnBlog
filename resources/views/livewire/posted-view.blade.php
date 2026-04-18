<div>

    {{-- Header --}}
    <div class="flex justify-between pt-28 px-16">
        {{-- Title --}}
        <h1 class="text-xl font-bold text-slate-900 dark:text-white md:text-2xl">
            All Posts
        </h1>
        {{-- Breadcrumb --}}
        <div>
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-cyan-600 dark:text-slate-300 dark:hover:text-white">
                        <svg class="h-6 w-6 text-slate-500 dark:text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 8a1 1 0 0 0-1 1v10H9a1 1 0 1 0 0 2h11a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-8Zm4 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v6h6V9a3 3 0 0 1 3-3h8c.35 0 .687.06 1 .17V5a2 2 0 0 0-2-2H5Zm4 10H3v2a2 2 0 0 0 2 2h4v-4Z" clip-rule="evenodd"/>
                        </svg>
                        <p class="pl-2.5 font-semibold">
                            Posts
                        </p>
                    </a>
                </li>
            </ol>
        </div>
        
    </div>

    {{-- Sperator --}}
    <hr class="m-auto mt-7 w-11/12 border-slate-200 pb-10 dark:border-slate-800">

    {{-- Contents --}}
    <div>
        {{-- Search Bar --}}
        <div class="flex items-center mx-auto w-11/12 mb-7">   
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="h-4 w-4 text-slate-500 dark:text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="simple-search" class="block w-full rounded-xl border border-slate-200 bg-white/90 p-2.5 ps-10 text-sm text-slate-900 shadow-sm focus:border-cyan-400 focus:ring-cyan-400 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder-slate-400 dark:focus:border-cyan-500 dark:focus:ring-cyan-500" placeholder="Post Title..." wire:model.live="search" />
            </div>
        </div>

        {{-- Content --}}
        <div id="'paginated-posts" class="m-7 md:w-11/12 md:m-auto sm:m-0 sm:col-span-7 md:col-span-9 sm:mx-5">
            {{-- Container --}}
            <div class="container md:m-auto">

                {{-- Loader --}}
                <div class="w-full" wire:loading>
                    <div class="loader m-auto" style="
                        width: 120px; 
                        height: 20px;  
                        -webkit-mask: radial-gradient(circle closest-side,#000 94%,#0000) left/20% 100%;
                        background: linear-gradient(#38bdf8 0 0) left/0% 100% no-repeat rgba(148,163,184,.25);
                        animation: l17 2s infinite steps(6);"></div>
                </div>

                {{-- Wrapper --}}
                <div wire:loading.remove id="contents" class="grid gap-9 md:w-full sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 sm:gap-5 md:gap-7">
                    @forelse ($contents as $index => $content)
                        <div
                            class="sm:max-w-lg w-full h-full sm:m-auto lg:max-w-lg md:block 
                            rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900">

                            @php
                                $formats = ['jpg', 'jpeg', 'png', 'webp'];
                                $banner = null;
                                $storage = \Illuminate\Support\Facades\Storage::disk('public');

                                foreach ($formats as $ext) {
                                    $path = "contents/{$content->slug}/banner.{$ext}";
                                    if ($storage->exists($path)) {
                                        $banner = $storage->url($path);
                                        break;
                                    }
                                }
                            @endphp
                            @if ($banner)
                                <img src="{{ $banner }}" alt="{{ $content->title }}" class="h-[300px] w-full rounded-t-lg object-cover">
                            @endif

                            <div class="p-5">
                                <a href="/post/read-{{ $content->slug }}">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ Str::limit($content->title, 63, '...') }}
                                    </h5>
                                </a>

                                <p class="author pb-2.5 text-sm font-semibold text-slate-400 dark:text-slate-500">
                                    <span class="hover:text-blue-700">
                                        <a href="#" target="_blank">
                                            {{ $content->author }}
                                        </a>
                                    </span>
                                    - {{ $content->created_at->toFormattedDateString() }}
                                </p>

                                <p class="mb-3 font-normal text-slate-700 dark:text-slate-300">
                                    {{ Str::limit($content->content_preview_text, 180, '...') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-slate-500 dark:text-slate-400">
                            <p>Post Not Found.</p>
                            
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div id="pagination" class="my-14 pl-2 sm:px-16 md:px-0">
                    {{ $contents->links('livewire.pagination.custom-tailwind', data: ['scrollTo' => '#paginated-posts']) }}
                </div>
            </div>
        </div>
    </div>

</div>
