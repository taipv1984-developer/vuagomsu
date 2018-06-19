<?php 
	$navLinks = $_REQUEST['navLinks'];
?>

<script src="<?=URLHelper::getResource('resource/backend/js/jquery.nestable/jquery.nestable.js') ?>"></script>
<link href="<?=URLHelper::getResource('resource/backend/js/jquery.nestable/jquery.nestable.css') ?>" rel="stylesheet" type="text/css" />

<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Nav Link Manage'), 'index.php?r=admin/nav_link/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body ">
		<div class="col-md-6">
			<div id="nestable-menu">
				<div data-action="expand-all" class="btn btn-primary">
					<i class="fa fa-plus margin-right-5"></i><?=e('Expand All')?>
				</div>
				<div data-action="collapse-all" class="btn btn-primary">
					<i class="fa fa-minus margin-right-5"></i><?=e('Collapse All')?>
				</div>
				<div class="btn btn-default show_info_button">
					<i class="fa fa-eye margin-right-5"></i><?=e('Show info')?>
				</div>
				<div class="btn btn-success btn_save right">
					<i class="fa fa-save"></i>
					<?=e('Save')?>
				</div>
			</div>
			
			<div class="dd nestable" id="nestable">
				<div class="add_item add_item_top" title="<?=e('Add item')?>">
					<i class="fa fa-plus"></i>
					<?=e('Add item')?>
				</div>
				<ul class="dd-list">
					<?php
						$template = PROTECTED_PATH."view/admin/nav_link/nav_link_item.php";
                        TemplateHelper::renderRecursive($navLinks, 'navLinkId', $template);
                    ?>
				</ul>
				<div class="add_item add_item_bottom" title="<?=e('Add item')?>">
					<i class="fa fa-plus"></i>
					<?=e('Add item')?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- nestable menu-->
<script type="text/javascript">
	$(document).ready(function(){
	    $('#nestable-menu').on('click', function(e){
	        var target = $(e.target),
	            action = target.data('action');
	        if (action === 'expand-all') {
	            $('.dd').nestable('expandAll');
	        }
	        if (action === 'collapse-all') {
	            $('.dd').nestable('collapseAll');
	        }
	    });
	    $('#nestable').nestable({
		    'listNodeName': 'ul',
		});
	});
</script>

<!-- menu action -->
<script type="text/javascript">
	$('.btn_save').click(function(){
		var order = 0;
		var iGroup = 0;
		var datas = [];
		$('.nestable li').each(function(){
			order++;
			var id = $(this).attr('data-id');
			var title = $(this).find('> .dd3-content > a').text().trim();
			var ul_class = $(this).parent('ul').attr('class');
			var level = ul_class.replace('ul_', '');
			var parentId = 0;	//default
			if(ul_class != 'ul_0'){
				//find parent
				parentId = $(this).parents('li').attr('data-id');
			}
			if(parentId == 0){
				iGroup ++;
				order = 0;	//reset order by iGroup
				//console.log(`id = ${id} ...title = ${title} ... parentId = ${parentId} ... order = ${iGroup}`);
				data = {'id': id, 'order': iGroup, 'parentId': parentId, 'level': level};
			}
			else{
				//console.log(`id = ${id} ...title = ${title} ... parentId = ${parentId} ... order = ${order}`);
				data = {'id': id, 'order': order, 'parentId': parentId, 'level': level};
			}
			
			datas.push(data);
		});
		
		//ajax
		var action = 'save';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/nav_link/action",
			data: {'action': action, 'datas': datas},
			async : true,
			success : function(data) {
				//message
				show_notice('Save menu success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	})
	
	$('.add_item_top').click(function(){
		var action = 'add';
		var order = 0;
 		$.ajax({
			type : 'post',
			url : "index.php?r=admin/nav_link/action",
			data: {'action': action, 'order': order},
			async : true,
			success : function(data) {
				$('.nestable .dd-list > .ul_0').prepend(data);
				//message
				show_notice('Add item success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});

	$('.add_item_bottom').click(function(){
		var action = 'add';
		var order = 999;
 		$.ajax({
			type : 'post',
			url : "index.php?r=admin/nav_link/action",
			data: {'action': action, 'order': order},
			async : true,
			success : function(data) {
				$('.nestable .dd-list > .ul_0').append(data);
				//message
				show_notice('Add item success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
	
	$(document).on('click','.btn_delete', function() {
		var action = 'delete';
		var id = $(this).parents('li').attr('data-id');
		if(confirm('Are you sure to delete item #'+id)){
	 		$.ajax({
				type : 'post',
				url : "index.php?r=admin/nav_link/action",
				data: {'action': action, 'id': id},
				async : true,
				success : function(data) {
					$('li#menu_item_'+id).fadeOut(500, function(){
						$(this).remove();
					});
					//message
					show_notice('Delete item success');
				},
				error: function (xhr, desc, err) {
					console.log(xhr + "\n" + err);
				}
			});
		}
	});
</script>

<script type="text/javascript">
	$(".show_info_button").click(function() {
	  $(".show_info").toggle();
	});
</script>

<?php include 'edit_item.php' ?>