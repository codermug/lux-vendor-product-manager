<div id="appModalsP">
   <!-- <div class="jumbotron">
    <h3 class="display-4">Sell an item</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    </div>-->
    <form action="<?php echo  admin_url('admin-ajax.php')?>" method="post" id="smvi" >
     
        <div class="lux-box">
                    <div class="row">
                        <div class="col-md-9">
                                    <div  class="label-title">Product Details <span class="d-md-none d-sm-block"  data-toggle="collapse" href="#tipsInfo" role="button" aria-expanded="false" aria-controls="tipsInfo"><i class="fa fa-info-circle"></i></span></div>
                                   
                                    <div class="row">
                                        <div class="col-md-12 lux-info" data-info="name">
                                            <div class="form-group">
                                                <input type="text" class="form-control rounded-0 " v-bind:class="{ 'is-invalid': attemptSubmit && selected_n=='' }" name="pname" placeholder="Product Name" v-model="selected_n" />
                                                <div class="invalid-feedback" v-bind:class="{ 'd-block': attemptSubmit && selected_n=='' }">Make sure to write product name.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 lux-info" data-info="description">
                                             <div class="form-group">
                                                <textarea class="form-control rounded-0 " name="pdescription" placeholder="Product Description" v-bind:class="{ 'is-invalid': attemptSubmit && selected_d=='' }" v-model="selected_d"></textarea>
                                                <div class="invalid-feedback" v-bind:class="{ 'd-block': attemptSubmit && selected_d=='' }">Make sure to provide description.</div>
                                              </div>
                                        </div>
                                    </div>
                        
                                    <div id="">
                                        <div class="row">
                                            <div class="col-md-6 lux-info" data-info="category">
                                                <div class="form-group">
                                                    <div class="form-control rounded-0 cb-input cb-ct" data-toggle="modal" data-target="#categoryModal" v-bind:class="{ 'is-invalid': attemptSubmit && (selected_c=='' || selected_g =='' || selected_b=='' ) }">Gender{{selected_g.text}} | Category{{selected_c.text}} | Brand{{selected_b.text}}</div>
                                                    <div class="invalid-feedback" v-bind:class="{ 'd-block': attemptSubmit && (selected_c=='' || selected_g =='' || selected_b=='' )}">Make sure to select product gender, brand and category.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 lux-info" data-info="materials">
                                                <div class="form-group">
                                                    <div class="form-control rounded-0 cb-input cb-mt" v-bind:class="[slCat ==0 ? 'disabled' : '',  attemptSubmit && (selected_m=='' || selected_cl =='' || selected_co=='' ) ? 'is-invalid' :'']" data-toggle="modal" :data-target="slCat==0? '' : '#materialModal'" >Material{{selected_m.text}} | Color{{selected_cl.text}}| Condition{{selected_co.text}}</div>
                                                    <div class="invalid-feedback" v-bind:class="{ 'd-block': attemptSubmit && (selected_m=='' || selected_cl =='' || selected_co=='' )}">Make sure to select product material, color and condition.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php _includes('front/_category_brand_modal.php')?>
                                        <?php _includes('front/_condition_modal.php')?>
                                    </div>
                        </div>
                        <div class="col-md-3  ">
                                    <div class="collapse d-md-block" id="tipsInfo">
                                        <div class="card border-0 mb-2">
                                            <span data-toggle="collapse" href="#tipsInfo" role="button" class="d-md-none btn">
                                                <i class="fa fa-times-circle 3x"></i>
                                            </span>
                                            <?php _includes('front/_product_information_tips.php')?>
                                        </div>
                                    </div>
                            <?php //_includes('front/_product_information_tips.php')?>
                        </div>
                    </div>
        </div>
        
        <div class="lux-box">
            <div class="row">
                <div class="col-md-9">
                        <div  class="label-title">Upload Photos  <span class="d-md-none d-sm-block"  data-toggle="collapse" href="#tipsPhoto" role="button" aria-expanded="false" aria-controls="tipsPhoto"><i class="fa fa-info-circle"></i></span> </div>
                    
                        <?php  _includes('front/_photo_uploader.php')?> 
                </div>
                <div class="col-md-3">
                        <div class="collapse d-md-block" id="tipsPhoto">
                            <div class="card border-0 mb-2">
                                <span data-toggle="collapse" href="#tipsPhoto" role="button" class="d-md-none btn">
                                    <i class="fa fa-times-circle 3x"></i>
                                </span>
                                <?php _includes('front/_photo_uploader_tips.php')?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="lux-box">
            <div class="row">
                <div class="col-md-9">
                   <div class="row">
                       <div class="col-md-8">
                       <div class="label-title">Item Dimension:</div>
                            <div class="row no-gutters dimension">
                                <div class="col-md-4">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                             <div class="input-group-text">KG</div>
                                        </div>
                                        <input type="text" class="form-control"  placeholder="Weight" name="we" v-model="selected_w" v-bind:class="{ 'is-invalid': attemptSubmit && selected_w=='' }">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                             <div class="input-group-text">CM</div>
                                        </div>
                                        <input type="text" class="form-control"  name="wi" placeholder="Width" v-model="selected_wi"  v-bind:class="{ 'is-invalid': attemptSubmit && selected_wi=='' }">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                             <div class="input-group-text">CM</div>
                                        </div>
                                        <input type="text" class="form-control mr-0" name="he" placeholder="Height" v-model="selected_h"  v-bind:class="{ 'is-invalid': attemptSubmit && selected_h=='' }">
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="col-md-4">
                         <div class="label-title">Item Price:</div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                        <div class="input-group-text">£</div>
                                </div>
                                <input type="text" class="form-control" name="pr"  placeholder="Price" v-model="selected_p"  v-bind:class="{ 'is-invalid': attemptSubmit && selected_p=='' }">
                            </div>
                       </div>
                   </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
       
        <div class="lux-box border-0">
            <div class="row">
                    <div class="col-md-9">
                       
                        <div class="form-group float-right">
                            <button type="submit" class="btn  btn-smvi woocommerce-Button button" v-on:click="validateForm">Send</button>
                        </div>
                        <p v-if="hasError" class="float-right m-2">*Please fill out the all required fields</p>
                    </div>
                    <div class="col-md-3">
                    
                    </div>
            </div>    
        </div>    
                    
    </form>
</div>