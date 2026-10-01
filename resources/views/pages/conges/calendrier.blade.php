<x-app-layout>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestion des congés</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNouveauConge">
            <i class="bi bi-plus-circle"></i> Nouveau congé
        </button>
    </div>

    @include('pages.conges.partials.nav')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <label class="form-label">Filtrer par fonctionnaire</label>
            <select id="filtre-fonctionnaire" class="form-select" style="max-width: 350px;">
                <option value="">Tous les fonctionnaires</option>
                @foreach($fonctionnaires as $f)
                    <option value="{{ $f->id_fonctionnaire }}">{{ $f->nom_fonctionnaire }} {{ $f->prenom_fonctionnaire }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div id="calendrier-conges"></div>
        </div>
    </div>
</div>

@include('pages.conges.partials.modal-nouveau-conge')

{{-- Chargé ici, à l'intérieur du slot : marche quel que soit le layout,
     même si celui-ci ne déclare pas @stack('scripts'). --}}
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
