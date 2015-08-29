<?php
/**
 * 微信公众平台 PHP SDK 示例文件
 *
 * @author NetPuter <netputer@gmail.com>
 */

  require('./core/components/Wechat.php');

  /**
   * 微信公众平台演示类
   */
  class MyWechat extends Wechat {
  	
  	const appID='wxdc908b51355c0193';
  	const appsecret= '61fcbdd4328a289a677556aca8ef2ee2';

    /**
     * 用户关注时触发，回复「欢迎关注」
     *
     * @return void
     */
    protected function onSubscribe() {
      //$this->responseText('欢迎关注');
      $openid = $this->getRequest('fromusername');
      $nickname = $this->getNickName($openid);
      $this->responseText($nickname."您好，欢迎关注猪八戒微信考勤系统！");
    }
    
    /**
     * 获取access_token
     * @param string $appID
     * @param string $appsecret
     */
    private function getAccessToken(){
    	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".self::appID."&secret=".self::appsecret;
    	$arr = $this->curl_get($url);
    	return $arr['access_token'];
    }
    
    /**
     * 通过openid获取微信用户昵称
     * @param string $access_token
     * @param string $openid
     */
    private function getNickName($openid=''){
    	$access_token = $this->getAccessToken();
    	$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
    	$arr = $this->curl_get($url);
    	return $arr['nickname'];
    }
    
    /**
     * cul获取数据
     * @param string $url
     */
    private  function docurl($url=''){
    	//初始化
    	$ch = curl_init();
    	//设置选项，包括URL
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	//执行并获取HTML文档内容
    	$output = curl_exec($ch);
    	//释放curl句柄
    	curl_close($ch);
    	//打印获得的数据
    	return $output;
    }
    
    /**
     * cul_get方法
     * @param unknown $url
     * @param unknown $data
     */
    private function curl_get($url, $data = array()) {
    	$data = http_build_query($data);
    	$url .= (strpos($url, '?') ? '&' : '?') . $data;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_HTTPGET, true);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	$content = curl_exec($ch);
    	if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
    		if (self::isJson($content)) {
    			$content = json_decode($content, true);
    		}
    	} else {
    		$content = false;
    		$curl_errno = curl_errno($ch);
    		$curl_error = curl_error($ch);
    		self::setError($curl_error, $curl_errno);
    	}
    	curl_close($ch);
    	return $content;
    }
    
    /**
     * 解析JSON格式的字符串
     *
     * @param string $str
     * @return bool
     */
    public static function isJson($str) {
    	$arr = json_decode($str, true);
    	if (gettype($arr) != "array") {
    		return false;
    	} else {
    		return true;
    	}
    }
    
    public static function getError() {
    	return self::$error;
    }
    
    public static function setError($message, $code = -1) {
    	self::$error = array(
    			'message' => $message,
    			'code' => $code,
    	);
    }
    
    public static function http_build_query($formdata) {
    	if (!$formdata || !is_array($formdata)) {
    		return '';
    	}
    	$arr = '';
    	foreach ($formdata as $key => $value) {
    		$arr[] = "{$key}={$value}";
    	}
    	$str = implode('&', $arr);
    	return $str;
    
    }
    

    /**
     * 用户取消关注时触发
     *
     * @return void
     */
    protected function onUnsubscribe() {
      // 「悄悄的我走了，正如我悄悄的来；我挥一挥衣袖，不带走一片云彩。」
    }

    /**
     * 收到文本消息时触发，回复收到的文本消息内容
     *
     * @return void
     */
    protected function onText() {
      $this->responseText('收到了文字消息：' . $this->getRequest('content'));
    }

    /**
     * 收到图片消息时触发，回复由收到的图片组成的图文消息
     *
     * @return void
     */
    protected function onImage() {
      $items = array(
        new NewsResponseItem('标题一', '描述一', $this->getRequest('picurl'), $this->getRequest('picurl')),
        new NewsResponseItem('标题二', '描述二', $this->getRequest('picurl'), $this->getRequest('picurl')),
      );

      $this->responseNews($items);
    }

    /**
     * 收到地理位置消息时触发，回复收到的地理位置
     *
     * @return void
     */
    protected function onLocation() {
      $num = 1 / 0;
      // 故意触发错误，用于演示调试功能

      $this->responseText('收到了位置消息：' . $this->getRequest('location_x') . ',' . $this->getRequest('location_y'));
    }

    /**
     * 收到链接消息时触发，回复收到的链接地址
     *
     * @return void
     */
    protected function onLink() {
      $this->responseText('收到了链接：' . $this->getRequest('url'));
    }

    /**
     * 收到未知类型消息时触发，回复收到的消息类型
     *
     * @return void
     */
    protected function onUnknown() {
      $this->responseText('收到了未知类型消息：' . $this->getRequest('msgtype'));
    }

  }

  $wechat = new MyWechat('weixin', TRUE);
  $wechat->run();
