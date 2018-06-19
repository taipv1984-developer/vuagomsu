<header id="header">
	<nav class="navbar navbar-default bottom-margin-15 ng-scope" id="checkoutHeader">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" 
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo URLHelper::getUrl('home')?>">
					<img src="<?php echo Registry::getSetting('logo')?>" 
						alt="<?php echo Registry::getSetting('site_name')?>"  title="<?php echo Registry::getSetting('site_name')?>">
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li <?php if($checkoutStep == 1) echo 'class="active"'?>>
						<a href="javascript:void(0)" style="line-height: 30px;">Bước 1: Đăng nhập</a>
					</li>
					<li <?php if($checkoutStep == 2) echo 'class="active"'?>>
						<a href="javascript:void(0)" style="line-height: 30px;">Bước 2: Địa chỉ</a>
					</li>
					<li <?php if($checkoutStep == 3) echo 'class="active"'?>>
						<a href="javascript:void(0)" style="line-height: 30px;">Bước 3: Thanh toán</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>