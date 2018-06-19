<?php 
	$items = $_REQUEST['pageView'];
?>
<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('News Tag Manage'), 'index.php?r=admin/news_tag/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/news_tag/add', 
                    		'text' => e('Add News Tag'),
                    	)); 
                    ?>
	            </div>
	        </div>
	    </div>
	    
		<?php
			$options = array(
				'model' => 'newsTagModel',
				'value' => $items->items,
				'id' => 'newsTagId'
			);
			
			$table = array(
				array('heading' => array('key' => 'newsTagId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'tagLink', 'label' => 'Name'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'description'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'news_count'),
					'filter' => array('show' => false),
					'tbody' => array(),
				),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/news_tag/edit&newsTagId=%s',
					'linkDelete' 	=> 'index.php?r=admin/news_tag/delete&newsTagId=%s',
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