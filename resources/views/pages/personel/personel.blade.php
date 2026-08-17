<x-app-layout>
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


    <div class="  w-11/12 max-w-9xl mx-auto">





        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center">

            <!-- Left: Title -->



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
            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <x-dropdown-filter align="right" />

                <!-- Datepicker built with flatpickr -->
                <x-datepicker />

                <!-- Add view button -->
                <button
                    class="btn bg-gray-900  text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
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
        <div class="flex justify-between items-center">
            <h1 class="bg-blue-600 text-xl text-white bg-opacity-50 shadow-2xl  hover:shadow-lg transition-all rounded-lg p-1"
                style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                Liste Fonctionaires grouper par Corps
            </h1>
            <!-- ===========================================================================Bouton Ajouter fonctionaire -->
            <button id="showFormBtn"
                class="flex right  btn m-1   bg-gray-900 h-8 w-auto  text-gray-100 hover:bg-gray-800
                 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white
                 ">

                <i class="fa-solid fa-user-plus fa-lg" style="color: #74C0FC;"></i>Ajouter

            </button>


        </div>

        <div class="w-full w-4xl mx-auto bg-white rounded-lg shadow-lg shadow-[0_4px_20px_rgba(59,130,246,0.6)]">
            @include('pages.personel.tabsCorps')
            <!-- Contenu des Onglets -->
            <div class="mt-4">
                <!-- Tableau pour la catégorie active -->
                @include('pages.personel.liste_fonctionaire')
            </div>
        </div>
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
            <h2 class="uppercase text-xl md:text-xl  text-blue-900 dark:text-gray-100"
                style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                Creer un nouveau fonctionnaire</h2>
            <button id="closeFormBtn" class="text-gray-600 text-4xl hover:text-red-600">&times;</button>
        </div>

            <div class="  shadow-lg  bg-white">

                <form action="{{ route('store.fonctionaires')}} " method="POST" enctype="multipart/form-data"
                    class="border rounded-lg shadow  space-y-2 text-sm ">
                    @csrf

                    <!-- ajouter une formulaire de fonctionnaire  -->

                    @include('pages.personel.Ajouter_Fonctionnaire')



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
    <!-- =================================================================== Script pour afficher/masquer le formulaire -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let showFormBtn = document.getElementById("showFormBtn");
            let closeFormBtn = document.getElementById("closeFormBtn");
            let sidePanelFonctionaire = document.getElementById("sidePanelFonctionaire");

            if (showFormBtn && closeFormBtn && sidePanelFonctionaire) {
                // Afficher au milieu avec effet zoom
                showFormBtn.addEventListener("click", function() {
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
    </script>
    <!-- =================================================================== confirmation supprission fonctionaire -->
    <script>
        function openCustomConfirm(event, form) {
            event.preventDefault(); // Empêche l'envoi du formulaire immédiat

            const modal = document.getElementById("customConfirmFonctionaire");
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
</x-app-layout>
