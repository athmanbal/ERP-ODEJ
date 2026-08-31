<x-app-layout>
    <div class="w-11/12 max-w-9xl mx-auto">

        <div
            class="col-span-6 flex items-center justify-start gap-2 py-2 px-4 bg-white rounded-lg shadow-sm border border-blue-100 mt-2 mb-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">accueil</span>
            </a>
            <span class="mx-2">→</span>
            <a href="{{ route('grades') }}" class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
                <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">Grades</span>
            </a>
            <span class="mx-2">→</span>
            <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide text-gray-500">Modifier</span>
        </div>

        <h1 class="bg-blue-600 text-xl text-white bg-opacity-50 shadow-2xl hover:shadow-lg transition-all rounded-lg p-1 mb-4"
            style="text-shadow: 2px 4px 10px rgba(22, 3, 62, 0.971);">
            Modifier le grade : {{ $grade->nom_grade }}
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
            <form action="{{ route('grades.update', $grade->id_grade) }}" method="POST" class="space-y-2 text-sm">
                @csrf
                @method('PUT')

                <div class="flex items-center space-x-2">
                    <label for="code_grade" class="mr-4 w-2/6">Code grade :</label>
                    <input type="text" id="code_grade" name="code_grade"
                        value="{{ old('code_grade', $grade->code_grade) }}"
                        class="border rounded px-2 py-1 text-sm w-2/3" required>
                </div>

                <div class="flex items-center space-x-2">
                    <label for="nom_grade" class="mr-4 w-2/6">Nom du grade :</label>
                    <input type="text" id="nom_grade" name="nom_grade"
                        value="{{ old('nom_grade', $grade->nom_grade) }}"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3" required>
                </div>

                <div class="flex items-center space-x-2">
                    <label for="bonification" class="mr-4 w-2/6">Bonification :</label>
                    <input type="number" step="0.01" id="bonification" name="bonification"
                        value="{{ old('bonification', $grade->bonification) }}" min="0"
                        class="border rounded px-2 py-1 ml-10 text-sm w-2/3">
                </div>

                <div class="flex gap-2 mt-4">
                    <button type="submit"
                        class="bg-gray-900 px-3 py-1 rounded text-gray-100 hover:bg-gray-700 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                        <span>Modifier</span>
                    </button>
                    <a href="{{ route('grades') }}"
                        class="bg-gray-300 px-3 py-1 rounded text-gray-800 hover:bg-gray-400">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
