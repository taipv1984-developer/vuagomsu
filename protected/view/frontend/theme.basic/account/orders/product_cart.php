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
			<tr id="row_<?=$v['attributeValueId']?>" class="row_<?=$v['attributeValueId']?>">
				<td>
                    <div class="image_center image_center_small">
                        <a href="<?=URLHelper::getProductDetailPage($v['productId'])?>" title="<?=$v['productName']?>">
                            <img src="<?=URLHelper::getImagePath($v['image'], 'small')?>"
                                 title="<?=$v['productName']?>" alt="<?=$v['productName']?>">
                        </a>
                    </div>
                </td>
				
				<td>
					<div class="product_name">
						<h3>
							<a href="<?=URLHelper::getProductDetailPage($v['productId'])?>" title="<?=$v['productName']?>" target="bank">
								<?=$v['productName']?>
							</a>
						</h3>
						<?=$v['productCode']?>
						<?php if($v['attributeValueId']){?>
						<div class="attribute_value">
							<img src="<?=$v['attributeValueImage']?>" title="<?=$v['attributeValue']?>" alt="<?=$v['attributeValue']?>">
							<span><?=$v['attributeValue']?></span>
						</div>
						<?php }?>
					</div>
				</td>
				<td>
					<div class="price"><?=ProductExt::getPriceText($v['price']);?></div>
				</td>
				<td>
					<?=$v['quantity']?>
				</td>
				<td>
					<div class="price price_total"><?=ProductExt::getPriceText($v['priceTotal']); ?></div>
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
				<em><?=e('Orders Subtotal')?></em>
				<strong class="price subTotal">
					<?=ProductExt::getPriceText($cartInfo['subTotal']); ?>
				</strong>
			</li>
			<!-- shipping price -->
			<li>
				<em><?=e('Shipping price')?></em>
				<strong class="price">
					<?=ProductExt::getPriceText($shippingPrice); ?>
				</strong>
			</li>
			<?php foreach($surchargeList as $v){?>
			<li>
				<em><?=e($v->name)?></em>
				<strong class="price">
					<?=ProductExt::getPriceText($v->value); ?>
				</strong>
			</li>
			<?php }?>
			<!-- total -->
			<li class="total_price">
				<em><?=e('Total')?></em>
				<strong class="price">
					<?=ProductExt::getPriceText($total); ?>
				</strong>
			</li>
		</ul>
	</div>
</div>