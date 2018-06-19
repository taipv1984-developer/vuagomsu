<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Help Cat Manage'), 'index.php?r=admin/help_cat/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/help_cat/add',
                    		'text' => e('Add Category'),
                    		'class' => 'popup_action',
                    	)); 
                    ?>
	            </div>
	            
	            <!-- paging -->
	            <?php TemplateHelper::getTemplate('common/paging.php')?>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'helpCatModel',
				'value' => $items->items,
				'id' => 'helpCatId'
			);
			
			$table = array(
				array('heading' => array('key' => 'helpCatId', 'label' => 'ID', 'style' => 'width: 6%', 'class' => 'sorting'),
					'filter' => array('type' => 'number'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'description'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEditPopup'  	=> 'index.php?r=admin/help_cat/edit&helpCatId=%s',
					'linkDelete' 	=> 'index.php?r=admin/help_cat/delete&helpCatId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		parent.$.fancybox.close();
	});
</script>