<div class="modal-content">
    <div class="modal-header">
        <h2 class="modal-title">Edit Products</h2>
    </div>
    <?php
    $attributes = array("name" => "save_details", "method" => "POST");
    echo form_open_multipart("productscontroller/update_details", array("id" => "editForm"));
    ?>

    <div class="modal-body">
        <div>
            <input type="hidden" name="id" value="<?php echo $product[0]['id']; ?>">
        </div>

        <div class="form-group mb-3">
            <label for="name">Products Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product name" value="<?php echo $product[0]['name'] ?>">
            <span id="edit-name-error" class="text-danger"></span>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="price" value="<?php echo $product[0]['price'] ?>">
                    <span id="edit-price-error" class="text-danger"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter location" value="<?php echo $product[0]['quantity'] ?>">
                    <span id="edit-quantity-error" class="text-danger"></span>
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>

    <?php echo form_close(); ?>
</div>