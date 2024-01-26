<script>
    var datatable;
    $(function() {
        datatable = $('#cartTable').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: false,
            'columnDefs': [
            ],
            dom: 'Blrtip',
            ajax: {
                url: '{{ route('cartitem.getData') }}',
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
                    data:'user_name',
                    name:'user_name'
                },
                {
                    data: 'created_at',
                    name: "created_at"
                },
                {
                    data: 'updated_at',
                    name: "updated_at"
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
