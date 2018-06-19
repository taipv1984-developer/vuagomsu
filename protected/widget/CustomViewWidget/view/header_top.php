<div class="col-sm-6  col-xs-6 a-left">
    <span>Hotline:
        <a href="tel:<?=Registry::getSetting('company_phone')?>">
            <?=Registry::getSetting('company_phone')?>
        </a>
    </span>
</div>
<div class="col-sm-6 col-xs-12">
    <?php if(Session::isCustomerLogin()){?>
    <ul class="list-inline f-right">
        <li>
            <a href="<?=URLHelper::getUrl('home/account')?>">
                <i class="fa fa-user" aria-hidden="true"></i>
                <?=Session::getCustomerName()?>
            </a>
        </li>
        <li>
            <a href="<?=URLHelper::getUrl('home/logout')?>">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Đăng xuất
            </a>
        </li>
        <li class="hide">
            <a href="<?=URLHelper::getUrl('home/cart')?>">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                Giỏ hàng
            </a>
        </li>
    </ul>
    <?php } else { ?>
    <ul class="list-inline f-right">
        <li>
            <a href="<?=URLHelper::getUrl('home/login')?>">
                <i class="fa fa-user" aria-hidden="true"></i>
                Đăng nhập
            </a>
        </li>
        <li>
            <a href="<?=URLHelper::getUrl('home/register')?>">
                <i class="fa fa-key" aria-hidden="true"></i>
                Đăng ký
            </a>
        </li>
        <li class="hide">
            <a href="<?=URLHelper::getUrl('home/cart')?>">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                Giỏ hàng
            </a>
        </li>
    </ul>
    <?php }?>
</div>