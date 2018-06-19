<?php
	$manufacInfo = $_REQUEST['manufacInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
    <div class="portlet light">
        <?php
        	$toolbar = new ToolBarHelper();
            $toolbar->addButtonBack(array('btn_back.php'));
            if($manufacInfo->manufacId){
				$toolbar->addTitle('edit', e('Edit manufac'));
			}
			else{
				$toolbar->addTitle('add', e('Add manufac'));
			}
            $toolbar->addButtonRight(array('btn_save_and_close.php'));
            $toolbar->showToolBar();
        ?>
        
		<div class="panel panel-default">
			<div class="panel-body">
			<?php
				//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
				//add option (class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
				$settingForm = array(
					'name'	=> array('required' => true),
					'image'	=> array('type' => 'file', 'action' => true, 'value'=> $manufacInfo->image),
				);
				$settingValue = $manufacInfo;
				$settingAll = array(
					'model' => 'manufacModel'
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
			var url = "index.php?r=admin/manufac/validate_ajax";
			<?php if($manufacInfo->manufacId){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var name = $('input[name="manufacModel.name"]').val();
			var manufacId = '<?php echo $manufacInfo->manufacId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'name': name, 'manufacId': manufacId},
				async : false,
				complete : function(){
			    },
				success : function(data){
					//reset validate
					$('.input').removeClass('validate_error');
					$('.input').parent().find('.validate_message').html('');
					
					if(data){	//validate message
						data = JSON.parse(data);
						console.log(data);
						
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