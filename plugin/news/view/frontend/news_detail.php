<?php 
	//get data
	$newsInfo = $_REQUEST['newsInfo'];
	$newsCategoryInfo = $_REQUEST['newsCategoryInfo'];
	$newsTagSelected = $_REQUEST['newsTagSelected'];
	$crtByName = $_REQUEST['crtByName'];
	$newsRelateList = $_REQUEST['newsRelateList'];
?>
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=<?= Registry::getSetting('facebook_app_id')?>";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<article class="new_detail_content">
    <div class="page_title">
        <h1><?=$newsInfo->title?></h1>
    </div>

    <div class="row post_extra margin-bottom-10">
        <div class="col-md-6">
            <div class="post_category">
                Chuyên mục:
                <a href="<?=URLHelper::getNewsListPage($newsCategoryInfo->newsCategoryId)?>" title="<?=$newsCategoryInfo->name?>">
                    <?=$newsCategoryInfo->name?>
                </a>

            </div>
        </div>
        <div class="col-md-6">
            <div class="post_info">
                <span class="post_calendar">
                    <i class="fa fa-calendar"></i>
                    Ngày đăng:
                    <?=date('d/m/y', strtotime($newsInfo->crtDate))?>
                </span>
                <span class="post_view">
                    <i class="fa fa-eye"></i>
                    Lượt xem:
                    <?=$newsInfo->viewCount?>
                </span>
            </div>
        </div>
    </div>

	<div class="page_content">
        <div class="post_img bottom-margin-15">
            <img src="<?=URLHelper::getImagePath($newsInfo->image, '')?>"
                title="<?=$newsInfo->title?>" alt="<?=$newsInfo->title?>">
        </div>
        <div class="clear"></div>

        <?php if($newsInfo->summary != ''){?>
        <div class="news_summary">
            <b><?=$newsInfo->summary?></b>
        </div>
        <div class="clear margin-bottom-10"></div>
        <?php } ?>

        <div class="post_content">
            <?=$newsInfo->content?>
        </div>
        <div class="clear"></div>

        <div class="social_share">
            <div class="share-button fb-share-button" data-href="<?=URLHelper::getProductDetailPage($productInfo->productId)?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
                <a class="fb-xfbml-parse-ignore" href="https://www.facebook.com/sharer/sharer.php?u=<?=URLHelper::getProductDetailPage($productInfo->productId)?>">
                    Chia sẻ
                </a>
            </div>

            <!-- google+ share button-->
            <script type="text/javascript" src="https://apis.google.com/js/platform.js" async defer>
                {lang: 'vi'}
            </script>
            <div class="share-button gp-share-button">
                <div class="g-plus" data-action="share" data-height="24"></div>
            </div>
        </div>
        <div class="clear"></div>

        <!-- facebook comment -->
        <div class="fb-comments" data-href="<?=URLHelper::getNewsDetailPage($newsInfo->newsId)?>"
             data-width="100%"
             data-numposts="10"
             data-order-by="social">
        </div>
        <div class="clear"></div>
	</div>
</article>
<div class="clear"></div>