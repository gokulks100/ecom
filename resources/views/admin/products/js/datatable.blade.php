<script>
    var datatable;
    $(function() {
        datatable = $('#productTable').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: false,
            'columnDefs': [
                {
                    targets: [7],
                    render: function(data, type, row) {
                        var editAction =
                            `<a href="javascript:void(0);" class="btn btn-sm text-primary fa-tip"  title="Edit" onclick="editProduct(${data})" ><i class="fa fa-pen cursor-pointer f-size-14"></i></a>`;
                        var deleteAction =
                            `<a href="javascript:void(0);" class="btn btn-sm text-danger fa-tip"  title="Delete" onclick="deleteProduct(${data})"><i class="fa fa-trash cursor-pointer f-size-14"></i></a>`;
                        return '<div class="d-flex">' + editAction + deleteAction + '</div>';
                    },
                }
            ],
            dom: 'Blrtip',
            ajax: {
                url: '{{ route('product.getData') }}',
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
                    data: 'category',
                    name: "category"
                },

                {
                    data: 'price',
                    name: "price"
                },

                {
                    data: 'description',
                    name: "description"
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
                var input_text = [1, 2, 3, 4, 5, 6, 7];
                var non_searchable = [0];
                this.api().columns().every(function() {
                    var column = this;
                    if (i == 6 || i==7 ) {
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
