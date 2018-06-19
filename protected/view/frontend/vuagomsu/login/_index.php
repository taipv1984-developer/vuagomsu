<?php 
	include_once LIBRARY_PATH.'googleapi/gpConfig.php';
	include_once LIBRARY_PATH.'facebookapi/fbConfig.php';
	
	$authUrl = $gClient->createAuthUrl();
//	$loginFbURL = $facebook->getLoginUrl(array('redirect_uri'=>$redirectURL,'scope'=>$fbPermissions));
?>

<section id="signIn" class="form-sign ng-scope">
	<div class="container w-xxl w-auto-xs ng-scope">
		<div class="m-b-lg">
			<div class="wrapper text-center">
				<h3 class="no-top-margin">Đăng nhập</h3>
			</div>
			<form action="" method="post" name="form" class="form-validation ng-invalid ng-dirty ng-invalid-email ng-valid-parse ng-valid-required">
				<div class="list-group list-group-sm">
					<div class="list-group-item">
						<input type="email" placeholder="Nhập Email" name="username"
							value="<?php //echo (isset($_REQUEST['email'])) ? $_REQUEST['email'] : ''?>"
							class="form-control no-border ng-invalid ng-not-empty ng-dirty ng-invalid-email ng-valid-required ng-touched" required="required">
					</div>
					<div class="list-group-item">
						<input type="password" placeholder="Nhập mật khẩu" name="password" value=""
							class="form-control no-border ng-untouched ng-not-empty ng-dirty ng-valid-parse ng-valid ng-valid-required" required="required">
					</div>
				</div>
				
				<button type="submit" class="btn btn-lg btn-primary btn-block">
					Đăng nhập
				</button>
				
				<div class="text-center m-t m-b">
					<span>Bạn quên mật khẩu?</span> 
					<a href="<?php echo URLHelper::getUrl('home/forget_password')?>" class="popup50">
						Lấy lại mật khẩu
					</a>
				</div>
				<div class="line line-dashed"></div>
				
				<p class="text-center"><small>Bạn chưa có tài khoản?</small></p>
				<a class="btn btn-lg btn-default btn-block" href="<?php echo URLHelper::getUrl('home/register')?>">Đăng ký tài khoản</a>
				<div class="line line-dashed"></div>

                <div class="hide">
                    <p class="text-center"><small>Hoặc đăng nhập</small></p>
                    <p id="social-buttons" class="text-center">
                        <a href="<?=URLHelper::getUrl('home/facebook/login')?>" class="btn btn-rounded btn-sm btn-info">
                            <i class="fa fa-fw fa-facebook"></i>
                            Facebook
                        </a>
                        <a href="<?php echo filter_var($authUrl, FILTER_SANITIZE_URL)?>" class="btn btn-rounded btn-sm btn-danger">
                            <i class="fa fa-fw fa-google-plus"></i>
                            Google+
                        </a>
                    </p>
                </div>
			</form>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$('input[name="username"]').focus();
	});
</script>