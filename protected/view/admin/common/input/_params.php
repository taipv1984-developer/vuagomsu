<?php
	$title = (isset($params['title']))? "title='{$params['title']}'" : '';
	$class = (isset($params['class']))? $params['class'] : '';
	$id = (isset($params['id']))? "id='{$params['id']}'" : '';
	$style = (isset($params['style']))? "style='{$params['style']}'" : '';
	$required = ($params['required'])? "required='required'" : "";
	
	$attr = '';
	if(isset($params['attr'])){
		foreach ($params['attr'] as $k => $v){
			$attr .= " $k='$v'";
		}
	}
?>