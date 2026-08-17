<div class="flex     h-auto bg-white gap-2 p-2">
    <!-- Colonne gauche -->


    <div class="bg-white w-1/2 p-3 overflow-y-auto space-y-2 rounded shadow"
        style="shadow: 2px 2px 10px rgba(22, 3, 62, 0.971);">
        <div style="text-shadow: 1px 1px 6px rgba(43, 2, 132, 0.971);>
            <h1 class="m-2 text-md font-bold">
            Détail Fonctionnaire </h1>
        </div>
        <div class="flex items-center space-x-2">
            <label for="non"
                class=" mr-4 w-2/6" ">Nom :</label>
            <input type="text" id="non" name="nom_fonctionnaire" class="    border rounded px-2 py-1 text-sm" required>
        </div>

        <div class="flex items-center space-x-2">
            <label for="prenon"         class=" mr-4 w-2/6" >Prénom :</label>
            <input type="text" id="prenon" name="prenom_fonctionnaire" class="     border rounded px-2 py-1 ml-10 text-sm"
                required>
        </div>

        <div class="flex items-center space-x-2">
            <label for="dateNaissance"         class=" mr-4 w-2/6" >Date de naissance :</label>
            <input type="date" id="dateNaissance" name="dateNaissance"
                class="    border rounded px-2 py-1 ml-10 text-sm" required>
        </div>

        <div class="flex items-center space-x-2">
            <label for="dateRecrutement"         class=" mr-4 w-2/6" >Date de recrutement :</label>
            <input type="date" id="dateRecrutement" name="dateRecrutement"
                class="    border rounded px-2 py-1 ml-10 text-sm" required>
        </div>

        <div class="flex items-center space-x-2">
            <label for="dateSortie"         class=" mr-4 w-2/6" >Date de sortie :</label>
            <input type="date" id="dateSortie" name="dateSortie"
                class="    border rounded px-2 py-1 ml-10 text-sm">
        </div class="flex items-center space-x-2">

        <div class="flex items-center space-x-2">
            <label for="sexe"         class=" mr-4 w-2/6" >Sexe :</label>
            <select id="sexe" name="sexe" class="    border rounded px-2 py-1 ml-10 text-sm" required>
                <option value="">-- Choisir --</option>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
        </div>

        <div class="flex items-center space-x-2">
            <label for="NSS"         class=" mr-4 w-2/6" >NSS :</label>
            <input type="text" id="NSS" name="NSS" class="    border rounded px-2 py-1 ml-10 text-sm"
                 pattern="^\d{12}$" title="Le NSS doit contenir exactement 11 chiffres">
        </div>

        <div class="flex items-center space-x-2">
            <label for="NombreEnfants"         class=" mr-4 w-2/6" >Nombre d'enfants :</label>
            <input type="number" id="NombreEnfants" name="NombreEnfants"
                class="    border rounded px-2 py-1 ml-10 text-sm" min="0">
        </div>

        <div class="flex items-center space-x-2">
            <label for="Telephone"         class=" mr-4 w-2/6" >Téléphone :</label>
            <input type="text" id="Telephone" name="Telephone"
                class="    border rounded px-2 py-1 ml-10 text-sm"  pattern="^0\d{9}$"
                title="Le numéro doit commencer par 0 et contenir 10 chiffres">
        </div>
    </div>

    <!-- Colonne droite -->


    <div class="bg-white w-1/2 p-3 overflow-y-auto space-y-2 rounded shadow">
        <div  style="text-shadow: 1px 1px 6px rgba(43, 2, 132, 0.971);>
            <h1 class="m-2 text-md font-bold">Détail Poste </h1>
        </div>
        <div>
            <div class="flex items-center space-x-2">
                <label for="id_grade" class=" mr-4 w-2/6">Grade :</label>
                <select id="id_grade" name="id_grade" class=" border rounded px-2 py-1 ml-10 text-sm">
                    <option value="">-- Choisir un grade --</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id_grade }}">
                            {{ $grade->nom_grade }} (Bonif: {{ $grade->bonification }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <label for="id_grade" class=" mr-4 w-2/6">Fonction :</label>
                <select id="id_fonction" name="id_fonction" class="  border rounded px-2 py-1 ml-1 w-4/6 text-sm"
                    required>
                    <option value="">-- Choisir une fonction --</option>
                    @foreach ($fonctions as $fonction)
                        <option value="{{ $fonction->id_fonction }}">
                            {{ $fonction->nom_fonction }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="flex items-center space-x-2">
                <label for="id_echelon" class=" mr-4 w-2/6">Nombre d'échlants :</label>
                <input type="number" id="id_echelon" name="id_echelon"
                    class="    border rounded px-2 py-1 ml-10 text-sm" min="0">
            </div>

            <div class="flex items-center space-x-2">

                <label for="id_service" class=" mr-4 w-2/6" ">Service :</label>
                <select id="id_service" name="id_service" class="    border rounded ml-10 px-2 py-1 ml-10 text-sm"
                   > /*required*/
                    <option value="">-- Choisir un service --</option>
                            @foreach ($services as $service)
                    <option value="{{ $service->id_service }}">{{ $service->nom_service }}</option>
                    @endforeach
                    </select>
            </div>

            <div class="flex items-center space-x-2">
                <label for="id_categorie" class=" mr-4 w-2/6" ">Catégorie :</label>
                <select id="id_categorie" name="id_categorie"
                    class="    border rounded px-2 py-1 ml-10 text-sm" required>
                    <option value="">-- Choisir une catégorie --</option>
                       @foreach ($categoriefonctionnaires as $categoriefonctionnaire)
                    <option value="{{ $categoriefonctionnaire->Id_CategorieFonctionnaire }}">
                        {{ $categoriefonctionnaire->Nom_CategorieFonctionnaire }}
                    </option>
                    @endforeach


                    </select>
            </div>

            <div class="flex items-center space-x-2">
                <label for="id_compte" class=" mr-4 w-2/6" ">Compte :</label>
                <select id="id_compte" name="id_compte" class="    border rounded px-2 py-1 ml-10 text-sm" >
                    <option value="">-- Choisir un compte --</option>
                            @foreach ($comptes as $compte)
                    <option value="{{ $compte->Id_Compte }}">
                        {{ $compte->Id_TypeCompte }}
                    </option>
                    @endforeach



                    </select>
            </div>

            <div class="flex items-center space-x-2">
                <label for="id_etablissement" class=" mr-4 w-2/6" ">Établissement :</label>


                    <select id="id_etablissement" name="id_etablissement"
                        class="    border rounded px-2 py-1 ml-10 text-sm" required>
                        <option value="">-- Choisir un établissement --</option>

                         @foreach ($etablisssemnts as $etablisssemnt)
                    <option value="{{ $etablisssemnt->id_etablissement }}">
                        {{ $etablisssemnt->nom_etablissement }}
                    </option>
                    @endforeach
                    </select>
            </div>


        </div>
        <button type="submit"
            class="mt-3 bg-gray-900 px-3 py-1 rounded text-gray-100 hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
            <span>Ajouter</span>
        </button>
    </div>
