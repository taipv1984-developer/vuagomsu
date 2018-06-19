<?php
	$sliderInfo = $_REQUEST['sliderInfo'];
	$imageList = $_REQUEST['imageList'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addButtonBack(array('btn_back.php'));
		if($sliderInfo){
			$toolbar->addTitle('edit', e('Edit Slider'));
		}
		else{
			$toolbar->addTitle('add', e('Add Slider'));
		}
		$toolbar->addButtonRight(array('btn_save.php'));
		$toolbar->showToolBar();
		?>
		
		<?php 
		TemplateHelper::getTemplate('common/tabs.php', array(
			'1' => array('id' => '1_1', 'name' => e('Overview')),
			'2' => array('id' => '1_2', 'name' => e('Images')),
	    ))
		?>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1_1">
				<?php
				//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
				//add option (class, id, stype, styleRow, required, placeholder, attr, [options, code])
				$settingForm = array(
					'name'	=> array('required' => true),
					'description'	=> array(),
				);
				$settingValue = $sliderInfo;
				$settingAll = array(
					'model' => 'sliderModel'
				);
				
				//render setting from
				TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
				?>
			</div><!-- end tab_1_1 -->
			<div class="tab-pane" id="tab_1_2">
				<?php if($sliderInfo){ //edit page?>
                    <div class="btn btn-danger add_image">
                        <i class="fa fa-plus"></i>
                        <?=e("Add image")?>
                    </div>
					<div class="clear"></div>
					
					<div class="slider_image_list">
					<?php
                    $i = 0;
                    foreach ($imageList as $sliderImageInfo){
                        $i++;
                        $sliderImageFile = PLUGIN_PATH."slider/view/admin/slider/slider_image.php";
                        include $sliderImageFile;
                    }
					?>
					</div>
				<?php } else { //add page?>
					<div class="disable_message">
						<?=e("This function will enable in edit page!")?>
					</div>
				<?php }?>
			</div><!-- end tab_1_2 -->
		</div>
	</div>
</form>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var url = "index.php?r=admin/slider/validate_ajax";
			<?php if($sliderInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var name = $('input[name="sliderModel.name"]').val();
			var sliderId = '<?=$sliderInfo->sliderId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'name': name, 'sliderId': sliderId},
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
			 			show_notice_error('Input data incorrect. Please check again');
					}
			   }
		   	});
		});
	});
</script>

<!-- add_image and delete_image action -->
<script type="text/javascript">
	$('body').on('click', '.add_image', function() {
		var url = "index.php?r=admin/slider/add_image";
		var sliderId = '<?=$sliderInfo->sliderId?>';
		$.ajax({
			type : 'post',
			url : url,
			data:{'sliderId': sliderId},
			async : true,
			complete : function(){
		    },
			success : function(data){
				//insert data
				$('.slider_image_list').append(data);
				
				//notice
	 			show_notice('<?=e('Add image is success')?>');
		   }
	   	});
	});
	$('body').on('click', '.delete_image', function() {
		var url = "index.php?r=admin/slider/delete_image";
		var sliderImageId = $(this).parents('.slider_image').find('.sliderImageId').val();
		$.ajax({
			type : 'post',
			url : url,
			data:{'sliderImageId': sliderImageId},
			async : true,
			complete : function(){
		    },
			success : function(data){
				//remove data
				$('.input_file_'+sliderImageId).parents('.slider_image').fadeOut(500, function(){
					$(this).remove();
				});
				
				//notice
	 			show_notice('<?=e('Delete image is success')?>');
		   }
	   	});
	});
</script>

<style type="text/css">
	.slider_image{
		overflow: hidden;
		position: relative;
	}
	.slider_image:hover{
		background: #eee;
	}
	.input_file {    
    }
	.input_file .input_file_preview{
		margin: 3px 0;
    }
</style>