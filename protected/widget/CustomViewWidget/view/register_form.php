<div class="widget_content register_form">
	<div class="title col-md-12">
		<img src="upload/images/register_form_title.png" title="" alt="" class="register_form_title">
		<img src="upload/images/register_form_title_small.png" title="" alt="" class="register_form_title_small">
	</div>
	<form action="" method="post">
		<div class="col-md-6">
			<?php
				$settingForm = array(
					'name'		=> array('required' => 'Y', 'label' => 'Họ tên'),
					'phone'		=> array('required' => 'Y', 'label' => 'Số điện thoại'),
				);
				$settingAll = array(
					'rows' => 2
				);
				TemplateHelper::renderForm($settingForm, null, $settingAll);
			?>
		</div>
		<div class="col-md-6">
			<?php
				$settingForm = array(
					'email'		=> array('type' => 'email', 'label' => 'Mail'),
					'more_info'	=> array('label' => 'Mục đích luyện tập'),
                    'region'	=> array('type' => 'select', 'options' => ArrayHelper::getRegionList(),
                        'label' => 'Đăng ký tập tại cơ sở'),
				);
				$settingAll = array(
					'rows' => 2
				);
				TemplateHelper::renderForm($settingForm, null, $settingAll);
			?>
		</div>
		<div class="clear"></div>
		
		<div class="button_group">
			<button type="submit" class="button button_violet register_button" title="Hoàn tất đăng ký">Hoàn tất đăng ký</button>
			<div class="line line_violet"></div>
		</div>
	</form>
</div>

<script type="text/javascript">
 	$(document).ready(function (){
		$(".register_button").click(function (){
			$('body,html').animate({
				scrollTop: $(".register_form").offset().top
			}, 800, function(){
				$('input.name').focus();
			});
		});
	});
</script>