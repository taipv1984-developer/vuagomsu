<?php
$baseUrl = URLHelper::getBaseUrl();
$templateName = Registry::getTemplate('templateName');
?>
<html>
<head>
    <!-- title -->
    <title><?php echo $title; ?></title>
    <!-- icon -->
    <link rel="shortcut icon" href="<?php echo Registry::getSetting("site_icon")?>">
    <!-- viewport mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- meta charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- style default -->
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/reset.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/css/font-awesome/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

    <!-- jquery -->
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/jquery/jquery.min.js" type="text/javascript"></script>

    <!-- bootstrap -->
    <script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css'>

</head>
<body>
    <?php include $contentPath?>
</body>
</html>
