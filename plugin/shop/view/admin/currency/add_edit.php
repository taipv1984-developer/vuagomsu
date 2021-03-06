<?php
	$currencyInfo = $_REQUEST['currencyInfo'];
	$isAction = $_REQUEST['isAction'];
?>

<div class="row">
    <form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
        <div class="portlet light">
            <?php
            	$toolbar = new ToolBarHelper();
                $toolbar->addButtonBack(array('btn_back.php'));
				if($currencyInfo){
					$toolbar->addTitle('edit', e('Edit currency'));
				}
				else{
					$toolbar->addTitle('add', e('Add currency'));
				}
                $toolbar->addButtonRight(array('btn_save_and_close.php'));
                $toolbar->showToolBar();
            ?>
            
			<div class="panel panel-default">
				<div class="panel-body">
				<?php
		            //default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
		            //add option(class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
		            //auto: type, label, name, value...
		            $settingForm = array(
	            		'currency_code'	=> array('label' => 'Code'),
	            		'description'	=> array(),
	            		'symbol'		=> array(),
	            		'after'			=> array('type' => 'select', 'options' => ArrayHelper::getYN()),
	            		'coefficient'	=> array(),
	            		'thousands_separator'	=> array(),
	            		'decimals_separator'	=> array(),
	            		'decimals'		=> array(),
		            	'is_primary' 	=> array('type' => 'select', 'value' => $currencyInfo->isPrimary, 
											'label' => 'Default', 'options' => ArrayHelper::getYN()),
	            		'status'		=> array('type' => 'select', 'options' => ArrayHelper::getAD()),
		            );
		            $settingAll = array(
	            		'model' => 'currencyModel',
	            		'required' => true
		            );
		            $settingValue = $currencyInfo;
		            
		            //render setting from
		            TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
	            ?>
				</div>
			</div>  
        </div>
    </form>
</div>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var url = "index.php?r=admin/currency/validate_ajax";
			<?php if($currencyInfo){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var currencyCode = $('input[name="currencyModel.currencyCode"]').val();
			var currencyStatus = $('select[name="currencyModel.status"]').val();
			var isPrimary = $('select[name="currencyModel.isPrimary"]').val();
			var currencyId = '<?php echo $currencyInfo->currencyId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 
					'currencyCode': currencyCode, 'isPrimary': isPrimary, 'currencyStatus': currencyStatus, 
					'currencyId': currencyId},
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