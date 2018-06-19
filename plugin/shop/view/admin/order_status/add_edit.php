<?php
	$orderStatusInfo = $_REQUEST['orderStatusInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if(!$_REQUEST['orderStatusId']){
				$toolbar->addTitle('add', e('Add order status'));
			}
			else{
				$toolbar->addTitle('edit', e('Edit order status'));
			}
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
		?>
		
		<div class="panel panel-default">
			<div class="panel-body">
			<?php
				if($orderStatusInfo->isSystem){
					$nameFilter = array('required' => true, attr => array('disabled' => 'disabled'));
				}
				else{
					$nameFilter = array('required' => true);
				}
				//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
				//add option (class, id, stype, styleRow, required, placeholder, attr, [options, code])
				$settingForm = array(
					'name'	=> $nameFilter,
					'description'	=> array('type' => 'textarea', 'class' => 'ckeditor_mini'),
					'order'	=> array('type' => 'number'),
				);
				$settingValue = $orderStatusInfo;
				$settingAll = array(
					'model' => 'orderStatusModel'
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
			var url = "index.php?r=admin/order_status/validate_ajax";
			<?php if(!$_REQUEST['orderStatusId']){ ?>
			var action = 'add';
			<?php } else {?>
			var action = 'edit';
			<?php }?>
			var name = $('input[name="orderStatusModel.name"]').val();
			var orderStatusId = '<?php echo $orderStatusInfo->orderStatusId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'name': name, 'orderStatusId': orderStatusId},
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