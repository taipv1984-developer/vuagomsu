<?php
class AdminExt{
	/**
	 * getAdminList by $filter array apply for filter in manage page
	 * 
	 * @param array $filter = array('admin_id' => $adminId, 'email' => arrray('like', $mail))
	 * @param array $orderBy
	 * @param int $start
	 * @param int $recSize
	 * @return list
	 */
	public static function getAdminList($filter, $orderBy, $start, $recSize){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$orderCondition = DataBaseHelper::getOrderCondition($orderBy);
		$limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
		
		$sql = "select a.*, ad.*, a.admin_id as adminId
		from admin as a
		left join admin_detail as ad on a.admin_id=ad.admin_id
		$whereCondition $orderCondition $limitCondition";
		 
		return DataBaseHelper::query($sql);
	}
	
	/**
	 * delete admin and admin_detail with $adminId
	 *
	 * @param int $adminId
	 */
	public static function deleteAdmin($adminId){
		//delete admin
		$sql = "delete from `admin` where admin_id=:adminId";
		$params = array(
			array(':adminId', $adminId)
		);
		DataBaseHelper::query($sql, $params, null);
	
		//delete admin_detail
		$sql = "delete from `admin_detail` where admin_id=:adminId";
		$params = array(
			array(':adminId', $adminId)
		);
		DataBaseHelper::query($sql, $params, null);
	}
	
	public static function getAdminUserName($adminId){
		//delete admin
		$sql = "select username from `admin` where admin_id=:adminId";
		$params = array(
				array(':adminId', $adminId)
		);
		$query = DataBaseHelper::query($sql, $params);
		return ($query) ? $query[0]->username : '';
	}
}