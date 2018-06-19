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
    <?php include $contentPath?>

	<!--  script_on_footer -->
	<?php echo Registry::getSetting('script_on_footer')?>
</body>
</html>