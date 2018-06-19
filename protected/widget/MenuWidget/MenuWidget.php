<?php
class MenuWidget{
	private $widgetController;
	private $layoutWidgetInfo;
	
	/**
	 * __construct of widget
	 */
	function __construct($layoutWidgetInfo){
		$this->widgetController = get_class($this);
		$this->layoutWidgetInfo = $layoutWidgetInfo;
	}
	
	/**
	 * Display input from in admin side
	 */ 
    public function form(){
   	 	if($this->layoutWidgetInfo){
    		$setting = json_decode($this->layoutWidgetInfo->setting, true);
    	}
		
    	//add data
    	$menuArray = MenuExt::getMenuArray();
    	
    	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
    	//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
    	$settingForm = array(
    		'layout_widget_id' 	=> array('type' => 'hidden', 'value' => $this->layoutWidgetInfo->layoutWidgetId),
    		'widget_controller' => array('type' => 'hidden', 'value' => $this->widgetController),
    		
    		'header' 	=> array('type' => 'custom', 'value' => "<h4 class='widget_header col-md-12'>{$this->widgetController}</h4>", 'label' => ''),
    		'title'		=> array(),
    		'show_title'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'class'		=> array(),
    		'menuId'	=> array('type' => 'select', 'label' => 'Menu', 'required' => true, 'options' => $menuArray),
    		'style'	=> array('type' => 'select', 'options' => ApplicationConfigHelper::get('menu.style')),
    	);
        $settingAll = array(
            'cols' => '3-9'
        );
    	//render setting from
        TemplateHelper::renderForm($settingForm, $setting, $settingAll);
        TemplateHelper::getTemplate('layout/_extra/add_setting.php', $setting);
   	}
   	
   	/**
   	 * View widget in frontend
   	 */
   	public function view(){
   		//get setting
   		if($this->layoutWidgetInfo){
   			$setting = json_decode($this->layoutWidgetInfo->setting, true);
   		}
   		
   		//add info
   		$menuId = $setting['menuId'];
   		$menuItem = MenuExt::getMenuItem($menuId);
   		$isSingleMenu = (count($menuItem) == 1) ? true : false;
   		//update $menuItem for menu type case
   		foreach ($menuItem as $k => $v){
   			$type = $v['type'];
   			$params = ($v['params'] != '') ? json_decode($v['params'], true) : array();
   			switch ($type){
   				case 'category_link':
   					//get params
   					$create_submenu = $params['create_submenu'];
   					$category_id = $params['category_id'];
   					$number_of_category = $params['number_of_category'];
   					$skip_category = ($params['skip_category'] != '') ? $params['skip_category'] : 0;
   					$order_by = $params['order_by'];
   					$order_direction = $params['order_direction'];
   					if($create_submenu){
   						//get all category child of $category_id
   						if($number_of_category == '' || ($number_of_category <= 0)){
   							$limit = ''; 
   						}
   						else{
   							$limit = "limit $number_of_category";
   						}
   						$sql = "select category_id, name 
                            from category
                            where parent_id=$category_id and category_id not in ($skip_category)
                            order by $order_by $order_direction
                            $limit";
   						$categoryList = DataBaseHelper::query($sql);
   						if(count($categoryList) > 0){
   							if($isSingleMenu){
	   							$menuItem = array();
		   					}
		   					else{
	   							//set haveChild
	   							$menuItem[$k]['haveChild'] = true;
		   					}
   							//add to $menuItem
                            $index = max(array_keys($menuItem));
	   						$order = 0;
	   						foreach ($categoryList as $categoryInfo){
                                $index++;
	   							$order++;
	   							$menuItem[$index] = array(
	   								'menuId' => $v['menuId'],
	   								'id' => $index,
	   								'link' => URLHelper::getProductListPage($categoryInfo->categoryId),
	   								'title' => $categoryInfo->name,
	   								'parentId' => ($isSingleMenu) ? 0 : $v['id'],
	   								'order' => $order,
	   								'level' => ($isSingleMenu) ? 0 : $v['level'] + 1,
	   								'icon' => '',
	   								'type' => 'custom_link',
	   								'params' => '[]',
	   								'haveChild' => false,
	   							);
	   						}
   						}
   					}
   					break;
                case 'category_all_link':
                    //setting parent
                    $menuItem[$k]['haveChild'] = true;
                    $menuItem[$k]['link'] = 'javascript:void()';

                    //get $categoryList
                    $categoryList = CategoryExt::getCategoryList();

                    //add to $menuItem
                    $index = max(array_keys($menuItem));
                    $order = 0;
                    foreach ($categoryList as $categoryInfo){
                        $index++;
                        $order++;
                        $menuItem[$index] = array(
                            'menuId' => $v['menuId'],
                            'id' => $index,
                            'link' => URLHelper::getProductListPage($categoryInfo['categoryId']),
                            'title' => $categoryInfo['name'],
                            'parentId' => ($categoryInfo['parentId']) ? $categoryInfo['parentId'] : $k,    //update later
                            'order' => $order,
                            'level' => $categoryInfo['level'] + 1,
                            'icon' => $categoryInfo['icon'],
                            'type' => 'category_all_link',
                            'params' => '[]',
                            'haveChild' => $categoryInfo['haveChild'],
                            'categoryId' => $categoryInfo['categoryId'], //+
                        );
                    }

                    foreach ($menuItem as $kMenu => $vMenu){
                        foreach ($menuItem as $kMenu2 => $vMenu2){
                            if($vMenu['categoryId'] == $vMenu2['parentId'] && $vMenu['type'] == 'category_all_link' && $vMenu2['type'] == 'category_all_link'){
                                $menuItem[$kMenu2]['parentId'] = $vMenu['id'];
                            }
                        }
                    }
                    break;
   			}
   		}
   		$setting['menuItem'] = $menuItem;

   		//view
        include "view.php";
   	}

   	/**
   	 * Load .css file to head or footer position of file. Called when the website render
   	 */
   	public function loadStyle(){
   		return null;
   	}
   	
   	/**
   	 * Load .js file to head or footer position of file. Called when website render
   	 */
   	public function loadScript(){
   		return null;
   	}
}
