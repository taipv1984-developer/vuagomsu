<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Customer Manage'), 'index.php?r=admin/customer/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <a href="index.php?r=admin/customer/export" class="btn btn-danger">
                        <i class="fa fa-download" aria-hidden="true"></i>
                        <?=e('Export data')?>
                    </a>
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/customer/add', 
                    		'text' => e('Add Customer'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'value' => $items->items,
				'id' => 'customerId'
			);
			
			$table = array(
				array('heading' => array('key' => 'customerId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
// 				array('heading' => array('key' => 'username'),
// 					'filter' => array(),
// 					'tbody' => array(),
// 				),
				array('heading' => array('key' => 'email'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'phone'),
					'filter' => array(),
					'tbody' => array(),
				),
//                array('heading' => array('key' => 'oauthProvider', 'label' => 'Loại tài khoản'),
//                    'filter' => array('type' => 'select', 'options' => ApplicationConfigHelper::get('account.type.list'), 'size' => 'small'),
//                    'tbody' => array(),
//                ),
				array('heading' => array('key' => 'status', 'style' => 'width: 160px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'size' => 'small'),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'class' => 'change_status_ajax', 'size' => 'small')
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/customer/edit&customerId=%s',
					'linkDelete' 	=> 'index.php?r=admin/customer/delete&customerId=%s',
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
			url : "index.php?r=admin/customer/manage_ajax",
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