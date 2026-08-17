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
        <div
            class="flex items-center bg-blue-600  bg-opacity-50 shadow-2xl  hover:shadow-lg transition-all rounded-lg   w-1/4  py-1">

            <h2 class="uppercase text-xl md:text-xl  text-white dark:text-gray-100"
                style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                </i><i class="fa-solid fa-file-lines"></i>
                <span>Fiche personel</span>
            </h2>


        </div>

        <div class="grid grid-cols-12 gap-2 bg-white  shadow-md hover:shadow-lg transition-all rounded-lg  w-full">
            <!-- Photo -->
            <div class="col-span-1 flex flex-col items-center justify-center">
                <!-- bloc photo de fonctionnaire -->
                <div class="relative group rounded-md overflow-hidden w-20 h-20 bg-gray-50">
                    <label for="photoInput_{{ $Fonct->id_fonctionnaire }}"
                        class="absolute inset-0 flex items-center justify-center
                                  bg-black/50 text-white text-sm font-semibold
                                  opacity-0 group-hover:opacity-100 transition duration-300
                                  cursor-pointer z-10">
                        Modifier
                    </label>
                    @forelse($Fonct->getMedia('photo') as $mediaItem)
                        <img class="w-full h-full object-cover"
                             src="{{ $mediaItem->getUrl() }}"
                             alt="{{ $mediaItem->name }}"
                        />
                    @empty
                        <span class="text-gray-400 text-xs flex items-center justify-center w-full h-full">Aucune
                            photo
                        </span>
                    @endforelse

                    <!-- Overlay au survol -->


                    <!-- Input file caché -->
                    <form action="{{ route('fonctionnaire.updatePhoto', $Fonct->id_fonctionnaire) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="photo" id="photoInput_{{ $Fonct->id_fonctionnaire }}"
                            class="hidden" onchange="this.form.submit()">
                    </form>
                </div>

                <!-- Matricule -->
                <span class="mt-1 px-2 py-1 bg-blue-700 text-white text-xs rounded font-bold">
                    {{ $Fonct->matricule_fonctionnaire }}
                </span>
            </div>


            <div class="col-span-10 grid grid-cols-3 gap-2 text-sm">
                <div class="col-span-3 mb-1 pl-24 my-4">
                    <span
                        class="uppercase text-base  text-black px-2 py-2  rounded font-bold">{{ $Fonct->nom_fonction }}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-xs">Date de naissance :</span><br>
                    <span class="font-bold text-gray-800">{{ $Fonct->date_naissance->format('Y-m-d') }}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-xs">Téléphone :</span><br>
                    <span class="font-bold text-gray-800">{{ $Fonct->telephone }}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-xs">Date de recrutement :</span><br>
                    <span class="font-bold text-gray-800">{{ $Fonct->date_recretement->format('Y-m-d')  }}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-xs">Nombre d'échelon :</span><br>
                    <span class="font-bold text-gray-800">{{ $Fonct->id_echelon }}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-xs">Établissement :</span><br>
                    <span class="font-bold text-gray-800">{{ $Fonct->nom_etablissement }}</span>
                </div>
            </div>


        </div>
        <!-------------------------------------------------------------Listes des fonctionnaires grouper par corps -->

        <!-- Menu horizontal des documents administratifs -->
        <nav
            class="w-full bg-white border-t border-gray-300 shadow-sm mb-6  rounded-lg
        hover:border-solid hover:border-gray-100 hover:border-2">
            <ul class="flex flex-row items-center justify-center gap-0"
                style="text-shadow: 2px 2px 4px rgba(24, 7, 132, 0.5);">
                <li class="flex-1 ">
                    <a href="#"
                        class="block text-center px-6 py-3 transition-all duration-200 font-medium text-blue-800 border-r border-gray-200 last:border-r-0 hover:bg-blue-100 hover:text-blue-900 rounded-t-lg">
                        Attestation de travail </i><i class="fa-solid fa-file-lines"></i></a>
                </li>
                <li class="flex-1">
                    <a href="#"
                        class="block text-center px-6 py-3 transition-all duration-200 font-medium text-blue-800 border-r border-gray-200 last:border-r-0 hover:bg-blue-100 hover:text-blue-900 rounded-t-lg">
                        Congé <i class="fa-solid fa-file-lines"></i></a>
                </li>
                <li class="flex-1">
                    <a href="#"
                        class="block text-center px-6 py-3 transition-all duration-200 font-medium text-blue-800 hover:bg-blue-100 hover:text-blue-900 rounded-t-lg">
                        Carte professionnelle <i class="fa-solid fa-file-lines"></i></a>
                </li>
            </ul>
        </nav>
        <!-------------------------------------------------------------Listes des fonctionnaires grouper par corps -->



        <div class="flex justify-between items-center m-0 b-0 w-full">

            <div
                class="flex items-center bg-blue-600  bg-opacity-50 shadow-2xl  hover:shadow-lg transition-all rounded-lg   w-2/4  py-0">

                <h2 class="uppercase text-xl md:text-xl  text-white dark:text-gray-100"
                    style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
                    </i><i class="fa-solid fa-file-lines"></i>
                    <span>liste des docs administratifs</span>
                </h2>

            </div>
            <button id="showFormBtn"
                class="flex items-center  btn m-0   bg-gray-900 h-8 w-24  text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M0 1a.75.75 0 0 1 .75.75V7.25H14a.75.75 0 0 1 0 1.5H8.75V14a.75.75 0 0 1-1.5 0V8.75H2a.75.75 0 0 1 0-1.5h5.25V1.75A.75.75 0 0 1 8 1z" />
                </svg>
                <i class="fa-solid fa-file-lines mr-2"></i>
                Ajouter
            </button>
        </div>

        <div class="bg-white  shadow-md hover:shadow-lg transition-all rounded-lg  w-full">

            <!-- fichier de fonctionaire actives -->



            <!--            --------------------------------------------------------------------------- affiche docs par type -->
            @forelse($Fonct->media->groupBy('collection_name') as $collectionName => $mediaItems)
                <div class="shadow-md m-0 mt-0 p-0  w-full">
                    <h2 style="text-shadow: 2px 2px 4px rgba(24, 7, 132, 0.5);"
                        class="block text-center px-6 py-3 transition-all duration-200 font-medium text-blue-800 border-r border-gray-200 last:border-r-0 hover:bg-blue-50 hover:text-blue-900 rounded-t-lg">

                        <span>{{ $collectionName }}</span>
                    </h2>
                    <table id="TableFonctionaires" class="w-full bg-white text-left text-sm text-gray-500">
                        <thead class="bg-white">
                            <tr class=" text-blue-900  text-sm font-normal">
                                <th scope="col" class="px-3 py-2 w-1/2 text-left rounded-tl-lg font-normal">
                                    <i class="fa-solid fa-file-lines mr-1"></i> Nom du document
                                </th>
                                <th scope="col" class="px-3 py-2 text-left font-normal">
                                    <i class="fa-solid fa-hashtag mr-1"></i> N° Doc
                                </th>
                                <th scope="col" class="px-3 py-2 text-left font-normal">
                                    <i class="fa-solid fa-calendar-days mr-1"></i> Date
                                </th>
                                <th scope="col" class="px-3 py-2 text-left rounded-tr-lg font-normal">
                                    <i class="fa-solid fa-gear mr-1"></i> Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-blue-900 ">
                            @foreach ($mediaItems as $media)
                                <tr class="hover:bg-blue-50 transition-all">
                                    <td class="py-2 px-3 text-gray-900 align-middle">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-file-pdf text-red-600 text-xl"></i>
                                            <span class="font-medium">{{ $media->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-2 px-3 text-gray-900  align-middle">
                                        {{ $media->getCustomProperty('NumDocs') }}
                                    </td>
                                    <td class="py-2 px-3 text-gray-900  align-middle">
                                        {{ $media->getCustomProperty('datedifie') }}
                                    </td>
                                    <td class="py-2 px-3 text-gray-900 font-medium align-middle">
                                        <div class="flex justify-end gap-2">
                                            <button data-bs-toggle="modal" data-bs-target="#pdfModal"
                                                data-pdf="{{ $media->getUrl() }}"
                                                class="btn p-1 border-0 border-b-2 border-blue-700 text-blue-900 hover:bg-blue-700 hover:text-white transition-colors rounded"
                                                title="Voir PDF">
                                                <i class="fa-solid fa-eye"></i>
                                           </button>



                                            <form
                                                action="{{ route('fonctionnaires.deleteMedia', ['id_fonctionnaire' => $Fonct->id_fonctionnaire, 'id' => $media->id]) }}"
                                                method="POST" onsubmit="return openCustomConfirm(event, this);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn p-1 border-0 border-b-2 border-red-800  text-red-900 hover:bg-red-500 hover:text-red-100 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                                                    <i class="fa-solid fa-trash"></i>

                                                </button>

                                            </form>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>





                </div>

            @empty
                <p>Aucun fichier trouvé pour cet employé.</p>
            @endforelse





        </div>

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
                                <option value="Decision_promotion--  مقررات الترقية ">Decision_promotion--  مقررات الترقية </option>
                                <option value="Decision_échelon--  مقررات ترقية في الدرجة">Decision_échelon--  مقررات ترقية في الدرجة</option>
                                <option value="Pévé d'instalation محضر التعيين"> Pévé d'instalation محضر التعيين</option>
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
    <!-- =================================================================== Script pour afficher/masquer le formulaire -->
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
