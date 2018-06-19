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
    <title><?php echo $title; ?></title>
    <!-- icon -->
    <link rel="shortcut icon" href="<?php echo Registry::getSetting("site_icon")?>">
    <!-- viewport mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- meta charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- meta keywords -->
    <meta name="keywords" content="<?php echo $keywords;?>">
    <!-- meta description -->
    <meta name="description" content="<?php echo $description?>">

    <!-- style default -->
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/reset.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/font-awesome/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/simple-line-icons/css/simple-line-icons.css" rel='stylesheet' type='text/css'>

    <!-- jquery -->
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/jquery/jquery.min.js" type="text/javascript"></script>

    <!-- bootstrap -->
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>

    <!-- style widget -->
    <?php echo $layoutStyle['head']; ?>
    <!-- toastr -->
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>

    <!-- fancybox  -->
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/fancy_box_2/source/jquery.fancybox.js" type="text/javascript"></script>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/fancy_box_2/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>

    <!-- image-tooltip -->
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/image-tooltip/image-tooltip.js" type="text/javascript"></script>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/image-tooltip/image-tooltip.css" rel="stylesheet" type="text/css"/>

    <!-- auto_numeric -->
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/auto_numeric/autoNumeric.js" type="text/javascript"></script>

    <!-- font -->
    <?php
        $fontLink = Registry::getSetting('font_link');
        if($fontLink != ''){
            $fontLink = explode("\n", $fontLink);
            foreach ($fontLink as $v){
                echo "<link href=\"$v\" rel=\"stylesheet\" type=\"text/css\">\n";
            }
        }
    ?>

    <!-- style -->
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/base.css" rel="stylesheet" type="text/css">
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/main.css" rel="stylesheet" type="text/css">
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/module.css" rel="stylesheet" type="text/css">
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/responsive.css" rel="stylesheet" type="text/css">
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/main.js" type="text/javascript"></script>

    <!-- mobile -->
    <?php if($isMobileSlidebar){?>
        <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/slidebars/slidebars.min.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/slidebars/style.css" rel='stylesheet' type='text/css'>
        <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/slidebars/slidebars.min.js" type="text/javascript"></script>
    <?php }?>
    <?php if($isMobile){?>
        <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/phone.css" rel='stylesheet' type='text/css'>
    <?php }?>

    <!-- style ovewrite -->
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/layout.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/my_style.css" rel='stylesheet' type='text/css'>

    <!-- script widget -->
    <?php echo $layoutScript['head']; ?>

    <!--  script_on_head -->
    <?php echo Registry::getSetting('script_on_head')?>

    <!--  script common -->
    <?php include RESOURCE_PATH ."frontend/$templateName/js/common.js.php" ?>

    <!-- custom_css -->
    <?php if(Registry::getSetting('custom_css') != ''){?>
        <style type="text/css">
            <?php echo Registry::getSetting('custom_css')?>
        </style>
    <?php }?>
</head>