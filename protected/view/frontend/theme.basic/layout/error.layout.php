<!-- error.layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?=Registry::getSetting('site_name'). ' | ' . $errorMessage; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link rel="shortcut icon" href="resource/backend/images/icon.png">
    <link href="resource/backend/css/style_404.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<div class="wrap">
		<div class="content">
			<div class="logo">
				<h1>
					<a href="<?=Registry::getSetting('base_url')?>">
						<img src="resource/backend/images/404/logo.png"/>
					</a>
				</h1>
				<span>
					<img src="resource/backend/images/404/signal.png"/>
					<?=e('Oops! The Page you requested was not found!')?>
				</span>
			</div>
			<div class="buttom">
				<div class="seach_bar">
					<p>
		                <a href="index.php">
		                    <?=e('Return home')?>
		                </a>
		            </p>
				</div>
			</div>
		</div>
	<p class="copy_right">&#169; 2015-2018 <a href="<?=Registry::getSetting('base_url')?>"><?=Registry::getSetting('site_name')?></a></p>
	</div>
</body>
</html>