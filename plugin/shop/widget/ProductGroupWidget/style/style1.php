<?php
//get data
$layoutWidgetInfo = $setting['layoutWidgetInfo'];
$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
$productNewList = $setting['productNewList'];
$productFeatureList = $setting['productFeatureList'];
$productBestSellerList = $setting['productBestSellerList'];
?>
<div class="section section_tab_product a-center">
    <h2><span>Sản phẩm</span></h2>
    <div class="e-tabs">
        <div class="row row-noGutter">
            <div class="col-sm-12">
                <div class="content">
                    <ul class="tabs tabs-title clearfix">
                        <li class="tab-link current" data-tab="tab-1">
                            <span>Mới</span>
                        </li>
                        <li class="tab-link" data-tab="tab-2">
                            <span>Nổi bật</span>
                        </li>
                        <li class="tab-link" data-tab="tab-3">
                            <span>Bán chạy</span>
                        </li>
                    </ul>
                    <div id="tab-1" class="tab-content current">
                        <div class="products row row-gutter-14">
                            <?php foreach ($productNewList as $v){?>
                            <div class="col-xs-6 col-sm-3 col-lg-2">
                                <?php TemplateHelper::renderProductItem('product_box_item', $v)?>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-content">
                        <div class="products row row-gutter-14">
                            <?php foreach ($productFeatureList as $v){?>
                                <div class="col-xs-6 col-sm-3 col-lg-2">
                                    <?php TemplateHelper::renderProductItem('product_box_item', $v)?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-content">
                        <div class="products row row-gutter-14">
                            <?php foreach ($productBestSellerList as $v){?>
                                <div class="col-xs-6 col-sm-3 col-lg-2">
                                    <?php TemplateHelper::renderProductItem('product_box_item', $v)?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>