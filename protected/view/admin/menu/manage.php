<?php 
	$menuItem = $_REQUEST['menuItem'];
	$menuId = $_REQUEST['menuId'];
	$menuArray = $_REQUEST['menuArray'];
	$categoryList = $_REQUEST['categoryList'];
	$staticPageList = $_REQUEST['staticPageList'];
?>

<script src="resource/backend/js/jquery.nestable/jquery.nestable.js"></script>
<link href="resource/backend/js/jquery.nestable/jquery.nestable.css" rel="stylesheet" type="text/css" />

<div class="portlet light menu_manage">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Menu Manage'), 'index.php?r=admin/menu/manage');
		$toolbar->showToolBar();
	?>
	<!-- menu -->
	<div class="menu_list">
		<div class='col-md-6'>
			<?php
			TemplateHelper::getTemplate('common/input/select_row.php', array(
				'options' => $menuArray,
				'value' => $menuId,
				'label' => 'Menu list',
				'cols' => '4-8',
				'class' => 'select_menu'
			));
			?>
		</div>
		<?php if($menuId){ ?>
		<span class="edit_menu">
			<a href="index.php?r=admin/menu/edit&menuId=<?=$menuId?>" title="Edit menu" class="popup50_action">
				<?=e('Edit menu')?>
			</a>
		</span>
		<?php }?>
		<a href="index.php?r=admin/menu/add" title="Add menu" class="btn btn-primary right popup50_action">
			<i class="fa fa-plus"></i>
			<?=e('Add menu')?>
		</a>
	</div>
	
	<div class="row portlet-body margin-top-10">
		<div class="col-md-4">
			<div class="panel-group accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#group1">
								<?=e('Custom links')?>
							</a>
						</h4>
					</div>
					<div id="group1" class="panel-collapse in">
						<div class="panel_option">
						<?php
							//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
							//add option (class, id, stype, styleRow, required, placeholder, attr, [options, code])
							$settingForm = array(
								'title'	=> array('required' => true),
								'link'	=> array(),
                                'class'		=> array(),
								'type'  => array('type' => 'select', 'options' => ApplicationConfigHelper::get('menu.item.type'),
                                    'label' => 'Loại menu', 'row_class' => 'hide'),
								'button' => array('type' => 'button', 'class' => 'add_custom_link', 'title' => 'Add to menu', 'label' => false)
							);
							$settingValue = $emailTemplateInfo;
							$settingAll = array(
								'cols' => '3-9',
							);
							
							//render setting from
							TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
						?>
						</div>
					</div>
				</div>
			</div><!-- end #group1 -->
			
			<div class="panel-group accordion hide">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" href="#group2">
								<?=e('Pages')?>
							</a>
						</h4>
					</div>
					<div id="group2" class="collapse">
						<div class="panel_option">
							<ul class="option_page">
								<?php foreach($staticPageList as $k => $v){?>
							  	<li>
							   		<a href="<?=URLHelper::getStaticPageUrl($v->staticPageId)?>" title="View detail" target="_blank">
							   			<?=StringHelper::toUcfirst($v->title)?>
							   		</a>
							   		<span class="add_page_link add_to_menu" title="Add to menu" 
							   			data-pageId="<?=$v->staticPageId?>"
							   			data-title="<?=$v->title?>">
							   			<i class="fa fa-plus"></i>
							   		</span>
							   	</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div><!-- end #group2 -->
			
			<div class="panel-group accordion hide">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" href="#group3">
								<?=e('Categories')?>
							</a>
						</h4>
					</div>
					<div id="group3" class="collapse">
						<div class="panel_option ">
							<ul class="option_category">
								<?php foreach($categoryList as $k => $v){
									$space = '';
									for($i = 0; $i < $v['level']; $i++){
										$space .= '¦----';
								   }
								?>
							  	<li>
							   		<a href="<?=URLHelper::getProductListPage($v['categoryId'])?>" class="<?=($space == '') ? 'bold' : ''?>" title="View detail">
							   			<?=$space.' '. StringHelper::toUcfirst($v['name'])?>
							   		</a>
							   		<span class="add_category_link add_to_menu" title="Add to menu" 
							   			data-categoryid="<?=$v['categoryId']?>"
							   			data-categorytitle="<?=$v['name']?>">
							   			<i class="fa fa-plus"></i>
							   		</span>
							   	</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div><!-- end #group3 -->
		</div>
		<div class="col-md-8">
			<?php if($menuId){ ?>
			<menu id="nestable-menu">
				<button type="button" data-action="expand-all" class="btn btn-success">
					<i class="fa fa-plus margin-right-5"></i><?=e('Expand All')?>
				</button>
				<button type="button" data-action="collapse-all" class="btn btn-success">
					<i class="fa fa-minus margin-right-5"></i><?=e('Collapse All')?>
				</button>
				<button type="button" class="btn btn-default show_info_button">
					<i class="fa fa-eye margin-right-5"></i><?=e('Menu info')?>
				</button>
				<div class="btn btn-primary save_menu right">
					<i class="fa fa-save"></i>
					<?=e('Save')?>
				</div>
			</menu>
			
			<div class="dd nestable" id="nestable">
				<ul class="dd-list">
					<?php
						$template = PROTECTED_PATH."view/admin/menu/menu_item.php";
                        TemplateHelper::renderRecursive($menuItem, 'id', $template);    //id->menuItemId later
					?>
				</ul>
			</div>
			
			<a class="delete_menu" title="Delete menu">
				<?=e('Delete menu')?>
			</a>
			<?php } else {?>
			<div class="no_data">
				<?=e("Menu not found. Click add menu button to insert to menu.") ?>
			</div>
			<?php }?>
		</div>
	</div>
</div>

<!-- select_menu change -->
<script type="text/javascript">
	$().ready(function(){
		$('.select_menu').change(function(){
			var menuId = $(this).val();
			window.location.assign('index.php?r=admin/menu/manage&menuId='+menuId);
		});
	});
</script>

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
	//save_menu OK
	$('.save_menu').click(function(){
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
		var action = 'save_menu';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/menu/action",
			data: {'action': action, 'datas': datas},
			async : true,
			success : function(data) {
				$('.new_item').removeClass('red');
				//message
				show_notice('Save menu success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	})

	//add_custom_link OK
	$('.add_custom_link').click(function(){
		if(<?=$menuId?> != 0){
			var action = 'add_custom_link';
			var menuId = '<?=$_REQUEST['menuId']?>';
			var title = $('input[name="title"]').val();
			var link = $('input[name="link"]').val();
            var cls = $('input[name="class"]').val();
            var type = $('select[name="type"]').val();
	
			//check title is required
			if(title != ''){
		 		$.ajax({
					type : 'post',
					url : "index.php?r=admin/menu/action",
					data: {'action': action, 'menuId': menuId, 'title': title, 'link': link, 'cls': cls, 'type': type},
					async : true,
					success : function(data) {
						$('.nestable .dd-list .ul_0').append(data);
						//message
						show_notice('Add item success');
						//reset input
                        $('input[name="title"]').focus();
                        $('input[name="title"]').val('');
                        $('input[name="link"]').val('');
                        $('select[name="type"]').val('custom_link');
					},
					error: function (xhr, desc, err) {
						console.log(xhr + "\n" + err);
					}
				});
			}
			else{
				//message error
				show_notice_error('Title is required');
				$('input[name="title"]').focus();
			}
		}
		else{
			alert('Add to menu is error');
		}
	});

	//add_page_link	OK
	$('.add_page_link').click(function(){
		if(<?=$menuId?> != 0){
			var action = 'add_page_link';
			var menuId = '<?=$_REQUEST['menuId']?>';
			var pageId = $(this).attr('data-pageId');
			var title = $(this).attr('data-title');
	
	 		$.ajax({
				type : 'post',
				url : "index.php?r=admin/menu/action",
				data: {'action': action, 'menuId': menuId, 
						'pageId': pageId, 'title': title},
				async : true,
				success : function(data) {
					$('.nestable .dd-list .ul_0').append(data);
					//message
					show_notice('Add item success');
				},
				error: function (xhr, desc, err) {
					console.log(xhr + "\n" + err);
				}
			});
		}
		else{
			alert('Add to menu is error');
		}
	});
	
	//add_category_link	OK
	$('.add_category_link').click(function(){
		if(<?=$menuId?> != 0){
			var action = 'add_category_link';
			var menuId = '<?=$_REQUEST['menuId']?>';
			var categoryId = $(this).attr('data-categoryid');
			var categoryTitle = $(this).attr('data-categorytitle');
	
	 		$.ajax({
				type : 'post',
				url : "index.php?r=admin/menu/action",
				data: {'action': action, 'menuId': menuId, 'categoryId': categoryId, 'categoryTitle': categoryTitle},
				async : true,
				success : function(data) {
					$('.nestable .dd-list .ul_0').append(data);
					//message
					show_notice('Add item success');
				},
				error: function (xhr, desc, err) {
					console.log(xhr + "\n" + err);
				}
			});
		}
		else{
			alert('Add to menu is error');
		}
	});

	//delete_menu_item OK
	$(document).on('click','.delete_menu_item', function() {
		var action = 'delete_menu_item';
		var menuItemId = $(this).parents('li').attr('data-id');
		if(confirm('Are you sure to delete menu item #'+menuItemId)){
	 		$.ajax({
				type : 'post',
				url : "index.php?r=admin/menu/action",
				data: {'action': action, 'menuItemId': menuItemId},
				async : true,
				success : function(data) {
					$('li#menu_item_'+menuItemId).fadeOut(500, function(){
						$(this).remove();
					});
					//message
					show_notice('Delete menu item success');
				},
				error: function (xhr, desc, err) {
					console.log(xhr + "\n" + err);
				}
			});
		}
	});

	//delete_menu OK
	$(document).on('click','.delete_menu', function() {
		var action = 'delete_menu';
		var menuId = '<?=$_REQUEST['menuId']?>';
		if(confirm('Are you sure to delete menu #'+menuId)){
	 		$.ajax({
				type : 'post',
				url : "index.php?r=admin/menu/action",
				data: {'action': action, 'menuId': menuId},
				async : true,
				success : function(data) {
					window.open("index.php?r=admin/menu/manage", '_self');
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

<?php include 'dialog_action.php' ?>