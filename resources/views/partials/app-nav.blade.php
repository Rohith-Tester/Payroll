@php
    $items = [
        [
            'route' => 'dashboard',
            'label' => 'Dashboard',
            'active' => ['dashboard', 'preview.dashboard'],
            'icon' => 'grid',
        ],
        [
            'route' => 'employees.index',
            'label' => 'Employees',
            'active' => 'employees.*',
            'icon' => 'users',
        ],
        [
            'route' => 'attendance.index',
            'label' => 'Attendance',
            'active' => 'attendance.*',
            'icon' => 'clock',
        ],
        [
            'route' => 'payroll.index',
            'label' => 'Payroll',
            'active' => 'payroll.*',
            'icon' => 'wallet',
        ],
        [
            'route' => 'leaves.index',
            'label' => 'Leaves',
            'active' => 'leaves.*',
            'icon' => 'calendar',
        ],
        [
            'route' => 'documents.index',
            'label' => 'HR Documents',
            'active' => 'documents.*',
            'icon' => 'file',
        ],
    ];
@endphp

<nav class="app-nav" aria-label="Main">
    @foreach ($items as $item)
        @php
            $active = is_array($item['active'])
                ? request()->routeIs(...$item['active'])
                : request()->routeIs($item['active']);
        @endphp
        <a
            href="{{ route($item['route']) }}"
            class="app-nav__link @if ($active) is-active @endif"
        >
            @if ($item['icon'] === 'grid')
                <svg class="app-nav__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
            @elseif ($item['icon'] === 'users')
                <svg class="app-nav__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            @elseif ($item['icon'] === 'clock')
                <svg class="app-nav__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 6v6l4 2"/>
                </svg>
            @elseif ($item['icon'] === 'wallet')
                <svg class="app-nav__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/>
                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/>
                    <path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/>
                </svg>
            @elseif ($item['icon'] === 'file')
                <svg class="app-nav__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            @else
                <svg class="app-nav__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            @endif
            {{ $item['label'] }}
        </a>
    @endforeach
</nav>
