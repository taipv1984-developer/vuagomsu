<?php 
	$items = $_REQUEST['pageView'];
?>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light">
	<div class="portlet-title">
	    <div class="caption">
	        <i class="fa fa-bars font-green-sharp"></i>
	           	<span class="caption-subject font-green-sharp bold uppercase">
	           		<a href='index.php?r=admin/attribute/manage'>
	           			<?php echo e('Attribute Manage')?>
	           		</a>
	           	</span>
	    </div>
	</div>
	<div class="table-toolbar">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <?php 
	                    TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
	                    	'link' => 'index.php?r=admin/attribute/add', 
	                    	'text' => e('Add Attribute')
	                    ))
                    ?>
	            </div>
	        </div>
	    </div>
    </div>
	<div class="portlet-body">
	    <?php
			$options = array(
				'model' => 'newsModel',
				'value' => $items->items,
				'id' => 'attributeId',
				'show_filter' => false
			);
			
			$table = array(
				array('heading' => array('key' => 'attributeId', 'label' => 'ID', 'style' => 'width: 80px', 'class' => 'sorting'),
					'filter' => array('type' => 'number'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'description'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'attributeValueList', 'label' => 'Attribute value'),
					'filter' => array(),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/attribute/edit&attributeId=%s',
					'linkDelete' 	=> 'index.php?r=admin/attribute/delete&attributeId=%s',
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