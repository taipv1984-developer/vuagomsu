<?php
	$routerInfo = $_REQUEST['routerInfo'];
	$layoutList = $_REQUEST['layoutList'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if(!$_REQUEST['routerId']){
				$toolbar->addTitle('add', e('Add router'));
			}
			else{
				$toolbar->addTitle('edit', e('Edit router'));
			}
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
		?>
		
		<div class="panel panel-default">
			<div class="panel-body">
			<?php
				$attr = ($_REQUEST['routerId']) ? array('disabled' => 'disabled') : array();
				$settingForm = array(
					'layout_id'	=> array('type' => 'select', 'label' => 'Layout', 'required' => true,
							'value' => $routerInfo->layoutId, 'options' => $layoutList, 'options_map' => array('layoutId', 'name'),
							'attr' => $attr),
					'alias_by'	=> array('type' => 'select',
							'value' => $routerInfo->aliasBy, 'options' => $routerInfo->aliasList),
					'alias'	=> array(),
					'prefix'	=> array(),
					'suffix'	=> array(),
				);
				$settingValue = $routerInfo;
				$settingAll = array(
					'model' => 'routerModel'
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
			var url = "index.php?r=admin/router/validate_ajax";
			<?php if(!$_REQUEST['routerId']){ ?>
			var action = 'add';
			<?php } else {?>
			var action = 'edit';
			<?php }?>
			var layoutId = $('select[name="routerModel.layoutId"]').val();
			var routerId = '<?=$routerInfo->routerId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'layoutId': layoutId, 'routerId': routerId},
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