<?php
	//get data
	$sliderImageId = $sliderImageInfo->sliderImageId;	
	$sliderId = $sliderImageInfo->sliderId;
	$image = $sliderImageInfo->image;
	$title = $sliderImageInfo->title;
	$description = $sliderImageInfo->description;
	$link = $sliderImageInfo->link;
	$order = $sliderImageInfo->order;
	$addClass = ($i%2==0) ? "slider_image_event" : "slider_image_odd";
?>

<div class="slider_image <?=$addClass?>">
	<input type="hidden" class="sliderImageId" value="<?=$sliderImageId?>">
	<div class="image col-md-2">
		<?php 
		TemplateHelper::getTemplate("common/input/file.php", array(
			'option' => 'single', 
			'value' => $image,
			'name' => "sliderImage[$sliderImageId][image]",
			'id' => $sliderImageId,
			'action' => true
		));
		?>
	</div>
	<div class="info col-md-10">
		<div class="my-row">
			<input type="text" name="sliderImage[<?=$sliderImageId?>][title]" class="input" value="<?=$title?>" placeholder="title">
		</div>
		<div class="my-row">
			<input type="text" name="sliderImage[<?=$sliderImageId?>][description]" class="input" value="<?=$description?>" placeholder="description">
		</div>
		<div class="my-row">
			<input type="text" name="sliderImage[<?=$sliderImageId?>][link]" class="input" value="<?=$link?>" placeholder="link">
		</div>
		<div class="my-row">
			<input type="number" name="sliderImage[<?=$sliderImageId?>][order]" class="input" value="<?=$order?>" placeholder="order" min="0" step="1" style="width: 50%">
		</div>
	</div>
</div>
<div class="clear"></div>