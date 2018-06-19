<?php
	//get data
	$layoutWidgetInfo = $setting['layoutWidgetInfo'];
	$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
	$categoryList = $setting['categoryList'];
?>

<div class='aside-item collection-category <?php echo $setting['class'] ?>'>
	<?php if($setting['show_title']){?>
        <div class="aside-title">
            <h3 class="title-head margin-top-0" id="mobileClickCate">
                <i class="fa fa-cubes" aria-hidden="true"></i>
                <?=$setting['title']?>
            </h3>
        </div>
	<?php } ?>

	<div class="aside-content" id="mobile-aside-content">
        <nav class="nav-category navbar-toggleable-md">
		<?php
			$template = __DIR__.'/menu.menu_item.php';
			$settingMenu = array(
				'class' => array(
					'0' => 'nav navbar-pills',
					'1' => 'dropdown-menu',
				),
			);
            TemplateHelper::renderRecursive($categoryList, 'id', $template, $settingMenu);
		?>
        </nav>
	</div>
</div>
<div class="clear"></div>