<?php 
	$rowInfo = $params['rowInfo'];
	$setting = (array)json_decode($rowInfo->setting);
?>

<div class='row_setting' id='row_<?=$rowInfo->layoutRowId?>'>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#genaral">Tổng quan</a></li>
        <li><a data-toggle="tab" href="#bg">Thông số nền</a></li>
    </ul>

    <div class="tab-content">
        <div id="genaral" class="tab-pane fade in active">
            <?php
            $settingForm = array(
                'add_class'	=> array(),
                'full_width'	=> array('type' => 'select', 'label' => 'Độ rộng lớn nhất',
                    'options' => array(1 => 'Có', 0 => 'Không')),
                'status'	=> array('type' => 'select', 'value' => $rowInfo->status, 'label' => 'Trạng thái',
                    'options' => array('A' => 'Bật', 'D' => 'Tắt')),
            );
            $settingAll = array(
                'cols' => '3-9'
            );
            TemplateHelper::renderForm($settingForm, $setting, $settingAll);
            ?>
            <div class='row my_row'>
                <div class="col_class">
                <?php
                for($i=0; $i<$rowInfo->cols; $i++){
                    $col_class = "col_class_$i";
                    ?>
                        <label class="col-md-3 my_tooltip">
                            <?=e('Col')." ".($i+1)?> class
                        </label>
                        <div class="row_value col-md-9">
                            <input type='text' name='col_class_<?=$i?>' value="<?=$setting[$col_class]?>"
                                   class="row_setting" placeholder="class">
                        </div>
                <?php }?>
                </div>
            </div>
        </div>

        <div id="bg" class="tab-pane fade">
            <?php
            $settingForm = array(
                'bg_color'	=> array('label' => 'Màu nền', 'class' => 'ColorPickerSliders',
                    'addElement' => '<a href="index.php?r=admin/help/view&helpId=4" target="_blank">Xem thêm</a>'),
                'bg_image'	=> array('type' => 'file', 'action' => true,
                    'value' => $setting['bg_image'], 'label' => 'Ảnh nền'),
                'bg_image_size'	=> array('type' => 'select', 'label' => 'Độ rộng ảnh nền',
                    'options' => ApplicationConfigHelper::get('layout.row.bg.size.list')),
                'bg_image_repeat'	=> array('type' => 'select', 'label' => 'Kiểu lặp ảnh nền',
                    'options' => ApplicationConfigHelper::get('layout.row.bg.repeat.list')),
            );
            $settingAll = array(
                'cols' => '3-9'
            );
            TemplateHelper::renderForm($settingForm, $setting, $settingAll);
            ?>
        </div>
    </div>
</div>
<?php TemplateHelper::getTemplate('layout/_extra/color_picker.php') ?>