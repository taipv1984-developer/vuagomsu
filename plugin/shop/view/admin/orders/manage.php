<?php 
	$ordersList = $_REQUEST['ordersList'];
	$shippingMethodArray = $_REQUEST['shippingMethodArray'];
	$paymentMethodArray = $_REQUEST['paymentMethodArray'];
	$orderStatusArray = $_REQUEST['orderStatusArray'];
    $exportLink = $_REQUEST['exportLink'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Orders Manage'), 'index.php?r=admin/orders/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
		<div class="table-toolbar">
	        <div class="row col-md-12">
	            <a href="<?=$exportLink?>" class="btn btn-danger">
		    		<i class="fa fa-download" aria-hidden="true"></i>
		    		<?php echo e('Export data')?>
		    	</a>
	        </div>
	    </div>
		<?php
			$options = array(
				'model' => 'ordersModel',
				'value' => $ordersList,
				'id' => 'orderId'
			);
			
			$table = array(
				array('heading' => array('key' => 'orderId', 'label' => 'ID', 'style' => 'width: 8%'),
					'filter' => array('type' => 'number', 'size' => 'xsmall'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'customerName', 'label' => 'Customer name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'email'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'phone'),
					'filter' => array('type' => 'number'),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'orderStatusName', 'label' => 'Status'),
					'filter' => array('type' => 'select', 'options' => $orderStatusArray, 'size' => 'small'),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'ordersDateTime', 'label' => 'Create date', 'style' => 'width: 150px'),
                    'filter' => array(
                        'type' => 'mutil_input',
                        'controls' => array(
                            array('type' => 'date', 'name' => 'crtDateFrom', 'value' => $_REQUEST['crtDateFrom'], 'placeholder' => 'Date from'),
                            array('type' => 'date', 'name' => 'crtDateTo', 'value' => $_REQUEST['crtDateTo'], 'placeholder' => 'Date to')
                        )),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'totalFormat', 'label' => 'Total', 'style' => 'width:100px'),
					'filter' => array('type' => 'text2', 
							'name1' => 'totalFrom', 'name2' => 'totalTo',
							'placeholder1' => 'Total from', 'placeholder2' => 'Total to'),
					'tbody' => array('class' => 'bold price'),
				),
				//...
			);
			
			$tool = array(
				'action' => array(
					'linkEdit' => 'index.php?r=admin/orders/edit&orderId=%s',
					'linkDelete' => 'index.php?r=admin/orders/delete&orderId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>
	    <div class="table-toolbar">
	    	<div class="row">
				<?php TemplateHelper::getTemplate('common/paging.php')?>
			</div>
		</div>
	</div>
</div>