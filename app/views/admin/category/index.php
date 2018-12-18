<?php $nds_admin_nonce = wp_create_nonce( 'nds_admin_nonce' );?>
<!--suppress ALL -->
<div class="row">
    <div class="col">
        <hr>
            <h1>Categories</h1>
        <hr>
        <table class="table table-hover " id="categoriesTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th class="text-center">Total Products</th>
                <th  class="text-center">Material</th>
                <th  class="text-right"></th>
            </tr>
            <thead>
            <tbody>
            <?php foreach ($categories as $category) { ?>
                <?php if (isset($category['children'])) { ?>

                    <?php _includes('admin/templates/_table_row.php',['text'=>$category['text'],'id'=>$category['id'],'total_products'=>$category['total_products']])?>

                    <?php foreach ($category['children'] as $child) { ?>

                        <?php _includes('admin/templates/_table_row.php',['text'=>$child['text'],'id'=>$child['id'],'total_products'=>$child['total_products'],'is_child'=>1])?>

                    <?php } ?>
                <?php } else {?>

                    <?php _includes('admin/templates/_table_row.php',['text'=>$category['text'],'id'=>$category['id'],'total_products'=>$category['total_products']])?>

                <?php } ?>
            <?php }// end categories loop ?>
            </tbody>
        </table>

    </div>
</div>

<!-- Modal -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
            <div class="modal-content rounded-0" id="app">
                <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="appCatMaterials" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Materials</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="alert alert-success" role="alert" style="display: none"></div>

                        <div class="search-wrapper">
                            <input type="text" class="form-control search-materials rounded-0" v-model="search"  placeholder="Search title.."/>
                        </div>
                        <div class="row mt-5 pt-4">
                            <div class="col-md-6" v-for="post in filteredList">
                                        <table class="table table-sm m-0">
                                            <tr>
                                                <td width="70%"> <span v-bind:class="[isExist(post.term_id) ? 'font-weight-bold':'']">{{post.name}}</td>
                                                <td>
                                                    <span class="btn btn-info btn-sm rounded-0" @click="setMaterial(post.term_id)"><i class="fa fa-plus"></i></span>
                                                    <span class="btn btn-secondary btn-sm rounded-0" @click="removeMaterial(post.term_id)"><i class="fa fa-minus"></i></span></td>
                                            </tr>
                                        </table>    
                                       
                                        
                            </div>
                            
                        </div>
                        <input type="hidden" name="category_id" value="">
                        <input type="hidden" name="action" value="lux_form_cat_materials">
                        <input type="hidden" name="nds_admin_nonce" value="<?php echo $nds_admin_nonce ?>" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary rounded-0" data-dismiss="modal">Close</button>
                        <button type="button" name="submit" class="btn btn-sm btn-info rounded-0 submit" >Save  </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<style>
    .modal-body{
        height: 400px;
        overflow-y: auto;
    }

    .modal-body .search-wrapper{
        position: fixed;
        width: 98%;
        background: #efefef;
        left: 2px;
        right: 10px;
        z-index: 1;
        padding: 10px;
    }

     .modal-body input[type=checkbox]:checked + label {
         background-color: #bbb;
     }
</style>



