<div>
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/dashboard"
                        class="flex items-center p-2 rounded-lg dark:text-white hover:text-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group" wire:navigate wire:current="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-white">

                        <svg class="w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21" wire:current="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-white">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/your-text"
                        class=" flex items-center p-2 rounded-lg dark:text-white hover:text-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group" wire:navigate wire:current="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-white">
                        <svg class="shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18" wire:current="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-white">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Your Text</span>
                    </a>
                </li>
                <li>
                    <a href="/new-text"
                        class="flex items-center p-2 rounded-lg hover:text-blue-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" wire:navigate wire:current="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-white">
                        <svg class="shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" wire:current="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-white">
                            <path fill-rule="evenodd"
                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">New Text</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>
