<div class="card p-0" style="width: 100% !important; max-width: 100% !important;">
    <div class="card-header">Category</div>
    <div class="card-body">
        <h3><?php echo $category->name;?></h3>
        <?php if(count($materials)) {?>
            <table class="table table-hover">
            <?php foreach ($materials as $material) {?>
               <tr><td><?php echo $material->name?></td>
                   <td width="20%" class="text-center"><button class="btn btn-sm btn-info">Remove</button></td>
               </tr>
            <?php } ?>
            </table>
        <?php } ?>

    </div>
</div>