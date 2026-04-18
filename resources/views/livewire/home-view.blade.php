<div>
    <section
        class="flex items-center justify-center bg-fixed bg-center bg-cover bg-no-repeat bg-stone-900/60 bg-blend-multiply px-6 text-center sm:px-10 lg:px-16 dark:bg-stone-950/65"
        style="background-image: url('{{ asset('images/homepage.jpg') }}'); min-height: 100vh; box-sizing: border-box; padding-top: 5rem;"
    >
        <div class="w-full max-w-5xl">
            <h1 class="mb-4 text-4xl font-extrabold leading-tight tracking-tight text-white md:text-5xl lg:text-6xl">
                I believe in the world's endless potential
            </h1>
            <p class="mx-auto max-w-3xl text-lg font-normal text-gray-300 lg:text-xl">
                On my blog, I share stories about tech, fresh ideas, and easy ways to build something meaningful so we can all grow together.
            </p>
        </div>
    </section>

    {{-- Breadcrumb --}}

    {{-- <hr id="bbc-lol" class="border-gray-200 border-{1px} sticky top-[4.6rem] z-20 w-[70%] m-auto hidden"> --}}

    <div id="breadcrumb"
        class="z-20 flex justify-between border-b border-slate-200 bg-white/95 p-4 shadow-lg shadow-slate-900/5 backdrop-blur md:sticky top-0 lg:px-10 dark:border-slate-800 dark:bg-slate-900/95">
        <div class="titleBc">
            <p class="font-semibold text-slate-900 dark:text-slate-100">OwnBlog</p>
        </div>

        <div class="breadcrumb">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/"
                            class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-cyan-600 dark:text-slate-300 dark:hover:text-white">
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
    <div class="pb-16 sm:mt-16 sm:grid sm:grid-cols-12 sm:pb-20 lg:mx-10 lg:pb-24">

        {{-- left content --}}
        <div class="mt-14 rounded-lg px-7 sm:col-span-5 sm:mt-0 sm:mx-5 sm:px-0 lg:col-span-3 lg:mx-4">
            <div class="flex flex-col pb-10 lg:pb-12">
                {{-- SearchBar --}}
                <div class="mb-6 flex w-full items-center sm:max-w-sm sm:mx-auto">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="h-6 w-6 text-slate-500 dark:text-slate-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                        </div>
                        <input type="text" id="simple-search" class="block w-full rounded-xl border border-slate-200 bg-white/90 p-2.5 ps-10 text-sm text-slate-900 shadow-sm focus:border-cyan-400 focus:ring-cyan-400 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder-slate-400 dark:focus:border-cyan-500 dark:focus:ring-cyan-500" placeholder="Post Title..." wire:model.live="search" />
                    </div>
                </div>

                <div class="container sm:h-fit rounded-[1.5rem] border border-slate-200 bg-white/85 p-7 text-left shadow-sm shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900/80">

                    {{-- Category Title --}}
                    <h2 class="pb-2.5 text-xl font-extrabold text-slate-900 dark:text-white">Categories</h2>
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

                <div class="container mt-6 h-fit rounded-[1.5rem] border border-slate-200 bg-white/85 p-7 text-left shadow-sm shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900/80">

                    {{-- Category Title --}}
                    <h2 class="pb-3 text-xl font-extrabold text-slate-900 dark:text-white">Top Posts</h2>
                    <ul class="mt-2">
                        @forelse ($topPosts as $topPost)
                            <li class="Tp flex pb-3.5">
                                <span class="font-bold text-2xl pr-2.5">{{ $loop->iteration }}</span>
                                <a href="/post/read-{{ $topPost->slug }}">
                                    <div>
                                        <div class="title font-semibold text-slate-900 dark:text-slate-100">
                                            {{ Str::limit($topPost->title, 44, '...') }}
                                        </div>
                                        <div class="subDesc text-sm font-semibold text-slate-400 dark:text-slate-500">
                                            {{ $topPost->category_label }} -
                                            {{ $topPost->created_at->toFormattedDateString() }}
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                                Belum ada post yang bisa ditampilkan di sini.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Right content --}}
        <div id="paginated-posts" class="m-7 sm:m-0 sm:col-span-7 sm:mx-5 lg:col-span-9 lg:mx-4">
            {{-- Container --}}
            <div class="container">

                {{-- Loader --}}
                <div class="w-full" wire:loading>
                    <div class="loader m-auto" style="
                        width: 120px; 
                        height: 20px;  
                        -webkit-mask: radial-gradient(circle closest-side,#000 94%,#0000) left/20% 100%;
                        background: linear-gradient(#38bdf8 0 0) left/0% 100% no-repeat rgba(148,163,184,.25);
                        animation: l17 2s infinite steps(6);"></div>
                </div>

                {{-- Wrapper Content --}}
                <div wire:loading.remove id="contents" class="grid gap-9 sm:grid-cols-1 lg:grid-cols-2 sm:gap-5 lg:gap-9">
                    @forelse ($contents as $index => $content)
                        <div
                            class="h-full w-full rounded-[1.5rem] border border-slate-200 bg-white shadow-sm shadow-slate-900/5 sm:m-auto sm:max-w-lg dark:border-slate-800 dark:bg-slate-900">

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
                            <p>Post {{ $search }} Not Found.</p>
                            
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div id="pagination" class="mt-14 flex justify-end pr-2 sm:pr-0">
                    {{ $contents->links('livewire.pagination.custom-tailwind', data: ['scrollTo' => '#paginated-posts']) }}
                </div>
            </div>
        </div>
    </div>
</div>
