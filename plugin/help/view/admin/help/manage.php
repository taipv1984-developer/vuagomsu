<?php 
	$items = $_REQUEST['pageView'];
	$helpCat = $_REQUEST['helpCat'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Help Manage'), 'index.php?r=admin/help/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/help/add', 
                    		'text' => e('Add Help'),
                    	)); 
                    ?>
	            </div>
	            
	            <!-- paging -->
	            <?php TemplateHelper::getTemplate('common/paging.php')?>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'helpModel',
				'value' => $items->items,
				'id' => 'helpId'
			);
			
			$table = array(
				array('heading' => array('key' => 'helpId', 'label' => 'ID', 'style' => 'width: 6%', 'class' => 'sorting'),
					'filter' => array('type' => 'number'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'title'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'helpCatName', 'label' => 'Category'),
					'filter' => array('type' => 'select', 'text' => 'Category',
							'options' => $helpCat),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'style' => 'width: 10%',
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/help/edit&helpId=%s',	
					'linkViewPopupMax'  	=> 'index.php?r=admin/help/view&helpId=%s',
					'linkDelete' 	=> 'index.php?r=admin/help/delete&helpId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>
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
			url : "index.php?r=admin/help/manage_ajax",
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