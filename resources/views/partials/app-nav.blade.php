@php
    $items = [
        [
            'label' => 'Employees',
            'subheadings' => [
                [
                    'route' => 'employees.index',
                    'label' => 'Employees List',
                    'icons' => 'users'
                ],
                [
                    'route' => 'documents.offer-letters.index',
                    'label' => 'Offer Letters',
                    'icons' => ''
                ],
                [
                    'route' => 'documents.joining-letters.index',
                    'label' => 'Joining Letters',
                    'icons' => ''
                ],
                [
                    'route' => 'documents.experience-letters.index',
                    'label' => 'Experience Letters',
                    'icons' => ''
                ],
                [
                    'route' => 'documents.salary-slips.index',
                    'label' => 'Salary Slips',
                    'icons' => ''
                ],


            ],
        ],
        [
            'label' => 'Allowance',
            'subheadings' => [
                [
                    'route' => 'employees.index',
                    'label' => 'Employees List',
                    'icons' => 'users'
                ]
            ],
        ],


    ];
@endphp


<nav class="app-nav" aria-label="Main">
    @foreach ($items as $item)
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $item['label'] }}
            </button>
            <ul class="dropdown-menu">
                @foreach ($item['subheadings'] as $shortcut)
                    <li><a class="dropdown-item app-nav__link" href="{{ route($shortcut['route']) }}">{{ $shortcut['label'] }}</a></li>
                @endforeach
            </ul>
        </div>
        </a>
    @endforeach
</nav>