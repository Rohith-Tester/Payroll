@props(['headers' => null, 'id' => null, 'pagetitle' => null, 'ajax'])
<table class="table table-striped table-bordered table-hover m-0" id="{{ $id }}">
    <thead>
        @foreach ($headers as $head)
            <th>{{ $head }}</th>
        @endforeach
    </thead>
    <tbody></tbody>
    <tfoot>
        @foreach ($headers as $head)
            <th>{{ $head }}</th>
        @endforeach
    </tfoot>
</table>
@push('external_scripts')
    <script>
        $('#{{ $id }}').DataTable({
            dom: '<"top"iBp<"dt_title">>t<"bottom"><"clear">',
            serverSide: true,
            processing: true,
            ajax: '{{ route($ajax) }}',
            initComplete: function () {
                document.querySelector('.dt_title').textContent = '{{ $pagetitle }}';
                var api = this.api();
                api.columns().every(function (index) {
                    let column = this;
                    let footer = $(column.footer());
                    let title = footer.text();
                    var storageKey = "footerSearch_" + index + "_" + title;
                    var input = $(
                        '<input type="text" class="footer-search" placeholder="🔍 ' +
                        title +
                        '" id="' +
                        title +
                        '"/>'
                    )
                        .appendTo($(column.footer()).empty())
                        .css({
                            width: "90%",
                            padding: "3px",
                            "box-sizing": "border-box",
                            "font-size": "13px",
                        });
                    var state = api.state.loaded();
                    if (state && state.columns[index].search.search) {
                        input.val(state.columns[index].search.search);
                        column.search(state.columns[index].search.search);
                    }

                    input.on("keyup change", function (e) {
                        if (column.search() !== this.value) {
                            column.search(this.value).draw();
                            localStorage.setItem(storageKey, this.value);
                        }
                    });
                });
            }
        });
    </script>
@endpush()