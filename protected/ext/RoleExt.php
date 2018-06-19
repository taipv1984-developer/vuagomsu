<?php
class RoleExt{
	/**
	 * getRoleList
	 * 
	 * @param string $roleType
	 * @return list
	 */
	public static function getRoleList($roleType=''){
		$sql = ($roleType == '') ? "select * from `role`" : "select * from `role` where role_type=:roleType";
		$params = array(
			array(':roleType', $roleType, 'str')
		);
		return DataBaseHelper::query($sql, $params);
	}
	
	/**
	 * getRoleArray 
	 * 
	 * @param string $roleType
	 * @return $roleArray[$v->roleId] = $v->roleName
	 */
	public static function getRoleArray($roleType=''){
		$sql = ($roleType == '') ? "select * from `role`" : "select * from `role` where role_type=:roleType";
		$params = array(
			array(':roleType', $roleType, 'str')
		);
		$query = DataBaseHelper::query($sql, $params);
		
		$roleArray = array();
		foreach ($query as $v){
			$roleArray[$v->roleId] = $v->roleName;
		}
		return $roleArray;
	}
	
	/**
	 * getPermission from $roleId
	 * 
	 * @param int $roleId
	 * @return array
	 */
	public static function getPermission($roleId){
		$sql = "select r.*, rp.permission
from role as r
left join role_permission as rp on rp.role_id=r.role_id
where r.role_id=:roleId";
		$params = array(
			array(':roleId', $roleId)
		);
		$query = DataBaseHelper::query($sql, $params);
		$permission = $query[0]->permission;
		return ($permission == '' || $permission == '[]') ? array() : json_decode($permission);
	}
	
	/**
	 * getAdminList have role_id=$roleId
	 *  
	 * @param int $roleId
	 * @return bool | list
	 */
	public static function getAdminList($roleId){
		$sql = "select * from admin where role_id=:roleId";
		$params = array(
			array(':roleId', $roleId)
		);
		return DataBaseHelper::query($sql, $params);
	}
	
	/**
	 * getCustomerList have role_id=$roleId
	 *
	 * @param int $roleId
	 * @return bool | list
	 */
	public static function getCustomerList($roleId){
		$sql = "select * from customer where role_id=:roleId";
		$params = array(
			array(':roleId', $roleId)
		);
		return DataBaseHelper::query($sql, $params);
	}
	
	/**
	 * delete role and role_permission with $roleId
	 * 
	 * @param int $roleId
	 */
	public static function deleteRole($roleId){
		//delete role
		$sql = "delete from `role` where role_id=:roleId";
		$params = array(
			array(':roleId', $roleId)
		);
		DataBaseHelper::query($sql, $params, null);
		
		//delete role_permission
		$sql = "delete from `role_permission` where role_id=:roleId";
		$params = array(
				array(':roleId', $roleId)
		);
		DataBaseHelper::query($sql, $params, null);
	}
}