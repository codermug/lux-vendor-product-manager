<div class="app-conditions">
    <div class="row">
        <div class="col-md-6">
            <?php $i=0;?>
            <?php foreach ($conditions as $condition) {?>

            <?php $i++;?>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio"  value="option1"> <?php echo $condition['text']?>
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