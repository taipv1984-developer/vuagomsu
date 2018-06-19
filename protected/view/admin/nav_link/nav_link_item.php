<?php 
	if(isset($v['class'])) $class = "class='{$v['class']}'";
?>
<li class="dd-item dd3-item" data-id="<?=$v['navLinkId']?>" id="menu_item_<?=$v['navLinkId']?>">
	<div class="dd-handle dd3-handle"></div>
	<div class="dd3-content">
		<a href="index.php?r=<?=$v['link']?>" <?=$class?> title="<?=$v['title'];?>">
			<?=$v['title'];?>
		</a>
		<div class="nestable_control">
			<span class="fa fa-key btn_control show_info margin-right-10" title="ID" style="display: none"><?=$v['navLinkId']?></span>
			<span class="fa fa-sort-amount-asc btn_control show_info margin-right-10" title="Order" style="display: none"><?=$v['order']?></span>
			<span class="fa fa-edit btn_control btn_edit" title="Edit"></span>
			<span class="fa fa-trash btn_control btn_delete" title="Delete"></span>
		</div>
	</div>
<?php if (isset($v['isEnd'])) echo '</li>'?>