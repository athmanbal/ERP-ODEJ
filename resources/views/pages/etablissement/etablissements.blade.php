<x-app-layout>
    @if (session('message'))
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

        <!-- Fil d'ariane -->
        <div
            class="col-span-6 flex items-center justify-start gap-2 py-2 px-4 bg-white rounded-lg shadow-sm border border-blue-100 mt-2 mb-4">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                    <path d="M12 2.1L1 10h2v11h6v-7h6v7h6V10h2L12 2.1z" />
                </svg>
                <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">accueil</span>
            </a>
            <span class="mx-2 flex items-center justify-center bg-white rounded-full p-1">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 3L11 8L5 13" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <a href="{{ route('etablissements') }}"
                class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                <i class="fa-solid fa-building text-violet-500"></i>
                <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">Établissements</span>
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-------------------------------------------------------------Liste des établissements -->
        <div class="flex justify-between items-center">
            <h1 class="bg-blue-600 text-xl text-white bg-opacity-50 shadow-2xl hover:shadow-lg transition-all rounded-lg p-1"
                style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                Liste des Établissements
            </h1>
            <button id="showFormBtnEtab"
                class="flex right btn m-1 bg-gray-900 h-8 w-auto text-gray-100 hover:bg-gray-800
                 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                <i class="fa-solid fa-building fa-lg" style="color: #74C0FC;"></i>Ajouter un établissement
            </button>
        </div>

        <div class="w-full w-4xl mx-auto bg-white rounded-lg shadow-lg shadow-[0_4px_20px_rgba(59,130,246,0.6)]">
            <div class="mt-4">
                @include('pages.etablissement.liste_etablissement')
            </div>
        </div>
    </div>

    <!-- ===========================================================================Formulaire d'ajout caché par défaut -->
    <div id="sidePanelEtab"
        class="fixed inset-0 flex items-center justify-center
            opacity-0 scale-0 pointer-events-none
            transition-all duration-500 ease-out">

        <div class="p-4">
            <div class="p-4 flex justify-between items-center bg-gray-200">
                <i class="fa-solid fa-building text-blue-900 text-xl"></i>
                <h2 class="uppercase text-xl md:text-xl text-blue-900 dark:text-gray-100"
                    style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                    Créer un nouvel établissement</h2>
                <button id="closeFormBtnEtab" class="text-gray-600 text-4xl hover:text-red-600">&times;</button>
            </div>

            <div class="shadow-lg bg-white">
                <form action="{{ route('store.etablissements') }}" method="POST"
                    class="border rounded-lg shadow space-y-2 text-sm p-4">
                    @csrf

                    <div class="flex items-center space-x-2">
                        <label for="nom_etablissement" class="mr-4 w-2/6">Nom :</label>
                        <input type="text" id="nom_etablissement" name="nom_etablissement"
                            value="{{ old('nom_etablissement') }}"
                            class="border rounded px-2 py-1 text-sm" required>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="type_etablissement" class="mr-4 w-2/6">Type :</label>
                        <input type="text" id="type_etablissement" name="type_etablissement"
                            value="{{ old('type_etablissement') }}"
                            class="border rounded px-2 py-1 ml-10 text-sm">
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="address_etablissement" class="mr-4 w-2/6">Adresse :</label>
                        <input type="text" id="address_etablissement" name="address_etablissement"
                            value="{{ old('address_etablissement') }}"
                            class="border rounded px-2 py-1 ml-10 text-sm">
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="telFax_etablissement" class="mr-4 w-2/6">Tél / Fax :</label>
                        <input type="text" id="telFax_etablissement" name="telFax_etablissement"
                            value="{{ old('telFax_etablissement') }}"
                            class="border rounded px-2 py-1 ml-10 text-sm">
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="mail_etablissement" class="mr-4 w-2/6">E-mail :</label>
                        <input type="email" id="mail_etablissement" name="mail_etablissement"
                            value="{{ old('mail_etablissement') }}"
                            class="border rounded px-2 py-1 ml-10 text-sm">
                    </div>

                    <button type="submit"
                        class="mt-3 bg-gray-900 px-3 py-1 rounded text-gray-100 hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                        <span>Ajouter</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ================================================= Boîte de confirmation suppression -->
    <div id="customConfirmEtab"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <p class="text-lg text-red-400 font-semibold mb-4">Êtes-vous sûr de
                vouloir supprimer cet établissement ?</p>
            <div class="flex justify-center gap-4">
                <button id="confirmYesEtab" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Oui</button>
                <button id="confirmNoEtab" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Annuler</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Panneau d'ajout
            const showBtn = document.getElementById("showFormBtnEtab");
            const closeBtn = document.getElementById("closeFormBtnEtab");
            const panel = document.getElementById("sidePanelEtab");

            const openPanel = () => {
                panel.classList.remove("opacity-0", "scale-0", "pointer-events-none");
                panel.classList.add("opacity-100", "scale-100");
            };
            const closePanel = () => {
                panel.classList.remove("opacity-100", "scale-100");
                panel.classList.add("opacity-0", "scale-0", "pointer-events-none");
            };

            if (showBtn && closeBtn && panel) {
                showBtn.addEventListener("click", openPanel);
                closeBtn.addEventListener("click", closePanel);
                document.addEventListener("keydown", e => { if (e.key === "Escape") closePanel(); });
            }

            // Panneau de succès
            const successPanel = document.getElementById("successPanel");
            const closeSuccessBtn = document.getElementById("closeSuccessBtn");
            if (successPanel) {
                setTimeout(() => successPanel.classList.remove("translate-x-full"), 500);
                setTimeout(() => successPanel.classList.add("opacity-0", "pointer-events-none"), 5000);
                closeSuccessBtn.addEventListener("click", () => successPanel.classList.add("translate-x-full"));
            }
        });

        // Confirmation de suppression : une seule modale, le formulaire cible est mémorisé
        let formEtabToSubmit = null;

        function openCustomConfirmEtab(event, form) {
            event.preventDefault();
            formEtabToSubmit = form;
            document.getElementById("customConfirmEtab").classList.remove("hidden");
            return false;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("customConfirmEtab");

            document.getElementById("confirmYesEtab").onclick = function() {
                modal.classList.add("hidden");
                if (formEtabToSubmit) formEtabToSubmit.submit();
            };
            document.getElementById("confirmNoEtab").onclick = function() {
                modal.classList.add("hidden");
                formEtabToSubmit = null;
            };
        });
    </script>
</x-app-layout>
