console.log(data_array);



var __enable_next = function() {
    if( jQuery('.app-brands').val()>0 && jQuery('.app-categories').val()>0) {
        jQuery('.sw-btn-next').attr('disabled',false);
       // luxWizard.smartWizard("next");
    }
}

var __loading_btn = function (loading) {
    var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
    jQuery('.sw-btn-next').html('Next');
    if(loading && jQuery('.app-brands').val()>0) {
        jQuery('.sw-btn-next').attr('disabled',true).html(loadingText);
    }
}

var __load_colors = function () {
    var _colors = '<div class="row"><div class="col"><ul>';
    var colors = ['white','off-white','beige',

        'grey',
        'silver',
        'gold',
        'brown',
        'red',
        'pink',
        'orange',
        'yellow',
        'lime',
        'green',
        'turquoise',
        'blue',
        'dark-blue',
        'purple',
        'navy',
        'violet','black'];
    jQuery.map( colors.sort(), function( val, i ) {
        var j = i+1;
        _colors += '<li class="form-check">';
        _colors += '<label class="color form-check-label" for="'+val+'">';
        _colors += '<input type="radio" name="color" class="form-check-input" id="'+val+'"/>';
        _colors += '<span class="'+val+'"></span> '+ val +'</label>';
        _colors += '</li>';

        console.log(j);
        if(j % 5 == 0) {
            _colors +='</ul></div><div class="col"><ul> ';
        }
    });
    _colors +='</ul></div></div>';
    jQuery('.app-colors').html(_colors);

}
var __clpr = function () {
    alert('__clpr');
}

jQuery(function () {
    'use strict';

    jQuery('.fileupload').each(function (index) {
        console.log('uploader is '  +index)
        console.log(jQuery(this).attr('action'));
        var  url = jQuery(this).attr('action');
        var $form = jQuery(this);
        jQuery(this).fileupload({
            url: url,
            type : 'POST',
            formData: {action: 'md_support_save'},
            autoUpload: true,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize: 999000,
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            previewMaxWidth: 100,
            previewMaxHeight: 100,
            previewCrop: true,

        }).on('fileuploadadd', function (e, data) {

            data.context = jQuery('<div/>').appendTo($form.find('.files'));
            jQuery.each(data.files, function (index, file) {
                var node = jQuery('<p class="m-0"/>');
                node.appendTo(data.context);
            });
            $form.find('span.title').hide();
            //data.submit();

        })
            .on('fileuploadstart', function (e)
            {
                $form.find('span.title').hide();
                $('<div class="loader"><div class="td"><div class="uprogress"><div class="bar" style="width: 0%;"></div></div></div></div>')
                    .appendTo($form.find('.fileinput-button'));


            })
            .on('fileuploadprocessalways', function (e, data)
            {
                console.log(data);
                    var index = data.index,
                        file = data.files[index],
                        node = jQuery(data.context.children()[index]);
                    if (file.preview) {
                        node
                            .prepend('<br>')
                            .prepend(file.preview);
                    }
                    if (file.error) {
                        _handle_error($form,file.error);
                    }
                    if (index + 1 === data.files.length) {
                        data.context.find('button')
                            .text('Upload')
                            .prop('disabled', !!data.files.error);
                    }
            })
            .on('fileuploadprogressall', function (e, data)
            {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $form.find('.uprogress .bar').css('width', progress + '%');
            })
            .on('fileuploaddone', function (e, data)
            {
                $form.find('.uprogress').hide();
                var file = JSON.parse(data.result);
                if (file.url) {
                    $form.find('.loader > .td').append("<button class='btn btn-sm'><i class='fa fa-trash'></i></button>");
                    $form.find('.fileinput-button').css('border-color', '#ccc');
                } else if (file.status =='error') {
                    _handle_error($form,file.msg);
                }
            })
            .on('fileuploadfail', function (e, data)
            {
                jQuery.each(data.files, function (index) {
                    var error = jQuery('<span class="text-danger"/>').text('File upload failed.');
                    jQuery(data.context.children()[index])
                        .append('<br>')
                        .append(error);
                 });
        });/*.prop('disabled', !jQuery.support.fileInput)
            .parent().addClass(jQuery.support.fileInput ? undefined : 'disabled');*/
    });// end of fileupload loop

    function _handle_error($form,msg) {
        var error = jQuery('<span class="text-danger"/>').text(msg);
        $form.find('.error').append(error);
        $form.find('.loader').remove();
        $form.find('span.title').show();
        $form.find('.files').html('');
        $form.find('.fileinput-button').css('border-color', '#ff0000');
    }
});

jQuery(document).ready(function () {

    __load_colors();
    var nonce =jQuery('.app-nnn').val();

    jQuery('app-prices').find('.mp').blur(function () {
        __clpr();
    });
    jQuery('.app-brands').select2({
        placeholder: "Select a state",
    }).on('select2:select', function (e) {
        __enable_next();
    }).on('change', function (e) {
        console.log('on change.. brands')
    });
    jQuery('.app-categories').select2({
        placeholder: "Select a state",
        width: 'resolve',
    }).on('change', function (e) {
        console.log('on change.. categories')
    }).on('select2:select', function (e) {

        var data = e.params.data;
        console.log(data);
        // Post to the server
        jQuery.ajax({
            url : jQuery('#categories').attr('data-url'),
            type : 'post',
            dataType: 'json',
            data : {
                action : 'lux_vendor_get_materials',
                category_id : data['id'],
                nonce: nonce
            },

            success : function( response ) {

                console.log('responce :')
                console.log(response)
                var data =  jQuery.makeArray( response );
                console.log('data');
                console.log(data);
                if(data.length) {
                    var tmpl = '<div class="row"><div class="col">';
                    jQuery.map( data, function( val, i ) {
                        var j = i+1;
                        console.log(val)
                        tmpl += '<div class="form-check">';
                        tmpl += '<label class="form-check-label">';
                        tmpl += '<input class="form-check-input" type="checkbox" id="" name="materials[]">';
                        tmpl += val.name;
                        tmpl += '</label>';
                        tmpl += '</div>';

                        if(j % 4 == 0) {
                            tmpl +='</div><div class="col"> ';
                        }
                    });

                    tmpl +='</div></div>'
                    jQuery('.app-materials').html(tmpl);
                }


            },
            complete: function () {
                __enable_next();
            }


        });
    });

    jQuery('.save-support').on('click', function (e) {

        var supporttitle = jQuery('.support-title').val();
        alert(supporttitle);

        var querytype = jQuery('.support-query').val();
        var file_data = jQuery('#sortpicture').prop('files')[0];
        alert(file_data);

        var form_data = new FormData();
        if (supporttitle == '') {
            jQuery('.support-title').css({"border": "1px solid red"})
            //  return false;
        } else {
            jQuery('.support-title').css({"border": "1px solid #e3ecf0"})
        }

        form_data.append('file', file_data);
        form_data.append('action', 'md_support_save');
        form_data.append('supporttitle', supporttitle);

        alert(  jQuery('.save-support').attr('data-url') );
        jQuery.ajax({
            url: jQuery('.save-support').attr('data-url'),
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                jQuery('.Success-div').html("Form Submit Successfully");
            }
            /* error : function (response) {
             console.log('error');
             }*/

        });
    });

    // load colors
    jQuery('#categoryModal').on('shown.bs.modal', function (event) {

        app = new Vue ({
            el: '#appCategory',
            data: {
                search_category: '',
                search_brands: '',
                categoryList : ['category 1','category 2','category 3'],
                brandsList : ['brand 1','brand 2','brand 3'],
                counter: 0
            },
            computed: {
                filteredCategoryList: function filteredList() {
                    var _this = this;
                    return this.categoryList.filter(function  (post) {
                        return post.toLowerCase().includes(_this.search_category.toLowerCase());
                    });
                },
                filteredBrandList: function filteredList() {
                    var _this = this;
                    return this.brandsList.filter(function  (brand) {
                        return brand.toLowerCase().includes(_this.search_brands.toLowerCase());
                    });
                }
            }
        });

    });





});

