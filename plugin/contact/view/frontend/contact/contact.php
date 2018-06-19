<div class="widget_content dang_ky">
    <h1>Đăng ký tham gia</h1>
    <div class="description col-md-12">
        <?php echo Registry::getSetting('contact_header');?>
    </div>
    <div class="col-md-6 dang_ky_form">
        <form action="" method="post">
            <?php
            $settingForm = array(
                'name'		=> array('required' => 'Y', 'label' => 'Họ tên'),
                'phone'		=> array('required' => 'Y', 'label' => 'Số điện thoại'),
                'email'		=> array('type' => 'email', 'label' => 'Mail'),
                'region'	=> array('type' => 'select', 'options' => ArrayHelper::getRegionList(),
                    'label' => 'Đăng ký tập tại cơ sở'),
                'more_info'	=> array('type' => 'textarea', 'label' => 'Thông tin thêm'),
            );
            $settingAll = array(
                'rows' => 2
            );
            TemplateHelper::renderForm($settingForm, null, $settingAll);
            ?>
            <div class="row my_row margin-bottom-10">
                <div class="button_group2 col-md-12">
                    <button type="submit" class="button button_blue register_button left" title="Hoàn tất đăng ký">Hoàn tất đăng ký</button>
                    <div class="clear"></div>
                    <div class="line line_blue"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6 dang_ky_map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1862.394596431295!2d105.8506648719666!3d21.00108577404992!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac737793a7ef%3A0x7b0225da53786926!2zMTAgVOG6oSBRdWFuZyBC4butdSwgSGFpIELDoCBUcsawbmcsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1470910994702" width="560" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

    </div>
</div>