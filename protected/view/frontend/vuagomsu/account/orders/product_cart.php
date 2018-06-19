<?php
	//get data
	$cartInfo = $_REQUEST['cartInfo'];
	$productCart = $cartInfo['productCart'];
	$productCartList = array();
	foreach ($productCart as $productCartAttribute){
		foreach ($productCartAttribute as $v){
			$productCartList[] = $v;
		}
	}
	$subTotal = $cartInfo['subTotal'] ;
	
	$shippingInfo = $_REQUEST['shippingInfo'];
	$shippingPrice = $shippingInfo->value;
	$paymentInfo = $_REQUEST['paymentInfo'];
	$surchargeList = $_REQUEST['surchargeList'];
	
	//set total from $subTotal, $shippingPrice, $surcharge
	$total = $subTotal + $shippingPrice;
	foreach($surchargeList as $v){
		$total += $v->value;
	}
?>

<div class="product_cart">
	<table class="table table-striped table-bordered table-hover dataTable no-footer">
		<thead>
			<tr>
				<th>Image</th>
				<th>Product</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
		</thead>
		<!-- Tbody -->
		<tbody>
			<?php foreach ($productCartList as $v){?>
			<tr id="row_<?php echo $v['attributeValueId']?>" class="row_<?php echo $v['attributeValueId']?>">
				<td>
                    <div class="image_center image_center_small">
                        <a href="<?php echo URLHelper::getProductDetailPage($v['productId'])?>" title="<?php echo $v['productName']?>">
                            <img src="<?=URLHelper::getImagePath($v['image'], 'small')?>"
                                 title="<?php echo $v['productName']?>" alt="<?php echo $v['productName']?>">
                        </a>
                    </div>
                </td>
				
				<td>
					<div class="product_name">
						<h3>
							<a href="<?php echo URLHelper::getProductDetailPage($v['productId'])?>" title="<?php echo $v['productName']?>" target="bank">
								<?php echo $v['productName']?>
							</a>
						</h3>
						<?php echo $v['productCode']?>
						<?php if($v['attributeValueId']){?>
						<div class="attribute_value">
							<img src="<?php echo $v['attributeValueImage']?>" title="<?php echo $v['attributeValue']?>" alt="<?php echo $v['attributeValue']?>">
							<span><?php echo $v['attributeValue']?></span>
						</div>
						<?php }?>
					</div>
				</td>
				<td>
					<div class="price"><?php echo CProductExt::getPriceText($v['price']);?></div>
				</td>
				<td>
					<?php echo $v['quantity']?>
				</td>
				<td>
					<div class="price price_total"><?php echo CProductExt::getPriceText($v['priceTotal']); ?></div>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
	
	<!-- product_cart_total -->
	<div class="cart_order_totals product_cart_total hide">
		<ul>
			<!-- sub total -->
			<li>
				<em><?php echo e('Orders Subtotal')?></em>
				<strong class="price subTotal">
					<?php echo CProductExt::getPriceText($cartInfo['subTotal']); ?>
				</strong>
			</li>
			<!-- shipping price -->
			<li>
				<em><?php echo e('Shipping price')?></em>
				<strong class="price">
					<?php echo CProductExt::getPriceText($shippingPrice); ?>
				</strong>
			</li>
			<?php foreach($surchargeList as $v){?>
			<li>
				<em><?php echo e($v->name)?></em>
				<strong class="price">
					<?php echo CProductExt::getPriceText($v->value); ?>
				</strong>
			</li>
			<?php }?>
			<!-- total -->
			<li class="total_price">
				<em><?php echo e('Total')?></em>
				<strong class="price">
					<?php echo CProductExt::getPriceText($total); ?>
				</strong>
			</li>
		</ul>
	</div>
</div>