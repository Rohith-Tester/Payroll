<x-layouts.app title="Salary slips">

    <div class="doc-page-head d-flex justify-content-end align-items-center">
        <a class="doc-btn btn btn-primary btn-sm px-2 py-1"
           href="{{ route('documents.salary-slips.create') }}">
            New salary slip
        </a>
    </div>

    <section class="table-panel">
        <div class="table-responsive custom-table-wrap">
            <table class="table table-striped table-bordered table-hover custom-table">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Net Salary</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($slips as $row)
                        <tr>
                            <td>{{ $row->salary_month ?? '—' }}</td>
                            <td>{{ $row->employee?->full_name ?? '—' }}</td>
                            <td>{{ $row->employee?->department?->name ?? '—' }}</td>
                            <td>{{ $row->net_salary ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No salary slips yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $slips->links() }}
        </div>
    </section>

</x-layouts.app>