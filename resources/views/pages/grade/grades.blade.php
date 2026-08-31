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
            <a href="{{ route('grades') }}"
                class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">Grades</span>
            </a>
        </div>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2 mb-4">
            <x-dropdown-filter align="right" />
            <x-datepicker />
        </div>

        <!-------------------------------------------------------------Liste des grades -->
        <div class="flex justify-between items-center">
            <h1 class="bg-blue-600 text-xl text-white bg-opacity-50 shadow-2xl hover:shadow-lg transition-all rounded-lg p-1"
                style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                Liste des Grades
            </h1>
            <button id="showFormBtnGrade"
                class="flex right btn m-1 bg-gray-900 h-8 w-auto text-gray-100 hover:bg-gray-800
                 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                <i class="fa-solid fa-medal fa-lg" style="color: #74C0FC;"></i>Ajouter un grade
            </button>
        </div>

        <div class="w-full w-4xl mx-auto bg-white rounded-lg shadow-lg shadow-[0_4px_20px_rgba(59,130,246,0.6)]">
            <div class="mt-4">
                @include('pages.grade.liste_grade')
            </div>
        </div>
    </div>

    <!-- ===========================================================================Formulaire d'ajout grade caché par défaut -->
    <div id="sidePanelGrade"
        class="fixed inset-0 flex items-center justify-center
            opacity-0 scale-0 pointer-events-none
            transition-all duration-500 ease-out">

        <div class="p-4">
            <div class="p-4 flex justify-between items-center bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24" fill="currentColor" class="text-blue-900">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                <h2 class="uppercase text-xl md:text-xl text-blue-900 dark:text-gray-100"
                    style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                    Créer un nouveau grade</h2>
                <button id="closeFormBtnGrade" class="text-gray-600 text-4xl hover:text-red-600">&times;</button>
            </div>

            <div class="shadow-lg bg-white">
                <form action="{{ route('store.grades') }}" method="POST"
                    class="border rounded-lg shadow space-y-2 text-sm p-4">
                    @csrf

                    <div class="flex items-center space-x-2">
                        <label for="code_grade" class="mr-4 w-2/6">Code grade :</label>
                        <input type="text" id="code_grade" name="code_grade"
                            value="{{ old('code_grade') }}"
                            class="border rounded px-2 py-1 text-sm" required>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="nom_grade" class="mr-4 w-2/6">Nom du grade :</label>
                        <input type="text" id="nom_grade" name="nom_grade"
                            value="{{ old('nom_grade') }}"
                            class="border rounded px-2 py-1 ml-10 text-sm" required>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="bonification" class="mr-4 w-2/6">Bonification :</label>
                        <input type="number" step="0.01" id="bonification" name="bonification"
                            value="{{ old('bonification') }}" min="0"
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

    <!-- ================================================= Boîte de confirmation suppression d'un grade -->
    <div id="customConfirmGrade"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <p class="text-lg text-red-400 font-semibold mb-4">Êtes-vous sûr de
                vouloir supprimer ce grade ?</p>
            <div class="flex justify-center gap-4">
                <button id="confirmYesGrade" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Oui</button>
                <button id="confirmNoGrade" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Annuler</button>
            </div>
        </div>
    </div>

    <!-- =================================================================== Script pour afficher/masquer le formulaire -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let showFormBtn = document.getElementById("showFormBtnGrade");
            let closeFormBtn = document.getElementById("closeFormBtnGrade");
            let sidePanel = document.getElementById("sidePanelGrade");

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

    <!-- =================================================================== confirmation suppression grade -->
    <script>
        function openCustomConfirmGrade(event, form) {
            event.preventDefault();

            const modal = document.getElementById("customConfirmGrade");
            modal.classList.remove("hidden");

            document.getElementById("confirmYesGrade").onclick = function() {
                modal.classList.add("hidden");
                form.submit();
            };

            document.getElementById("confirmNoGrade").onclick = function() {
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
