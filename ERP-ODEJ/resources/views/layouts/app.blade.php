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
    @vite('resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">

    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- JS DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#TableFonctionaires').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json' // Traduction française
                },
                columnDefs: [{
                        orderable: false,
                        targets: -1
                    } // Désactiver le tri sur la colonne Actions
                ]
            });
        });
    </script>






    <!-- Styles -->
    @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
            document.querySelector('html').classList.remove('dark');
            document.querySelector('html').style.colorScheme = 'light';
        } else {
            document.querySelector('html').classList.add('dark');
            document.querySelector('html').style.colorScheme = 'dark';
        }
    </script>


    <!-- LARAVEL FILE MANAGER -->
    <link href="https://cdn.jsdelivr.net/npm/laravel-filemanager/css/lfm.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/laravel-filemanager/js/lfm.js"></script>
    <script>
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
    </script>
</head>

<body class=" font-serif antialiased bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400"
    :class="{ 'sidebar-expanded': sidebarExpanded }" x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">

    <script>
        if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }
    </script>

    <!-- Page wrapper -->
    <div class="flex h-[100dvh] overflow-hidden">

        <x-app.sidebar :variant="$attributes['sidebarVariant']" />

        <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if ($attributes['background']) {{ $attributes['background'] }} @endif"
            x-ref="contentarea">

            <x-app.header :variant="$attributes['headerVariant']" />

            <main class="grow">
                {{ $slot }}
            </main>

        </div>

    </div>

    @livewireScriptConfig
    @livewireScripts






    <script>
        $(document).ready(function() {


            // Ajouter des classes Tailwind au sélecteur de longueur
            $('#TableFonctionaires_length').addClass('mb-4 text-sm text-gray-700 text-gray-700');
            $('#TableFonctionaires_length label').addClass('font-semibold text-gray-700');
            $('#TableFonctionaires_length select').addClass('p-2 border border-gray-300 rounded bg-gray-500 text-gray-700 focus:outline-none focus:border-blue-500');
        });
    </script>




    <script src="https://cdn.jsdelivr.net/npm/laravel-filemanager/js/lfm.js"></script>
    <script>
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
    </script>

<script>



file && file.type !== 'application/pdf') {
        // Affiche l'alerte personnalisée
        errorMessage.classList.remove('hidden');
        
        // Cacher l'alerte après 3 secondes
        setTimeout(function() {
            errorMessage.classList.add('hidden');
        }, 3000);
        
        event.target.value = ''; // Réinitialise l'entrée
    }
});
</script>
</body>

</html>