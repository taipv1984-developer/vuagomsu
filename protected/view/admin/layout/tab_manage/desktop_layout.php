<?php 
$action = $_REQUEST['action'];
$layoutId = $_REQUEST['layoutId'];
$layoutInfo = $_REQUEST['layoutInfo'];
$layoutRow = $_REQUEST['layoutRow'];
$widgets = $_REQUEST['widgets'];
$allLayoutWidget = $_REQUEST['allLayoutWidget'];
$bootrapClassCols = ArrayHelper::getBootrapClassCols();
?>

<div class='layout_list'>
	<div class='layout_system_panel layout_system_panel_header'>
		<div class='title'>
			<h3><?=e('Header')?></h3>
		</div>
		<div class='description'>
			<?=e("This <b>Header</b> panel. Switch to <u>layout system</u> tab to config this")?>
		</div>
	</div>
	
	<div class='add_row'>
		<div class='label'>
			<?=e('Add a row'); ?>
		</div>
		<div class='cols_list'>
			<ul>
			<?php for($i=1; $i<=6; $i++){?>
				<li class='add_row_item btn btn-default' id='<?="cols_$i"?>'>
					<?="$i " . e('Cols');?>
				</li>
			<?php }?>
			</ul>
		</div>
	</div>
    <ul id="sortable_layout" class='sortable_layout'>
    	<input type="hidden" name="active_layout_widget_list" class="active_layout_widget_list" value="">
    	<?php 
    		//foreach row
    		$iRow = -1;
    		foreach($layoutRow as $k => $v){
				$iRow++;
				$rowSetting = (array)json_decode($v->setting);
				$layoutWidgetList = (array)json_decode($v->layoutWidgetList);
				if($v->group == 'mobile') continue;
    	?>
    	<li id="row_<?=$v->layoutRowId?>" class="layout_row <?= ($v->status == 'D') ? 'layout_row_disable' : ''?>">
    	   <input type="hidden" name="layoutRow[<?=$v->layoutRowId?>][position]" class="layout_row_position" value="<?=$iRow?>">
		   
		   <div class="control">
		      <div class="move" title="Move row"></div>
		      <div class="delete delete_row_item" title="Delete row"></div>
		      <div class="setting show_row_setting " title="Setting row"></div>
		   </div>
		   <div class="cols">
		   	  <?php 
		   	  	//foreach col
		   	  	$cols = (int)$v->cols;
		   	  	for($i=0; $i<$cols; $i++){
					$layoutWidgets = $layoutWidgetList[$i];				//string: 1-2-3
					if($layoutWidgets != ''){
						$layoutWidgets = explode('-', $layoutWidgets);	//array(1, 2, 3)
					}
					else{
						$layoutWidgets = array();
					}
					$colClass = $rowSetting["col_class_$i"];
			  ?>
			      <div class="col_item <?=$bootrapClassCols[$cols]?> col_position_<?=$i?>" layout_row_position="<?=$i?>">
			      	 <input type="hidden" class='layout_row_position_value' value='<?=$i?>'>
			      	 <input type="hidden" class='layout_row_group_value' value=''>
			      	 <input type="hidden" name="layoutRow[<?=$v->layoutRowId?>][cols][<?=$i?>]" class="layout_row_cols" value="<?=join('-', $layoutWidgets)?>">
			         
			         <ul class="widget_list connectedSortable sortable_widget ui-sortable">
			         	<?php 
			         		//foreach layout_widget
			         		foreach($layoutWidgets as $w){
									$layoutWidget = $allLayoutWidget[$w]; 
									$setting = (array)json_decode($layoutWidget->setting);
									$settingTitle = $setting['title'];
									$widgetName =($settingTitle != '')? "<b class='blue'>".$settingTitle."</b>" : $layoutWidget->name;
						?>
			            	<li class="widget_item" id="layout_widget_id_<?=$layoutWidget->layoutWidgetId?>">
								<input type="hidden" class="layout_widget_id" value="<?=$layoutWidget->layoutWidgetId?>" id="layout_widget_<?=$layoutWidget->layoutWidgetId?>">
								<input type="hidden" class="layout_widget_controller" name='widgetList[]' value="<?=$layoutWidget->widgetController?>">
								<h4>
									<i class="icon <?=$layoutWidget->icon?>"></i>
									<span><?=$widgetName?></span>
								</h4>
								<div class="widget_control">
									<div class="widget_control_item widget_control_delete" title="<?=e('Delete widget')?>"></div>
									<div class="widget_control_item widget_control_edit" title="<?=e('Setting widget')?>"></div>
								</div>
							</li>
			            <?php }?>
			         </ul>
			         <div class="col_item_control">
			         	<div class='col_class'><?=$colClass; ?></div>
			            <div class="show_add_widget" title="<?=e('Add widget') ?>"></div>
			         </div>
			      </div>
		      <?php }//end foreach cols?>
		   </div>
		</li>
		<?php }//end foreach layoutRow?>
    </ul>
</div><!-- end  layout_list-->
<div class='clear'></div>

<div class='layout_system_panel layout_system_panel_footer'>
	<div class='title'>
		<h3><?=e('Footer')?></h3>
	</div>
	<div class='description'>
		<?=e("This <b>Footer</b> panel. Switch to <u>layout system</u> tab to config this")?>
	</div>
</div>

<!-- action in layout_row (add_row) -->
<script type="text/javascript">
	//event add a layout_row  
	$(document).on('click', '.add_row_item', function(){
		var id = $(this).attr('id');
		var cols = id.replace('cols_', '');

		//ajax edit layoutWidget
		var url = 'index.php?r=admin/layout/layout_row_action_ajax';
		var action = 'add_row';
		$.ajax({
			url: url,
			type: 'post',
			data:{'action': action, 'layoutId': <?=$_REQUEST['layoutId']?>, 'cols': cols},
			success: function(data){
				//append item
				var layout_item = get_row_item(data, cols);
				$('#sortable_layout').append(layout_item);
				//sortable_widget
				widget_list_sortable();

				show_notice('<?=e('Layout row add success') ?>');
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});
	});
</script>

<?php TemplateHelper::getTemplate('layout/dialog_form_action/add_widget.php'); ?>
<?php TemplateHelper::getTemplate('layout/dialog_form_action/edit_widget.php'); ?>
<?php TemplateHelper::getTemplate('layout/dialog_form_action/row_setting.php'); ?>