<?php 
	//get data
	$staticPageInfo = $_REQUEST['staticPageInfo'];
?>

<article class="new_detail_content">
    <div class="page_title">
        <h1><?=$staticPageInfo->title?></h1>
    </div>

    <div class="page_content">
        <div class="post_img bottom-margin-15">
            <img src="<?=URLHelper::getImagePath($staticPageInfo->image, '')?>"
                 title="<?=$staticPageInfo->title?>" alt="<?=$staticPageInfo->title?>">
        </div>
        <div class="clear"></div>

        <div class="post_content">
            <?=$staticPageInfo->content?>
        </div>
        <div class="clear"></div>
    </div>
</article>