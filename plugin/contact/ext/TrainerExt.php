<?php
class TrainerExt{
	public static function getTrainerArray($status='A'){
		$trainerDao = new TrainerDao();
		$trainerVo = new TrainerVo();
		$trainerVo->status = $status;
		$trainerVos = $trainerDao->selectByFilter($trainerVo);
		
		$trainerArray = array();
		foreach ($trainerVos as $v){
			$trainerArray[$v->trainerId] = $v->name;
		}
		
		return $trainerArray;
	}
}