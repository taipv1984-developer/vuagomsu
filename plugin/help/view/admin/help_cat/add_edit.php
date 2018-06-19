<?php
	$helpCatInfo = $_REQUEST['helpCatInfo'];
	$isAction = $_REQUEST['isAction'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
    <div class="portlet light">
        <?php
        	$toolbar = new ToolBarHelper();
            $toolbar->addButtonBack(array('btn_back.php'));
            if($helpCatInfo->helpCatId){
				$toolbar->addTitle('edit', e('Edit category help'));
			}
			else{
				$toolbar->addTitle('add', e('Add category help'));
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
					'name'	=> array('required' => true),
					'description'	=> array('type' => 'textarea', 'style' => 'height: 80px', 'class' => 'tinymce_empty'),
                    'status'		=> array('type' => 'select', 'options' => ArrayHelper::getAD()),
				);
				$settingValue = $helpCatInfo;
				$settingAll = array(
					'cols' => '2-10',
					'model' => 'helpCatModel'
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
			var url = "index.php?r=admin/help_cat/validate_ajax";
			<?php if($helpCatInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var name = $('input[name="helpCatModel.name"]').val();
			var helpCatId = '<?php echo $helpCatInfo->helpCatId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'name': name, 'helpCatId': helpCatId},
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