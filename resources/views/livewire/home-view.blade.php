<div>
    <section class="bg-center bg-cover bg-no-repeat bg-gray-700 bg-blend-multiply lg:h-screen bg-fixed"
        style="background-image: url('{{ asset('images/homepage.jpg') }}')">
        <div class="px-4 pt-44 mx-auto lg:pt-72 max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">I
                believe in the world's endless potential</h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">On my blog, I share stories
                about tech, fresh ideas, and easy ways to build something meaningful so we can all grow together.</p>
        </div>
    </section>

    {{-- Breadcrumb --}}

    {{-- <hr id="bbc-lol" class="border-gray-200 border-{1px} sticky top-[4.6rem] z-20 w-[70%] m-auto hidden"> --}}

    <div id="breadcrumb"
        class="border-gray-300 dark:bg-gray-900 flex md:sticky top-0 justify-between p-4 lg:px-10 bg-white shadow-lg shadow-black-300 z-20">
        <div class="titleBc">
            <p class="font-semibold">OwnBlog</p>
        </div>

        <div class="breadcrumb">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Home
                        </a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- contents --}}
    <div class="sm:grid sm:grid-cols-12 sm:mt-16 lg:mx-10">

        {{-- left content --}}
        <div class="sm:col-span-5 lg:col-span-3 sm:mx-5 lg:mx-4 rounded-lg ">

            {{-- SearchBar --}}
            <div class="mt-14 px-7 sm:px-0 sm:mt-0 flex w-full items-center sm:max-w-sm sm:mx-auto mb-3.5">   
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                        </svg>

                    </div>
                    <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Post Title..." wire:model.live="search" />
                </div>
            </div>


            <div class="hidden sm:grid grid-rows-3 sm:gap-5 lg:gap-4">
                <div class="container sm:h-fit rounded-lg bg-gray-100 text-left p-7">

                    {{-- Category Title --}}
                    <h2 class="font-extrabold pb-2.5 text-xl">Categories</h2>
                    <ul class="mt-2">
                        <li class="cat">
                            <a href="/tech-notes/post">
                                Tech Notes
                            </a>
                        </li>
                        <li class="cat">
                            <a href="/projects/post">
                                Projects
                            </a>
                        </li>
                        <li class="cat">
                            <a href="/tutorials/post">
                                Tutorials
                            </a>
                        </li>
                        <li class="cat">
                            <a href="/stories/post">
                                Stories
                            </a>
                        </li>
                        <li class="cat">
                            <a href="/writing/post">
                                Writing
                            </a>
                        </li>
                    </ul>

                </div>

                <div class="container rounded-lg bg-gray-100 text-left p-7 row-span-2 h-fit">

                    {{-- Category Title --}}
                    <h2 class="font-extrabold pb-3 text-xl">Top Posts</h2>
                    <ul class="mt-2">
                        @foreach ($topPosts as $topPost)
                            <li class="Tp flex pb-3.5">
                                <span class="font-bold text-2xl pr-2.5">{{ $loop->iteration }}</span>
                                <a href="/post/read-{{ $topPost->slug }}">
                                    <div>
                                        <div class="title font-semibold">
                                            {{ Str::limit($topPost->title, 44, '...') }}
                                        </div>
                                        <div class="subDesc text-gray-400 font-semibold text-sm">
                                            {{ $topPost->category }} -
                                            {{ $topPost->created_at->toFormattedDateString() }}
                                        </div>
                                    </div>
                                </a>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Right content --}}
        <div id="'paginated-posts" class="m-7 sm:m-0 sm:col-span-7 lg:col-span-9 sm:mx-5 lg:mx-4">
            {{-- Container --}}
            <div class="container">

                {{-- Loader --}}
                <div class="w-full" wire:loading>
                    <div class="loader m-auto" style="
                        width: 120px; 
                        height: 20px;  
                        -webkit-mask: radial-gradient(circle closest-side,#000 94%,#0000) left/20% 100%;
                        background: linear-gradient(#000 0 0) left/0% 100% no-repeat #ddd;
                        animation: l17 2s infinite steps(6);"></div>
                </div>

                {{-- Wrapper Content --}}
                <div wire:loading.remove id="contents" class="grid gap-9 sm:grid-cols-1 lg:grid-cols-2 sm:gap-5 lg:gap-9">
                    @forelse ($contents as $index => $content)
                        <div
                            class="sm:max-w-lg w-full h-full sm:m-auto lg:max-w-lg md:block {{ $index >= 4 ? 'hidden' : '' }} 
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
                            <p>Post {{ $search }} Not Found.</p>
                            
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div id="pagination" class="my-14">
                    {{ $contents->links('livewire.pagination.custom-tailwind', data: ['scrollTo' => '#paginated-posts']) }}
                </div>
            </div>
        </div>
    </div>
</div>
