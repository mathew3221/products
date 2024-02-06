<!DOCTYPE html>
<html>

<head>
    <title>PRODUCTS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container mt-4">
        <br>
        <div class="col-md-9">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add New Product
            </button>
        </div>
        

        <table class="table table-striped table-bordered table-hover mt-3">
            <thead class="bg-primary">
                <tr>
                    <th>No</th>
                    <th>Ptroduct Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody id="list"></tbody>
        </table>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h2 class="modal-title" id="exampleModalLabel">Add New Products</h2>
                </div>
                <?php $attributes = array("name" => "save_products", "method" => "POST");
                echo form_open_multipart("productscontroller/save_details", $attributes); ?>

                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Name of Products</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span class="text-danger" id="name-error"></span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" name="price" id="price">
                                <span class="text-danger" id="price-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="quantity" id="quantity">
                                <span class="text-danger" id="quantity-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save Products</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="viewModalLabel">Details</h2>

                </div>


                <div class="modal-body" id="info">

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" tabindex="-1" role="dialog" id="editModal" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="pedit">

        </div>
</div>




</body>

</html>


<script type="text/javascript">
    $(document).ready(function() {
        get_product_detail();
    });



    function get_product_detail() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'productscontroller/get_product_list'; ?>',
            data: {},
            success: function(response) {
                $('#list').html(response);
            }
        });
    }


    function get_product_info(id) {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url() . 'productscontroller/get_product_info'; ?>',
            data: {id: id},
            success: function(response) {
                $('#info').html(response);
            }
        });
    }



    function edit_product_info(id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'productscontroller/get_product_edit'; ?>',
            data: {id: id},
            success: function(response) {
                $('#pedit').html(response);
                $('#editForm').submit(function(e) {
                    e.preventDefault();
                    updateProductDetails(id);
                });
            }
        });
    }



    function updateProductDetails(id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'productscontroller/update_details'; ?>',
            data: $('#editForm').serialize(),
            success: function(response) {
                var result = $.parseJSON(response);
                if (result.status === 'success') {
                    alert('Product updated successfully!');
                    $('#editModal').modal('hide');
                    get_product_detail();
                } else {
                    alert('Failed to update product.');
                }
            }
        });
    }


    function delete_product_info(id) {
        var a = confirm("Are you sure !.");
        if (a == true) {
            $.ajax({
                url: '<?php echo base_url() . 'productscontroller/delete_details'; ?>',
                method: 'POST',
                data: {id: id},
                success: function(response) {
                    setTimeout(function() {
                        get_product_detail();
                    }, 10);
                }
            })
        }
    }




    $("form[name='save_products']").submit(function(event) {
        event.preventDefault();

        var productName = $("#name").val();
        var price = $("#price").val();
        var quantity = $("#quantity").val();

        if (!validateProductName(productName, "name-error") ||
            !validatePrice(price, "price-error") ||
            !validateQuantity(quantity, "quantity-error")) {
            return;
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'productscontroller/save_details'; ?>",
            data: $(this).serialize(),
            success: function(response) {
                var result = $.parseJSON(response);
                alert('Product saved successfully!');
                    $('#exampleModal').modal('hide');
                    get_product_detail();
            }
        });


    });



    function validateProductName(productName, errorId) {
        var alphanumericRegex = /^[a-zA-Z0-9\s]+$/;
        var errorElement = $("#" + errorId);

        if (productName.trim() === "" || !alphanumericRegex.test(productName)) {
            errorElement.text("Product name is required and must be alphanumeric.");
            return false;
        }

        errorElement.text("");
        return true;
    }

    function validatePrice(price, errorId) {
        var errorElement = $("#" + errorId);

        if (price.trim() === "" || isNaN(price) || parseFloat(price) <= 0) {
            errorElement.text("Price is required and must be a numeric value greater than 0.");
            return false;
        }

        errorElement.text("");
        return true;
    }

    function validateQuantity(quantity, errorId) {
        var errorElement = $("#" + errorId);

        if (quantity.trim() === "" || isNaN(quantity) || parseInt(quantity) < 0) {
            errorElement.text("Quantity is required and must be a numeric value greater than or equal to 0.");
            return false;
        }

        errorElement.text("");
        return true;
    }



    

</script>