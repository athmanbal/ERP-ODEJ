<table id="TableFonctionaires" class="w-full border-collapse bg-white text-left text-sm text-gray-500 ">
    <thead class="bg-gray-200">
        <tr class="uppercase underline underline-offset-8">
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Non Prenom</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900"> Date_Naissance</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Grade</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Etablissement</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Corps</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Ations</th>
        </tr>
    </thead>





    <tbody class="divide-y divide-gray-100 border-t border-gray-100 bg-gray-10 ">

        @foreach ($Fonctionnaires as $Fonctionnaire)
            <tr class="hover:bg-gray-200 ">
                <th class="flex gap-3 px-1 py-1  text-gray-900 font-bold  ">
                    <div class="relative h-10 w-10">
                        <img class="h-full w-full rounded-full object-cover object-center"
                            src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" />
                        <span
                            class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                    </div>
                    <div class="text-md">
                        <div class="font-bold text-gray-900 text-left">
                            <a href="#" class="font-bold">
                                {{ $Fonctionnaire->nom_fonctionnaire }}
                                {{ $Fonctionnaire->prenom_fonctionnaire }}

                            </a>
                        </div>
                        <div class="text-gray-500 text-sm">jobs@sailboatui.com</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                        Active
                    </span>
                </td>
                <td class="px-1 py-1"> {{ $Fonctionnaire->id_fonction }} </td>
                <td class="px-1 py-1"> {{ $Fonctionnaire->date_naissance }} </td>
                <td class="px-1 py-1">
                    <div class="flex gap-2">
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                            {{ $Fonctionnaire->nom_corps }}
                        </span>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600">
                            Product
                        </span>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-violet-50 px-2 py-1 text-xs font-semibold text-violet-600">
                            Develop
                        </span>
                    </div>
                </td>


                <!------------------------------------------------------------  TD ACTION TABLE FONCTIONNAIRES    -->
                <td class="px-1 py-1">
                    <div class="flex justify-end gap-4">
                        <!-- ---------------------------------------------------------------  -->
                        <button
                        class="btn p-1 border-0 border-b-2 border-gray-800  text-gray-900 hover:bg-gray-800 hover:text-gray-100 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">

                            <a x-data="{ tooltip: 'Voir' }"
                                href="{{ route('fonctionaires.show', $Fonctionnaire->id_fonctionnaire) }}"
                                class="relative group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 w-4 ">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 8.943 6.994 6.75 12 6.75c5.005 0 8.268 2.193 9.542 5.25-1.274 3.057-4.537 5.25-9.542 5.25-5.006 0-8.268-2.193-9.542-5.25z" />
                                </svg>
                                <!-- Tooltip -->
                                <span x-text="tooltip"
                                    class="absolute left-1/2 bottom-full mb-2 hidden -translate-x-1/2 bg-gray-800 text-white text-sm px-2 py-1 rounded shadow-lg group-hover:block">
                                </span>
                            </a>
                        </button>
                        <!-- ---------------------------------------------------------------  -->
                        <button
                        class="btn p-1 border-0 border-b-2 border-gray-800  text-gray-900 hover:bg-gray-800 hover:text-gray-100 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">


                            <a x-data="{ tooltip: 'Delete' }" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 w-4" x-tooltip="tooltip">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </a>
                        </button>
                        <button
                            class="btn p-1 border-0 border-b-2 border-gray-800  text-gray-900 hover:bg-gray-800 hover:text-gray-100 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">

                            <a x-data="{ tooltip: 'Edite' }" href="#" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 w-4" x-tooltip="tooltip">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Pagination -->
{{-- <div class="mt-4">
    
    @if (!$Fonctionnaires->isEmpty())
    
        {{ $Fonctionnaires->appends(['corp' => $Fonctionnaire->id_corps])->links() }}
    @endif
</div> --}}


