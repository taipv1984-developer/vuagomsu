<?php 
	$message = SessionMessage::getSessionMessages();
	$messageError = (isset($message['error'])) ? $message['error'][0] : '';
	$messageSuccess = (isset($message['success'])) ? $message['success'][0] : '';
	
	$forget_password_status = Session::getSession('forget_password_status');	//1(first) 2(error) 3(ok)
?>

<div class="request_password_page">
	<?php if($forget_password_status == 1 || $forget_password_status == 2){?>
	<h3>Quên mật khẩu</h3>
	<div class="my_row message">Nhập địa chỉ email bạn đã đăng ký, chúng tôi sẽ giúp bạn lấy lại mật khẩu</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="my_row">
			<input type="email" name="email" class="input" required="required"
				placeholder="Email" maxlength="50" 
				value="<?php echo ($forget_password_status == 2) ? $_REQUEST['email'] : '' ?>">
		</div>
		<div class="my_row error_message f_error_message">
			<?php 
				if($forget_password_status != 1){
					echo $messageError;
				}
			?>
		</div>
		<div class="my_row">
			<button type="submit" class="btn btn-primary">
				Gửi
			</button>
		</div>
	</form>
	<?php } else{?>
	<div class="password_reset_page password_reset_modal">
		<h3>Gửi yều cầu thành công</h3>
		<p class="message">
			Để thiết lập lại mật khẩu của bạn, chỉ cần làm theo các hướng dẫn chúng tôi gửi qua email cho bạn.
		</p>
		<button type="button" class="btn btn-primary close_dialog_button">
			Đóng
		</button>
	</div>
	<script type="text/javascript">
		$('.close_dialog_button').click(function (){
			parent.jQuery.fancybox.close()
		});
	</script>
	<?php }?>
</div>