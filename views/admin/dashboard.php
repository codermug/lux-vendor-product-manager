<?php $materials = Inc\DataService::wooCommerceMaterials(1)?>
<?php $categories =  Inc\DataService::wooCommerceCategories()?>
<!--suppress ALL -->
<div>
    <div class="col">Manage Categories
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>Categories</th>
                    <th class="text-center">Total Products</th>
                    <th>Material</th>
                </tr>
            <thead>
            <tbody>
            <?php foreach ($categories as $category) { ?>
                <?php if (isset($category['children'])) { ?>
                            <?php foreach ($category['children'] as $child) { ?>
                                <tr>
                                    <td>
                                        <?php echo '<br> ---------- ' . $child['text']?>
                                    </td>
                                    <td class="text-center">  <?php echo $child['total_products']?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">  Set Materials </button>
                                    </td>
                                </tr>
                            <?php } // end loop of children subcategories ?>

                            <tr>
                                <td>
                                    <?php echo $category['text']?>
                                </td>
                                <td class="text-center"><?php echo $category['total_products']?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">  Set Materials </button>
                                </td>
                            </tr>
                <?php } else {?>
                    <tr>
                        <td>
                            <?php echo $category['text']?>
                        </td>
                        <td class="text-center"><?php echo $category['total_products']?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">  Set Materials </button>
                        </td>
                    </tr>
                <?php }// end of  (isset($category['children'])) ?>


            <?php }// end categories loop ?>
            </tbody>
        </table>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
        <div class="modal-content" id="app">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Materials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="search-wrapper">
                        <input type="text" class="form-control search-materials" v-model="search"  placeholder="Search title.."/>
                    </div>
                    <div class="row">
                        <div class="col-md-6" v-for="post in filteredList">
                                <div class="form-check form-check-inline"  v-bind:href="post.title">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        {{post.name}}
                                    </label>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save" v-on:click="counter += 1">Save changes {{counter}}</button>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-body{
        height: 250px;
        overflow-y: auto;
    }
</style>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css"        href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "paging":   false,
            "ordering": false,
            "info":     false
        });

        /*$('#myModal').find('.save').on('click',function () {
            alert('dd');
        })*/

    });
    $('#myModal').on('show.bs.modal', function () {
        console.log('ss');
    });
    $('#myModal').on('show.bs.modal', function () {
        console.log('ss');
        $('.search-materials').val();
        alert('sss')

        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    });
    $('#myModal').on('hidden.bs.modal', function (e) {
       alert('hide');
    })

    var materials =  <?php echo Inc\DataService::wooCommerceMaterials(1)?>;
    console.log(materials);

     app = new Vue ({
        el: '#app',
        data: {
            search: '',
            postList : materials,
            counter: 0
        },
        computed: {
            filteredList: function filteredList() {
                var _this = this;
                return this.postList.filter(function  (post) {
                        return post.name.toLowerCase().includes(_this.search.toLowerCase())
                })
            }
        }
    });


</script>