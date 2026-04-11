<x-layouts.app title="Employees">
    @if (session('success'))
        <div class="app-flash app-flash--success" role="status">{{ session('success') }}</div>
    @endif

    <div class="doc-page-head">
        <p>Directory with department and current salary (from <code>salary_structure</code>).</p>
        <a class="doc-btn" href="{{ route('employees.create') }}">Add employee</a>
    </div>

    <section class="app-panel">
        <h2 class="app-panel__head">All employees</h2>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Basic</th>
                        <th>HRA</th>
                        <th>Gross</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        @php $s = $employee->latestSalaryStructure; @endphp
                        <tr>
                            <td>{{ $employee->employee_code }}</td>
                            <td>{{ $employee->full_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department?->name ?? '—' }}</td>
                            <td class="cell-muted">{{ $s ? number_format((float) $s->basic, 2) : '—' }}</td>
                            <td class="cell-muted">{{ $s ? number_format((float) $s->hra, 2) : '—' }}</td>
                            <td class="cell-muted">{{ $s ? number_format((float) $s->gross, 2) : '—' }}</td>
                            <td class="cell-muted">{{ $employee->status ?? '—' }}</td>
                            <td>
                                <a class="doc-link" href="{{ route('employees.edit', $employee) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <p class="empty-state">No employees yet. Click <strong>Add employee</strong> to create one.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $employees->withQueryString()->links() }}
    </section>
</x-layouts.app>
