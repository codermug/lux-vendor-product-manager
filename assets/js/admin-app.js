'use strict';
var lux_vendor_materials = lux_vendor_materials;
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

    
    if(jQuery('#app').length) {
        var app = new Vue ({
            el: '#app',
            data: {
                search: '',
                postList : lux_vendor_materials,
                counter: 0
            },
            computed: {
                filteredList: function filteredList() {
                    var _this = this;
                    return this.postList.filter(function  (post) {
                        return post.name.toLowerCase().includes(_this.search.toLowerCase())
                    });
                }
            }
        });
    }
    __submit_materials();


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
}
function __submit_materials() {
    var $form = jQuery('#appCatMaterials');
        $form.find('.alert').hide();

    jQuery(".submit").on('click',function (e) {
        e.preventDefault();
        __disable_form();

        jQuery.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data:$form.serialize(),
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