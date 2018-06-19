<?php  
	$productInfo = $_REQUEST['productInfo'];
	$productExtension = $_REQUEST['productExtension'];
?>

<div class="portlet-body">
	<?php
		//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
		//add option (class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
		$settingForm = array(
			'attribute'	=> array('name' => "productExtension[attribute]",
					'type' => 'textarea',  'class' => 'ckeditor_mini'),
            'help'	=> array('name' => "productExtension[help]", 'label' => 'Hướng dẫn sử dụng',
                'type' => 'textarea',  'class' => 'ckeditor_content'),
		);
		$settingValue = $productExtension;
		$settingAll = array();
		
		//render setting from
		TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
	?>
</div>