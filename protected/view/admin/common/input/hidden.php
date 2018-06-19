<?php
	$id = ($params['id']) ? "id={$params['id']}" : '';
?>
<input type="hidden" name="<?=$params['name']?>" value="<?=$params['value']?>"
 	<?=$id?> class="<?=$params['class']?> <?=$params['name']?>"/>