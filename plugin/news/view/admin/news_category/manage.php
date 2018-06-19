<?php 
	$newsCategoryList = $_REQUEST['newsCategoryList'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('News Category Manage'), 'index.php?r=admin/news_category/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/news_category/add', 
                    		'text' => e('Add News Category'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'newsCategoryModel',
				'value' => $newsCategoryList,
				'id' => 'id',
				'show_filter' => false
			);
			
			$table = array(
				array('heading' => array('key' => 'id', 'label' => 'ID', 'class' => 'sorting', 'style' => 'width: 80px'),
					'filter' => array('type' => 'number'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'image', 'label' => 'Image', 'style' => 'width: 100px'),
					'filter' => array('show' => false),
					'tbody' => array('type' => 'file', 'class' => 'image_center image_center_small'),
				),
				array('heading' => array('key' => 'name', 'label' => 'Name'),
					'filter' => array(),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/news_category/edit&newsCategoryId=%s',
					'linkDelete' 	=> 'index.php?r=admin/news_category/delete&newsCategoryId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>
	</div>
</div>