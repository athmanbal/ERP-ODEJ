<div class="p-4 space-y-2">
    <div class="flex items-center space-x-2">
        <label for="nom_fonction" class="mr-4 w-2/6">Nom de la fonction :</label>
        <input type="text" id="nom_fonction" name="nom_fonction"
            value="{{ old('nom_fonction') }}"
            class="border rounded px-2 py-1 text-sm" required>
    </div>

    <div class="flex items-center space-x-2">
        <label for="code_fonction" class="mr-4 w-2/6">Code fonction :</label>
        <input type="text" id="code_fonction" name="code_fonction"
            value="{{ old('code_fonction') }}"
            class="border rounded px-2 py-1 ml-10 text-sm" required>
    </div>

    <div class="flex items-center space-x-2">
        <label for="section" class="mr-4 w-2/6">Section :</label>
        <input type="text" id="section" name="section"
            value="{{ old('section') }}"
            class="border rounded px-2 py-1 ml-10 text-sm">
    </div>

    <div class="flex items-center space-x-2">
        <label for="niveau" class="mr-4 w-2/6">Niveau :</label>
        <input type="number" id="niveau" name="niveau"
            value="{{ old('niveau') }}" min="0"
            class="border rounded px-2 py-1 ml-10 text-sm">
    </div>

    <div class="flex items-center space-x-2">
        <label for="taux_prime" class="mr-4 w-2/6">Taux prime :</label>
        <input type="number" step="0.01" id="taux_prime" name="taux_prime"
            value="{{ old('taux_prime') }}" min="0"
            class="border rounded px-2 py-1 ml-10 text-sm">
    </div>

    <div class="flex items-center space-x-2">
        <label for="valeur_indiciere" class="mr-4 w-2/6">Valeur indiciaire :</label>
        <input type="number" step="0.01" id="valeur_indiciere" name="valeur_indiciere"
            value="{{ old('valeur_indiciere') }}" min="0"
            class="border rounded px-2 py-1 ml-10 text-sm">
    </div>

    <div class="flex items-center space-x-2">
        <label for="id_corps" class="mr-4 w-2/6">Corps :</label>
        <select id="id_corps" name="id_corps" class="border rounded px-2 py-1 ml-10 text-sm" required>
            <option value="">-- Choisir un corps --</option>
            @foreach ($corps as $c)
                <option value="{{ $c->Id_Corps }}" {{ old('Id_Corps') == $c->Id_Corps ? 'selected' : '' }}>
                    {{ $c->Nom_Corps }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit"
        class="mt-3 bg-gray-900 px-3 py-1 rounded text-gray-100 hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
        <span>Ajouter</span>
    </button>
</div>
