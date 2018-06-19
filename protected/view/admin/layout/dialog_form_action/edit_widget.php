<div class='dialog_form dialog_form_edit_widget'>
   	<form>
	    <!-- dynamic content -->
	</form>
</div>

<!-- script dialog edit widget -->
<script type="text/javascript">
    $(function(){
        var dialog_edit_widget;			
        
        function checkRequired(){
            var check = true;
            $('.dialog_form_edit_widget').find('.input').each(function(){
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

        function dialog_edit_widget_action(){
            if(validateForm()){
				//get json_setting	
				var json_setting = getFormData($('.dialog_form_edit_widget form'));		

				//ajax edit layoutWidget
	    		var url = 'index.php?r=admin/layout/layout_widget_action_ajax';
	    		var action = 'edit_widget';
	    		var layout_widget_id = $('.dialog_form_edit_widget .layout_widget_id').val();
	    		var widget_controller = $('.dialog_form_edit_widget .widget_controller').val();
	    		$.ajax({
	    			url: url,
	    			type: 'post',
	    			data:{'action': action, ' layout_widget_id':  layout_widget_id, 'widget_controller': widget_controller, 
		    			'json_setting': json_setting},
	    			success: function(data){
						//console.log(data);
						$('#layout_widget_id_' + layout_widget_id + ' h4 span').html(data);
	    			},
	    			error: function(xhr, desc, err){
	    				console.log(xhr + "\n" + err);
	    			}
	    		});
	    		
				//close dialog_form
				dialog_edit_widget.dialog("close");
           }
       }

        dialog_edit_widget = $(".dialog_form_edit_widget").dialog({
            autoOpen: false,
            height: 600,
            width: 750,
            modal: true,
            buttons:{
                'Update': dialog_edit_widget_action,
           },
            close: function(){
                $('.dialog_form_edit_widget').find('.input').each(function(){
                    $(this).removeClass("error")
               });
                return false;
           }
       });

        dialog_edit_widget.find("form").on("submit", function(event){
            event.preventDefault();
            dialog_edit_widget_action();
       });

    	//event show edit widget form
    	$(document).on('click', '.widget_control_edit', function(e){
        	var url = 'index.php?r=admin/layout/layout_widget_action_ajax';
        	var action = 'show_edit_widget';
        	var layout_widget_id = $(this).parents('li.widget_item').find('.layout_widget_id').val();
			$.ajax({
				url: url,
				type: 'post',
				data:{'action': action, 'layout_widget_id': layout_widget_id},
				success: function(data){
					//console.log(data);
					$('.dialog_form_edit_widget form').html(data);
				},
				error: function(xhr, desc, err){
					console.log(xhr + "\n" + err);
				}
			});
			
        	//change ui dialog_form_edit_widget 
        	$('.dialog_form_edit_widget form').html('');
        	$('.dialog_form_edit_widget .validateTips').html('');
        	$('.ui-dialog .ui-dialog-title').html('<i class="fa fa-edit" style="margin-right: 5px"></i><?=e("Edit widget")?>' + `<span class='notice_id'>#${layout_widget_id}</span>`);
			$('.ui-dialog-titlebar-close').html('<i class="fa fa-times" title="Close"></i>'); 
			
        	//open dialog
            dialog_edit_widget.dialog("open");
    	});
   });
</script>