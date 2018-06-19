<?php
	$helpInfo = $_REQUEST['helpInfo'];
	$isAction = $_REQUEST['isAction'];
	$relatedList = $_REQUEST['relatedList'];
?>

<div class="col-md-12 help_content">
	<h3><?php echo $helpInfo->title?></h3>
	<div class="clear"></div>
	
	<div class="content">
		<?php echo $helpInfo->content?>
	</div>
	<div class="clear"></div>
	
	<br>
	<div class="related">
		<h4>Các bài viết cùng danh mục</h4>
		<div class="clear"></div>
		<ul>
			<?php
				foreach ($relatedList as $v){
					$addClass = ($helpInfo->helpId == $v->helpId) ? 'active' : '';
			?> 
			<li class="<?php echo $addClass?>">
				<a href="<?php echo URLHelper::getUrl("admin/help/view", array('helpId' => $v->helpId))?>" title="<?php echo $v->title?>">
					<?php echo $v->title?>
				</a>
			</li>
			<?php }?>
		</ul>
	</div>
</div>