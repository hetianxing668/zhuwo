<?php
date_default_timezone_set("Asia/Shanghai");
define('ROOT',str_replace("\\",DIRECTORY_SEPARATOR,dirname(__FILE__)). DIRECTORY_SEPARATOR);
define("ROOT_APP",			ROOT."/app");
define("ROOT_CONFIG",		ROOT."/config");
define("ROOT_SLIGHTPHP",	ROOT."/SlightPHP");
define("ROOT_PLIGUNS",		ROOT_SLIGHTPHP."/plugins");
require_once(ROOT_SLIGHTPHP."/SlightPHP.php");
//{{{
function __autoload($class){
	if($class{0}=="S"){
		$file = ROOT_PLIGUNS."/$class.class.php";
	}else{
		$file = SlightPHP::$appDir."/".str_replace("_","/",$class).".class.php";
	}
	if(file_exists($file)) return require_once($file);
}
spl_autoload_register('__autoload');
//}}}
