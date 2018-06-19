<?php 
//	include_once LIBRARY_PATH.'googleapi/gpConfig.php';
//	include_once LIBRARY_PATH.'facebookapi/fbConfig.php';
	
//	$authUrl = $gClient->createAuthUrl();
//	$loginFbURL = $facebook->getLoginUrl(array('redirect_uri'=>$redirectURL,'scope'=>$fbPermissions));

//    $facebookLoginData = $_SESSION['facebookLoginData'];
?>

<?php
//get data
$baseUrl = URLHelper::getBaseUrl();
$templateName = Registry::getTemplate('templateName');
?>
<!-- datepicker -->
<script src="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<link href="<?php echo "$baseUrl/resource/frontend/$templateName"?>/js/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>


<h1 class="title-head">
    Đăng ký tài khoản
</h1>

<form action="" method="post" name="form" id="registerForm">
    <div id="login">
        <span>Nếu chưa có tài khoản vui lòng đăng ký tại đây</span>
        <div class="form-signup clearfix">
            
            <div class="row">
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label>Họ: </label>
                        <input name="firstName" value="<?=$_REQUEST['firstName']?>"
                               placeholder="Họ" class="input form-control" required="required">
                        <div class="validate_message"></div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label>Tên: </label>
                        <input name="lastName"  value="<?=$_REQUEST['lastName']?>"
                               placeholder="Tên" class="input form-control">
                        <div class="validate_message"></div>
                    </fieldset>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label>Email: </label>
                        <input type="email" name="email"  value="<?=$_REQUEST['email']?>"
                               placeholder="Email" class="input form-control" required="required">
                        <div class="validate_message"></div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label>Số điện thoại: </label>
                        <input type="number" name="phone"  value="<?=$_REQUEST['phone']?>"
                               placeholder="Số điện thoại" class="input form-control">
                        <div class="validate_message"></div>
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label>Mật khẩu: </label>
                        <input type="password" name="password"
                               placeholder="Nhập mật khẩu" class="input form-control" required="required">
                        <div class="validate_message"></div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label>Nhập lại mật khẩu: </label>
                        <input type="password" name="confirmPassword"
                               placeholder="Nhập lại mật khẩu" class="input form-control" required="required">
                        <div class="validate_message"></div>
                    </fieldset>
                </div>
            </div>

            <div class="col-xs-12 text-xs-left" style="margin-top:30px; padding: 0">
                <button type="summit" value="Đăng ký" class="btn btn-lg btn-style btn-dark">Đăng ký</button>
            </div>

            <div class="hide">
                <p class="text-center">
                    <small>Hoặc đăng nhập</small>
                </p>
                <p id="social-buttons" class="text-center">
                    <a href="<?=URLHelper::getUrl('home/facebook/login')?>" class="btn btn-rounded btn-sm btn-info">
                        <i class="fa fa-fw fa-facebook"></i>
                        Facebook
                    </a>
                    <a href="<?=filter_var($authUrl, FILTER_SANITIZE_URL)?>" class="btn btn-rounded btn-sm btn-danger">
                        <i class="fa fa-fw fa-google-plus">
                        </i> Google+
                    </a>
                </p>
            </div>
        </div>
    </div>
</form>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var email = $('input[name="email"]').val();
			var password = $('input[name="password"]').val();
			var confirmPassword = $('input[name="confirmPassword"]').val();
			var birthday = $('input[name="birthday"]').val()
            var data = {'email': email, 'password': password, 'confirmPassword': confirmPassword, 'birthday': birthday};

			$.ajax({
				type : 'post',
				url : "<?=URLHelper::getUrl('home/register/validate')?>",
				data: data,
				async : false,
				complete : function(){
			    },
				success : function(data){
					if(data){	//validate message
						data = JSON.parse(data);
						console.log(data);
						
						//reset validate
						$('.input').removeClass('validate_error');
						$('.input').parent().find('.validate_message').html('');
						
						for(name in data){
							var message = data[name];
							$('.input[name="' +name+ '"]').addClass('validate_error');
							$('.input[name="' +name+ '"]').parent().find('.validate_message').html(message);
						}
			 			event.preventDefault();	//required

			 			//notice error
			 			show_notice_error('Nhập dữ liệu không đúng, vui lòng kiểm tra lại');
					}
			   }
		   	});
		});
	});
</script>