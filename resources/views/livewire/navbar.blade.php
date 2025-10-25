<nav id="navbar"
    class="bg-white z-10 border-gray-200 dark:bg-gray-900 fixed w-full shadow-lg shadow-black-300 md:shadow-none">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" wire:navigate class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/ownblog.png') }}" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">OwnBlog</span>
        </a>
        <button data-collapse-toggle="navbar-solid-bg" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-solid-bg" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
            <ul
                class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                
                {{-- Home --}}
                <li>
                    <a href="/"
                        wire:navigate
                        class="block py-2 px-3 md:p-0 rounded-sm 
                            {{ request()->is('/') 
                                ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' 
                                : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 
                                dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white 
                                md:dark:hover:bg-transparent' }}">
                        Home
                    </a>
                </li>

                {{-- Posts --}}
                <li>
                    <a href="/posts"
                        wire:navigate
                        class="block py-2 px-3 md:p-0 rounded-sm 
                            {{ request()->is('posts') || request()->is('posts/*') 
                                ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' 
                                : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 
                                dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white 
                                md:dark:hover:bg-transparent' }}">
                        Posts
                    </a>
                </li>

                {{-- About --}}
                <li>
                    <a href="/about"
                        wire:navigate
                        class="block py-2 px-3 md:p-0 rounded-sm 
                            {{ request()->is('about') 
                                ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700' 
                                : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 
                                dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white 
                                md:dark:hover:bg-transparent' }}">
                        About
                    </a>
                </li>
                {{-- <li>
                    <a href="/contact" wire:navigate
                        class="block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
@push('scripts')
    <script>
        function initNav(){
            // Action Navbar n Breadcrumb
            // get navbar
            const getNav = document.getElementById('navbar');
            let lastScrollTop = 0;
    
            // get breadcrumb
            const getBc = document.getElementById('breadcrumb');
    
            // get bbc HAHAHA
            // const bbc = document.getElementById('bbc-lol');
    
            function swapClass(el, removeClasses, addClasses) {
                el.classList.remove(...removeClasses);
                el.classList.add(...addClasses);
            }
            if(!getBc){
                getNav.classList.remove("md:shadow-none")
            }
            window.addEventListener('scroll', () =>{
                const currentScroll = window.scrollY || document.documentElement.scrollTop; 
    
                if (currentScroll > lastScrollTop && currentScroll > 80) {
                
                    navbar.classList.add("-translate-y-full");
                    
                    if(getBc){
                        swapClass(getBc, ["top-[4rem]"], ["top-0", "bg-gray-200"])
    
                        // bbc.classList.add("hidden");
                    }
                    navbar.classList.remove("md:shadow-none");
                } 
                else {
                    navbar.classList.remove("-translate-y-full");
    
                    if(getBc){
                        swapClass(getBc, ["top-0", "bg-gray-200",], ["top-[4rem]"])
                        
                        // bbc.classList.remove("hidden");
                    }
                    navbar.classList.remove("md:shadow-none");
                }
                lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; 
            });
        }
        document.addEventListener('DOMContentLoaded', initNav);
        document.addEventListener('livewire:navigated', initNav);
    </script>
@endpush
