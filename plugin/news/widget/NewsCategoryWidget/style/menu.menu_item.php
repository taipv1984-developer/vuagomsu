<?php 
	$currentUrl = URLHelper::getCurrentUrl();
    $link = URLHelper::getNewsListPage($v['id']);
    $pos = strpos($currentUrl, $link);
?>

<li class="nav-item <?php //echo ($v['haveChild']) ? "dropdown" : '' ?> <?=($pos !== false) ? 'active' : ''?>">
	<?php if($link != ''){?>
		<a href="<?=$link?>" title="<?=$v['name'];?>"
			class="nav-link"
			<?php //if($v['haveChild']) echo 'data-toggle="dropdown"' ?>
			>
            <?php if($level == 1){?>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <?=$v['name'];?>
                <?php if($v['haveChild']){?>
                <i class="fa fa-angle-right pull-right"></i>
                <?php }?>
            <?php } else{?>
                <?=$v['name'];?>
            <?php } ?>
		</a>
	<?php  } else {?>
		<span>
			<?=$v['name'];?>
		</span>
	<?php }?>