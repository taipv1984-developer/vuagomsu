<?php
//get data
$productInfo = $_REQUEST['productInfo'];
$productId = $productInfo->productId;
$productExtension = $_REQUEST['productExtension'];
$productImage = $_REQUEST['productImage'];
$productTagList = $_REQUEST['productTagList'];
$isWishlisted = ProductExt::isWishlisted($productId);
?>

<!-- productId = <?=$productId?> -->
<article class="product_page">
    <div class="row">
        <div class="product_image_wrap col-md-6">
            <!-- primary_image -->
            <div class="product_image image_center image_center_large">
                <a href="<?=URLHelper::getImagePath($productInfo->image)?>" class="fancybox" rel="gallery1" id="primary_image_link" title="<?=$productInfo->name?>">
                    <img class="primary_image" src="<?=URLHelper::getImagePath($productInfo->image)?>">
                </a>
                <?php if($productInfo->discount >0 & $productInfo->price > 0){?>
                    <div class="sale-flash sale-flash-large">- <?=$productInfo->discount?>%</div>
                <?php }?>
            </div>

            <!-- product_thumbnails -->
            <div class="thumbs product_thumbnail">
                <ul>
                    <li class="flex-1 image_center image_center_small ">
                        <a href="<?=URLHelper::getImagePath($productInfo->image)?>" rel="gallery1" class="thumbnail_link fancybox active" title="<?=$productInfo->name?>">
                            <img class="" src="<?=URLHelper::getImagePath($productInfo->image)?>">
                        </a>
                    </li>
                    <?php
                    $i = 0;
                    foreach ($productImage as $v){
                        $i++;
                        if($i>5) continue;
                        ?>
                    <li class="flex-1 image_center image_center_small ">
                        <a href="<?=URLHelper::getImagePath($v)?>" rel="gallery1" class="thumbnail_link fancybox active" title="<?=$productInfo->name?>">
                            <img class="" src="<?=URLHelper::getImagePath($v, 'small')?>">
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>

        <div class="product_info_wrap col-md-6 col-right">
            <h3 class="product_name">
                <?=$productInfo->name?>
            </h3>
            <div class="clear margin-bottom-10"></div>

            <div class="product_contact">Liên hệ</div>
            <div class="clear margin-bottom-10"></div>

            <!-- product_attribute-->
            <?php if($productExtension['attribute'] != ''){?>
                <div class="product_attribute">
                    <?=$productExtension['attribute']?>
                </div>
            <?php }?>

            <div class="product-extra margin-top-10 margin-bottom-10">
                <button class="add-to-wish-list btn btn-default btn_add_product_wishlist" type="button">
                    <i class="fa fa-heart-o add_product_wishlist_icon"></i>
                    <span class="add_product_wishlist" data-productid="348">
						Thêm vào sản phẩm quan tâm
					</span>
                </button>
                <div class="clear margin-bottom-10"></div>
                <div class="social_share">
                    <div class="fb-share-button" data-href="<?=URLHelper::getProductDetailPage($productInfo->productId)?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
                        <a class="fb-xfbml-parse-ignore" href="https://www.facebook.com/sharer/sharer.php?u=<?=URLHelper::getProductDetailPage($productInfo->productId)?>">
                            Chia sẻ
                        </a>
                    </div>
                </div>
            </div>

            <?php if($productTagList){?>
            <div class="tag-product">
                <label class="inline">Tags: </label>
                <?php foreach ($productTagList as $v){?>
                <a href="<?=URLHelper::getProductTagPage($v->productTagId)?>">
                   <?=$v->name?>,
                </a>
                <?php }?>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="clear margin-bottom-5"></div>

    <div class="body">
        <?php if(Registry::getSetting('ship_info') != ''){?>
        <div class="ship-info">
            <h3>
                <span>Thông tin giao hàng</span>
            </h3>
            <div class="ship-info-content">
            <?=Registry::getSetting('ship_info')?>
            </div>
        </div>
        <?php }?>

        <div class="e-tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#description">Mô tả sản phẩm</a></li>
                <li><a data-toggle="tab" href="#help">Hướng dẫn sử dụng</a></li>
            </ul>
            <div class="tab-content">
                <div id="description" class="tab-pane fade in active">
                    <?=$productInfo->description?>
                </div>
                <div id="help" class="tab-pane fade">
                    <?=$productExtension['help']?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</article>
<div class="clear margin-bottom-10"></div>

<!-- facebook comment -->
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=<?= Registry::getSetting('facebook_app_id')?>";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="fb-comments" data-href="<?=URLHelper::getNewsDetailPage($productInfo->productId)?>"
     data-width="100%"
     data-numposts="10"
     data-order-by="social">
</div>
<div class="clear"></div>