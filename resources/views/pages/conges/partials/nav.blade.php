<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('conges.dashboard') ? 'active' : '' }}" href="{{ route('conges.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Tableau de bord
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('conges.calendrier') ? 'active' : '' }}" href="{{ route('conges.calendrier') }}">
            <i class="bi bi-calendar3"></i> Calendrier
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('conges.historique') ? 'active' : '' }}" href="{{ route('conges.historique') }}">
            <i class="bi bi-clock-history"></i> Historique
        </a>
    </li>
</ul>
