<?php 
	//get params
	$icon = $params['icon'];
	$title = $params['title'];
	$link = isset($params['link']) ? $params['link'] : '';
?>

<?php if($icon == 'manage'){?>
    <i class="fa fa-bars font-green-sharp"></i>
<?php } else if($icon == 'add'){?>
    <i class="fa fa-plus font-green-sharp"></i>
<?php } else if($icon == 'edit'){?>
    <i class="fa fa-edit font-green-sharp"></i>
<?php } else {?>
	<i class="<?=$icon;?> font-green-sharp"></i>
<?php }?>
<span class="caption-subject font-green-sharp bold uppercase">
	<?php 
		if($link == '') {
			echo $title;
		}
		else{
			echo "<a href='$link' title='$title'>$title</a>";
		}
	?>
    <?php
    //get current router
    $r = $_REQUEST[ACTION_PARAM];

    return; //test
    //getHelpRouter
    
    $routerHelp = HelpExt::getRouterArray();

    //show icon help
    if(isset($routerHelp[$r])){
        foreach ($routerHelp[$r] as $k => $v){
            ?>
            <a href="index.php?r=admin/help/view&helpId=<?=$k?>" class="linkViewPopup popup_max" title="<?=$v?>">
		<i class="fa fa-question-circle red" style=" margin-left:5px; font-size: 16px"></i>
	</a>
            <?php
        }
    }
    ?>
</span>