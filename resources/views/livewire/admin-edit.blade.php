<div>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <h2 class="font-extrabold text-2xl text-gray-800 dark:text-white tracking-tight">
            ✏️ Edit Content
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Update existing post
        </p>
    </div>

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


    <form method="POST" action="{{ route('post.updated', $content->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Group 1: Title / Slug / Banner --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- Title --}}
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Title<sup class="text-red-600">*</sup>
                </label>
                <input type="text" id="title" name="title"
                    value="{{ old('title', $content->title) }}"
                    class="w-full text-sm p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm transition">
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Slug
                </label>
                <input type="text" id="slug" name="slug" readonly
                    value="{{ old('slug', $content->slug) }}"
                    class="w-full p-2.5 text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 shadow-sm cursor-not-allowed">
            </div>

            {{-- Banner --}}
            <div>
                <label for="banner" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Banner Image
                </label>
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
                    <img src="{{ $banner }}" alt="Banner" class="w-full h-32 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                @else
                    <img src="" alt="No Banner" class="w-full grid content-center text-sm h-16 p-1.5 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                @endif
                <input id="banner" type="file" name="banner"
                    class="block w-full h-fit p-1 text-sm text-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 dark:text-gray-400 focus:outline-none">
                <p class="text-sm text-gray-400">Leave blank to keep existing image - images : jpg, jpeg, png | max-2mb</p>
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
                    <option value="tech-notes" {{ $content->category === "tech-notes" ? 'selected' : '' }} >Tech Notes</option>
                    <option value="projects" {{ $content->category === "projects" ? 'selected' : '' }} >Projects</option>
                    <option value="tutorials" {{ $content->category === "tutorials" ? 'selected' : '' }} >Tutorials</option>
                    <option value="stories" {{ $content->category === "stories" ? 'selected' : '' }} >Stories</option>
                    <option value="writing" {{ $content->category === "writing" ? 'selected' : '' }} >Writing</option>
                </select>
            </div>

            {{-- Tags --}}
            <div>
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Tags
                </label>
                <input id="tags" type="text" name="tags"
                    value="{{ old('tags', $content->tags) }}"
                    class="w-full p-2.5 text-sm rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm">
            </div>

            {{-- Status --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Status<sup class="text-red-600">*</sup>
                </label>
                <div class="flex gap-5 items-center p-2.5 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-300 dark:border-gray-700">
                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <input type="radio" name="status" value="draft" {{ $content->status === 'draft' ? 'checked' : '' }}
                            class="text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600">
                        Draft
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <input type="radio" name="status" value="published" {{ $content->status === 'published' ? 'checked' : '' }}
                            class="text-green-600 focus:ring-green-500 border-gray-300 dark:border-gray-600">
                        Publish
                    </label>
                </div>
            </div>
        </div>

        {{-- Group 3: Content Editor --}}
        <div>
            <label for="editor" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Content<sup class="text-red-600">*</sup>
            </label>

            {{-- Editor container --}}
            <div id="editor"
                class="min-h-[200px] w-full p-3 rounded-b-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus-within:ring-2 focus-within:ring-blue-500 transition">
                {!! $content->contents !!}
            </div>

            {{-- Hidden input for editor content --}}
            <textarea id="hidden-input" name="content" hidden>{!! $content->contents !!}</textarea>
        </div>

        {{-- Action Button --}}
        <div class="flex justify-end pt-4">
            <button type="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white rounded-lg text-sm font-medium shadow-sm focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-800 transition">
                Update Post
            </button>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        function slugGenerator() {
            const getTitle = document.getElementById('title');
            const getSlug  = document.getElementById('slug');

            if (getTitle && !getTitle.dataset.slugBound) {
                getTitle.dataset.slugBound = true; // biar gak dobel event listener
                getTitle.addEventListener('input', () => {
                    let title = getTitle.value.trim();
                    let slug = title
                        .toLowerCase()
                        .replace(/\s+/g, '-')     
                        .replace(/[^\w-]+/g, '');
                    getSlug.value = slug;
                });
            }
        }

        function initQuillEditor() {
            const editorContainer = document.getElementById('editor');
            const hiddenInput = document.getElementById('hidden-input');

            if (!editorContainer || editorContainer.dataset.initialized) return;
            editorContainer.dataset.initialized = true;

            const quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Berimajinasi lah coeg...',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['blockquote', 'code-block'],
                        ['link', 'image'],
                        [{'direction': 'rtl'}, {'script': 'sub'}, {'script' : 'super'}],
                        ['clean']
                    ]
                }
            });

            // Prefill editor content
            const existingContent = hiddenInput.value;
            if (existingContent) quill.root.innerHTML = existingContent;

            quill.on('text-change', () => {
                hiddenInput.value = quill.root.innerHTML;
            });
        }

        function initAllEdit() {
            slugGenerator();
            initQuillEditor();
        }

        document.addEventListener('DOMContentLoaded', initAllEdit);
        document.addEventListener('livewire:load', initAllEdit);
        document.addEventListener('livewire:navigated', initAllEdit);
        if (window.Livewire) {
            Livewire.hook('morph.updated', () => initAllEdit());
        }
    </script>
@endpush
