<form id="app">
        <div id="smartwizard" class="sw-main sw-theme-default">
            <ul class="nav nav-tabs step-anchor">
                <li class="nav-item active"><a class="nav-link" href="#step-1">Category & Brand<br /><small>This is step description</small></a></li>
                <li class="nav-item"><a class="nav-link" href="#step-5">Category & Brand 2<br /><small>This is step description</small></a></li>
                <li class="nav-item"><a class="nav-link"href="#step-2">Specification<br /><small>This is step description</small></a></li>
                <li class="nav-item"><a class="nav-link" href="#step-3">Photos<br /><small>This is step description</small></a></li>
                <li class="nav-item"><a class="nav-link" href="#step-4">Item Condition & Price<br /><small>This is step description</small></a></li>
            </ul>

            <div class="sw-container tab-content">
                <div id="step-1" class="tab-pane step-content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="label-title">Item For:</div>
                            <div class="app-gender">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> Women
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> Men
                                    </label>
                                </div>
                                <div class="form-check form-check-inline disabled">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled> Kids
                                    </label>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="label-title">Item Category:</div>
                            <div class="form-group">
                                 <select id="categories" name="category_id" class="app-categories form-control form-control-lg"  data-url="<?php echo  admin_url('admin-ajax.php')?>">
                                     <option value="-1">Please Select</option>
                                     <?php foreach($categories as $category) {?>
                                         <?php if(isset($category['children'])) {?>
                                             <optgroup label="<?php echo $category['text'] ?>"> <?php echo $category['text'] ?></optgroup>
                                                <?php foreach($category['children'] as $child) {?>
                                                         <option value="<?php echo $child['id']?>">
                                                                 <?php echo $child['text']; ?>
                                                         </option>
                                                <?php } ?>
                                        <?php } else { ?>
                                             <option value="<?php echo $category['id']?>">
                                                 <?php echo $category['text'] ?>
                                             </option>
                                         <?php } ?>
                                     <?php } ?>
                                 </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="label-title">Item Brand:</div>
                            <div class="form-group">
                                <select class="app-brands form-control form-control-lg" name="brand_id" >
                                    <option value="-1">Please Select</option>
                                    <?php foreach($brands as $brand) {?>
                                        <option value="<?php echo $brand['id']?>">
                                            <?php echo $brand['text'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="step-2" class="tab-pane step-content">
                    <h3  class="label-title">Materials</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="app-materials">
                                Load materials Please Wait .....
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3  class="label-title">Colors</h3>
                            <div class="app-colors">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="step-3" class="tab-pane step-content">
                    <div class="row">
                        <div class="col-md-8">
                            <h3  class="label-title">Photos</h3>
                            <?php  _includes('front/_photo_uploader.php')?>
                            <div class="app-photos">
                                <div class="row">
                                    <div class="col-md-6">Front</div>
                                    <div class="col-md-6">Back</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Asside</div>
                                    <div class="col-md-6">Back</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4 class="label-title">How To Capture a perfect photo</h4>
                            <p>
                                <ul>
                                    <li>Lorem Ipsum has been the industry's standard</li>
                                    <li> not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it</li>
                                    <li> If you are going to use a passage of Lorem Ipsum, you need to be sure </li>
                                    <li> to generate Lorem Ipsum which looks reasonable. The generated</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div id="step-4" class="tab-pane step-content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="label-title">Item Condition:</div>
                            <div class="app-conditions">
                                <div class="row">
                                    <div class="col-md-6">
                                    <?php $i=0;?>
                                    <?php foreach ($conditions as $condition) {?>

                                            <?php $i++;?>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox"  value="option1"> <?php echo $condition['text']?>
                                                </label>
                                            </div>
                                            <p><?php echo $condition['description']?></p>
                                            <?php if($i%4 ==0 ) { ?>
                                                </div><div class="col-md-6">
                                            <?php }?>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
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
                <div id="step-5" class="tab-pane step-content">
                   <?php _includes('front/_category_brand.php')?>
                </div>
            </div>
        </div>
        <input type="hidden" class="app-nnn" name="nnn" value="<?php echo  wp_create_nonce("my_user_vote_nonce");?>">
    </form>

<style>
    #app .step-content{
        margin: 2em;
    }
    #app hr{
        margin: 2em 0;
    }
    #appCategory .col-box {
        padding: 2em;
        background: #cccccc;
    }
    .label-title {
        color: #d79e61;
        text-transform: uppercase;
        font-weight: bold;
        margin: 0 0 20px 0;
    }
    .select2-container .select2-selection--single{
        border-radius: 0;
    }

    .select2-selection__rendered {
        line-height: 32px !important;
    }

    .select2-selection {
        height: auto !important;
    }
    input[type="radio"] {

    }
    input[type="radio"]:checked + label.color span {
        transform: scale(1.25);
    }
    input[type="radio"]:checked + label.color {
        border: 2px solid #711313;
    }

    label.color {
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
        text-transform: capitalize;
        font-size: .9em;
    }
    label.color:hover span {
        transform: scale(1.25);
    }
    label.color span {
        display: inline-block;
        width: 20px;
        height: 20px;
        transition: transform .2s ease-in-out;
    }
    label span.black {
        background: #000000;
    }
    label span.grey {
        background: #cccccc;
    }
    label span.gold {
        background: #cc9b1c;
    }
    label span.white {
        background: #ffffff;
        border: #fffedf 1px solid;
    }
    label span.beige {
        background: #F5F5DC;
    }
    label span.off-white {
        background: #fffedf;
    }
    label span.brown {
        background: #786600;
    }

    label span.red {
        background: #DB2828;
    }
    label span.orange {
        background: #F2711C;
    }
    label span.yellow {
        background: #FBBD08;
    }
    label span.lime {
        background: #B5CC18;
    }
    label span.olive {
        background: #306c16;
    }
    label span.green {
        background: #21BA45;
    }
    label span.teal {
        background: #00B5AD;
    }
    label span.blue {
        background: #2185D0;
    }
    label span.dark-blue {
        background: #170d91;
    }
    label span.turquoise {
        background: #2cd0c5;
    }
    label span.violet {
        background: #6435C9;
    }
    label span.purple {
        background: #A333C8;
    }
    label span.pink {
        background: #E03997;
    }
    label span.silver {
        background: #E4E4E4;
    }

</style>