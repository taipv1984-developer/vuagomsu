<?php
//get data
$menuItem = $setting['menuItem'];
?>
<div class="menu_vertical">
    <?php
    $template = dirname(__DIR__)."/temp/_temp.php";
    $setting = array(
        'class' => array(
        ),
    );
    TemplateHelper::renderRecursive($menuItem, 'id', $template, $setting);
    ?>
</div>