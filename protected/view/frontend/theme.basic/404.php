<div class="page-404">
	<div class="page-404-image center">
		<img src="<?=URLHelper::getImagePath("upload/images/404.jpg")?>"
			title="<?php Registry::getSetting('site_name')?>" alt="<?php Registry::getSetting('site_name')?>">
	</div>

	<div class="page-404-info">
		<h3 class=page-404-title">
			<?=e("Oops!<br>The site does not exist")?>.
		</h3>
		<a class="btn btn-primary" href="<?=URLHelper::getBaseUrl()?>"
			title="<?php Registry::getSetting('site_name')?>">
			<i class="fa fa-arrow-left"></i>
			<?=e("Go to home")?>
		</a>
	</div>
</div>
