<div>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <h2 class="font-extrabold text-2xl text-gray-800 dark:text-white tracking-tight">
            Dashboard Overview
        </h2>

        <span class="text-sm text-gray-500 dark:text-gray-400">
            Updated {{ now()->diffForHumans() }}
        </span>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        {{-- Total Posts --}}
        <div
            class="p-5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Total Posts</h3>
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalPosts }}</p>
        </div>

        {{-- Published --}}
        <div
            class="p-5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Published</h3>
                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $publishedPosts }}</p>
        </div>

        {{-- Drafts --}}
        <div
            class="p-5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Drafts</h3>
                <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h18v4H3V3zm0 6h18v12H3V9z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $draftPosts }}</p>
        </div>

        {{-- Categories --}}
        <div
            class="p-5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Categories</h3>
                <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $categoriesCount }}</p>
        </div>
    </div>

    {{-- Recent Posts --}}
    <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm">
        <h3 class="px-6 py-4 font-semibold text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
            Recent Posts
        </h3>
        <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3 font-semibold">Title</th>
                    <th class="px-6 py-3 font-semibold">Status</th>
                    <th class="px-6 py-3 font-semibold">Category</th>
                    <th class="px-6 py-3 font-semibold">Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentPosts as $post)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/70 transition">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ Str::limit($post->title, 35, '...') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium
                                {{ $post->status === 'published' 
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' 
                                    : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ ucfirst($post->category) }}</td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                            {{ $post->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-8 text-gray-500 dark:text-gray-400">
                            No recent posts found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>    