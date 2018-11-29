<div class="card p-0" style="width: 100% !important; max-width: 100% !important;">
    <div class="card-header">Category</div>
    <div class="card-body">
        <h3><?php echo $category->name;?></h3>
        <?php if(count($materials)) {?>
            <table class="table table-hover">
            <?php foreach ($materials as $material) {?>
               <tr><td><?php echo $material->text?></td>
                   <td width="20%" class="text-center">
                        <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="del-Material">
                            <input type="hidden" value="<?php echo $nonce?>" name="nonce">
                            <input type="hidden" value="<?php echo $id?>" name="delid">
                            <button class="btn btn-sm btn-info rounded-0" type="submit">Remove</button>
                        </form>
                   </td>
               </tr>
            <?php } ?>
            </table>
        <?php } ?>

    </div>
</div>