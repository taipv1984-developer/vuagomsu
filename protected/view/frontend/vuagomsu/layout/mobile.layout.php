<?php 
	//get $layoutRowMobileSystem
	$layoutRowMobileSystem = LayoutExt::getLayoutRowMobileSystem();
	$s_layoutWidgetList = (array)json_decode($layoutRowMobileSystem->layoutWidgetList);
	$mobile_system_top = ($s_layoutWidgetList['mobile_system_top'] != '')? explode('-', $s_layoutWidgetList['mobile_system_top']): array();
    $mobile_system_bottom = ($s_layoutWidgetList['mobile_system_bottom'] != '')? explode('-', $s_layoutWidgetList['mobile_system_bottom']): array();
	$mobile_system_left = ($s_layoutWidgetList['mobile_system_left'] != '')? explode('-', $s_layoutWidgetList['mobile_system_left']): array();
    $mobile_system_right = ($s_layoutWidgetList['mobile_system_right'] != '')? explode('-', $s_layoutWidgetList['mobile_system_right']): array();

	//get $layoutWidgetIds
	$layoutRowMobile = LayoutExt::getLayoutRowMobile($layoutInfo->layoutId);
	$layoutWidgetIds = (array)json_decode($layoutRowMobile->layoutWidgetList);
	$mobile_widget_content =($layoutWidgetIds['mobile_widget_content'] != '')? explode('-', $layoutWidgetIds['mobile_widget_content']): array();
	$mobile_widget_left =($layoutWidgetIds['mobile_widget_left'] != '')? explode('-', $layoutWidgetIds['mobile_widget_left']): array();
	$mobile_widget_right =($layoutWidgetIds['mobile_widget_right'] != '')? explode('-', $layoutWidgetIds['mobile_widget_right']): array();
?>
<div class='mobile_layout'>
    <?php if($isMobileSlidebar){?>
        <!-- navbar -->
        <nav class="navbar navbar-default sb-slide" role="navigation">
            <!-- left control -->
            <div class="sb-toggle-left navbar-left">
                <div class="navicon-line"></div>
                <div class="navicon-line"></div>
                <div class="navicon-line"></div>
            </div>

            <div class='mobile_system_top'>
                <?php show_widget_content($mobile_system_top); ?>
            </div>

            <!-- right control -->
            <div class="sb-toggle-right navbar-right right">
                <div class="navicon-line"></div>
                <div class="navicon-line"></div>
                <div class="navicon-line"></div>
            </div>
        </nav>

        <!-- slidebar left -->
        <div class="sb-slidebar sb-left">
            <?php
                show_widget_content($mobile_system_left);
                show_widget_content($mobile_widget_left);
            ?>
        </div>

        <!-- slidebar right -->
        <div class="sb-slidebar sb-right sb-style-overlay" style="margin-right: -254px">
            <?php
                show_widget_content($mobile_system_right);
                show_widget_content($mobile_widget_right);
            ?>
        </div>

        <!-- main content -->
        <div class="mobile_main_content">
            <?php
            show_widget_content($mobile_widget_content);
            ?>
        </div>

        <div class='mobile_system_bottom'>
            <?php show_widget_content($mobile_system_bottom); ?>
        </div>

        <!-- slidebar script -->`
        <script type="text/javascript">
            $(document).ready(function(){
                $.slidebars();
            });
        </script>
    <?php } else {?>
        <!-- main content -->
        <div class="mobile_widget_content">
            <div class="mobile_system_top">
                <?php show_widget_content($mobile_system_top); ?>
            </div>
            <div class="mobile_main_content">
                <div class="mobile_main_menu_content" style="display: none">
                    <?php
                    $categoryList = CategoryExt::getCategoryList();
                    $template = PROTECTED_PATH.'/widget/CustomViewWidget/header/mobile.menu_item.php';
                    $settingMenu = array(
//                'class' => array(
//                    '0' => 'nav navbar-nav',
//                    '1' => 'dropdown-menu',
//                ),
                    );
                    TemplateHelper::renderRecursive($categoryList, 'categoryId', $template, $settingMenu);
                    ?>
                </div>
                <script type="text/javascript">
                    //mobile_main_menu_content
                    $( ".navbar-header" ).click(function() {
                        $( ".mobile_main_menu_content" ).toggle( "fade", function() {
                        });
                    });
                    $( ".mobile_main_menu_content ul.ul_0 li.dropdown" ).click(function() {
                        $(this).find("ul.ul_1" ).toggle( "fade", function() {
                        });
                    });
                    $( ".mobile_main_menu_content ul.ul_0 li.dropdown a" ).click(function() {
                        window.location = $(this).attr('href');
                        return false;
                    });
                </script>
                <div class="clear"></div>
                <?php show_widget_content($mobile_widget_content); ?>
            </div>
            <div id="footer" class="mobile_system_bottom">
                <?php show_widget_content($mobile_system_bottom); ?>
            </div>
        </div>
    <?php }?>
</div>
<?php
	//show widget content
	function show_widget_content($layoutWidgetIds){
		foreach($layoutWidgetIds as $layoutWidgetId){
			LayoutExt::viewLayoutWidget($layoutWidgetId, true);
		}
	}
?>