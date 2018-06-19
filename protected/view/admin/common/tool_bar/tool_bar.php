<?php
//get params
$buttonBack = $params['buttonBack'];
$buttonRight = $params['buttonRight'];
$buttonTool = $params['buttonTool'];
$buttonExtra = $params['buttonExtra'];
?>
<div class="portlet-title">
    <div class="caption">
        <?php TemplateHelper::getTemplate("common/tool_bar/component/title.php", $params); ?>
    </div>
    <div class="actions btn-set">
        <?php
        if (!empty($buttonBack)) {
            foreach ($buttonBack as $btnBack) {
                TemplateHelper::getTemplate("common/tool_bar/component/$btnBack", $params);
            }
        }
        if (!empty($buttonRight)) {
            foreach ($buttonRight as $btnRight) {
                TemplateHelper::getTemplate("common/tool_bar/component/$btnRight", $params);
            }
        }
        if (!empty($buttonTool)) {
            foreach ($buttonTool as $btnTool) {
                TemplateHelper::getTemplate("common/tool_bar/component/$btnTool", $params);
            }
        }
        if (!empty($buttonExtra)) {
            foreach ($buttonExtra as $btnExtra) {
                TemplateHelper::getTemplate("common/tool_bar/component/btn_extra.php", $btnExtra);
            }
        }
        ?>
    </div>
</div>