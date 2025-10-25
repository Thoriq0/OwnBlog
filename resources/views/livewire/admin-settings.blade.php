<div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-md">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <h2 class="font-extrabold text-2xl text-gray-800 dark:text-white tracking-tight">
            ⚙️ Admin Settings
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Manage your profile, preferences, and security settings
        </p>
    </div>

    <form wire:submit.prevent="updateSettings" class="space-y-8">

        {{-- Profile Section --}}
        <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                👤 Profile Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Name --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Full Name
                    </label>
                    <input type="text" id="name" wire:model="name"
                        class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 
                               dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm transition"
                        placeholder="John Doe">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email Address
                    </label>
                    <input type="email" id="email" wire:model="email"
                        class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 
                               dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm transition"
                        placeholder="john@example.com">
                </div>
            </div>

            {{-- Avatar Upload --}}
            <div class="mt-5">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Profile Picture
                </label>
                <div class="flex items-center gap-4">
                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}"
                            class="w-16 h-16 rounded-full object-cover border border-gray-300 dark:border-gray-700"
                            alt="Preview">
                    @else
                        <img src="{{ Auth::user()->avatar_url ?? '/default-avatar.png' }}"
                            class="w-16 h-16 rounded-full object-cover border border-gray-300 dark:border-gray-700"
                            alt="Avatar">
                    @endif
                    <input type="file" wire:model="avatar"
                        class="block w-full text-sm text-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 dark:text-gray-400 focus:outline-none">
                </div>
            </div>
        </div>

        {{-- Security Section --}}
        <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                🔐 Security Settings
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                {{-- Current Password --}}
                <div>
                    <label for="current_password"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Current Password
                    </label>
                    <input type="password" id="current_password" wire:model="current_password"
                        class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 
                               dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm transition">
                </div>

                {{-- New Password --}}
                <div>
                    <label for="new_password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        New Password
                    </label>
                    <input type="password" id="new_password" wire:model="new_password"
                        class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 
                               dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm transition">
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="confirm_password"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Confirm Password
                    </label>
                    <input type="password" id="confirm_password" wire:model="confirm_password"
                        class="w-full p-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 
                               dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 shadow-sm transition">
                </div>
            </div>
        </div>

        {{-- Preferences Section --}}
        <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                🎨 Preferences
            </h3>

            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Enable Dark Mode
                </span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:model="darkMode" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:bg-blue-600 
                                after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border 
                                after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                    </div>
                </label>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end pt-4">
            <button type="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white 
                       rounded-lg font-medium shadow-sm focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition">
                Save Changes
            </button>
        </div>
    </form>
</div>
