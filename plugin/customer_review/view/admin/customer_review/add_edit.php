<?php
	$customerReviewInfo = $_REQUEST['customerReviewInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if(!$_REQUEST['customerReviewId']){
				$toolbar->addTitle('add', e('Add customer review'));
			}
			else{
				$toolbar->addTitle('edit', e('Edit customer review'));
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
					'name'	=> array(),
					'career'	=> array('required' => false),
					'phone'	=> array('required' => false),
					'email'	=> array('type' => 'email', 'required' => false),
					'image'	=> array('type' => 'file', 'value' => $customerReviewInfo->image, 'action' => true, 'required' => false),
					'title'	=> array(),
					'content'	=> array('type' => 'textarea', 'class' => 'ckeditor_mini'),
					'crt_date'	=> array('label' => 'Create date', 'required' => false),
					'status'	=> array('type' => 'select', 'value' => $customerReviewInfo->status, 'options' => ArrayHelper::getAPD()),
				);
				$settingValue = $customerReviewInfo;
				$settingAll = array(
					'required' => true,
					'model' => 'customerReviewModel'
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
			var url = "index.php?r=admin/customer_review/validate_ajax";
			<?php if(!$_REQUEST['customerReviewId']){ ?>
			var action = 'add';
			<?php } else {?>
			var action = 'edit';
			<?php }?>
			var name = $('input[name="customerReviewModel.name"]').val();
			var customerReviewId = '<?php echo $customerReviewInfo->customerReviewId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'name': name, 'customerReviewId': customerReviewId},
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