<div>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="/dashboard" class="flex ms-2 md:me-24">
                        <img src="{{ $siteSettings->logo_url }}" class="h-8 w-8 rounded-lg object-cover me-3" alt="{{ $siteSettings->site_title }} logo" />
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">{{ $siteSettings->site_title }}</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <button type="button" data-theme-toggle class="theme-button me-3" aria-label="Toggle theme">
                        <span data-theme-icon-light class="theme-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.05rem] w-[1.05rem]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 6.5A6.5 6.5 0 1 0 21.5 13 5.5 5.5 0 0 1 15 6.5Z" />
                            </svg>
                        </span>
                        <span data-theme-icon-dark class="theme-icon hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.05rem] w-[1.05rem]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 2.75v2.5M12 18.75v2.5M4.75 12h-2.5M21.75 12h-2.5M6.88 6.88 5.1 5.1M18.9 18.9l-1.78-1.78M17.12 6.88l1.78-1.78M5.1 18.9l1.78-1.78M15.5 12a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" />
                            </svg>
                        </span>
                        <span data-theme-label>Dark mode</span>
                    </button>
                    {{-- Notification --}}
                    {{-- User --}}
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                @if (Auth::user()->avatar_url)
                                    <img class="w-8 h-8 rounded-full object-cover"
                                        src="{{ Auth::user()->avatar_url }}"
                                        alt="{{ Auth::user()->name }} avatar">
                                @else
                                    <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-semibold"
                                        style="background-color: color-mix(in srgb, var(--warm-accent-soft) 78%, var(--warm-surface)); color: var(--warm-accent-strong);">
                                        {{ Auth::user()->initials }}
                                    </span>
                                @endif
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="/dashboard"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="/settings"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">
                                        Settings
                                    </a>
                                </li>
                                <li id="signOut">
                                    <form action="/logout" method="POST" class="signOutForm">
                                        @csrf
                                        <label for="signOut"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Sign Out</label>
                                        <input type="submit" value="signOut" hidden>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

@push('scripts')
    <script>
        function initSignOut() {
            const signOut = document.getElementById('signOut');
            if (!signOut) return;

            signOut.addEventListener('click', () => {
                const form = document.querySelector('.signOutForm');
                form?.submit();
            });
        }

        document.addEventListener('livewire:navigated', initSignOut);
        document.addEventListener('DOMContentLoaded', initSignOut);
    </script>
@endpush
