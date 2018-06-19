<div class="col-md-12">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addTitle('manage', e('File Manager'));
			$toolbar->showToolBar();
		?>
		<div class="portlet-body">
			<iframe style='width: 100%; border: none; height: 666px;' 
    			src="resource/backend/js/filemanager/dialog.php?type=0&akey=<?=Session::getSession('filemanager_access_key')?>">
    		</iframe>
		</div>
	</div>
</div>