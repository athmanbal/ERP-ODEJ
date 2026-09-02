<x-app-layout>

    <div class="w-11/12 max-w-9xl mx-auto py-6 space-y-6">

        {{-- ============================================================ En-tête de page --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-xs font-medium text-ink-secondary uppercase tracking-wide mb-1">
                    Personnel
                </p>
                <h1 class="font-display text-2xl font-semibold text-navy-900">
                    Gestion du personnel
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <button class="h-10 w-10 flex items-center justify-center bg-white border border-navy-100 rounded-card text-ink-secondary hover:text-institutionnel hover:border-institutionnel-100 transition-colors">
                    <i class="fa-solid fa-sliders"></i>
                </button>
                <div class="h-10 flex items-center gap-2 px-4 bg-white border border-navy-100 rounded-card text-sm text-ink">
                    <i class="fa-regular fa-calendar text-ink-muted"></i>
                    <span>25 Août — 31 Août 2026</span>
                </div>
                <button class="h-10 px-4 flex items-center gap-2 bg-navy-900 text-white rounded-card text-sm font-medium hover:bg-navy-700 transition-colors">
                    <i class="fa-solid fa-plus"></i>
                    Ajouter une vue
                </button>
            </div>
        </div>

        {{-- ============================================================ Indicateurs clés (KPI) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="kpi-card" style="--kpi-accent: theme('colors.institutionnel.DEFAULT')">
                <p class="kpi-label mb-2">Fonctionnaires actifs</p>
                <p class="kpi-value">{{ $totalFonctionnaires ?? 0 }}</p>
                <p class="text-xs text-status-success mt-1">
                    <i class="fa-solid fa-arrow-up"></i> +{{ $nouveauxCeMois ?? 0 }} ce mois
                </p>
            </div>

            <div class="kpi-card" style="--kpi-accent: theme('colors.violet.DEFAULT')">
                <p class="kpi-label mb-2">Postes vacants</p>
                <p class="kpi-value">{{ $postesVacants ?? 0 }}</p>
                <p class="text-xs text-ink-secondary mt-1">sur {{ $totalPostes ?? 0 }} postes</p>
            </div>

            <div class="kpi-card" style="--kpi-accent: theme('colors.status.success')">
                <p class="kpi-label mb-2">Grades référencés</p>
                <p class="kpi-value">{{ $totalGrades ?? 0 }}</p>
                <p class="text-xs text-ink-secondary mt-1">{{ $totalFonctions ?? 0 }} fonctions</p>
            </div>

            <div class="kpi-card" style="--kpi-accent: theme('colors.status.warning')">
                <p class="kpi-label mb-2">Établissements</p>
                <p class="kpi-value">{{ $totalEtablissements ?? 0 }}</p>
                <p class="text-xs text-ink-secondary mt-1">rattachés à l'ODEJ</p>
            </div>
        </div>

        {{-- ============================================================ Graphique + liste --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <div class="lg:col-span-2 bg-white border border-navy-100 rounded-card p-5">
                <h2 class="font-display text-base font-semibold text-navy-900 mb-4">
                    Répartition des fonctionnaires par établissement
                </h2>
                <div class="relative h-64">
                    <canvas id="chartEtablissements"></canvas>
                </div>
            </div>

            <div class="bg-white border border-navy-100 rounded-card p-5">
                <h2 class="font-display text-base font-semibold text-navy-900 mb-4">
                    Postes vacants prioritaires
                </h2>
                <ul class="space-y-3">
                    @forelse ($postesVacantsListe ?? [] as $poste)
                        <li class="flex items-center justify-between text-sm">
                            <span class="text-ink">{{ $poste->nom_fonction }}</span>
                            <span class="text-xs text-ink-secondary">{{ $poste->nom_etablissement }}</span>
                        </li>
                    @empty
                        <li class="text-sm text-ink-muted">Aucun poste vacant recensé.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- ============================================================ Navigation modules --}}
        <div>
            <h2 class="font-display text-lg font-semibold text-navy-900 mb-4 uppercase tracking-wide bg-white/60 border border-navy-100 rounded-card px-4 py-2 inline-block">
                Gestion du personnel
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                @php
                    $modules = [
                        ['label' => 'Fonctionnaires',    'icon' => 'fa-user',           'route' => 'fonctionaires'],
                        ['label' => 'Fonctions',         'icon' => 'fa-gear',           'route' => 'fonctions'],
                        ['label' => 'Grades',            'icon' => 'fa-star',           'route' => 'grades'],
                        ['label' => 'Postes supérieurs', 'icon' => 'fa-arrow-up-long',  'route' => 'postes-superieurs'],
                        ['label' => 'Établissements',    'icon' => 'fa-building',       'route' => 'etablissements'],
                    ];
                @endphp

                @foreach ($modules as $module)
                    <a href="{{ Route::has($module['route']) ? route($module['route']) : '#' }}"
                        class="module-tile group">
                        <span class="absolute inset-y-0 right-0 w-16 bg-institutionnel"
                            style="clip-path: polygon(60% 0, 100% 50%, 60% 100%, 0 100%, 40% 50%, 0 0);"></span>
                        <span class="relative z-10 flex h-11 w-11 items-center justify-center rounded-full bg-violet-50 text-violet-600 text-lg">
                            <i class="fa-solid {{ $module['icon'] }}"></i>
                        </span>
                        <span class="module-tile__label relative z-10">{{ $module['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('chartEtablissements');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($etablissementsLabels ?? []),
                    datasets: [{
                        label: 'Fonctionnaires',
                        data: @json($etablissementsData ?? []),
                        backgroundColor: '#3B78E7',
                        borderRadius: 4,
                        maxBarThickness: 36,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
