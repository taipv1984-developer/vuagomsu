<!DOCTYPE html>
<html lang="en">
<head>
	<?php include PROTECTED_PATH.'view/layout/backend.head.php'?>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="page-header-menu-fixed">
    <?php TemplateHelper::getTemplate('common/message.php') ?>
	
	<!-- BEGIN HEADER -->
	<?php TemplateHelper::getTemplate('common/header/header.php', array())?>
	<!-- END HEADER -->
	
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
		    <?php include $contentPath;?>
		</div>
	</div>
	<!-- END PAGE CONTENT -->
	
	<!-- BEGIN PRE-FOOTER -->
	<?php TemplateHelper::getTemplate('common/footer/prefooter.php', array())?>
	<!-- END PRE-FOOTER -->
	
	<!-- BEGIN FOOTER -->
	<?php TemplateHelper::getTemplate('common/footer/footer.php', array())?>
	<!-- END FOOTER -->
	
	<!-- ORTHER ITEMS -->
	<div id="wait">
		<img src="<?=URLHelper::getResource('resource/backend/images/pre_load_ajax.gif')?>">
	</div>
	<div class="notice"></div>
</body>
<!-- END BODY -->
</html>