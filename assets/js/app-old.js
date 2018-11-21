var __disable_buttons = function() {
    jQuery('.sw-btn-next').attr('disabled',true);
    jQuery('.sw-btn-prev').hide();

}
var __disable_next = function() {

    console.log(jQuery('.app-brands').val());
    console.log(jQuery('.app-categories').val());
    if( jQuery('.app-brands').val()== -1 || jQuery('.app-categories').val()==-1) {
        jQuery('.sw-btn-next').attr('disabled',true);
    }
}

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
    // Change this to the location of your server-side upload handler:
    var url = jQuery('#fileupload').attr('data-url');
    var  uploadButton = jQuery('<button/>')
        .addClass('btn btn-primary')
        .prop('disabled', true)
        .text('Processing...')
        .on('click', function () {
            var $this = jQuery(this),
                data = $this.data();
            $this
                .off('click')
                .text('Abort')
                .on('click', function () {
                    $this.remove();
                    data.abort();
                });
            data.submit().always(function () {
                $this.remove();
            });
        });
    jQuery('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = jQuery('<div/>').appendTo('#files');
        jQuery.each(data.files, function (index, file) {
            var node = jQuery('<p/>')
                .append(jQuery('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = jQuery(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append(jQuery('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        jQuery('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        jQuery.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = jQuery('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                jQuery(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = jQuery('<span class="text-danger"/>').text(file.error);
                jQuery(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        jQuery.each(data.files, function (index) {
            var error = jQuery('<span class="text-danger"/>').text('File upload failed.');
            jQuery(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !jQuery.support.fileInput)
        .parent().addClass(jQuery.support.fileInput ? undefined : 'disabled');
});

jQuery(document).ready(function () {
    __load_colors();
    var nonce =jQuery('.app-nnn').val();


    var luxWizard = jQuery('#smartwizard').smartWizard({
        selected: 0,  // Initial selected step, 0 = first step
        keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
        autoAdjustHeight:false, // Automatically adjust content height
        cycleSteps: false, // Allows to cycle the navigation of steps
        backButtonSupport: true, // Enable the back button support
        useURLhash: false, // Enable selection of the step based on url hash
        showStepURLhash: false,
        lang: {  // Language variables
            next: 'Next',
            previous: 'Previous'
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'right', // left, right
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button

        },

        contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
        disabledSteps: [],    // Array Steps disabled
        errorSteps: [],    // Highlight step with errors
        transitionEffect: 'fade', // Effect on navigation, none/slide/fade
        transitionSpeed: '400'
    }).on("showStep", function(e, anchorObject, stepNumber, stepDirection) {

        jQuery('.sw-btn-prev').show();
       if(stepNumber==0) {
           jQuery('.sw-btn-prev').hide();
       }
       if(stepNumber==1) {

       }
    });

    // disable next button
    //__disable_buttons();

    jQuery('app-prices').find('.mp').blur(function () {
        __clpr();
    });
    jQuery('.app-brands').select2({
        placeholder: "Select a state",
    }).on('select2:select', function (e) {
        __enable_next();
    }).on('change', function (e) {
        console.log('on change.. brands')
        __disable_next();
    });
    jQuery('.app-categories').select2({
        placeholder: "Select a state",
        width: 'resolve',
    }).on('change', function (e) {
        console.log('on change.. categories')
        __disable_next();
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
        alert(file_data)

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
                search: '',
                search_brands: '',
                postList : ['cateory1','data2','data3'],
                brandsList : ['cateory1','data2','data3'],
                counter: 0
            },
            computed: {
                filteredList: function filteredList() {
                    var _this = this;
                    return this.postList.filter(function  (post) {
                        return post.toLowerCase().includes(_this.search.toLowerCase());
                    });
                }
            }
        });

    });





});

