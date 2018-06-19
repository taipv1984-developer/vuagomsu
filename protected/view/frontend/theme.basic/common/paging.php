<?php
$pageView = $_REQUEST['pageView'];
$curPage = 1;
if(!empty($_REQUEST['page'])&& is_numeric($_REQUEST['page']))
	$curPage = $_REQUEST['page'];
if(!empty($pageView)){
	$curPage = $pageView->currentPage;
}
$totalPage = $pageView->totalPage;
$nextPageRange = 2;
$prePageRange = 2;

$pageSize = $pageView->pageSize;
$totalItem = $pageView->totalItems;
if($curPage == $totalPage){
	$curentItem = $totalItem - ($totalPage-1)*$pageView->pageSize;
}
else{
	$curentItem = $pageView->pageSize;
}
//get orderBy
$orderBy = (isset($_REQUEST['orderBy'])) ? $_REQUEST['orderBy'] : '';
$limit = (isset($_REQUEST['limit'])) ? $_REQUEST['limit'] : 0;

//option show
$show_total = (isset($params['show_total'])) ? $params['show_total'] : false;
$show_all = (isset($params['show_all'])) ? $params['show_all'] : false;
?>
<?php if($totalPage){ ?>
	<?php if($show_total){?>
    <div class="pagination_title">
    	<?=e("PAGE %s OF %s <i>(item %s of %s)</i>", array($curPage, $totalPage, $curentItem, $totalItem));?>
    </div>
    <?php }?>
	<ul class="pagination">
	    <li class="pagination_first">
	    	<a href="<?=URLHelper::getPadingPage(1, $orderBy)?>"
	    	 	title='<?=e('Go to first page')?>'>
	    	 	<?=e('Previous')?>
	    	 </a>
	    </li>
		<?php 
			for($i = 0; $i < $totalPage; $i++){
				$iPage = $pageView->pageRange[$i];
				if($iPage == $curPage) {
		?>
			<li class="active">
				<a title='<?=e('Go to page %s', $iPage)?>'>
					<?=$iPage?>
				</a>
			</li>
			<?php }
			else{ 
				if($iPage > $curPage+$nextPageRange) continue;
				if($iPage < $curPage-$prePageRange) continue;
			?>
			<li>
				<a href="<?=URLHelper::getPadingPage($iPage, $orderBy)?>"
					title='<?=e('Go to page %s', $iPage)?>'>
					<?=$iPage?>
				</a>
			</li>
			<?php 
				}//end if
			}//end for
		?>
		<li class="pagination_last">
	    	<a href="<?=URLHelper::getPadingPage($totalPage, $orderBy)?>"
	    	 	title='<?=e('Go to last page')?>'>
	    	 <?=e('Next')?>
	    	 </a>
	    </li>
	    <?php if($show_all){?>
	    <li class="pagination_view_all">
	    	<a href="<?=URLHelper::getPadingPage(1, $orderBy, 'all')?>"
	    	 	title='<?=e('View all')?>'><?=e('View all')?></a>
	    </li>
	    <?php }?>
	</ul>
<?php } else {?>
	<div class='pagination_content col-md-6 right'>
		<ul class="pagination right">
			<?php if($show_all){?>
			<li class="active">
			    <a class="pagination_view_less" href="<?=URLHelper::getPadingPage(1, $orderBy)?>"
			    	 	title='<?=e('View less')?>'>
			    	<?=e('View less')?>
			    </a>
		    </li>
		    <?php }?>
		</ul>
	</div>
<?php }?>
