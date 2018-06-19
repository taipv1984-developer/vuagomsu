<?php
	//get current link
	$currentUrl = URLHelper::getCurrentUrl();

    $liLevel = $level-1;

	//get class
	$class = $v['class'] . ' nav-link';
	if($v['haveChild']) $class .= ' dropdown-toggle';
	if($class != '') $class = "class='$class'";

	$liClass = 'nav-item ';
    $liClass .= "li_{$liLevel} ";
    $liClass .= "menu_item_{$v['id']} ";
    $liClass .= ($v['haveChild']) ? 'dropdown' : '';
    $liClass .= ($v['link'] == $currentUrl) ? 'active' : '';
    $liClass .= ($v['class'] != '') ? "li_{$v['class']}" : '';

    if($liLevel==1){
        $liClass = 'nav-item-lv2';
    }
?>
<li class="<?=trim($liClass)?>">
	<?php if($v['link'] != ''){?>
		<a href="<?=$v['link']?>" title="<?=$v['title'];?>"
			<?=$class?>
			<?php if($v['haveChild']) echo 'data-toggle="dropdown" class="dropdown-toggle"' ?>
			>
			<?=$v['title'];?>
			<?php if($v['haveChild']){?>
				<i class="fa fa-angle-down"></i>
			<?php }?>
		</a>
	<?php  } else {?>
		<span>
			<?=$v['title'];?>
            <?php if($v['haveChild']){?>
                <i class="fa fa-angle-down"></i>
            <?php }?>
		</span>
	<?php }?>