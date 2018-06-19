<?php 
	$adminInfo = $_REQUEST['adminInfo'];
	$adminDetailInfo = $_REQUEST['adminDetailInfo'];
	$roleArray = $_REQUEST['roleArray'];
	$languageList = $_REQUEST['languageList'];
	
	//set active tab
	$admin_account_tab = Session::getSession('admin_account_tab');
?>

<form class="form-horizontal form-row-seperated" action="" method="post">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if($adminInfo){
				$toolbar->addTitle('edit', e('Edit admin'));
			}
			else{
				$toolbar->addTitle('add', e('Add admin'));
			}
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
		?>
		<?php TemplateHelper::getTemplate('common/tabs.php', array(
			'1' => array(
				'id' => '1_1', 
				'name' => e('Account information'),
				'active' => ($admin_account_tab == null || $admin_account_tab == 'account_information')? true : false
			),
			'2' => array(
				'id' => '1_2', 
				'name' => e('Admin information'),
				'active' => ($admin_account_tab == 'admin_information')? true : false
			),
	   	))
		?>
		<div class="portlet-body">
			<div class="tab-content">
				<div class="tab-pane <?php if($admin_account_tab == null || $admin_account_tab == 'account_information')echo 'active' ?>" id="tab_1_1">
				<?php 
					//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
					//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
					if(!isset($adminInfo->adminId)){	//add
						$settingForm = array(
							'role_id'	=> array('type' => 'select', 'options' => $roleArray, 'label' => 'Role'),
							'username'	=> array(),
							'email'		=> array('type' => 'email'),
							'password'		=> array(),
							'language_code'		=> array('type' => 'select', 'label' => 'Language',
									'options' => $languageList, 'options_map' => array('languageCode', 'name')),
							'status'		=> array('type' => 'select', 'options' => ArrayHelper::getAD()),
						);
						$settingValue = $adminInfo;
						$settingAll = array(
							'model' => 'adminModel',
							'required' => true,
							'cols' => '3-9'
						);
						//render setting from
						TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
					}
					else{	//edit
						$settingForm = array(
							'role_id'	=> array('type' => 'select', 'value' => $adminInfo->roleId, 'options' => $roleArray, 'label' => 'Role'),
							'username'	=> array('readonly' => true),
							'email'		=> array('type' => 'email', 'readonly' => true),
							'current_password'		=> array('type' => 'password', 'value' => ''),
							'new_password'			=> array('type' => 'password', 'value' => ''),
							'confirm_new_password'	=> array('type' => 'password', 'value' => ''),
							'language_code'		=> array('type' => 'select', 'label' => 'Language',
									'options' => $languageList, 'options_map' => array('languageCode', 'name')),
							'status'		=> array('type' => 'label', 'title' => ArrayHelper::getAPD()[$adminInfo->status], 'class' => 'bold'),
						);
						$settingValue = $adminInfo;
						$settingAll = array(
							'cols' => '3-9'
						);
						//render setting from
						TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
					}
				?>
				</div>
				
				<div class="tab-pane <?php if($admin_account_tab == 'admin_information')echo 'active' ?>" id="tab_1_2">
					<?php 
					//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
					//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
					if(!isset($adminInfo->adminId)){	//add
						echo e("Feature is disable, this enable in edit mode");
					}
					else {	//edit
						$settingForm = array(
							'name'		=> array(),
							'phone'			=> array(),
							'address'		=> array(),
							'gender'		=> array('type' => 'select', 'options' => ArrayHelper::getGender()),
							'image'			=> array('type' => 'file', 'value'=> $adminDetailInfo->image, 'action' => true),
						);
						$settingValue = $adminDetailInfo;
						$settingAll = array(
							'model' => 'adminDetailModel',
							'cols' => '3-9'
						);
						//render setting from
						TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
					}
					?>
				</div>
			</div>
		</div>
	</div>
</form>

<?php if(!isset($adminInfo->adminId)){	//add?>
<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var url = "index.php?r=admin/admin/validate_ajax";
			var action = 'add';
			var username = $('input[name="adminModel.username"]').val();
			var email = $('input[name="adminModel.email"]').val();
			var adminId = '<?=$adminInfo->adminId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'username': username, 'email': email, 'adminId': adminId},
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
<?php }?>