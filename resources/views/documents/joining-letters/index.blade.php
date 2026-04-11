<x-layouts.app title="Appointment letters">
    <div class="doc-page-head">
        <p>Appointment / joining letters (stored in <code>joining_letter</code>).</p>
        <a class="doc-btn" href="{{ route('documents.joining-letters.create') }}">New appointment letter</a>
    </div>

    <section class="app-panel">
        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Issued</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Joining date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($letters as $row)
                        <tr>
                            <td>{{ $row->issued_date?->format('Y-m-d') ?? '—' }}</td>
                            <td>{{ $row->employee?->full_name }}</td>
                            <td class="cell-muted">{{ $row->employee?->department?->name ?? '—' }}</td>
                            <td class="cell-muted">{{ $row->joining_date?->format('Y-m-d') }}</td>
                            <td><a class="doc-link" href="{{ route('documents.joining-letters.preview', $row) }}">Open</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><p class="empty-state">No appointment letters yet.</p></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $letters->links() }}</div>
    </section>
</x-layouts.app>
