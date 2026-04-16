<x-layouts.app title="Experience letters">
    <div class="doc-page-head">
        <p>Service / experience certificates for employees.</p>
        <a class="doc-btn" href="{{ route('documents.experience-letters.create') }}">New experience letter</a>
    </div>

    <section class="app-panel">
        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Issued</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Signed by</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($letters as $row)
                        <tr>
                            <td>{{ $row->issued_date?->format('Y-m-d') ?? '—' }}</td>
                            <td>{{ $row->employee?->full_name }}</td>
                            <td class="cell-muted">{{ $row->employee?->department?->name ?? '—' }}</td>
                            <td class="cell-muted">{{ $row->issuer?->user_name ?? $row->issuer?->email ?? '—' }}</td>
                            <td><a class="doc-link" href="{{ route('documents.experience-letters.preview', $row) }}">Open</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><p class="empty-state">No experience letters yet.</p></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $letters->links() }}</div>
    </section>
</x-layouts.app>
