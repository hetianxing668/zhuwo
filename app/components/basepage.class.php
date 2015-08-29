<?php

class components_basepage extends STpl{
	protected $_time;
	protected $_date;
	
	function __construct(){
		$this->_time = time();
		$this->_date = date('Y-m-d',$this->_time);
	}
	
	/**
	 * 系统提示
	 */
	public function ShowMsg($msg = 'message', $backurl = '', $second = 3, $state = 0) {
		$params ['msg'] = $msg;
		$params ['url'] = $backurl;
		$params ['second'] = $second;
		$params ['state'] = $state;
		$params ['root_dir'] = $this->params ['root_dir'];
		echo $this->render('common/showmsg.html', $params);
		exit ();
	}
	
	/**
	 * 获取url参数
	 */
	public function getUrlParams($inPath) {
		$newary = array ();
		for($i = 3; $i < count ( $inPath ); $i ++) {
			//如果不遵守变量规则，直接跳过
			if (preg_match ( "/[^A-Za-z0-9_]/", $inPath [$i] ))
				continue;
			if ($i % 2) {
				$newary [$inPath [$i]] = $inPath [$i + 1];
			}
		}
		unset ( $newary [lib_Constant::URL_SUFFIX] );
		return $newary;
	}
	
	/**
	 * 构建完整url
	 */
	public function createUrl($route, $params = array()) {
		$root_dir = lib_Constant::ROOT_DIR ? '/' . trim ( lib_Constant::ROOT_DIR, '/' ) : '' ;
		$uf = lib_Constant::URL_FORMAT;
		$url = rtrim ( $route, lib_Constant::URL_FORMAT );
		if (! empty ( $params )) {
			$sux = '.' . lib_Constant::URL_SUFFIX;
			foreach ( $params as $key => $value ) {
				if (trim ( $value ) != '') {
					$tmp .= $key . $uf . $value . $uf;
				}
			}
			$tmp = rtrim ( $tmp, $uf );
			$url = rtrim ( $url . lib_Constant::URL_FORMAT . $tmp, lib_Constant::URL_FORMAT );
		}
		if (substr ( $url, - 1 ) != '/') { //以'/'结束的url不加$sux;
			$url = $route === '' ? $url : $url . $sux;
		}
		if (! lib_Constant::REWRITE) {
			return $root_dir."/index.php/c" . $url;
		}
		return $root_dir.$url;
	}
}
