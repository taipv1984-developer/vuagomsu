<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('{tableText} Manage'), 'index.php?r=admin/{table}/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/{table}/add', 
                    		'text' => e('Add {tableText}'),
                    		//'class' => 'popup_action'
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => '{tableVo}Model',
				'value' => $items->items,
				'id' => '{tableVo}Id'
			);
			
			$table = array(
				array('heading' => array('key' => '{tableVo}Id', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'name'),
					'filter' => array(),
					'tbody' => array(),
				),
				//...
				array('heading' => array('key' => 'status', 'style' => 'width: 120px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'size' => 'small'),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'class' => 'change_status_ajax', 'size' => 'small')
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/{table}/edit&{tableVo}Id=%s',
					//'linkView' 	=> 'index.php?r=admin/{table}/view&{tableVo}Id=%s',
					//'linkViewPopup' 	=> 'index.php?r=admin/{table}/view&{tableVo}Id=%s',
					'linkDelete' 	=> 'index.php?r=admin/{table}/delete&{tableVo}Id=%s',
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
			url : "index.php?r=admin/{table}/manage_ajax",
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