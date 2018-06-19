<?php 
	$customerInfo = $_REQUEST['customerInfo'];
	$customerDetailInfo = $_REQUEST['customerDetailInfo'];
	$customer_support_username = Registry::getSetting('customer_support_username');
	$customerAddressList = $_REQUEST['customerAddressList'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if(!isset($_REQUEST['customerId'])){
				$toolbar->addTitle('add', e('Add customer'));
			}
			else{
				$toolbar->addTitle('edit', e('Edit customer'));
			}
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
		?>
		<div class="portlet-body">
            <?php
            //default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
            //add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
            if(!isset($_REQUEST['customerId'])){	//add
                if($customer_support_username){
                    $settingForm = array(
                        'username'	=> array('required' => true),
                        'email'		=> array('type' => 'email', 'required' => true),
                        'password'	=> array('type' => 'password', 'required' => true),
                        'confirm_password'	=> array('type' => 'password', 'required' => true),
                    );
                }
                else{
                    $settingForm = array(
                        'email'		=> array('type' => 'email', 'required' => true),
                        'password'	=> array('type' => 'password', 'required' => true),
                        'confirm_password'	=> array('type' => 'password', 'required' => true),
                    );
                }

            }
            else{	//edit
                if($customer_support_username){
                    $settingForm = array(
                        'username'	=> array('readonly' => true, 'value' => $customerInfo->username),
                        'email'		=> array('type' => 'email', 'readonly' => true, 'value' => $customerInfo->email),
                        'current_password'	=> array('type' => 'password', 'value' => ''),
                        'new_password'		=> array('type' => 'password', 'value' => ''),
                        'confirm_password'	=> array('type' => 'password', 'value' => ''),
                    );
                }
                else{
                    $settingForm = array(
                        'email'		=> array('type' => 'email', 'readonly' => true, 'value' => $customerInfo->email),
                        'current_password'	=> array('type' => 'password', 'value' => ''),
                        'new_password'		=> array('type' => 'password', 'value' => ''),
                        'confirm_password'	=> array('type' => 'password', 'value' => ''),
                    );
                }
            }

            $settingForm += array(
                'first_name'		=> array('value' => $customerDetailInfo->firstName, 'label' => 'Họ'),
                'last_name'		=> array('value' => $customerDetailInfo->lastName, 'label' => 'Tên'),
                'phone'		=> array('value' => $customerDetailInfo->phone),
            );
            //render setting from
            TemplateHelper::renderForm($settingForm);
            ?>

            <div class="my_row ">
                <label class="col-md-2 my_tooltip">Địa chỉ</label>
                <div class="row_value col-md-10">
                    <ul class="simple-list">
                        <?php foreach ($customerAddressList as $v){?>
                            <li>
                                <?=$v->address?>
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </div>

            <?php
            $settingForm = array(
//                'birthday'	=> array('value' => $customerDetailInfo->birthday, 'attr' => array('disabled' => 'disabled')),
// 						'gender'	=> array('type' => 'select', 'value' => $customerDetailInfo->gender, 'options' => ArrayHelper::getGender()),
                'status'	=> array('type' => 'select', 'value' => $customerInfo->status, 'options' => ArrayHelper::getAD(), ),
//                'receive_email'	=> array('type' => 'select', 'value' => $customerDetailInfo->receiveEmail, 'options' => ArrayHelper::get10(), ),
                'image'		=> array('type' => 'file', 'value'=> $customerDetailInfo->image, 'action' => true),
            );

            //render setting from
            TemplateHelper::renderForm($settingForm);
            ?>
		</div>
	</div>
</form>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var username = $('input[name="username"]').val();
			var email = $('input[name="email"]').val();
			var customerId = '<?=$customerInfo->customerId?>';

			//password
			<?php if(!isset($_REQUEST['customerId'])){ //add?>
				var action = 'add';
				var password = $('input[name="password"]').val();
				var confirm_password = $('input[name="confirm_password"]').val();
				var data = {'action': action, 'username': username, 'email': email, 'customerId': customerId,
						'password': password, 'confirm_password': confirm_password};
			<?php } else { //edit?>
				var action = 'edit';
				var current_password = $('input[name="current_password"]').val();
				var new_password = $('input[name="new_password"]').val();
				var confirm_password = $('input[name="confirm_password"]').val();
				var data = {'action': action, 'username': username, 'email': email, 'customerId': customerId,
						'current_password': current_password, 'new_password': new_password, 'confirm_password': confirm_password};
			<?php }?>
			
			$.ajax({
				type : 'post',
				url : "index.php?r=admin/customer/validate_ajax",
				data: data,
				async : false,
				complete : function(){
			    },
				success : function(data){
					if(data){	//validate message
						data = JSON.parse(data);
						console.log(data);
						
						//reset validate
						$('.input').removeClass('validate_error');
						$('.input').parent().find('.validate_message').html('');
						
						for(name in data){
							var message = data[name];
							$('.input[name="' +name+ '"]').addClass('validate_error');
							$('.input[name="' +name+ '"]').parent().find('.validate_message').html(message);
						}
			 			event.preventDefault();	//required

			 			//notice error
			 			show_notice_error('Nhập dữ liệu không đúng, vui lòng kiểm tra lại');
					}
			   }
		   	});
		});
	});
</script>