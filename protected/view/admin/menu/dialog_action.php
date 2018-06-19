<div class='dialog_form'>
   	<form>
	    <!-- dynamic content -->
	</form>
</div>

<!-- script dialog edit item -->
<script type="text/javascript">
var dialog_form;			

//event show edit item form
$(document).on('click', '.edit_menu_item', function(e){
	var action = 'edit_menu_item';
	var menuItemId = $(this).parents('li').attr('data-id');
	$.ajax({
		type : 'post',
		url : "index.php?r=admin/menu/action",
		data: {'action': action, 'menuItemId': menuItemId},
		async : true,
		success : function(data) {
			$('.dialog_form form').html(data);
		},
		error: function (xhr, desc, err) {
			console.log(xhr + "\n" + err);
		}
	});
	
	//change ui dialog_form 
	$('.ui-dialog .ui-dialog-title').html('<i class="fa fa-edit" style="margin-right: 5px"></i>Edit item');
	$('.ui-dialog .ui-dialog-titlebar-close').html('<i class="fa fa-times" title="Close"></i>'); 
	$('.ui-dialog form').html('');
	$('.ui-dialog .validateTips').html('');
	
	//open dialog
    dialog_form.dialog("open");
});

function dialog_action(){
    if(checkRequired('.dialog_form')){
        
		//get json_data	
		var json_data = getFormData($('.dialog_form form'));		

		//ajax
		var action = 'save_menu_item';
		$.ajax({
			url: "index.php?r=admin/menu/action",
			type: "post",
			data:{'action': action, 'json_data': json_data},
			success: function(data){
				data = JSON.parse(data);
				console.log(data);
				//chang view
				$('#menu_item_'+data.menu_item_id+' > .dd3-content > a')
					.text(data.title)
					.attr('href', data.link)
					.removeClass('red');
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});

		//message
		show_notice('Menu update success');
		
		//close dialog_form
		dialog_form.dialog("close");
   }
}

dialog_form = $(".dialog_form").dialog({
    autoOpen: false,
    height: 440,
    width: 500,
    modal: true,
    buttons:{
        'Update': dialog_action,
    },
    close: function(){
        $($('.dialog_form form')).find('.input').each(function(){
            $(this).removeClass("error")
       });
   }
});

dialog_form.find("form").on("submit", function(event){
    event.preventDefault();
    dialog_action();
});
</script>