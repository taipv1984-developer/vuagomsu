<?php
$cartInfo = ProductExt::getCartInfo();
$liClass = ($v['class'] != '') ? "li_{$v['class']}" : '';
?>

<li class="nyx-utility-menu-bag cart_popup <?=$liClass?>">
	<div class="minicart_wrapper">
		<div id="minicart" class="minicart <?=($cartInfo['totalItem']) ? '' : 'empty_minicart'?> ">
			<div class="mini_cart_total">
				<a href="<?=URLHelper::getUrl('home/cart')?>" title="View Bag" class="mini_cart_link ">
					Bag
					<?php if($cartInfo['totalItem']){?>
					<span class="mini_cart_quantity">[<?=$cartInfo['totalItem']?>]</span>
					<?php }?>
				</a>
			</div>
			<div class="mini_cart_content">
				<?php if($cartInfo['totalItem']) {?>
					<?php
					$params = array (
						'cartInfo' => $cartInfo,
						'isPopup' => true 
					);
					TemplateHelper::getTemplate('common/cart/cart.php', $params, 'shop');
					?>
				<?php } else {?>
				<div class=" content_asset minicartempty ">
					<p>
						<?=e("Your shopping bag is empty")?>. 
						<a href="<?=URLHelper::getUrl('home')?>"><?=e("SHOP NOW")?></a> 
						<?=e("to find your favorite product")?>.
					</p>
				</div>
				<?php }?>
			</div>
		</div>
	</div>