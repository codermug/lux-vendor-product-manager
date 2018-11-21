<section class="app-photos">
    <div class="row">
        <div class="col-md-3">
            <form></form>
            <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" enctype="multipart/form-data">
                <div class="lux-photo-btn lux-info fileinput-button" data-info="front">
                    <span class="title"><i class="fa fa-plus"></i> Front</span>
                    <input  type="file" name="file">
                    <div class="files"></div>
                    <span class="error"></span>
                </div>
            </form>
        </div>
       <div class="col-md-3">
           <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" enctype="multipart/form-data">
               <div class="lux-photo-btn lux-info fileinput-button" data-info="back">
                   <span class="title"><i class="fa fa-plus"></i> Back</span>
                   <input  type="file" name="file">
                   <div class="files"></div>
                   <span class="error"></span>
               </div>
           </form>
        </div>
        <div class="col-md-2">
            <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" enctype="multipart/form-data">
                <div class="lux-photo-btn lux-info fileinput-button" data-info="corners">
                    <span class="title"><i class="fa fa-plus"></i> Corners</span>
                    <input  type="file" name="file">
                    <div class="files"></div>
                    <span class="error"></span>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" enctype="multipart/form-data">
                <div class="lux-photo-btn lux-info fileinput-button"  data-info="label">
                    <span class="title"><i class="fa fa-plus"></i> Label</span>
                    <input  type="file" name="file">
                    <div class="files"></div>
                    <span class="error"></span>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" enctype="multipart/form-data">
                <div class="lux-photo-btn lux-info fileinput-button"  data-info="serial-no">
                    <span class="title"><i class="fa fa-plus"></i> Serial No</span>
                    <input  type="file" name="file">
                    <div class="files"></div>
                    <span class="error"></span>
                </div>
            </form>
        </div>
    </div>
</section>
<style>

</style>