<?php
	${tableVo}Info = $_REQUEST['{tableVo}Info'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if(!$_REQUEST['{tableVo}Id']){
				$toolbar->addTitle('add', e('Add template'));
			}
			else{
				$toolbar->addTitle('edit', e('Edit template'));
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
					'field1'	=> array(),
					'field2'	=> array(),
					'field3'	=> array(),
					'status'	=> array('type' => 'select', 'value' => ${tableVo}Info->status, 'options' => ArrayHelper::getAD()),
					//...
				);
				$settingValue = ${tableVo}Info;
				$settingAll = array(
					'required' => true,
					'model' => '{tableVo}Model'
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
			var url = "index.php?r=admin/{table}/validate_ajax";
			<?php if(!$_REQUEST['{tableVo}Id']){ ?>
			var action = 'add';
			<?php } else {?>
			var action = 'edit';
			<?php }?>
			var name = $('input[name="{tableVo}Model.name"]').val();
			var {tableVo}Id = '<?=${tableVo}Info->{tableVo}Id?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'name': name, '{tableVo}Id': {tableVo}Id},
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
							$('.input[name="' +name+ '"]').parents('.my_row').find('.validate_message').html(message);
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