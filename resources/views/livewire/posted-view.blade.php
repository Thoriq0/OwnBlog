<div>

    {{-- Header --}}
    <div class="flex justify-between pt-28 px-16">
        {{-- Title --}}
        <h1 class="text-gray-700 text-xl md:text-2xl font-bold ">
            All Posts
        </h1>
        {{-- Breadcrumb --}}
        <div>
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
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
    <hr class="border-gray-400 w-11/12 border-{1px} m-auto pb-10 mt-7">

    {{-- Contents --}}
    <div>
        {{-- Search Bar --}}
        <div class="flex items-center mx-auto w-11/12 mb-7">   
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Post Title..." wire:model.live="search" />
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
                        background: linear-gradient(#000 0 0) left/0% 100% no-repeat #ddd;
                        animation: l17 2s infinite steps(6);"></div>
                </div>

                {{-- Wrapper --}}
                <div wire:loading.remove id="contents" class="grid gap-9 md:w-full sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 sm:gap-5 md:gap-7">
                    @forelse ($contents as $index => $content)
                        <div
                            class="sm:max-w-lg w-full h-full sm:m-auto lg:max-w-lg md:block 
                            bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">

                            <span>
                                @php
                                    $formats = ['jpg', 'jpeg', 'png', 'webp'];
                                    $banner = null;

                                    foreach ($formats as $ext) {
                                        $path = public_path("storage/contents/{$content->slug}/banner.{$ext}");
                                        if (file_exists($path)) {
                                            $banner = asset("storage/contents/{$content->slug}/banner.{$ext}");
                                            break;
                                        }
                                    }
                                @endphp
                                @if ($banner)
                                    <img src="{{ $banner }}" alt="{{ $content->title }}" class="rounded-t-lg w-full h-[300px]">
                                @else
                                    <img src="{{ asset('storage/own/bg-view.jpeg') }}" alt="{{ $content->title }}" class="rounded-t-lg bg-cover">
                                @endif
                            </span>

                            <div class="p-5">
                                <a href="/post/read-{{ $content->slug }}">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ Str::limit($content->title, 63, '...') }}
                                    </h5>
                                </a>

                                <p class="author text-sm pb-2.5 font-semibold text-gray-400">
                                    <span class="hover:text-blue-700">
                                        <a href="#" target="_blank">
                                            {{ $content->author }}
                                        </a>
                                    </span>
                                    - {{ $content->created_at->toFormattedDateString() }}
                                </p>

                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {{ Str::limit(strip_tags($content->contents), 180, '...') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-12">
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
