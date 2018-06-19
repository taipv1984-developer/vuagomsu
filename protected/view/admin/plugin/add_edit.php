<?php
	$pluginInfo = $_REQUEST['pluginInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if($pluginInfo){
				$toolbar->addTitle('edit', e('Edit plugin'));
			}
			else{
				$toolbar->addTitle('add', e('Add plugin'));
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
					'plugin_code'	=> array('required' => true,),
					'priority'	=> array('type' => 'number', 'min' => 0, 'step' => 1),
					'status'	=> array('type' => 'select', 'value' => $pluginInfo->status, 'options' => ArrayHelper::getAD()),
					'info_view'	=> array('type' => 'label', 'title' => 'Info'),
				);
				$settingValue = $pluginInfo;
				$settingAll = array(
					'model' => 'pluginModel'
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
			var url = "index.php?r=admin/plugin/validate_ajax";
			<?php if($pluginInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var pluginCode = $('input[name="pluginModel.pluginCode"]').val();
			var pluginId = '<?=$pluginInfo->pluginId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'pluginCode': pluginCode, 'pluginId': pluginId},
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