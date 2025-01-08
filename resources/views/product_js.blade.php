<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.add_product', function (e) {
            e.preventDefault();
            let formData = new FormData($('#addProductForm')[0]);
            $.ajax({
                url: "{{route('add.product')}}",
                method: "post",
                data: formData,
                contentType: false, // Prevent jQuery from setting the content type
                processData: false, // Prevent jQuery from processing the data
                success: function (res) {
                    console.log(res);
                    if(res.status=='success') {
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors,function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            })
        });

        //show product value in update form
        $(document).on('click', '.update_product_form', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            let image = $(this).data('image');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_price').val(price);

            if (image) {
                $('#up_image_preview').attr('src', image).show();
            } else {
                $('#up_image_preview').hide();
            }
        });


        //update Product Data

        $(document).on('click', '.update_product', function (e) {
            e.preventDefault();
            let formData = new FormData($('#updateProductForm')[0]);
            $.ajax({
                url: "{{route('update.product')}}",
                method: "post",
                data: formData,
                contentType: false, // Prevent jQuery from setting the content type
                processData: false, // Prevent jQuery from processing the data
                success: function (res) {
                    console.log(res);
                    if(res.status=='success') {
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors,function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            })
        });


        //delete product data
        $(document).on('click', '.delete_product', function (e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            if (confirm('Are you sure to delete this product??')){
                $.ajax({

                });
            }
        });

    });
</script>
