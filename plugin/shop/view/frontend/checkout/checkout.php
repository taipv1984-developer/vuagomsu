<?php 
	//get data
	$cityList = $_REQUEST['cityList'];
	$customerInfo = $_REQUEST['customerInfo'];
    $customerAddressList = $_REQUEST['customerAddressList'];
    $cartInfo = $_REQUEST['cartInfo'];
?>

<div class="row">
	<!-- form -->
	<div class="col-md-6 col-sm-6">
        <?php if(!Session::isCustomerLogin()){?>
        <!-- login -->
        <div class="login-group">
            <a class="btn btn-primary btn-block" href="javascript:login()">
                Đăng nhập
            </a>
            <h5>
                <i class="glyphicon glyphicon-flash"></i>
                Để mua hàng nhanh hơn
            </h5>
            <h5>
                <i class="glyphicon glyphicon-flash"></i>
                Đăng nhập 1 lần cho tất cả dịch vụ
            </h5>
        </div>
        <div class="clear margin-bottom-10"></div>
        <?php } ?>

		<form method="post" action="" class="checkout-form" enctype="multipart/form-data">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="no-margin">Thông tin mua hàng</h3>
				</div>
				<div class="panel-body">
					<div class="list-group list-group-sm">
						<div class="list-group-item">
							<input type="text" class="form-control no-border" placeholder="Nhập họ và tên *" required="required"
								name="fisrtName" value="<?=trim($customerInfo->firstName .' '. $customerInfo->lastName)?>">
						</div>
						<div class="list-group-item">
							<input type="tel" class="form-control no-border" placeholder="Nhập số điện thoại *" required="required"
								name="phone" value="<?=$customerInfo->phone?>">
						</div>
                        <div class="list-group-item">
                            <input type="email" class="form-control no-border" placeholder="Nhập email *" required="required"
                                   name="email" value="<?=$customerInfo->email?>">
                        </div>
						<div class="list-group-item">
                            <select name="customerAddressId" class="form-control no-border customerAddressId <?= (!empty($customerAddressList)) ? '' : 'hide'?>">
                                <?php foreach ($customerAddressList as $v){?>
                                <option value="<?=$v->customerAddressId?>">
                                    <?=$v->address?>
                                </option>
                                <?php }?>
                                <option value="0">
                                    Nhập 1 địa chỉ khác
                                </option>
                            </select>
							<input type="text" class="form-control no-border customerAddress <?= (empty($customerAddressList)) ? '' : 'hide'?>"
                                   placeholder="Nhập địa chỉ" name="address" value="">
						</div>
                        <div class="list-group-item">
                            <select name="cityId" class="form-control no-border">
                                <?php
                                foreach ($cityList as $k => $v){
                                    if($k != ''){
                                ?>
                                        <option value="<?=$k?>"><?=$v?></option>
                                <?php
                                    }
                                }
                                ?>
                                <option value="0">Khác</option>
                            </select>
                        </div>
						<div class="list-group-item">
							<textarea name="note" class="form-control no-border" rows="2" cols="2" placeholder="Nhập ghi chú"></textarea>
						</div>
					</div>
					<button class="btn btn-danger right" type="submit"
                        <?= ($cartInfo['totalItem'] > 0) ? '' : 'disabled="disabled"' ?>>
					    Gửi đơn hàng
					</button>
                    <a class="btn btn-info left" onclick="goBackFromCheckout()">
                        Tiếp tục mua hàng
                    </a>
				</div>
			</div>
		</form>
	</div>
	 
	<!-- checkout_info -->
	<div class="col-md-6 col-sm-6">
		<div class="checkout_info">
			<?=Registry::getSetting('checkout_info')?>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
       $('.customerAddressId').change(function(){
           var val = $(this).val();
           $('.customerAddress').addClass('hide');
           $('.customerAddress').removeClass('validate_error');
           if(val == 0){
               $('.customerAddress').removeClass('hide');
               $('.customerAddress').focus();
           }
       });
    });
</script>

<!-- validate ajax form -->
<script type="text/javascript">
    $(document).ready(function() {
        //$('.submit').click(function(){
        $("form").submit(function(event){		//required
            var validate = true;
            var address = $('input[name="address"]').val();
            var customerAddressId = $('select[name="customerAddressId"]').val();

            if(customerAddressId == 0 & address == ''){
                validate = false;
            }
            if(!validate){
                show_notice_error('Bạn chưa nhập địa chỉ');
                $('.customerAddress').addClass('validate_error');
                $('.customerAddress').focus();
                event.preventDefault();	//required
            }
        })
    });
</script>

<script type="text/javascript">
    function goBackFromCheckout() {
        window.history.go(-2);
    }
</script>