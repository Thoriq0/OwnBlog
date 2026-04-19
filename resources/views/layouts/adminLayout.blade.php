<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
      <meta charset="utf-8">
      <meta name="turbo-cache-control" content="no-preview">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>{{ $title }}</title>

      <style>

      </style>
      @livewireStyles

      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

      <!-- Styles / Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <script>
            (() => {
                  const storedTheme = localStorage.getItem('ownblog-theme');
                  const theme = storedTheme || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                  document.documentElement.setAttribute('data-theme', theme);
            })();
      </script>
</head>



<body>

   <div id="app">

      {{-- Navbar --}}
      @livewire('admin-navbar')
      {{-- SideBar --}}
      @livewire('admin-sidebar')

      {{-- Content --}}
      <div class="p-4 sm:ml-64">
         <div class="p-4 mt-14">
            {{ $slot }}
         </div>
      </div>

   </div>
   @stack('scripts')
   @livewireScripts

   <script>
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
