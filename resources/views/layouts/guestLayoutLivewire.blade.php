<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>
    @livewireStyles
    <style>
        /* #loader {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            z-index: 9999;
        }
        #app {
            display: none;
        } */

        .cat{
            display: flex;
            align-items: center;
            padding-bottom: 0.8rem;
            padding-top: 0.8rem;
            border-bottom: 1px solid var(--warm-border);
            font-weight: 500;
            color: var(--warm-text-soft);
        }
        .cat:last-child{
            border-bottom-width: 0;
        }
        [data-theme="dark"] .cat{
            border-bottom-color: var(--warm-border);
            color: var(--warm-text-soft);
        }
        @keyframes l17 {
            100% {background-size:120% 100%}
         }

    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script>
        (() => {
            const storedTheme = localStorage.getItem('ownblog-theme');
            const theme = storedTheme || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
</head>
<body>

   {{-- <div id="loader">
      <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-blue-600"></div>
   </div> --}}

   <div id="app">

      {{-- Navbar --}}
      @livewire('navbar')
      
      {{-- Content --}}
      <div>
         {{ $slot }}
      </div>

   </div>

   <button type="button" data-theme-toggle class="theme-fab" aria-label="Toggle theme">
      <span data-theme-icon-light class="theme-icon">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 6.5A6.5 6.5 0 1 0 21.5 13 5.5 5.5 0 0 1 15 6.5Z" />
         </svg>
      </span>
      <span data-theme-icon-dark class="theme-icon hidden">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 2.75v2.5M12 18.75v2.5M4.75 12h-2.5M21.75 12h-2.5M6.88 6.88 5.1 5.1M18.9 18.9l-1.78-1.78M17.12 6.88l1.78-1.78M5.1 18.9l1.78-1.78M15.5 12a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" />
         </svg>
      </span>
   </button>

   @livewire('footer')
   @stack('scripts')
   @livewireScripts
   <script>
      // window.addEventListener('load', () => {
      //    document.getElementById('loader').style.display = 'none';
      //    document.getElementById('app').style.display = 'block';
      // });

      // FlowBite
      document.addEventListener('livewire:load', () => {
         if (window.initFlowbite) window.initFlowbite();
      });

      document.addEventListener('livewire:navigated', () => {
         // console.log('Navigated event triggered!');
         if (window.initFlowbite) {
            window.initFlowbite();
            // console.log('Flowbite re-initialized!');
         }
      });
   </script>

</body>
</html>
