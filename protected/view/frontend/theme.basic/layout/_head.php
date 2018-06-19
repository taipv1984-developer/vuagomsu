<?php
if ($seoInfo->title != '') {
	$title = $seoInfo->title;
} else {
	$title = Registry::getSetting('site_name');
}
$seoInfo = $_REQUEST['seoInfo'];
if ($seoInfo->keyword != '') {
	$keywords = $seoInfo->keyword;
} else {
	$keywords = Registry::getSetting('meta_keyword');
}
if ($seoInfo->description != '') {
	$description = $seoInfo->description;
} else {
	$description = Registry::getSetting('description');
}
?>
<head>
    <!-- title -->
    <title><?=$title; ?></title>
    <!-- icon -->
    <link rel="shortcut icon" href="<?=Registry::getSetting("site_icon")?>">
    <!-- viewport mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- meta charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- meta keywords -->
    <meta name="keywords" content="<?=$keywords;?>">
    <!-- meta description -->
    <meta name="description" content="<?=$description?>">

    <!-- style default -->
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/reset.css" rel='stylesheet' type='text/css'>
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/font-awesome/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

    <!-- jquery -->
    <script src="<?="$baseUrl/resource/frontend/$templateName"?>/js/jquery/jquery.min.js" type="text/javascript"></script>

    <!-- bootstrap -->
    <script src="<?="$baseUrl/resource/frontend/$templateName"?>/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/js/bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>

    <!-- style widget -->
    <?=$layoutStyle['head']; ?>
    <!-- toastr -->
    <script src="<?="$baseUrl/resource/frontend/$templateName"?>/js/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/js/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>

    <!-- fancybox  -->
    <script src="<?="$baseUrl/resource/frontend/$templateName"?>/js/fancy_box_2/source/jquery.fancybox.js" type="text/javascript"></script>
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/js/fancy_box_2/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>

    <!-- font -->
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <?php
        $fontLink = Registry::getSetting('font_link');
        if($fontLink != ''){
            $fontLink = explode("\n", $fontLink);
            foreach ($fontLink as $v){
                echo "<link href=\"$v\" rel=\"stylesheet\" type=\"text/css\">\n";
            }
        }
    ?>

    <!-- mobile -->
    <?php if($isMobileSlidebar){?>
        <link href="<?="$baseUrl/resource/frontend/$templateName"?>/js/slidebars/slidebars.min.css" rel='stylesheet' type='text/css'>
        <link href="<?="$baseUrl/resource/frontend/$templateName"?>/js/slidebars/style.css" rel='stylesheet' type='text/css'>
        <script src="<?="$baseUrl/resource/frontend/$templateName"?>/js/slidebars/slidebars.min.js" type="text/javascript"></script>
    <?php }?>
    <?php if($isMobile){?>
        <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/phone.css" rel='stylesheet' type='text/css'>
    <?php }?>

    <!-- style ovewrite -->
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/CustomViewWidget.css" rel='stylesheet' type='text/css'>
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/kbefitness.style.css" rel='stylesheet' type='text/css'>
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/my_style.css" rel='stylesheet' type='text/css'>

    <!-- script widget -->
    <?=$layoutScript['head']; ?>

    <!--  script_on_head -->
    <?=Registry::getSetting('script_on_head')?>

    <!--  script common -->
    <?php include RESOURCE_PATH ."frontend/$templateName/js/common.js.php" ?>

    <!-- custom_css -->
    <?php if(Registry::getSetting('custom_css') != ''){?>
        <style type="text/css">
            <?=Registry::getSetting('custom_css')?>
        </style>
    <?php }?>
</head>