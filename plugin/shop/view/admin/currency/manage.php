<?php 
	$items = $_REQUEST['pageView'];
	
	function showDefault($str){
		if($str == 'Y'){
			return '<b>Default</b>';
		}
		else{
			return '';
		}
	}
?>
<div id="ajax-modal" class="modal fade" tabindex="-1" data-width="760"></div>
<div class="portlet light">
	<div class="portlet-title">
	    <div class="caption">
	        <i class="fa fa-bars font-green-sharp"></i>
           	<span class="caption-subject font-green-sharp bold uppercase">
           		<a href='index.php?r=admin/currency/manage'><?php echo e('Currency Manage') ?></a>
           	</span>
	    </div>
	</div>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/currency/add', 
                    		'text' => e('Add Currency')
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'currencyModel',
				'value' => $items->items,
				'id' => 'currencyId'
			);
			
			$table = array(
				array('heading' => array('key' => 'currencyId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'currencyCode', 'label' => 'Code'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'description'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'symbol'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'coefficient'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'isPrimary', 'label' => 'Default', 'style' => 'width: 100px'),
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
					'linkEdit'  	=> 'index.php?r=admin/currency/edit&currencyId=%s',
					'linkDelete' 	=> 'index.php?r=admin/currency/delete&currencyId=%s',
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