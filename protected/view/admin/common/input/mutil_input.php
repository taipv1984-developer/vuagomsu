<div class="mutil_input">
	<?php
		foreach ($params['controls'] as $v){
			$v['type'] = (isset($v['type']))? $v['type'] : "text";
			TemplateHelper::getTemplate("common/input/{$v['type']}.php", $v);
		}
	?>
</div>