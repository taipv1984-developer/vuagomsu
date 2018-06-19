<div class='dialog_form dialog_form_edit'>
   	<form>
	    <!-- dynamic content -->
	</form>
</div>

<!-- script dialog edit item -->
<script type="text/javascript">
    $(function(){
        var dialog_form, form_edit;			

        function dialog_action(){
            if(checkRequired('.dialog_form')){
                
				//get json_data	
				form_edit = $('.dialog_form_edit form');
				var json_data = getFormData(form_edit);		

				//ajax
	    		var action = 'edit_save';
	    		$.ajax({
	    			url: "index.php?r=admin/nav_link/action",
	    			type: "post",
	    			data:{'action': action, 'json_data': json_data},
	    			success: function(data){
	    				data = JSON.parse(data);
						//console.log(data);
						//chang view
						$('#menu_item_'+data.nav_link_id+' > .dd3-content > a')
							.text(data.title)
							.attr('href', data.link)
							.removeClass('red');
	    			},
	    			error: function(xhr, desc, err){
	    				console.log(xhr + "\n" + err);
	    			}
	    		});

	    		//message
				show_notice('Nav link update success');
				
				//close dialog_form
				dialog_form.dialog("close");
           }
       }

       dialog_form = $(".dialog_form_edit").dialog({
            autoOpen: false,
            height: 300,
            width: 500,
            modal: true,
            buttons:{
                'Update': dialog_action,
            },
            close: function(){
                $(form_edit).find('.input').each(function(){
                    $(this).removeClass("error")
               });
           }
       });

       dialog_form.find("form").on("submit", function(event){
            event.preventDefault();
            dialog_action();
       });

    	//event show edit item form
    	$(document).on('click', '.btn_edit', function(e){
    		var action = 'edit_form';
    		var id = $(this).parents('li').attr('data-id');
			$.ajax({
				type : 'post',
				url : "index.php?r=admin/nav_link/action",
				data: {'action': action, 'id': id},
				async : true,
				success : function(data) {
					$('.dialog_form_edit form').html(data);
				},
				error: function (xhr, desc, err) {
					console.log(xhr + "\n" + err);
				}
			});
			
        	//change ui dialog_form_edit 
        	$('.ui-dialog .ui-dialog-title').html('<i class="fa fa-edit" style="margin-right: 5px"></i>Edit item');
			$('.ui-dialog .ui-dialog-titlebar-close').html('<i class="fa fa-times" title="Close"></i>'); 
			$('.ui-dialog form').html('');
        	$('.ui-dialog .validateTips').html('');
        	
        	//open dialog
            dialog_form.dialog("open");
    	});
   });
</script>