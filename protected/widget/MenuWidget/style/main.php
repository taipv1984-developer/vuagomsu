<?php
//get data
$menuItem = $setting['menuItem'];
?>
<div class="main_menu">
    <?php
    $template = dirname(__DIR__)."/temp/_temp.php";
    $setting = array(
        'class' => array(
            '0' => 'nav navbar-nav navbar-right menu_right',
            '1' => 'dropdown-menu dropdown-menu-1',
        ),
    );
    TemplateHelper::renderRecursive($menuItem, 'id', $template, $setting);
    ?>
</div>