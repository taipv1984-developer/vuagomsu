<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Product tag Manage'), 'index.php?r=admin/news_tag/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/news_tag/add', 
                    		'text' => e('Add Product tag'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'productTagModel',
				'value' => $items->items,
				'id' => 'productTagId'
			);
			
			$table = array(
				array('heading' => array('key' => 'productTagId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'tagLink', 'label' => 'Name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'description'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'product_count'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/product_tag/edit&productTagId=%s',
					'linkDelete' 	=> 'index.php?r=admin/product_tag/delete&productTagId=%s',
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