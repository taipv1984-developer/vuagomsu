<li class="dd-item dd3-item" data-id="<?=$v['id']?>" id="menu_item_<?=$v['id']?>">
	<input type="hidden" class="menu_item_type" value="<?=$v['type']?>"/>
	<input type="hidden" class="menu_item_params" value="<?=$v['params']?>"/>
	<div class="dd-handle dd3-handle"></div>
	<div class="dd3-content">
		<a href="<?=$v['link']?>" class="menu_item_active <?=$v['class']?>"
			title="<?=$v['title'];?>" target="_blank">
			<?=$v['title'];?>
		</a>
		<div class="nestable_control">
			<span class="btn_control show_info margin-right-5 left" title="Menu type" style="">
				[<?=$v['type']?>]
			</span>
			<span class="btn_control show_info margin-right-5" title="ID" style="display: none">
				<i class="fa fa-key"></i>
				<?=$v['id']?>
			</span>
			<span class=" btn_control show_info margin-right-5" title="Order" style="display: none">
				<i class="fa fa-sort-amount-down"></i>
				<?=$v['order']?>
			</span>
			<span class="fa fa-edit btn_control edit_menu_item" title="Edit"></span>
			<span class="fa fa-trash btn_control delete_menu_item" title="Delete"></span>
		</div>
	</div>
<?php if (isset($v['isEnd'])) echo '</li>'?>