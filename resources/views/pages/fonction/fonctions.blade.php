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

    <div class="w-11/12 max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center">
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
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 3L11 8L5 13" stroke="#222" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <a href="{{ route('fonctions') }}"
                    class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                    <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24">
                        <path d="M4 4h16v2H4zM4 11h16v2H4zM4 18h16v2H4z" />
                    </svg>
                    <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">Fonctions</span>
                </a>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <x-dropdown-filter align="right" />
                <x-datepicker />
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

        <!-------------------------------------------------------------Liste des fonctions -->
        <div class="flex justify-between items-center">
            <h1 class="bg-blue-600 text-xl text-white bg-opacity-50 shadow-2xl hover:shadow-lg transition-all rounded-lg p-1"
                style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                Liste des Fonctions
            </h1>
            <!-- ===========================================================================Bouton Ajouter fonction -->
            <button id="showFormBtnFonction"
                class="flex right btn m-1 bg-gray-900 h-8 w-auto text-gray-100 hover:bg-gray-800
                 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                <i class="fa-solid fa-briefcase fa-lg" style="color: #74C0FC;"></i>Ajouter une fonction
            </button>
        </div>

        <div class="w-full w-4xl mx-auto bg-white rounded-lg shadow-lg shadow-[0_4px_20px_rgba(59,130,246,0.6)]">
            <div class="mt-4">
                @include('pages.fonction.liste_fonction')
            </div>
        </div>
    </div>

    <!-- ===========================================================================Formulaire d'ajout fonction caché par défaut -->
    <div id="sidePanelFonction"
        class="fixed inset-0 flex items-center justify-center
            opacity-0 scale-0 pointer-events-none
            transition-all duration-500 ease-out">

        <div class="p-4">
            <div class="p-4 flex justify-between items-center bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24" fill="currentColor" class="text-blue-900">
                    <path d="M20 6h-4V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2H4a2 2 0 00-2 2v11a2 2 0 002 2h16a2 2 0 002-2V8a2 2 0 00-2-2zM10 4h4v2h-4V4z" />
                </svg>
                <h2 class="uppercase text-xl md:text-xl text-blue-900 dark:text-gray-100"
                    style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                    Créer une nouvelle fonction</h2>
                <button id="closeFormBtnFonction" class="text-gray-600 text-4xl hover:text-red-600">&times;</button>
            </div>

            <div class="shadow-lg bg-white">
                <form action="{{ route('store.fonctions') }}" method="POST"
                    class="border rounded-lg shadow space-y-2 text-sm">
                    @csrf
                    @include('pages.fonction.Ajouter_Fonction')
                </form>
            </div>
        </div>
    </div>

    <!-- ================================================= Boîte de confirmation suppression d'une fonction -->
    <div id="customConfirmFonction"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <p class="text-lg text-red-400 font-semibold mb-4">Êtes-vous sûr de
                vouloir supprimer cette fonction ?</p>
            <div class="flex justify-center gap-4">
                <button id="confirmYesFonction" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Oui</button>
                <button id="confirmNoFonction" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Annuler</button>
            </div>
        </div>
    </div>

    <!-- =================================================================== Script pour afficher/masquer le formulaire -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let showFormBtn = document.getElementById("showFormBtnFonction");
            let closeFormBtn = document.getElementById("closeFormBtnFonction");
            let sidePanel = document.getElementById("sidePanelFonction");

            if (showFormBtn && closeFormBtn && sidePanel) {
                showFormBtn.addEventListener("click", function() {
                    sidePanel.classList.remove("opacity-0", "scale-0", "pointer-events-none");
                    sidePanel.classList.add("opacity-100", "scale-100");
                });

                closeFormBtn.addEventListener("click", function() {
                    sidePanel.classList.remove("opacity-100", "scale-100");
                    sidePanel.classList.add("opacity-0", "scale-0", "pointer-events-none");
                });

                document.addEventListener("keydown", function(e) {
                    if (e.key === "Escape") {
                        sidePanel.classList.remove("opacity-100", "scale-100");
                        sidePanel.classList.add("opacity-0", "scale-0", "pointer-events-none");
                    }
                });
            }
        });
    </script>

    <!-- =================================================================== confirmation suppression fonction -->
    <script>
        function openCustomConfirmFonction(event, form) {
            event.preventDefault();

            const modal = document.getElementById("customConfirmFonction");
            modal.classList.remove("hidden");

            document.getElementById("confirmYesFonction").onclick = function() {
                modal.classList.add("hidden");
                form.submit();
            };

            document.getElementById("confirmNoFonction").onclick = function() {
                modal.classList.add("hidden");
            };

            return false;
        }
    </script>

    <!-- Script pour afficher/masquer le panel de succès -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let successPanel = document.getElementById("successPanel");
            let closeSuccessBtn = document.getElementById("closeSuccessBtn");

            if (successPanel) {
                setTimeout(() => successPanel.classList.remove("translate-x-full"), 500);
                setTimeout(() => successPanel.classList.add("opacity-0", "pointer-events-none"), 5000);
                closeSuccessBtn.addEventListener("click", function() {
                    successPanel.classList.add("translate-x-full");
                });
            }
        });
    </script>
</x-app-layout>
