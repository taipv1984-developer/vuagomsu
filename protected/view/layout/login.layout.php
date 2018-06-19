<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- TITLE -->
    <title><?=Registry::getSetting('site_name'). '&nbsp;-&nbsp;' . e('Login'); ?></title>
    
    <!-- META TAG -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="" >
    <meta name="author" content="">
    <!-- META TAG END-->
    
    <!-- ICON -->
    <link rel="shortcut icon" href="<?=URLHelper::getResource('resource/backend/images/icon.png')?>">
    <!-- ICON END-->
    
    
	<script src="<?=URLHelper::getResource('resource/backend/js/jquery.min.js')?>" type="text/javascript"></script>
	<link href="<?=URLHelper::getResource('resource/backend/css/components.css')?>" rel="stylesheet" type="text/css">
	
	<!-- BOOTSTRAP GROUP -->
	<!-- bootstrap -->
	<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
	<link href="<?=URLHelper::getResource('resource/backend/js/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
	<!-- toastr -->
	<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-toastr/toastr.min.js')?>" type="text/javascript"></script>
	<link href="<?=URLHelper::getResource('resource/backend/js/bootstrap-toastr/toastr.min.css')?>" rel="stylesheet" type="text/css"/>
	
	<!-- BOOTSTRAP GROUP END -->
	
	
    
	<link href="<?=URLHelper::getResource('resource/backend/css/login.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?=URLHelper::getResource('resource/backend/css/my_style.css')?>" rel="stylesheet" type="text/css"/>
</head>
<body class="login">
<?php TemplateHelper::getTemplate('common/message.php') ?>
<?php include $contentPath?>
</body>
</html>