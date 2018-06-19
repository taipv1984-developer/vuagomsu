<?php
	//get data
	$r = $_REQUEST['r'];
?>
<ul class="account-menu">
	<li class="<?php if($r == 'home/account') echo 'active'?>">
		<a href="<?=URLHelper::getUrl('home/account')?>">
			<i class="fa fa-info"></i>
			Thông tin tài khoản
		</a>
	</li>
	<li class="<?php if($r == 'home/product/wishlist') echo 'active'?>">
		<a href="<?=URLHelper::getUrl('home/product/wishlist')?>">
			<i class="fa fa-star"></i>
			Sản phẩm quan tâm
		</a>
	</li>
	<li class="<?php if($r == 'home/account/orders') echo 'active'?> hide">
		<a href="<?=URLHelper::getUrl('home/account/orders')?>">
			<i class="fa fa-opencart"></i>
			Đơn hàng đã mua
		</a>
	</li>
	<li class="logout">
		<a href="<?=URLHelper::getUrl('home/logout')?>">
			<i class="fa fa-sign-out"></i>
			Đăng xuất
		</a>
	</li>
</ul>