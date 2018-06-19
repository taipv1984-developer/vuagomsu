<?php 
	$helpCat = $_REQUEST['helpCat'];
	$helpArray = $_REQUEST['helpArray'];
	$helpCatId = $_REQUEST['helpCatId'];
?>

	<form class="form-horizontal form-row-seperated" action="" method="post">
		<div class="portlet light">
			<?php
				$toolbar = new ToolBarHelper();
				$toolbar->addTitle('manage', e('Help List'), 'index.php?r=admin/help/list');
				$toolbar->showToolBar();
			?>
			<div class="portlet-body">
				<!-- settingType list-->
				<div class='col-md-2'>
					<div class='setting_tyle_list'>
						<ul>
						<?php 
							foreach ($helpCat as $k => $v){
								$active = ($k == $helpCatId) ? 'active' : '';
						?>
							<li class='<?php echo $active?>'>
								<a href="index.php?r=admin/help/list&helpCatId=<?php echo $k?>">
									<?php echo $v?>
								</a>						
							</li>
						<?php }?>
						</ul>
					</div>
				</div>
				
				<!-- setting edit value -->
				<div class='col-md-10'>
					<?php 
						foreach($helpCat as $k => $v){
							if($helpCatId){
								if($k != $helpCatId) continue;
							}
					?>
						<div class="portlet-body">
		                    <div class="panel-group accordion"> 
		                        <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#help_<?php echo $k?>">
		                                        <?php echo $v?> 
		                                    </a>
		                                </h4>
		                            </div>
		                            <div id="help_<?php echo $k?>" class="panel-collapse in" style='overflow: hidden;'>
		                            	<ul class="help_list">
		                                <?php foreach($helpArray[$k] as $_k => $_v){ ?>
		                                	<li>
												<a href="index.php?r=admin/help/view&helpId=<?php echo $_k?>" class="linkViewPopup popup_max" title="<?php echo $_v?>">
													<?php echo $_v?>
												</a>
											</li>
			                            <?php }?>
			                            </ul>
		                            </div>
		                        </div>
		                    </div>
		                </div>
					<?php }?>
				</div>
			</div>
		</div>
	</form>
