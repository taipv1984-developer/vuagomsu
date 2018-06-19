<?php
class TemplateHelper{
	/**
	 * 
	 * @param string $template Set the template will be called such as: button,input,breadcums
	 * @param string $area Set the area is admin or main, ... etc
	 * @param array $params params will be used by the template */
	public static function getTemplate($template, $params, $pluginCode=''){
        $pageType = Session::getPageType();
        $exp = explode('/', $template);
        $fileName = $exp[count($exp)-1];
        $posRow = strpos($fileName, '_row.php');
        if($posRow !== false){
            $template = str_replace($fileName, '_row.php', $template);
            $params['rowType'] = str_replace('_row.php', '', $fileName);
        }

        if($pageType == 'frontend'){
        	if($pluginCode == ''){
          	  	$filePath = FRONTEND_VIEW_PATH.Registry::getTemplate('templateName').'/'.$template;
        	}
        	else{
        		$filePath = PLUGIN_PATH."$pluginCode/view/frontend/".$template;
        	}
        	include $filePath;;
        }
        else{
            if($pluginCode == ''){
                $filePath = ADMIN_VIEW_PATH.$template;
            }
            else{
                $filePath = PLUGIN_PATH."$pluginCode/view/admin/".$template;
            }
            include $filePath;
       }
	}
    
    /**
     * renderForm from array setting
     * default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
     * add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
     * auto: type, label, name, value
     * 
     * @param array $settingForm 
     * $settingForm = array(
			'title'		=> array(),
			'showTitle'	=> array('type' => 'select', 'label' => 'Show title', 'options' => array('N' => 'No', 'Y' => 'Yes')),
			);
	* @param array(object)$settingValue value of item in settingForm($key of $values = $key of $settingForm)
	* $settingValue = array(
   			'showTitle' => 'N',
   		); 
   	* @param array $settingAll setting apply all item
	* $settingAll = array('cols' => '2-10');
     */
	public static function renderForm($settingForm, $settingValue=array(), $settingAll=array()){
		foreach($settingForm as $k => $v){
			//add parameter
			foreach($settingAll as $_k => $_v){
				if(!isset($v[$_k]))$v[$_k] = $_v;
			}
			
			//set default value field
			if(!isset($v['type']))$v['type'] 	= 'text';
			if(!isset($v['label']))$v['label'] = StringHelper::toUcfirst($k);
			if(!isset($v['name']))$v['name'] 	= $k;
			if(!isset($v['value'])){
				if(is_array($settingValue)){
					if(isset($settingValue[$k]))$v['value'] = $settingValue[$k];
				}
				else if(is_object($settingValue)){
					$vo =  StringHelper::toCamelCase($k);
					if(isset($settingValue->$vo))$v['value'] = $settingValue->$vo;
				}
			}
			
			//add modelName(apply for add/edit form)
			if(isset($v['model'])){
				if($v['type'] != 'hidden' & $v['type'] != 'submit' & $v['type'] != 'file'){
					$v['name'] 	= $v['model']. '.' .StringHelper::toCamelCase($v['name']);	//userModel.email
				}
			}
			self::getTemplate("common/input/{$v['type']}_row.php", $v);
		}
	}
	
	public static function renderProductItem($template, $productInfo, $params){
		$pathView = PLUGIN_PATH."shop/view/frontend/common/product/$template.php";
		include $pathView;
	}

	/**
	 * render table by $options, $table, $tool
	 * example view/admin/customer/manage
	 *  
	 * @param array $options
	 * $options = array(
			'model' => 'customerModel',
			'value' => $items->items,
			'id' => 'customerId'
		);
		model: model name of object => name filter = model.$key
		value(array2, array object): list data of object
		id: primary of table. apply write id for tool action...
	 * @param array $table include seting of col
	 * $table = array(
			array('heading' => array('key' => 'customerId', 'label' => 'ID', 'class' => 'sorting'),
					'filter' => array('type' => 'number', 'style' => 'width: 80px'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
			),
			...
		);
		'heading' => array('key')is required remain is option
		heading option: key, label, class, style
		filter option: show, type(edittext*, select), name, text, value, options, class, style
		tbody option: before_code, after_code, function, type(select, edittext, link, text*), href, class, style
	 * @param array $tool info col tool(support: linkEdit, linkDelete, linkView)
	 * $tool = array(
			'action' => array(
					'linkEdit' => 'index.php?r=admin/customer/edit&customerId=%s',
					'linkDelete' => 'index.php?r=admin/customer/delete',
			)
		);
	 */
	public static function renderTable($options, $table, $tool){
		TemplateHelper::getTemplate('common/input/_table.php', array(
			'options' 	=> $options,
			'table' 	=> $table,
			'tool' 		=> $tool
		));
	}
	
	public static function renderTable_getDefaultTableValue($table, $options){
		for($i=0; $i<count($table); $i++){
			//heading
			if(!isset($table[$i]['heading']['label']))$table[$i]['heading']['label'] = StringHelper::toUcfirst($table[$i]['heading']['key']);
			
			$table[$i]['heading']['key'] = StringHelper::toCamelCase($table[$i]['heading']['key']);
			$key = $table[$i]['heading']['key'];
			
			if(!isset($table[$i]['filter'])){
				$table[$i]['filter'] = array();
				$table[$i]['filter']['show'] = true;
			}
			if(!isset($table[$i]['tbody']))$table[$i]['tbody'] = array();
	
			//filter
            if(!isset($table[$i]['filter']['placeholder']))$table[$i]['filter']['placeholder'] = '';
			if(!isset($table[$i]['filter']['show']))$table[$i]['filter']['show'] = true;
			if(!isset($table[$i]['filter']['type']))$table[$i]['filter']['type'] = 'text';
			if(!isset($table[$i]['filter']['name'])){
				if(!isset($options['model'])){
					$table[$i]['filter']['name'] = $key;
				}
				else{
					$table[$i]['filter']['name'] = $options['model'].".".$key;
				}
			}
			if(!isset($table[$i]['filter']['value'])){
				if(!isset($options['model'])){
					$table[$i]['filter']['value'] = $_REQUEST[$key];
				}
				else{
					$table[$i]['filter']['value'] = CTTHelper::getRequestProperty($table[$i]['filter']['name']);
				}
			}
			if(!isset($table[$i]['filter']['text']))$table[$i]['filter']['text'] =  $table[$i]['heading']['label'];
		}
	
		return $table;
	}
	public static function renderTable_getDefaultToolValue($tool){
		if(!isset($tool['label']))$tool['label'] = 'Tool';
		if(!isset($tool['style'])){
			$tool['style'] = 'style="width: 8%"';
		}
		else{
			$tool['style'] = "style='".$tool['style']."'";
		}
		return $tool;
	}
	public static function renderTable_getStyle($style){
		if($style != null & $style != ''){
			return "style='$style'";
		}
		else{
			return '';
		}
	}
	public static function renderTable_getClass($class){
		if($class != null & $class != ''){
			return "class='$class'";
		}
		else{
			return '';
		}
	}
	
	/**
	 * render li tag for file multi
	 * 
	 * @param string $image
	 * @param int $index
	 */
	public static function renderInputMultiFile($image, $index, $action){
?>
	<li class='input_file input_file_<?=$index?>'>
		<div class="input_file_preview">
			<input type="hidden" class="image_source" value="<?=$image?>" id="image_list_<?=$index?>" name="image_list[]">
			<div class='image_preview_wrap image_center image_center_default'>
				<a class='fancybox image_preview_link' href='<?=$image?>' title='<?=e('Image preview')?>' rel="photos-lib">
					<img class="image_preview" src="<?=URLHelper::getImagePath($image, 'large')?>" alt='<?=e('Image preview')?>' title='<?=e('Image preview')?>'/>
				</a>
			</div>
		</div>
		<div class='clear'></div>
		
		<?php
            if($action){
                $filemanager_access_key = Session::getSession('filemanager_access_key');
        ?>
		<a class="btn btn-primary image_select popup" href="<?=URLHelper::getResource("resource/backend/js/filemanager/dialog.php?type=0&field_id=image_list_$index&akey=$filemanager_access_key")?>" title='<?=e('Image preview')?>' style="width: 100%">
			<?=e('Select image')?>
		</a>
		<div class='btn btn-danger image_remove right' id='image_remove'>
			<i class="fa fa-trash"></i>
		</div>    
		<?php }?>        
    </li>
<?php 
	}//end renderInputMultiFile function

    public static function renderRecursive($data, $pkName='id', $template, $params=array(), $parentId=0, $level=0, $levelMax=-1, $haveChild=true){
        if($levelMax != -1 && $level > $levelMax) return;

        $class = (isset($params['class'][$level])) ? "class='{$params['class'][$level]} ul_$level'" : "class='ul_$level'";
        $id = (isset($params['id'][$level])) ? "id='{$params['id'][$level]}'" : "";
        $attributes = (isset($params['attributes'][$level])) ? $params['attributes'][$level] : "";
        $container = (isset($params['container'])) ? $params['container'] : 'ul';

        if($haveChild){
            echo ($container == 'ul') ? "<ul $class $id $attributes>\n" : "<div $class $id $attributes>\n";
        }
        foreach($data as $v){
            if($v['parentId'] == $parentId){
                $level++;
                include $template;
                self::renderRecursive($data, $pkName, $template, $params, $v[$pkName], $level, $levelMax, $v['haveChild']);
                $level--;
                echo ($container == 'ul') ? "</li>\n" : "</div>\n";
            }
        }
        if($haveChild){
            echo ($container == 'ul') ? "</ul> <!-- end .ul_$level -->\n" : "</div> <!-- end .ul_$level -->\n";
        }
    }

	public static function renderLayout($data, $parentId, $level, $levelMax, $haveChild, $template, $params){
		if($levelMax != 0 && $level > $levelMax) return;
	
		$class = (isset($params['class'][$level])) ? "class='{$params['class'][$level]} ul_$level'" : "class='ul_$level'";
		$id = (isset($params['id'][$level])) ? "id='{$params['id'][$level]}'" : "";
		$attributes = (isset($params['attributes'][$level])) ? $params['attributes'][$level] : "";
		$container = (isset($params['container'])) ? $params['container'] : 'ul';
	
		if($haveChild){
			echo ($container == 'ul') ? "<ul $class $id $attributes>\n" : "<div $class $id $attributes>\n";
		}
		foreach($data as $v){
			if($v['parentId'] == $parentId){
                if(!$v['fluidContainer']) echo "<div class='container'>";
				$level++;
				include $template;
				self::renderLayout($data, $v['id'], $level, $levelMax, $v['haveChild'], $template, $params);
				$level--;
                if(!$v['fluidContainer']) echo "</div> <!-- end .container-->";
				echo ($container == 'ul') ? "</li>\n" : "</div>\n";
			}
		}
		if($haveChild){
			echo ($container == 'ul') ? "</ul> <!-- end .ul_$level -->\n" : "</div> <!-- end .ul_$level -->\n";
		}
	}
}?>