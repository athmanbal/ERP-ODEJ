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

    <div class="bg-white rounded-lg shadow p-4 mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Filtrer par fonctionnaire</label>
        <select id="filtre-fonctionnaire"
                class="w-full max-w-sm rounded-md border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
            <option value="">Tous les fonctionnaires</option>
            @foreach($fonctionnaires as $f)
                <option value="{{ $f->id_fonctionnaire }}">{{ $f->nom_fonctionnaire }} {{ $f->prenom_fonctionnaire }}</option>
            @endforeach
        </select>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <div id="calendrier-conges"></div>
    </div>
</div>

@include('pages.conges.partials.modal-nouveau-conge')

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendrier-conges');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'fr',
        height: 700,
        initialView: 'multiMonthYear',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'multiMonthYear,dayGridMonth'
        },
        events: function (info, successCallback, failureCallback) {
            const idFonctionnaire = document.getElementById('filtre-fonctionnaire').value;
            fetch(`{{ route('conges.events') }}?fonctionnaire=${idFonctionnaire}`)
                .then(res => res.json())
                .then(successCallback)
                .catch(failureCallback);
        },
    });
    calendar.render();

    document.getElementById('filtre-fonctionnaire').addEventListener('change', () => calendar.refetchEvents());
});
</script>

</x-app-layout>
