<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-2 w-11/12 max-w-9xl mx-auto">
        <!-- action precedent -->
        <div class=" grid  grid-cols-12 ">
            <div
                class="col-span-6 flex items-center justify-start gap-2 py-2 px-4 bg-white rounded-lg shadow-sm border border-blue-100 mt-2 mb-4">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                    <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24">
                        <path d="M12 2.1L1 10h2v11h6v-7h6v7h6V10h2L12 2.1z" />
                    </svg>
                    <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">accueil</span>
                </a>
                <span class="mx-2 flex items-center justify-center bg-white rounded-full p-1">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 3L11 8L5 13" stroke="#222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <a href="{{ route('fonctionaires') }}"
                    class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                    <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M12 14c-5 0-9 2.5-9 6v2h18v-2c0-3.5-4-6-9-6z" />
                    </svg>
                    <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">Fonctionnaires</span>
                </a>
            </div>
            @foreach ($Fonctionnaire as $Fonct)
                <div
                    class="col-span-6 h-8 font-bold hover:shadow-xl hover:bg-blue-300 border-l-2 border-blue-400 m-2 pr-12  items-center justify-center text-center  relative">
                    <a class="block flex items-center" href="{{ route('fonctionaires') }}">
                        <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <!-- Circle for the head -->
                            <circle cx="12" cy="8" r="4" />
                            <!-- Path for the body -->
                            <path d="M12 14c-5 0-9 2.5-9 6v2h18v-2c0-3.5-4-6-9-6z" />
                        </svg>
                        <!-- Left: Title -->
                        <div class="mb-4 sm:mb-0 text-2xl md:text-xl text-gray-800 dark:text-gray-100 uppercase">
                            <label
                                class="uppercase text-2xl md:text-3xl border-solide border-gray-900 border-b-2  text-blue-900 dark:text-gray-100  "
                                style="text-shadow: 1px 2px 4px rgba(24, 7, 132, 0.5);">
                                {{ $Fonct->nom_fonctionnaire }}
                                {{ $Fonct->prenom_fonctionnaire }}</label>
                        </div>
                    </a>
                    <div class="absolute top-0 right-0 w-0 h-0  border-transparent border-t-gray-100 border-r-gray-100 "
                        style="border-bottom-width: 14px;border-top-width: 14px; border-left-width:14px ;border-right-width:14px;">
                    </div>
                    <div class="absolute bottom-0 right-0 w-0 h-0  border-transparent border-b-gray-100 border-r-gray-100 "
                        style="border-bottom-width: 14px;border-top-width: 14px; border-left-width:14px ;border-right-width:14px;">
                    </div>
                </div>
        </div>
        <div class="flex justify-between items-center m-0 b-0 w-full">
            <div
                class="flex items-center bg-blue-600  bg-opacity-50 shadow-2xl  hover:shadow-lg transition-all rounded-lg   w-1/4  py-1">

                <h2 class="uppercase text-xl md:text-xl  text-white dark:text-gray-100"
                    style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                    </i><i class="fa-solid fa-file-lines"></i>
                    <span>Fiche personel</span>
                </h2>
            </div>
            <button id="showFormEditBtn"
                class="flex right  btn m-1   bg-gray-900 h-8 w-auto  text-gray-100 hover:bg-gray-800
                 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white
                 ">

                <i class="fa-solid fa-user-plus fa-lg" style="color: #74C0FC;"></i>:Modifier informations

            </button>


        </div>


<!-- =========================================================
     FICHE FONCTIONNAIRE
========================================================= -->

<div class="group relative overflow-hidden
            grid grid-cols-12
            gap-4
            w-full
            bg-white
            border border-gray-200
            rounded-2xl
            p-5
            shadow-sm
            hover:shadow-xl
            hover:-translate-y-1
            hover:border-blue-700
            transition-all duration-300">


    <!-- =====================================================
         PHOTO + MATRICULE
    ====================================================== -->

    <div class="col-span-12 md:col-span-2
                flex flex-col items-center justify-center">

        <!-- Photo -->
        <div class="relative group/photo
                    w-46 h-64
                    rounded-2xl
                    overflow-hidden
                    bg-gray-100
                    border-2 border-gray-200
                    shadow-sm
                    hover:border-blue-600
                    transition-all duration-300">

            <!-- Overlay -->
            <label
                for="photoInput_{{ $Fonct->id_fonctionnaire }}"
                class="absolute inset-0
                       flex items-center justify-center
                       bg-blue-900/70
                       text-white text-xs font-semibold
                       opacity-0
                       group-hover/photo:opacity-100
                       transition-all duration-300
                       cursor-pointer
                       z-10">

                <span class="flex flex-col items-center gap-1">

                    <i class="fa-solid fa-camera text-lg"></i>

                    Modifier

                </span>

            </label>


            <!-- Image -->
            @forelse($Fonct->getMedia('photo') as $mediaItem)

                <img
                    class="w-full h-full object-cover"
                    src="{{ $mediaItem->getUrl() }}"
                    alt="{{ $mediaItem->name }}"
                />

            @empty

                <div class="w-full h-full
                            flex flex-col
                            items-center justify-center
                            text-gray-400">

                    <i class="fa-solid fa-user text-3xl mb-1"></i>

                    <span class="text-xs">
                        Aucune photo
                    </span>

                </div>

            @endforelse


            <!-- Upload -->
            <form
                action="{{ route('fonctionnaire.updatePhoto', $Fonct->id_fonctionnaire) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <input
                    type="file"
                    name="photo"
                    id="photoInput_{{ $Fonct->id_fonctionnaire }}"
                    class="hidden"
                    onchange="this.form.submit()"
                >

            </form>

        </div>


        <!-- Matricule -->
        <span class="mt-3
                     inline-flex
                     items-center
                     gap-1
                     px-3 py-1
                     bg-blue-700
                     text-white
                     text-xs
                     rounded-full
                     font-bold
                     shadow-sm">



            {{ $Fonct->id_fonctionnaire }}

        </span>

    </div>



    <!-- =====================================================
         INFORMATIONS
    ====================================================== -->

    <div class="col-span-12 md:col-span-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row
                    md:items-center
                    md:justify-between
                    gap-2
                    pb-4
                    mb-4
                    border-b border-gray-100">


            <!-- Nom / Fonction -->
            <div>

                <span class="text-xs
                             uppercase
                             tracking-wider
                             text-blue-600
                             font-semibold">

                    Fonctionnaire

                </span>

                <h2 class="mt-1
                           text-xl md:text-2xl
                           uppercase
                           font-bold
                           text-blue-950
                           group-hover:text-blue-700
                           transition-colors duration-300">

                    {{ $Fonct->nom_fonction }}

                </h2>

            </div>


            <!-- Status -->
            <span class="inline-flex
                         items-center
                         gap-2
                         w-fit
                         px-3 py-1
                         rounded-full
                         bg-green-50
                         text-green-700
                         text-xs
                         font-semibold">

                <span class="w-2 h-2 bg-green-500 rounded-full"></span>

                Actif

            </span>

        </div>



        <!-- Informations Grid -->
        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-3
                    gap-3">


            <!-- Date naissance -->
            <div class="p-3
                        rounded-xl
                        bg-gray-50
                        border border-gray-100
                        hover:bg-blue-50
                        hover:border-blue-100
                        transition-all">

                <span class="flex items-center gap-2
                             text-gray-500 text-xs">

                    <i class="fa-solid fa-cake-candles text-blue-500"></i>

                    Date de naissance

                </span>

                <span class="block mt-1
                             font-semibold
                             text-gray-800">

                    {{ $Fonct->date_naissance->format('Y-m-d') }}

                </span>

            </div>


            <!-- Téléphone -->
            <div class="p-3
                        rounded-xl
                        bg-gray-50
                        border border-gray-100
                        hover:bg-blue-50
                        hover:border-blue-100
                        transition-all">

                <span class="flex items-center gap-2
                             text-gray-500 text-xs">

                    <i class="fa-solid fa-phone text-blue-500"></i>

                    Téléphone

                </span>

                <span class="block mt-1
                             font-semibold
                             text-gray-800">

                    {{ $Fonct->telephone }}

                </span>

            </div>


            <!-- Recrutement -->
            <div class="p-3
                        rounded-xl
                        bg-gray-50
                        border border-gray-100
                        hover:bg-blue-50
                        hover:border-blue-100
                        transition-all">

                <span class="flex items-center gap-2
                             text-gray-500 text-xs">

                    <i class="fa-solid fa-calendar-check text-blue-500"></i>

                    Date de recrutement

                </span>

                <span class="block mt-1
                             font-semibold
                             text-gray-800">

                    {{ $Fonct->date_recretement->format('Y-m-d') }}

                </span>

            </div>


            <!-- Échelon -->
            <div class="p-3
                        rounded-xl
                        bg-gray-50
                        border border-gray-100
                        hover:bg-blue-50
                        hover:border-blue-100
                        transition-all">

                <span class="flex items-center gap-2
                             text-gray-500 text-xs">

                    <i class="fa-solid fa-layer-group text-blue-500"></i>

                    Nombre d'échelon

                </span>

                <span class="block mt-1
                             font-semibold
                             text-gray-800">

                    {{ $Fonct->id_echelon }}

                </span>

            </div>


            <!-- Établissement -->
            <div class="sm:col-span-2 p-3
                        rounded-xl
                        bg-gray-50
                        border border-gray-100
                        hover:bg-blue-50
                        hover:border-blue-100
                        transition-all">

                <span class="flex items-center gap-2
                             text-gray-500 text-xs">

                    <i class="fa-solid fa-building text-blue-500"></i>

                    Établissement

                </span>

                <span class="block mt-1
                             font-semibold
                             text-gray-800">

                    {{ $Fonct->nom_etablissement }}

                </span>

            </div>

        </div>

    </div>

</div>



<!-- =========================================================
     DOCUMENTS ADMINISTRATIFS
========================================================= -->

<nav class="mt-1 mb-4
            w-full
            bg-white
            border border-gray-200
            rounded-2xl
            p-1
            shadow-sm
            hover:shadow-md
            hover:border-blue-200
            transition-all duration-300">


    <ul class="grid
               grid-cols-1
               md:grid-cols-3
               gap-2">


        <!-- Attestation -->
        <li>

            <a
                href="{{ route('fonctionnaire.attestation', $Fonct->id_fonctionnaire) }}"
                target="_blank"
                class="group/doc
                       flex items-center
                       justify-center
                       gap-3
                       px-1 py-1
                       rounded-xl
                       text-blue-800
                       font-medium
                       text-sm
                       bg-blue-50
                       hover:bg-blue-700
                       hover:text-white
                       transition-all duration-300">

                <span class="w-9 h-9
                             flex items-center justify-center
                             rounded-lg
                             bg-white
                             text-blue-600
                             group-hover/doc:bg-blue-600
                             group-hover/doc:text-white
                             transition-all">

                    <i class="fa-solid fa-file-lines"></i>

                </span>

                <span>
                    Attestation de travail
                </span>

                <i class="fa-solid fa-arrow-up-right-from-square
                          text-xs
                          opacity-50
                          group-hover/doc:opacity-100">
                </i>

            </a>

        </li>



        <!-- Congé -->
        <li>

            <a
                href="#"
                class="group/doc
                       flex items-center
                       justify-center
                       gap-3
                       px-1 py-1
                       rounded-xl
                       text-blue-800
                       font-medium
                       text-sm
                       bg-gray-50
                       hover:bg-blue-700
                       hover:text-white
                       transition-all duration-300">

                <span class="w-9 h-9
                             flex items-center justify-center
                             rounded-lg
                             bg-white
                             text-blue-600
                             group-hover/doc:bg-blue-600
                             group-hover/doc:text-white
                             transition-all">

                    <i class="fa-solid fa-calendar-days"></i>

                </span>

                <span>
                    Congé
                </span>

                <i class="fa-solid fa-chevron-right
                          text-xs
                          opacity-40
                          group-hover/doc:opacity-100">
                </i>

            </a>

        </li>



        <!-- Carte professionnelle -->
        <li>

            <a
                href="#"
                class="group/doc
                       flex items-center
                       justify-center
                       gap-3
                       px-1 py-1
                       rounded-xl
                       text-blue-800
                       font-medium
                       text-sm
                       bg-gray-50
                       hover:bg-blue-700
                       hover:text-white
                       transition-all duration-300">

                <span class="w-9 h-9
                             flex items-center justify-center
                             rounded-lg
                             bg-white
                             text-blue-600
                             group-hover/doc:bg-blue-600
                             group-hover/doc:text-white
                             transition-all">

                    <i class="fa-solid fa-id-badge"></i>

                </span>

                <span>
                    Carte professionnelle
                </span>

                <i class="fa-solid fa-chevron-right
                          text-xs
                          opacity-40
                          group-hover/doc:opacity-100">
                </i>

            </a>

        </li>


    </ul>

</nav>


        <!-------------------------------------------------------------carierre profesionnel -->



        <div class="flex justify-between items-center m-0 b-0 w-full">

            <div
                class="flex items-center bg-blue-600  bg-opacity-50 shadow-2xl  hover:shadow-lg transition-all rounded-lg   w-2/6  py-0">

                <h2 class="uppercase text-xl md:text-xl  text-white dark:text-gray-100"
                    style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                    </i><i class="fa-solid fa-file-lines"></i>
                    <span>Carierre Proffesionel</span>
                </h2>


            </div>
            <button id="showFormBtn"
                class="flex items-center  btn m-0   bg-gray-900 h-8 w-64  text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M0 1a.75.75 0 0 1 .75.75V7.25H14a.75.75 0 0 1 0 1.5H8.75V14a.75.75 0 0 1-1.5 0V8.75H2a.75.75 0 0 1 0-1.5h5.25V1.75A.75.75 0 0 1 8 1z" />
                </svg>
                <i class="fa-solid fa-file-lines mr-2"></i>
                Ajouter Un document
            </button>
        </div>

{{-- ============================================================
     DOCUMENTS DU FONCTIONNAIRE
============================================================ --}}

<div class="mt-6 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

    {{-- ===================== HEADER ===================== --}}
    <div class="px-2 py-2 border-b border-gray-200">

        <div class="flex items-center justify-between gap-4">

            <div>
                <h3 class="text-lg font-bold text-gray-800">
                    Documents du fonctionnaire
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Consultez et gérez les documents administratifs
                </p>
            </div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
                <i class="fa-solid fa-folder-open text-blue-700"></i>

                <span>
                    {{ $Fonct->media->count() }} document(s)
                </span>
            </div>

        </div>

        {{-- ===================== COLLECTION TABS ===================== --}}
        <div class="mt-2 relative">

            <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-thin bg-blue-200 scrollbar-thumb-blue-300 scrollbar-track-blue-100 scrollbar-thumb-rounded-full scrollbar-track-rounded-full">

                @foreach($Fonct->media->groupBy('collection_name') as $collectionName => $mediaItems)

                    @php
                        $tabId = 'collection-' . $loop->index;
                        $contentId = 'content-' . $loop->index;
                    @endphp

                    <button
                        type="button"
                        onclick="showCollection('{{ $loop->index }}')"
                        data-tab="{{ $loop->index }}"
                        class="collection-tab flex-shrink-0
                               inline-flex items-center gap-2
                               px-2 py-2
                               rounded-xl
                               border-2
                               border-gray-200
                               bg-white
                               text-gray-600
                               text-sm font-semibold
                               hover:border-blue-700
                               hover:text-blue-700
                               transition-all duration-200">

                        {{-- Icône --}}
                        <i class="fa-solid fa-folder text-blue-600"></i>

                        {{-- Nom collection --}}
                        <span>
                            {{ $collectionName }}
                        </span>

                        {{-- Nombre --}}
                        <span
                            class="ml-1 min-w-[24px] h-6
                                   flex items-center justify-center
                                   rounded-full
                                   bg-gray-100
                                   text-gray-600
                                   text-xs font-bold">

                            {{ $mediaItems->count() }}

                        </span>

                    </button>

                @endforeach

            </div>

        </div>

    </div>


    {{-- ===================== TABLES ===================== --}}

    <div class="p-6">

        @forelse($Fonct->media->groupBy('collection_name') as $collectionName => $mediaItems)

            @php
                $contentId = 'content-' . $loop->index;
            @endphp

            <div
                id="{{ $contentId }}"
                data-content="{{ $loop->index }}"
                class="collection-content hidden">

                {{-- ===================== TABLE HEADER ===================== --}}
                <div class="flex items-center justify-between mb-4">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10
                                    rounded-xl
                                    bg-blue-50
                                    text-blue-700
                                    flex items-center justify-center">

                            <i class="fa-solid fa-folder-open"></i>

                        </div>

                        <div>

                            <h4 class="font-bold text-gray-800">
                                {{ $collectionName }}
                            </h4>

                            <p class="text-xs text-gray-500">
                                {{ $mediaItems->count() }} document(s)
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ===================== TABLE ===================== --}}
                <div class="overflow-x-auto
                            rounded-xl
                            border border-gray-200">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 border-b border-gray-200">

                            <tr>

                                <th class=" px-2 py-2 text-left
                                           font-semibold text-gray-600">
                                    Document
                                </th>

                                <th class=" px-2 py-2 text-left
                                           font-semibold text-gray-600">
                                    Date
                                </th>

                                <th class=" px-2 py-2 text-center
                                           font-semibold text-gray-600">
                                    Taille
                                </th>

                                <th class=" px-2 py-2 text-center
                                           font-semibold text-gray-600">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @foreach($mediaItems as $media)

                                <tr class="hover:bg-blue-50/40 transition-colors">

                                    {{-- DOCUMENT --}}
                                    <td class=" px-2 py-2">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10
                                                        rounded-lg
                                                        bg-red-50
                                                        text-red-600
                                                        flex items-center justify-center">

                                                <i class="fa-solid fa-file-pdf text-lg"></i>

                                            </div>

                                            <div>

                                                <p class="font-semibold text-gray-800">
                                                    {{ $media->name }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    PDF
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- DATE --}}
                                    <td class=" px-2 py-2 text-gray-600">

                                        <div class="flex items-center gap-2">

                                            <i class="fa-regular fa-calendar text-gray-400"></i>

                                            {{ $media->created_at->format('d/m/Y') }}

                                        </div>

                                    </td>


                                    {{-- SIZE --}}
                                    <td class=" px-2 py-2 text-center text-gray-600">

                                        {{ number_format($media->size / 1024, 0) }} Ko

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td class=" px-2 py-2">

                                        <div class="flex justify-center items-center gap-2">

                                            {{-- VOIR --}}
                                            <button
                                                type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#pdfModal"
                                                data-pdf="{{ $media->getUrl() }}"
                                                class="w-9 h-9
                                                       rounded-lg
                                                       bg-blue-50
                                                       text-blue-700
                                                       hover:bg-blue-700
                                                       hover:text-white
                                                       transition"
                                                title="Visualiser">

                                                <i class="fa-solid fa-eye"></i>

                                            </button>


                                            {{-- TÉLÉCHARGER --}}
                                            <a
                                                href="{{ $media->getUrl() }}"
                                                download
                                                class="w-9 h-9
                                                       rounded-lg
                                                       bg-green-50
                                                       text-green-700
                                                       hover:bg-green-600
                                                       hover:text-white
                                                       flex items-center justify-center
                                                       transition"
                                                title="Télécharger">

                                                <i class="fa-solid fa-download"></i>

                                            </a>


                                            {{-- SUPPRIMER --}}
                                            <button
                                                type="button"
                                                onclick="openCustomConfirm(event, this)"
                                                data-url="{{ route('fonctionnaires.deleteMedia', [
                                                    'id_fonctionnaire' => $Fonct->id_fonctionnaire,
                                                    'id' => $media->id
                                                ]) }}"
                                                class="w-9 h-9
                                                       rounded-lg
                                                       bg-red-50
                                                       text-red-600
                                                       hover:bg-red-600
                                                       hover:text-white
                                                       transition"
                                                title="Supprimer">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @empty

            {{-- Aucun document --}}
            <div class="py-12 text-center">

                <div class="mx-auto w-16 h-16
                            rounded-2xl
                            bg-gray-100
                            text-gray-400
                            flex items-center justify-center">

                    <i class="fa-solid fa-folder-open text-2xl"></i>

                </div>

                <h4 class="mt-4 font-semibold text-gray-700">
                    Aucun document
                </h4>

                <p class="mt-1 text-sm text-gray-400">
                    Aucun document n'est disponible pour ce fonctionnaire.
                </p>

            </div>

        @endforelse

    </div>

</div>


{{-- ============================================================
     JAVASCRIPT : GESTION DES COLLECTIONS
============================================================ --}}

<script>

function showCollection(collectionIndex) {

    /* ==========================================
       CACHER TOUS LES TABLEAUX
    ========================================== */

    document.querySelectorAll('.collection-content')
        .forEach(function(content) {

            content.classList.add('hidden');

        });


    /* ==========================================
       REMETTRE TOUS LES ONGLETS EN ÉTAT NORMAL
    ========================================== */

    document.querySelectorAll('.collection-tab')
        .forEach(function(tab) {

            tab.classList.remove(
                'bg-blue-700',
                'text-white',
                'border-blue-700',
                'shadow-md'
            );

            tab.classList.add(
                'bg-white',
                'text-gray-600',
                'border-gray-200'
            );

        });


    /* ==========================================
       AFFICHER LE TABLEAU SÉLECTIONNÉ
    ========================================== */

    const selectedContent =
        document.querySelector(
            '[data-content="' + collectionIndex + '"]'
        );

    if (selectedContent) {

        selectedContent.classList.remove('hidden');

    }


    /* ==========================================
       ACTIVER L'ONGLET
    ========================================== */

    const selectedTab =
        document.querySelector(
            '[data-tab="' + collectionIndex + '"]'
        );

    if (selectedTab) {

        selectedTab.classList.remove(
            'bg-white',
            'text-gray-600',
            'border-gray-200'
        );

        selectedTab.classList.add(
            'bg-blue-700',
            'text-white',
            'border-blue-700',
            'shadow-md'
        );

    }

}


/* ==========================================
   PREMIER ONGLET ACTIF AU CHARGEMENT
========================================== */

document.addEventListener('DOMContentLoaded', function() {

    const firstTab =
        document.querySelector('.collection-tab');

    if (firstTab) {

        showCollection(firstTab.dataset.tab);

    }

});

</script>



    </div>



    <!-- ------------------------------------------------------------------------------------- fichier  pour le fonctionaire  active -->
    @if (session('message'))
        <!-- ------------------------------- Panel de succès -->
        <div id="successPanel"
            class="fixed top-5 right-5 w-96 bg-green-500 text-white p-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="flex justify-between items-center">
                <span class="font-semibold">Succès !</span>
                <button id="closeSuccessBtn" class="text-white hover:text-gray-300">&times;</button>
            </div>
            <p class="mt-2">{{ session('message') }}</p>
        </div>
    @endif
    <!-- ===========================================================================Formulaire AJOUTER FICHIER caché par défaut -->
    <div id="sidePanel"
        class="fixed top-0 right-0 w-200 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="p-4 flex justify-between items-center bg-gray-200">
            <h2 class="text-lg font-semibold">Ajouter un fichier</h2>
            <button id="closeFormBtn" class="text-gray-600 text-4xl hover:text-red-600">&times;</button>
        </div>
        <div class="p-4">
            <form action="{{ route('employees.upload', $Fonct->id_fonctionnaire) }}" method="POST"
                enctype="multipart/form-data" class="">
                <div class="  shadow-lg mb-4 p-2 bg-white">
                    @csrf
                    <h1 class="m-2 text-md font-bold">Ajout de fichier pour le fonctionnaire actifs
                    </h1>
                    <div class="bg-white grid grid-cols-2">
                        <div class="form-group m-2 p-0">
                            <label for="NumDocs">Numéro de document</label><br />
                            <input type="text" id="NumDocs" name="NumDocs" class="form-control h-6" required
                                pattern="^\d+$" title="Le numéro de document doit être un nombre">
                            <small id="NumDocsError" class="form-text text-danger" style="display:none;">Le
                                numéro de document doit être un nombre valide.</small>
                        </div>
                        <div class="form-group m-2 p-0">
                            <label for="dateDefie">Date de défi</label><br />
                            <input type="date" id="dateDefie" name="dateDefie" class="form-control  h-6"
                                required>
                            <small id="dateDefieError" class="form-text text-danger" style="display:none;">La
                                date est obligatoire et doit être dans le format
                                YYYY-MM-DD.</small>
                        </div>

                        <div class="form-group m-2 p-0">
                            <label for="file">Sélectionnez un fichier :</label><br />
                            <input type="file" name="file" id="file" accept="application/pdf" required>
                            <div id="error-message"
                                class="hidden fixed top-0 left-0 right-0 bg-red-500 text-white p-4 text-center z-50">
                                Veuillez sélectionner un fichier PDF.
                            </div>
                        </div>
                        <div class="form-group m-2 p-0">
                            <label for="select-option" class=" text-sm font-medium ml-8 text-gray-700">
                                Choisissez type de document</label><br />
                            <select id="file-colllectios" name="file-colllectios"
                                class="mt-1  pl-8 pr-12 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="photo">Photos--صورة شمسية</option>
                                <option value="Doosier_initial">Doosier_initial -- ملف التوظيف</option>
                                <option value="Decision_promotion--  مقررات الترقية ">Decision_promotion-- مقررات                                    الترقية </option>
                                <option value="Decision_échelon--  مقررات ترقية في الدرجة">Decision_échelon-- مقررات                                    ترقية في الدرجة</option>
                                <option value="Pévé d'instalation محضر التعيين"> Pévé d'instalation محضر التعيين                                </option>
                                <option value="مقرر التنصيب">مقرر التنصيب</option>
                                <option value="مقرر الادماج">مقرر الادماج</option>
                                <option value="Decision_مقرر تعيين في منصب عالي">مقرر تعيين في منصب عالي</option>
                                <option value="Decision_قرار التحويل">قرار التحويل</option>
                                <option value="Decision_مقرر الوكيل الداخيل">مقرر الوكيل الداخيل</option>
                                <option value="Decision_تثمين الخبرة">تثمين الخبرة</option>
                                <option value="Decision_Maladies-- العطل المرضية"> Maladies-- العطل المرضية</option>
                                <option value="Decision_تثمين الخبرة">تثمين الخبرة</option>

                                <option value="Pévé">Pévé</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="btn m-1   bg-gray-900 h-8 w-24  text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                            <svg class="fill-current shrink-0 xs:hidden" width="16" height="16"
                                viewBox="0 0 16 16">
                                <path
                                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                            </svg>
                            <span class="max-xs:sr-only">Uploader</span>
                        </button>
                    </div>



                </div>
            </form>
        </div>
    </div>


    <!-- ================================================= Boîte de confirmation suppressin personnalisée -->
    <div id="customConfirm" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <p class="text-lg text-red-400 font-semibold mb-4">Êtes-vous sûr de
                vouloir supprimer ce fichier ?</p>
            <div class="flex justify-center gap-4">
                <button id="confirmYes" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Oui</button>
                <button id="confirmNo" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Annuler</button>
            </div>
        </div>
    </div>
    <!-- Modale Bootstrap -->
    <!-- ==================================================================================== pdfModal PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aperçu du PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="" width="100%" height="700px"></iframe>
                </div>
            </div>
        </div>
    </div>







    </div>
    @endforeach



    </div>
    <!-- ===========================================================================Formulaire d'ajout fonctionaire caché par défaut -->

    <div id="sidePanelFonctionaire"
        class="fixed inset-0 flex items-center justify-center
            opacity-0 scale-0 pointer-events-none
            transition-all duration-500 ease-out">


        <div class="p-4">
            <div class="p-4 flex justify-between items-center bg-gray-200">

                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 640 640">
                    <!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M280 88C280 57.1 254.9 32 224 32C193.1 32 168 57.1 168 88C168 118.9 193.1 144 224 144C254.9 144 280 118.9 280 88zM304 300.7L341 350.6C353.8 333.1 369.5 317.9 387.3 305.6L331.1 229.9C306 196 266.3 176 224 176C181.7 176 142 196 116.8 229.9L46.3 324.9C35.8 339.1 38.7 359.1 52.9 369.7C67.1 380.3 87.1 377.3 97.7 363.1L144 300.7L144 576C144 593.7 158.3 608 176 608C193.7 608 208 593.7 208 576L208 416C208 407.2 215.2 400 224 400C232.8 400 240 407.2 240 416L240 576C240 593.7 254.3 608 272 608C289.7 608 304 593.7 304 576L304 300.7zM496 608C575.5 608 640 543.5 640 464C640 384.5 575.5 320 496 320C416.5 320 352 384.5 352 464C352 543.5 416.5 608 496 608zM512 400L512 448L560 448C568.8 448 576 455.2 576 464C576 472.8 568.8 480 560 480L512 480L512 528C512 536.8 504.8 544 496 544C487.2 544 480 536.8 480 528L480 480L432 480C423.2 480 416 472.8 416 464C416 455.2 423.2 448 432 448L480 448L480 400C480 391.2 487.2 384 496 384C504.8 384 512 391.2 512 400z" />
                </svg>
                <h2 class="uppercase text-xl md:text-xl  text-blue-900 dark:text-gray-600"
                    style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                    Mise à jour de
                    <label
                        class="uppercase text-2xl md:text-3xl border-solide border-gray-900 border-b-2  text-blue-900 dark:text-gray-400  "
                        style="text-shadow: 1px 2px 4px rgba(24, 7, 132, 0.5);">
                        {{ $Fonct->nom_fonctionnaire }}
                        {{ $Fonct->prenom_fonctionnaire }}
                    </label>
                </h2>
                <button id="closeFormBtnEditFonctionnaire"
                    class="text-gray-600 text-4xl hover:text-red-600">&times;</button>
            </div>

            <div class="  shadow-lg  bg-white">

                <form action="{{ route('update.fonctionaires', $Fonct->id_fonctionnaire) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ajouter une formulaire de fonctionnaire  -->

                    @include('pages.personel.Modifier_Fonctionnaire')



                </form>

            </div>

        </div>
    </div>
    <!-- ================================================= Boîte de confirmation suppressin personnalisée d'un fonctionaire -->
    <div id="customConfirmFonctionaire"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <p class="text-lg text-red-400 font-semibold mb-4">Êtes-vous sûr de
                vouloir supprimer ce fonctionnaire ?</p>
            <div class="flex justify-center gap-4">
                <button id="confirmYes" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Oui</button>
                <button id="confirmNo" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Annuler</button>
            </div>
        </div>
    </div>

    <!-- ==================================================================================== apercu PDF -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pdfModal = document.getElementById('pdfModal');
            pdfModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var pdfUrl = button.getAttribute('data-pdf');
                var modalBody = pdfModal.querySelector('#pdfViewer');
                modalBody.src = pdfUrl;
            });

            pdfModal.addEventListener('hidden.bs.modal', function() {
                var modalBody = pdfModal.querySelector('#pdfViewer');
                modalBody.src = "";
            });
        });
    </script>
    <!--   ===============================================================================messsage de success-->

    <!-- Script pour afficher/masquer le panel de succès -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let successPanel = document.getElementById("successPanel");
            let closeSuccessBtn = document.getElementById("closeSuccessBtn");

            // Afficher le panel
            setTimeout(() => {
                successPanel.classList.remove("translate-x-full");
            }, 500); // Petit délai avant l'affichage

            // Cacher automatiquement après 5s
            setTimeout(() => {
                successPanel.classList.add("opacity-0", "pointer-events-none");
            }, 5000);

            // Bouton de fermeture manuel
            closeSuccessBtn.addEventListener("click", function() {
                successPanel.classList.add("translate-x-full");
            });
        });
    </script>
    <!-- =================================================================== Script pour afficher/masquer le formulaire ajouter docs -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let showFormBtn = document.getElementById("showFormBtn");
            let closeFormBtn = document.getElementById("closeFormBtn");
            let sidePanel = document.getElementById("sidePanel");

            // Afficher le panel
            showFormBtn.addEventListener("click", function() {
                sidePanel.classList.remove("translate-x-full");
            });

            // Cacher le panel
            closeFormBtn.addEventListener("click", function() {
                sidePanel.classList.add("translate-x-full");
            });
        });
    </script>
    <!-- =================================================================== Script pour afficher/masquer le formulaire Modifier information fonctionaire -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let showFormEditBtn = document.getElementById("showFormEditBtn");
            let closeFormBtn = document.getElementById("closeFormBtnEditFonctionnaire");
            let sidePanelFonctionaire = document.getElementById("sidePanelFonctionaire");

            if (showFormEditBtn && closeFormBtn && sidePanelFonctionaire) {
                // Afficher au milieu avec effet zoom
                showFormEditBtn.addEventListener("click", function() {
                    sidePanelFonctionaire.classList.remove("opacity-0", "scale-0", "pointer-events-none");
                    sidePanelFonctionaire.classList.add("opacity-100", "scale-100");
                });

                // Cacher avec effet zoom inverse
                closeFormBtn.addEventListener("click", function() {
                    sidePanelFonctionaire.classList.remove("opacity-100", "scale-100");
                    sidePanelFonctionaire.classList.add("opacity-0", "scale-0", "pointer-events-none");
                });

                // Fermer avec Escape
                document.addEventListener("keydown", function(e) {
                    if (e.key === "Escape") {
                        sidePanelFonctionaire.classList.remove("opacity-100", "scale-100");
                        sidePanelFonctionaire.classList.add("opacity-0", "scale-0", "pointer-events-none");
                    }
                });
            }
        });
    </script>
    <!-- =================================================================== confirmation supprission file -->
    <script>
        function openCustomConfirm(event, form) {
            event.preventDefault(); // Empêche l'envoi du formulaire immédiat

            const modal = document.getElementById("customConfirm");
            modal.classList.remove("hidden"); // Affiche la boîte modale

            // Quand l'utilisateur clique sur "Oui"
            document.getElementById("confirmYes").onclick = function() {
                modal.classList.add("hidden");
                form.submit(); // Soumet le formulaire
            };

            // Quand l'utilisateur clique sur "Annuler"
            document.getElementById("confirmNo").onclick = function() {
                modal.classList.add("hidden");
            };

            return false; // Empêche l'envoi du formulaire tant qu'on n'a pas confirmé
        }
    </script>
</x-app-layout>
