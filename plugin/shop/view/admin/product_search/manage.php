<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Tìm kiếm sản phẩm'), 'index.php?r=admin/product_search/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/product_search/add', 
                    		'text' => e('Thêm 1 từ khóa'),
                    	));
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'productSearchModel',
				'value' => $items->items,
				'id' => 'productSearchId'
			);
			
			$table = array(
				array('heading' => array('key' => 'productSearchId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'key', 'label' => 'Từ khóa'),
					'filter' => array(),
					'tbody' => array(),
				),
                array('heading' => array('key' => 'count', 'label' => 'Số lần tìm kiếm'),
                    'filter' => array('type' => 'number'),
                    'tbody' => array(),
                ),
                array('heading' => array('key' => 'modDate', 'label' => 'Thời gian tìm kiếm cuối cùng'),
                    'filter' => array('show' => false),
                    'tbody' => array(),
                ),
                array('heading' => array('key' => 'order', 'label' => 'Thứ tự'),
                    'filter' => array('show' => false),
                    'tbody' => array(),
                ),
				array('heading' => array('key' => 'status', 'style' => 'width: 120px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'size' => 'small'),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'class' => 'change_status_ajax', 'size' => 'small')
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/product_search/edit&productSearchId=%s',
					'linkDelete' 	=> 'index.php?r=admin/product_search/delete&productSearchId=%s',
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
			url : "index.php?r=admin/product_search/manage_ajax",
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