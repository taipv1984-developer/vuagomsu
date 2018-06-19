<section id="signIn" class="form-sign ng-scope">
	<div class="container w-xxl w-auto-xs ng-scope">
		<a class="logo-brand block text-center" href="<?=URLHelper::getUrl('home')?>">
			<img src="<?=Registry::getSetting('logo')?>"
				title="<?=Registry::getSetting('site_name')?>" alt="<?=Registry::getSetting('site_name')?>">
		</a>
		<div class="m-b-lg">
			<div class="wrapper text-center">
				<h3 class="no-top-margin">Thiết lập lại mật khẩu</h3>
			</div>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="my_row">
					<input type="password" name="password" class="input" 
						autocomplete="off" placeholder="New Password" maxlength="25" required="required">
					<span class="error_message f_error_message"></span>
				</div>
				<div class="my_row">
					<input type="password" name="retype_password" class="input"	
						autocomplete="off" placeholder="Confirm Password" maxlength="25" required="required">
					<span class="error_message f_error_message"></span>
				</div>
				<div class="my_row">
					<button type="submit" class="btn btn-lg btn-primary btn-block reset_password_button">
						<?=e('Apply')?>
					</button>
				</div>
			</form>
		</div>
	</div>
</section>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var password = $('input[name="password"]').val().trim();
			var retype_password = $('input[name="retype_password"]').val().trim();
			if(password != retype_password){
				event.preventDefault();	//required

	 			//notice error
	 			$('.error_message').text('Password not match. Please check again').css('display', 'block');
			}
		});
	});
</script>