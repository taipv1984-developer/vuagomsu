<?php include '_params.php'?>
<?php
	$options = isset($params['options']) ? $params['options'] : ArrayHelper::getAll();
	$status = $options[$params['value']];
	$class = str_replace(' ', '_', strtolower($status));
	echo "<span title='$status' class='$class'>$status</span>";
?>