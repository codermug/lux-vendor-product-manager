 <div class="row">
        <div class="col-md-4">
            <form></form>
            <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>" data-content="front" method="POST" enctype="multipart/form-data">
                <div class="lux-photo-btn lux-info fileinput-button" data-info="front" v-bind:class="{ 'is-invalid': attemptSubmit && selected_gallery.indexOf(0)==-1 }">
                    <span class="title"><i class="fa fa-plus"></i> Front</span>
                    <input  type="file" name="file"   >
                    <div class="files"></div>
                    <span class="error"></span>
                </div>
            </form>
        </div>
       <div class="col-md-4">
           <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>"  data-content="back" method="POST" enctype="multipart/form-data">
               <div class="lux-photo-btn lux-info fileinput-button" data-info="back" v-bind:class="{ 'is-invalid': attemptSubmit && selected_gallery.indexOf(1)==-1 }">
                   <span class="title"><i class="fa fa-plus"></i> Back</span>
                   <input  type="file" name="file">
                   <div class="files"></div>
                   <span class="error"></span>
               </div>
           </form>
        </div>
        <div class="col-md-4">
            <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>"  data-content="corners" method="POST" enctype="multipart/form-data">
                <div class="lux-photo-btn lux-info fileinput-button" data-info="corners" v-bind:class="{ 'is-invalid': attemptSubmit && selected_gallery.indexOf(2)==-1 }">
                    <span class="title"><i class="fa fa-plus"></i> Corners</span>
                    <input  type="file" name="file">
                    <div class="files"></div>
                    <span class="error"></span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
            <div class="col-md-4">
                <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>"  data-content="inside" method="POST" enctype="multipart/form-data">
                    <div class="lux-photo-btn lux-info fileinput-button"  data-info="inside" v-bind:class="{ 'is-invalid': attemptSubmit && selected_gallery.indexOf(3)==-1 }">
                        <span class="title"><i class="fa fa-plus"></i> Inside</span>
                        <input  type="file" name="file">
                        <div class="files"></div>
                        <span class="error"></span>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>"  data-content="label" method="POST" enctype="multipart/form-data">
                    <div class="lux-photo-btn lux-info fileinput-button"  data-info="label" v-bind:class="{ 'is-invalid': attemptSubmit && selected_gallery.indexOf(4)==-1 }">
                        <span class="title"><i class="fa fa-plus"></i> Label</span>
                        <input  type="file" name="file">
                        <div class="files"></div>
                        <span class="error"></span>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form class="fileupload" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST"  data-content="serial_no" enctype="multipart/form-data">
                    <div class="lux-photo-btn lux-info fileinput-button"  data-info="serial-no" v-bind:class="{ 'is-invalid': attemptSubmit && selected_gallery.indexOf(5)==-1 }" > 
                        <span class="title"><i class="fa fa-plus"></i> Serial No</span>
                        <input  type="file" name="file">
                        <div class="files"></div>
                        <span class="error"></span>
                    </div>
                </form>
            </div>
    </div>