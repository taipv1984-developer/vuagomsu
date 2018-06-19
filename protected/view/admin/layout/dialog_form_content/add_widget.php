<?php 
	//getAllWidget group by widgetCatName
	$allWidget = $params['allWidget'];
	$widgetList = array();
	$i = 0;
	$widgetController = '';
	foreach($allWidget as $k => $v){
		if($i == 0){
			$widgetController = $v->controller;
			//loadWidget
			FileHelper::loadWidget($v);
		}
		$i++;
		$widgetList[$v->widgetCatName][] = $v;
	}
?>

<!-- widgets list -->
<?php if(count($widgetList)== 0){
	echo "<div class='data_empty'>";
	echo e("Widgets list is empty");
	echo "</div>";
}
else{?>

<div class="row">
    <!-- left -->
    <div class="col-md-6">
        <div id="accordion-resizer" class="ui-widget-content widget_list">
            <?php foreach($widgetList as $k => $v){?>
              <h3><?=$k?></h3>
              <ul>
                <?php foreach($v as $widget){?>
                    <li class="widget_list_select <?php echo($widget->controller == $widgetController)? 'active' : ''; ?>">
                        <input type="hidden" class="widget_controller" value="<?=$widget->controller?>">
                        <h4>
                            <i class='icon <?=$widget->icon?>'></i><?=$widget->name?>
                        </h4>
                        <div class='description'><?=$widget->description?></div>
                    </li>
                <?php }?>
              </ul>
            <?php }?>
        </div>
        <?php }?>
    </div>

    <!-- right -->
    <div class="col-md-6 no_padding">
        <div class="validateTips" style='font-style: italic; margin: 3px 0; padding: 3px 0; color: red; font-size: 0.8em'></div>
        <div class="widget_form_content">
            <?php
                if(class_exists($widgetController)){
                    $control = new $widgetController();
                    $control->form();
                }
                else{
                    echo "<b style='color: red'>Controler $widgetController not exist</b>";
                    LogUtil::devInfo("[view/admin/layout/../add_widget.php] Controler $widgetController not exist");
                }
            ?>
        </div>
    </div>
</div>

<!-- accordion event -->
<script type="text/javascript">
	$().ready(function($){
		$("#accordion").accordion({
			heightStyle: "fill",
			active: 0
		});
		$("#accordion-resizer").resizable({
			minHeight: 360,
			minWidth: 200,
			resize: function(){
				$("#accordion").accordion("refresh");
			}
		});
	});
</script>