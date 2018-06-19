<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Customer Review Manage'), 'index.php?r=admin/customer_review/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/customer_review/add', 
                    		'text' => e('Add Customer Review'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'customerReviewModel',
				'value' => $items->items,
				'id' => 'customerReviewId'
			);
			
			$table = array(
				array('heading' => array('key' => 'customerReviewId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'career'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'title'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'content'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'status', 'style' => 'width: 120px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getAPD(), 'size' => 'small'),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getAPD(), 'class' => 'change_status_ajax', 'size' => 'small')
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/customer_review/edit&customerReviewId=%s',
					'linkDelete' 	=> 'index.php?r=admin/customer_review/delete&customerReviewId=%s',
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
			url : "index.php?r=admin/customer_review/manage_ajax",
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