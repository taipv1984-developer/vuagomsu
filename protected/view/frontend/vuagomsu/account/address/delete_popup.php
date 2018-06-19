<?php
    //get data
    $customerAddressVo = $_REQUEST['customerAddressVo'];
?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
	<h4 class="modal-title">
		Xóa địa chỉ
	</h4>
</div>
<div class="modal-body">
	<form id="modal_dialog_form" ufid="<?=uniqid()?>" method="post" class="form-horizontal">
		<div class="form-body">
			Bạn muốn xóa địa chỉ<br>
            <b><?=$customerAddressVo->address?></b>
            <input type="hidden" name="customerAddressId" value="<?=$customerAddressVo->customerAddressId?>">
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" id="btnAction" class="btn btn-primary blue margin-top-5 margin-bottom-5 ">Xóa</button>
	<button type="button" data-dismiss="modal" class="btn btn-primary blue margin-top-5 margin-bottom-5 ">Bỏ qua</button>
</div>