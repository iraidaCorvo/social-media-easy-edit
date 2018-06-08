<select <?php echo $serialize_attrs ?>>
    <?php foreach($options as $value => $text):?>
        <option <?php echo ($value== $selected) ? 'selected': null ?> value='<?php echo $value?>'><?php echo $text ?></option>
    <?php endforeach ?>
 </select>