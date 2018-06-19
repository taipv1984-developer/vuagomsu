<?php
$pageView = $_REQUEST['pageView'];
$curPage = 1;
if(!empty($_REQUEST['page'])&& is_numeric($_REQUEST['page']))
	$curPage = $_REQUEST['page'];
if(!empty($pageView)){
	$curPage = $pageView->currentPage;
}
TemplateHelper::getTemplate('common/input/hidden.php', array(
	'input_name' => 'page',
	'value' => $curPage,
	'id' => 'page'
));
$searchFormId ='userSearchForm';
$searchPageId ='page';
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
?>

<?php if(!empty($pageView) & $totalPage != 0){ ?>
<div class='clear'></div>
<div class="col-md-6 pull-right">
    <div class="row">
	    <div class="col-md-5 col-sm-12">
	    	<div class="dataTables_info" style='line-height: 34px;'>
	    		<?=e("PAGE %s OF %s <i>(item %s of %s)</i>", array($curPage, $totalPage, $curentItem, $totalItem));?>
	    	</div>
	    </div>
    	<div class="col-md-7 col-sm-12">
    		<div class="dataTables_paginate paging_bootstrap_full_number">
				<ul class="pagination right">
				    <li class="cm-history">
				    	<a href="javascript:search('<?=$searchFormId?>', '<?=$searchPageId?>', 1)"
				    	 	title='<?=e('Go to first page')?>' id='page_1'>&laquo;</a>
				    </li>
					<?php
						for($i = 1; $i <= $totalPage; $i++){
							if($i == $curPage) {
					?>
						<li class="active">
							<a title='<?=e('Go to page %s', $i)?>' id='page_<?=$i?>'>
								<?=$i?>
							</a>
						</li>
					<?php }
						else{
							if($i > $curPage+$nextPageRange) continue;
							if($i < $curPage-$prePageRange) continue;
						?>
						<li>
							<a href="javascript:search('<?=$searchFormId?>', '<?=$searchPageId?>', <?=$i?>)"
								title='<?=e('Go to page %s', $i)?>' id='page_<?=$i?>'>
								<?=$i?>
							</a>
						</li>
					<?php
							}//end if
						}//end for
					?>
					<li class="cm-history">
				    	<a href="javascript:search('<?=$searchFormId?>', '<?=$searchPageId?>', <?=$totalPage?>)"
				    	 	title='<?=e('Go to last page')?>' id='page_<?=$totalPage?>'>&raquo;</a>
				    </li>
				</ul>
    		</div>
    	</div>
    </div>
</div>
<?php }?>