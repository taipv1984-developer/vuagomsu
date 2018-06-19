<?php
	//get data
	$layoutWidgetInfo = $setting['layoutWidgetInfo'];
	$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
	$categoryList = $setting['categoryList'];
?>

<div class='widget_content widget_product_category_list <?php echo $setting['class'] ?>'>
	<?php if($setting['show_title']){?>
        <h3 class="widget_title">
            <span><?=$setting['title']?></span>
        </h3>
	<?php } ?>

	<div class="product-category-list-mobile">
		<?php
			$template = __DIR__.'/list.menu_item.php';
			$settingMenu = array();
            TemplateHelper::renderRecursive($categoryList, 'categoryId', $template, $settingMenu);
		?>
	</div>
</div>
<div class="clear"></div>

<script type="text/javascript">
    //product-category-list-mobile
    $( ".product-category-list-mobile ul.ul_0 li.dropdown" ).click(function() {
        $(this).find("ul.ul_1" ).toggle( "fade", function() {
        });
    });
    $( ".product-category-list-mobile ul.ul_0 li.dropdown a" ).click(function() {
        window.location = $(this).attr('href');
        return false;
    });
</script>