<?php include '_params.php'?>
<div class="<?="$class {$params['name']}" ?> label_value">
	<?php if(isset($params['link'])){?>
		<a href='<?=$params['link']?>'
			<?php if($params['is_popup']) echo 'class="popup"'?>>
			<?=$params['title']?>
		</a>
	<?php } else { 
			echo $params['title'];
		}
	?>
</div>