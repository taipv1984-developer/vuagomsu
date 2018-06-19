<?php 
	$adminInfo = $_REQUEST['adminInfo'];
	$adminDetailInfo = $_REQUEST['adminDetailInfo'];
	$languageList = $_REQUEST['languageList'];
	
	//set active tab
	$admin_account_tab = Session::getSession('admin_account_tab');
?>

<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('edit', e('Edit admin account'));
		$toolbar->showToolBar();
	?>
	<?php TemplateHelper::getTemplate('common/tabs.php', array(
		'1' => array(
			'id' => '1_1', 
			'name' => e('Account information'),
			'active' =>($admin_account_tab == null || $admin_account_tab == 'account_information')? true :  false
		),
		'2' => array(
			'id' => '1_2', 
			'name' => e('Admin information'),
			'active' =>($admin_account_tab == 'admin_information')? true :  false
		),
    ))
	?>
	<div class="portlet-body">
		<div class="tab-content">
			<div class="tab-pane <?php if($admin_account_tab == null || $admin_account_tab == 'account_information')echo 'active' ?>" id="tab_1_1">
			   <form action="" method="post" enctype="multipart/form-data">
				<?php 
					//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
					//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
					$settingForm = array(
						'role_name'	=> array('readonly' => true, 'label' => 'Role'),
						'username'	=> array('readonly' => true),
						'email'		=> array('type' => 'email', 'readonly' => true),
						'current_password'		=> array('type' => 'password', 'value' => ''),
						'new_password'			=> array('type' => 'password', 'value' => ''),
						'confirm_new_password'	=> array('type' => 'password', 'value' => ''),
						'language_code'		=> array('type' => 'select', 'label' => 'Language',
								'options' => $languageList, 'options_map' => array('languageCode', 'name')),
						'status'		=> array('type' => 'label', 'title' => ArrayHelper::getAPD()[$adminInfo->status], 'class' => 'bold'),
						'submit'		=> array('type' => 'submit', 'title' => 'Update', 'label' => false, 'name' => 'submit_account_information'),
					);
					$settingValue = $adminInfo;
					$settingAll = array(
						'cols' => '3-9'
					);
					//render setting from
					TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
				?>
				</form> 
			</div>
			
			<div class="tab-pane <?php if($admin_account_tab == 'admin_information')echo 'active' ?>" id="tab_1_2">
			   <form action="" method="post" enctype="multipart/form-data">
				<?php 
				//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
				//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
				$settingForm = array(
					'name'		=> array(),
					'phone'			=> array(),
					'address'		=> array(),
					'gender'		=> array('type' => 'select', 'options' => ArrayHelper::getGender()),
					'image'			=> array('type' => 'file', 'value' => $adminDetailInfo->image, 'action' => true),
					'submit'		=> array('type' => 'submit', 'title' => 'Update', 'label' => false, 'name' => 'submit_admin_information'),
				);
				$settingValue = $adminDetailInfo;
				$settingAll = array(
					'model' => 'adminDetailModel',
					'cols' => '3-9'
				);
				//render setting from
				TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
				?>
				</form>
			</div>
		</div>
	</div>
</div>