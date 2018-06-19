<?php 
	//get data
	$cartInfo = $_REQUEST['cartInfo'];
?>
<div class="cart-order-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>Thông tin đơn hàng</strong>
		</div>
		<div class="panel-body">
			<div class="sub-total-price">
				<span>Tạm tính:</span>
				<strong><?php echo ProductExt::getPriceText($cartInfo['subTotal'])?></strong>
			</div>
			<div class="total-price">
				<span>Tổng thanh toán</span> <strong>( sản phẩm)</strong>
				<p class="price">
				<strong class="text-red-d42323">
					<?php echo ProductExt::getPriceText($cartInfo['subTotal'])?>
				</strong></p>
			</div>
			<small>Giá trên chưa bao gồm: phí vận chuyển, VAT</small>
		</div>
		<div class="panel-footer">
			<a href="<?php echo URLHelper::getUrl('home/checkout')?>" class="btn btn-danger btn-block" title="Thanh Toán">
				Thanh Toán
			</a>
		</div>
	</div>
</div>