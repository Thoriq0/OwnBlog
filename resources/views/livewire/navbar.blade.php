<nav id="navbar"
    class="fixed z-10 w-full border-b border-slate-200 bg-white/95 shadow-lg shadow-slate-900/5 backdrop-blur md:shadow-none dark:border-slate-800 dark:bg-slate-900/95">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" wire:navigate class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/ownblog.png') }}" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">OwnBlog</span>
        </a>
        <button data-collapse-toggle="navbar-solid-bg" type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-sm text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200 md:hidden dark:text-slate-400 dark:hover:bg-slate-800 dark:focus:ring-slate-700"
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
                class="mt-4 flex flex-col rounded-2xl bg-slate-50 p-2 font-medium md:mt-0 md:flex-row md:space-x-8 md:border-0 md:bg-transparent md:p-0 rtl:space-x-reverse dark:bg-slate-800 dark:md:bg-transparent">
                
                {{-- Home --}}
                <li>
                    <a href="/"
                        wire:navigate
                        class="{{ request()->is('/') ? 'nav-link-active' : 'nav-link' }}">
                        Home
                    </a>
                </li>

                {{-- Posts --}}
                <li>
                    <a href="/posts"
                        wire:navigate
                        class="{{ request()->is('posts') || request()->is('posts/*') ? 'nav-link-active' : 'nav-link' }}">
                        Posts
                    </a>
                </li>

                {{-- About --}}
                <li>
                    <a href="/about"
                        wire:navigate
                        class="{{ request()->is('about') ? 'nav-link-active' : 'nav-link' }}">
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
                        swapClass(getBc, ["top-[4rem]", "bg-white/95", "dark:bg-slate-900/95"], ["top-0", "bg-slate-100/95", "dark:bg-slate-900/95"])
    
                        // bbc.classList.add("hidden");
                    }
                    navbar.classList.remove("md:shadow-none");
                } 
                else {
                    navbar.classList.remove("-translate-y-full");
    
                    if(getBc){
                        swapClass(getBc, ["top-0", "bg-slate-100/95"], ["top-[4rem]", "bg-white/95", "dark:bg-slate-900/95"])
                        
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
