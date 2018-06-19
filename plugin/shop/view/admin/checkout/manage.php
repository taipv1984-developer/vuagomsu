<?php 
	//get data
	$checkOutData = $_REQUEST['checkOutData'];
	$checkoutTypes = CheckoutExt::getCheckoutType();
	$checkoutTypeIcon = CheckoutExt::getCheckoutTypeIcon();
	
	$checkout_tab = Session::getSession('checkout_tab');
	if(!$checkout_tab) $checkout_tab = "tab_payment";
?>
<div class="portlet light">
	<?php 
		$tabParams = array();
		foreach ($checkoutTypes as $checkoutType){
			$tabParams[] = array(
				'id' => $checkoutType,
				'name' => $checkoutType,
				'active' => ($checkout_tab == "tab_$checkoutType")? true :  false,
				'icon' => $checkoutTypeIcon[$checkoutType]
			);
		}
		
		TemplateHelper::getTemplate('common/tabs.php', $tabParams);
	?>
	<div class="portlet-body">
		<div class="tab-content">
			<?php foreach ($checkoutTypes as $checkoutType){?>
			<div class="tab-pane <?php if($checkout_tab == "tab_$checkoutType") echo 'active' ?>" id="<?php echo "tab_$checkoutType" ?>">
				<div class="table-toolbar hide">
			        <div class="row">
			            <div class="col-md-6">
		                    <?php 
		                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
		                    		'link' => "index.php?r=admin/checkout/add&checkoutType=$checkoutType",
		                    		'text' => e('Add %s', $checkoutType),
		                    	)); 
		                    ?>
			            </div>
			        </div>
			    </div>
				<?php
					$options = array(
						'id' => 'checkoutId',
						'value' => $checkOutData[$checkoutType],
						'show_filter' => false
					);
					
					$table = array(
						array('heading' => array('key' => 'checkout_code'),
								'filter' => array(),
								'tbody' => array()
						),
						array('heading' => array('key' => 'checkout_name'),
							'filter' => array(),
							'tbody' => array('class' => 'bold')
						),
						array('heading' => array('key' => 'order'),
							'filter' => array(),
							'tbody' => array()
						),
						array('heading' => array('key' => 'status', 'style' => 'width: 160px'),
							'filter' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'size' => 'small'),
							'tbody' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'class' => 'change_status_ajax', 'size' => 'small')
						),
					);
					
					$tool = array(
						'action' => array(
							'linkEdit'  	=> 'index.php?r=admin/checkout/edit&checkoutId=%s',	
							'linkDelete' 	=> 'index.php?r=admin/checkout/delete&checkoutId=%s',
						)
					);
					TemplateHelper::renderTable($options, $table, $tool);
				?>
			</div>
			<?php }?>
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
			url : "index.php?r=admin/checkout/manage_ajax",
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