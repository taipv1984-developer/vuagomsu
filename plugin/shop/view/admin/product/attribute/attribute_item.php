<?php 
	//get data
	$pluginCode = $params['pluginCode'];
	$attributeInfo = (array)$params['attributeInfo'];
	$attributeArray = $params['attributeArray'];
	
	$attributeId = $attributeInfo['attributeId'];
	$attributeName = $attributeInfo['name'];
 	$attributeType = $attributeInfo['type'];
 	$attributeImage = $attributeInfo['attributeImage'];
 	$attributeValue = $attributeInfo['attributeValue'];
?>

<div class="panel-group accordion" id="panel_group_<?php echo $attributeId?>">
	<input type="hidden" name="attributeType[<?php echo $attributeId?>]" value="<?php echo $attributeType?>">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#accordion_group_<?php echo $attributeId?>">
					<?php echo $attributeName?>
				</a>
			</h4>
			<i class="fa fa-trash margin-left-10 delete_attribute" id="delete_attribute_<?php echo $attributeId?>"
				title="<?php echo e("Delete attribute")?>"></i>
		</div>
		
		<div id="accordion_group_<?php echo $attributeId?>" class="panel-collapse in panel_content">
			<input type="hidden" name="attributeId" class="attributeId" value="<?php echo $attributeId?>">
			<div class="col-md-12 value_group margin-top-10">
				<?php 
					if($attributeType == 'select'){
						$attributeValueSelectedArray = array();
						foreach ($attributeValue as $v){
							$attributeValueSelectedArray[] = $v->attributeValueId;
						}
				?>
				<input type="hidden" name="attributeValue[<?php echo $attributeId?>]" class="attributeValue" value="">
				<select data-placeholder="Select values" multiple="" class="chosen-select">
				<?php foreach ($attributeArray[$attributeId] as $k => $v){?>
					<option value="<?php echo $k?>" <?php if (in_array($k, $attributeValueSelectedArray)) echo 'selected="selected"'?>>
						<?php echo $v?>
					</option>
				<?php }?>
				</select>
				<div class="action_group" style="overflow: hidden; margin: 10px 0;">
					<div class="btn btn-success left select_all_attribute_value">
						<i class="fa fa-check"></i>
						<?php echo e('Select all')?>
					</div>
					<div class="btn btn-success left margin-left-10 select_none_attribute_value">
						<i class="fa fa-remove"></i>
						<?php echo e('Select none')?>
					</div>
				</div>
				
				<?php } else if($attributeType == 'text'){?>
				<?php 
					$attributeValueText = array();
					foreach ($attributeInfo['attributeValue'] as $v){
						$attributeValueText[] = trim($v->value);
					}
				?>
				<input type="text" name="attributeValue[<?php echo $attributeId?>]" value="<?php echo join(' | ', $attributeValueText)?>">
				<div style="overflow: hidden; margin: 10px 0; font-style: italic; font-size: 0.9em">
					<?php echo e("Use char | to insert mutil attribute value.")?>
				</div>
				
				<?php } else if($attributeType == 'image'){ ?>
					<input type="hidden" name="attributeValue[<?php echo $attributeId?>]" value="">
					<div class="btn btn-success add_attribute_value" title="<?php echo e('Add attribute value')?>" 
						id="add_attribute_value_<?php echo $attributeId?>">
						<i class="fa fa-plus"></i>
						<?php echo e('Add attribute value')?>				        
					</div>
					<div class="btn btn-default show_all_image margin-left-10" title="<?php echo e('Show all image')?>"
						id="show_all_image_<?php echo $attributeId?>" data-click='0'>
						<i class="fa fa-eye"></i>
						<?php echo e('Show all image')?>
					</div>
					<ul class="attribute_item_image_list">
						<?php 
						foreach ($attributeInfo['attributeValue'] as $attributeValueInfo){
							$params = array(
								'attributeValueInfo' => $attributeValueInfo,
							);
							TemplateHelper::getTemplate('product/attribute/attribute_item_image.php', $params, $pluginCode);
						}
						?>
					</ul>
				<?php }?>
			</div>
		</div>
	</div>
</div>