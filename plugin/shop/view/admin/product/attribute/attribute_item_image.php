<?php 
	//get data
	$info = $params['attributeValueInfo'];
?>

<li class="attribute_item_image" id="attribute_item_image_<?php echo $info->attributeValueId?>">
	<input type="hidden" class="attributeValueId" value="<?php echo $info->attributeValueId?>">
	<div class="image_main col-md-2">
		<?php 
		TemplateHelper::getTemplate("common/input/file.php", array(
			'value' => $info->attributeValueImage,
			'name' => "attributeValue[$info->attributeId][$info->attributeValueId][image]",
			'id' => $info->attributeValueId,
			'action' => true,
			'class' => 'image_center image_center_small'
		));
		?>
	</div>
	<div class="info col-md-10">
		<div class="my_row">
			<input type="text"  class="input" value="<?php echo $info->value?>" 
				placeholder="<?php echo e("Value")?>" 
				title="<?php echo e("Value")?>"
				name="attributeValue[<?php echo $info->attributeId?>][<?php echo $info->attributeValueId?>][value]">
		</div>
		<div class="my_row hide">
			<textarea class="input image_list_value" style="height: 68px"
				placeholder="<?php echo e("Each image link or video (youtube) link write on per line")?>" 
				title="<?php echo e("Each image or video (youtube) write on per line")?>"
				name="attributeValue[<?php echo $info->attributeId?>][<?php echo $info->attributeValueId?>][imageList]"
				><?php echo $info->imageList?></textarea>
		</div>
		
		<div class="my_row image_list_data">
		<?php
			$imageList = explode(";", $info->imageList);
			for($i=0; $i<6; $i++){
				$image = trim($imageList[$i]);
				$addClass = ($image == '') ? 'image_hide hide' : 'image_show';
				echo "<div class='col-md-2 $addClass'>";
				TemplateHelper::getTemplate("common/input/file.php", array(
					'value' => $image,
					'name' => "",
					'id' => $info->attributeValueId."_image_$i",
					'action' => true,
					'class' => 'image_center image_center_small'
				));
				echo "</div>";
			}
		?>
		</div>
	</div>
</li>