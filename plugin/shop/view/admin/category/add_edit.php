<?php
	$categoryInfo = $_REQUEST['categoryInfo'];
	$categoryList = $_REQUEST['categoryList'];
	$seoInfo = $_REQUEST['seoInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addButtonBack(array('btn_back.php'));
		if($categoryInfo){
			$toolbar->addTitle('edit', e('Edit category'));
		}
		else{
			$toolbar->addTitle('add', e('Add category'));
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
					'parent_id'	=> array('type' => 'select_category', 'label' => 'Parent', 'mode' => 'edit',
							'options' => $categoryList, 'value' => $categoryInfo->parentId,),
					'icon'	=> array(),
					'image'	=> array('type' => 'file', 'value'=> $categoryInfo->image, 'action' => true),
					'description'	=> array('type' => 'textarea', 'class' => 'ckeditor'),
                    //'status'	=> array('type' => 'select', 'value' => $categoryInfo->status, 'options' => ArrayHelper::getAD()),
				);
				$settingValue = $categoryInfo;
				$settingAll = array(
					'model' => 'categoryModel'
				);
				//render setting from
				TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
				$settingForm = array(
					'title' => array('label' => 'Meta Title',
						'name' => "title",
					),
					'keyword' => array('label' => 'Meta Keyword',
						'name' => "keyword",
					),
					'description' => array('label' => 'Meta Description',
						'name' => "description",
					),
				);
				$settingValue =$seoInfo;
				$settingAll = array('model' => 'seoModel');
				
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
			var url = "index.php?r=admin/category/validate_ajax";
			<?php if($categoryInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var value = $('input[name="categoryModel.name"]').val();
			var parentId = $('select[name="categoryModel.parentId"]').val();
			var categoryId = '<?php echo $categoryInfo->categoryId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'value': value, 'parentId': parentId, 'categoryId': categoryId},
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