<?php
session_start();
mb_internal_encoding('UTF-8');
// date_default_timezone_set('Europe/Rome');

/*
|--------------------------------------------------------------------------
| Optional security
|--------------------------------------------------------------------------
|
| if set to true only those will access RF whose url contains the access key(akey) like:
| <input type="button" href="../filemanager/dialog.php?field_id=imgField&lang=en_EN&akey=myPrivateKey" value="Files">
| in tinymce a new parameter added: filemanager_access_key:"myPrivateKey"
| example tinymce config:
|
| tiny init ...
| external_filemanager_path:"../filemanager/",
| filemanager_title:"Filemanager" ,
| filemanager_access_key:"myPrivateKey" ,
| ...
|
*/

define('USE_ACCESS_KEYS', true); // TRUE or FALSE
//change    line 208    'access_keys' => array(),

/*
|--------------------------------------------------------------------------
| DON'T COPY THIS VARIABLES IN FOLDERS config.php FILES
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Path configuration
|--------------------------------------------------------------------------
| In this configuration the folder tree is
| root
|    |- source <- upload folder
|    |- thumbs <- thumbnail folder [must have write permission (755)]
|    |- filemanager
|    |- js
|    |   |- tinymce
|    |   |   |- plugins
|    |   |   |   |- responsivefilemanager
|    |   |   |   |   |- plugin.min.js
*/

/**************************************
start my config (ZPham)
**************************************/
//get upload setting from  $_SESSION
//...

//get upload permission from  $_SESSION
$my_permission = array(
	'create_folders'     => true,
	'rename_folders'     => true,
	'copy_cut_dirs'      => true,
	'delete_folders'     => true,
	'chmod_dirs'         => true,
	
	'upload_files'       => true,
	'rename_files'       => true,
	'copy_cut_files'     => true,
	'duplicate_files'    => true,
	'delete_files'       => true,
	'chmod_files'        => true,
	
	'preview_text_files' => true,
	'edit_text_files'    => true,
	'create_text_files'  => true,
);

//get upload path
$my_upload_folder = 'upload/images';
$my_base_url = $_SESSION['SW_SESSION_GROUP']['BASE_URL'];		//CPrepareParamFilter
$my_current_folder= "../../../../$my_upload_folder/";				//path upload image
$my_medium_folder = "/$my_upload_folder/medium/";			//path upload image thumb (medium)
$my_small_folder  = "/$my_upload_folder/small/";
$my_large_folder  = "/$my_upload_folder/large/";
/**
 * add config (version current not support config thumbnail size (default 122x91) and method create thumb (default crop)
 * modify file list:
 * 		upload.php		create_img($targetFile, $targetFileThumb, 122, 91)
 * 		dialog.php		if(!create_img($file_path, $src_thumb, 122, 91)){
 * 						if($img_width<122 && $img_height<91){
 * 		ajax_calls.php	create_img($current_path . $_POST['path'] . $_POST['name'], $thumbs_base_path.$_POST['path'].$_POST['name'], 122, 91);
 * 
 *  $option:     
 	  	0 / exact = defined size;
		1 / portrait = keep aspect set height;
		2 / landscape = keep aspect set width;
		3 / auto = auto;
		4 / crop= resize and crop;
 */

$my_thumbnail_config = array(
	'option_resize' => isset($_SESSION['SW_SESSION_GROUP']['option_resize']) ? $_SESSION['SW_SESSION_GROUP']['option_resize'] : 3,
	'image_small' => array(
		'width' => isset($_SESSION['SW_SESSION_GROUP']['image_small_width']) ? $_SESSION['SW_SESSION_GROUP']['image_small_width'] : 90,
		'height' => isset($_SESSION['SW_SESSION_GROUP']['image_small_height']) ? $_SESSION['SW_SESSION_GROUP']['image_small_height'] : 90,
	),
	'image_large' => array(
		'width' => isset($_SESSION['SW_SESSION_GROUP']['image_large_width']) ? $_SESSION['SW_SESSION_GROUP']['image_large_width'] : 270,
		'height' => isset($_SESSION['SW_SESSION_GROUP']['image_large_height']) ? $_SESSION['SW_SESSION_GROUP']['image_large_height'] : 270,
	),
	'image_max' => array(
		'width' => isset($_SESSION['SW_SESSION_GROUP']['image_max_width']) ? $_SESSION['SW_SESSION_GROUP']['image_max_width'] : 1000,
		'height' => isset($_SESSION['SW_SESSION_GROUP']['image_max_height']) ? $_SESSION['SW_SESSION_GROUP']['image_max_height'] : 1000,
	),
);

function my_message($message, $log_file='D:\wamp\www\dato-ec\dato-ec.filemanage.log'){
	if(is_array($message)){
		$mes = "Array content \n";
		foreach ($message as $k => $v){
			$mes .= "\tarray[$k] = $v\n";
		}
		$message = $mes;
	}
	else if(is_object($message)){
		$objectName = get_class($message);
		$mes = "$objectName object content \n";
		foreach ($message as $k => $v){
			$mes .= "\t$objectName->$k = {$message->$k}\n";
		}
		$message = $mes;
	}
	$message = "[" . date('d-m h:m:s') . "] " . $message;
	$fp = @fopen($log_file, "a");
	if (!is_resource($fp))
		return false;
	@fwrite($fp, $message . "\n");
	@fclose($fp);
}
/**************************************
end  my config (ZPham)
**************************************/

$config = array(

	/*
	|--------------------------------------------------------------------------
	| DON'T TOUCH (base url (only domain) of site).
	|--------------------------------------------------------------------------
	|
	| without final /
	|
	*/

	//'base_url' => ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && ! in_array(strtolower($_SERVER['HTTPS']), array( 'off', 'no' ))) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'],
	'base_url' => $my_base_url.'/',
	

	/*
	|--------------------------------------------------------------------------
	| path from base_url to base of upload folder
	|--------------------------------------------------------------------------
	|
	| with start and final /
	|
	*/
	//'upload_dir' => '/source/',
	'upload_dir' => $my_upload_folder.'/',

	/*
	|--------------------------------------------------------------------------
	| relative path from filemanager folder to upload folder
	|--------------------------------------------------------------------------
	|
	| with final /
	|
	*/
	//'current_path' => '../source/',
	'current_path' => $my_current_folder,

	/*
	|--------------------------------------------------------------------------
	| relative path from filemanager folder to thumbs folder
	|--------------------------------------------------------------------------
	|
	| with final /
	| DO NOT put inside upload folder
	|
	*/
	//'thumbs_base_path' => '../thumbs/',
// 	'thumbs_base_path' => $my_medium_folder,
//  'thumbs_base_path' => $my_current_folder,
	'thumbs_base_path' => './',

	/*
	|--------------------------------------------------------------------------
	| Access keys
	|--------------------------------------------------------------------------
	|
	| add access keys eg: array('myPrivateKey', 'someoneElseKey');
	| keys should only containt (a-z A-Z 0-9 \ . _ -) characters
	| if you are integrating lets say to a cms for admins, i recommend making keys randomized something like this:
	| $username = 'Admin';
	| $salt = 'dsflFWR9u2xQa' (a hard coded string)
	| $akey = md5($username.$salt);
	| DO NOT use 'key' as access key!
	| Keys are CASE SENSITIVE!
	|
	*/

	//'access_keys' => array(),
    'access_keys' => array($_SESSION['SW_SESSION_GROUP']['filemanager_access_key']),

	//--------------------------------------------------------------------------------------------------------
	// YOU CAN COPY AND CHANGE THESE VARIABLES INTO FOLDERS config.php FILES TO CUSTOMIZE EACH FOLDER OPTIONS
	//--------------------------------------------------------------------------------------------------------

	/*
	|--------------------------------------------------------------------------
	| Maximum upload size
	|--------------------------------------------------------------------------
	|
	| in Megabytes
	|
	*/
	'MaxSizeUpload' => 100,


	/*
	|--------------------------------------------------------------------------
	| default language file name
	|--------------------------------------------------------------------------
	*/
	'default_language' => "en_EN",

	/*
	|--------------------------------------------------------------------------
	| Icon theme
	|--------------------------------------------------------------------------
	|
	| Default available: ico and ico_dark
	| Can be set to custom icon inside filemanager/img
	|
	*/
	'icon_theme' => "ico",


	//Show or not show folder size in list view feature in filemanager (is possible, if there is a large folder, to greatly increase the calculations)
	'show_folder_size'                        => true,
	//Show or not show sorting feature in filemanager
	'show_sorting_bar'                        => true,
	//active or deactive the transliteration (mean convert all strange characters in A..Za..z0..9 characters)
	'transliteration'                         => true,	//false
	//convert all spaces on files name and folders name with $replace_with variable
	'convert_spaces'                          => true,	//false
	//convert all spaces on files name and folders name this value
	'replace_with'                            => "_",

	// -1: There is no lazy loading at all, 0: Always lazy-load images, 0+: The minimum number of the files in a directory
	// when lazy loading should be turned on.
	'lazy_loading_file_number_threshold'      => 0,


	//*******************************************
	//Images limit and resizing configuration
	//*******************************************

	// set maximum pixel width and/or maximum pixel height for all images
	// If you set a maximum width or height, oversized images are converted to those limits. Images smaller than the limit(s) are unaffected
	// if you don't need a limit set both to 0
	'image_max_width'                         => 0,
	'image_max_height'                        => 0,
	'image_max_mode'                          => 'auto',
	/*
	#  $option:  0 / exact = defined size;
	#            1 / portrait = keep aspect set height;
	#            2 / landscape = keep aspect set width;
	#            3 / auto = auto;
	#            4 / crop= resize and crop;
	 */

	//Automatic resizing //
	// If you set $image_resizing to TRUE the script converts all uploaded images exactly to image_resizing_width x image_resizing_height dimension
	// If you set width or height to 0 the script automatically calculates the other dimension
	// Is possible that if you upload very big images the script not work to overcome this increase the php configuration of memory and time limit
	'image_resizing'                          => false,
	'image_resizing_width'                    => 0,
	'image_resizing_height'                   => 0,
	'image_resizing_mode'                     => 'auto', // same as $image_max_mode
	'image_resizing_override'                 => false,
	// If set to TRUE then you can specify bigger images than $image_max_width & height otherwise if image_resizing is
	// bigger than $image_max_width or height then it will be converted to those values

	//******************
	// Default layout setting
	//
	// 0 => boxes
	// 1 => detailed list (1 column)
	// 2 => columns list (multiple columns depending on the width of the page)
	// YOU CAN ALSO PASS THIS PARAMETERS USING SESSION VAR => $_SESSION['RF']["VIEW"]=
	//
	//******************
	'default_view'                            => 0,

	//set if the filename is truncated when overflow first row
	'ellipsis_title_after_first_row'          => true,

	//*************************
	//Permissions configuration
	//******************
// 	'delete_files'                            => true,
// 	'create_folders'                          => true,
// 	'delete_folders'                          => true,
// 	'upload_files'                            => true,
// 	'rename_files'                            => true,
// 	'rename_folders'                          => true,
// 	'duplicate_files'                         => true,
// 	'copy_cut_files'                          => true, // for copy/cut files
// 	'copy_cut_dirs'                           => true, // for copy/cut directories
// 	'chmod_files'                             => false, // change file permissions
// 	'chmod_dirs'                              => false, // change folder permissions
// 	'preview_text_files'                      => true, // eg.: txt, log etc.
// 	'edit_text_files'                         => true, // eg.: txt, log etc.
// 	'create_text_files'                       => true, // only create files with exts. defined in $editable_text_file_exts
		'delete_files'                            => $my_permission['delete_files'],
		'create_folders'                          => $my_permission['create_folders'],
		'delete_folders'                          => $my_permission['delete_folders'],
		'upload_files'                            => $my_permission['upload_files'],
		'rename_files'                            => $my_permission['rename_files'],
		'rename_folders'                          => $my_permission['rename_folders'],
		'duplicate_files'                         => $my_permission['duplicate_files'],
		'copy_cut_files'                          => $my_permission['copy_cut_files'], // for copy/cut files
		'copy_cut_dirs'                           => $my_permission['copy_cut_dirs'], // for copy/cut directories
		'chmod_files'                             => $my_permission['chmod_files'], // change file permissions
		'chmod_dirs'                              => $my_permission['chmod_dirs'], // change folder permissions
		'preview_text_files'                      => $my_permission['preview_text_files'], // eg.: txt, log etc.
		'edit_text_files'                         => $my_permission['edit_text_files'], // eg.: txt, log etc.
		'create_text_files'                       => $my_permission['create_text_files'], // only create files with exts. defined in $editable_text_file_exts

	// you can preview these type of files if $preview_text_files is true
	'previewable_text_file_exts'              => array( 'txt', 'log', 'xml', 'html', 'css', 'htm', 'js' ),
	'previewable_text_file_exts_no_prettify'  => array( 'txt', 'log' ),

	// you can edit these type of files if $edit_text_files is true (only text based files)
	// you can create these type of files if $create_text_files is true (only text based files)
	// if you want you can add html,css etc.
	// but for security reasons it's NOT RECOMMENDED!
	'editable_text_file_exts'                 => array( 'txt', 'log', 'xml', 'html', 'css', 'htm', 'js' ),

	// Preview with Google Documents
	'googledoc_enabled'                       => true,
	'googledoc_file_exts'                     => array( 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx' ),

	// Preview with Viewer.js
	'viewerjs_enabled'                        => true,
	'viewerjs_file_exts'                      => array( 'pdf', 'odt', 'odp', 'ods' ),

	// defines size limit for paste in MB / operation
	// set 'FALSE' for no limit
	'copy_cut_max_size'                       => 100,
	// defines file count limit for paste / operation
	// set 'FALSE' for no limit
	'copy_cut_max_count'                      => 200,
	//IF any of these limits reached, operation won't start and generate warning

	//**********************
	//Allowed extensions (lowercase insert)
	//**********************
	'ext_img'                                 => array( 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg', 'ico' ), //Images
	'ext_file'                                => array( 'doc', 'docx', 'rtf', 'pdf', 'xls', 'xlsx', 'txt', 'csv', 'html', 'xhtml', 'psd', 'sql', 'log', 'fla', 'xml', 'ade', 'adp', 'mdb', 'accdb', 'ppt', 'pptx', 'odt', 'ots', 'ott', 'odb', 'odg', 'otp', 'otg', 'odf', 'ods', 'odp', 'css', 'ai' ), //Files
	'ext_video'                               => array( 'mov', 'mpeg', 'm4v', 'mp4', 'avi', 'mpg', 'wma', "flv", "webm" ), //Video
	'ext_music'                               => array( 'mp3', 'm4a', 'ac3', 'aiff', 'mid', 'ogg', 'wav' ), //Audio
	'ext_misc'                                => array( 'zip', 'rar', 'gz', 'tar', 'iso', 'dmg' ), //Archives

	/******************
	 * AVIARY config
	 *******************/
	'aviary_active'                           => true,
	//'aviary_apiKey'                           => "2444282ef4344e3dacdedc7a78f8877d",
	'aviary_apiKey'                           => "dato-ec-haiphong-13-10-2015-zpham",
	'aviary_language'                         => "en",
	'aviary_theme'                            => "light",
	'aviary_tools'                            => "all",
	'aviary_maxSize'                          => "1400",
	// Add or modify the Aviary options below as needed - they will be json encoded when added to the configuration so arrays can be utilized as needed

	//The filter and sorter are managed through both javascript and php scripts because if you have a lot of
	//file in a folder the javascript script can't sort all or filter all, so the filemanager switch to php script.
	//The plugin automatic swich javascript to php when the current folder exceeds the below limit of files number
	'file_number_limit_js'                    => 500,

	//**********************
	// Hidden files and folders
	//**********************
	// set the names of any folders you want hidden (eg "hidden_folder1", "hidden_folder2" ) Remember all folders with these names will be hidden (you can set any exceptions in config.php files on folders)
	'hidden_folders'                          => array(),
	// set the names of any files you want hidden. Remember these names will be hidden in all folders (eg "this_document.pdf", "that_image.jpg" )
	'hidden_files'                            => array( 'config.php' ),

	/*******************
	 * JAVA upload
	 *******************/
	'java_upload'                             => false,
	'JAVAMaxSizeUpload'                       => 200, //Gb


	//************************************
	//Thumbnail for external use creation
	//************************************


	// New image resized creation with fixed path from filemanager folder after uploading (thumbnails in fixed mode)
	// If you want create images resized out of upload folder for use with external script you can choose this method,
	// You can create also more than one image at a time just simply add a value in the array
	// Remember than the image creation respect the folder hierarchy so if you are inside source/test/test1/ the new image will create at
	// path_from_filemanager/test/test1/
	// PS if there isn't write permission in your destination folder you must set it
	//
	'fixed_image_creation'                    => false, //activate or not the creation of one or more image resized with fixed path from filemanager folder
	'fixed_path_from_filemanager'             => array( '../test/', '../test1/' ), //fixed path of the image folder from the current position on upload folder
	'fixed_image_creation_name_to_prepend'    => array( '', 'test_' ), //name to prepend on filename
	'fixed_image_creation_to_append'          => array( '_test', '' ), //name to appendon filename
	'fixed_image_creation_width'              => array( 300, 400 ), //width of image (you can leave empty if you set height)
	'fixed_image_creation_height'             => array( 200, '' ), //height of image (you can leave empty if you set width)
	/*
	#             $option:     0 / exact = defined size;
	#                          1 / portrait = keep aspect set height;
	#                          2 / landscape = keep aspect set width;
	#                          3 / auto = auto;
	#                          4 / crop= resize and crop;
	 */
	'fixed_image_creation_option'             => array( 'crop', 'auto' ), //set the type of the crop


	// New image resized creation with relative path inside to upload folder after uploading (thumbnails in relative mode)
	// With Responsive filemanager you can create automatically resized image inside the upload folder, also more than one at a time
	// just simply add a value in the array
	// The image creation path is always relative so if i'm inside source/test/test1 and I upload an image, the path start from here
	//
	'relative_image_creation'                 => true, //activate or not the creation of one or more image resized with relative path from upload folder
	'relative_path_from_current_pos'          => array( './small', './large'), //relative path of the image folder from the current position on upload folder
	'relative_image_creation_name_to_prepend' => array( '', ''), //name to prepend on filename
	'relative_image_creation_name_to_append'  => array( '', ''), //name to append on filename
	'relative_image_creation_width'           => array( $my_thumbnail_config['image_small']['width'], $my_thumbnail_config['image_large']['width'] ), //width of image (you can leave empty if you set height)
	'relative_image_creation_height'          => array( $my_thumbnail_config['image_small']['height'], $my_thumbnail_config['image_large']['height'] ), //height of image (you can leave empty if you set width)
	/*
	#             $option:     0 / exact = defined size;
	#                          1 / portrait = keep aspect set height;
	#                          2 / landscape = keep aspect set width;
	#                          3 / auto = auto;
	#                          4 / crop= resize and crop;
	 */
	'relative_image_creation_option'          => array($my_thumbnail_config['option_resize'], $my_thumbnail_config['option_resize']), //set the type of the crop


	// Remember text filter after close filemanager for future session
	'remember_text_filter'                    => true,

);

return array_merge(
	$config,
	array(
		'MaxSizeUpload' => ((int)(ini_get('post_max_size')) < $config['MaxSizeUpload'])
			? (int)(ini_get('post_max_size')) : $config['MaxSizeUpload'],
		'ext'=> array_merge(
			$config['ext_img'],
			$config['ext_file'],
			$config['ext_misc'],
			$config['ext_video'],
			$config['ext_music']
		),
		// For a list of options see: https://developers.aviary.com/docs/web/setup-guide#constructor-config
		'aviary_defaults_config' => array(
			'apiKey'     => $config['aviary_apiKey'],
			'language'   => $config['aviary_language'],
			'theme'      => $config['aviary_theme'],
			'tools'      => $config['aviary_tools'],
			'maxSize'    => $config['aviary_maxSize']
		),
	)
);
