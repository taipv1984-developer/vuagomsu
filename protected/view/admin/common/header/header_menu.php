<?php 
	$menus = $params;
?>
<div class="page-header-menu">
	<div class="container">
		<!-- BEGIN MEGA MENU -->
		<div class="hor-menu">
			<ul class="nav navbar-nav">
				<?php if(Session::isAdmin()){?>
				<li class="<?php if($_REQUEST[ACTION_PARAM] == 'admin/index'){echo 'active';}?>">
				    <a href="index.php?r=admin/index"><?=e('Dashboard')?></a>
				</li>
				<?php }?>
				<?php 
				foreach($menus as $k => $v){
					if($v['level'] == 0){
						$subMenu = array();
						foreach($menus as $k1 => $v1){
							if($v1['level'] == 1 & $v1['parentId'] == $v['navLinkId'] & Session::havePermission($v1['link'])){
								$subMenu[] = $v1;
							}
						}
						if(count($subMenu) > 0){
				?>
				<li class="menu-dropdown classic-menu-dropdown">
				    <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" class="dropdown-toggle" href="javascript:void()">
				        <?=$v['title']; ?> <i class="fa fa-angle-down"></i>
				    </a>
				    <ul class="dropdown-menu pull-left">
				    <?php foreach ($subMenu as $item){ ?>
		    			<li class="<?php if($item['link'] == $_REQUEST[ACTION_PARAM]){echo 'active';}?>">
				            <a href="index.php?r=<?=$item['link']; ?>">
				                <i class="<?=$item['icon']; ?>"></i>
				                <?=$item['title']; ?>
				            </a>
				        </li>
	    			<?php } ?>
		    		</ul>
			    	<?php } ?>
				</li>
				<?php }//end level 0 
				}//end main foreach
				?>
			</ul>
		</div>
		<!-- END MEGA MENU -->
	</div>
	<div class='bottom_line'></div>
</div>