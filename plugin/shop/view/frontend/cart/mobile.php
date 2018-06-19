<?php
	//get data
	$cartInfo = $_REQUEST['cartInfo'];
	$productCartList = array();
	foreach ($cartInfo['productCart'] as $productCartAttribute){
		foreach ($productCartAttribute as $v){
			$productCart[] = $v;
		}
	}

    $cityList = $_REQUEST['cityList'];
    $customerInfo = $_REQUEST['customerInfo'];
    $customerAddressList = $_REQUEST['customerAddressList'];
    $cartInfo = $_REQUEST['cartInfo'];
?>
<section id="content" ui-view="content" class="ng-scope">
    <div class="container-fluid ng-scope">
        <article class="cart-info">
            <header class="article-header text-center">
                <h1>Giỏ hàng</h1>
            </header>
            <div class="body">
                <div class="row">
                    <div class="col-md-8 product_cart_list product_cart_list_mobile">
                        <div class="cart-title" display="flex" align-items="center">
                            <strong flex="3" class="ng-binding"><?=count($productCart)?> Sản phẩm</strong>
                            <strong flex="1">Giá</strong>
                            <strong flex="1">Số lượng</strong>
                        </div>
                        <div class="clear margin-bottom-5"></div>

                        <?php
                        $i = 0;
                        foreach ($productCart as $v){
                            $i++;
                        ?>
                        <div class="cart-list ng-scope product_cart_item product_cart_item_mobile" display="flex" align-items="flex-start"
                             data-productId="<?=$v['productId']?>" data-attributeValueid="<?=$v['attributeValueId']?>">
                            <figure class="prd-info" flex="3" display="flex">
                                <div class="thumbnail" flex="1">
                                    <a href="<?=URLHelper::getProductDetailPage($v['productId'])?>" title="<?=$v['productName']?>">
                                        <img title="<?=$v['productName']?>" alt="<?=$v['productName']?>"
                                             src="<?=URLHelper::getImagePath($v['image'], 'small')?>">
                                    </a>
                                </div>
                                <figcaption flex="2">
                                    <a href="<?=URLHelper::getProductDetailPage($v['productId'])?>" title="<?=$v['productName']?>">
                                        <h4 class="bold margin-top-0"><?=$v['productName']?></h4>
                                    </a>
                                    <p class="hide unknoww">Hàng nhập khẩu</p>
                                    <a href="#" class="btn-link remove_product" title="Loại bỏ sản phẩm">
                                        <i class="fa fa-times-circle"></i>
                                        Loại bỏ sản phẩm
                                    </a>
                                </figcaption>
                            </figure>
                            <div class="_price" flex="1">
                                <strong class="text-red-d42323 ng-binding">
                                    <?=ProductExt::getPriceText($v['price']); ?>
                                </strong>
                                <?php if($v['discount'] > 0){?>
                                <p><del><?=CurrencyExt::format_price($v['saleOf']);?></del></p>
                                <p class="ng-binding">Giảm giá <?=$v['discount']?>%</p>
                                <?php } ?>
                            </div>
                            <div class="quality center" flex="1">
                                <span class="fa fa-play fa-rotate-270 quantity_button quantity_button_up""></span>
                                <div class="clear"></div>
                                <input type="number" class="quantity" value="<?=$v['quantity']?>" style="padding: 3px; width: 50px; text-align: center;"/>
                                <div class="clear"></div>
                                <span class="fa fa-play fa-rotate-90 quantity_button quantity_button_down"></span>
                            </div>
                        </div>
                        <div class="clear margin-bottom-5"></div>
                        <?php }?>
                        <div class="clear margin-bottom-5"></div>
                    </div>
                    <div class="col-md-4">
                        <aside" class="ng-scope">
                            <div class="cart-order-info ng-scope">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>Thông tin đơn hàng</strong>
                                    </div>
                                    <div class="panel-body">
                                        <?php if($cartInfo['subTotal'] > 0){?>
                                        <div class="sub-total-price">
                                            <span>Tạm tính:</span>
                                            <strong><?=CurrencyExt::format_price($cartInfo['subTotal']);?></strong>
                                        </div>
                                        <?php } ?>
                                        <div class="total-price">
                                            <span>Tổng thanh toán</span>
                                            <strong class="ng-binding">(<?=count($productCart)?> sản phẩm)</strong>
                                            <p class="price">
                                                <strong class="text-red-d42323 ng-binding">
                                                    <?=ProductExt::getPriceText($cartInfo['subTotal'])?>
                                                </strong>
                                            </p>
                                        </div>
                                        <small>Giá trên chưa bao gồm: phí vận chuyển, VAT</small>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
            <footer class="order-info">
                <h3 class="prd-title">Thông tin người mua</h3>
                <form method="post" action="" class="form-horizontal ng-pristine ng-invalid ng-invalid-required ng-valid-email" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fullName" class="col-sm-3 control-label">Họ tên <span class="text-red-d42323">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" placeholder="Họ tên"
                                   required="required" name="fisrtName" value="<?=trim($customerInfo->firstName .' '. $customerInfo->lastName)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tỉnh/TP</label>
                        <div class="col-sm-9">
                            <select name="cityId" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty">
                                <?php
                                foreach ($cityList as $k => $v){
                                    if($k != ''){
                                ?>
                                <option value="<?=$k?>"><?=$v?></option>
                                <?php
                                    }
                                }
                                ?>
                                <option value="0">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Địa chỉ <span class="text-red-d42323">*</span></label>
                        <div class="col-sm-9">
                            <select name="customerAddressId" class="form-control customerAddressId <?= (!empty($customerAddressList)) ? '' : 'hide'?>">
                                <?php foreach ($customerAddressList as $v){?>
                                    <option value="<?=$v->customerAddressId?>">
                                        <?=$v->address?>
                                    </option>
                                <?php }?>
                                <option value="0">
                                    Nhập 1 địa chỉ khác
                                </option>
                            </select>
                            <input type="text" class="form-control customerAddress <?= (empty($customerAddressList)) ? '' : 'hide'?>"
                                   placeholder="Nhập địa chỉ" name="address" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber" class="col-sm-3 control-label">Điện thoại <span class="text-red-d42323">*</span></label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" id="phoneNumber" placeholder="Điện thoại" required=""
                                   required="required" name="phone" value="<?=$customerInfo->phone?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email <span class="text-red-d42323">*</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-email" id="email" placeholder="Email"
                                   required="required" name="email" value="<?=$customerInfo->email?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-sm-3 control-label">Ghi chú</label>
                        <div class="col-sm-9">
                            <textarea class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="note" rows="3" placeholder="Ghi chú" name="note"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <a class="btn btn-info" onclick="goBackFromCartCheckout()">
                                Tiếp tục mua hàng
                            </a>
                        </div>
                    </div>
                    <nav class="navbar navbar-default navbar-fixed-bottom" id="sendOrder">
                        <div class="container-fluid">
                            <button class="btn btn-block btn-danger btn-lg" type="submit"
                                <?= ($cartInfo['totalItem'] > 0) ? '' : 'disabled="disabled" style="background: #aaa; border: 1px solid #999;"' ?>>
                                Gửi đơn hàng
                            </button>
                        </div>
                    </nav>
                </form>
            </footer>
        </article>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $('.customerAddressId').change(function(){
            var val = $(this).val();
            $('.customerAddress').addClass('hide');
            $('.customerAddress').removeClass('validate_error');
            if(val == 0){
                $('.customerAddress').removeClass('hide');
                $('.customerAddress').focus();
            }
        });
    });
</script>

<script type="text/javascript">
    function goBackFromCartCheckout() {
        window.history.go(-1);
    }
</script>

<!-- validate ajax form -->
<script type="text/javascript">
    $(document).ready(function() {
        //$('.submit').click(function(){
        $("form").submit(function(event){		//required
            var validate = true;
            var address = $('input[name="address"]').val();
            var customerAddressId = $('select[name="customerAddressId"]').val();

            if(customerAddressId == 0 & address == ''){
                validate = false;
            }
            if(!validate){
                show_notice_error('Bạn chưa nhập địa chỉ');
                $('.customerAddress').addClass('validate_error');
                $('.customerAddress').focus();
                event.preventDefault();	//required
            }
        })
    });
</script>