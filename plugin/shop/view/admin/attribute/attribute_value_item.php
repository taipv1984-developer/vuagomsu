<div class="attribute_value_item">
	<input type="hidden" class="attributeValueId" value="<?php echo $attributeValueInfo->attributeValueId?>">
	<div class="image col-md-2">
		<?php 
		TemplateHelper::getTemplate("common/input/file.php", array(
			'value' => $attributeValueInfo->image,
			'name' => "attributeValue[$attributeValueInfo->attributeValueId][image]",
			'id' => $attributeValueInfo->attributeValueId,
			'action' => true,
			'class' => 'image_center image_center_small'
		));
		?>
	</div>
	<div class="info col-md-10">
		<div class="my_row">
			<input type="text" name="attributeValue[<?php echo $attributeValueInfo->attributeValueId?>][value]" 
				class="input" value="<?php echo $attributeValueInfo->value?>" placeholder="value" title="value">
		</div>
		<div class="my_row">
			<input type="text" name="attributeValue[<?php echo $attributeValueInfo->attributeValueId?>][description]" 
				class="input" value="<?php echo $attributeValueInfo->description?>" placeholder="description"  title="description">
		</div>
	</div>
</div>
<div class="clear"></div>