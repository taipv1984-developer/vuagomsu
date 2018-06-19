<?php include '_params.php'?>
<?php 
	//option(single* | list)
	$option =(isset($params['option']))? $params['option'] : 'single';
	$action =(isset($params['action']))? $params['action'] : false;
	if($option == 'single'){
		//get $imageLoad
		$imageLoad = ($params['value']) ? URLHelper::getImagePath($params['value']) : Registry::getSetting('no_image');
		$imageThumb = ($params['value']) ? URLHelper::getImagePath($params['value'], 'large') : Registry::getSetting('no_image');
?>
	<div class='input_file <?=$params['class']?> <?php if(isset($params['id'])) echo "input_file_{$params['id']}"?>'>
		<div class="input_file_preview">
			<input type="hidden" class="image_source" value="<?=$imageLoad?>"
				name="<?php echo(isset($params['name']))? $params['name'] : 'image'; ?>" 
				id="<?=(isset($params['id']))? $params['id'] : 'image_select'?>"
			>
			<div class='image_preview_wrap image_center image_center_default <?=$class?>'>
				<a class='fancybox image_preview_link image_preview_link' href='<?=$imageLoad?>' title='<?=e('Image preview')?>'>
					<img class="image_preview image_preview" src="<?=$imageThumb ?>"
						alt='<?=e('Image preview')?>' title='<?=e('Image preview')?>'/>
				</a>
			</div>
		</div>
		<div class='clear'></div>
		
		<?php
        if($action){
            $field_id = (isset($params['id']))? $params['id'] : 'image_select';
            $filemanager_access_key = Session::getSession('filemanager_access_key');
            ?>
			<a class="btn btn-primary popup left" title='<?=e('Image preview')?>'
				href="<?=URLHelper::getResource("resource/backend/js/filemanager/dialog.php?type=0&field_id=$field_id&akey=$filemanager_access_key")?>">
				<?=e('Select image')?>
			</a>
			<div class="margin-left-10 button_delete delete_image right" title='<?=e('Delete item')?>'>
				<i class="fa fa-trash" title="Delete image"></i>
			</div>
			<script type="text/javascript">
				$(document).on('click', '.input_file .delete_image', function(){
					$(this).parents('.input_file').find('.image_source').attr('value', '<?=Registry::getSetting('no_image')?>');
					$(this).parents('.input_file').find('.image_preview').attr('src', '<?=Registry::getSetting('no_image')?>');
					$(this).parents('.input_file').find('.image_preview_link').attr('href', '<?=Registry::getSetting('no_image')?>');
				});
			</script>
		<?php }?>
	</div>
<?php }else{//multi?>
	<?php 
		$imageList = $params['imageList'];
	?>
	<?php
        if($action){
            $filemanager_access_key = Session::getSession('filemanager_access_key');
    ?>
	<div class="form-group">
	    <div class="col-md-12 left">
	    	<input type="hidden" class="" value="" id="image_add">
	        <a class="btn btn-success addImage popup" title='<?=e('Add image')?>'
	        	href="<?=URLHelper::getResource("resource/backend/js/filemanager/dialog.php?type=0&field_id=image_add&akey=$filemanager_access_key")?>" >
	        	<i class="fa fa-plus"></i> 
				<?=e('Add image')?>
			</a>
	    </div>
	</div>
	<?php }?>
	<div class="my_row">
		<ul class='input_multi_file <?=$class?>' id="sortable">
			<?php 
				$index = 0;
				foreach($imageList as $image){
					$index++;
					TemplateHelper::renderInputMultiFile($image, $index, $action);
				}
			?>
		</ul>
	</div>
	
	<script type="text/javascript">
		$(document).on('click', '.image_remove', function(){
			$(this).parents('li').fadeOut(500, function(){
				$(this).remove();
			});
		});
	</script>
<?php }?>