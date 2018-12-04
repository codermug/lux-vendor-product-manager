<br>
<a class="btn btn-secondary rounded-0" href="<?php echo _lux_admin_url('categories')?>">Back to Categories</a>
<div class="card p-0 rounded-0" style="width: 100% !important; max-width: 100% !important;" id="lux-vendor-page">
    <div class="card-header rounded-0">Category</div>
    <div class="card-body rounded-0">
    <div class="alert alert-success" role="alert" style="display: none"></div>
        <h3><?php echo $category->name;?></h3><br>
        <?php if(count($records)) {?>
            <table class="table table-hover" id="categoriesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Term ID</th>
                        <th>Material</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record) {?>
                        <tr>
                            <td><?php echo $record->id?></td>
                            <td><?php echo $record->term_id?></td>
                            <td><?php echo $record->material_name?></td>
                            <td width="20%" class="text-center">
                                    <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" >
                                        <input type="hidden" value="<?php echo $nonce?>" name="nonce">
                                        <input type="hidden" value="<?php echo $record->id?>" name="delid">
                                        <input type="hidden" value="lux_form_del_cat_materials" name="action">
                                        <button class="btn btn-sm btn-info rounded-0 del-material" type="submit">Remove</button>
                                    </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>