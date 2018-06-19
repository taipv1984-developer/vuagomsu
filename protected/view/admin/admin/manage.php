<?php 
	$items = $_REQUEST['pageView'];
	$roleArray = $_REQUEST['roleArray'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Admin Manage'), 'index.php?r=admin/admin/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/admin/add', 
                    		'text' => e('Add Admin')
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'adminModel',
				'value' => $items->items,
				'id' => 'adminId'
			);
			
			$table = array(
				array('heading' => array('key' => 'adminId', 'label' => 'ID', 'style' => 'width: 6%', 'class' => 'sorting'),
					'filter' => array('type' => 'number'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'role_name', 'label' => 'Role'),
					'filter' => array('type' => 'select', 'options' => $roleArray, 'size' => 'small'),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'username'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'email'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'phone'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'status', 'style' => 'width: 160px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'size' => 'small'),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'class' => 'change_status_ajax', 'size' => 'small')
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/admin/edit&adminId=%s',
					'linkDelete' 	=> 'index.php?r=admin/admin/delete&adminId=%s',
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

<script type="text/javascript">
	//change_status_ajax
	$(document).on('change','.change_status_ajax', function() {
		var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'change_status_ajax';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/admin/manage_ajax",
			data: {'action': action, 'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Change status success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
</script>