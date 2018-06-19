<?php 
	$attributeInfo = $_REQUEST['attributeInfo'];
	$attributeValueList = $_REQUEST['attributeValueList'];
?>
<div class="row">
	<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
		<div class="portlet light">
			<?php
				$toolbar = new ToolBarHelper();
				$toolbar->addButtonBack(array('btn_back.php'));
				if(!isset($attributeInfo)){
					$toolbar->addTitle('add', e('Add attribute'));
			    }
			    else{
					$toolbar->addTitle('edit', e('Edit attribute'));
			    }
				$toolbar->addButtonRight(array('btn_save_and_close.php'));
				$toolbar->showToolBar();
			?>
			<div class="tabbable">
				<?php TemplateHelper::getTemplate('common/tabs.php', array(
					'1' => array('id' => 'general', 'name' => e('General')),
					'2' => array('id' => 'attribute_value', 'name' => e('Attribute Value'))))
				?>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_general">
						<?php
							//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
							//add option (class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
							$settingForm = array(
								'name'	=> array('required' => true),
								'type'	=> array('type' => 'select', 'value' => $attributeInfo->type, 'options' => ArrayHelper::getProductAttributeType()),
								'image'	=> array('type' => 'file', 'action' => true, 'value'=> $attributeInfo->image),
								'description'	=> array('type' => 'textarea', 'class' => 'ckeditor'),
							);
							$settingValue = $attributeInfo;
							$settingAll = array(
								'model' => 'attributeModel'
							);
							
							//render setting from
							TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
						?>
					</div>
					<div class="tab-pane" id="tab_attribute_value">
						<?php if($attributeInfo){ //edit page?>
						    <div class="col-md-12">
						        <a class="btn  btn-success add_attribute_value">
							        <i class="fa fa-plus"></i> 
							        <?php echo e('Add attribute value')?>
						        </a>
						    </div>
						    <div class="attribute_value_list">
								<?php
									foreach ($attributeValueList as $attributeValueInfo){
										include 'attribute_value_item.php';
									}
								?>
							</div>
						<?php } else {?>
							<div class="action_disable">
								<?php echo e("This function will enable in edit page!")?>
							</div>
						<?php }?>
					</div>
				</div>
			</div> 
		</div>
	</form>        
</div>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var url = "index.php?r=admin/attribute/validate_ajax";
			<?php if($attributeInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var value = $('input[name="attributeModel.name"]').val();
			var id = '<?php echo $attributeInfo->attributeId?>';

			//check attributeValue_value
			var checked = true;
			var valueCheck = [];
			$('.attributeValue_value').each(function(){
				$(this).removeClass('error');
				var val = $(this).val();
				if(val.trim() == ''){
					checked = false;
					$(this).addClass('error');
				}
				else{
					val = val.toLowerCase();
					if(valueCheck.indexOf(val) == -1){
						valueCheck.push(val);
					}
					else{
						checked = false;
						$(this).addClass('error');
					}
				}
			});

			if(checked){
				$.ajax({
					type : 'post',
					url : url,
					data:{'action': action, 'value': value, 'id': id},
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
			}
			else{
				//notice error
	 			show_notice_error('Product attribute value is duplicate or empty');
	 			
				event.preventDefault();	//required
			}
		});
	});
</script>

<!-- attributeValue action -->
<script type="text/javascript">
	$('body').on('click', '.add_attribute_value', function() {
		var url = "index.php?r=admin/attribute/add_attribute_value";
		var attributeId = '<?php echo $attributeInfo->attributeId?>';
		$.ajax({
			type : 'post',
			url : url,
			data:{'attributeId': attributeId},
			async : true,
			complete : function(){
		    },
			success : function(data){
				//insert data
				$('.attribute_value_list').append(data);
				
				//notice
	 			show_notice('Add attribute value is success');
		   }
	   	});
	});

    $('body').on('click', '.delete_image', function() {
		var url = "index.php?r=admin/attribute/delete_attribute_value";
		var attributeValueId = $(this).parents('.attribute_value_item').find('.attributeValueId').val();
		$.ajax({
			type : 'post',
			url : url,
			data:{'attributeValueId': attributeValueId},
			async : true,
			complete : function(){
		    },
			success : function(data){
				//remove data
				$('.input_file_'+attributeValueId).parents('.attribute_value_item').fadeOut(500, function(){
					$(this).remove();
				});
				
				//notice
	 			show_notice('Delete attribute value is success');
		   }
	   	});
	});
</script>