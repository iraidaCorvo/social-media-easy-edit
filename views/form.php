<form method = '<?php echo $method?>' action='<?php echo $action?>'>
    <?php foreach($fields as $field => $value):
                echo $value->render();
            endforeach;
    ?>
</form>