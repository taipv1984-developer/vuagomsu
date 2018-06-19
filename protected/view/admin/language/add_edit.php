<?php
	$languageInfo = $_REQUEST['languageInfo'];
	$arrayCountry = $_REQUEST['arrayCountry'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if($languageInfo){
				$toolbar->addTitle('edit', e('Edit language'));
			}
			else{
				$toolbar->addTitle('add', e('Add language'));
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
					'language_code'	=> array('label' => 'Code'),
					'name'			=> array(),
					'country_code'	=> array('type' => 'select', 'value' => $languageInfo->countryCode, 'options' => $arrayCountry, 'label' => 'Country'),
					'default' 		=> array('type' => 'select', 'value' => $languageInfo->default, 'options' => ArrayHelper::get10()),
					'status'		=> array('type' => 'select', 'value' => $languageInfo->status, 'options' => ArrayHelper::getAD()),
				);
				$settingValue = $languageInfo;
				$settingAll = array(
					'required' => true,
					'cols' => '2-10',
					'model' => 'languageModel'
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
			var url = "index.php?r=admin/language/validate_ajax";
			<?php if($languageInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var languageCode = $('input[name="languageModel.languageCode"]').val();
			var languageDefault = $('select[name="languageModel.default"]').val();
			var languageStatus = $('select[name="languageModel.status"]').val();
			var languageId = '<?=$languageInfo->languageId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 
					'languageCode': languageCode, 'languageDefault': languageDefault, 'languageStatus': languageStatus, 
					'languageId': languageId},
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