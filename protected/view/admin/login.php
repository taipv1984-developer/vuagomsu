<!-- recaptcha -->
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>

<!-- BEGIN LOGO -->
<div class="logo">
</div>
<!-- END LOGO -->

<div class="content">
	<form class="login-form" action="" method="post">
		<h2><?=e('Administrator')?></h2>
	    <h3 class="form-title"><?=e('Login to your account')?></h3>
	    <div class="alert alert-danger display-hide">
	        <button class="close" data-close="alert"></button>
			<span><?=e('Enter username and password')?></span>
	    </div>
	    <?php
		    TemplateHelper::getTemplate('common/input/text.php',array(
		    	'placeholder' => 'Username',
		    	'name' => 'adminModel.username',
		    	'required' => true,
		    	'class' => 'login_input'
		    ));
		    TemplateHelper::getTemplate('common/input/password.php',array(
			    'placeholder' => 'Password',
			    'name' => 'adminModel.password',
			    'required' => true,
			    'class' => 'login_input'
		    ));
	    ?>
	    
	    <!-- recaptcha -->
<!--        <div class="g-recaptcha" data-sitekey="6LcNlT8UAAAAAC6QTvKr8M2aSERESKO45hA2IQkr"></div>-->
<!--	    <div class="margin-bottom-5"></div>-->
	    
	    <div class="form-actions">
		    	<input class='checkbox' type="checkbox" name="remember" id="remember" value="1" checked="checked"/> 
		        <label for="remember"><?=e('Remember me')?> </label>
	        <button type="submit" class="btn  btn-success pull-right">
	            <?=e('Login')?>
	            <i class="m-icon-swapright m-icon-white"></i>
	        </button>
	    </div>
	    <div class="forget-password hide">
	        <h4><?=e('Forgot your password ?')?></h4>
	        <p>
	        	<a href='index.php?r=admin/forget_password' class='blue'>
	        		<?=e('click here ')?>
	        	</a>
	        	<?=e('to reset your password')?>
	        </p>
	    </div>
	</form>
</div>