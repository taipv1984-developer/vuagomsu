<!-- get_row_item building html item layout -->
<script type="text/javascript">
	function get_widget_item(layout_widget_id, layout_widget_controller, name, icon){
		var widget_item = '';
		
		widget_item += 	'<li class="widget_item" id="layout_widget_id_' +layout_widget_id+ '">';
		widget_item += 		'<input type="hidden" class="layout_widget_id" value="' + layout_widget_id + '" id="layout_widget_' + layout_widget_id + '">';
		widget_item += 		'<input type="hidden" class="layout_widget_controller" name="widgetList[]" value="' + layout_widget_controller + '">';
		widget_item += 		'<h4>';
		widget_item += 			'<i class="icon ' + icon + '"></i>';
		widget_item += 			'<span>' + name + '</span>';
		widget_item += 		'</h4>';
		widget_item += 		'<div class="widget_control">';
		widget_item += 			'<div class="widget_control_item widget_control_delete" title="<?=e('Delete widget'); ?>"></div>';
		widget_item += 			'<div class="widget_control_item widget_control_edit" title="<?=e('Setting widget'); ?>"></div>';
		widget_item += 		'</div>';
		widget_item += 	'</li>';
	
		return widget_item;
	}
	
	function get_row_item(row_id, cols){
		var colsClass ={'1':'col-md-12', '2':'col-md-6', '3':'col-md-4', '4':'col-md-3', '5':'col-md-2', '6':'col-md-2'};
		var layout_item="";
		layout_item += "<li id='row_" +row_id+ "' class='layout_row'>";
		layout_item += "<input type='hidden' name='layoutRow[" +row_id+ "][position]' class='layout_row_position' value=''>";
		layout_item += "	<div class='control'>";
		layout_item += "		<div class='move' title='<?=e('Move row')?>'><\/div>";
		layout_item += "		<div class='delete delete_row_item' title='<?=e('Delete row')?>'><\/div>";
		layout_item += "		<div class='setting show_row_setting ' title='<?=e('Setting row')?>'><\/div>";
		layout_item += "	<\/div>";
		layout_item += "	<div class='cols'>";
		for(var i=0; i<cols; i++){
			layout_item += "		<div class='col_item " +colsClass[cols]+ " no_padding col_position_" +i+ "'>";
			layout_item += "		<input type='hidden' class='layout_row_position_value' value='" +i+ "'>";
			layout_item += "		<input type='hidden' name='layoutRow[" +row_id+ "][cols][" +i+ "]' class='layout_row_cols' value=''>";
			layout_item += "			<ul class='widget_list connectedSortable sortable_widget ui-sortable'>";
			layout_item += "				<!-- dymanic content -->";
			layout_item += "			<\/ul>";
			layout_item += "			<div class='col_item_control'>";
			layout_item += "				<div class='col_class' title='<?=e('Column class')?>'>" + colsClass[cols] + "<\/div>";
			layout_item += "				<div class='show_add_widget' title='<?=e('Add widget')?>'><\/div>";
			layout_item += "			<\/div>";
			layout_item += "		<\/div>";
		}
		layout_item += "	<\/div>";
		layout_item += "<\/li>";
		return layout_item;
	}
</script>

<!-- function stop sortable -->
<script type="text/javascript">
	function layout_row_sortable_update(){
		var iRow = -1;
		$('#sortable_layout .layout_row').each(function(){
			iRow++;
			$(this).find('.layout_row_position').attr('value', iRow);
		});

		var iRow = -1;
		$('#sortable_layout_system_header .layout_row').each(function(){
			iRow++;
			$(this).find('.layout_row_position').attr('value', iRow);
		});

		var iRow = -1;
		$('#sortable_layout_system_footer .layout_row').each(function(){
			iRow++;
			$(this).find('.layout_row_position').attr('value', iRow);
		});
	};
	
	function widget_list_sortable_update(){
		//Case desktop layout
		//1. Duyet qua cac layout_row
		$('.layout_row').each(function(){
			//2. Duyet qua cac cot
			var col = -1;
			$(this).find('.col_item').each(function(){
				//3. Duyet qua cac widget_item thuoc col hien tai
				var layout_widget_list = [];
				$(this).find('.widget_item').each(function(){
					var layout_widget_id = $(this).find('.layout_widget_id').val();
					layout_widget_list.push(layout_widget_id);
				});
				//update layout_row_cols value
				$(this).find('.layout_row_cols').attr('value', layout_widget_list.join('-'));
			});
		});

		//Case mobile layout
		//2. Duyet qua cac navbar
		$('#mobile_layout .mobile_widget_box').each(function(){
			//2. Duyet qua cac widget_item thuoc navbar hien tai
			var m_layout_widget_list = [];
			$(this).find('.widget_item').each(function(){
				var layout_widget_id = $(this).find('.layout_widget_id').val();
				m_layout_widget_list.push(layout_widget_id);
			});
			//update m_layout_widget_list value
			$(this).find('.m_layout_widget_list').attr('value', m_layout_widget_list.join('-'));
		});
		$('#mobile_layout_system .mobile_system_box').each(function(){
			//2. Duyet qua cac widget_item thuoc navbar hien tai
			var m_layout_system_widget_list = [];
			$(this).find('.widget_item').each(function(){
				var layout_widget_id = $(this).find('.layout_widget_id').val();
				m_layout_system_widget_list.push(layout_widget_id);
			});
			//update m_layout_system_widget_list value
			$(this).find('.m_layout_system_widget_list').attr('value', m_layout_system_widget_list.join('-'));
		});

		//3. active_layout_widget_list
		var active_layout_widget_list = [];
		$('#sortable_layout .widget_list li').each(function(){
			var layout_widget_id = $(this).find('.layout_widget_id').val();
			active_layout_widget_list.push(layout_widget_id);
		});
		//update active_layout_widget_list
		$('.active_layout_widget_list').attr('value', active_layout_widget_list.join('-'));

		//4. disable_widget_list
		var disable_layout_widget_list = [];
		$('.disable_layout_widget_content ul li').each(function(){
			var layout_widget_id = $(this).find('.layout_widget_id').val();
			disable_layout_widget_list.push(layout_widget_id);
		});
		//update disable_widget_list
		$('.disable_layout_widget_list').attr('value', disable_layout_widget_list.join('-'));
	};
</script>

<!-- Pre submit event doing -->
<script type="text/javascript">
	$().ready(function(){
		//https://www.bram.us/2008/10/27/jqueryjson_encodeanything-json_encode-anything-and-not-just-forms/
		(function($){
			$.fn.json_encodeAnything = function(){
				var toReturn	= [];
				var els 		= $(this).find(':input').get();
				$.each(els, function(){
					if(this.name && !this.disabled &&(this.checked || /select|textarea/i.test(this.nodeName)|| /text|number|hidden|password/i.test(this.type))){
						var val = $(this).val();
						toReturn.push(encodeURIComponent(this.name)+ "=" + encodeURIComponent(val));
					}
				});
				return toReturn.join("&").replace(/%20/g, "+");
			}
		})(jQuery);
	});
	
	function pre_submit(){	
		layout_row_sortable_update();
		widget_list_sortable_update();
	}
	
	$(document).on('click', '.submit', function(){
		pre_submit();
	});

	//Test
	$(document).on('click', '#test', function(){
		pre_submit();
	});
</script>


<!-- layout_row sortable -->
<script type="text/javascript">
	$().ready(function(){
		 //sortable_layout
		 //$("#sortable_layout").sortable();
		 $("#sortable_layout").sortable({
			start: function(event, ui){
			},
			stop: function(){
				layout_row_sortable_update();
			},
			over: function(){
			},
			out: function(){
			}
		});
		 
		 $("#sortable_layout").disableSelection();
		 
		 //sortable_widget
		 widget_list_sortable();
	});
</script>

<!-- sortable layout_widget -->
<script type="text/javascript">
	//sortable_widget
	function widget_list_sortable(){
		//$(".widget_list").sortable();
		 $(".widget_list").sortable({
		 	start: function(event, ui){
				//console.log('.widget_list sortable start');
		   },
		    stop: function(){
				//console.log('.widget_list sortable stop');
		    	widget_list_sortable_update();
		    },
		    over: function(){
		         $(this).addClass('sortable_over');
		         $(this).find('.ui-sortable-placeholder').addClass('widget_item_placeholder');
		         $(this).find('.ui-sortable-placeholder').attr('style', '');
		    },
		     out: function(){
		          $(this).removeClass('sortable_over');
		    }
		});
		 $(".widget_list").disableSelection();
		 $(".sortable_widget").sortable({
		      connectWith: ".connectedSortable"
		   }).disableSelection();
	}
</script>

<!-- action in layout_row (delete_row) -->
<script type="text/javascript">
	//event delete a layout_row, layout_row_system
	$(document).on('click', '.delete_row_item', function(){
		var id = $(this).parents('li').attr('id');
		var layoutRowId = id.replace('row_', '');
		var layout_widget_list = [];
		$('#'+id).find('.widget_item').each(function(){
			var layout_widget_id = $(this).find('.layout_widget_id').val();
			layout_widget_list.push(layout_widget_id);
		});
		layout_widget_list = layout_widget_list.join('-');

		var url = 'index.php?r=admin/layout/layout_row_action_ajax';
		var action = 'delete_row';
		if(confirm('Are you sure to delete layout row #'+layoutRowId)){
			$.ajax({
				url: url,
				type: 'post',
				data:{'action': action, 'layoutRowId': layoutRowId, 'layout_widget_list': layout_widget_list},
				success: function(data){
					//remove all layout widget to disable widget list
					$('#'+id).find('.widget_item').each(function(){
						$(this).appendTo($('.disable_layout_widget_content ul'));
					});
	
					//remove item
					$('#row_'+layoutRowId).fadeOut(500, function(){
						$(this).remove();
					});

					show_notice('<?=e('Layout row detele success') ?>');
				},
				error: function(xhr, desc, err){
					console.log(xhr + "\n" + err);
				}
			});
		}
	});
</script>

<!-- action delete widget -->
<script type="text/javascript">
	//event delete widget
    $(document).on('click', '.widget_control_delete', function(e){
    	//ajax edit layoutWidget
		var url = 'index.php?r=admin/layout/layout_widget_action_ajax';
		var action = 'delete_widget';
		var layout_widget_id = $(this).parents('li.widget_item').find('.layout_widget_id').val();
		$.ajax({
			url: url,
			type: 'post',
			data:{'action': action, 'layout_widget_id': layout_widget_id},
			success: function(data){
				show_notice('<?=e('Widget detele success') ?>');
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});
		
		//remove widget_item
		$(this).parents('li.widget_item').fadeOut(500, function(){
			$(this).remove();
		});
	});
</script>

<?php 
	function print_widget_item_list($layoutWidgets, $allLayoutWidget){
	    //foreach layout_widget
		foreach($layoutWidgets as $w){
				$layoutWidget = $allLayoutWidget[$w]; 
				$setting = (array)json_decode($layoutWidget->setting);
				$settingTitle = $setting['title'];
				$widgetName =($settingTitle != '')? "<b class='blue'>".$settingTitle."</b>" : $layoutWidget->name;
?>
		<li class="widget_item" id="layout_widget_id_<?=$layoutWidget->layoutWidgetId?>">
		<input type="hidden" class="layout_widget_id" value="<?=$layoutWidget->layoutWidgetId?>" id="layout_widget_<?=$layoutWidget->layoutWidgetId?>">
		<input type="hidden" class="layout_widget_controller" name='widgetList[]' value="<?=$layoutWidget->widgetController?>">
		<h4>
			<i class="icon <?=$layoutWidget->icon?>"></i>
			<span><?=$widgetName?></span>
			</h4>
			<div class="widget_control">
				<div class="widget_control_item widget_control_delete" title="Delete widget"></div>
				<div class="widget_control_item widget_control_edit" title="Setting widget"></div>
			</div>
		</li>
<?php }	//end foreach
	}
?>