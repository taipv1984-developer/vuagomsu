<?php 
	//get data
	$options = $params['options'];
	$table 	= $params['table'];
	$tool 	= $params['tool'];
	
	//set default table value
	$table = TemplateHelper::renderTable_getDefaultTableValue($table, $options);
	
	//set default $tool value
	$tool = TemplateHelper::renderTable_getDefaultToolValue($tool);
	
	//get action_type(in tool)
	$data_type =(isset($tool['action']['data_type']))? $tool['action']['data_type'] : '';	//auto, [space]
	
	//get show_filter
	$show_filter = isset($options['show_filter']) ? $options['show_filter'] : true;
	$show_tool = isset($options['show_tool']) ? $options['show_tool'] : true;
	$show_count = isset($options['show_count']) ? $options['show_count'] : true;
	
	//convert value type frome object to array
	$values = array();
	foreach($options['value'] as $v){
		$values[] = (array)$v;
	}
?>

<table class="table table-striped table-bordered table-hover dataTable no-footer">
	<thead>
		<!-- Heading -->
		<tr class="heading">
			<?php $i = 0; foreach($table as $col){ $i++;?>
				<th <?=TemplateHelper::renderTable_getClass($col['heading']['class'])?> <?=TemplateHelper::renderTable_getStyle($col['heading']['style'])?>>
					<?=e($col['heading']['label'])?>
				</th>
			<?php }?>
			<?php if($show_tool){?>
				<th <?=$tool['style']?>><?=e($tool['label']);?></th>
			<?php }?>
		</tr>
		
		<?php if($show_filter){?>
		<!-- Filter -->
        <form action="" id="userSearchForm" method="post">
		<tr class='filter'>
			<?php foreach($table as $col){?>
				<!-- <?=$col['heading']['key']?> -->
				<td <?=TemplateHelper::renderTable_getClass($col['filter']['class'])?> <?=TemplateHelper::renderTable_getStyle($col['filter']['style'])?>>
					<?php 
						if($col['filter']['show']){
							TemplateHelper::getTemplate("common/input/{$col['filter']['type']}.php", $col['filter']);
						}
					?>
				</td>
			<?php }?>
			<?php if($show_tool){?>
				<td>
					<?=$tool['add_tool']?>
	                <?php 
		                TemplateHelper::getTemplate('common/buttons/btn_search.php',array(
							'type'=>'button', 'id'=>'userSearch', 'text'=>e('Search')
		               ));
	                ?>
	            </td>
			<?php }?>
		</tr>
        </form>
		<?php }//end if $show_filter?>
	</thead>
	<!-- Tbody -->
	<tbody>
	<?php foreach($values as $v){?>
		<tr <?="id='row_".$v[$options['id']]."'"?> <?="class='row_".$v[$options['id']]."'"?>>
			<?php foreach($table as $col){?>
			<td <?php if($col['tbody']['td_class']) echo " class='{$col['tbody']['td_class']}'"?>>
				<?php 
					//get value
					$key = $col['heading']['key']; 
					$value = ($key == 'this') ? $v : $v[$key];
					
					if(isset($col['tbody']['callback'])){
						$callback = $col['tbody']['callback'];
						$value = $callback($value);
					}
					
					//class
					$class = TemplateHelper::renderTable_getClass($col['tbody']['class']);
					//style
					$style = TemplateHelper::renderTable_getStyle($col['tbody']['style']);
					
					//write value
					$tbodyType = ($col['tbody']['type']) ? $col['tbody']['type'] : 'label';
					if($tbodyType == 'label'){
						echo "<span $class $style>";
						echo $col['tbody']['before_code'];
						echo $value;
						echo $col['tbody']['after_code'];
						echo "</span>";
					}
					else{
						$params = $col['tbody'];
						$params['value'] = $value;
                        $tbodyFile = "common/input/$tbodyType.php";
						TemplateHelper::getTemplate($tbodyFile, $params);
					}
				?>
			</td>
			<?php }//end foreach table ?>
			<?php if($show_tool){?>
				<?php if(isset($tool['key'])){?>
					<td>
						<?=$v[$tool['key']]?>
					</td>
				<?php } else {?>
					<td>
						<?php
							$params = array();
							if($data_type == 'auto'){	//demo shipping extension(install)	
								//render button by $values
								$params[$tool['action']['button_type']] = 1;
								$params['data_type'] = $data_type;
								$params['data_value'] = $v;
								TemplateHelper::getTemplate('common/buttons/btn_tool.php', $params);
							}
							else{
								//render button by replace string
								foreach($tool['action'] as $key => $value){
									if(!is_array($value)){
										$params = array();
										$newValue = str_replace('%s', $v[$options['id']], $value);
										$newValue = str_replace('%z', $v[$options['zone']], $newValue);
										$params[$key] = $newValue;
										TemplateHelper::getTemplate('common/buttons/btn_tool.php', $params);
									}
									else{
										$params = array();
										foreach ($value['key'] as $valueParams){
											$params[$key][$valueParams] = $v[$valueParams];
										}
										TemplateHelper::getTemplate('common/buttons/btn_tool.php', $params);
									}
								}
							}
						?>
					</td>
				<?php }?>
			<?php }?>
		</tr>
		<?php 	}	//end foreach options['value'] ?>
	</tbody>
</table>