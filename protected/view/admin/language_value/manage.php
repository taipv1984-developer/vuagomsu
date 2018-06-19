<?php 
	$languageList = $_REQUEST['languageList'];
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Language Value Manage'), 'index.php?r=admin/language_value/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/language_value/add', 
                    		'text' => e('Add language value')
                    	)); 
                    ?>
                    <div class="btn btn-primary margin-left-10 import_auto">
                    	<?=e('Import auto')?>
                    	<i class="fa fa-flash"></i>
                    </div>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'languageValueModel',
				'value' => $items->items,
				'id' => 'languageValueId'
			);
			
			$table = array(
				array('heading' => array('key' => 'languageValueId', 'label' => 'ID', 'class' => 'sorting', 'style' => 'width: 80px'),
					'filter' => array('type' => 'number'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'languageName', 'label' => 'Name', 'style' => 'width: 120px'),
					'filter' => array('type' => 'select', 'options' => $languageList),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'key'),
					'filter' => array(),
					'tbody' => array('type' => 'label', 'class' => 'languageName blue'),
				),
				array('heading' => array('key' => 'value', 'label' => 'Value'),
					'filter' => array(),
					'tbody' => array('type' => 'text', 'class' => 'languageValue', 'name' => 'value'),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkSave'  	=> 'index.php?r=admin/language_value/save&languageValueId=%s',
					'linkDelete' 	=> 'index.php?r=admin/language_value/delete&languageValueId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>

	    <!-- paging -->
	    <div class="row">
			<?php TemplateHelper::getTemplate('common/paging.php')?>
		</div>
	</div>
</div>

<script type="text/javascript">
	//import_auto
	$(document).on('click','.import_auto', function() {
		if(confirm('<?=e('This action will scan the entire source code to identify the language up will take time. Do you want to continue?')?>')){
			$.ajax({
				type : 'post',
				url : "index.php?r=admin/language_value/import_auto",
				data: {},
				async : true,
				success : function(data) {
					window.location.reload();
				},
				error: function (xhr, desc, err) {
					console.log(xhr + "\n" + err);
				}
			});
		}
	});

	//linkSave
	$(document).on('click','.linkSave', function() {
		var row = $(this).parents('tr').attr('id');
		var id = row.replace('row_', '');
		var value = $('#'+row).find('input[name="value"]').val();

		$.ajax({
			type : 'post',
			url : "index.php?r=admin/language_value/save",
			data: {'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Language save success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
</script>