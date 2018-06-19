<?php
	TemplateHelper::getTemplate('common/input/textarea.php', array(
		'value' => Registry::getSetting('custom_css'),
		'class' => 'height_300',
		'name' => 'custom_css'
	));