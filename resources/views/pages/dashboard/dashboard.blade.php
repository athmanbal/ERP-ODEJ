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
        <div class="grid grid-cols-12  gap-2 mb-10 ">
            <!-- carré  des fonctionaire -->
            <div class="col-span-12 bg-white border-b-blue-500 border-b-2 text-3xl text-blue-900 h-8 uppercase  flex items-center justify-center  m-1 "
                style="text-shadow: 2px 2px 4px rgba(24, 7, 132, 0.5);">
                Gestion du personnel</div>

            <div
                class="col-span-4 flex  border-b-blue-500 border-b-2 items-center justify-center bg-white text-center text-2xl text-blue-900 h-32 m-1 hover:bg-blue-50  hover:shadow-2xl uppercase relative">
                <div class="flex  h-full items-center justify-center text-center">
                    <a href="{{ route('fonctionaires') }}" class="h-full flex items-center justify-center ">
                        <svg class="absolute  left-0 fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="48"
                            height="48" viewBox="0 0 24 24">
                            <!-- Circle for the head -->
                            <circle cx="12" cy="8" r="4" />
                            <!-- Path for the body -->
                            <path d="M12 14c-5 0-9 2.5-9 6v2h18v-2c0-3.5-4-6-9-6z" />
                        </svg>
                         FONCTIONAIRES
                        <div class="absolute top-0 right-0 w-0 h-0  border-transparent border-t-blue-500 border-r-blue-500 "
                            style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                        </div>
                        <div class="absolute bottom-0 right-0 w-0 h-0  border-transparent border-b-blue-500 border-r-blue-500 "
                            style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                        </div>
                    </a>
                </div>
            </div>

            <div
                class="col-span-4 flex  border-b-blue-500 border-b-2 items-center justify-center bg-white text-center text-2xl text-blue-900 h-32 m-1  hover:bg-blue-50  hover:shadow-2xl hover:bg-blue-200 uppercase relative">


                <a href="{{ route('fonctions') }}" class="h-full flex items-center justify-center ">
                    <svg class="absolute  left-0  fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="48"
                        height="48" viewBox="0 0 24 24">
                        <!-- Outer gear teeth -->
                        <path
                            d="M19.14 12.94c.03-.3.06-.6.06-.94s-.03-.64-.06-.94l2.11-1.65a1 1 0 0 0 .25-1.3l-2-3.46a1 1 0 0 0-1.2-.46l-2.49 1a7.02 7.02 0 0 0-1.62-.94l-.38-2.65A1 1 0 0 0 12 2h-4a1 1 0 0 0-1 .84l-.38 2.65a7.02 7.02 0 0 0-1.62.94l-2.49-1a1 1 0 0 0-1.2.46l-2 3.46a1 1 0 0 0 .25 1.3l2.11 1.65c-.03.3-.06.6-.06.94s.03.64.06.94l-2.11 1.65a1 1 0 0 0-.25 1.3l2 3.46a1 1 0 0 0 1.2.46l2.49-1c.47.39 1 .72 1.62.94l.38 2.65A1 1 0 0 0 8 22h4a1 1 0 0 0 1-.84l.38-2.65c.62-.22 1.15-.55 1.62-.94l2.49 1a1 1 0 0 0 1.2-.46l2-3.46a1 1 0 0 0-.25-1.3l-2.11-1.65ZM12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                    </svg>
                   FONCTIONs
                    <div class="absolute top-0 right-0 w-0 h-0  border-transparent border-t-blue-500 border-r-blue-500 "
                        style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                    </div>
                    <div class="absolute bottom-0 right-0 w-0 h-0  border-transparent border-b-blue-500 border-r-blue-500 "
                        style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                    </div>
                </a>
            </div>
            <div
                class="col-span-4 flex  border-b-blue-500 border-b-2 items-center justify-center bg-white text-center text-2xl text-blue-900 h-32 m-1  hover:bg-blue-50  hover:shadow-2xl hover:bg-blue-200 uppercase relative">


                <a href="{{ route('grades') }}" class="h-full flex items-center justify-center ">
                    <svg class="absolute  left-0  fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="48"
                        height="48" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z" />
                      </svg>
                    GRADES
                    <div class="absolute top-0 right-0 w-0 h-0  border-transparent border-t-blue-500 border-r-blue-500 "
                        style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                    </div>
                    <div class="absolute bottom-0 right-0 w-0 h-0  border-transparent border-b-blue-500 border-r-blue-500 "
                        style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                    </div>
                </a>
            </div>
            <div
                class="col-span-4 flex  border-b-blue-500 border-b-2 items-center justify-center bg-white text-center text-2xl text-blue-900 h-32 m-1  hover:bg-blue-50  hover:shadow-2xl hover:bg-blue-200 uppercase relative">


                <a href="#" class="h-full flex items-center justify-center ">
                    <svg class="absolute  left-0  fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="48"
                        height="48" viewBox="0 0 24 24">
                        <!-- Outer gear teeth -->
                        <path d="M12 2l6 6h-4v8h-4V8H6l6-6z" />
                        <rect x="5" y="18" width="14" height="4" rx="1" />
                    </svg>
                    POSTE SUPERIEURES
                    <div class="absolute top-0 right-0 w-0 h-0  border-transparent border-t-blue-500 border-r-blue-500 "
                        style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                    </div>
                    <div class="absolute bottom-0 right-0 w-0 h-0  border-transparent border-b-blue-500 border-r-blue-500 "
                        style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                    </div>
                </a>
            </div>
            <div
                class="col-span-4 flex  border-b-blue-500 border-b-2 items-center justify-center bg-white text-center text-2xl text-blue-900 h-32 m-1  hover:bg-blue-50  hover:shadow-2xl hover:bg-blue-200 uppercase relative">


                <a href="#" class="h-full flex items-center justify-center ">
                    <svg class="absolute  left-0  fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="48"
                        height="48" viewBox="0 0 24 24">
                        <!-- Outer gear teeth -->
                        <path d="M10 22v-6h4v6h-4z" />
                        <path d="M6 10h2v4H6zM16 10h2v4h-2z" />
                    </svg>
                    ETABLISSEMENTS
                    <div class="absolute top-0 right-0 w-0 h-0  border-transparent border-t-blue-500 border-r-blue-500 "
                        style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                    </div>
                    <div class="absolute bottom-0 right-0 w-0 h-0  border-transparent border-b-blue-500 border-r-blue-500 "
                        style="border-bottom-width: 34px;border-top-width: 34px; border-left-width:34px ;border-right-width:34px;">
                    </div>
                </a>
        </div>



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
