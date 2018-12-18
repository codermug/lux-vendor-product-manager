
var lux_vendor_materials = data_array.materials;
var lux_nds_admin_nonce = data_array.nonce;


jQuery(document).ready(function () {
    var table2 = jQuery('#categoriesTable').DataTable({
        "paging":   true,
        "ordering": false,
        "info":     false,
        "aaSorting": []

    });
   /* var table1= jQuery('.myTable').DataTable({
        "paging":   true,
       // "ordering": true,
        "info":     true,

    });*/

    jQuery('#appCatMaterials').submit(function(e){
        e.preventDefault();
    });

    
    if(jQuery('#app').length) {
        var vueApp = new Vue ({
            el: '#app',
            data: {
                search: '',
                postList : lux_vendor_materials,
                checkedList: []
            },
            computed: {
                filteredList: function filteredList() {
                    var _this = this;
                    return this.postList.filter(function  (post) {
                        return post.name.toLowerCase().includes(_this.search.toLowerCase())
                    });
                },
                
            },
            methods: {
                setMaterial: function (val) {
                    console.log(val);
                    this.checkedList.push(val);
                },
                removeMaterial: function (val) {
                    var index = this.checkedList.indexOf(val);
                    if (index > -1) {
                        this.checkedList.splice(index, 1);
                    }
                },
               
                isExist : function(val){
                    for(var i=0; i < this.checkedList.length; i++){
                      if( this.checkedList[i] == val){
                        return true
                      }
                    }
                    return false
                }
              
            }
        });
        __submit_materials(vueApp);
    }
    


    jQuery('#myModal').on('show.bs.modal', function (e) {
        console.log('ss');
    });
    jQuery('#myModal').on('shown.bs.modal', function (event) {

        jQuery('.search-materials').val();
        // reset search filter vue.js
        var button = jQuery(event.relatedTarget);
        var category_name = button.data('category_name');
        var category_id = button.data('category_id');
        var modal = jQuery(this);
            modal.find('.modal-title').text('Set Materials for ' + category_name );
            modal.find('input[name=category_id]').val(category_id);
    });
    jQuery('#myModal').on('hidden.bs.modal', function (e) {
        __reset_form();
    });
    _remove_element();

});






function __disable_form() {
    jQuery('#appCatMaterials').find('input[type=text]').prop('disabled', true);
   // jQuery('#appCatMaterials').find('input:checkbox').prop('disabled', true);
    jQuery('#appCatMaterials').find('.submit').prop('disabled', true).html('please wait ...');
}
function __reset_form() {
    jQuery('#appCatMaterials').find('.alert').hide();
    jQuery('#appCatMaterials').find('.submit').html('Save').prop('disabled', false);
    jQuery('#appCatMaterials').find('input[name=category_id]').val('');
    jQuery('#appCatMaterials').find('input[type=text]').prop('disabled', false);
    jQuery('#appCatMaterials').find('input:checkbox').prop('disabled', false).removeAttr('checked');
    vueApp.checkedList = [];
}
function __submit_materials(vueApp) {
    var $form = jQuery('#appCatMaterials');
        $form.find('.alert').hide();

    jQuery(".submit").on('click',function (e) {
        e.preventDefault();
        __disable_form();

        jQuery.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data    : {'materials':vueApp.checkedList,'nds_admin_nonce':lux_nds_admin_nonce,'action':'lux_form_cat_materials','category_id':jQuery('#myModal').find('input[name=category_id]').val()},
            dataType:"json",
            success: function (response) {
                $form.find('.alert').addClass('alert-'+response.alert).html(response.msg).show();
                setTimeout(function () {
                    jQuery('#myModal').modal('hide');

                },700);
            },
            fail: function () {
                console.log("submittion fail");
            }
        });
    });
}



function _remove_element() {
    //$.each('.del-Material',function(){
            jQuery('.del-material').on('click',function(e) {
                e.preventDefault();
                alert('s')
                var $form = jQuery(this).closest('form');
                console.log($form.serialize());
                jQuery.ajax({
                    type: 'POST',
                    url : $form.attr('action'),
                    data: $form.serialize(),
                    dataType:"json",
                    success: function (response) {
                        
                        console.log(response);
                        jQuery('#lux-vendor-page')
                            .find('.alert')
                            .addClass('alert-'+response.alert).
                            html(response.msg)
                            .show();
                    },
                    fail: function () {
                        console.log("submittion fail");
                    }
                });
            });
    //});
    
}