<div>
   <footer class="border-t border-slate-200 bg-white/95 dark:border-slate-800 dark:bg-slate-900/95">
      <div class="mx-auto w-full max-w-screen-xl p-6 md:py-10">
         <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">

            {{-- Brand --}}
            <div class="flex items-center gap-4">
               <img src="{{ asset('images/ownblog.png') }}" alt="OwnBlog Logo" class="h-12 w-12 rounded-lg" />
               <div>
                  <h2 class="text-2xl font-semibold dark:text-white">OwnBlog</h2>
               </div>
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-3 sm:grid-cols-3 gap-8 text-sm">
               <div>
                  <h3 class="mb-3 font-semibold uppercase text-gray-900 dark:text-white">Menu</h3>
                  <ul class="space-y-2 text-gray-500 dark:text-gray-400">
                     <li><a href="/" class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">Home</a></li>
                     <li><a href="/posts" class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">Posts</a></li>
                     <li><a href="/about" wire:navigate class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">About</a></li>
                  </ul>
               </div>

               <div>
                  <h3 class="mb-3 font-semibold uppercase text-gray-900 dark:text-white">Category</h3>
                  <ul class="space-y-2 text-gray-500 dark:text-gray-400">
                     <li><a wire:navigate href="/tech-notes/post" class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">Tech Notes</a></li>
                     <li><a wire:navigate href="/tutorials/post" class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">Tutorials</a></li>
                     <li><a wire:navigate href="/stories/post" class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">Stories</a></li>
                  </ul>
               </div>

               <div>
                  <h3 class="mb-3 font-semibold uppercase text-gray-900 dark:text-white">Connect</h3>
                  <ul class="space-y-2 text-gray-500 dark:text-gray-400">
                     <li><a href="https://github.com/Thoriq0" target="_blank" class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">GitHub</a></li>
                     <li><a href="https://x.com/Thoriq527" target="_blank" class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">Twitter/X</a></li>
                     <li><a href="mailto:thoriq.ahmad1301@gmail.com" class="hover:text-cyan-600 hover:underline dark:hover:text-cyan-300">Email</a></li>
                  </ul>
               </div>
            </div>
         </div>

         <hr class="my-8 border-slate-200 dark:border-slate-800">

         <div class="flex flex-col sm:flex-row justify-between items-center text-gray-500 dark:text-gray-400 text-sm">
            <p>© {{ date('Y') }} <span class="font-semibold text-gray-700 dark:text-gray-200">OwnBlog</span></p>
            <p class="mt-2 sm:mt-0">
               Built with ☕</a>
            </p>
         </div>
      </div>
   </footer>
</div>
