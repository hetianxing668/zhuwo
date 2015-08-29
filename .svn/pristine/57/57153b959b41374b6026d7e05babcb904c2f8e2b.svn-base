<?php
/**
 * API接口
 */
class controller_api extends components_basepage{
    
    /**
     * 添加用户
     * @param type $inPath
     * @throws Exception
     */
    public function pageUserAdd(){
        $srv = new service_user();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $items['nickname'] = lib_BaseUtils::getStr($_POST["nickname"]);
            $items['username'] = lib_BaseUtils::getStr($_POST["username"]);
            $items['pwd'] = md5(lib_BaseUtils::getStr($_POST["pwd"]));
            $items['status'] = lib_BaseUtils::getStr($_POST["status"]);
            $items['createtime'] = $this->_time;
            $items['createymd'] = $this->_date;
            $items['email'] = lib_BaseUtils::getStr($_POST["email"]);
            $items['location'] = lib_BaseUtils::getStr($_POST["location"]);
            $lastInserId = $srv->add($items);
            if($lastInserId){
                echo '用户添加成功';
            }else{
                echo '用户添加失败';
            }
        }else{
            $message = '非法请求';
            throw new Exception($message);
        }
    }
    
    /**
     * 用户登录
     */
    public function pageLogin(){
        $model = new model_user();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $info = $GLOBALS['HTTP_RAW_POST_DATA'];
            $data = json_decode($info,true);
            $condition['username'] = $data['username'];
            $condition['userpwd'] = $data['userpwd'];
            $res = $model->selectOne($condition, "user_id");
            if($res){
                $msg = '登录成功';
                $params['user_id'] = $res['user_id'];
                lib_BaseUtils::jsonp($msg,1,0,$params);
            }else{
                $msg = '账号或密码有误';
                lib_BaseUtils::jsonp($msg,1,1);
            }
        }
    }
    
    /**
     * 打卡签到接口
     */
    public function pageSignIn(){
        $model = new model_kaoqin();
        $mdl_user = new model_user();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $info = $GLOBALS['HTTP_RAW_POST_DATA'];
            $data = json_decode($info,true);
            $user_id = $condition['user_id'] = $data['user_id'];
            if($this->verifySignIn($user_id,$data['status'])){
                $res = $mdl_user->selectOne($user_id, 'username,nickname');
                $condition['username'] = $res['username'];
                $condition['nickname'] = $res['nickname'];
                $condition['status'] = $data['status'];
                $condition['createtime'] = $this->_time;
                $condition['createymd'] = $this->_date;
                $model->insert($condition);
                $lastInsertId = $model->lastInsertId();
                if($lastInsertId){
                    $msg = '上班打卡成功';
                    lib_BaseUtils::jsonp($msg,1,0);
                }else{
                    $msg = '上班打卡失败';
                    lib_BaseUtils::jsonp($msg,1,0);
                }
            }else{
                $msg = '抱歉，您已经打过卡了';
                lib_BaseUtils::jsonp($msg,1,1);
            }
            
        }
    }
    
    /**
     * 判断用户当天是否已签到
     */
    public function pageVerifySignIn($user_id){
        $model = new model_kaoqin();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $info = $GLOBALS['HTTP_RAW_POST_DATA'];
            $data = json_decode($info,true);
            $condition['user_id'] = $data['user_id'];
            $condition['createymd'] = $this->_date;
            $res = $model->select($condition, "status")->items;
            if($res){
                foreach ($res as $val){
                    if($val['status']==0){
                        $msg = '您现在已经是下班状态';
                        $params['ok'] = 0;
                        lib_BaseUtils::jsonp($msg,1,0,$params);
                    }
                    if($val['status']==1){
                        $msg = '您现在已经是上班状态';
                        $params['ok'] = 1;
                        lib_BaseUtils::jsonp($msg,1,0,$params);
                    }
                }
            }else {
                $msg = '您尚未打卡请打卡';
                $params['ok'] = 0;
                lib_BaseUtils::jsonp($msg,1,0,$params);
            }
        }
    }
    
    /**
     * 私有方法判断用户当天是否已签到
     */
    private function verifySignIn($user_id,$status=0){
        $model = new model_kaoqin();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $info = $GLOBALS['HTTP_RAW_POST_DATA'];
            $data = json_decode($info,true);
            $condition['user_id'] = $user_id;
            $condition['status'] = $status;
            $condition['createymd'] = $this->_date;
            $res = $model->selectOne($condition, "status");
            if($res['status']==$status){
                return false;
            }else{
                return true;
            }
        }
    }
    
    
    
}

