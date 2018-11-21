<tr>
    <td>
        <?php echo (isset($is_child) ?  '-------- '.$text :  $text); ?>
    </td>
    <td class="text-center"><?php echo $total_products?></td>
    <td width="30%" class="text-center">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" data-category_name="<?php echo $text?>" data-category_id="<?php echo $id?>">  Set Materials </button>
        <a class="btn btn-sm btn-primary" href="<?php echo _lux_admin_url("categories",["a"=>"show","p"=>"category","id"=>$id])?>" class="btn btn-default">  Show Materials </a>
    </td>
</tr>