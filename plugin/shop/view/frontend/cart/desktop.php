<?php
//get data
$cartInfo = $_REQUEST['cartInfo'];
$productCartList = array();
foreach ($cartInfo['productCart'] as $productCartAttribute){
    foreach ($productCartAttribute as $v){
        $productCart[] = $v;
    }
}
?>
<article class="cart-info">
    <header class="bottom-margin-15 margin-top-15 text-center">
        <h1>Giỏ hàng</h1>
    </header>
    <div class="body">
        <div class="col-md-12 content-left">
            <div class="product_cart">
                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                    <thead>
                    <tr>
                        <th class="col-md-1 center"></th>
                        <th class="col-md-1 center">Hình ảnh</th>
                        <th class="col-md-2 center">Mã sản phẩm</th>
                        <th class="col-md-2 center">Tên sản phẩm</th>
                        <th class="col-md-2 center">Đơn giá</th>
                        <th class="col-md-2 center">Số lượng</th>
                        <th class="col-md-2 center">Thành tiền</th>
                    </tr>
                    </thead>
                    <!-- Tbody -->
                    <tbody>
                    <?php foreach ($productCart as $v){?>
                        <tr class="product_cart_item" data-productId="<?=$v['productId']?>" data-attributeValueid="<?=$v['attributeValueId']?>">
                            <td class="center">
                                <a href="#" class="remove_product" title="Loại bỏ sản phẩm">
                                    <i class="fa fa-close"></i>
                                </a>
                            </td>
                            <td>
                                <div class="image_center image_center_small">
                                    <a href="<?=URLHelper::getProductDetailPage($v['productId'])?>" title="<?=$v['productName']?>">
                                        <img src="<?=URLHelper::getImagePath($v['image'], 'small')?>"
                                             title="<?=$v['productName']?>" alt="<?=$v['productName']?>">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <?=$v['productCode']?>
                            </td>
                            <td>
                                <h3 class="product_name nopadding nomargin" title="Tên sản phẩm">
                                    <a href="<?=URLHelper::getProductDetailPage($v['productId'])?>" title="<?=$v['productName']?>" target="bank">
                                        <?=$v['productName']?>
                                    </a>
                                </h3>
                            </td>
                            <td>
                                <?=ProductExt::getPriceText($v['price']); ?>
                            </td>
                            <td class="center">
                                <span class="fa fa-play fa-rotate-90 quantity_button quantity_button_down" title="Giảm 1"></span>
                                <input type="number" class="quantity" value="<?=$v['quantity']?>"/>
                                <span class="fa fa-play fa-rotate-270 quantity_button quantity_button_up" title="Tăng 1"></span>
                            </td>
                            <td>
                                <div class="price price_total">
                                    <?=ProductExt::getPriceText($v['priceTotal']); ?>
                                </div>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div> <!-- end .product_cart_list -->
            <div class="clear margin-bottom-10"></div>

            <div class="form-group">
                <p class="price right">
                    <strong class="text-red-d42323">
                        <?=ProductExt::getPriceText($cartInfo['subTotal'])?>
                    </strong>
                </p>
                <span class="margin-right-10 right">Tổng cộng</span>
            </div>
            <div class="clear"></div>

            <div class="form-group right red">
                <span>
                    *Giá chưa bao gồm VAT và phí vận chuyển
                </span>
            </div>
            <div class="clear"></div>

            <div class="form-group">
                <a href="<?=URLHelper::getUrl('home/checkout')?>" <?= ($cartInfo['totalItem'] > 0) ? '' : 'disabled="disabled"' ?>
                   class="btn btn-danger right" title="Thanh Toán">
                    Thanh Toán
                </a>
                <a class="btn btn-info  margin-right-10 right" onclick="goBackFromCat()">
                    Tiếp tục mua hàng
                </a>
            </div>
        </div>
        <div class="clear margin-bottom-10"></div>
    </div>
</article>

<script type="text/javascript">
    function goBackFromCat() {
        window.history.go(-1);
    }
</script>