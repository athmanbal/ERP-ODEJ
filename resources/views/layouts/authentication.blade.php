<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <script>
            if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            } else {
                document.querySelector('html').classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            }
        </script>
    </head>
    <body class="font-inter antialiased bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400">



    <!--  Panel -->
    <div id="authPanel" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50  z-50">

        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-3xl relative">


            <div class="flex">

                <!-- Content -->
                <div class="w-full md:w-1/2 p-6">
                    <div class="max-w-sm mx-auto w-full">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Image -->
                <div class="hidden md:block md:w-1/2">
                    <img class="object-cover object-center w-full h-full rounded-r-2xl"
                        src="{{ asset('images/GRH_odej.png') }}" alt="Authentication image" />
                </div>
            </div>
        </div>
    </div>




        @livewireScriptConfig
    </body>
</html>


