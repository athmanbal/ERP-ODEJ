<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">





        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">PERSONEL</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <x-dropdown-filter align="right" />

                <!-- Datepicker built with flatpickr -->
                <x-datepicker />

                <!-- Add view button -->
                <button
                    class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="max-xs:sr-only">Add View</span>
                </button>

            </div>



        </div>
        <!-------------------------------------------------------------Filtre et recherche des fonctionnaires-->





        <!-------------------------------------------------------------Listes des fonctionnaires grouper par corps -->
        <h1 class="shadow-md uppercase font-bold pb-1 mb-1  w-auto">Liste Fonctionaires grouper par Corps</h1>
        <div class="w-full w-4xl mx-auto bg-white rounded-lg shadow-lg">
            <!-- Menu Tabs Dynamique -->
            @include('pages.personel.tabsCorps')
            <!-- Contenu des Onglets -->
            <div class="mt-4">
                <!-- Tableau pour la catégorie active -->
                @include('pages.personel.liste_fonctionaire')
            </div>
        </div>
    </div>
</x-app-layout>

