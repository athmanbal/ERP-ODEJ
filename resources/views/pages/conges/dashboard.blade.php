<x-app-layout>

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold text-gray-900">Gestion des congés</h2>
        <button type="button"
                onclick="document.getElementById('modal-nouveau-conge').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
            + Nouveau congé
        </button>
    </div>

    @include('pages.conges.partials.nav')

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="rounded-lg shadow p-5 bg-amber-500 text-white">
            <div class="text-3xl font-bold">{{ $stats['en_attente'] }}</div>
            <div class="text-sm opacity-90">Demandes en attente</div>
        </div>
        <div class="rounded-lg shadow p-5 bg-sky-500 text-white">
            <div class="text-3xl font-bold">{{ $stats['en_conge_aujourdhui'] }}</div>
            <div class="text-sm opacity-90">En congé aujourd'hui</div>
        </div>
        <div class="rounded-lg shadow p-5 bg-emerald-500 text-white">
            <div class="text-3xl font-bold">{{ $stats['jours_pris_annee'] }}</div>
            <div class="text-sm opacity-90">Jours pris ({{ now()->year }})</div>
        </div>
        <div class="rounded-lg shadow p-5 bg-gray-500 text-white">
            <div class="text-3xl font-bold">{{ $fonctionnaires->count() }}</div>
            <div class="text-sm opacity-90">Fonctionnaires</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-5">
            <div class="bg-white rounded-lg shadow h-full">
                <div class="px-5 py-3 border-b border-gray-200 font-medium text-gray-700">
                    Répartition par type ({{ now()->year }})
                </div>
                <div class="p-5">
                    <canvas id="chartTypes"></canvas>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7">
            <div class="bg-white rounded-lg shadow h-full">
                <div class="px-5 py-3 border-b border-gray-200 font-medium text-gray-700">
                    Solde annuel par fonctionnaire
                    <span class="text-xs text-gray-400 font-normal">(droit annuel − jours consommés, calculé en direct)</span>
                </div>
                @include('pages.conges.partials.table-solde-recherche')
            </div>
        </div>
    </div>
</div>

@include('pages.conges.partials.modal-nouveau-conge')

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
    options: { plugins: { legend: { position: 'bottom' } } }
});
</script>

</x-app-layout>
