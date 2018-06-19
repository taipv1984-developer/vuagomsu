<?php
	//get data
	$pluginCode = $_REQUEST['pluginCode'];
	$cartInfo = $_REQUEST['cartInfo'];
		$subTotal = $cartInfo['subTotal'];
		$totalQuantity = $cartInfo['totalQuantity'];
		$totalItem = $cartInfo['totalItem'];
	$shippingMethod = $_REQUEST['shippingMethod'];
	$paymentMethod = $_REQUEST['paymentMethod'];
	$surcharge = $_REQUEST['surcharge'];
	$total = $_REQUEST['total'];
	$shippingPrice = $_REQUEST['shippingPrice'];
?>
<div class="primary">
	<h1 class="cart_title">
		<?php echo e('Checkout'); ?>
	</h1>
	<div class="checkout_step">
		<?php include 'steps/step_1.php'?>
		
		<!-- contact_detail -->
		<?php include 'steps/step_2.php'?>
		
		<!-- shipping_payment -->
		<?php include 'steps/step_3.php'?>
		
		<!-- confirm -->
		<?php include 'steps/step_4.php'?>
	</div>
</div>