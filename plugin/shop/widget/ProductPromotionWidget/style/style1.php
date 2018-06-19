<?php
//get data
$productList = $setting['productList'];
$itemShow = 4;
?>

<div class="side_box <?=$setting['class']?>">
    <?php if($setting['show_title']){?>
        <h3 class="side_box_title">
            <span><?=$setting['title']?></span>
        </h3>
    <?php } ?>

    <div class="side_box_content">
        <div class="side_box_slide">
            <ul class="simple-list ">
                <?php
                //split to 2 col (4 product) in 3 slide
                $i = -1;
                $statusTag = false;
                foreach ($productList as $v){
                    $i++;
                    $addClass = ($i%2==0) ? 'side_box_item_left' : 'side_box_item_right';
                ?>
                <?php
                    if($i%$itemShow==0) {
                        $statusTag = !$statusTag;
                        echo ($statusTag) ? '<li>' : '';
                    }
                ?>
                <div class="col-md-6 side_box_item <?=$addClass?>"">
                    <?php TemplateHelper::renderProductItem('product_box_item', $v, array('class' => 'center'))?>
                </div>
                <?=($i%2==1 & $i<count($productList)-1)?'<div class="clear side_box_item_line"></div>':''?>
                <?php
                    if($i%$itemShow==0) {
                        $statusTag = !$statusTag;
                        echo ($statusTag) ? '</li>' : '';
                    }
                ?>
                <?php }?>
            </ul>
        </div>
    </div>
</div>