<?php  
	$permission = $_REQUEST['permission'];
	$permissionCount = (is_array($permission)) ? count($permission) : 0;
	$role = $_REQUEST['role'];
	$roleId = $role->roleId;
	$permissionGroup = $_REQUEST['permissionGroup'];
?>
<form class="form-horizontal form-row-seperated" action="" method="post">
	<div class="portlet light">
		<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addButtonBack(array('btn_back.php'));
		if(!isset($_REQUEST['roleId'])){
			$toolbar->addTitle('add', e('Add role'));
		}
		else{
			$toolbar->addTitle('edit', e('Edit role'));
		}
		$toolbar->addButtonRight(array('btn_save.php',));
		$toolbar->showToolBar();
		?>
		<div class="portlet-body">
			<div class="form-body">
				<?php
				TemplateHelper::getTemplate('common/input/text_row.php', array(
					'label' => e('Group name'),
					'required' => true,
					'type' => 'text',
					'name' => 'roleName',
					'value' => $role->roleName
				));
				TemplateHelper::getTemplate('common/input/checkbox_permission_row.php', array(
					'label' => e('Permission') . " ($permissionCount)",
					'name' => 'permission[]',
					'permissionGroup' => $permissionGroup,
					'permission' => $permission,
				));
				?>
			</div>
			<textarea name='permission_join' class='permission_join hide'></textarea>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){
            var permission = [];
            $("input[name='permission[]']:checked").each(function(){            
            	permission.push($(this).val());
            });
            $('.permission_join').html(permission.join(","));
        });
    });
</script>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function(event){		//required
			var url = "index.php?r=admin/role/validate_ajax";
			<?php if(isset($_REQUEST['roleId'])){ ?>
			var action = 'edit';
			<?php } else {?>
			var action = 'add';
			<?php }?>
			var roleName = $('input[name="roleName"]').val();
			var roleId = '<?=$roleId?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'roleName': roleName, 'roleId': roleId},
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