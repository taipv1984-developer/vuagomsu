<?php
	$contactInfo = $_REQUEST['contactInfo'];
	$trainerArray = $_REQUEST['trainerArray'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if($contactInfo){
				$toolbar->addTitle('edit', e('Edit Contact'));
			}
			else{
				$toolbar->addTitle('add', e('Add Contact'));
			}
			$toolbar->addButtonRight(array('btn_save.php'));
			$toolbar->showToolBar();
		?>
		
		<div class="panel panel-default">
			<div class="panel-body">
			<?php
				//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
				//add option (class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
				$settingForm = array(
					'trainer_id'	=> array('type' => 'select', 'value' => $contactInfo->trainerId, 'options' => array('' => '') + $trainerArray, 'label' => 'Trainer'),
					'name'	=> array('required' => 'Y'),
					'phone'	=> array('required' => 'Y'),
					'email'	=> array('type' => 'email'),
					'more_info'	=> array('type' => 'textarea', 'class' => 'ckeditor_mini'),
					'status'	=> array('type' => 'select', 'value' => $contactInfo->status, 'options' => ArrayHelper::getContactStatus()),
					'source'	=> array('type' => 'select', 'value' => $contactInfo->source, 'options' => ArrayHelper::getContactSource()),
                    'region'	=> array('type' => 'select', 'value' => $contactInfo->region, 'options' => ArrayHelper::getRegionList(), 'label' => 'Cơ sở'),
					'note'	=> array('type' => 'textarea', 'class' => 'ckeditor_mini'),
				);
				$settingValue = $contactInfo;
				$settingAll = array(
					'model' => 'contactModel'
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
			var url = "index.php?r=admin/contact/validate_ajax";
			<?php if($contactInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var name = $('input[name="contactModel.name"]').val();
			var phone = $('input[name="contactModel.phone"]').val();
			var contactId = '<?=$contactInfo->contactId?>';
			
			$.ajax({
				type : "post",
				url : url,
				data:{'action': action, 'name': name, 'phone': phone, 'contactId': contactId},
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
			 			show_notice_error('<?php echo e('Input data incorrect. Please check again')?>');
					}
			   }
		   	});
		});
	});
</script>