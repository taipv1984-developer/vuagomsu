<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Newsletter Manage'), 'index.php?r=admin/newsletter/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
//                     	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
//                     		'link' => 'index.php?r=admin/newsletter/add', 
//                     		'text' => e('Add Newsletter'),
//                     	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'newsletterModel',
				'value' => $items->items,
				'id' => 'newsletterId'
			);
			
			$table = array(
				array('heading' => array('key' => 'newsletterId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'email'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'subscribe', 'style' => 'width: 160px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::get10(), 'size' => 'small'),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::get10(), 'class' => 'change_subscribe_ajax', 'size' => 'small')
				),
			);
			
			$tool = array(
				'action' => array(
					//'linkEdit'  	=> 'index.php?r=admin/newsletter/edit&newsletterId=%s',
					'linkDelete' 	=> 'index.php?r=admin/newsletter/delete&newsletterId=%s',
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
	//change_subscribe_ajax
	$(document).on('change','.change_subscribe_ajax', function() {
		var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'change_subscribe_ajax';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/newsletter/manage_ajax",
			data: {'action': action, 'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Change subscribe success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
</script>