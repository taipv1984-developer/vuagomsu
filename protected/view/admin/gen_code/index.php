<?php 
	$allTable = $_REQUEST['allTable'];
?>
	<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
    	<div class="col-md-12">
            <div class="portlet light">
            	<div class="col-md-6" >
            		<h4><?=e('Table list')?></h4>
            		<!-- table list -->
					<ul class='my_list border' style='overflow-y: auto; height: 210px; padding: 0'>
						<?php foreach($allTable as $v){?>
						<li id='table_<?=$v?>' class='table_item pointer'>
							<?=$v?>
						</li>
						<?php }?>
					</ul>
				</div>
				<div class="col-md-6">
					<h4><?=e('Table info')?></h4>
					<div id='table_info_content' style='overflow-y: auto; height: 210px; padding: 0'>
						<!-- dynamic content -->
					</div>
				</div>
				<div class='clear'></div><p>
            
				<div class="panel panel-default">
					<div class="panel-body">
						<?php 
							//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
							//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
							$settingForm = array(
									'configContent' 	=> array('value' => $_REQUEST['configContent']),
									'controllerContent' => array('value' => $_REQUEST['controllerContent']),
									'manageContent' 	=> array('value' => $_REQUEST['manageContent']),
									'addContent' 		=> array('value' => $_REQUEST['addContent']),
							);
							
							$settingAll = array(
								'type' => 'textarea'
							);

							//render setting from
							TemplateHelper::renderForm($settingForm, null, $settingAll);
						?>
					</div>
				</div>
            </div>
    	</div>
    </form>

<script type="text/javascript">
	$('.table_item').click(function(){
		var table = $(this).attr('id');
		table = table.replace('table_', '');
		$('.table_item').removeClass('active');
		$(this).addClass('active');
		var action = 'show_table_info';
		$.ajax({
			url: 'index.php?r=admin/gen_code_action_ajax',
			type: 'post',
			data:{'action': action, 'table': table},
			success: function(data){
				//console.log(data);
				$('#table_info_content').html(data);
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});
	});
</script>