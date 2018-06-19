<?php
 	//get data
 	$newsList = $_REQUEST['newsList'];
 	$newsCategoryInfo = $_REQUEST['newsCategoryInfo'];
?>

<div class="box-heading">
    <h1 class="title-head">
        <?=($newsCategoryInfo->name != '') ? $newsCategoryInfo->name : 'Tin tức'?>
    </h1>
</div>
<section class="list-blogs blog-main row">
    <?php
    $i = 0;
    $col = 3;
    foreach ($newsList as $v){
        $i++;
    ?>
    <div class="col-sm-4 col-md-4 col-lg-4">
        <article class="blog-item">
            <div class="blog-item-thumbnail">
                <a href="<?=URLHelper::getNewsDetailPage($v->newsId)?>" class="news_thumbnail">
                    <img src="<?=URLHelper::getImagePath($v->image, 'large')?>"
                         title="<?=$v->title?>" alt="<?=$v->title?>"/>
                </a>
            </div>
            <div class="blog-content">
                <h3 class="blog-item-name margin-top-10">
                    <a href="<?=URLHelper::getNewsDetailPage($v->newsId)?>" title="<?=$v->title?>">
                        <?=$v->title?>
                    </a>
                </h3>
                <div class="post-time">
                    <div><?=date('Y<p>d/m</p>', strtotime($v->crtDate))?></div>
                </div>
                <p class="blog-item-summary margin-bottom-5">
                    <?php
                    if($v->summary == '' || $v->summary == '<p></p>'){
                        echo StringHelper::subString($v->content);
                    }
                    else{
                        echo $v->summary;
                    }
                    ?>
                </p>
                <a href="<?=URLHelper::getNewsDetailPage($v->newsId)?>" class="btn btn-white btn_readmore">
                    Xem thêm
                </a>
            </div>
        </article>
    </div>
    <?=($i%$col==0) ? '<div class="clear"></div>' : ''?>
    <?php }?>
</section>
<div class="clear"></div>

<div class="row margin-top-5">
    <div class="col-xs-6 col-md-8 text-sm-right right">
        <!-- paging -->
        <?php TemplateHelper::getTemplate('common/paging.php')?>
    </div>
</div>
<div class="clear"></div>