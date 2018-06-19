<?php if($checkoutStep == 1){?>
<div id="checkOut">
	<div class="container">
		<div class="row">
			<article class="col-md-8 col-sm-7 content">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="no-margin">
							Đăng ký &amp; Đăng Nhập hoặc đặt hàng không cần Đăng ký
						</h3>
					</div>
					<div class="panel-body">
						<div class="signup-form">
							<h3 class="text-center">Đăng ký tài khoản</h3>
							<form action="" method="post" name="form" id="registerForm">
								<div class="list-group list-group-sm">
									<div class="list-group-item">
										<input name="name" value="<?php echo $_REQUEST['name']?>"
											placeholder="Họ và tên" class="input form-control no-border" required="required">
										<div class="validate_message"></div>
									</div>
									<div class="list-group-item">
										<input type="email" name="email"  value="<?php echo $_REQUEST['email']?>"
											placeholder="Email" class="input form-control no-border" required="required">
										<div class="validate_message"></div>
									</div>
									<div class="list-group-item">
										<input type="number" name="phone"  value="<?php echo $_REQUEST['phone']?>"
											placeholder="Số điện thoại" class="input form-control no-border">
										<div class="validate_message"></div>
									</div>
									<div class="list-group-item">
										<input type="password" name="password"
											placeholder="Nhập mật khẩu" class="input form-control no-border" required="required">
										<div class="validate_message"></div>
									</div>
									<div class="list-group-item">
										<input type="password" name="confirmPassword"
											placeholder="Nhập lại mật khẩu" class="input form-control no-border" required="required">
										<div class="validate_message"></div>
									</div>
								</div>
								
								<button type="submit" class="btn btn-lg btn-primary btn-block" name="submit_register">
									Đăng ký
								</button>
								<div class="line line-dashed"></div>
								
								<p class="text-center">
									<small>Hoặc đăng nhập</small>
								</p>
								<p id="social-buttons" class="text-center">
									<a href="https://facebook.com" class="btn btn-rounded btn-sm btn-info">
										<i class="fa fa-fw fa-facebook"></i>
										Facebook
									</a>
									<a href="https://plus.google.com" class="btn btn-rounded btn-sm btn-danger">
										<i class="fa fa-fw fa-google-plus">
										</i> Google+
									</a>
								</p>
							</form>
						</div>
					</div>
				</div>
			</article>
			
			<!-- cart_info -->
			<aside class="col-md-4 col-sm-5">
				<?php include '/../../common/cart/cart_info.php';?>
			</aside>
		</div>
	</div>
</div>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var email = $('input[name="email"]').val();
			var password = $('input[name="password"]').val();
			var confirmPassword = $('input[name="confirmPassword"]').val();
			var birthday = $('input[name="birthday"]').val();
			
			$.ajax({
				type : 'post',
				url : '<?php echo URLHelper::getUrl('home/register/validate')?>',
				data: {'email': email, 'password': password, 'confirmPassword': confirmPassword, 'birthday': birthday},
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
<?php }?>