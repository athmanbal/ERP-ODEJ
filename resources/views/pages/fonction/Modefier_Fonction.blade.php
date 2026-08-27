<x-app-layout>
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
            <a href="{{ route('fonctions') }}"
                class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">Fonctions</span>
            </a>
            <span class="mx-2 flex items-center justify-center bg-white rounded-full p-1">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 3L11 8L5 13" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide text-gray-500">Modifier</span>
        </div>

        <h1 class="bg-blue-600 text-xl text-white bg-opacity-50 shadow-2xl hover:shadow-lg transition-all rounded-lg p-1 mb-4"
            style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
            Modifier la fonction : {{ $fonction->nom_fonction }}
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-4 rounded-lg shadow-lg shadow-[0_4px_20px_rgba(59,130,246,0.6)]">
            <form action="{{ route('fonctions.update', $fonction->id_fonction) }}" method="POST" class="space-y-2 text-sm">
                @csrf
                @method('PUT')

                <div class="flex items-center space-x-2">
                    <label for="nom_fonction" class="mr-4 w-2/6">Nom de la fonction :</label>
                    <input type="text" id="nom_fonction" name="nom_fonction"
                        value="{{ old('nom_fonction', $fonction->nom_fonction) }}"
                        class="border rounded px-2 py-1 text-sm w-2/3" required>
                </div>

                <div class="flex items-center space-x-2">
                    <label for="code_fonction" class="mr-4 w-2/6">Code fonction :</label>
                    <input type="text" id="code_fonction" name="code_fonction"
                        value="{{ old('code_fonction', $fonction->code_fonction) }}"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3" required>
                </div>

                <div class="flex items-center space-x-2">
                    <label for="section" class="mr-4 w-2/6">Section :</label>
                    <input type="text" id="section" name="section"
                        value="{{ old('section', $fonction->section) }}"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex items-center space-x-2">
                    <label for="niveau" class="mr-4 w-2/6">Niveau :</label>
                    <input type="number" id="niveau" name="niveau"
                        value="{{ old('niveau', $fonction->niveau) }}" min="0"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex items-center space-x-2">
                    <label for="taux_prime" class="mr-4 w-2/6">Taux prime :</label>
                    <input type="number" step="0.01" id="taux_prime" name="taux_prime"
                        value="{{ old('taux_prime', $fonction->taux_prime) }}" min="0"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex items-center space-x-2">
                    <label for="valeur_indiciere" class="mr-4 w-2/6">Valeur indiciaire :</label>
                    <input type="number" step="0.01" id="valeur_indiciere" name="valeur_indiciere"
                        value="{{ old('valeur_indiciere', $fonction->valeur_indiciere) }}" min="0"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex items-center space-x-2">
                    <label for="id_corps" class="mr-4 w-2/6">Corps :</label>
                    <select id="id_corps" name="id_corps" class="border rounded px-2 py-1 ml-10 text-sm w-2/3" required>
                        <option value="">-- Choisir un corps --</option>
                        @foreach ($corps as $c)
                            <option value="{{ $c->Id_Corps }}"
                                {{ old('Id_Corps', $fonction->id_corps) == $c->Id_Corps ? 'selected' : '' }}>
                                {{ $c->Nom_Corps }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2 mt-4">
                    <button type="submit"
                        class="bg-gray-900 px-3 py-1 rounded text-gray-100 hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                        <span>Modifier</span>
                    </button>
                    <a href="{{ route('fonctions') }}"
                        class="bg-gray-300 px-3 py-1 rounded text-gray-800 hover:bg-gray-400">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
