<?php 
	$group = $params['group'];
	$layoutRowSystem = $params['layoutRowSystem'];
	$allLayoutWidget = $params['allLayoutWidget'];
	$bootrapClassCols = ArrayHelper::getBootrapClassCols();
?>
<div class="layout_list">
	<div class='add_row col-md-8'>
		<div class='label'>
			<?=e('Add a row'); ?>
		</div>
		<div class='cols_list'>
			<ul>
			<?php for($i=1; $i<=6; $i++){?>
				<li class='add_row_system btn btn-default' id='<?="cols_$i"?>'>
					<?="$i " . e('Cols');?>
				</li>
			<?php }?>
			</ul>
		</div>
	</div>
	<div class='clear'></div>
	
    <ul id="sortable_layout_system_<?=$group; ?>" class='sortable_layout sortable_layout_system'>
    	<input type="hidden" class="sortable_group" value="<?=$group?>">
    	<?php 
    		//foreach row
    		$iRow = -1;
    		foreach($layoutRowSystem as $k => $v){
				$iRow++;
				$rowSetting = (array)json_decode($v->setting);
				$layoutWidgetList = (array)json_decode($v->layoutWidgetList);
				$group = $v->group;
    	?>
    	<li id="row_<?=$v->layoutRowId?>" class="layout_row <?= ($v->status == 'D') ? 'layout_row_disable' : ''?>">
    	   <input type="hidden" name="layoutRow[<?=$v->layoutRowId?>][position]" class="layout_row_position" value="<?=$iRow?>">
		   
		   <div class="control">
		      <div class="move" title="<?=e('Move row')?>"></div>
		      <div class="delete delete_row_item" title="<?=e('Delete row')?>"></div>
		      <div class="setting show_row_setting " title="<?=e('Setting row')?>"></div>
		   </div>
		   <div class="cols">
		   	  <?php 
		   	  	//foreach col
		   	  	$cols = (int)$v->cols;
		   	  	for($i=0; $i<$cols; $i++){
					$layoutWidgets = $layoutWidgetList[$i];				//string: 1-2-3
					$layoutWidgets =($layoutWidgets != '')? explode('-', $layoutWidgets): array();	//array(1, 2, 3)
					$colClass = $rowSetting["col_class_$i"];
			  ?>
			      <div class="col_item <?=$bootrapClassCols[$cols]?> no_padding col_position_<?=$i?>" layout_row_position="<?=$i?>">
			      	 <input type="hidden" class='layout_row_position_value' value='<?=$i?>'>
			      	 <input type="hidden" class='layout_row_group_value' value='<?=$group?>'>
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
			            <div class="show_add_widget" title="<?=e('Add widget')?>"></div>
			         </div>
			      </div>
		      <?php }//end foreach cols?>
		   </div>
		</li>
		<?php }//end foreach layoutRow?>
    </ul>
</div>