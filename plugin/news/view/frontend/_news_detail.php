<?php 
	//get data
	$newsInfo = $_REQUEST['newsInfo'];
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
	<header class="margin-bottom-15 text-center">
    	<h1>
			<?=$newsInfo->title?>
		</h1>
    </header>
	<div class="news-content">
        <header class="margin-bottom-10">
            <div class="post-info display-flex">
				<span class="user-post left">
					<i class="fa fa-user"></i>&nbsp;
                    <?=$crtByName?>
				</span>
                <span class="calendar-post right" style="text-align: right">
					<i class="fa fa-calendar"></i>&nbsp;
                    <?=date('d/m/Y', strtotime($newsInfo->crtDate))?>
				</span>
                <span class="tags-post hide">
					<i class="fa fa-tags"></i>
                    <?php
                    $i = 0;
                    foreach ($newsTagSelected as $v){
                        $i++;
                        ?>
                        <a href="<?=URLHelper::getNewsTagPage($v->newsTagId)?>" title="<?=$v->name?>">
						<?=$v->name?>
                        <?php if($i < count($newsTagSelected)) echo ',&nbsp;'?>
					</a>
                    <?php }?>
				</span>
            </div>
        </header>

		<div class="body">
			<div class="post-img bottom-margin-15">
				<img src="<?=URLHelper::getImagePath($newsInfo->image, '')?>"
					title="<?=$newsInfo->title?>" alt="<?=$newsInfo->title?>">
			</div>
			<div class="clear"></div>
			
			<div class="news_summary">
				<b><?=$newsInfo->summary?></b>
			</div>
			<div class="clear margin-bottom-10"></div>

			<div class="post-content">
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

            <?php if(!empty($newsTagSelected)){?>
			<div class="news_relate news_relate_footer">
				<div class="news_relate_title">
					Các bài viết liên quan
				</div>
				<ul class="simple-list">
					<?php 
					$i = 0;
					foreach ($newsRelateList as $v){
					$i++;
					if($i>5) continue;
					?>
					<li>
                        <h4>
                            <a href="<?=URLHelper::getNewsDetailPage($v->newsId)?>" title="<?=$v->title?>">
                                <i class="fa fa-caret-right"></i>
                                <?=$v->title?>
                            </a>
                        </h4>
					</li>
					<?php }?>
				</ul>
			</div>
            <?php }?>
		</div>
	</div>
</article>
<div class="clear"></div>