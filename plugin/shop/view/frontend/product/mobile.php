<?php 
	//get data
	$productInfo = $_REQUEST['productInfo'];
	$productId = $productInfo->productId;
	$productExtension = $_REQUEST['productExtension'];
	$productImage = $_REQUEST['productImage'];
	$isWishlisted = ProductExt::isWishlisted($productId);

	//add
    $categoryList = $_REQUEST['categoryList'];
?>

<section id="content" ui-view="content" class="ng-scope">
    <div id="productDetail" class="ng-scope">
        <div class="container-fluid">
            <div class="btn-group">
                <?php foreach ($categoryList as $v){?>
                <a href="<?=URLHelper::getProductListPage($v->categoryId)?>" class="btn btn-primary ng-binding ng-scope"">
                   <?=$v->name?>
                </a>
                <?php }?>
            </div>

            <article class="article-detail">
                <div class="banner-slider">
                    <ul>
                        <li class="flex-1">
                            <img src="<?=URLHelper::getImagePath($productInfo->image)?>" />
                        </li>
                    <?php foreach ($productImage as $v){?>
                        <li class="flex-1">
                            <img src="<?=URLHelper::getImagePath($v)?>" />
                        </li>
                    <?php }?>
                    </ul>
                </div>

                <header class="article-header text-center">
                    <h1 class="ng-binding">
                        <?=$productInfo->name?>
                    </h1>
                </header>

                <div class="body">
                    <div class="article-content">
                        <div class="header-wrap">
                            <div class="prd-info">
                                <?php if ($productInfo->code != ''){?>
                                <p class="code-product">
                                    <span>Mã sản phẩm: </span>
                                    <strong class="ng-binding"><?=$productInfo->code?></strong>
                                </p>
                                <?php }?>

                                <div class="price-info btn-action flex" display="flex">
                                    <div class="price-group flex-1">
                                        <?php if($productInfo->price > 0){?>
                                            <?php if($productInfo->saleOf > 0){?>
                                                <del class="ng-binding"><?=CurrencyExt::format_price($productInfo->saleOf)?></del>
                                            <?php }?>
                                            <p class="text-red-d42323 fs-22px">
                                                <strong class="ng-binding"><?=CurrencyExt::format_price($productInfo->price)?></strong>
                                            </p>
                                        <?php } else{?>
                                            <p class="text-red-d42323 fs-22px">Liên hệ</p>
                                        <?php }?>
                                    </div>
                                    <div class="action text-right" flex="1">
                                        <button class="btn btn-danger btn-block buy_now" data-productId="<?=$productInfo->productId?>">Mua hàng</button>
                                    </div>
                                </div>

                                <small>Giá không bao gồm phí vận chuyển và VAT</small>
                                <div class="clear margin-bottom-5"></div>

                                <!-- product_attribute-->
                                <?php if($productExtension['attribute'] != ''){?>
                                    <div class="product_attribute">
                                        <?=$productExtension['attribute']?>
                                    </div>
                                <?php }?>

                                <div class="bl-r">
                                    <?php if ($isWishlisted) { ?>
                                        <button class="add-to-wish-list btn btn-warning" type="button">
                                            <i class="fa fa-heart-o add_product_wishlist_icon_selected"></i>
                                            <span class="remove_product_wishlist"
                                                  data-productId="<?= $productInfo->productId ?>">
                                                Sản phẩm đang quan tâm
                                            </span>
                                        </button>
                                    <?php } else { ?>
                                        <button class="add-to-wish-list btn btn-default" type="button">
                                            <i class="fa fa-heart-o add_product_wishlist_icon"></i>
                                            <span class="add_product_wishlist"
                                                  data-productId="<?= $productInfo->productId ?>">
                                                Thêm vào sản phẩm quan tâm
                                            </span>
                                        </button>
                                    <?php } ?>

                                    <div class="clear margin-bottom-5"></div>
                                    <div class="fb-share-button fb_iframe_widget fb_iframe_widget_fluid">
                                        <div class="fb-share-button" data-href="<?=URLHelper::getProductDetailPage($productInfo->productId)?>"
                                             data-layout="button_count" data-size="large" data-mobile-iframe="true">
                                            <a class="fb-xfbml-parse-ignore"
                                               href="https://www.facebook.com/sharer/sharer.php?u=<?=URLHelper::getProductDetailPage($productInfo->productId)?>">
                                                Chia sẻ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-content">
                            <div class="ship-info">
                                <?=Registry::getSetting('ship_info')?>
                            </div>
                            <div class="prd-info-detail">
                                <h3>Thông tin chi tiết</h3>
                                <?=$productInfo->description?>

                                <!-- youtube -->
                                <?php
                                    if($productExtension['youtube'] != ''){
                                        $videoPath = str_replace("watch?v=", 'embed/', $productExtension['youtube']);
                                ?>
                                    <div class="youtube-wrap ng-isolate-scope">
                                        <iframe src="<?=$videoPath?>" style="width:100%; height:250px; border: 0" allowfullscreen='allowfullscreen'></iframe>
                                    </div>
                                <?php }?>
                            </div>
                            <!-- buy_now -->
                            <button class="btn btn-danger btn-block btn-lg top-margin-10 buy_now" data-productId="<?=$productInfo->productId?>">
                                Mua hàng
                            </button>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
<div class="clear"></div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.banner-slider ul').lightSlider({
            auto: false,
            item: 1,
            loop: true,
            slideMove: 1,
            pager: true,
        });
    });
</script>
