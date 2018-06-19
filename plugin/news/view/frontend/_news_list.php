<?php
 	//get data
 	$newsList = $_REQUEST['newsList'];
 	$newsCategoryInfo = $_REQUEST['newsCategoryInfo'];
?>

<article>
	<header class="margin-bottom-15 text-center">
    	<h1>
			<?=($newsCategoryInfo->name != '') ? $newsCategoryInfo->name : 'Tin tức'?>
		</h1>
    </header>
	<div class="news-content">
		<?php if(count($newsList) == 0){?>
			<div class="no_data">
				<?=e('No data')?>
			</div>
		<?php } else { ?>
			<div class="news-list">
				<ul>
				<?php foreach ($newsList as $v){?>
					 <li>
                        <a href="<?=URLHelper::getNewsDetailPage($v->newsId)?>" class="news_thumbnail">
                            <img src="<?=URLHelper::getImagePath($v->image, 'large')?>"
                                title="<?=$v->title?>" alt="<?=$v->title?>"/>
                        </a>
                        <h3 class="news_title">
                            <a href="<?=URLHelper::getNewsDetailPage($v->newsId)?>">
                                <?=$v->title?>
                            </a>
                        </h3>

                         <div class="news_info">
                             <span class="news_info_item news_crt">
                                 <i class="fa fa-calendar"></i>
                                 Ngày đăng: <?=date('d/m/Y', strtotime($v->crtDate))?>
                             </span>
                             <span class="news_info_item news_view_count">
                                 <i class="fa fa-bar-chart"></i>
                                 Lượt xem: <?=$v->viewCount?>
                             </span>
                             <br>
                         </div>

                        <div class="news_summary">
                            <?php
                                if($v->summary == '' || $v->summary == '<p></p>'){
                                    echo StringHelper::subString($v->content);
                                }
                                else{
                                    echo $v->summary;
                                }
                            ?>
                        </div>
					</li>
				<?php } ?>
				</ul>
				
				<!-- paging -->
                <div class="col-md-12">
				<?php TemplateHelper::getTemplate('common/paging.php')?>
                </div>
			</div>
		<?php }?>
	</div>
</article>
<div class="clear"></div>