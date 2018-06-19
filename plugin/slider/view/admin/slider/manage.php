<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Slider Manage'), 'index.php?r=admin/slider/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/slider/add', 
                    		'text' => e('Add Slider'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
	    <form action="" id="userSearchForm" method="post">
		<?php 
			$options = array(
				'model' => 'sliderModel',
				'value' => $items->items,
				'id' => 'sliderId'
			);
			
			$table = array(
				array('heading' => array('key' => 'sliderId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
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
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/slider/edit&sliderId=%s',
					'linkDelete' 	=> 'index.php?r=admin/slider/delete&sliderId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>
	    </form>
		
		<!-- paging -->
	    <div class="row">
			<?php TemplateHelper::getTemplate('/common/paging.php')?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		parent.$.fancybox.close();
	});
	
	//change_status_ajax
	$(document).on('change','.change_status_ajax', function() {
		var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'change_status_ajax';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/slider/manage_ajax",
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