<?php 
	//get data
	$pluginCode = $_REQUEST['pluginCode'];
	$attributeList = $_REQUEST['attributeList'];
	$productAttribute = $_REQUEST['productAttribute'];

	$attributeIdSelected = array();
	foreach ($productAttribute as $v){
		$attributeIdSelected[] = $v['attributeId'];
	}
?>

<?php if(!isset($_REQUEST['productId'])){?>
	<div class='action_disable'>
		<?php echo e('Please save product before add attribute')?>
	</div>
<?php } else {?>
	<div class='product_attribute'>
		<div class="my_row">
			<div class="col-md-3 nopadding">
				<select class="select_attribute">
					<option value=""><?php echo e('Select a attribute')?></option>
					<?php foreach($attributeList as $attributeId => $v){?>
					<option value="<?php echo $attributeId?>" 
						<?php if(in_array($attributeId, $attributeIdSelected)) echo 'disabled="disabled"'?>>
						<?php echo $v['name']?>
					</option>
					<?php } ?>
				</select>
			</div>
			<div class="btn btn-success add_attribute margin-left-10">
				<i class="fa fa-plus"></i>
				<?php echo e('Add attribute')?>
			</div>
		</div>
		<div class="my_row">
			<div class="attribute_selected">
            <?php 
				foreach ($productAttribute as $attributeInfo){
					$params = array(
						'pluginCode' => $pluginCode,
						'attributeInfo' => $attributeInfo,
						'attributeArray' => ProductExt::getAttributeArray(),
					);
					TemplateHelper::getTemplate('product/attribute/attribute_item.php', $params, $pluginCode);
				}
			?>
			</div>
		</div>
	</div>

	<!-- attribute action -->
	<script type="text/javascript">
		$(document).on("click", ".add_attribute", function(){
	    	var action = 'add_attribute';
	    	var productId = <?php echo $_REQUEST['productId']?>;
	    	var attributeId = $(this).parents('.product_attribute').find('.select_attribute option:selected').val().trim();
	
	    	//localhost/vdato_empty/index.php?r=admin/product/attribute_action&action=add_attribute&productId=1&attributeId=1
	    	if(attributeId != ''){
				$.ajax({
					url: 'index.php?r=admin/product/attribute_action',
					type: 'post',
					data:{'action': action, 'productId': productId, 'attributeId': attributeId},
					success: function(data){
						//console.log(data);
						if(data == 'exist'){
							show_notice_error('Attribute is exist');
						}
						else{
							//add data
							$('.attribute_selected').append(data);
							//chosen
							$('.chosen-select').chosen();
							//disable select_attribute selected
							$('.select_attribute option').each(function(){
								var val = $(this).val();
								$(this).prop('selected', false);
								if(val == attributeId){
									$(this).attr('disabled', 'disabled');
								}
								if(val == ''){
									$(this).attr('selected', 'selected');
								}
							});
							//message
							show_notice('Add attribute is success');
						}
					},
					error: function(xhr, desc, err){
						console.log(xhr + "\n" + err);
					}
				});
	    	}
	    	else{
	    		show_notice_error('Yout not select a attribute');
	    	}
		});
	
		$(document).on("click", ".delete_attribute", function(){
	    	var action = 'delete_attribute';
	    	var productId = <?php echo $_REQUEST['productId']?>;
	    	var id = $(this).attr('id');
	    	var attributeId = id.replace('delete_attribute_', '');
	
	    	//localhost/vdato_empty/index.php?r=admin/product/attribute_action&action=delete_attribute&productId=1&attributeId=1
			$.ajax({
				url: 'index.php?r=admin/product/attribute_action',
				type: 'post',
				data:{'action': action, 'productId': productId, 'attributeId': attributeId},
				success: function(data){
					//remove
					$('#panel_group_'+attributeId).fadeOut(500, function(){
						$(this).remove();
					});
					//disable item in select_attribute
					$('.select_attribute option').each(function(){
						var val = $(this).val();
						$(this).prop('selected', false);
						if(val == attributeId){
							$(this).prop('disabled', false);
						}
						if(val == ''){
							$(this).attr('selected', 'selected');
						}
					});
					//message
					show_notice('Delete attribute is success');
				},
				error: function(xhr, desc, err){
					console.log(xhr + "\n" + err);
				}
			});
		});
	</script>
	
	<!-- attribute_value action -->
	<script type="text/javascript">
		//add_attribute_value click
		$(document).on("click", ".add_attribute_value", function(){
			var action = 'add_attribute_value';
			var productId = <?php echo $_REQUEST['productId']?>;
			var id = $(this).attr('id');
	    	var attributeId = id.replace('add_attribute_value_', '');
	
	    	//localhost/vdato_empty/index.php?r=admin/product/attribute_action&action=add_attribute_value&productId=1&attributeId=1
			$.ajax({
				url: 'index.php?r=admin/product/attribute_action',
				type: 'post',
				data:{'action': action, 'productId': productId, 'attributeId': attributeId},
				success: function(data){
					//console.log(data);
					//add data
					$('#panel_group_'+attributeId+' .attribute_item_image_list').append(data);
					//message
					show_notice('Add attribute value is success');
				},
				error: function(xhr, desc, err){
					console.log(xhr + "\n" + err);
				}
			});
		});
	
		$('body').on('click', '.image_main .delete_image', function() {
			var action = 'delete_attribute_value';
			var attributeValueId = $(this).parents('.attribute_item_image').find('.attributeValueId').val();
	
			$.ajax({
				type : 'post',
				url : 'index.php?r=admin/product/attribute_action',
				data:{'action': action, 'attributeValueId': attributeValueId},
				async : true,
				complete : function(){
			    },
				success : function(data){
					//remove data
					$('.input_file_'+attributeValueId).parents('.attribute_item_image').fadeOut(500, function(){
						$(this).remove();
					});
					
					//notice
		 			show_notice('Delete attribute value is success');
			   }
		   	});
		});
	
		$('body').on('click', '.show_all_image', function() {
			var id = $(this).attr('id');
	    	var attributeId = id.replace('show_all_image_', '');
	    	var click = $(this).attr('data-click');
	    	if(click % 2 == 0){
	        	//hide
	    		$('#panel_group_'+attributeId+' .attribute_item_image_list .info .image_list_data .image_hide').removeClass('hide');
	    		$(this).html('<i class="fa fa-eye" style="margin-right: 5px"></i>Hide all image');
	    	}
	    	else{
	        	//show
	    		$('#panel_group_'+attributeId+' .attribute_item_image_list .info .image_list_data .image_hide').addClass('hide');
	    		$(this).html('<i class="fa fa-eye" style="margin-right: 5px"></i>Show all image');
	    	}
	    	//update
	    	click++;
	    	$(this).attr('data-click', click);
		});
	</script>
	
	<!-- chosen-select -->
	<script type="text/javascript">
		//select_all_attribute_value click
		$(document).on("click", ".select_all_attribute_value", function(){
			var attributeId = $(this).parents('.panel_content').find('.attributeId').val();
	 		$('#accordion_group_' +attributeId+ ' .chosen-select option').each(function(){
				$(this).prop('selected', true);
		 	});
			$(this).parents('.panel_content').find('.chosen-select').trigger('chosen:updated');
		});
	
		//select_none_attribute_value click
		$(document).on("click", ".select_none_attribute_value", function(){
			var attributeId = $(this).parents('.panel_content').find('.attributeId').val();
	 		$('#accordion_group_' +attributeId+ ' .chosen-select option').each(function(){
				$(this).prop('selected', false);
		 	});
			$(this).parents('.panel_content').find('.chosen-select').trigger('chosen:updated');
		});
	</script>
<?php }//end if?>