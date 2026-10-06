<x-app-layout>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Gestion des congés</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNouveauConge">
                <i class="bi bi-plus-circle"></i> Nouveau congé
            </button>
        </div>

        @include('pages.conges.partials.nav')

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <label class="form-label">Fonctionnaire</label>
                <select id="select-fonctionnaire" class="form-select" style="max-width: 350px;"
                    onchange="if(this.value) window.location.href = '{{ url('/conges/historique') }}/' + this.value">
                    <option value="">-- Sélectionner un fonctionnaire --</option>
                    @foreach ($fonctionnaires as $f)
                        <option value="{{ $f->id_fonctionnaire }}"
                            {{ (string) $id_fonctionnaire === (string) $f->id_fonctionnaire ? 'selected' : '' }}>
                            {{ $f->nom_fonctionnaire }} {{ $f->prenom_fonctionnaire }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Historique des congés</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Départ</th>
                            <th>Retour</th>
                            <th>Jours</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($conges as $conge)
                            <tr>
                                <td>{{ ucfirst($conge->type_conge) }}</td>
                                <td>{{ $conge->date_depart->format('d/m/Y') }}</td>
                                <td>{{ $conge->date_retour->format('d/m/Y') }}</td>
                                <td>{{ $conge->nombre_jours }}</td>
                                <td>
                                    <span
                                        class="badge {{ ['en_attente' => 'bg-warning', 'approuve' => 'bg-success', 'refuse' => 'bg-danger'][$conge->statut] }}">
                                        {{ str_replace('_', ' ', $conge->statut) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($conge->statut === 'en_attente')
                                        <form action="{{ route('conges.statut', $conge->id_conge) }}" method="POST"
                                            class="inline">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="statut" value="approuve">
                                            <button
                                                class="text-green-600 hover:text-green-800 font-medium px-1">✓</button>
                                        </form>
                                        <form action="{{ route('conges.statut', $conge->id_conge) }}" method="POST"
                                            class="inline">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="statut" value="refuse">
                                            <button class="text-red-600 hover:text-red-800 font-medium px-1">✕</button>
                                        </form>
                                    @elseif($conge->statut === 'approuve')
                                        <a href="{{ route('conges.imprimer', $conge->id_conge) }}" target="_blank"
                                            class="text-xs font-medium text-green-700 border border-green-300 rounded-md px-2 py-1 hover:bg-green-600 hover:text-white">
                                            Imprimer
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    {{ $id_fonctionnaire ? 'Aucun congé enregistré pour ce fonctionnaire' : 'Sélectionnez un fonctionnaire pour voir son historique' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('pages.conges.partials.modal-nouveau-conge')

</x-app-layout>
