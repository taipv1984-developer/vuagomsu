<?php 
	$items = $_REQUEST['pageView'];
	$newsCategoryList = $_REQUEST['newsCategoryList'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('News Manage'), 'index.php?r=admin/news/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/news/add', 
                    		'text' => e('Add News'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'newsModel',
				'value' => $items->items,
				'id' => 'newsId'
			);
			
			$table = array(
				array('heading' => array('key' => 'newsId', 'label' => 'ID', 'style' => 'width: 70px'),
					'filter' => array('type' => 'number'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'image', 'label' => 'Image', 'style' => 'width: 80px'),
					'filter' => array('show' => false),
					'tbody' => array('type' => 'file', 'class' => 'image_center image_center_small'),
				),
				array('heading' => array('key' => 'newsCategoryLink', 'label' => 'Category', 'style' => 'width: 180px'),
					'filter' => array('type' => 'select_category', 'options' => $newsCategoryList),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'titleLink', 'label' => 'Title', 'style' => 'width: 200px'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'summary'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'status', 'style' => 'width: 110px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'size' => 'small'),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'class' => 'change_status_ajax', 'size' => 'small')
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/news/edit&newsId=%s',
					'linkDelete' 	=> 'index.php?r=admin/news/delete&newsId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>

		<!-- paging -->
	    <div class="row">
			<?php TemplateHelper::getTemplate('common/paging.php')?>
		</div>
	</div>
</div>

<script type="text/javascript">
	//change_status_ajax
	$(document).on('change','.change_status_ajax', function() {
		var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'change_status_ajax';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/news/manage_ajax",
			data: {'action': action, 'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Change status success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
</script>