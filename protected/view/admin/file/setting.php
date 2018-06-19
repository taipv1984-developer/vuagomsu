<?php 
	$fileSetting = $_REQUEST['fileSetting'];
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			$toolbar->addTitle('edit', e('Save'));
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
			$news = $_REQUEST['newsItem'];
		?>
		<div class="portlet-body">
			<div class="panel panel-default">
				<div class="panel-body">
				<?php 
					$settingForm = array(
						'option_resize'	   		=> array('type' => 'select', 'label' => 'Thumbnail create option',
								'options' => ArrayHelper::getOptionCreateThumbnail(), 'size' => 'medium'),
						'image_small_width'		=> array('type' => 'number', 'label' => 'Image <i>small</i> width(px)'),
						'image_small_height'	=> array('type' => 'number', 'label' => 'Image <i>small</i> height(px)'),
						'image_large_width'		=> array('type' => 'number', 'label' => 'Image <b>large</b> width(px)'),
						'image_large_height'	=> array('type' => 'number', 'label' => 'Image <b>large</b> height(px)'),
// 						'image_max_width'	=> array('type' => 'number', 'label' => 'Image MAX width(px)'),
// 						'image_max_height'	=> array('type' => 'number', 'label' => 'Image MAX height(px)'),
					);
					$settingValue = $fileSetting['thumbs'];
					$settingAll = array(
						'required' => true,
						'size' => 'small'
					);
					//render setting from
					TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
				?>
				</div>
			</div>
		</div>
	</div>
</form>
