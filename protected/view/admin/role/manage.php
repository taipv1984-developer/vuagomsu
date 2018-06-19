<?php 
	$roleList = $_REQUEST['roleList'];
?>

<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Role Manage'));
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
		<div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/role/add', 
                    		'text' => e('Add role'),
                    	));
                    ?>
	            </div>
	        </div>
	    </div>
	    
	    <?php
			$options = array(
				'value' => $roleList,
				'id' => 'roleId',
				'show_filter' => false
			);
			
			$table = array(
				array('heading' => array('key' => 'role_id', 'label' => 'ID', 'style' => 'width: 150px'),
					'filter' => array('show' => false),
					'tbody' => array('class' => 'bold')
				),
				array('heading' => array('key' => 'role_name'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'role_type'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'permission_count'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/role/edit&roleId=%s',
					'linkDelete' 	=> 'index.php?r=admin/role/delete&roleId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>
	</div>
</div>
