<?php
	//get data
	$layoutWidgetInfo = $setting['layoutWidgetInfo'];
	$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
    $newsList = $setting['newsList'];
?>

<div class='widget_content aside-item <?=$setting['class'] ?>' <?=LayoutExt::getStyleWidget($setting)?>>
    <?php if($setting['show_title']){?>
        <h3 class="widget_title image_widget_title">
            <span><?=$setting['title']?></span>
        </h3>
    <?php } ?>

    <div class="list-blogs">
        <?php foreach ($newsList as $v){?>
            <article class="blog-item blog-item-list col-xs-12 col-md-12">
                <div class="blog-item-thumbnail">
                    <a href="<?=URLHelper::getNewsDetailPage($v->newsId)?>" title="<?=$v->title?>">
                        <img src="<?=URLHelper::getImagePath($v->image, 'large')?>"
                             title="<?=$v->title?>" alt="<?=$v->title?>">
                    </a>
                </div>
                <div>
                    <h3 class="blog-item-name">
                        <a href="<?=URLHelper::getNewsDetailPage($v->newsId)?>" title="<?=$v->title?>">
                            <?=$v->title?>
                        </a>
                    </h3>
                    <div class="post-time">
                        <i class="fa fa-calendar" aria-hidden="true"></i><?=date('d/m/Y', strtotime($v->crtDate))?>
                    </div>
                </div>
            </article>
        <?php }?>
    </div>
</div>
<div class="clear"></div>

