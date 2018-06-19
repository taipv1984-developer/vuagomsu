<?php 
	$categoryList = $_REQUEST['categoryList'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Category Manage'), 'index.php?r=admin/category/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/category/add', 
                    		'text' => e('Add Category'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'categoryModel',
				'value' => $categoryList,
				'id' => 'categoryId',
				'show_filter' => false
			);
			
			$table = array(
				array('heading' => array('key' => 'categoryId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
// 				array('heading' => array('key' => 'image', 'label' => 'Image'),
// 					'filter' => array('show' => false),
// 					'tbody' => array('type' => 'file', 'class' => 'image_center image_center_small'),
// 				),
				array('heading' => array('key' => 'icon', 'style' => 'width: 80px'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'name', 'label' => 'Name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'productCount', 'label' => 'Product count'),
					'filter' => array(),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/category/edit&categoryId=%s',
					'linkDelete' 	=> 'index.php?r=admin/category/delete&categoryId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>
	</div>
</div>