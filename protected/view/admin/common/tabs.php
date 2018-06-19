<?php 
	$setActive = false;
	foreach($params as $k => $tab){
		if(isset($tab['active'])){
			$setActive = true;
			break;
		}
	}
?>
<ul class="nav nav-tabs">
    <?php foreach($params as $k => $tab){?>
    <li 
    	<?php 
    		if($setActive){
	    		if($tab['active']){
					echo 'class="active"';
				}
			}
			else{
				if($k == 1){
					echo 'class="active"';
				}
			}
    	?>
    	>
        <a href="#tab_<?=$tab['id']?>" data-toggle="tab">
            <?php if (isset($tab['icon'])) {?> 
            <i class="<?=$tab['icon']?>"></i>
            <?php }?>
            <?=$tab['name']?>
        </a>
    </li>
    <?php }?>
</ul>