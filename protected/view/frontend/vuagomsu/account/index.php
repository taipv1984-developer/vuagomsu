<!-- modal -->
<script src="<?=URLHelper::getResource('resource/backend/js/jquery.blockui.min.js')?>" type="text/javascript"></script>
<link href="<?=URLHelper::getResource('resource/backend/js/bootstrap-modal/css/bootstrap-modal-bs3patch.css')?>" rel="stylesheet" type="text/css"/>
<link href="<?=URLHelper::getResource('resource/backend/js/bootstrap-modal/css/bootstrap-modal.css')?>" rel="stylesheet" type="text/css"/>
<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-modal/js/bootstrap-modalmanager.js')?>" type="text/javascript"></script>
<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-modal/js/bootstrap-modal.js')?>" type="text/javascript"></script>
<script src="<?=URLHelper::getResource('resource/backend/js/modal.js')?>" type="text/javascript"></script>
<link href="<?=URLHelper::getResource('resource/backend/js/modal.css')?>" rel="stylesheet" type="text/css">
<link href="<?=URLHelper::getResource('resource/backend/css/plugins.css')?>" rel="stylesheet" type="text/css">
<?php 
$isStatic = true;
$size = 800;
$extraClass = '';
$staticStr = !isset($isStatic) || $isStatic == true ? "data-backdrop='static' data-keyboard='false'" : "";
$id = 'modal_dialog';
$isMobile = Session::getSession('isMobile');
?>
<div class="modal draggable-modal modal-overflow" <?php echo ! empty ( $id ) ? "id='$id'" : ""; ?> 
tabindex="-1" role="basic" aria-hidden="true" 
style="display: none;" <?=isset($size) && !empty($size)? "data-width='$size'" : ""?> <?=$staticStr?>></div>

<div class="page-title">
    <h1 class="title-head">Thông tin tài khoản</h1>
</div>
<p><i>Xin chào, <?=Session::getCustomerName()?></i></p>

<div class="row">
    <div class="col-md-9 col-xs-12" id="account_info">
        <?php TemplateHelper::getTemplate('account/account_info.php'); ?>
        <div class="clear margin-bottom-10"></div>
    </div>
    <div class="col-md-3 col-xs-12">
        <?php TemplateHelper::getTemplate('account/common/account_navigation.php'); ?>
        <div class="clear margin-bottom-10"></div>
    </div>
</div>

<!-- check new_password and confirm_password pre submit form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var new_password = $('input[name="new_password"]').val().trim();
			var confirm_password = $('input[name="confirm_password"]').val().trim();
			if(new_password != '' || confirm_password != ''){
				if(new_password != confirm_password){
					event.preventDefault();	//required

					show_notice_error('Password not match. Please check again');
				}
			}
		});
	});
</script>

<script type="text/javascript">
	function customerAddressAddView(customerId){
		simpleCUDModal(
			"#modal_dialog",
			"#modal_dialog_form",
			guid(),
			"#btnAction",
			"<?=URLHelper::getUrl("home/customer/address/add/view&rtype=json")?>",
			"<?=URLHelper::getUrl("home/customer/address/add&rtype=json")?>",
            customerAddressRefresh
		);
	};

    function customerAddressEditView(customerAddressId){
        simpleCUDModal(
            "#modal_dialog",
            "#modal_dialog_form",
            guid(),
            "#btnAction",
            "<?=URLHelper::getUrl("home/customer/address/edit/view&rtype=json")?>" + `&customerAddressId=${customerAddressId}`,
            "<?=URLHelper::getUrl("home/customer/address/edit&rtype=json")?>",
            customerAddressRefresh
        );
    };

    function customerAddressDeleteView(customerAddressId){
        simpleCUDModal(
            "#modal_dialog",
            "#modal_dialog_form",
            guid(),
            "#btnAction",
            "<?=URLHelper::getUrl("home/customer/address/delete/view&rtype=json")?>" + `&customerAddressId=${customerAddressId}`,
            "<?=URLHelper::getUrl("home/customer/address/delete&rtype=json")?>",
            customerAddressRefresh
        );
    };
</script>

<!-- customerAddressRefresh -->
<script type="text/javascript">
    function customerAddressRefresh(dialogId,btnId,res){
        var data = [];
        $.post("<?=URLHelper::getUrl("home/customer/address/refresh&rtype=json")?>", data, function(res) {
            if (res.errorCode == "SUCCESS") {
                //update content
                $("#account_info").html(res.content);
                //show message
                show_notice(res.message);
                //close dialog
                $(dialogId).html("");
                $(dialogId).modal("toggle");
            } else {
                alert(res.message);
            }
        }).fail(function() {
            alert("System error.");
        });
    }
</script>