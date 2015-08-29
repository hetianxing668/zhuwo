<?php
class controller_main extends components_basepage{
	
	/**
	 * 
	 * @param unknown $inPath
	 */
	function pageIndex($inPath){
		$params['title'] = '首页';
		$params['content'] = 'Hello world!';
		return $this->render("main/index.html",$params);
	}
	
	function pageAddUser(){
		$model = new model_user();
		$model->set('nickname', '李四');
		$model->set('username', 'lisi');
		$model->set('pwd', '123456');
		$model->set('status', '1');
		$model->set('createtime',$this->_time);
		$model->set('createymd', $this->_date);
		$res = $model->save();
		if($res){
			$this->ShowMsg("用户添加成功");
		}else{
			$this->ShowMsg("用户添加失败");
		}
	}
}
?>
