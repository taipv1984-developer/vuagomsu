<div class="page-header-top">
	<div class="container">
		<div class="page-logo">
		    <a href="<?=URLHelper::getBaseUrl()?>">
		    	<img src="<?=Registry::getSetting('logo')?>"
                     title="<?=Registry::getSetting('site_name')?>" alt="<?=Registry::getSetting('site_name')?>"
                     class="logo_image">
		    </a>
		</div>
		<a href="javascript:void();" class="menu-toggler"></a>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- setting -->
				<?php 
					if(Session::havePermission('admin/setting/manage')){
						TemplateHelper::getTemplate('common/header/component/settings.php');
				?>
				<li class="droddown dropdown-separator">
				    <span class="separator"></span>
				</li>
				<?php } ?>
				
				<!-- language -->
				<?php 
					if(Session::havePermission('admin/language/manage')){
						//get adminCountryCode
                        $adminCountryCode = $_SESSION[SESSION_GROUP]['admin_countryCode'];
				?>
				<li class="dropdown dropdown-dark">
					<a class="dropdown-toggle" href="<?=URLHelper::getUrl('admin/language/manage')?>" title='<?=e('Language manage')?>'>
				        <img alt="<?=e('Language manage')?>"
                             src="<?=URLHelper::getResource("resource/backend/images/flags/{$adminCountryCode}.png")?>"
                             title='<?=e('Default language')?>'>
				    </a>
			    </li>
				<li class="droddown dropdown-separator">
				    <span class="separator"></span>
				</li>
				<?php } ?>
				<?php TemplateHelper::getTemplate('common/header/component/login.php',array())?>
			</ul>
		</div>
	</div>
</div>
