<x-layouts.app title="Salary slips">
    <div class="doc-page-head">
        <p>Generated payslips linked to monthly payroll rows.</p>
        <a class="doc-btn" href="{{ route('documents.salary-slips.create') }}">New salary slip</a>
    </div>

    <section class="app-panel">
        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Generated</th>
                        <th>Employee</th>
                        <th>Period</th>
                        <th>Net pay</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($slips as $row)
                        @php
                            $ms = $row->monthlySalary;
                        @endphp
                        <tr>
                            <td>{{ $row->generated_at?->format('Y-m-d H:i') }}</td>
                            <td>{{ $ms?->employee?->full_name }}</td>
                            <td class="cell-muted">
                                @if ($ms)
                                    {{ \Carbon\Carbon::create($ms->year, $ms->month, 1)->format('F Y') }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="cell-muted">
                                @if ($ms && $ms->net_payable !== null)
                                    {{ number_format((float) $ms->net_payable, 2) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td><a class="doc-link" href="{{ route('documents.salary-slips.preview', $row) }}">Open</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><p class="empty-state">No salary slips yet.</p></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $slips->links() }}</div>
    </section>
</x-layouts.app>
