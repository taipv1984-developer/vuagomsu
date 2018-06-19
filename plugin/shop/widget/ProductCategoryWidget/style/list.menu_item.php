<?php 
	//get current link
	$currentUrl = URLHelper::getCurrentUrl();
    $link = URLHelper::getProductListPage($v['categoryId']);
?>

<li <?php if($v['haveChild']) echo 'class="dropdown"' ?>>
	<?php if($link != ''){?>
		<a href="<?=$link?>" title="<?php echo $v['name'];?>">
			<?php if($v['level'] == 0){?>
				<i class='<?php echo $v['icon']?>'></i>
			<?php }?>
			
			<?php echo $v['name'];?>
		</a>
        <?=($v['haveChild']) ? '<b class="caret"></b>' : ''?>
	<?php  } else {?>
		<span>
			<?php echo $v['name'];?>
		</span>
	<?php }?>