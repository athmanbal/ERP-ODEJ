<x-app-layout>
    <div class="w-11/12 max-w-9xl mx-auto">

        <div
            class="col-span-6 flex items-center justify-start gap-2 py-2 px-4 bg-white rounded-lg shadow-sm border border-blue-100 mt-2 mb-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">accueil</span>
            </a>
            <span class="mx-2">→</span>
            <a href="{{ route('etablissements') }}" class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">Établissements</span>
            </a>
            <span class="mx-2">→</span>
            <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide text-gray-500">Modifier</span>
        </div>

        <h1 class="bg-blue-600 text-xl text-white bg-opacity-50 shadow-2xl hover:shadow-lg transition-all rounded-lg p-1 mb-4"
            style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
            Modifier l'établissement : {{ $etablissement->nom_etablissement }}
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
            <form action="{{ route('etablissements.update', $etablissement->id_etablissement) }}" method="POST" class="space-y-2 text-sm">
                @csrf
                @method('PUT')

                <div class="flex items-center space-x-2">
                    <label for="nom_etablissement" class="mr-4 w-2/6">Nom :</label>
                    <input type="text" id="nom_etablissement" name="nom_etablissement"
                        value="{{ old('nom_etablissement', $etablissement->nom_etablissement) }}"
                        class="border rounded px-2 py-1 text-sm w-2/3" required>
                </div>

                <div class="flex items-center space-x-2">
                    <label for="type_etablissement" class="mr-4 w-2/6">Type :</label>
                    <input type="text" id="type_etablissement" name="type_etablissement"
                        value="{{ old('type_etablissement', $etablissement->type_etablissement) }}"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex items-center space-x-2">
                    <label for="address_etablissement" class="mr-4 w-2/6">Adresse :</label>
                    <input type="text" id="address_etablissement" name="address_etablissement"
                        value="{{ old('address_etablissement', $etablissement->address_etablissement) }}"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex items-center space-x-2">
                    <label for="telFax_etablissement" class="mr-4 w-2/6">Tél / Fax :</label>
                    <input type="text" id="telFax_etablissement" name="telFax_etablissement"
                        value="{{ old('telFax_etablissement', $etablissement->telFax_etablissement) }}"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex items-center space-x-2">
                    <label for="mail_etablissement" class="mr-4 w-2/6">E-mail :</label>
                    <input type="email" id="mail_etablissement" name="mail_etablissement"
                        value="{{ old('mail_etablissement', $etablissement->mail_etablissement) }}"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex gap-2 mt-4">
                    <button type="submit"
                        class="bg-gray-900 px-3 py-1 rounded text-gray-100 hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                        <span>Modifier</span>
                    </button>
                    <a href="{{ route('etablissements') }}"
                        class="bg-gray-300 px-3 py-1 rounded text-gray-800 hover:bg-gray-400">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
