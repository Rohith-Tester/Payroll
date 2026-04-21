<x-layouts.app title="Experience letters">

    <div class="doc-page-head d-flex justify-content-end align-items-center">
        <a class="doc-btn btn btn-primary btn-sm px-2 py-1"
           href="{{ route('documents.experience-letters.create') }}">
            New experience letter
        </a>
    </div>

    <section class="table-panel">
        <div class="table-responsive custom-table-wrap">
            <table class="table table-striped table-bordered table-hover custom-table">
                <thead>
                    <tr>
                        <th>Issued</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Options</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($letters as $row)
                        <tr>
                            <td>{{ $row->issued_date?->format('Y-m-d') ?? '—' }}</td>
                            <td>{{ $row->employee?->full_name ?? '—' }}</td>
                            <td>{{ $row->employee?->department?->name ?? '—' }}</td>
                            <td>{{ $row->employee?->designation ?? '—' }}</td>

                            <td class="text-left align-middle">
                                <a href="{{ route('documents.experience-letters.preview', $row) }}"
                                   class="icon-open me-3 text-dark text-decoration-none"
                                   title="Open">
                                    <i class="fa-solid fa-file-lines"></i>
                                </a>

                                <a href="#"
                                   class="icon-delete text-dark text-decoration-none"
                                   title="Delete">
                                    <i class="fa-solid fa-trash text-dark"></i>
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No experience letters yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $letters->links() }}
        </div>
    </section>

</x-layouts.app>