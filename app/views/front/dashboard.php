<form id="app">
    <div class="lux-box">
        <div class="row">
            <div class="col-md-2 lux-box-steps"><h5>Step 1</h5></div>
            <div class="col-md-7">
                <h3  class="label-title">Product Details</h3>
                <div class="row">
                    <div class="col-md-12 lux-info" data-info="description">
                        <textarea class="form-control rounded-0 mb-4" placeholder="Product Description"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 lux-info" data-info="category">
                        <div class="form-control rounded-0 cb-input" data-toggle="modal" data-target="#categoryModal">Category | Brand</div>
                    </div>
                </div>

                <?php _includes('front/_category_brand.php')?>
                <div class="row lux-info">
                    <div class="col-md-12 lux-info" data-info="conditions" >
                        <hr>
                        <?php _includes('front/_condition.php',['conditions'=>$conditions])?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="tips">
                    <div class="info-description">
                        <span><i class="fa fa-info-circle"></i> How to write description</span>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                    </div>
                    <div class="info-category ">
                        <span><i class="fa fa-info-circle"></i> Select Category & Brand</span>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                    </div>
                    <div class="info-conditions ">
                        <span><i class="fa fa-info-circle"></i> Product Condition</span>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lux-box">
        <div class="row">
            <div class="col-md-2 lux-box-steps"><h5>Step 2</h5></div>
            <div class="col-md-7">
                       <h3  class="label-title">Upload Photos</h3>
                       <?php  _includes('front/_photo_uploader.php')?>
            </div>
            <div class="col-md-3">
                <div class="tips">
                    <div class="info-front">
                        <span>Front Side</span>
                        is simply dummy text of the printingthe industry's standard dummy text ever
                        <img src="<?php echo plugins_url('lux-vendor-product-manager/assets/images/front.jpg')?>">
                    </div>
                    <div class="info-back">
                        <span>Back Side Photo</span>
                        is simply dummy text of the printingthe industry's standard dummy text ever
                        <img src="<?php echo plugins_url('lux-vendor-product-manager/assets/images/back.jpg')?>">
                    </div>
                    <div class="info-corners">
                        <span>Corners</span> load image ...
                    </div>
                    <div class="info-label">
                        <span>Label</span> load label ...
                    </div>
                    <div class="info-serial-no">
                        <span>Serial No</span> load Serial no ...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lux-box">
        <div class="row">
            <div class="col-md-2 lux-box-steps"><h5>Step 3</h5></div>
            <div class="col-md-10">
                <h4 class="label-title">Prices:</h4>
                <div class="row app-prices">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Item Price</label>
                            <input type="text" class="form-control rounded-0 mp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>You Receive</label>
                            <input type="text" class="form-control rounded-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <input type="hidden" class="app-nnn" name="nnn" value="<?php echo  wp_create_nonce("my_user_vote_nonce");?>">
    </form>


<script>

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

</script>