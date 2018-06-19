<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Newsletter Email Template Manage'), 'index.php?r=admin/newsletter/email_manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/newsletter/email_add', 
                    		'text' => e('Add Newsletter Email Template'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'newsletterEmailModel',
				'value' => $items->items,
				'id' => 'newsletterEmailTemplateId'
			);
			
			$table = array(
				array('heading' => array('key' => 'newsletterEmailTemplateId', 'label' => 'ID', 'class' => 'sorting'),
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
			);
			
			$tool = array(
				'style' => 'width: 130px',
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/newsletter/email_edit&newsletterEmailTemplateId=%s',
					'linkSend' 		=> 'index.php?r=admin/newsletter/email_send&newsletterEmailTemplateId=%s',
					'linkDelete' 	=> 'index.php?r=admin/newsletter/email_delete&newsletterEmailTemplateId=%s',
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