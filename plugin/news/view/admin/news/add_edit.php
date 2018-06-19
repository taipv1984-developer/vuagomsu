<?php
	$newsInfo = $_REQUEST['newsInfo'];
	$newsCategoryList = $_REQUEST['newsCategoryList'];
	$newsTagSelected = $_REQUEST['newsTagSelected'];
	$newsTagList = $_REQUEST['newsTagList'];
	$seoInfo = $_REQUEST['seoInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if($newsInfo){
				$toolbar->addTitle('edit', e('Edit news'));
			}
			else{
				$toolbar->addTitle('add', e('Add news'));
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
					'title'	=> array('required' => true),
					'news_category_id'	=> array('type' => 'select_category', 'required' => true, 'mode' => 'edit',
							'value' => $newsInfo->newsCategoryId, 'options' => $newsCategoryList, 'label' => 'Parent'),
//					'news_tag'	=> array('type' => 'news_tag', 'label' => 'News tags',
//							'news_tag_list' => $newsTagList, 'news_tag_selected' => $newsTagSelected,
//                            'option' => isset($newsInfo) ? 'edit' : 'add'),
                    'image'	=> array('type' => 'file', 'value' => $newsInfo->image, 'action' => true),
					'summary'	=> array('type' => 'textarea', 'class' => 'ckeditor_mini'),
					'content'	=> array('type' => 'textarea', 'class' => 'ckeditor_content'),
					'status'	=> array('type' => 'select', 
							'value' => $newsInfo->status, 'options' => ArrayHelper::getAD()),
				);
				$settingValue = $newsInfo;
				$settingAll = array(
					'model' => 'newsModel'
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
			var url = "index.php?r=admin/news/validate_ajax";
			<?php if($newsInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var title = $('input[name="newsModel.title"]').val();
			var newsId = '<?=$newsInfo->newsId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'title': title, 'newsId': newsId},
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
			 			show_notice_error('<?=e('Nhập dữ liệu không đúng, vui lòng kiểm tra lại')?>');
					}
			   }
		   	});
		});
	});
</script>