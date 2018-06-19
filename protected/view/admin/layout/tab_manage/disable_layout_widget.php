<?php 
	$widgets = $_REQUEST['widgets'];
	$disableLayoutWidget = $_REQUEST['disableLayoutWidget'];
?>

<div class='disable_layout_widget_title'>
	<h3><?=e('Disable widgets')?></h3>
</div>
<div class='disable_layout_widget_content'>
	<input type="hidden" name="disable_layout_widget_list" class="disable_layout_widget_list" value="">
	<ul class='widget_list connectedSortable sortable_widget'>
		<?php 
			foreach($disableLayoutWidget as $layoutWidget){
					$setting = (array)json_decode($layoutWidget->setting);
					$settingTitle = $setting['title'];
					$widget = $widgets[$layoutWidget->widgetId];
					$widgetName =($settingTitle != '')? "<b class='blue'>".$settingTitle."</b>" : $widget->name;
			?>
			<li class="widget_item" id="layout_widget_id_<?=$layoutWidget->layoutWidgetId?>">
				<input type="hidden" class="layout_widget_id" value="<?=$layoutWidget->layoutWidgetId?>" id="layout_widget_<?=$layoutWidget->layoutWidgetId?>">
				<input type="hidden" class="layout_widget_controller" name='widgetList[]' value="<?=$layoutWidget->widgetController?>">
				<h4>
					<i class="icon <?=$layoutWidget->icon?>"></i>
					<span><?=$widgetName?></span>
				</h4>
				<div class="widget_control">
					<div class="widget_control_item widget_control_delete" title="Delete widget"></div>
					<div class="widget_control_item widget_control_edit" title="Setting widget"></div>
				</div>
			</li>
		<?php }?>
	</ul>
</div>