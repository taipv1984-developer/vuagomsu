<?php 
	$items = $_REQUEST['pageView'];
	
	function showDefault($str){
		if($str == 1){
			return '<b>Default</b>';
		}
		else{
			return '';
		}
	}
?>
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="760"></div>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Language Manage'), 'index.php?r=admin/language/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/language/add', 
                    		'text' => e('Add Language')
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'languageModel',
				'value' => $items->items,
				'id' => 'languageId'
			);
			
			$table = array(
				array('heading' => array('key' => 'languageId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'languageCode', 'label' => 'Code'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'default'),
					'filter' => array('show' => false),
					'tbody' => array('function' => 'showDefault'),
				),
				array('heading' => array('key' => 'status', 'style' => 'width: 160px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'size' => 'small'),
					'tbody' => array('type' => 'status', 'size' => 'small')
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/language/edit&languageId=%s',
					'linkDelete' 	=> 'index.php?r=admin/language/delete&languageId=%s',
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