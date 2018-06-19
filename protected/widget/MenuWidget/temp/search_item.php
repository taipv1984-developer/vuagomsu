<?php
$liClass = ($v['class'] != '') ? "li_{$v['class']}" : '';
?>

<li class="<?=$liClass?>">
    <div class="search f-right">
        <div class="header_search search_form">
            <form action="<?=URLHelper::getUrl('home/search')?>" name="search-form" id="search-form" method="get"
                class="input-group search-bar search_form">
                <input type="search" name="key" value="<?=urldecode($_REQUEST['key'])?>" placeholder="Tìm kiếm sản phẩm... "
                       class="input-group-field st-default-search-input search-text">
                <span class="input-group-btn">
                    <button class="btn icon-fallback-text">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </form>
        </div>
    </div>