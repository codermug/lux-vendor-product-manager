//console.log(data_array);

var _DATA_ARR = data_array;

console.log(_DATA_ARR._categories);

function load_uploaders(parentApp) {
    var myParent = parentApp;
    jQuery('.fileupload').each(function (index) {
        var  url = jQuery(this).attr('data-action');
        var $form = jQuery(this);
        var $pForm = jQuery('#smvi');
        var uploader_n  = index;
        jQuery(this).fileupload({
            url: url,
            type : 'POST',
            formData: {action: 'md_upfls_save'},
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
            $form.find('.fileinput-button').append('<div class="loader"><div class="td"><div class="uprogress"><div class="bar" style="width: 0%;"></div></div></div></div>');
            


        })
            .on('fileuploadprocessalways', function (e, data)
            {
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
                var attach_id = 'attachment_'+$form.attr('data-content');

                console.log('uploaded data');
                console.log(data);
                if (file.status=='success') {
                   
                    $form.find('.loader > .td').append( 
                        $('<button/>').addClass('btn btn-sm')
                                      .html("<i class='fa fa-trash'></i>")
                                      .on('click',function(e) {
                                            e.preventDefault();
                                            jQuery('#'+attach_id).remove();
                                            if(attach_id=="attachment_front") {
                                                jQuery('#attachment_thumbnail').remove();
                                            }
                                            $form.find('.title').show();
                                            $form.find('.files').html('');
                                            $form.find('.loader').remove();
                                           // remove element
                                            var index = myParent.selected_gallery.indexOf(uploader_n);
                                            if (index > -1) {
                                                myParent.selected_gallery.splice(index, 1);
                                            }
                                      })
                    );
                   // $form.find('.fileinput-button').css('border-color', '#ccc');
                    $pForm.append('<input type="hidden" name="attachments[]" id="'+attach_id+'" value="'+file.url+'">');
                    if(attach_id=="attachment_front") {
                        $pForm.append('<input type="hidden" name="thumbnail" id="attachment_thumbnail" value="'+file.url+'">');
                    }

                    myParent.selected_gallery.push(uploader_n);
                    console.log(myParent.selected_gallery);
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
        }).prop('disabled', !jQuery.support.fileInput).parent().addClass(jQuery.support.fileInput ? undefined : 'disabled');
    });// end of fileupload loop

    function _handle_error($form,msg) {
        var error = jQuery('<span class="text-danger"/>').text(msg);
        $form.find('.error').append(error);
        $form.find('.loader').remove();
        $form.find('span.title').show();
        $form.find('.files').html('');
        $form.find('.fileinput-button').css('border-color', '#ff0000');
    }
}



jQuery(document).ready(function () {

    var vAppCategory = new Vue ({
        el: '#appModalsP',
        data: {
            search_category: '',
            search_brand: '',
            search_material:'',
            search_color:'',
            search_condition:'',
          
            selected_g:'',
            selected_c:'',
            selected_b:'',
            selected_n:'',
            selected_d:'',
            selected_w:'',
            selected_p:'',
            selected_m:'',
            selected_cl:'',
            selected_co:'',
            selected_wi:'',
            selected_h:'',
            selected_t:'',
            selected_gallery : [],



            
            slCat:0,
            genderList : _DATA_ARR._gender,
            colorsList       : _DATA_ARR._colors,//['white','off-white','beige','grey','silver','gold','brown','red','pink','orange','yellow','lime','green','turquoise','blue','dark-blue','purple','navy','violet','black'],
            categoryList     : _DATA_ARR._categories,
            conditionList    : _DATA_ARR._conditions,
            brandsList       : _DATA_ARR._brands,
            catMaterialsList : _DATA_ARR._materials,
            materialsList    : [],

            attemptSubmit:false,
            SubmitSuccess: {status:false,text:''},
            hasError:'',
        
        },
        methods: {
            setBrand: function(id,text) {
                this.selected_b = {'id':id,'text':text};
                setTimeout(function(){  jQuery('#categoryModal').modal('hide');}, 300);
               
               
            },
            setGender: function(id,text) {
                this.selected_g = {'id':id,'text':text};
            },
            setMaterial: function(id,text) {
               
                this.selected_m = {'id':id,'text':text};
                console.log(this.selected_m);
            },
            setColor: function(id,text) {
                this.selected_cl = {'id':id,'text':text};
                console.log(this.selected_cl);
            },
            setCnd: function(id,text) {
                this.selected_co = {'id':id,'text':text};
                console.log(this.selected_co);
                
                setTimeout(function(){  jQuery('#materialModal').modal('hide');}, 300);
            },
            
            getMaterials:  function (id,text) {

              
              this.slCat =  id;

            
              console.log(id);
              var data = JSON.parse(this.catMaterialsList);
              
              this.selected_c = {'id':id,'text':text};
           
              
             // var provinceAbc = data.filter(d => d.province_id === 'ABC');
                for (var key in data) {
                    if(key == id) {
                        this.materialsList = data[key]['materials'];
                    }
                   // if (data.hasOwnProperty(key)) {
                     //   console.log(key + " -> " + data[key]);
                   // }
                }

                console.log(this.materialsList);
             
            },
            isNumeric: function (n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            },
            validateForm: function (event) {
                event.preventDefault();
                this.attemptSubmit = true;

                console.log("  this.selected_gallery.length = "+ this.selected_gallery.length);
                if (
                    this.selected_g == ''||
                    this.selected_c==''  ||
                    this.selected_b==''  ||
                    this.selected_n==''  ||
                    this.selected_d==''  ||
                    this.selected_w==''  ||
                    this.selected_p==''  ||
                    this.selected_m==''  ||
                    this.selected_cl=='' ||
                    this.selected_co=='' ||
                    this.selected_wi=='' ||
                    this.selected_h==''  ||
                    this.selected_t ==''
                   //this.selected_gallery.length < 6
                    ) {
                       
                     this.hasError = '*Please fill out the all required fields';
                } else {

                    this.hasError = '';
                    console.log('--- send ajax request ----- ')
                    var url =  jQuery('#smvi').attr('action');
                    var $form = jQuery('#smvi');
                    var vueObj = this;
                    
                    $form.find('input[name=gn]').val(this.selected_g.id);
                    $form.find('input[name=ct]').val(this.selected_c.id);
                    $form.find('input[name=bd]').val(this.selected_b.id);
                    $form.find('input[name=mt]').val(this.selected_m.id);
                    $form.find('input[name=color]').val(this.selected_cl.id);
                    $form.find('input[name=cnd]').val(this.selected_co.id);
                    //$form.find('button[type=submit]').html("Sending Please wait ...").attr('disabled',true);

                    jQuery.ajax({
                        url : url,
                        type : 'post',
                        //dataType: 'json',
                        data : {
                            action : 'md_pfm_save',
                            dt: jQuery('#smvi').serialize()
                        },
            
                        success : function( data ) {
                            var response = JSON.parse(data);
                            console.log('response')
                            console.log(response);
                            
                            
                            console.log('responce :')
                            console.log(response);
                            if(response.status == "success") {
                                vueObj.SubmitSuccess.status =true;
                                vueObj.SubmitSuccess.text = response.msg;
                                //alert( vueObj.SubmitSuccess)
                            } else if (response.status == "error") {
                                vueObj.hasError = response.msg;
                                
                            } else {
                                vueObj.hasError = response.msg;
                            }

                            console.log( "has error " + vueObj.hasError );    
                           
                            //$form.find('button[type=submit]').html("Send").attr('disabled',false);
            
                        },
                        complete: function () {
                          
                        },
                        error: function (r) {
                            console.log(r);
                            alert('error');
                        }

                    });
                    console.log( "has error " + vueObj.hasError );    

                }
            },
        },
        computed: {
         
            filteredCategoryList: function filteredList() {
                var _this = this;
                return this.categoryList.filter(function  (post) {
                    return post.text.toLowerCase().includes(_this.search_category.toLowerCase());
                });
            },
            filteredBrandList: function filteredList() {
                var _this = this;
                return this.brandsList.filter(function  (brand) {
                    return brand.text.toLowerCase().includes(_this.search_brand.toLowerCase());
                });
            },
            filteredMaterialsList: function filteredList() {
                var _this = this;
                return this.materialsList.filter(function  (material) {
                    return material.text.toLowerCase().includes(_this.search_material.toLowerCase());
                });
            },
            filteredColorsList: function filteredList() {
                var _this = this;
                return this.colorsList.filter(function  (color) {
                    return color.text.toLowerCase().includes(_this.search_color.toLowerCase());
                });
            },
            filteredConditionList: function filteredList() {
                var _this = this;
                return this.conditionList.filter(function  (cn) {
                    return cn.text.toLowerCase().includes(_this.search_condition.toLowerCase());
                });
            },
          
            
        },

        mounted : function() {
            console.log(this.conditionList);
            load_uploaders(this) ;
        },
        
       
    });
    
    $('.lux-info').hover(
        function () {
            var l = $(this).attr('data-info');
            console.log('.info-'+l);
            $('.info-'+l).addClass('show');
        },
        function () {
            var l = $(this).attr('data-info');
            $('.info-'+l).removeClass('show');
        }
    );

    var nonce =jQuery('.app-nnn').val();

    jQuery('app-prices').find('.mp').blur(function () {
        __clpr();
    });
    

    

    // load colors
   

    jQuery('#categoryModal').on('shown.bs.modal', function (event) {

        vAppCategory.search_category = "";
        vAppCategory.search_brand    = "";
       
        
    
    });
    jQuery('#categoryModal').on('hidden.bs.modal', function (event) {

        vAppCategory.search_category = "";
        vAppCategory.search_brand    = "";

                 
        
    
    });

   


   
});

