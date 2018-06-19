<?php
	//get data
	$baseUrl = URLHelper::getBaseUrl();
	$templateName = Registry::getTemplate('templateName');
	$customerReviewList = $_REQUEST['customerReviewList'];
?>

<link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/testimonial.css" rel="stylesheet" type="text/css">

<div class="testimonial_content">
    <article>
        <header class="margin-bottom-15 text-center">
            <h1>Ý kiến khách hàng</h1>
        </header>
        <div id="testimonialArticle" class="content-block">
            <?php
                $i = 0;
                foreach ($customerReviewList as $v){
                    $i++;
                    $addClass = ($i % 2 == 0) ? 'blq-right blockquote-reverse' : 'blq-left';
            ?>
            <blockquote class="ng-scope <?php echo $addClass?>">
                <div class="testdesc">
                    <?php echo $v->content?>
                </div>
                <figure>
                    <div class="thumbnail flex-1 <?php if($i % 2 == 0) echo 'thumbnail-right'?>">
                        <img src="<?php echo URLHelper::getImagePath($v->image, 'large')?>"
                            alt="<?php echo "{$v->name} - {$v->career}"?>" title="<?php echo "{$v->name} - {$v->career}"?>">
                    </div>
                    <div class="flex-4">
                        <h4><?php echo $v->title?></h4>
                        <footer>
                            <cite title="Source Title"><?php echo $v->name?></cite>, <?php echo $v->career?>
                        </footer>
                    </div>
                </figure>
            </blockquote>
            <div class="clear"></div>
            <?php }?>

            <!-- paging -->
            <?php TemplateHelper::getTemplate('common/paging.php')?>
        </div>
    </article>
</div>
<div class="clear"></div>