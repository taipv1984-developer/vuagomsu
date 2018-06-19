<?php
    //get data
    $customerAddressVo = $_REQUEST['customerAddressVo'];
?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
	<h4 class="modal-title">
		Sửa địa chỉ
	</h4>
</div>
<div class="modal-body">
	<form id="modal_dialog_form" ufid="<?=uniqid()?>" method="post" class="form-horizontal">
		<div class="form-body">
            <div class="list-group-item">
                <label>Địa chỉ</label>
                <input type="text" name="address"  value="<?=$customerAddressVo->address?>" required="required"
                       placeholder="Địa chỉ" class="input form-control no-border">
                <div class="validate_message"></div>
                <input type="hidden" name="customerAddressId" value="<?=$customerAddressVo->customerAddressId?>">
            </div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" id="btnAction" class="btn btn-primary blue margin-top-5 margin-bottom-5 ">Sửa</button>
	<button type="button" data-dismiss="modal" class="btn btn-primary blue margin-top-5 margin-bottom-5 ">Bỏ qua</button>
</div>