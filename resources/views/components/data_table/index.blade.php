@props(['headers' => null, 'id' => null, 'pagetitle' => null, 'ajax'])
<table class="table table-striped table-bordered table-hover m-0 datatable-v1" id="{{ $id }}">
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
        let table_header = '{{  $pagetitle }}';
        function adjustTableHeight() {
            let windowHeight = $(window).height();
            let headerHeight = $(".app-nav").outerHeight(true) + 40;
            let footerHeight = $(".footer").outerHeight(true) || 35;
            let tableFooterHeight = $(".dataTables_scrollFoot").outerHeight(true) || 50;
            let availableHeight =
                windowHeight - (headerHeight + footerHeight + tableFooterHeight + 40);
            var rowHeight = 40;
            let pageLength = Math.floor(availableHeight / rowHeight);
            localStorage.setItem(table_header + "_length", pageLength);
            let response = [pageLength, availableHeight];
            return response;
        }
        var heightResponse = adjustTableHeight();

        var table = $('#{{ $id }}').DataTable({
            dom: '<"top"iBp<"dt_title">>t<"bottom"><"clear">',
            serverSide: true,
            processing: true,
            scroller: true,
            scrollY: heightResponse[1] + "px",
            pageLength: heightResponse[0],
            ajax: {
                url: '{{ route($ajax) }}',
                data: function (d) {
                    d.length = heightResponse[0];
                },
                error: function (xhr, error, thrown) {
                    console.log("Failed to load table data  : ", xhr, error, thrown);
                },
                complete: function (xhr) {
                    $(".spinner-wrapper").css("visibility", "hidden");
                },
            },
            autoWidth: false,
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
                $(document).trigger('table-ready' , [table]);
            }
        });
    </script>
@endpush()