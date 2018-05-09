<form method = '<?php echo $method?>' action='<?php echo $action?>'>
    <?php foreach($fields as $field => $value):
                //include SMEE_VIEWS . 'input.php';
                echo $value->render();
            endforeach;
    ?>
    <input type = 'submit'/>
</form>