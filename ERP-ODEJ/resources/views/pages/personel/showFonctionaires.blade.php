<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        @foreach ($Fonctionnaire as $Fonct)
            <div
                class="grid bg-white grid-cols-3 sm:auto-cols-max justify-start sm:justify-end gap-2 shadow-md hover:shadow-lg transition-all  rounded-lg">
                <div class="h-18 w-16 ">
                    <img class="h-full w-full  rounded-xl object-cover object-center"
                        src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="" />
                    <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                </div>
                <div class="">

                    <label
                        class="uppercase text-2xl md:text-3xl border-solide border-gray-900 border-b-2  text-blue-900 dark:text-gray-100  ">{{ $Fonct->nom_fonctionnaire }}
                        {{ $Fonct->prenom_fonctionnaire }}</label>
                    <h3
                        class="block  p-r-2 mr-2 text-gray-800 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate">
                        <label
                            class="bg-blue-700 text-white  p-1 m-r-0 rounded-xl w-1/2">{{ $Fonct->matricule_fonctionnaire }}</label>|{{ $Fonct->date_naissance }}
                    </h3>
                </div>
                <!-- Filter button -->
                <div class="grid  grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
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



            <!-- Dashboard actions -->
            <div class="sm:flex sm:justify-between sm:items-center ">

                <!-- Left: Title -->
                <div class="grid grid-cols-3 mb-4 sm:mb-0">

                    <h3
                        class="block  p-2 mr-2 text-gray-800 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate">
                        <label
                            class="border border-blue-700 text-blue  p-2 m-2 rounded-xl w-1/2">{{ $Fonct->date_recretement }}</label>|{{ $Fonct->n_ss }}
                    </h3>
                    <h3
                        class="block  p-2 mr-2 text-gray-800 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate">
                        <label
                            class="border border-blue-700 text-blue  p-2 m-2 rounded-xl w-1/2">{{ $Fonct->nbr_annees }}</label>|{{ $Fonct->n_ss }}
                    </h3>
                    <h3
                        class="block  p-2 mr-2 text-gray-800 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate">
                        <label
                            class="border border-blue-700 text-blue  p-2 m-2 rounded-xl w-1/2">{{ $Fonct->matricule_fonctionnaire }}</label>|{{ $Fonct->lieu_naissance }}
                    </h3>

                </div>


                <!-- Right: Actions -->




            </div>
            <!-------------------------------------------------------------Filtre et recherche des fonctionnaires-->





            <!-------------------------------------------------------------Listes des fonctionnaires grouper par corps -->

            <div class="w-full w-4xl h-full mx-auto bg-white rounded-lg shadow-lg">
                <!-- Menu Tabs Dynamique -->

                <div class="flex border-b-4 border-gray-200 ">
                    -----------------{{ $Fonct->nom_fonctionnaire }}
                </div>


                <!-- fichier de fonctionaire actives -->
                <div class="mt-4">

                    <div class="mt-4 ">
                        <!-- ------------------------------------------------------------------------------------- fichier  pour le fonctionaire  active -->

                        <div
                            class="bg-white  sm:auto-cols-max justify-start sm:justify-end gap-2 shadow-md hover:shadow-lg transition-all  rounded-lg">
                            <label
                                class="uppercase text-xl md:text-xl border-solide border-gray-900 border-b-2  text-blue-900 dark:text-gray-100  ">

                                carrière administrative
                            </label>
                        </div>

                        <h1 class="m-4">Ajout de fichier pour le fonctionnaire actives</h1>

                        <form action="{{ route('employees.upload', $Fonct->id_fonctionnaire) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <label for="file">Sélectionnez un fichier :</label>
                            <input type="file" name="file" id="file" accept="application/pdf" required>
                            <div id="error-message" class="hidden fixed top-0 left-0 right-0 bg-red-500 text-white p-4 text-center z-50">
                                Veuillez sélectionner un fichier PDF.
                            </div>
                            <label for="select-option" class=" text-sm font-medium ml-8 text-gray-700">
                                Choisissez type de document</label>
                            <select id="file-colllectios" name="file-colllectios"
                                class="mt-1  pl-8 pr-12 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Dossier_Recrutement">Doosier Recrutement</option>
                                <option value="Decision">Decision</option>
                                <option value="peve">Pévé</option>
                            </select>

                            <button type="submit"
                                class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                                <svg class="fill-current shrink-0 xs:hidden" width="16" height="16"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                </svg>
                                <span class="max-xs:sr-only">Uploader</span>
                            </button>


                        </form>
                        <div class="flex">
                            @forelse($Fonct->media->groupBy('collection_name') as $collectionName => $mediaItems)
                                @if (session('file_uploaded'))
                                    <div class="  w-1/2 h-full  pt-8">
                                    @elseif (session('no_file'))
                                        <div class=" w-1/{{ $mediaGroupedByCollection->count() }}  h-full  pt-8">
                                @endif
                                <div style="border: 1px">
                                    <h2
                                        class="uppercase text-xl md:text-xl border-solide border-gray-900 m-2 border-b-2 font-bold text-blue-900 dark:text-gray-100  ">
                                        {{ $collectionName }}
                                    </h2>
                                    <ul>
                                        @foreach ($mediaItems as $media)
                                            <li><a href="{{ $media->getUrl() }}" target="_blank">
                                                    <strong>-</strong> {{ $media->file_name }}est pour url:====={{ $media->getUrl() }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                        </div>
                    @empty
                        <p>Aucun fichier trouvé pour cet employé.</p>
        @endforelse
    </div>
  
    </div>
    </div>
    </div>
    @endforeach



    </div>


    
   
</x-app-layout>
