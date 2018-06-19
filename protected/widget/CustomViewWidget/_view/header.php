<div class="menu-bar hidden-md hidden-lg">
    <i class="fa fa-bars"></i>
</div>

<div class="header-main">
    <div class="col-sm-4">
        <div class="logo">
            <a href="<?=URLHelper::getUrl('home')?>" class="logo-wrapper" title="Logo">
                <img src="<?=Registry::getSetting('logo')?>"
                     title="<?=Registry::getSetting('site_name')?>" alt="<?=Registry::getSetting('site_name')?>"
                     class="logo_image">
            </a>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="bannerTop">
            <a href="<?=Registry::getSetting('header_image_link')?>" title="<?=Registry::getSetting('site_name')?>">
                <img src="<?=Registry::getSetting('header_image')?>"
                     title="<?=Registry::getSetting('site_name')?>" alt="<?=Registry::getSetting('site_name')?>">
            </a>
        </div>
    </div>
</div>