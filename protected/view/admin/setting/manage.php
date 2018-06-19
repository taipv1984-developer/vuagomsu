<?php 
	$setting = $_REQUEST['setting'];
	$settingList = $_REQUEST['settingList'];
	$settingType = $_REQUEST['settingType'];
	$settingGroup = $_REQUEST['settingGroup'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post">
    <div class="portlet light">
        <?php
        $toolbar = new ToolBarHelper();
        $toolbar->addButtonBack(array('btn_back.php'));
        $toolbar->addTitle('fa fa-gear', e('Settings for general'));
        $toolbar->addButtonRight(array('btn_save_and_close.php'));
        $toolbar->showToolBar();
        ?>
        <div class="row">
            <!-- settingType list-->
            <div class='col-md-3'>
                <div class='setting_tyle_list'>
                    <ul>
                    <?php
                        foreach ($settingType as $k => $v){
                            $active = ($k == $setting) ? 'active' : '';
                    ?>
                        <li class='<?=$active?>'>
                            <a href='index.php?r=admin/setting/manage&setting=<?=$k?>'>
                                <?=$v?>
                            </a>
                        </li>
                    <?php }?>
                    </ul>
                </div>
            </div>

            <!-- setting edit value -->
            <div class='col-md-9'>
                <?php
                    if(!empty($settingGroup)){
                    foreach($settingGroup as $groupKey => $group){
                        if($group->status != 'A') continue;
                ?>
                    <div class="portlet-body">
                        <div class="panel-group accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#setting_group_<?=$group->settingGroupId?>">
                                            <?=$group->name?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="setting_group_<?=$group->settingGroupId?>" class="panel-collapse in" style='overflow: hidden;'>
                                    <?php
                                        $settingGroupList = $settingList[$groupKey];
                                        foreach($settingGroupList as $k => $v){
                                            $function = $v->function;
                                            if ($v->valueType == 'textarea'){
                                                TemplateHelper::getTemplate('common/input/textarea_row.php', array(
                                                    'label' => StringHelper::toUcfirst($v->settingName),
                                                    'value' => $v->settingValue,
                                                    'required' => $v->required,
                                                    'title' => $v->description,
                                                    'name' => $v->settingName,
                                                    'cols' => '3-9',
                                                    'class' => 'ckeditor'
                                                ));
                                            }
                                            else if ($v->valueType == 'textarea_only'){
                                                TemplateHelper::getTemplate('common/input/textarea_row.php', array(
                                                    'label' => StringHelper::toUcfirst($v->settingName),
                                                    'value' => $v->settingValue,
                                                    'required' => $v->required,
                                                    'title' => $v->description,
                                                    'name' => $v->settingName,
                                                    'cols' => '3-9',
                                                ));
                                            }
                                            else if ($v->valueType == 'file'){
                                                TemplateHelper::getTemplate('common/input/file_row.php', array(
                                                    'label' => StringHelper::toUcfirst($v->settingName),
                                                    'value' => $v->settingValue,
                                                    'required' => $v->required,
                                                    'title' => $v->description,
                                                    'name' => $v->settingName,
                                                    'cols' => '3-9',
                                                    'id' => $v->settingName,
                                                    'action' => true,
                                                ));
                                            }
                                            else{
                                                $valueType = ($v->valueType == 'number') ? 'number' : 'text';
                                                if($function == ''){
                                                    TemplateHelper::getTemplate('common/input/text_row.php', array(
                                                        'type' => $valueType,
                                                        'label' => StringHelper::toUcfirst($v->settingName),
                                                        'value' => $v->settingValue,
                                                        'required' => $v->required,
                                                        'title' => $v->description,
                                                        'name' => $v->settingName,
                                                        'cols' => '3-9',
                                                    ));
                                                }
                                                else{
                                                    TemplateHelper::getTemplate('common/input/select_row.php', array(
                                                        'label' => StringHelper::toUcfirst($v->settingName),
                                                        'value' => $v->settingValue,
                                                        'required' => $v->required,
                                                        'title' => $v->description,
                                                        'name' => $v->settingName,
                                                        'options' => ArrayHelper::$function(),
                                                        'cols' => '3-9',
                                                    ));
                                                }
                                            }
                                       }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } //end foreach
                }
                else { //$settingGroup is empty
                    foreach($settingList as $k => $v){
                        TemplateHelper::getTemplate('common/input/text_row.php', array(
                            'label' => StringHelper::toUcfirst($v->settingName),
                            'value' => $v->settingValue,
                            'required' => $v->required,
                            'title' => $v->description,
                            'name' => $v->settingName
                        ));
                    }
                }?>
            </div>
        </div>
    </div>
</form>