<?php

class ToolBarHelper {
    public $buttonLeft = array();
    public $buttonRight = array();
    public $buttonBack = array();
    public $buttonTool = array();
    public $paramsLeft = array();
    public $paramsRight = array();
    public $paramsBack = array();
    public $paramsTool = array();
    public $paramsAjax = array();
    public $buttonAjax = array();
    public $buttonExtra = array();
    public $icon;
    public $title;
    public $link;

    function addButtonLeft($buttonsLeft = array(), $paramsLeft = array()) {
        $this->buttonLeft += $buttonsLeft;
        $this->paramsLeft += $paramsLeft;
    }

    function addButtonRight($buttonsRight = array(), $paramsRight = array()) {
        $this->buttonRight += $buttonsRight;
        $this->paramsRight += $paramsRight;
    }

    function addButtonAjax($buttonAjax = array(), $paramsAjax = array()) {
        $this->buttonRight += $buttonAjax;
        $this->paramsRight += $paramsAjax;
    }

    function addButtonExtra($buttonsExtra = array()) {
        $this->buttonExtra = $buttonsExtra;
    }

    function addTitle($icon, $title, $link) {
        $this->icon = $icon;
        $this->title = $title;
        $this->link = $link;
    }

    function addButtonBack($buttonsBack = array(), $paramsBack = array()) {
        $this->buttonBack += $buttonsBack;
        $this->paramsBack += $paramsBack;
    }

    function addButtonTool($buttonsTool = array(), $paramsTool = array()) {
        $this->buttonTool += $buttonsTool;
        $this->paramsTool += $paramsTool;
    }

    function showToolBar() {
        $params = array(
            'buttonBack' => $this->buttonBack,
            'paramsBack' => $this->paramsBack,
            'buttonLeft' => $this->buttonLeft,
            'paramsLeft' => $this->paramsLeft,
            'buttonRight' => $this->buttonRight,
            'paramsRight' => $this->paramsRight,
            'buttonTool' => $this->buttonTool,
            'paramsTool' => $this->paramsTool,
            'buttonAjax' => $this->buttonAjax,
            'paramsAjax' => $this->paramsAjax,
            'buttonExtra' => $this->buttonExtra,
            'icon' => $this->icon,
            'title' => $this->title,
            'link' => $this->link,
        );
        TemplateHelper::getTemplate('common/tool_bar/tool_bar.php', $params);
    }
}