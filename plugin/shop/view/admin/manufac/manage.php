<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Manufac Manage'), 'index.php?r=admin/manufac/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/manufac/add',
                    		'text' => e('Add Manufac'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'manufacModel',
				'value' => $items->items,
				'id' => 'manufacId'
			);
			
			$table = array(
				array('heading' => array('key' => 'manufacId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'image'),
					'filter' => array('show' => false),
					'tbody' => array('type' => 'file', 'class' => 'image_center image_center_small'),
				),
				array('heading' => array('key' => 'name'),
					'filter' => array(),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/manufac/edit&manufacId=%s',	
					'linkDelete' 	=> 'index.php?r=admin/manufac/delete&manufacId=%s',
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