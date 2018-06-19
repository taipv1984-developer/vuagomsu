<div class="page-404">
	<div class="page-404-image center">
		<img src="<?php echo URLHelper::getImagePath("upload/images/404.jpg")?>"
			title="<?php Registry::getSetting('site_name')?>" alt="<?php Registry::getSetting('site_name')?>">
	</div>

	<div class="page-404-info">
		<h3 class=page-404-title">
			<?php echo e("Oops!<br>The site does not exist")?>.
		</h3>
		<a class="btn btn-primary" href="<?php echo URLHelper::getBaseUrl()?>"
			title="<?php Registry::getSetting('site_name')?>">
			<i class="fa fa-arrow-left"></i>
			<?php echo e("Go to home")?>
		</a>
	</div>
</div>
