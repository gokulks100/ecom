<script>

    function manageStock(id,count)
    {
        console.log(id ,count);
        $("#id").val(id);
        $("#count").val(count);
        $("#stockModal").modal('show');
    }

    function updateStock(e) {
        e.preventDefault();

        let data = $("#updateStock")[0];
        const formData = new FormData(data);

        $.ajax({
            url: '{{ route('stock.manage') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#stockButton').attr('disabled', 'disabled');
                $('#stockButton').text('Updation..');
            },
            complete: function() {
                $('#stockButton').attr("disabled", false);
                $("#stockButton").text('Update stock');
            },
            success: function(data) {
                if (data.success == true) {
                    $('#stockTable').DataTable().ajax.reload();
                    $('#updateStock').trigger("reset");
                    notify("success", data.message);
                    $("#stockModal").modal('hide');
                } else {
                    if($("#id").val())
                    {
                        $("#stockButton").text('Update Product');
                    }
                    notify("warning", data.message);
                }
            },
            error: function(data) {
                notify('danger', 'Something went wrong!');
            }
        });

    }





</script>
