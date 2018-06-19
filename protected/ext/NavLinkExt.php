<?php
class NavLinkExt{
	/**
	 * get all menu of admin only in nav_link table
	 *
	 * @return array
	 */
	public static function getNavLink(){
		$sql = "select n.*, p.`status` as plugin_status
from nav_link as n
left join `plugin` as p on p.plugin_code=n.plugin_code
order by n.order ASC";
		$navLinkList = DataBaseHelper::query($sql);

        $navLinkList = ArrayHelper::objectToArray($navLinkList);

		//check have children
		foreach($navLinkList as $key => $value){
			//add common field
			$navLinkList[$key]['id'] = $navLinkList[$key]['navLinkId'];
			//$navLinkList[$key]['name'] = $navLinkList[$key]['name'];
				
			//add haveChild
			$navLinkList[$key]['haveChild'] = false;
			foreach($navLinkList as $k => $v){
				if($v['parentId'] == $value['navLinkId']){
					$navLinkList[$key]['haveChild'] = true;
					break;
				}
			}
		}

        return ArrayHelper::recursive( $navLinkList);
	}
	
	public static function getNavLinkByTitle($title){
		$sql = "select * from `nav_link` where `title`='$title'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	/**
	 * addNavLink
	 * $params = array(
		 'link' => '',
		 'title' => '',
		 'icon' => '',			//fa icon
		 'level' => '',			//0, 1
		 'parentId' => '',		//0...
		 'order' => '',			//0...
		 'status' => '',		//A, D
		 'pluginCode' => '',
	 );
	 */
	public static function addNavLink($params){
		$navLinkDao = new NavLinkDao();
		$navLinkVo = new NavLinkVo();
		foreach ($params as $k => $v){
			$navLinkVo->$k = $v;
		}
		//check exist
		$navLinkVos = $navLinkDao->selectByFilter($navLinkVo);
		if(!$navLinkVos){
			$navLinkId = $navLinkDao->insert($navLinkVo);
			return $navLinkId;
		}
	}
	
	/**
	 * deleteNavLink by $params
	 * @param array $params[pluginCode...]
	 */
	public static function deleteNavLink($params){
		$navLinkDao = new NavLinkDao();
		$navLinkVo = new NavLinkVo();
		foreach ($params as $k => $v){
			$navLinkVo->$k = $v;
		}
		$navLinkDao->deleteByFilter($navLinkVo);
	}
}