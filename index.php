<?php
/**
 * sample to test
 *
 * http://localhost/samples/www/index.php/zone/default/entry/a/b/c
 * http://localhost/samples/www/index.php/zone-default-entry-a-b-c.html
 *
 */
require_once("global.php");

SlightPHP::setDebug(true);
SlightPHP::setAppDir("app");
SlightPHP::setDefaultZone("controller");
SlightPHP::setDefaultPage("main");
SlightPHP::setDefaultEntry("index");
SlightPHP::setSplitFlag("-_.");
//{{{
SDb::setConfigFile(ROOT_CONFIG. "/db.ini.php");
//}}}
if(($r=SlightPHP::run())===false){
	echo("404 error");
}elseif(is_object($r)){
	var_dump($r);
}else{
	echo($r);
}
