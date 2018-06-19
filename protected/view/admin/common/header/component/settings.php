<?php 
	$settingType = SettingExt::getSettingType();
?>

<li class="dropdown dropdown-dark">
    <a href="javascript:void();" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-close-others="true">
        <span><?=e('Settings')?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-default">
    	<?php 
			foreach ($settingType as $k => $v){
				if($k == '') continue;
				$active = ($k == $_REQUEST['setting']) ? 'active' : '';
		?>
			<li class='<?=$active?>'>
				<a href='index.php?r=admin/setting/manage&setting=<?=$k?>'>
					<?=$v?>
				</a>						
			</li>
		<?php }?>
    </ul>
</li>