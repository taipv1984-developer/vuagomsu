<?php 
	$orderId = $_REQUEST['orderId'];
	$ordersInfo = $_REQUEST['ordersInfo'];
	$customerInfo = $ordersInfo->customerInfo;
?>

<header class="margin-bottom-15 text-center">
    <h1>
		Chi tiết đơn hàng #<?php echo $orderId?>
	</h1>
</header>
<div class="orders_detail">
	<!-- #Orders_information -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title bold">
				<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#orders_information">
					<?php echo e('Orders information')?> 
				</a>
			</h4>
		</div>
		<div id="orders_information" class="panel-collapse in">
			<div class="panel-body">
			<?php 
				TemplateHelper::getTemplate('common/input/label_row.php',
					array('label' => e('Note'),
						'title' => $ordersInfo->orderStatusName,
					));
				TemplateHelper::getTemplate('common/input/label_row.php',
					array('label' => e('Total'),
						'title' => CProductExt::getPriceText($ordersInfo->total),
						'class' => 'red bold left price',
					));
				TemplateHelper::getTemplate('common/input/label_row.php',
					array('label' => e('Note'), 
						'title' => $ordersInfo->note,
						'class' => 'italic'
					));
			?>
			<!-- date time -->
			<?php 
				TemplateHelper::getTemplate('common/input/label_row.php',
					array('label' => e('Created onaaaaa'),
						'title' => $ordersInfo->crtDateInfo,
					));
				TemplateHelper::getTemplate('common/input/label_row.php',
					array('label' => e('Modified on'),
						'title' => $ordersInfo->modInfo,
					));
			?>
			</div>
		</div>
	</div>  
	
	<!-- contact_detail -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title bold">
				<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#contact_detail">
					<?php echo e('Customer info')?> 
				</a>
			</h4>
		</div>
		<div id="contact_detail" class="panel-collapse in contact_detail">
			<div class="panel-body">
				<?php 
					TemplateHelper::getTemplate('common/input/label_row.php',
						array('label' => e('Name'),
							'title' => CCustomerExt::getFullName($customerInfo),
						));
					TemplateHelper::getTemplate('common/input/label_row.php',
						array('label' => e('Email'),
							'title' => $customerInfo->email,
						));
					TemplateHelper::getTemplate('common/input/label_row.php',
						array('label' => e('Phone'),
							'title' => $customerInfo->phone,
						));
					TemplateHelper::getTemplate('common/input/label_row.php',
						array('label' => e('Address'),
							'title' => $ordersInfo->shippingAddress,
						));
				?>
			</div>
		</div>
	</div>
	
	<!-- product_cart -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title bold">
				<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#product_cart">
					<?php echo e('Product list')?> 
				</a>
			</h4>
		</div>
		<div id="product_cart" class="panel-collapse in orders_product_cart">
			<?php include 'product_cart.php';?>
		</div>
	</div>
</div>