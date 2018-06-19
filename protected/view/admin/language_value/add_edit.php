<?php
	$languageList = $_REQUEST['languageList'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			$toolbar->addTitle('add', e('Add language value'));
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
		?>
		
		<div class="panel panel-default">
			<div class="panel-body">
				<?php 
					TemplateHelper::getTemplate('common/input/text_row.php', array(
						'name' => 'key',
						'label' => 'Language key',
						'required' => true
					));
					foreach ($languageList as $k => $v){
						TemplateHelper::getTemplate('common/input/text_row.php', array(
							'name' => "value[$k]",
							'label' => "$v value",
						));
					}
				?>
				</div>
		</div>  
	</div>
</form>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var url = 'index.php?r=admin/language_value/add/validate';
			var key = $('input[name="key"]').val();
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'key': key},
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