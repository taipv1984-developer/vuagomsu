<?php
$isMobile = Session::getSession('isMobile');
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

//++
$prePage = $curPage-1;
$nextPage = $curPage+1;
?>

<footer>
    <div class="ng-scope pagination_mobile">
        <nav class="ng-scope">
            <ul class="pager">
                <li class="pagination_mobile_first">
                    <?php if($curPage == 1){
                        echo "&nbsp;";
                        }
                    else {?>
                    <a href="<?=URLHelper::getPadingPage($prePage, $orderBy)?>">
                        Trang trước
                    </a>
                    <?php }?>
                </li>

                <li class="pagination_mobile_last">
                    <?php if($curPage == $totalPage) {
                        echo "&nbsp;";
                    }
                    else {?>
                    <a href="<?=URLHelper::getPadingPage($nextPage, $orderBy)?>">
                        Trang sau
                    </a>
                    <?php }?>
                </li>
            </ul>
        </nav>
    </div>
</footer>