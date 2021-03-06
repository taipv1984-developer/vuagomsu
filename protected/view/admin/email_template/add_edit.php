<?php
	$emailTemplateInfo = $_REQUEST['emailTemplateInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if($emailTemplateInfo){
				$toolbar->addTitle('edit', e('Edit email template'));
			}
			else{
				$toolbar->addTitle('add', e('Add email template'));
			}
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
		?>
		
		<div class="panel panel-default">
			<div class="panel-body">
			<?php
				//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
				//add option (class, id, stype, styleRow, required, placeholder, attr, [options, code])
				$settingForm = array(
					'key'		=> array('attr' => array('disabled' => 'disabled')),
					'subject'	=> array('required' => true),
					'note'	=> array('type' => 'textarea'),
					'content'	=> array('type' => 'textarea', 'class' => 'ckeditor'),
				);
				$settingValue = $emailTemplateInfo;
				$settingAll = array(
					'cols' => '2-10',
					'model' => 'emailTemplateModel'
				);
				
				//render setting from
				TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
			?>
			</div>
		</div>  
	</div>
</form>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var url = "index.php?r=admin/email_template/validate_ajax";
			<?php if($emailTemplateInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var key = $('input[name="emailTemplateModel.key"]').val();
			var emailTemplateId = '<?=$emailTemplateInfo->emailTemplateId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'key': key, 'emailTemplateId': emailTemplateId},
				async : false,
				complete : function(){
			    },
				success : function(data){
					if(data){	//validate message
						data = JSON.parse(data);

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