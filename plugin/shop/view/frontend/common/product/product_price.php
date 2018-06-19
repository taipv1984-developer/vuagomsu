<div class="pricing">
<?php if($productInfo->price > 0){?>
    <?php if($productInfo->saleOf > 0){ ?>
        <del><?=CurrencyExt::format_price($productInfo->saleOf)?></del>
    <?php }?>
    <p>
        <strong><?=CurrencyExt::format_price($productInfo->price)?></strong>
    </p>
<?php } else{?>
    <a class="btn btn-primary" href="<?=URLHelper::getUrl('home/contact')?>" title="Liên hệ">
        <i class="fa fa-phone margin-right-5"></i>
        Liên hệ
    </a>
<?php }?>
</div>