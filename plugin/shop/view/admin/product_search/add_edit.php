<?php
	$productSearchInfo = $_REQUEST['productSearchInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if(!$_REQUEST['productSearchId']){
				$toolbar->addTitle('add', e('Add product search'));
			}
			else{
				$toolbar->addTitle('edit', e('Edit product search'));
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
					'key'	=> array('required' => true),
					'count'	=> array('type' => 'number', 'label' => 'Số lượt tìm kiếm',
                        'attr' => array()),
					'order'	=> array('type' => 'number'),
					'status'	=> array('type' => 'select', 'value' => $productSearchInfo->status,
                        'options' => ArrayHelper::getAD()),
				);
				$settingValue = $productSearchInfo;
				$settingAll = array(
					'model' => 'productSearchModel'
				);
				
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
			var url = "index.php?r=admin/product_search/validate_ajax";
			<?php if(!$_REQUEST['productSearchId']){ ?>
			var action = 'add';
			<?php } else {?>
			var action = 'edit';
			<?php }?>
			var key = $('input[name="productSearchModel.key"]').val();
			var productSearchId = '<?php echo $productSearchInfo->productSearchId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'key': key, 'productSearchId': productSearchId},
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
							$('.input[name="' +name+ '"]').parents('.my_row').find('.validate_message').html(message);
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