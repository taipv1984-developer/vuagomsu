<?php 
class AddressHelper{
	/**
	 * getAllCountry
	 */
	public static function getAllCountry(){
		$countryDao = new CountryDao();
		$countryVo = new CountryVo();
		$countryVos = $countryDao->selectByFilter($countryVo, array('order' => 'ASC'));
		$country = array('' => e('Select a country'));
		foreach($countryVos as $k => $v){
			$country [$v->countryId] = $v->name;
		}
		return $country;
	}
	
	 /**
     * getAllState of countryId
     */
    public static function getAllState($countryId){
    	if($countryId == '' || $countryId == 0){
    		return array('' => e('---'));
    	}
    	$stateDao = new StateDao();
    	$stateVo = new StateVo();
    	$stateVo->countryId = $countryId;
    	$stateVos = $stateDao->selectByFilter($stateVo, array('order' => 'ASC'));
    	$state = array();
    	foreach($stateVos as $k => $v){
    		$state [$v->stateId] = $v->name;
    	}
    	if(count($state)== 0){
    		$first = array('' => e('---'));
    	}
    	else{
    		$first = array('' => e('Select a state'));
    	}
    	return($first + $state);
   }
     
     /**
     * getAllCity by stateId or countryId
     * first find by stateId, not found next find by countryId
     */
    public static function getAllCity($countryId, $stateId){
    	$stateId =($stateId != '')? $stateId : 0;
    	$countryId =($countryId != '')? $countryId : 0;
    	$cityDao = new CityDao();
    	if($stateId == 0 & $countryId == 0){					//no find
    		return array('' => e('---'));
    	}
    	else if($stateId != 0 & $countryId == 0){	//findByState
    		$cityVo = new CityVo();
    		$cityVo->stateId = $stateId;
    		$cityVos = $cityDao->selectByFilter($cityVo, array('order' => 'ASC'));
    	}
    	else if($stateId == 0 & $countryId != 0){	//findByCountry
    		$cityVo = new CityVo();
    		$cityVo->countryId = $countryId;
    		$cityVos = $cityDao->selectByFilter($cityVo, array('order' => 'ASC'));
    	}
    	else{			//findByState and findByCountry
	    	//1. find by stateId
	    	$cityVo = new CityVo();
	    	$cityVo->stateId = $stateId;
	    	$cityVos = $cityDao->selectByFilter($cityVo, array('order' => 'ASC'));
	    	if(!$cityVos){
	    		//2. find by countryId
	    		$cityVo = new CityVo();
	    		$cityVo->countryId = $countryId;
	    		$cityVos = $cityDao->selectByFilter($cityVo, array('order' => 'ASC'));
	    	}
    	}
    	$city = array();
    	foreach($cityVos as $k => $v){
    		$city [$v->cityId] = $v->name;
    	}
    	if(count($city)== 0){
    		$first = array('' => e('---'));
    	}
    	else{
    		$first = array('' => e('Select a city'));
    	}
    	return($first +  $city);
   }
    
    /**
     * getAllDistrict by cityId
     */
    public static function getAllDistrict($countryId, $stateId, $cityId){
    	if($cityId == '' || $cityId == 0){
    		return array('' => e('---'));
    	}
    	$citys = AddressHelper::getAllCity($countryId, $stateId);
    	if(count($citys)== 1){
    		return array('' => e('---'));
    	}
    	$districtDao = new DistrictDao();
    	$districtVo = new DistrictVo();
    	$districtVo->cityId = $cityId;
    	$districtVos = $districtDao->selectByFilter($districtVo, array('order' => 'ASC'));
    	$district = array();
    	foreach($districtVos as $k => $v){
    		$district [$v->districtId] = $v->name;
    	}
    	if(count($district)== 0){
    		 $first = array('' => e('---'));
    	}
    	else{
    		 $first = array('' => e('Select a district'));
    	}
    	return($first + $district);
   }
   
   public static function getAllCountryArray(){
	  	$sql = "select * from `country` order by `order` ASC";
	  	$output = array(
  			'type' => 'array', 
  			'key' => 'country_id',
  			'value' => 'name'		
  		);
	  	return DataBaseHelper::query($sql, array(), $output);
   }
   
   public static function getAllStateArray(){
   		$sql = "select * from `state` order by `order` ASC";
   		$output = array(
   			'type' => 'array',  	
   			'key' => 'state_id',
   			'value' => 'name'
   		);
   		return DataBaseHelper::query($sql, array(), $output);
   }
   
   public static function getAllCityArray(){
	   	$sql = "select * from `city` order by `order` ASC";
	   	$output = array(
   			'type' => 'array',  	
   			'key' => 'city_id',
	   		'value' => 'name'
	   	);
	   	return DataBaseHelper::query($sql, array(), $output);
   }
   
   public static function getAllDistrictArray(){
	   	$sql = "select * from `district` order by `order` ASC";
	   	$output = array(
   			'type' => 'array',  	
   			'key' => 'district_id',
	   		'value' => 'name'
	   	);
	   	return DataBaseHelper::query($sql, array(), $output);
   }

   	public static function getCountryName($countryId){
	   	$sql = "select * from `country` where country_id=$countryId";
	   	$query = DataBaseHelper::query($sql);
	   	return ($query) ? $query[0]->name : false;
   	}
   	public static function getStateName($stateId){
	   	$sql = "select * from `state` where state_id=$stateId";
	   	$query = DataBaseHelper::query($sql);
	   	return ($query) ? $query[0]->name : false;
   	}
   	public static function getCityName($cityId){
	   	$sql = "select * from `city` where city_id=$cityId";
	   	$query = DataBaseHelper::query($sql);
	   	return ($query) ? $query[0]->name : false;
   	}
   	public static function getDistrictName($districtId){
	   	$sql = "select * from `district` where district_id=$districtId";
	   	$query = DataBaseHelper::query($sql);
	   	return ($query) ? $query[0]->name : false;
   	}
}
?>