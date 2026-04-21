<x-layouts.app title="Employees">
    @if (session('success'))
        <div class="app-flash app-flash--success" role="status">{{ session('success') }}</div>
    @endif

    <section class="table-panel" style="padding:0; margin:0;">
                <div class="table-responsive" style="width:100%; margin:0; padding:0;">
            <table class="table table-striped table-bordered table-hover m-0" style="width:100%;">
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
<div class="dropdown">

    <button type="button"
        style="
            background:#0095d9;
            color:#fff;
            border:none;
            padding:2px 10px;
            font-size:12px;
            font-weight:600;
            min-width:72px;
            height:28px;
            cursor:pointer;
        ">
        Options ⚙
    </button>

    <ul class="dropdown-menu">

        <li><a class="dropdown-item" href="{{ route('employees.edit', $employee) }}">Edit</a></li>

        <li><a class="dropdown-item" href="{{ route('documents.offer-letters.index') }}">Offer Letter</a></li>

        <li><a class="dropdown-item" href="{{ route('documents.joining-letters.index') }}">Joining Letter</a></li>

        <li><a class="dropdown-item" href="{{ route('documents.experience-letters.index') }}">Experience Letter</a></li>

        <li><a class="dropdown-item" href="{{ route('documents.salary-slips.index') }}">Salary Slips</a></li>

    </ul>

</div>
</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9">
                                <p class="empty-state">No employees yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $employees->withQueryString()->links() }}
    </section>
    <style>
.table-responsive{
    overflow: visible !important;
}

.dropdown{
    position: relative;
}

<style>
.table-responsive{
    overflow: visible !important;
}

.dropdown{
    position:relative;
}

.dropdown-menu{
    display:none;
    position:absolute;
    top:100%;
    left:50%;
    transform:translateX(-50%);
    z-index:9999;
    min-width:180px;
}

.dropdown:hover .dropdown-menu{
    display:block;
}
</style>
</x-layouts.app>
