<div>

    {{-- Title --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <h2 class="font-extrabold text-2xl text-gray-800 dark:text-white tracking-tight">
            Your Text
        </h2>

        {{-- Search Bar --}}
        <div class="relative w-full sm:w-80">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="simple-search" placeholder="Search title..."
                wire:model.live="search"
                class="pl-10 w-full border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white 
                       bg-gray-50 dark:bg-gray-800 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 p-2.5 
                       placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:shadow-blue-100 
                       dark:focus:shadow-blue-900 transition-shadow duration-150">
        </div>
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

    {{-- Filter Action --}}
    <div class="filterAction flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-gray-200 dark:border-gray-700">
        {{-- Filtering --}}
        <div class="flex flex-wrap items-center gap-3">

            {{-- Filter by Status --}}
            <select wire:model.live="status"
                class="bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 
                       text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 
                       focus:border-blue-500 p-2.5 shadow-sm transition-shadow duration-150">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>

            {{-- Filter by Category --}}
            <select wire:model.live="category"
                class="bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 
                       text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 
                       focus:border-blue-500 p-2.5 shadow-sm transition-shadow duration-150">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
        </div>

        {{-- Reset Filter Button --}}
        <button wire:click="resetFilters"
            class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 
                   transition-colors duration-150 underline">
            Reset Filters
        </button>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto mt-6 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm">
        <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3 font-semibold">Title</th>
                    <th class="px-6 py-3 font-semibold">Status</th>
                    <th class="px-6 py-3 font-semibold">Category</th>
                    <th class="px-6 py-3 font-semibold">Created</th>
                    <th class="px-6 py-3 text-center font-semibold">Action</th>
                </tr>
            </thead>
            
            <tbody>

                <tr wire:loading>
                    <td colspan="5" class="py-10 text-center px-10">
                        <div class="flex justify-center items-center gap-3">
                            <svg class="w-5 h-5 animate-spin text-blue-500" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span>Loading...</span>
                        </div>
                    </td>
                </tr>

                @forelse ($contents as $content)
                    <tr wire:loading.remove class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/70 transition" >
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ Str::limit($content->title, 35, '...') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium
                                {{ $content->status === 'published' 
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' 
                                    : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' }}">
                                {{ ucfirst($content->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ ucfirst($content->category) }}</td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                            {{ $content->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="/{{ $content->slug }}/edited"
                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                   Edit
                                </a>
                                <form action="{{ route('content.delete', $content->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus konten ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="openDeleteModal('{{ route('content.delete', $content->id) }}')"
                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr wire:loading.remove>
                        <td colspan="5" class="text-center py-8 text-gray-500 dark:text-gray-400">
                            No content found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $contents->links('livewire.pagination.custom-tailwind') }}
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
        <div class="relative inset-0 bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-md mx-4">
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 text-red-500 w-12 h-12" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v4m0 4h.01m-6.938 4h13.856C18.9 21 20 19.9 20 18.556V5.444C20 4.1 18.9 3 17.556 3H6.444C5.1 3 4 4.1 4 5.444v13.112C4 19.9 5.1 21 6.444 21z" />
                </svg>

                <h3 class="mb-5 text-sm font-semibold text-gray-700 dark:text-gray-200">
                    This Content Will Delete ?
                </h3>

                <div class="flex justify-center gap-4">
                    <button id="cancelDelete"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg 
                            hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        Cancel
                    </button>

                    <form id="confirmDeleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg 
                                hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
                            Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function initDelModal() {
            const deleteModal = document.getElementById('deleteModal');
            const confirmDeleteForm = document.getElementById('confirmDeleteForm');
            const cancelDelete = document.getElementById('cancelDelete');

            window.openDeleteModal = function(actionUrl) {
                confirmDeleteForm.action = actionUrl;
                deleteModal.classList.remove('hidden');
            }

            if (cancelDelete) {
                cancelDelete.addEventListener('click', () => {
                    deleteModal.classList.add('hidden');
                    confirmDeleteForm.action = '';
                });

                deleteModal.addEventListener('click', (e) => {
                    if (e.target === deleteModal) {
                        deleteModal.classList.add('hidden');
                        confirmDeleteForm.action = '';
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', initDelModal);
        document.addEventListener('livewire:navigated', initDelModal);
    </script>
@endpush
