<div class="app-conditions">
    <ul class="lux-ul-condition funkyradio">
        <li>
            <div class="funkyradio-default">
                <input type="radio" name="radio" id="radio1" />
                <label for="radio1">First Option default</label>
            </div>
        </li>
            <?php foreach ($conditions as $condition) {?>
            <li>
                <div class="funkyradio-default">
                    <input  type="radio"  value="option1" id="<?php echo $condition['text']?>">
                    <label for="<?php echo $condition['text']?>"><?php echo $condition['text']?></label>

                </div>
            </li>
            <?php } ?>
        </ul>
</div>
