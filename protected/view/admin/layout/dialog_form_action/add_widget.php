<div class='dialog_form dialog_form_add_widget'>
   	<form>
	    <!-- dynamic content -->
	</form>
</div>

<!-- script dialog add widget -->
<script type="text/javascript">
    $(function(){
        var dialog_add_widget;			
        
        function checkRequired(){
            var check = true;
            $('.dialog_form_add_widget').find('.input').each(function(){
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

        function dialog_add_widget_action(){
            if(validateForm()){
				//get json_setting	
				var json_setting = getFormData($('.dialog_form_add_widget form'));		
				
				//ajax edit layoutWidget
	    		var url = 'index.php?r=admin/layout/layout_widget_action_ajax';
	    		var action = 'add_widget';
	    		var layout_row_id = $('.dialog_form_add_widget .layout_row_id').val();
	    		var layout_row_position = $('.dialog_form_add_widget .layout_row_position').val();
	    		var layout_row_group = $('.dialog_form_add_widget .layout_row_group').val();
	    		var widget_controller = $('.dialog_form_add_widget .widget_form_content .widget_controller').val();
	    		var type = 'desktop';
	    		var layoutId = '<?=$_REQUEST['layoutId']?>';
	    		
	    		$.ajax({
	    			url: url,
	    			type: 'post',
	    			data:{'action': action, 'widget_controller': widget_controller, 
	    				'layout_row_id': layout_row_id, 'type': type,
		    			'json_setting': json_setting, 'layoutId': layoutId,
		    			'group': layout_row_group},
	    			success: function(data){
	    				data = JSON.parse(data);
						//console.log(data);
						
						var widget_item = get_widget_item(data.layoutWidgetId, data.widgetController, data.title, data.icon);
						$('#row_'+layout_row_id+' .col_item').each(function(){
							var layout_row_position_value = $(this).find('.layout_row_position_value').val();
							if(layout_row_position_value == layout_row_position){
								$(this).find('ul').append(widget_item);
							}
						});
	    			},
	    			error: function(xhr, desc, err){
	    				console.log(xhr + "\n" + err);
	    			}
	    		});
	    		
				//close dialog_form
				dialog_add_widget.dialog("close");
           }
       }

        dialog_add_widget = $(".dialog_form_add_widget").dialog({
            autoOpen: false,
            height: 600,
            width: 1000,
            modal: true,
            buttons:{
                'Add widget': dialog_add_widget_action,
           },
            close: function(){
                $('.dialog_form_add_widget').find('.input').each(function(){
                    $(this).removeClass("error")
                });
                return false;
           }
       });

        dialog_add_widget.find("form").on("submit", function(event){
            event.preventDefault();
            dialog_add_widget_action();
       });

    	//event show add widget form
    	$(document).on('click', '.show_add_widget', function(e){
        	//all ajax load dialog_form
        	var url = 'index.php?r=admin/layout/layout_widget_action_ajax';
        	var action = 'show_add_widget';
        	var layout_row_id = $(this).parents('li').attr('id');
    		layout_row_id = layout_row_id.replace('row_', '');
        	var layout_row_position = $(this).parents('.col_item').find('.layout_row_position_value').val();
        	var layout_row_group = $(this).parents('ul.sortable_layout_system').find('.sortable_group').val();
        	var layoutId = '<?=$_REQUEST['layoutId']?>';

			$.ajax({
				url: url,
				type: 'post',
				data:{'action': action, 'layoutId': layoutId},
				success: function(data){
					$('.dialog_form_add_widget').html('<form></form>');
					
					$('.dialog_form_add_widget form').html(data);

					//add option
					$('.dialog_form_add_widget form').append('<input type="hidden" class="layout_row_id" value="' +layout_row_id+ '">');
					$('.dialog_form_add_widget form').append('<input type="hidden" class="layout_row_position" value="' +layout_row_position+ '">');
					$('.dialog_form_add_widget form').append('<input type="hidden" class="layout_row_group" value="' +layout_row_group+ '">');
				},
				error: function(xhr, desc, err){
					console.log(xhr + "\n" + err);
				}
			});
			
        	//change ui dialog_form_add_widget 
        	$('.dialog_form_add_widget form').html('');
        	$('.dialog_form_add_widget .validateTips').html('');
        	$('.ui-dialog .ui-dialog-title').html('<i class="fa fa-plus" style="margin-right: 5px"></i><?=e("Add widget")?>');
			$('.ui-dialog-titlebar-close').html('<i class="fa fa-times" title="Close"></i>'); 
			
        	//open dialog
            dialog_add_widget.dialog("open");
    	});
   });
</script>

<!-- action change widget -->
<script type="text/javascript">
    //event changle controller ajax
	$(document).on('click', '.dialog_form_add_widget .widget_list_select', function(){
		$(this).attr('id', 'widget_selected');
		var url = 'index.php?r=admin/layout/layout_widget_action_ajax';
		var widget_controller = $(this).find('.widget_controller').val();
    	var action = 'change_widget';
    	var layoutId = '<?=$_REQUEST['layoutId']?>';
        $.ajax({
            url: url,
            type: 'post',
            data:{'action': action, 'widget_controller': widget_controller, 'layoutId': layoutId},
            success: function(data){
            	//console.log(data);
				$('.dialog_form_add_widget .widget_form_content').html(data);
				$('.dialog_form_add_widget .widget_list_select').removeClass('active');
				$('#widget_selected').addClass('active');
				$('.dialog_form_add_widget .widget_list_select').attr('id', '');
           },
            error: function(xhr, desc, err){
                console.log(xhr + "\n" + err);
           }
       });
	});
</script>