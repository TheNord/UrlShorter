<ul class="nav nav-tabs mb-4">
    <li class="nav-item"><a class="nav-link {{ $page === '' ? ' active' : '' }}" href="{{ route('cabinet.index') }}">Dashboard</a></li>
    <li class="nav-item"><a class="nav-link {{ $page === 'links' ? ' active' : '' }}" href="{{ route('cabinet.links') }}">Links</a></li>
</ul>