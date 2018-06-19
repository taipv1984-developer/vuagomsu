<?php
$setting = $params;
$settingForm = array();
$settingForm['mobile_show'] = array('type' => 'select', 'label' => 'Hiển thị trên mobile',
    'options' => array(1 => 'Có', 0 => 'Không'));
if(isset($setting['note'])){
    $settingForm['note'] = array('type' => 'label', 'title' => $setting['note']);
}
$settingAll = array(
    'cols' => '3-9'
);
TemplateHelper::renderForm($settingForm, $setting, $settingAll);
?>

<script type="text/javascript">
    $(document).ready(function() {
        pluginInit();
    });
</script>
