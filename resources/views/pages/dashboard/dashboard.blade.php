<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">





        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold"></h1>
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

        <!-- ---------------------------------------------------------------- start corps Tabs


         ---------------------------------------------------------------- End corps Tabs -->




        <!-- Cards graphres-->



        <!-- ================================
     GESTION DU PERSONNEL
================================= -->

        <section class="mb-10">

            <!-- Header -->
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>

                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-blue-950">
                        Gestion du personnel
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Gestion des fonctionnaires et des informations administratives
                    </p>
                </div>
            </div>


            <!-- Categories Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">


                <!-- ================= FONCTIONNAIRES ================= -->
                <a href="{{ route('fonctionaires') }}"
                    class="group relative overflow-hidden
                            bg-white rounded-2xl
                            border-2 border-gray-200
                            p-6
                            shadow-sm
                            hover:shadow-2xl
                            hover:border-blue-500
                            hover:-translate-y-1
                            hover:border-blue-700
                            transition-all duration-300">

                    <!-- Decorative background -->
                    <div
                        class="absolute -right-8 -top-8
                        w-24 h-24
                        bg-blue-50
                        rounded-full
                        group-hover:scale-150
                        transition-transform duration-500">
                    </div>

                    <div class="relative flex items-center gap-5">

                        <!-- Icon -->
                        <div
                            class="flex-shrink-0
                            w-16 h-16
                            rounded-2xl
                            bg-blue-50
                            flex items-center justify-center
                            group-hover:bg-blue-600
                            transition-colors duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-9 h-9 fill-blue-600
                                group-hover:fill-white
                                transition-colors duration-300"
                                viewBox="0 0 24 24">

                                <circle cx="12" cy="8" r="4" />

                                <path d="M12 14c-5 0-9 2.5-9 6v2h18v-2c0-3.5-4-6-9-6z" />
                            </svg>

                        </div>


                        <!-- Content -->
                        <div class="flex-1">

                            <h3
                                class="text-lg font-bold text-blue-950
                               group-hover:text-blue-600
                               transition-colors">

                                Fonctionnaires

                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Gestion du personnel
                            </p>

                        </div>


                        <!-- Arrow -->
                        <div
                            class="text-gray-300
                            group-hover:text-blue-600
                            group-hover:translate-x-1
                            transition-all">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />

                            </svg>

                        </div>

                    </div>

                </a>



                <!-- ================= FONCTIONS ================= -->
                <a href="{{ route('fonctions') }}"
                    class="group relative overflow-hidden
                  bg-white rounded-2xl
                  border-2 border-gray-200
                  p-6
                  shadow-sm
                  hover:shadow-xl
                  hover:-translate-y-1
                  hover:border-violet-500
                  transition-all duration-300">

                    <div
                        class="absolute -right-8 -top-8
                        w-24 h-24
                        bg-violet-50
                        rounded-full
                        group-hover:scale-150
                        transition-transform duration-500">
                    </div>


                    <div class="relative flex items-center gap-5">

                        <div
                            class="flex-shrink-0
                            w-16 h-16
                            rounded-2xl
                            bg-violet-50
                            flex items-center justify-center
                            group-hover:bg-violet-600
                            transition-colors duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-9 h-9 fill-violet-600
                                group-hover:fill-white
                                transition-colors duration-300"
                                viewBox="0 0 24 24">

                                <path
                                    d="M19.14 12.94c.03-.3.06-.6.06-.94s-.03-.64-.06-.94l2.11-1.65a1 1 0 0 0 .25-1.3l-2-3.46a1 1 0 0 0-1.2-.46l-2.49 1a7.02 7.02 0 0 0-1.62-.94l-.38-2.65A1 1 0 0 0 12 2H8a1 1 0 0 0-1 .84l-.38 2.65a7.02 7.02 0 0 0-1.62.94l-2.49-1a1 1 0 0 0-1.2.46l-2 3.46a1 1 0 0 0 .25 1.3l2.11 1.65c-.03.3-.06.6-.06.94s.03.64.06.94l-2.11 1.65a1 1 0 0 0-.25 1.3l2 3.46a1 1 0 0 0 1.2.46l2.49-1c.47.39 1 .72 1.62.94l.38 2.65A1 1 0 0 0 8 22h4a1 1 0 0 0 1-.84l.38-2.65c.62-.22 1.15-.55 1.62-.94l2.49 1a1 1 0 0 0 1.2-.46l2-3.46a1 1 0 0 0-.25-1.3l-2.11-1.65ZM12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                            </svg>

                        </div>


                        <div class="flex-1">

                            <h3
                                class="text-lg font-bold text-blue-950
                               group-hover:text-violet-600
                               transition-colors">

                                Fonctions

                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Gestion des fonctions
                            </p>

                        </div>


                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-gray-300
                            group-hover:text-violet-600
                            group-hover:translate-x-1
                            transition-all"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                        </svg>

                    </div>

                </a>



                <!-- ================= GRADES ================= -->
                <a href="{{ route('grades') }}"
                    class="group relative overflow-hidden
                  bg-white rounded-2xl
                  border-2 border-gray-200
                  p-6
                  shadow-sm
                  hover:shadow-xl
                  hover:-translate-y-1
                  hover:border-amber-500
                  transition-all duration-300">

                    <div
                        class="absolute -right-8 -top-8
                        w-24 h-24
                        bg-amber-50
                        rounded-full
                        group-hover:scale-150
                        transition-transform duration-500">
                    </div>


                    <div class="relative flex items-center gap-5">

                        <div
                            class="flex-shrink-0
                            w-16 h-16
                            rounded-2xl
                            bg-amber-50
                            flex items-center justify-center
                            group-hover:bg-amber-500
                            transition-colors duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-9 h-9 fill-amber-500
                                group-hover:fill-white
                                transition-colors"
                                viewBox="0 0 24 24">

                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z" />

                            </svg>

                        </div>


                        <div class="flex-1">

                            <h3
                                class="text-lg font-bold text-blue-950
                               group-hover:text-amber-500
                               transition-colors">

                                Grades

                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Gestion des grades
                            </p>

                        </div>


                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-gray-300
                            group-hover:text-amber-500
                            group-hover:translate-x-1
                            transition-all"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                        </svg>

                    </div>

                </a>



                <!-- ================= POSTES SUPERIEURS ================= -->
                <a href="#"
                    class="group relative overflow-hidden
                  bg-white rounded-2xl
                  border-2 border-gray-200
                  p-6
                  shadow-sm
                  hover:shadow-xl
                  hover:-translate-y-1
                  hover:border-emerald-500
                  transition-all duration-300">

                    <div
                        class="absolute -right-8 -top-8
                        w-24 h-24
                        bg-emerald-50
                        rounded-full
                        group-hover:scale-150
                        transition-transform duration-500">
                    </div>


                    <div class="relative flex items-center gap-5">

                        <div
                            class="flex-shrink-0
                            w-16 h-16
                            rounded-2xl
                            bg-emerald-50
                            flex items-center justify-center
                            group-hover:bg-emerald-600
                            transition-colors">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-9 h-9 fill-emerald-600
                                group-hover:fill-white"
                                viewBox="0 0 24 24">

                                <path d="M12 2l6 6h-4v8h-4V8H6l6-6z" />
                                <rect x="5" y="18" width="14" height="4" rx="1" />

                            </svg>

                        </div>


                        <div class="flex-1">

                            <h3
                                class="text-lg font-bold text-blue-950
                               group-hover:text-emerald-600">

                                Postes supérieurs

                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Gestion des postes
                            </p>

                        </div>


                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-gray-300
                            group-hover:text-emerald-600
                            group-hover:translate-x-1
                            transition-all"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                        </svg>

                    </div>

                </a>



                <!-- ================= ETABLISSEMENTS ================= -->
                <a href="#"
                    class="group relative overflow-hidden
                  bg-white rounded-2xl
                  border-2 border-gray-200
                  p-6
                  shadow-sm
                  hover:shadow-xl
                  hover:-translate-y-1
                  hover:border-emerald-500                  transition-all duration-300">

                    <div
                        class="absolute -right-8 -top-8
                        w-24 h-24
                        bg-cyan-50
                        rounded-full
                        group-hover:scale-150
                        transition-transform duration-500">
                    </div>


                    <div class="relative flex items-center gap-5">

                        <div
                            class="flex-shrink-0
                            w-16 h-16
                            rounded-2xl
                            bg-cyan-50
                            flex items-center justify-center
                            group-hover:bg-cyan-600
                            transition-colors">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-9 h-9 fill-cyan-600
                                group-hover:fill-white"
                                viewBox="0 0 24 24">

                                <path d="M3 21h18v-2H3v2z" />
                                <path d="M5 19V5l7-3 7 3v14h-2V7l-5-2-5 2v12H5z" />
                                <path d="M9 9h2v2H9V9zm4 0h2v2h-2V9zM9 13h2v2H9v-2zm4 0h2v2h-2v-2z" />

                            </svg>

                        </div>


                        <div class="flex-1">

                            <h3
                                class="text-lg font-bold text-blue-950
                               group-hover:text-cyan-600">

                                Établissements

                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Gestion des établissements
                            </p>

                        </div>


                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-gray-300
                            group-hover:text-cyan-600
                            group-hover:translate-x-1
                            transition-all"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                        </svg>

                    </div>

                </a>


            </div>

        </section>



    </div>



    <!-- Cards graphres-->
    <div class="grid grid-cols-12 gap-6">

        <!-- Line chart (Acme Plus) -->
        <x-dashboard.dashboard-card-01 :dataFeed="$dataFeed" />

        <!-- Line chart (Acme Advanced) -->
        <x-dashboard.dashboard-card-02 :dataFeed="$dataFeed" />

        <!-- Line chart (Acme Professional) -->
        <x-dashboard.dashboard-card-03 :dataFeed="$dataFeed" />

        <!-- Bar chart (Direct vs Indirect) -->
        <x-dashboard.dashboard-card-04 />

        <!-- Line chart (Real Time Value) -->
        <x-dashboard.dashboard-card-05 />

        <!-- Doughnut chart (Top Countries) -->
        <x-dashboard.dashboard-card-06 />

        <!-- Table (Top Channels) -->
        <x-dashboard.dashboard-card-07 />

        <!-- Line chart (Sales Over Time) -->
        <x-dashboard.dashboard-card-08 />

        <!-- Stacked bar chart (Sales VS Refunds) -->
        <x-dashboard.dashboard-card-09 />

        <!-- Card (Customers) -->
        <x-dashboard.dashboard-card-10 />

        <!-- Card (Reasons for Refunds) -->
        <x-dashboard.dashboard-card-11 />

        <!-- Card (Recent Activity) -->
        <x-dashboard.dashboard-card-12 />

        <!-- Card (Income/Expenses) -->
        <x-dashboard.dashboard-card-13 />

    </div>

    </div>
</x-app-layout>
