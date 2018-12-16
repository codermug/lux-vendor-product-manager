<tr>
    <td><?php echo $id ?></td>
    <td>
        <?php echo (isset($is_child) ?  '-------- '.$text :  $text); ?>
    </td>
    <td class="text-center"><?php echo $total_products?></td>
    <td class="text-center"><?php echo App\Models\CategoryModel::getTotalMaterialsCount($id)->total?></td>
    <td width="30%" class="text-right">
        <button type="button" class="btn btn-sm btn-info rounded-0" data-toggle="modal" data-target="#myModal" data-category_name="<?php echo $text?>" data-category_id="<?php echo $id?>">  Set Materials </button>
        <a  href="<?php echo _lux_admin_url("categories",["a"=>"show","p"=>"category","id"=>$id])?>" class="btn btn-sm btn-secondary rounded-0">  Show Materials </a>
        <a href ="term.php?taxonomy=product_cat&tag_ID=<?php echo $id?>&post_type=product" class="btn btn-sm btn-secondary rounded-0">Show</a>
    </td>
</tr>