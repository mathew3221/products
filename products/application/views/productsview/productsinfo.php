<?php if (!empty($product)) { ?>
  <table class="table table-striped table-hover">
    <tbody>
      <?php foreach ($product as $pt) { ?>
        <tr>
          <th>Product name</th>
          <td><?php echo $pt['name'] ?></td>
        </tr>
        <tr>
          <th>Price</th>
          <td><?php echo $pt['price'] ?></td>
        </tr>
        <tr>
          <th>Quantity</th>
          <td><?php echo $pt['quantity'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>
