<x-layouts.app title="Attendance">
    <section class="app-panel">
        <h2 class="app-panel__head">Attendance records</h2>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Employee</th>
                        <th>Check in</th>
                        <th>Check out</th>
                        <th>Status</th>
                        <th>Source</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $row)
                        <tr>
                            <td>{{ $row->date?->format('Y-m-d') ?? '—' }}</td>
                            <td>{{ $row->employee?->full_name ?? '—' }}</td>
                            <td class="cell-muted">{{ $row->check_in ?? '—' }}</td>
                            <td class="cell-muted">{{ $row->check_out ?? '—' }}</td>
                            <td>{{ $row->status ?? '—' }}</td>
                            <td class="cell-muted">{{ $row->source ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <p class="empty-state">No attendance rows yet. Data comes from the <code>attendance</code> table.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $records->withQueryString()->links() }}
    </section>
</x-layouts.app>
