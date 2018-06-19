<?php 
	$items = $_REQUEST['pageView'];
	$layoutList = $_REQUEST['layoutList'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Router Manage'), 'index.php?r=admin/router/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/router/add', 
                    		'text' => e('Add Router'),
                    		'class' => 'hide'
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'routerModel',
				'value' => $items->items,
				'id' => 'routerId'
			);
			
			$table = array(
				array('heading' => array('key' => 'routerId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'layoutLink', 'label' => 'Layout'),
					'filter' => array('type' => 'select', 
							'options' => $layoutList, 'options_map' => array('layoutId', 'name')),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'alias_by', 'label' => 'Alias by'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'alias'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'prefix', 'style' => 'width: 120px'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'suffix', 'style' => 'width: 120px'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'count', 'label' => 'Url Count', 'style' => 'width: 100px'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/router/edit&routerId=%s',
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