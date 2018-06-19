	<!-- TITLE -->
    <title>
	    <?php
	    $titleDefault = Registry::getSetting('site_name'). '&nbsp;-&nbsp;' . e('Administrator Panel');
	    $title = Registry::getConfig('title');
	    echo (!AppUtil::isEmptyString($title)) ? $title : $titleDefault;
	    Registry::setConfig('title', '');
	    ?>
    </title>
    
    <!-- META TAG -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="" >
    <meta name="company" content="TaiPV">
    <meta name="author" content="TaiPV">
    <!-- META TAG END-->
    
    <!-- ICON -->
    <?php if(Registry::getSetting('site_icon')){?>
    <link rel="shortcut icon" href="<?=Registry::getSetting('site_icon')?>">
    <?php } else {?>
    <link rel="shortcut icon" href="<?=URLHelper::getResource('resource/backend/images/icon.png')?>">
    <?php } ?>
    <!-- ICON END-->
    
    <!-- FONT ICON -->
    <link href="<?=URLHelper::getResource('resource/backend/css/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
<!--    <link href="--><?//=URLHelper::getResource('resource/backend/css/font-awesome-all/css/fontawesome-all.min.css')?><!--" rel="stylesheet" type="text/css">-->
    <!-- FONT ICON END-->

    <!-- JQUERY GROUP -->
  	<!-- jquery -->
	<script src="<?=URLHelper::getResource('resource/backend/js/jquery.min.js')?>" type="text/javascript"></script>
    <!-- jquery-ui -->
    <script src="<?=URLHelper::getResource('resource/backend/js/jquery-ui.min.js')?>" type="text/javascript"></script>
    <link href="<?=URLHelper::getResource('resource/backend/js/jquery-ui.min.css')?>" rel="stylesheet" type="text/css">
    <!-- JQUERY GROUP END -->
	
	<!-- BOOTSTRAP GROUP -->
	<!-- bootstrap -->
	<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
	<link href="<?=URLHelper::getResource('resource/backend/js/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
	<!-- datepicker -->
	<script type="text/javascript" src="<?=URLHelper::getResource('resource/backend/js/bootstrap-datepicker/js/bootstrap-datepicker.js')?>"></script>
	<link rel="stylesheet" type="text/css" href="<?=URLHelper::getResource('resource/backend/js/bootstrap-datepicker/css/datepicker.css')?>"/>
	<!-- toastr -->
	<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-toastr/toastr.min.js')?>" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?=URLHelper::getResource('resource/backend/js/bootstrap-toastr/toastr.min.css')?>"/>
	<!-- fileinput -->
	<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-fileinput/js/fileinput.js')?>" type="text/javascript"></script>
	<link href="<?=URLHelper::getResource('resource/backend/js/bootstrap-fileinput/css/fileinput.css')?>" rel="stylesheet" type="text/css"/>
	<!-- BOOTSTRAP GROUP END -->

    <link href="<?=URLHelper::getResource('resource/backend/css/layout.min.css')?>" rel="stylesheet" type="text/css">

    <!-- FANCYBOX2 GROUP  -->
	<script src="<?=URLHelper::getResource('resource/backend/js/fancy_box_2/source/jquery.fancybox.js')?>" type="text/javascript"></script>
	<link href="<?=URLHelper::getResource('resource/backend/js/fancy_box_2/source/jquery.fancybox.css')?>" rel="stylesheet" type="text/css"/>
	<!-- FANCYBOX2 GROUP END -->

    <!-- THEME STYLES BEGIN -->
    <link href="<?=URLHelper::getResource('resource/backend/css/components.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=URLHelper::getResource('resource/backend/css/default.css')?>" rel="stylesheet" type="text/css">
    <!-- THEME STYLES END -->
	<!-- auto_numeric -->
    <script type="text/javascript" src="<?=URLHelper::getResource('resource/backend/js/auto_numeric/autoNumeric.js')?>"></script>

	<!-- ckeditor -->
	<script type="text/javascript" src="<?=URLHelper::getResource('resource/backend/js/ckeditor/ckeditor.js')?>"></script>
	<script type="text/javascript" src="<?=URLHelper::getResource('resource/backend/js/ckeditor/adapters/jquery.js')?>"></script>

    <!-- modal -->
    <script src="<?=URLHelper::getResource('resource/backend/js/jquery.blockui.min.js')?>" type="text/javascript"></script>
    <link href="<?=URLHelper::getResource('resource/backend/js/bootstrap-modal/css/bootstrap-modal-bs3patch.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=URLHelper::getResource('resource/backend/js/bootstrap-modal/css/bootstrap-modal.css')?>" rel="stylesheet" type="text/css"/>
    <script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-modal/js/bootstrap-modalmanager.js')?>" type="text/javascript"></script>
    <script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-modal/js/bootstrap-modal.js')?>" type="text/javascript"></script>
    <script src="<?=URLHelper::getResource('resource/backend/js/modal.js')?>" type="text/javascript"></script>
    <link href="<?=URLHelper::getResource('resource/backend/js/modal.css')?>" rel="stylesheet" type="text/css">

	<!-- shop plugin -->
	<link href="<?=URLHelper::getResource('resource/backend/js/chosen/chosen.css')?>" rel="stylesheet" type="text/css">
	<script src="<?=URLHelper::getResource('resource/backend/js/chosen/chosen.jquery.min.js')?>" type="text/javascript"></script>
	<link href="<?=URLHelper::getResource('resource/backend/js/wickedpicker/stylesheets/wickedpicker.css')?>" rel="stylesheet" type="text/css">
	<script src="<?=URLHelper::getResource('resource/backend/js/wickedpicker/src/wickedpicker.js')?>" type="text/javascript"></script>
	<!-- shop plugin end-->

	<!-- MY STYLE -->
	<link href="<?=URLHelper::getResource('resource/backend/css/my_style.css')?>" rel="stylesheet" type="text/css"/>
	<?php include BASE_PATH . '/resource/backend/js/common.js.php' ?>
	<!-- MY STYLE END-->