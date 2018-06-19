<?php 
	$items = $_REQUEST['pageView'];
?>
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="760"></div>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Email Template Manage'), 'index.php?r=admin/email_template/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/email_template/add', 
                    		'text' => e('Add Email Template')
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
					'model' => 'emailTemplateModel',
					'value' => $items->items,
					'id' => 'emailTemplateId'
			);
			
			$table = array(
				array('heading' => array('key' => 'emailTemplateId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'key'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'subject'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'note'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit' => 'index.php?r=admin/email_template/edit&emailTemplateId=%s',
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