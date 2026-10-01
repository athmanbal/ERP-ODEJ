<x-app-layout>
    <div class="  w-11/12 max-w-9xl mx-auto">
    <!-- Left: Title -->



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
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 3L11 8L5 13" stroke="#222" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </span>
        <a href="{{ route('conges.dashboard') }}"
            class="flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold transition-colors">
            <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4" />
                <path d="M12 14c-5 0-9 2.5-9 6v2h18v-2c0-3.5-4-6-9-6z" />
            </svg>
            <span class="text-lg md:text-xl uppercase font-sans font-light tracking-wide">Gestion des Congés</span>
        </a>
    </div>



    <div>

        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Gestion des congés</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalNouveauConge">
                    <i class="bi bi-plus-circle"></i> Nouveau congé
                </button>
            </div>

            @include('pages.conges.partials.nav')

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card text-bg-warning">
                        <div class="card-body">
                            <div class="fs-3 fw-bold">{{ $stats['en_attente'] }}</div>
                            <div>Demandes en attente</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-info">
                        <div class="card-body">
                            <div class="fs-3 fw-bold">{{ $stats['en_conge_aujourdhui'] }}</div>
                            <div>En congé aujourd'hui</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-success">
                        <div class="card-body">
                            <div class="fs-3 fw-bold">{{ $stats['jours_pris_annee'] }}</div>
                            <div>Jours pris ({{ now()->year }})</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-secondary">
                        <div class="card-body">
                            <div class="fs-3 fw-bold">{{ $fonctionnaires->count() }}</div>
                            <div>Fonctionnaires</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 mb-4">
                    <div class="card h-100">
                        <div class="card-header">Répartition par type ({{ now()->year }})</div>
                        <div class="card-body">
                            <canvas id="chartTypes"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            Solde annuel par fonctionnaire
                            <span class="text-muted small">(droit annuel − jours consommés, calculé en direct)</span>
                        </div>
                        <div class="card-body p-0" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-sm table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Fonctionnaire</th>
                                        <th class="text-end">Solde restant</th>
                                        <th class="text-end">Détail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fonctionnaires as $f)
                                        <tr>
                                            <td>{{ $f->nom_fonctionnaire }} {{ $f->prenom_fonctionnaire }}</td>
                                            <td class="text-end">
                                                <span class="badge {{ $f->solde <= 5 ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $f->solde }} j
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('conges.historique', $f->id_fonctionnaire) }}"
                                                    class="btn btn-sm btn-outline-secondary">
                                                    Historique
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('pages.conges.partials.modal-nouveau-conge')
    </div>
</x-app-layout>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        new Chart(document.getElementById('chartTypes'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_map('ucfirst', array_keys($stats['par_type']->toArray()))) !!},
                datasets: [{
                    data: {!! json_encode(array_values($stats['par_type']->toArray())) !!},
                    backgroundColor: ['#3788d8', '#e74c3c', '#f39c12', '#9b59b6', '#7f8c8d'],
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endpush
