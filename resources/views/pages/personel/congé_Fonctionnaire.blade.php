<div class="flex h-auto bg-white gap-2 p-2">
    <!-- Colonne gauche -->
    <div class="bg-white w-1/2 p-3 overflow-y-auto space-y-2 rounded shadow">
        <div>
            <h1 class="m-2 text-md font-bold">Détail Fonctionnaire</h1>
        </div>
        <div class="flex items-center space-x-2">
            <label for="non" class="mr-4 w-2/6">Nom :</label>
            <input type="text" id="non" name="nom_fonctionnaire" value="{{ $Fonct->nom_fonctionnaire }}"
                class="border rounded px-2 py-1 text-sm" required>
        </div>

        <div class="flex items-center space-x-2">
            <label for="prenon" class="mr-4 w-2/6">Prénom :</label>
            <input type="text" id="prenon" name="prenom_fonctionnaire" value="{{ $Fonct->prenom_fonctionnaire }}"
                class="border rounded px-2 py-1 ml-10 text-sm" required>
        </div>

        <div class="flex items-center space-x-2">
            <label for="id_fonction" class="mr-4 w-2/6">Fonction :</label>
            <select id="id_fonction" name="id_fonction" class="border rounded px-2 py-1 ml-1 w-4/6 text-sm" required>
                <option value="">-- Choisir une fonction --</option>
                @foreach ($fonctions as $fonction)
                    <option value="{{ $fonction->id_fonction }}"
                        {{ $Fonct->id_fonction == $fonction->id_fonction ? 'selected' : '' }}>
                        {{ $fonction->nom_fonction }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center space-x-2">
            <label for="id_etablissement" class="mr-4 w-2/6">Établissement :</label>
            <select id="id_etablissement" name="id_etablissement" class="border rounded px-2 py-1 ml-10 text-sm"
                required>
                <option value="">-- Choisir un établissement --</option>
                @foreach ($etablisssemnts as $etablisssemnt)
                    <option value="{{ $etablisssemnt->id_etablissement }}"
                        {{ $Fonct->id_etablissement == $etablisssemnt->id_etablissement ? 'selected' : '' }}>
                        {{ $etablisssemnt->nom_etablissement }}
                    </option>
                @endforeach
            </select>
        </div>



    </div>

    <!-- Colonne droite -->
    <div class="bg-white w-1/2 p-3 overflow-y-auto space-y-2 rounded shadow">
        <div>
            <h1 class="m-2 text-md font-bold">Détail Congé demandé</h1>
        </div>
        <div>


            <div class="flex items-center space-x-2">
                <label for="dateNaissance" class="mr-4 w-2/6">Date de départ:</label>
                <input type="date" id="dateNaissance" name="dateNaissance"
                    value="{{ old('date_recrutement', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
            </div>

            <div class="flex items-center space-x-2">
                <label for="dateRecrutement" class="mr-4 w-2/6">Date de retour:</label>
                <input type="date" id="dateRecrutement" name="dateRecrutement"
                    value="{{ old('date_recrutement', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
            </div>

            <div class="flex items-center space-x-2">
                <label for="dateSortie" class="mr-4 w-2/6">Année de Congé :</label>

                <input type="text" id="dateSortie" name="dateSortie"
                    value="{{ $Fonct->date_sortie ? $Fonct->date_sortie->format('Y') : '' }}"
                    class="border rounded px-2 py-1 ml-10 text-sm" maxlength="4" placeholder="2026"
                      inputmode="numeric"
       pattern="[0-9]{4}"
       placeholder="2026"
       oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);">
            </div>





































        </div>

        <button type="submit"
            class="mt-3 bg-gray-900 px-3 py-1 rounded text-gray-100 hover:bg-gray-700 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white">
            <span>Confirmer</span>
        </button>
    </div>
</div>
