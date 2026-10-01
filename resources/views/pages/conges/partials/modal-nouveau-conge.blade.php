<div class="modal fade" id="modalNouveauConge" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('conges.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvelle demande de congé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Fonctionnaire</label>
                        <select name="id_fonctionnaire" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($fonctionnaires as $f)
                                <option value="{{ $f->id_fonctionnaire }}" {{ old('id_fonctionnaire') == $f->id_fonctionnaire ? 'selected' : '' }}>
                                    {{ $f->nom_fonctionnaire }} {{ $f->prenom_fonctionnaire }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type de congé</label>
                        <select name="type_conge" class="form-select" required>
                            <option value="annuel">Annuel</option>
                            <option value="maladie">Maladie</option>
                            <option value="exceptionnel">Exceptionnel</option>
                            <option value="maternite">Maternité</option>
                            <option value="sans_solde">Sans solde</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Date de départ</label>
                            <input type="date" name="date_depart" class="form-control" value="{{ old('date_depart') }}" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Date de retour</label>
                            <input type="date" name="date_retour" class="form-control" value="{{ old('date_retour') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motif (facultatif)</label>
                        <textarea name="motif" class="form-control" rows="2">{{ old('motif') }}</textarea>
                    </div>
                    @error('date_retour')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
