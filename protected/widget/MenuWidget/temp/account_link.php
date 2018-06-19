<?php
    $liClass = ($v['class'] != '') ? "li_{$v['class']}" : '';
?>
<?php if(Session::isCustomerLogin()){?>
    <li class="header_top_account <?=$liClass?>">
        <a href="<?=URLHelper::getUrl('home/account')?>">
            <i class="icon-user"></i>
            <?=Session::getCustomerName()?>
        </a>
<?php } else {?>
    <li class="header_top_account <?=$liClass?>">
        <a href="javascript:login()">
            <i class="icon-user"></i>
            Đăng nhập
        </a>
<?php }?>