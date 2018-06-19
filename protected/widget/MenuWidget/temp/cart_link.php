<?php
$cartInfo = ProductExt::getCartInfo();
$totalItem = $cartInfo['totalItem'];

$liClass = ($v['class'] != '') ? "li_{$v['class']}" : '';
?>

<li class="header_top_cart  <?=$liClass?>">
    <a class="shopping_cart" href="<?=URLHelper::getUrl("home/cart")?>">
        <i class="fa fa-shopping-cart"></i>
        <span>
            <?=($totalItem) ? e("Giỏ hàng (%s)", $totalItem) : e("Giỏ hàng")?>
        </span>
    </a>