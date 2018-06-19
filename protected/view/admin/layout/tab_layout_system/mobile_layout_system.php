<?php
$layoutRowMobile = $_REQUEST['layoutRowMobileSystem'];
$layoutWidgetList = (array)json_decode($layoutRowMobile->layoutWidgetList);
$allLayoutWidget = $_REQUEST['allLayoutWidget'];
$mobile_system_top = ($layoutWidgetList['mobile_system_top'] != '') ? explode('-', $layoutWidgetList['mobile_system_top']) : array();
$mobile_system_bottom = ($layoutWidgetList['mobile_system_bottom'] != '') ? explode('-', $layoutWidgetList['mobile_system_bottom']) : array();
$mobile_system_left = ($layoutWidgetList['mobile_system_left'] != '') ? explode('-', $layoutWidgetList['mobile_system_left']) : array();
$mobile_system_right = ($layoutWidgetList['mobile_system_right'] != '') ? explode('-', $layoutWidgetList['mobile_system_right']) : array();
?>

<div class='mobile_layout' id='mobile_layout_system'>
    <input type="hidden" class='groupValue' value='mobile_system'>
    <div class='navbar_container' id='navbar_container'>
        <!-- start mobile_system_left -->
        <div class='mobile_system_box mobile_system_left_box mobile_box _hide' id='mobile_system_left'>
            <input type="hidden" value='' class='m_layout_system_widget_list'
                   name='m_layout_system_widget_list[mobile_system_left]'>
            <h3 class='left'><?=e('Mobile system left') ?></h3>
            <ul class="widget_list connectedSortable sortable_widget ui-sortable">
                <?php print_widget_item_list($mobile_system_left, $allLayoutWidget); ?>
            </ul>
            <div class="col_item_control">
                <div class="show_add_widget_mobile" title="<?=e('Add widget') ?>"></div>
            </div>
        </div>

        <div class="mobile_system_content">
            <!--mobile_system_top-->
            <div class='mobile_system_box mobile_system_top_box mobile_box' id='mobile_system_top'>
                <input type="hidden" value='' class='m_layout_system_widget_list'
                       name='m_layout_system_widget_list[mobile_system_top]'>
                <h3 class='center'><?=e('Mobile system top') ?></h3>
                <ul class="widget_list connectedSortable sortable_widget ui-sortable">
                    <?php print_widget_item_list($mobile_system_top, $allLayoutWidget); ?>
                </ul>
                <div class="col_item_control">
                    <div class="show_add_widget_mobile" title="<?=e('Add widget') ?>"></div>
                </div>
            </div>

            <!-- start main_content -->
            <div class='main_content_system_box' id='main_content_system'>
                <div class='note_system_content'>
                    <span><?=e('Header content') ?></span>
                </div>
            </div>

            <!--mobile_system_bottom-->
            <div class='mobile_system_box mobile_system_bottom_box mobile_box' id='mobile_system_bottom'>
                <input type="hidden" value='' class='m_layout_system_widget_list'
                       name='m_layout_system_widget_list[mobile_system_bottom]'>
                <h3 class='center'><?=e('Mobile system bottom') ?></h3>
                <ul class="widget_list connectedSortable sortable_widget ui-sortable">
                    <?php print_widget_item_list($mobile_system_bottom, $allLayoutWidget); ?>
                </ul>
                <div class="col_item_control">
                    <div class="show_add_widget_mobile" title="<?=e('Add widget') ?>"></div>
                </div>
            </div>
        </div>

        <!-- mobile_system_right -->
        <div class='mobile_system_box mobile_system_right_box _hide' id='mobile_system_right'>
            <input type="hidden" value='' class='m_layout_system_widget_list'
                   name='m_layout_system_widget_list[mobile_system_right]'>
            <h3 class='left'><?=e('Mobile system right') ?></h3>
            <ul class="widget_list connectedSortable sortable_widget ui-sortable">
                <?php print_widget_item_list($mobile_system_right, $allLayoutWidget); ?>
            </ul>
            <div class="col_item_control">
                <div class="show_add_widget_mobile" title="<?=e('Add widget') ?>"></div>
            </div>
        </div>
    </div>
    <!-- end navbar_container -->
</div>