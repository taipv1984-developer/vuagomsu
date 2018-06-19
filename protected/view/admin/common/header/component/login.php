<li class="dropdown dropdown-user dropdown-dark">
    <a href="javascript:void();" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-close-others="true">
        <i class='fa fa-user fa-2x'></i>
        <span class="username username-hide-mobile"><?=Session::getSession('admin_username')?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-default">
    	<?php if(Session::havePermission('admin/account')){ ?>
        <li>
            <a href="<?=URLHelper::getUrl('admin/account')?>">
                <i class="fa fa-user"></i> <?=e('My account')?> </a>
        </li>
        <?php }?>
        <li>
            <a href="<?=URLHelper::getUrl('admin/logout')?>">
                <i class="fa fa-key"></i> <?=e('Log out')?> </a>
        </li>
    </ul>
</li>