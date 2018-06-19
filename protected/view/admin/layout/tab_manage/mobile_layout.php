<?php 
	$layoutRowMobile = $_REQUEST['layoutRowMobile'];	
	$layoutWidgetList = (array)json_decode($layoutRowMobile->layoutWidgetList);
	$allLayoutWidget = $_REQUEST['allLayoutWidget'];
	$mobile_widget_content =($layoutWidgetList['mobile_widget_content'] != '')? explode('-', $layoutWidgetList['mobile_widget_content']): array();
	$mobile_widget_left =($layoutWidgetList['mobile_widget_left'] != '')? explode('-', $layoutWidgetList['mobile_widget_left']): array();
	$mobile_widget_right =($layoutWidgetList['mobile_widget_right'] != '')? explode('-', $layoutWidgetList['mobile_widget_right']): array();
?>

<div class='mobile_layout' id='mobile_layout'>
	<input type="hidden" class='groupValue' value='mobile'>

    <!-- start mobile_widget_container -->
	<div class='mobile_widget_container'>
		<!-- start mobile_widget_left -->
        <div class='mobile_widget_box mobile_widget_left_box mobile_box hide' id='mobile_widget_left'>
			<input type="hidden" value='<?=$mobile_widget_left ?>'
				   class='m_layout_widget_list' name='m_layout_widget_list[mobile_widget_left]'>
			<h3 class='left'><?=e('Slidebar left')?></h3>
			<div class='note_system_content'>
				<span><?=e('System content')?></span>
			</div>
	        <ul class="widget_list connectedSortable sortable_widget ui-sortable">
				<?php print_widget_item_list($mobile_widget_left, $allLayoutWidget); ?>
			</ul>
	        <div class="col_item_control">
	            <div class="show_add_widget_mobile" title="<?=e('Add widget')?>"></div>
	        </div>
		</div>
		<!-- end mobile_widget_left -->

        <!-- start mobile_widget_content -->
        <div class='mobile_widget_box mobile_widget_content_box mobile_box' id='mobile_widget_content'>
            <div class="col_item_control">
                <div class="show_add_widget_mobile" title="<?=e('Add widget')?>"></div>
            </div>
            <input type="hidden" value='<?=$mobile_widget_content ?>'
                   class='m_layout_widget_list' name='m_layout_widget_list[mobile_widget_content]'>
            <h3 class='center uppercase'><?=e('Main content')?></h3>
            <div class='note_system_content'>
                <span><?=e('Mobile system top')?></span>
            </div>
            <ul class="widget_list connectedSortable sortable_widget ui-sortable">
                <?php print_widget_item_list($mobile_widget_content, $allLayoutWidget); ?>
            </ul>
            <div class='note_system_content'>
                <span><?=e('Mobile system bottom')?></span>
            </div>
        </div>
        <!-- end mobile_widget_content -->

		<!-- start mobile_widget_right -->
        <div class='mobile_widget_box mobile_widget_right_box mobile_box hide' id='mobile_widget_right'>
			<input type="hidden" value='<?=$mobile_widget_right ?>'
				   class='m_layout_widget_list' name='m_layout_widget_list[mobile_widget_right]'>
			<h3 class='left'><?=e('Slidebar right')?></h3>
			<div class='note_system_content'>
				<span><?=e('System content')?></span>
			</div>
			<ul class="widget_list connectedSortable sortable_widget ui-sortable">
				<?php print_widget_item_list($mobile_widget_right, $allLayoutWidget); ?>
			</ul>
			<div class="col_item_control">
	            <div class="show_add_widget_mobile" title="<?=e('Add widget')?>"></div>
	        </div>
		</div>
		<!-- end mobile_widget_right -->
	</div>
	<!-- end mobile_widget_container -->
</div>

<?php TemplateHelper::getTemplate('layout/dialog_form_action/add_widget_mobile.php'); ?>