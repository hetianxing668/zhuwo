<?php

/**
 *  模型对外接口
 *  保证相同模型不重复创建
 */

class components_api {
	
	//存储已创建的模型
	static private $_model = array();

	/**
	* 获取数据模型
	* @param string $name 获取模型的名称，例如:mk_task
	* @param int $id 需要实例化的数据记录ID
	* @param boolean $is_cache 是否缓存
	* return object|false
	 */
	static public function get($name, $id = null, $is_cache = true) {

		$class_name  = $name;

		if(empty($id)) {

			//如果没有传递要实例化的ID，直接创建模型，不保存
			return new $class_name();

		}else {

			//如果传递了要实例化的ID，检查是否创建
			$cache_name  = $name.'_'.$id;
			if(!$is_cache) {
				return new $class_name($id);
			}else {
				if(!isset(self::$_model[$cache_name])) {
					self::$_model[$cache_name] = new $class_name($id);
				}
				return self::$_model[$cache_name];
			}
		}
	}

	/**
	 * 获得当前数据模型的前缀
	 * @return string
	 */
	static public function getPrefix() {
		return substr(__CLASS__, 0 ,strlen(__CLASS__) - 3);
	}
	
	/**
	 * 释放所有对象
	 * return object|false
	 */
	static public function clear($name='') {
		self::$_model = (array)self::$_model;
		
		if(!empty($name)){ 
			unset(self::$_model[$name]);
			return true;
		}
		
		foreach(self::$_model as $k=>$obj){
			unset($obj,self::$_model[$k]);
		}
		self::$_model = array();
	}
	
	/**
	 * 释放所有对象和数据库连接
	 * return object|false
	 */
	static public function destroy() {
		// 清除数据库连接，防止长连接导致的数据库超时
		$db = SDb::getDbEngine("pdo_new_mysql");
      	$db->disconnect();
		// 释放所有数据库对象
		self::clear();
	}
}
