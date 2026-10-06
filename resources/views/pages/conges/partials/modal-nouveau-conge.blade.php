<div id="modal-nouveau-conge" class="hidden fixed inset-0 z-50">
    <div class="fixed inset-0 bg-black/50"
        onclick="document.getElementById('modal-nouveau-conge').classList.add('hidden')"></div>

    <div class="relative flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md">
            <form action="{{ route('conges.store') }}" method="POST">
                @csrf
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Nouvelle demande de congé</h3>
                    <button type="button"
                        onclick="document.getElementById('modal-nouveau-conge').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">
                        <span class="text-2xl leading-none">&times;</span>
                    </button>
                </div>

                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fonctionnaire</label>
                        <select name="id_fonctionnaire" required
                            class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($fonctionnaires as $f)
                                <option value="{{ $f->id_fonctionnaire }}"
                                    {{ old('id_fonctionnaire') == $f->id_fonctionnaire ? 'selected' : '' }}>
                                    {{ $f->nom_fonctionnaire }} {{ $f->prenom_fonctionnaire }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de congé</label>
                        <select name="type_conge" required
                            class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="annuel">Annuel</option>
                            <option value="maladie">Maladie</option>
                            <option value="exceptionnel">Exceptionnel</option>
                            <option value="maternite">Maternité</option>
                            <option value="sans_solde">Sans solde</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date de départ</label>
                            <input type="date" name="date_depart" value="{{ old('date_depart') }}" required
                                class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date de retour</label>
                            <input type="date" name="date_retour" value="{{ old('date_retour') }}" required
                                class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lieu du congé</label>
                        <input type="text" name="lieu_conge" value="{{ old('lieu_conge') }}"
                            placeholder="Ville / adresse où le congé sera passé"
                            class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Motif (facultatif)</label>
                        <textarea name="motif" rows="2"
                            class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('motif') }}</textarea>
                    </div>

                    @error('date_retour')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                    <button type="button"
                        onclick="document.getElementById('modal-nouveau-conge').classList.add('hidden')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
    {{-- Rouvre automatiquement le modal si la soumission a échoué --}}
    <script>
        document.getElementById('modal-nouveau-conge').classList.remove('hidden');
    </script>
@endif
