@php
    $lien = fn($actif) => 'px-4 py-2 text-sm font-medium border-b-2 ' .
        ($actif ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300');
@endphp

<div class="border-b border-gray-200 mb-6">
    <nav class="-mb-px flex gap-4">
        <a href="{{ route('conges.dashboard') }}" class="{{ $lien(request()->routeIs('conges.dashboard')) }}">
            Tableau de bord
        </a>
        <a href="{{ route('conges.calendrier') }}" class="{{ $lien(request()->routeIs('conges.calendrier')) }}">
            Calendrier
        </a>
        <a href="{{ route('conges.historique') }}" class="{{ $lien(request()->routeIs('conges.historique')) }}">
            Historique
        </a>
    </nav>
</div>
