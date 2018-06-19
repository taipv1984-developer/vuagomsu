<?php 
	//get data
	$baseUrl = URLHelper::getBaseUrl();
	$templateName = Registry::getTemplate('templateName');
	
	$isMobile = Session::getSession('isMobile');
	$isMobile = false;	//skip mobile UI
    $isMobileSlidebar = false;  //not show left, right sildebar
?>

<?php 
	$dispatch = $_REQUEST[ACTION_PARAM];
	
	//get layoutInfo
	$filter = array(
		'dispatch' => $dispatch,
	);
	$layoutInfo = LayoutExt::getLayoutInfo($filter);

	if(!$layoutInfo){
		$errorLayoutFile = FRONTEND_VIEW_PATH.Registry::getTemplate('templateName').'/layout/error.layout.php';
		include $errorLayoutFile;
		return;
	}
	
	//get layoutStyle and layoutScript
	$layoutStyle = json_decode($layoutInfo->layoutStyle, true);
	$layoutScript = json_decode($layoutInfo->layoutScript, true);
?>
<!DOCTYPE html>
<html lang="vi">
<?php include '_head.php' ?>
<?php
$style = array();
$font_family = Registry::getSetting('font_family');
if($font_family != ''){
    $style[] = "font-family: $font_family";
}
$font_size = Registry::getSetting('font_size');
if($font_size != ''){
    $style[] = "font-size: $font_size";
}
$bodyStyle = '';
if(count($style) > 0){
    $bodyStyle = "style=\"" . join('; ', $style) . "\"";
}
?>
<body <?=$bodyStyle?>>
	<?php
		$messageFile = FRONTEND_VIEW_PATH.Registry::getTemplate('templateName').'/common/message.php';
		include $messageFile;
		if($isMobile){
			$mobileLayoutFile = FRONTEND_VIEW_PATH.Registry::getTemplate('templateName').'/layout/mobile.layout.php';
			include $mobileLayoutFile;
		}
		else{
			LayoutExt::renderTemplate($layoutInfo);
		}
	?>
	<div class="clear"></div>
	<?php
		//write footer
		echo $layoutStyle['footer'];
		echo $layoutScript['footer'];
	?>
	<div class='dialog_form'></div>

    <?php
        if(!$isMobile){
            echo Registry::getSetting('script_live_chat');
        }
    ?>
	<!--  script_on_footer -->
	<?php echo Registry::getSetting('script_on_footer')?>
</body>
</html>