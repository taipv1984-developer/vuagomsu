<?php 
	//get data
	$xmlDataCount = $_REQUEST['xmlDataCount'];
	$productCategoryXmlDataCount = $_REQUEST['productCategoryXmlDataCount'];
	$productXmlDataCount = $_REQUEST['productXmlDataCount'];
	$newsCategoryXmlDataCount = $_REQUEST['newsCategoryXmlDataCount'];
	$newsXmlDataCount = $_REQUEST['newsXmlDataCount'];
	$staticPageXmlDataCount = $_REQUEST['staticPageXmlDataCount'];
	$commonPageXmlDataCount = $_REQUEST['commonPageXmlDataCount'];
?>

<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Sitemap info'));
		$toolbar->showToolBar();
	?>
	
	<div class="panel panel-default">
		<div class="panel-body">
			<ul class="sitemap-statistics">
				<li>
					<b>
						<?=e('Total link %s', $xmlDataCount)?>
					</b>
				</li>
				<li>
					<a href="indexx.php?r=admin/category/manage"><?=e('Product category page')?></a>
					<b><?=$productCategoryXmlDataCount?></b>
				</li>
				<li>
					<a href="indexx.php?r=admin/product/manage"><?=e('Product page')?></a>
					<b><?=$productXmlDataCount?></b>
				</li>
				<li>
					<a href="indexx.php?r=admin/news_category/manage"><?=e('News category page')?></a>
					<b><?=$newsCategoryXmlDataCount?></b>
				</li>
				<li>
					<a href="indexx.php?r=admin/news/manage"><?=e('News page')?></a>
					<b><?=$newsXmlDataCount?></b>
				</li>
				<li>
					<a href="indexx.php?r=admin/static_page/manage"><?=e('Static page page')?></a>
					<b><?=$staticPageXmlDataCount?></b>
				</li>
				<li>
					<span><?=e('Other page')?></span>
					<b><?=$xmlDataCount - $productCategoryXmlDataCount - $productXmlDataCount - $newsCategoryXmlDataCount - $newsXmlDataCount - $staticPageXmlDataCount?></b>
				</li>
			</ul>
			
			<a href="<?=Registry::getSetting('base_url').'/sitemap.xml'?>" class="btn btn-primary" target="_blank">
				<i class="fa fa-sitemap"></i>
				<?=e('View sitemap')?>
			</a>
		</div>
	</div>
</div>