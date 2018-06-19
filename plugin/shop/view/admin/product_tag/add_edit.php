<?php
	$productTagInfo = $_REQUEST['productTagInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if(!$_REQUEST['productTagId']){
				$toolbar->addTitle('add', e('Add product tag'));
			}
			else{
				$toolbar->addTitle('edit', e('Edit product tag'));
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
					'description'	=> array('type' => 'textarea', 'class' => 'ckeditor_mini'),
				);
				$settingValue = $productTagInfo;
				$settingAll = array(
					'model' => 'productTagModel'
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
			var url = "index.php?r=admin/product_tag/validate_ajax";
			<?php if(!$_REQUEST['productTagId']){ ?>
			var action = 'add';
			<?php } else {?>
			var action = 'edit';
			<?php }?>
			var name = $('input[name="productTagModel.name"]').val();
			var productTagId = '<?php echo $productTagInfo->productTagId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'name': name, 'productTagId': productTagId},
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