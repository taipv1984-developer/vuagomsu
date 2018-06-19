<div class='dialog_form dialog_form_row_setting'>
   	<form>
	    <!-- dynamic content -->
	</form>
</div>

<!-- script dialog row setting -->
<script type="text/javascript">
    $(function(){
        var dialog_row_setting;			
        
        function checkRequired(){
            var check = true;
            $('.dialog_form_row_setting').find('.input').each(function(){
                var required = $(this).attr('required');
                if(required == 'required'){
                    var val = $(this).val();
                    var name = $(this).attr('name');
                    if(val.trim() == ''){
                        var message = `${name} is required`;
                        $(this).addClass('validate_error');
						$(this).parent().find('.validate_message').html(message);
                        check = false;
                   }
               }
           });
           return check;
       }

        function validateForm(){
			return checkRequired();
       }

        function dialog_row_setting_action(){
            if(validateForm()){
				//get json_setting	
				var json_setting = getFormData($('.dialog_form_row_setting form'));		

				//ajax edit layoutWidget
	    		var url = 'index.php?r=admin/layout/layout_row_action_ajax';
	    		var action = 'update_row_setting';
	    		var id = $('.dialog_form_row_setting .row_setting').attr('id');
	    		var status = $('select[name="status"]').val(); 
	    		var layoutRowId = id.replace('row_', '');
	    		$.ajax({
	    			url: url,
	    			type: 'post',
	    			data:{'action': action, 'layoutRowId': layoutRowId, 'json_setting': json_setting, 'status': status},
	    			success: function(data){
	    				data = JSON.parse(data);
	    				var setting = data.setting;
	    				if(status == 'A'){
							$('#'+id).removeClass('layout_row_disable');
	    				}
	    				else{
	    					$('#'+id).addClass('layout_row_disable');
	    				}
	    				
	    				//change col_class
	    				$('#row_'+layoutRowId+' .cols .col_position_0 .col_item_control .col_class').html(setting.col_class_0);
	    				$('#row_'+layoutRowId+' .cols .col_position_1 .col_item_control .col_class').html(setting.col_class_1);
	    				$('#row_'+layoutRowId+' .cols .col_position_2 .col_item_control .col_class').html(setting.col_class_2);
	    				$('#row_'+layoutRowId+' .cols .col_position_3 .col_item_control .col_class').html(setting.col_class_3);
	    				$('#row_'+layoutRowId+' .cols .col_position_4 .col_item_control .col_class').html(setting.col_class_4);
	    				$('#row_'+layoutRowId+' .cols .col_position_5 .col_item_control .col_class').html(setting.col_class_5);
	    			},
	    			error: function(xhr, desc, err){
	    				console.log(xhr + "\n" + err);
	    			}
	    		});
	    		
				//close dialog_form_row_setting
				dialog_row_setting.dialog("close");
           }
       }

        dialog_row_setting = $(".dialog_form_row_setting").dialog({
            autoOpen: false,
            height: 440,
            width: 610,
            modal: true,
            buttons:{
                'Update': dialog_row_setting_action,
           },
            close: function(){
                $('.dialog_form_row_setting').find('.input').each(function(){
                    $(this).removeClass("error")
               });
           }
       });

       dialog_row_setting.find("form").on("submit", function(event){
            event.preventDefault();
            dialog_row_setting_action();
       });

    	//event show setting row form
    	$(document).on('click', '.show_row_setting', function(e){
    		var id = $(this).parents('li').attr('id');
    		var layoutRowId = id.replace('row_', '');

    		//ajax edit layoutWidget
    		var url = 'index.php?r=admin/layout/layout_row_action_ajax';
    		var action = 'show_row_setting';
    		
    		$.ajax({
    			url: url,
    			type: 'post',
    			data:{'action': action, 'layoutId': <?=$_REQUEST['layoutId']?>, 'layoutRowId': layoutRowId},
    			success: function(data){
    				//console.log('action = ' + action);
    				$('.dialog_form_row_setting form').html(data);
    			},
    			error: function(xhr, desc, err){
    				console.log(xhr + "\n" + err);
    			}
    		});

			//change ui dialog_form_row_setting 
			$('.dialog_form_row_setting form').html('');
			$('.dialog_form_row_setting .validateTips').html('');
			$('.ui-dialog .ui-dialog-title').html('<i class="fa fa-edit" style="margin-right: 5px"></i><?=e("Row setting")?>' + `<span class='notice_id'>#${layoutRowId}</span>`);
			$('.ui-dialog-titlebar-close').html('<i class="fa fa-times" title="Close"></i>'); 
						
        	//open dialog
            dialog_row_setting.dialog("open");
    	});
   });
</script>