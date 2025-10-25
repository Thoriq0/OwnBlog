<div class="container pt-32 lg:pt-36 md:px-5 lg:px-5 w-full m-auto lg:mb-48">

    {{-- Title --}}
    <div class="title pl-5 sm:pl-7 md:pl-5 lg:pl-0 font-semibold text-2xl lg:text-3xl text-left">
        <h1 class="capitalize">
            {{ $post->title }}
        </h1>
    </div>

    {{-- Breadcrumb / Author --}}
    <nav class="flex mt-3.5 pl-5 sm:pl-7 md:pl-5 lg:pl-0" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <div class="flex items-center">
                    @if ($post->category === 'tech notes')
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm-.293 9.293a1 1 0 0 1 0 1.414L9.414 14l1.293 1.293a1 1 0 0 1-1.414 1.414l-2-2a1 1 0 0 1 0-1.414l2-2a1 1 0 0 1 1.414 0Zm2.586 1.414a1 1 0 0 1 1.414-1.414l2 2a1 1 0 0 1 0 1.414l-2 2a1 1 0 0 1-1.414-1.414L14.586 14l-1.293-1.293Z"
                                clip-rule="evenodd" />
                        </svg>
                    @elseif ($post->category === 'projects')
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M18 17h-.09c.058-.33.088-.665.09-1v-1h1a1 1 0 0 0 0-2h-1.09a5.97 5.97 0 0 0-.26-1H17a2 2 0 0 0 2-2V8a1 1 0 1 0-2 0v2h-.54a6.239 6.239 0 0 0-.46-.46V8a3.963 3.963 0 0 0-.986-2.6l.693-.693A1 1 0 0 0 16 4V3a1 1 0 1 0-2 0v.586l-.661.661a3.753 3.753 0 0 0-2.678 0L10 3.586V3a1 1 0 1 0-2 0v1a1 1 0 0 0 .293.707l.693.693A3.963 3.963 0 0 0 8 8v1.54a6.239 6.239 0 0 0-.46.46H7V8a1 1 0 0 0-2 0v2a2 2 0 0 0 2 2h-.65a5.97 5.97 0 0 0-.26 1H5a1 1 0 0 0 0 2h1v1a6 6 0 0 0 .09 1H6a2 2 0 0 0-2 2v2a1 1 0 1 0 2 0v-2h.812A6.012 6.012 0 0 0 11 21.907V12a1 1 0 0 1 2 0v9.907A6.011 6.011 0 0 0 17.188 19H18v2a1 1 0 0 0 2 0v-2a2 2 0 0 0-2-2Zm-4-8.65a5.922 5.922 0 0 0-.941-.251l-.111-.017a5.52 5.52 0 0 0-1.9 0l-.111.017A5.925 5.925 0 0 0 10 8.35V8a2 2 0 1 1 4 0v.35Z" />
                        </svg>
                    @elseif ($post->category === 'tutorials')
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15v3c0 .5523.44772 1 1 1h4v-4m-5 0v-4m0 4h5m-5-4V6c0-.55228.44772-1 1-1h16c.5523 0 1 .44772 1 1v1.98935M3 11h5v4m9.4708 4.1718-.8696-1.4388-2.8164-.235-2.573-4.2573 1.4873-2.8362 1.4441 2.3893c.3865.6396 1.2183.8447 1.8579.4582.6396-.3866.8447-1.2184.4582-1.858l-1.444-2.38925h3.1353l2.6101 4.27715-1.0713 2.5847.8695 1.4388" />
                        </svg>
                    @elseif ($post->category === 'stories')
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z"
                                clip-rule="evenodd" />
                        </svg>
                    @elseif ($post->category === 'writing')
                        <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z"
                                clip-rule="evenodd" />
                        </svg>
                    @endif

                    <a href="/{{ $post->category }}/post"
                        class="inline-flex pl-1.5 items-center text-sm font-medium capitalize text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        {{ $post->category }}
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Post</a>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Banner --}}
    <div class="px-5 sm:px-7 md:px-5 lg:px-0 banner mt-4">
        @php
            $formats = ['jpg', 'jpeg', 'png', 'webp'];
            $banner = null;

            foreach ($formats as $ext) {
                $path = public_path("storage/contents/{$post->slug}/banner.{$ext}");
                if (file_exists($path)) {
                    $banner = asset("storage/contents/{$post->slug}/banner.{$ext}");
                    break;
                }
            }
        @endphp
        @if ($banner)
            <img src="{{ $banner }}" alt="{{ $post->title }}" class="w-full max-h-[540px]">
        @else
            <img src="{{ asset('storage/own/bg-view.jpeg') }}" alt="{{ $post->title }}" class="w-full max-h-[540px]">
        @endif
        {{-- <img src="https://images.unsplash.com/photo-1760340769739-653d00200baf?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870"
            alt="banner" class="w-full max-h-[540px]" /> --}}
    </div>

    {{-- Content --}}
    <div class="content mt-4 px-7 md:px-5 sm:px-10 lg:px-0">
        <div class="author">
            <p class="text-sm text-gray-500 font-semibold">Posted by {{ $post->author }},
                {{ $post->created_at->toFormattedDateString() }}</p>
            <p class="text-sm text-gray-500 pt-2">{{ $post->tags }}</p>
        </div>

        <div class="write my-10">
            <article class="prose prose-lg prose-neutral max-w-none">
                {{-- {!! Purifier::clean($post->contents) !!} --}}
                {!! $post->contents !!}
            </article>
        </div>
    </div>
</div>
