<?php 
	$items = $_REQUEST['pageView'];
	$widgetCatArray = $_REQUEST['widgetCatArray'];
	$pluginCodeArray = $_REQUEST['pluginCodeArray'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Widget Manage'), 'index.php?r=admin/widget/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/widget/add', 
                    		'text' => e('Add Widget'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'widgetModel',
				'value' => $items->items,
				'id' => 'widgetId'
			);
			
			$table = array(
				array('heading' => array('key' => 'widgetId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'widgetCatName', 'label' => 'Category'),
					'filter' => array('type' => 'select', 'options' => $widgetCatArray),
					'tbody' => array(),
				),
					array('heading' => array('key' => 'controller'),
					'filter' => array(),
					'tbody' => array(),
				),
					array('heading' => array('key' => 'name'),
					'filter' => array(),
					'tbody' => array(),
				),
					array('heading' => array('key' => 'plugin_code', 'label' => 'Plugin'),
					'filter' => array('type' => 'select', 'options' => $pluginCodeArray),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/widget/edit&widgetId=%s',
					'linkDelete' 	=> 'index.php?r=admin/widget/delete&widgetId=%s',
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