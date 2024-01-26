<script>


    $(document).ready(function(){

        $('#category').select2();

         $("#addImage").click(function() {
        var lsthmtl = $(".clone").html();
        $(".increment").after(lsthmtl);
    });

    $("body").on("click", "#removeImage", function() {
        $(this).parents(".hdtuto").remove();
    });

    });


    function addCategoryForm(value) {
        if (value == 0) {
            clearAll();
            $(".heading").text('Add Category');
            $("#add").addClass('d-none');
            $("#back").removeClass('d-none');
            $("#category_list").addClass('d-none');
            $("#category_form").removeClass('d-none');
        } else if (value == 2) {
            $("#category_form").removeClass('d-none');
            $("#category_list").addClass('d-none');
        } else {
            clearAll();
            $("#category_form").addClass('d-none');
            $("#category_list").removeClass('d-none');
        }
    }


    function clearAll() {
        $('#categoryForm').trigger("reset");
        $('#categoryButton').html('Add Category');
        $('#id').val('');
    }


    function addCategory(e) {
        e.preventDefault();

        let data = $("#categoryForm")[0];
        const formData = new FormData(data);

        $.ajax({
            url: '{{ route('category.add') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#categoryButton').attr('disabled', 'disabled');
                $('#categoryButton').text('Adding..');
            },
            complete: function() {
                $('#categoryButton').attr("disabled", false);
                $("#categoryButton").text('Add Category');
            },
            success: function(data) {
                if (data.success == true) {
                    clearAll();
                    $('#categoryForm').trigger("reset");
                    notify("success", data.message);
                    $('#categoryTable').DataTable().ajax.reload();
                    addCategoryForm(1);
                } else {
                    if($("#id").val())
                    {
                        $("#categoryButton").text('Update Product');
                    }
                    notify("warning", data.message);
                }
            },
            error: function(data) {
                notify('danger', 'Something went wrong!');
            }
        });

    }


    function editCategory(id) {
        clearAll();
        let url = "{{ route('category.get', ':id') }}";
        url = url.replace(":id", id);

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function(output) {
                $(".heading").text("Update Category");
                $("#categoryButton").text("Update Category");
                $("#back").removeClass('d-none');
                $('#id').val(output.id);
                $('#name').val(output.name);
                $("#description").val(output.description);
                addCategoryForm(2);
            },
            error: function(data) {

            }
        });
    }

    function deleteCategory(id) {

        let route = "{{ route('category.delete', ':id') }}"
        route = route.replace(":id", id);

        $.confirm({
            title: 'Confirm Delete',
            content: 'Do you want to delete?',
            type: 'red',
            buttons: {
                tryAgain: {
                    text: 'CONFIRM',
                    //btnClass: 'btn-success',
                    keys: ['y'],
                    action: function() {
                        $.ajax({
                            url: route,
                            type: 'DELETE',
                            data: {
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success == true) {
                                    $('#categoryTable').DataTable().ajax.reload();
                                    notify('success', response.message);
                                } else {
                                    notify('warning', response.message);
                                }
                            },
                            error: function(jqXHR, status, err) {
                                notify('danger', 'Data under this section !');
                            }
                        });
                    }
                },
                cancel: {
                    keys: ['n'],
                    action: function() {

                    }
                }
            }
        });
    }

</script>
