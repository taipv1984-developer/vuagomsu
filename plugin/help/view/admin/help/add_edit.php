<?php
	$helpInfo = $_REQUEST['helpInfo'];
	$isAction = $_REQUEST['isAction'];
	$helpCat = $_REQUEST['helpCat'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
    <div class="portlet light">
        <?php
        	$toolbar = new ToolBarHelper();
            $toolbar->addButtonBack(array('btn_back.php'));
            if($helpInfo){
				$toolbar->addTitle('edit', e('Edit help'));
			}
			else{
				$toolbar->addTitle('add', e('Add help'));
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
					'help_cat_id' => array('type' => 'select', 'label' => 'Category','required' => true,
							'value' => $helpInfo->helpCatId, 'options' => $helpCat),
					'title'	=> array('required' => true),
					'router'	=> array('type' => 'textarea', 'class' => '_tinymce_empty', 'style' => 'height: 90px'),
					'content'	=> array('type' => 'textarea', 'class' => 'tinymce'),
				);
				$settingValue = $helpInfo;
				$settingAll = array(
					'cols' => '2-10',
					'model' => 'helpModel'
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
			var url = "index.php?r=admin/help/validate_ajax";
			<?php if($helpInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var title = $('input[name="helpModel.title"]').val();
			var helpId = '<?php echo $helpInfo->helpId?>';
			var helpCatId = $('select[name="helpModel.helpCatId"]').val();
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'title': title, 'helpId': helpId, 'helpCatId': helpCatId},
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