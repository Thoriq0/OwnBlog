<div>
    
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <h2 class="font-extrabold text-2xl text-gray-800 dark:text-white tracking-tight">
            ✍️ Start Writing
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Create new content for your blog
        </p>
    </div>
    {{-- Flash Notif --}}
    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3500)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-3"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-3"
            class="fixed right-[2%] top-[12%] z-50 flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl shadow-lg p-4 w-[320px] text-green-800">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m5 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
                </svg>
            </div>

            <!-- Text -->
            <div class="flex-1 text-sm font-medium">
                {{ session('success') }}
            </div>

            <!-- Close Button -->
            <button 
                @click="show = false"
                class="text-green-700/70 hover:text-green-900 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 6000)"
            x-show="show"
            x-transition
            class="fixed right-6 top-6 z-50 flex items-start gap-3 bg-red-50 border border-red-200 rounded-xl shadow-lg p-4 w-[320px] text-red-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856C19.07 19 20 18.07 20 16.938V7.062C20 5.93 19.07 5 17.938 5H6.062C4.93 5 4 5.93 4 7.062v9.876C4 18.07 4.93 19 6.062 19z"/>
            </svg>

            <div class="flex-1 text-sm font-medium">
                {{ $errors->first() }}
            </div>

            <button @click="show = false" class="text-red-700/70 hover:text-red-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
            <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3500)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-3"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-3"
            class="fixed right-[2%] top-[12%] z-50 flex items-start gap-3 bg-red-50 border border-red-200 rounded-xl shadow-lg p-4 w-[320px] text-red-800">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m5 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
                </svg>
            </div>

            <!-- Text -->
            <div class="flex-1 text-sm font-medium">
                {{ session('error') }}
            </div>

            <!-- Close Button -->
            <button 
                @click="show = false"
                class="text-red-700/70 hover:text-red-900 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    <form method="POST" action="{{ route('post.newText') }}" enctype="multipart/form-data" class="space-y-6" data-markdown-editor>
        @csrf

        {{-- Group 1: Title / Slug / Banner --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            
            {{-- Title --}}
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Title<sup class="text-red-600">*</sup>
                </label>
                <input type="text" id="title" name="title" data-markdown-title
                    value="{{ old('title') }}"
                    placeholder="Why you can't put your kids on the car"
                    class="w-full text-sm p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none shadow-sm transition">
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Slug
                </label>
                <input type="text" id="slug" name="slug" readonly data-markdown-slug
                    value="{{ old('slug') }}"
                    class="w-full p-2.5 text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 shadow-sm cursor-not-allowed">
            </div>

            {{-- Banner --}}
            <div>
                <label for="banner" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Banner Image
                </label>
                <input id="banner" type="file" name="banner"
                    class="block w-full h-fit p-1 text-sm text-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 dark:text-gray-400 focus:outline-none">
                <p class="text-sm text-gray-400">images : jpg, jpeg, png | max-2mb</p>
            </div>
        </div>

        {{-- Group 2: Category / Tags / Status --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            
            {{-- Category --}}
            <div>
                <label for="categories" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Category<sup class="text-red-600">*</sup>
                </label>
                <select id="categories" name="categories"
                    class="w-full p-2.5 text-sm rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm">
                    <option value="">Select category...</option>
                    <option value="tech-notes" {{ old('categories') === 'tech-notes' ? 'selected' : '' }}>Tech Notes</option>
                    <option value="projects" {{ old('categories') === 'projects' ? 'selected' : '' }}>Projects</option>
                    <option value="tutorials" {{ old('categories') === 'tutorials' ? 'selected' : '' }}>Tutorials</option>
                    <option value="stories" {{ old('categories') === 'stories' ? 'selected' : '' }}>Stories</option>
                    <option value="writing" {{ old('categories') === 'writing' ? 'selected' : '' }}>Writing</option>
                </select>
            </div>

            {{-- Tags --}}
            <div>
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Tags
                </label>
                <input id="tags" type="text" name="tags" value="{{ old('tags') }}" placeholder="#laravel, #markdown"
                    class="w-full p-2.5 text-sm rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm">
            </div>

            {{-- Status --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Status<sup class="text-red-600">*</sup>
                </label>
                <div class="flex gap-5 items-center p-2.5 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-300 dark:border-gray-700">
                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <input type="radio" name="status" value="draft" {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}
                            class="text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600">
                        Draft
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <input type="radio" name="status" value="published" {{ old('status') === 'published' ? 'checked' : '' }}
                            class="text-green-600 focus:ring-green-500 border-gray-300 dark:border-gray-600">
                        Publish
                    </label>
                </div>
            </div>
        </div>

        {{-- Group 3: Markdown Editor --}}
        <div class="markdown-shell">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Markdown Content<sup class="text-red-600">*</sup>
                    </label>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Tulis artikel pakai Markdown. Preview di kanan akan update otomatis.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="markdown-toolbar-button" data-md-action="heading">H2</button>
                    <button type="button" class="markdown-toolbar-button" data-md-action="bold">Bold</button>
                    <button type="button" class="markdown-toolbar-button" data-md-action="italic">Italic</button>
                    <button type="button" class="markdown-toolbar-button" data-md-action="quote">Quote</button>
                    <button type="button" class="markdown-toolbar-button" data-md-action="list">List</button>
                    <button type="button" class="markdown-toolbar-button" data-md-action="table">Table</button>
                    <button type="button" class="markdown-toolbar-button" data-md-action="code">Code</button>
                    <button type="button" class="markdown-toolbar-button" data-md-action="link">Link</button>
                </div>
            </div>

            <div class="mt-6 grid gap-5 xl:grid-cols-2">
                <div>
                    <textarea id="content" name="content" data-markdown-input class="markdown-input" placeholder="# Judul artikel&#10;&#10>Tulis konten markdown di sini...">{{ old('content') }}</textarea>
                </div>
                <div class="markdown-preview-panel">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">
                            Preview
                        </h3>
                        <span class="text-xs text-slate-400 dark:text-slate-500">Rendered from Markdown</span>
                    </div>
                    <div data-markdown-empty class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                        Preview akan muncul di sini begitu kamu mulai ngetik.
                    </div>
                    <article data-markdown-preview class="prose prose-lg max-w-none"></article>
                </div>
            </div>
        </div>

        {{-- Action Button --}}
        <div class="flex justify-end pt-4">
            <button type="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg text-sm font-medium shadow-sm focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition">
                Publish Now
            </button>
        </div>
    </form>
</div>
