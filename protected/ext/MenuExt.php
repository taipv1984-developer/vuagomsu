<?php
class MenuExt{
	/*****************************************
	 * MenuItem
	 ****************************************/
	/**
	 * get all menu item from menu table
	 *
	 * @return array
	 */
	public static function getMenuItem($menuId){
		$sql = "select * from menu_item
where menu_id=$menuId
order by `order` ASC";
		$query = DataBaseHelper::query($sql);
		$menus = array();
		foreach($query as $k => $v){
			$menus[$v->menuItemId] = array(
				'menuId' => $v->menuId,
				'id' => $v->menuItemId,
				'link' => $v->link,
				'title' => $v->title,
				'parentId' => $v->parentId,
				'order' => $v->order,
				'level' => $v->level,
				'icon' => $v->icon,
                'class' => $v->class,
				'type' => $v->type,
				'params' => $v->params,
			);
		}
		
		//check have children
		foreach($menus as $key => $value){
			$menus[$key]['haveChild'] = false;
			foreach($menus as $k => $v){
				if($v['parentId'] == $key){
					$menus[$key]['haveChild'] = true;
					break;
				}
			}
		}
		
		$newMenus = array();
		$newMenus = ArrayHelper::dequi($newMenus, $menus, 0);
		return $newMenus;
	}
	
	/**
	 * delete menu at $menuId position and child of this
	 * 
	 * @param int $menuId
	 */
	public static function deleteMenuItem($menuItemId){
		//delete all child
		$sql = "delete from menu_item where parent_id=$menuItemId";
		DataBaseHelper::query($sql, null, null);
		
		//delete this
		$sql = "delete from menu_item where menu_item_id=$menuItemId";
		DataBaseHelper::query($sql, null, null);
	}
	
	/*****************************************
	 * Menu
	 ****************************************/
	public static function getMenuInfo($menuId){
		$sql = "select * from menu
where menu_id=$menuId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getMenuList(){
		$sql = "select * from menu";
		return DataBaseHelper::query($sql);
	}
	
	public static function getMenuArray(){
		$sql = "select * from menu";
		$output = array(
			'type' => 'array',
			'key' => 'menu_id',
			'value' => 'name'
		);
		return DataBaseHelper::query($sql, array(), $output);
	}
	
	public static function deleteMenu($menuId){
		//delete menu item
		$sql = "delete from menu_item where menu_id=$menuId";
		DataBaseHelper::query($sql, null, null);
	
		//delete menu
		$sql = "delete from menu where menu_id=$menuId";
		DataBaseHelper::query($sql, null, null);
	}
}