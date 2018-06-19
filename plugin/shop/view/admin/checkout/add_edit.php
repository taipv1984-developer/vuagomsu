<?php 
	//get data
	$checkoutId = $_REQUEST['checkoutId'];
	$pluginCode = $_REQUEST['pluginCode'];
	$checkoutInfo = $_REQUEST['checkoutInfo'];
	$checkoutType = $checkoutInfo->checkoutType;
	$checkoutCode = $checkoutInfo->checkoutCode;
	
	//get $viewPath
	$viewPath = "checkout/$checkoutType/$checkoutCode/$checkoutCode.php";
?>
<form class="form-horizontal form-row-seperated" action="" method="post">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if($checkoutId){
				$toolbar->addTitle('edit', e("Checkout %s edit [%s]", array($checkoutType, $checkoutCode)));
			}
			else{
				$toolbar->addTitle('add', e("Checkout %s add [%s]", array($checkoutType, $checkoutCode)));
			}
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
		?>
		<?php TemplateHelper::getTemplate('common/tabs.php', array(
			'1' => array(
				'id' => '1_1', 
				'name' => e('General'),
				'active' => true
			),
			'2' => array(
				'id' => '1_2', 
				'name' => e('Setting'),
				'active' => false
			),
	    ))
		?>
		<div class="portlet-body">
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1_1">
			   <?php 
					//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
					//add option(class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
		  			if($checkoutId){	//edit
						$settingForm = array(
							'checkout_type'		=> array('attr' => array('disabled' => 'disabled')),
							'checkout_code'		=> array('attr' => array('disabled' => 'disabled')),
							'checkout_name'		=> array('required' => true),
							'order'			=> array('label' => 'Sort order', 'type' => 'number'),
							'status'		=> array('type' => 'select', 
									'options' => ArrayHelper::getAD(), 'value' => $checkoutInfo->status),
						);
		  			}
		  			else{	//add
		  				$settingForm = array(
	  						'checkout_type'		=> array('required' => true),
	  						'checkout_code'		=> array('required' => true),
	  						'checkout_name'		=> array('required' => true),
	  						'order'			=> array('label' => 'Sort order', 'type' => 'number'),
	  						'status'		=> array('type' => 'select', 
	  								'options' => ArrayHelper::getAD(), 'value' => $checkoutInfo->status),
		  				);
		  			}
					
					$settingValue = $checkoutInfo;
					$settingAll = array(
						'model' => 'checkoutModel'
					);
					
					//render setting from
					TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
				?>
				</div>
	  			<div class="tab-pane" id="tab_1_2">
			    <?php
					$params = array(
						'checkoutInfo' => $checkoutInfo
					);
					TemplateHelper::getTemplate($viewPath, $params, $pluginCode);
				?>
	  			</div>
	 		</div>
		</div>
	</div>
</form>