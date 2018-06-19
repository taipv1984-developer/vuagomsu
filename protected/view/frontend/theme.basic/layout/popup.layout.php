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

    <!-- style ovewrite -->
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/CustomViewWidget.css" rel='stylesheet' type='text/css'>
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/kbefitness.style.css" rel='stylesheet' type='text/css'>
    <link href="<?="$baseUrl/resource/frontend/$templateName"?>/css/my_style.css" rel='stylesheet' type='text/css'>
</head>
<body>
	<?php LayoutExt::renderTemplate($layoutInfo)?>
</body>
</html>