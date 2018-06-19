<?php 
	$allLayoutWidget = $_REQUEST['allLayoutWidget'];
	$layoutRowSystem = $_REQUEST['layoutRowSystem'];
?>
<div class='layout_system'>
	<div class='layout_system_group'>
		<div class='layout_system_item layout_system_header'>
			<?php $group = 'header'; ?>
			<input type="hidden" class='group_value' value="<?=$group?>">
			<div class='layout_system_title'>
				<h3 class='uppercase center bold'><?=e('Header')?></h3>
			</div>
			<div class='layout_system_list'>
				<?php 
					TemplateHelper::getTemplate('layout/tab_layout_system/desktop_layout_system_group.php',array(
						'group' => $group,
						'layoutRowSystem' => $layoutRowSystem[$group],
						'allLayoutWidget' => $allLayoutWidget
					)); 
				?>
			</div>
		</div>
		<div class='clear'></div>
		
		<div class='layout_system_item layout_system_content'>
			<span><?=e('Main content')?></span>
		</div>
		<div class='clear'></div>
		
		<div class='layout_system_item layout_system_footer'>
			<?php $group = 'footer'; ?>
			<input type="hidden" class='group_value' value="<?=$group?>">
			<div class='layout_system_title'>
				<h3 class='uppercase center bold'><?=e('Footer')?></h3>
			</div>
			<div class='layout_system_list'>
				<?php 
					TemplateHelper::getTemplate('layout/tab_layout_system/desktop_layout_system_group.php',array(
						'group' => $group,
						'layoutRowSystem' => $layoutRowSystem[$group],
						'allLayoutWidget' => $allLayoutWidget
					)); 
				?>
			</div>
		</div>
	</div>
</div>
<div class='clear'></div>

<!-- layout_row sortable -->
<script type="text/javascript">
	$().ready(function(){
		 $("#sortable_layout_system_header, #sortable_layout_system_footer").sortable({
		      connectWith: ".sortable_layout"
		   }).disableSelection();

		$("#sortable_layout_system_header").sortable({
			start: function(event, ui){
			},
			stop: function(){
				layout_row_sortable_update();
			},
			over: function(){
			},
			out: function(){
			}
		});
		
		 $("#sortable_layout_system_footer").sortable({
			start: function(event, ui){
			},
			stop: function(){
				layout_row_sortable_update();
			},
			over: function(){
			},
			out: function(){
			}
		});
	});
</script>

<!-- action in layout_system_row (add_row_system) -->
<script type="text/javascript">
	//event add a layout_system_row  
	$(document).on('click', '.add_row_system', function(){
		var id = $(this).attr('id');
		var cols = id.replace('cols_', '');
		var group = $(this).parents('.layout_system_item').find('.group_value').val();
		var sortable_id = $(this).parents('.layout_system_item').find('.sortable_layout').attr('id');

		var url = 'index.php?r=admin/layout/layout_row_action_ajax';
		var action = 'add_row_system';
		$.ajax({
			url: url,
			type: 'post',
			data:{'action': action, 'cols': cols, 'group': group},
			success: function(data){
				//console.log('(action = add_row)data = ' + data);
				//append item
				var layout_item = get_row_item(data, cols);
				$('#'+sortable_id).append(layout_item);

				show_notice('<?=e('Layout row add success') ?>');
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});
	});
</script>