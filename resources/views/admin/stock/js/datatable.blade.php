<script>
    var datatable;
    $(function() {
        datatable = $('#stockTable').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: false,
            'columnDefs': [
                {
                    targets: [5],
                    render: function(data, type, row) {
                        return`<a href="javascript:void(0);" class="btn btn-sm text-primary fa-tip"  title="Edit" onclick="manageStock(${data},${row.count})" >
                        <button class="btn btn-success">Manage Stock</button></a>`;
                    },
                }
            ],
            dom: 'Blrtip',
            ajax: {
                url: '{{ route('stock.getData') }}',
                type: "get",
                data: function(d) {

                }
            },
            "order": [
                [0, "desc"]
            ],
            "paging": true,
            columns: [{
                    data: 'DT_RowIndex',
                    name: "id",
                    orderable:false
                },
                {
                    data: 'name',
                    name: "name"
                },
                {
                    data: 'count',
                    name: "count"
                },

                {
                    data: 'created_at',
                    name: "created_at"
                },
                {
                    data: 'updated_at',
                    name: "updated_at"
                },
                {
                    data: 'id',
                    name: 'id',
                    orderable:false
                }
            ],
            "initComplete": function() {
                var i = 0;
                var input_text = [1, 2, 3, 4];
                var non_searchable = [0];
                this.api().columns().every(function() {
                    var column = this;
                    if (i == 3 || i== 4 ) {
                        var input =
                            `<input type="date" name="date" class="per-page form-control form-control-sm m-input">`;
                        $(input).appendTo($(column.footer()).empty()).on('change',
                            function() {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    } else if (non_searchable.includes(i)) {
                        var input = ``
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function() {

                            });
                    } else if (input_text.includes(i)) {
                        var input =
                            "<input type='text'  placeholder=\"&#xF002; Search\" style='height:30px; font-family: Arial,FontAwesome' class=\"per-page form-control form-control-sm m-input\">";
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function() {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    }
                    i++;
                });
            },
        });
    });
</script>
