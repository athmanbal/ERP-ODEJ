
<div class="mt-2 w-full overflow-x-auto bg-gray-100 dark:bg-gray-900">

    <div class="flex w-1/2 min-w-max items-stretch gap-1
                border-b-4 border-gray-300 dark:border-gray-700
                text-sm font-semibold uppercase">

        @foreach ($corps as $corp)

            <a href="{{ route('fonctionaires', ['corp' => $corp->Id_Corps]) }}"
               class="group flex flex-1 min-w-max items-center justify-center
                      rounded-t-2xl border-b-4 border-l-4 px-4 py-2
                      transition-all duration-300 ease-in-out

                      {{ $activeCorpId == $corp->Id_Corps
                          ? 'border-blue-700 bg-white text-blue-900 shadow-md
                             dark:border-blue-400 dark:bg-gray-800 dark:text-blue-300'
                          : 'border-transparent bg-gray-200 text-gray-700
                             hover:border-blue-500 hover:bg-white hover:text-blue-900
                             dark:bg-gray-900 dark:text-gray-300
                             dark:hover:border-blue-400 dark:hover:bg-gray-800
                             dark:hover:text-blue-300' }}">

                <div class="flex flex-col items-center gap-1">

                    {{-- Compteur des fonctionnaires --}}
                    <span class="flex h-8 min-w-8 items-center justify-center
                                 rounded-full px-2 text-sm font-bold
                                 transition-colors duration-300

                                 {{ $activeCorpId == $corp->Id_Corps
                                     ? 'bg-blue-700 text-white dark:bg-blue-500'
                                     : 'bg-gray-300 text-gray-800
                                        group-hover:bg-blue-100
                                        dark:bg-gray-700 dark:text-gray-200
                                        dark:group-hover:bg-gray-600' }}">

                        {{ $corp->fonctionnaires_count }}

                    </span>

                    {{-- Nom du corps --}}
                    <span class="whitespace-nowrap text-xs md:text-sm">
                        {{ $corp->Nom_Corps }}
                    </span>

                </div>

            </a>

        @endforeach

    </div>


</div>




           <!-- Flèche sous le div -->
