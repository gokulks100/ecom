<script>


    $(document).ready(function(){

        $('#category').select2();

         $("#addImage").click(function() {
        var lsthmtl = $(".clone").html();

        console.log(lsthmtl);
        $(".increment").after(lsthmtl);
    });

    $("body").on("click", "#removeImage", function() {
        $(this).parents(".hdtuto").remove();
    });

    });


    function addProductForm(value) {
        if (value == 0) {
            clearAll();
            $(".heading").text('Add Product');
            $("#add").addClass('d-none');
            $("#back").removeClass('d-none');
            $("#product_list").addClass('d-none');
            $("#product_form").removeClass('d-none');
        } else if (value == 2) {
            $("#product_form").removeClass('d-none');
            $("#product_list").addClass('d-none');
        } else {
            clearAll();
            $("#product_form").addClass('d-none');
            $("#product_list").removeClass('d-none');
        }
    }


    function clearAll() {
        $('#imageDiv').empty();
        $("#category").val(null).trigger('change');
        $('#productForm').trigger("reset");
        $('#productButton').html('Add Product');
        $('#id').val('');
    }


    function addProduct(e) {
        e.preventDefault();

        let data = $("#productForm")[0];
        const formData = new FormData(data);

        $.ajax({
            url: '{{ route('product.add') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#productButton').attr('disabled', 'disabled');
                $('#productButton').text('Adding..');
            },
            complete: function() {
                $('#productButton').attr("disabled", false);
                $("#productButton").text('Add Product');
            },
            success: function(data) {
                if (data.success == true) {
                    clearAll();
                    $('#productForm').trigger("reset");
                    notify("success", data.message);
                    $('#productTable').DataTable().ajax.reload();
                    addProductForm(1);
                } else {
                    if($("#id").val())
                    {
                        $("#productButton").text('Update Product');
                    }
                    notify("warning", data.message);
                }
            },
            error: function(data) {
                notify('danger', 'Something went wrong!');
            }
        });

    }


    function editProduct(id) {
        clearAll();
        let url = "{{ route('product.get', ':id') }}";
        url = url.replace(":id", id);

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function(output) {
                $(".heading").text("Update Product");
                $("#productButton").text("Update Product");
                $("#back").removeClass('d-none');
                $('#id').val(output.id);
                $('#name').val(output.name);
                $("#stock").val(output.stock.count);
                $("#category").val(output.category_id).trigger('change');

                if (output.images.length > 0) {
                        $('#imageDiv').empty();
                        var i = 1;
                        $.each(output.images, function(key, value) {
                            console.log(value.url);
                            $('#imageDiv').append(`
                                <div id="img${output.id}"><img src="/images/${value.url}" class="img-bg" style="background-size: cover;width:200px;"><span class="upload__img-close" onclick="deleteProductImage(${output.id})"></span></div>`);
                            i++;
                        });

                    }

                $("#price").val(output.price);
                $("#tax").val(output.tax);
                $("#description").val(output.description);

                addProductForm(2);
            },
            error: function(data) {

            }
        });
    }

    function deleteProduct(id) {

        let route = "{{ route('product.delete', ':id') }}"
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
                                    $('#productTable').DataTable().ajax.reload();
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

    function deleteProductImage(id) {
        $.ajax({
            url: "{{ route('product.delete.productimage') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            cache: false,
            beforeSend: function() {},
            complete: function() {},
            success: function(data) {
                if (data.success == false) {
                    notify("warning", "data not found!");
                }
                $('#img' + id).remove();
            },
            error: function(data) {
                notify('warning', 'try again !');
            }
        });

    }

</script>
