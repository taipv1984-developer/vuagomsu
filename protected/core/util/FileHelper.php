<?php 
class FileHelper{
	/**
	 * load controller file
	 * 
	 * @param string $controller name of controller		AdminExtensionController
	 * @param string $pageType(admin|frontend)
	 * @param string $pluginCode of plugin
	 * @return require_once protected/controller/admin/AdminExtensionController.php
	 */
	public static function loadController($controller, $pageType, $pluginCode){
		if($pluginCode == ''){	//default
			$file = PROTECTED_PATH."controller/$pageType/$controller.php";
		}
		else{
			$file = PLUGIN_PATH."$pluginCode/controller/$pageType/$controller.php";
		}
		if(file_exists($file)){
			FileHelper::loadFile($file);
		}
		else{
			LogUtil::devInfo("[FileHelper::loadController] actionControler = $controller ... pageType = $pageType ...file = $file");
		}	
	}

	/**
	 * require_once filePath 
	 * 
	 * @param string $filePath full path
	 * @return string $vqFile
	 */
	public static function loadFile($filePath){
		require_once $filePath;
	}

    public static function loadDir($pluginCode, $dirName)
    {
        $dir = PLUGIN_PATH."$pluginCode/$dirName/";
        $cdir = scandir($dir);
        foreach ($cdir as $fileName) {
            $fileExt = substr($fileName, strpos($fileName, '.') + 1);
            if ($fileExt == 'php') {
                self::loadFile($dir.$fileName);
            }
        }
    }

    public static function loadPlugin($pluginCode)
    {
        //get $pluginLoaded from session
        $pluginLoaded = Session::getSession('pluginLoaded');
        if($pluginLoaded == null){
            $pluginLoaded = [];
        }

        if(!isset($pluginLoaded[$pluginCode])){
            $pluginLoaded[$pluginCode] = $pluginCode;

            //loadPlugin
            $loadDirList = array(
                'persistence/vo',
                'persistence/dao',
                'model',
                'ext',
                'helper',
                'util'
            );
            foreach ($loadDirList as $dir) {
                self::loadDir($pluginCode, $dir);
            }

            //update $pluginLoaded to session
            Session::setSession('pluginLoaded', $pluginLoaded);
        }
    }

	/**
	 * Load widget controller file
	 * 
	 * @param object $layoutWidgetInfo
	 */
	public static function loadWidget($layoutInfo){
		if($layoutInfo){
			$widgetController = $layoutInfo->controller;
			$pluginCode = $layoutInfo->pluginCode;

            //load controller
			if($pluginCode == '' || $pluginCode == null){	//default
				$widgetFile = WIDGET_PATH."$widgetController/$widgetController.php";
			}
			else{
				$widgetFile = PLUGIN_PATH."$pluginCode/widget/$widgetController/$widgetController.php";
			}
			self::loadFile($widgetFile);

            //load plugin
            if($pluginCode != '' & $pluginCode != null) {
                self::loadPlugin($pluginCode);
            }
		}
		else{
			LogUtil::devInfo("[FileHelper::loadWidget] not exist widget have widgetController");
		}
	}

    public static function loadWidgetByController($widgetController, $pluginCode){
        if($pluginCode == '' || $pluginCode == null){	//default
            $widgetFile = WIDGET_PATH."$widgetController/$widgetController.php";
        }
        else{
            $widgetFile = PLUGIN_PATH."$pluginCode/widget/$widgetController/$widgetController.php";
        }
        self::loadFile($widgetFile);
    }
	
	public static function loadWidgetLayout($layoutWidgetInfo){
		if($layoutWidgetInfo){
			$widgetController = $layoutWidgetInfo->widgetController;
			$pluginCode = $layoutWidgetInfo->pluginCode;

			//load controller
			if($pluginCode == '' || $pluginCode == null){	//default
				$widgetFile = WIDGET_PATH."$widgetController/$widgetController.php";
			}
			else{
				$widgetFile = PLUGIN_PATH."$pluginCode/widget/$widgetController/$widgetController.php";
			}
			self::loadFile($widgetFile);

			//load plugin
            if($pluginCode != '' & $pluginCode != null) {
                self::loadPlugin($pluginCode);
            }
		}
		else{
			LogUtil::devInfo("[FileHelper::loadWidgetLayout] not exist widget have widgetController");
		}
	}
	
    public static function dirToFiles($dir, &$result, $levelMax=0, $level=0) {
	    if($level==null)$level=0;
        if($levelMax==null)$levelMax=0;
        if($level >= $levelMax & $levelMax != 0) return;

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $level++;
                    self::dirToFiles($dir . DIRECTORY_SEPARATOR . $value, $result, $levelMax, $level);
                    $level--;
                } else {
                    $filePath = $dir . DIRECTORY_SEPARATOR . $value;
                    $result [] = $filePath;
                }
            }
        }
    }

    /**
     * extract a file(.zip)to $extractDir
     *
     * @param string $filePath full path of file
     * @param string $extractDir	//default='' 	extract to the current dir of $file
     */
	public static function extractFile($filePath, $extractDir=''){
		$fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
		$fileName = strtolower(pathinfo($filePath, PATHINFO_FILENAME));
		$extractDir = ($extractDir == '')? strtolower(pathinfo($filePath, PATHINFO_DIRNAME))."/$fileName/" : $extractDir;
		
		//extractFile
        switch($fileType){
        	case 'zip';
	        	$zip = new ZipArchive;
				$zip->open($filePath);
				$zip->extractTo($extractDir);		
				$zip->close();
				break;
        	default:
        		LogUtil::devInfo("File type = $fileType not support extract");
        		return false;
        		break;
       }//end switch
        
        return true;
	}

	/**
	 * read all lines of file after + to string
	 * 
	 * @param string $file
	 * @param string $charJoin
	 * @return string
	 */
	public static function toString($file, $charJoin="\n"){
		$str = '';
		
		$myfile = fopen($file, 'r')or die("Unable to open file!(2)");
		while(!feof($myfile)){
		  	$line = str_replace("\n", '', fgets($myfile));
		  	$str .= $line.$charJoin;
		}
		fclose($myfile);
		
		return $str;
	}

	/**
	 * create ALL new dir of $dir it not exist
	 * 
	 * @param string $dir
	 */
	public static function mkdir($dir){
		$dir = str_replace('\\', '/', $dir);
		$exp = explode('/', $dir);
		$mkDir = '';
		foreach($exp as $v){
			$mkDir .= $v.'/';
			if(!is_dir($mkDir)){
				mkdir($mkDir);
			}
		}
	}
	
	/**
	 * copy from $fileSource to $fileTarget
	 * create new dir of $fileTarget it not exist
	 * 
	 * @param string $fileSource
	 * @param string $fileTarget
	 */
	public static function copy($fileSource, $fileTarget){
		//step1: create folder in $fileTarget path
		$fileTarget = str_replace('\\', '/', $fileTarget);
		$dirTarget = pathinfo($fileTarget, PATHINFO_DIRNAME);
		self::mkdir($dirTarget);
		
		//step2: copy
		copy($fileSource, $fileTarget);
	}
	
	/**
	 * delete all file and folder of dir
	 * 
	 * @param string $dir
	 */
	public static function deleteAll($dir){
	    if(is_file($dir)){
	        return @unlink($dir);
	   }
	    elseif(is_dir($dir)){
	        $scan = glob(rtrim($dir,'/').'/*');
	        foreach($scan as $index => $path){
	            self::deleteAll($path);
	       }
	   }
	}
	
	/**
	 * write $content to $file
	 * 
	 * @param string $file
	 * @param string $content
	 */
	public static function write($file, $content){
		$fp = @fopen($file, "w");
		@fwrite($fp, $content);
		@fclose($fp);
	}
	
	/**
	 * append $content to $file
	 * 
	 * @param string $file
	 * @param string $content
	 */
	public static function append($file, $content){
		$fp = @fopen($file, "a");
		@fwrite($fp, $content);
		@fclose($fp);
	}
	
	/**
	 * open $file after write $content to
	 * 
	 * @param string $file
	 * @param string $content
	 * @param string $option w* | a ...
	 */
	public static function open($file, $content, $option='w'){
		$fp = @fopen($file, $option);
		@fwrite($fp, $content);
		@fclose($fp);
	}
	
	/**
	 * make thumb for image (current support .jpg only)
	 * 
	 * @param string $src
	 * @param string $dest
	 * @param int $imageWidth (100px)
	 */
	public static function makeThumb($src, $dest, $imageWidth=100) {
		/* read the source image */
		$source_image = imagecreatefromjpeg($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($imageWidth / $width));
		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($imageWidth, $desired_height);
		
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $imageWidth, $desired_height, $width, $height);
		
		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image, $dest);
	}
}
?>