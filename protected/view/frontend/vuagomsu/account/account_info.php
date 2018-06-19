<?php
//get data
$baseUrl = URLHelper::getBaseUrl();
$templateName = Registry::getTemplate('templateName');
$customerInfo = $_REQUEST['customerInfo'];
$customerAddressList = $_REQUEST['customerAddressList'];
?>

<!-- datepicker -->
<script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>

<form action="" method="post" enctype="multipart/form-data">
    <!-- email -->
    <div class="form-group">
        <label><?=e('Email'); ?></label>
        <input type="email" name="email"  value="<?=$customerInfo->email?>"
               <?=($customerInfo->oauthId != '' & $customerInfo->email == '') ? '' : 'disabled="disabled"' ?>
               placeholder="<?=e('Email')?>" class="input form-control" required="required">
        <div class="validate_message"></div>
    </div>
    <!-- new_password -->
    <div class="form-group">
        <label><?=e('Password'); ?></label>
        <input type="password" name="new_password"  value=""
               placeholder="<?=e('Password')?>" class="input form-control">
        <div class="validate_message"></div>
    </div>
    <!-- confirm_password -->
    <div class="form-group">
        <label><?=e('Confirm Password'); ?></label>
        <input type="password" name="confirm_password"  value=""
               placeholder="<?=e('Confirm Password')?>" class="input form-control">
        <div class="validate_message"></div>
    </div>

    <div class="form-group">
        <label>Họ</label>
        <input type="text" name="firstName"  value="<?=$customerInfo->firstName?>" required="required"
               placeholder="Họ" class="input form-control">
        <div class="validate_message"></div>
    </div>
    <div class="form-group">
        <label>Tên</label>
        <input type="text" name="lastName"  value="<?=$customerInfo->lastName?>" required="required"
               placeholder="Tên" class="input form-control">
        <div class="validate_message"></div>
    </div>
    <div class="form-group">
        <label><?=e('Mobile Number'); ?></label>
        <input type="text" name="phone"  value="<?=$customerInfo->phone?>" required="required" placeholder="<?=e('Mobile Number')?>" class="input form-control">
        <div class="validate_message"></div>
    </div>

    <!-- customerAddressList -->
    <div class="form-group hide">
        <label><?=e('Address'); ?></label>
        <ul class="customerAddressList">
            <?php foreach ($customerAddressList as $v){?>
                <li>
                    <?=$v->address?>
                    <div class="customerAddressControl">
                        <a href="javascript:customerAddressEditView(<?=$v->customerAddressId?>)" class="fa fa-edit margin-right-10"></a>
                        <a href="javascript:customerAddressDeleteView(<?=$v->customerAddressId?>)" class="fa fa-trash hide"></a>
                    </div>
                </li>
            <?php }?>
        </ul>
        <div class="clear"></div>

        <a href="javascript:customerAddressAddView(<?=$customerInfo->customerId?>)" class="btn btn-dark hide">
            <i class="fa fa-plus"></i>
            Thêm địa chỉ
        </a>
    </div>

    <!-- birthday -->
    <div class="form-group hide">
        <label><?=e('Birthday'); ?></label>
        <div class="input-group date datepicker">
            <?php
            if($customerInfo->birthday != '' & $customerInfo->birthday != '0000-00-00'){
                $birthday = Date('d/m/Y', strtotime($customerInfo->birthday));
            }
            else{
                $birthday = '';
            }
            ?>
            <input type="text" name="birthday" required="required" value="<?=$birthday?>"
                   class="input form-control" placeholder="dd/mm/yyyy">
            <span class="input-group-btn">
                <button type="button" class="btn btn-default">
                    <i class="glyphicon glyphicon-calendar"></i>
                </button>
            </span>
            <div class="clear"></div>
            <div class="validate_message"></div>
        </div>
    </div>

    <!-- submit -->
    <div class="form-group margin-top-10">
        <button type="submit" class="btn btn-dark">
            <?=e('Update')?>
        </button>
    </div>
    </form>