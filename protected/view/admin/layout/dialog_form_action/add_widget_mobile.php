<div class='dialog_form dialog_form_add_widget_mobile'>
   	<form>
	    <!-- dynamic content -->
	</form>
</div>

<!-- script dialog add widget -->
<script type="text/javascript">
    $(function(){
        var dialog_add_widget_mobile;			
        
        function checkRequired(){
            var check = true;
            $('.dialog_form_add_widget_mobile').find('.input').each(function(){
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

        function dialog_add_widget_mobile_action(){
            if(validateForm()){
				//get json_setting	
				var json_setting = getFormData($('.dialog_form_add_widget_mobile form'));

				//ajax edit layoutWidget
	    		var url = 'index.php?r=admin/layout/layout_widget_action_ajax';
	    		var action = 'add_widget_mobile';
	    		var layout_row_id = 0;
	    		var mobile_box_id = $('.dialog_form_add_widget_mobile .mobile_box_id').val();
	    		var widget_controller = $('.dialog_form_add_widget_mobile .widget_form_content .widget_controller').val();
	    		var groupValue = $('.dialog_form_add_widget_mobile .groupValue').val();
	    		var type = groupValue;	//mobile || mobile_system
	    		var layoutId = '<?=$_REQUEST['layoutId']?>';
	    		$.ajax({
	    			url: url,
	    			type: 'post',
	    			data:{'action': action, 'widget_controller': widget_controller, 
	    				'layout_row_id': layout_row_id, 'type': type,
		    			'json_setting': json_setting, 'layoutId': layoutId},
	    			success: function(data){
	    				data = JSON.parse(data);
						console.log('action = add_widget_mobile ajax');
						console.log(data);
						var widget_item = get_widget_item(data.layoutWidgetId, data.widgetController, data.title, data.icon);
						console.log(widget_item);
						$('#'+mobile_box_id+' ul').append(widget_item);
	    			},
	    			error: function(xhr, desc, err){
	    				console.log(xhr + "\n" + err);
	    			}
	    		});
	    		
				//close dialog_form
				dialog_add_widget_mobile.dialog("close");
           }
       }

        dialog_add_widget_mobile = $(".dialog_form_add_widget_mobile").dialog({
            autoOpen: false,
            height: 600,
            width: 1000,
            modal: true,
            buttons:{
                'Add widget': dialog_add_widget_mobile_action,
           },
            close: function(){
                $('.dialog_form_add_widget_mobile').find('.input').each(function(){
                    $(this).removeClass("error")
               });
           }
       });

       dialog_add_widget_mobile.find("form").on("submit", function(event){
            event.preventDefault();
            dialog_add_widget_mobile_action();
       });

    	//event show add widget form
    	$(document).on('click', '.show_add_widget_mobile', function(e){
        	//all ajax load dialog_form
        	var url = 'index.php?r=admin/layout/layout_widget_action_ajax';
        	var action = 'show_add_widget_mobile';
        	var mobile_box_id = $(this).parents('.mobile_box').attr('id');
        	var layoutId = '<?=$_REQUEST['layoutId']?>';
        	var groupValue = $(this).parents('.mobile_layout').find('.groupValue').val();	//add
			$.ajax({
				url: url,
				type: 'post',
				data:{'action': action, 'layoutId': layoutId, 'groupValue': groupValue},
				success: function(data){
					//console.log(data);
					$('.dialog_form_add_widget_mobile form').html(data);

					//add option
					$('.dialog_form_add_widget_mobile form').append('<input type="hidden" class="mobile_box_id" value="' +mobile_box_id+ '">');
					$('.dialog_form_add_widget_mobile form').append('<input type="hidden" class="groupValue" value="' +groupValue+ '">');
				},
				error: function(xhr, desc, err){
					console.log(xhr + "\n" + err);
				}
			});
			
        	//change ui dialog_form_add_widget_mobile 
        	$('.dialog_form_add_widget_mobile form').html('');
        	$('.dialog_form_add_widget_mobile .validateTips').html('');
        	$('.ui-dialog .ui-dialog-title').html('<i class="fa fa-plus" style="margin-right: 5px"></i><?=e("Add widget")?>');
        	$('.ui-dialog-titlebar-close').html('<i class="fa fa-times" title="Close"></i>'); 

        	//open dialog
            dialog_add_widget_mobile.dialog("open");
    	});
   });
</script>

<!-- action change widget -->
<script type="text/javascript">
    //event changle controller ajax
	$(document).on('click', '.dialog_form_add_widget_mobile .widget_list_select', function(){
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
				$('.dialog_form_add_widget_mobile .widget_form_content').html(data);
				$('.dialog_form_add_widget_mobile .widget_list_select').removeClass('active');
				$('#widget_selected').addClass('active');
				$('.dialog_form_add_widget_mobile .widget_list_select').attr('id', '');
           },
            error: function(xhr, desc, err){
                console.log(xhr + "\n" + err);
           }
       });
	});
</script>