<?php
    if(!empty($product)){
        $i=0;
        foreach($product as $pt){
        $i++;
        ?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $pt['name']?></td>
            <td><?php echo $pt['price']?></td>
            <td><?php echo $pt['quantity']?></td>
            <td>
                <button class="btn btn-success" title="read" data-toggle="modal" data-target="#viewModal" onclick="get_product_info(<?php echo $pt['id'];?>);"><i class="fa fa-info"></i></button>
                <button class="btn btn-warning" title="edit" data-toggle="modal" data-target="#editModal" onclick="edit_product_info(<?php echo $pt['id'];?>);"><i class="fa fa-edit"></i></button>
                <button class="btn btn-danger" title="delete" onclick="delete_product_info(<?php echo $pt['id'];?>);"><i class="fa fa-trash"></i></button>
                
            </td>            
        </tr>   
        <?php }
    }?>
