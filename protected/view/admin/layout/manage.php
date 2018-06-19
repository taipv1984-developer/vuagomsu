<?php 
$action = $_REQUEST['action'];
$layoutId = $_REQUEST['layoutId'];
$layoutList = $_REQUEST['layoutList'];
$layoutInfo = $_REQUEST['layoutInfo'];
$widgets = $_REQUEST['widgets'];

$linkDemo = URLHelper::getLinkDemo($layoutInfo->dispatch);
$pos = strpos($linkDemo, '?');
$isLinkDemo = ($pos === false) ? true : false;
?>

<link href="resource/backend/css/layout_manage.css" rel="stylesheet" type="text/css">
<?php TemplateHelper::getTemplate('layout/tab_manage/common_js.php'); ?>

<div class="row">
	<form action="<?="index.php?r=admin/layout/manage&action=$action&layoutId=$layoutId"; ?>" method="post" enctype="multipart/form-data">
		<div class="portlet light"  style="overflow: hidden">
			<?php
                $toolbar = new ToolBarHelper();
                $toolbar->addTitle('manage', e('Layout manage'));
                $toolbar->addButtonRight(array('btn_save.php'));
                $toolbar->showToolBar();
            ?>
			<?php 
				TemplateHelper::getTemplate('common/tabs.php', array(
					'1' => array('id' => 'layout', 'name' => e('Layout')),
					'2' => array('id' => 'layout_system', 'name' => e('Layout system')),
				));
			?>
			<div class="tab-content ">
				<div class="tab-pane active" id="tab_layout">
					<div class="col-md-6">
						<?php 
							TemplateHelper::getTemplate('common/input/select_row.php', array(
								'label' => 'Page list', 
								'options' => $layoutList, 
								'value' => $layoutId,
								'class' => 'layout_select',
								'cols' => '3-9'
							)); 
				    	?>
					</div>
					<div class="col-md-6">
				    	<?php if ($isLinkDemo){?>
				    	<a href="<?='index.php?r='.$linkDemo ?>" target="blank">
				    		<span class='link_demo'><?=$linkDemo ?></span>
				    	</a>
				    	<?php } else {
				    		echo "<span class='link_demo'>$linkDemo</span>";
				    	}?>
			    	</div>
			    	<div class='clear'></div>
				    	
					<div class="portlet-body col-md-9 nopadding left">
					    <div class="tabbable">
							<?php TemplateHelper::getTemplate('common/tabs.php', array(
								'1' => array('id' => 'desktop_layout', 'name' => e('Genenal')),//Desktop
// 								'2' => array('id' => 'mobile_layout', 'name' => e('Mobile')),
								'3' => array('id' => 'option', 'name' => e('Option')),
								'4' => array('id' => 'custom_css', 'name' => e('Custom Css')),
								));
							?>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_desktop_layout">
									<?php TemplateHelper::getTemplate('layout/tab_manage/desktop_layout.php'); ?>
								</div> <!-- end tab desktop_layout -->
								
								<div class="tab-pane _active" id="tab_mobile_layout">
									<?php //TemplateHelper::getTemplate('layout/tab_manage/mobile_layout.php'); ?>
								</div> <!-- end tab mobile_layout -->
								<div class="tab-pane" id="tab_option">
									<?php TemplateHelper::getTemplate('layout/tab_manage/option.php'); ?>
								</div> <!-- end tab option -->
								<div class="tab-pane" id="tab_custom_css">
									<?php TemplateHelper::getTemplate('layout/tab_manage/custom_css.php'); ?>
								</div> <!-- end tab custom_css -->
							</div> <!-- end .tab-content -->
						</div> <!-- end .tabbable -->
					</div>
					
					<div class='disable_layout_widget_list col-md-3 left'>
						<?php TemplateHelper::getTemplate('layout/tab_manage/disable_layout_widget.php'); ?>
					</div><!-- end  disable_widget_list-->
				</div><!-- end tab -->
			
				<div class="tab-pane _active" id="tab_layout_system">
					<div class="portlet-body">
					    <div class="tabbable">
							<?php 
 								TemplateHelper::getTemplate('common/tabs.php', array(
// 									'1' => array('id' => 'desktop_layout_system', 'name' => e('Desktop')),
// 									'2' => array('id' => 'mobile_layout_system', 'name' => e('Mobile')),
 								))
							?>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_desktop_layout_system">
									<?php TemplateHelper::getTemplate('layout/tab_layout_system/desktop_layout_system.php'); ?>
								</div> <!-- end tab desktop_layout -->
								
								<div class="tab-pane _active" id="tab_mobile_layout_system">
									<?php //TemplateHelper::getTemplate('layout/tab_layout_system/mobile_layout_system.php'); ?>
								</div> <!-- end tab mobile_layout -->
							</div> <!-- end .tab-content -->
						</div> <!-- end .tabbable -->
					</div>
				</div><!-- end tab -->
			</div>
		</div>
	</form>
</div>

<input type="button" value="test" id='test' class='hidden'>

<!-- redirect layout page event -->
<script type="text/javascript">
	$().ready(function(){
		$('.layout_select').change(function(){
			var layoutId = $(this).val();
			window.location.assign('index.php?r=admin/layout/manage&action=edit&layoutId='+layoutId);
		});
	});
</script>