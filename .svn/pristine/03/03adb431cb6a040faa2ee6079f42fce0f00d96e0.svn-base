<?php

class lib_BaseUtils {

    /**
     * 安全过滤数据
     *
     * @param string	$str		需要处理的字符或数组
     * @param string	$type		返回的字符类型，支持，string,int,float,html
     * @param maxid		$default	当出现错误或无数据时默认返回值
     * @return 		mixed		当出现错误或无数据时默认返回值
     */
    public static function getStr($str, $type = 'string', $default = '') {

        //如果为空则为默认值
        if ($str === '')
            return $default;

        if (is_array($str)) {
            $_str = array();
            foreach ($str as $key => $val) {
                $_str[$key] = self::getStr($val, $type, $default);
            }
            return $_str;
        }

        //转义
        if (!get_magic_quotes_gpc())
            $str = addslashes($str);

        switch ($type) {
            case 'string': //字符处理
                $_str = strip_tags($str);
                $_str = str_replace("'", '&#39;', $_str);
                $_str = str_replace("\"", '&quot;', $_str);
                $_str = str_replace("\\", '', $_str);
                $_str = str_replace("\/", '', $_str);
                $_str = str_replace("+/v", '', $_str);
                break;
            case 'int': //获取整形数据
                $_str = intval($str);
                break;
            case 'float': //获浮点形数据
                $_str = floatval($str);
                break;
            case 'html': //获取HTML，防止XSS攻击
                $_str = self::reMoveXss($str);
                break;

            default: //默认当做字符处理
                $_str = strip_tags($str);
        }

        return $_str;
    }

    /**
     * 兼容jsonp
     * @param string $return
     * @param int $type 0=html,1=json,2=iframe返回
     * @param int $state 表示json返回状态
     */
    static function jsonp($str, $type = 1, $state = 1, $other = array()) {
        $state = (int) $_GET['state'] ? (int) $_GET['state'] : $state;
        if ($_REQUEST['ifr'] == 2) {
            $type = 2;
        }
        $return = array('state' => $state, 'msg' => $str);
        if ($other && is_array($other)) {
            foreach ($other as $k => $v) {
                $return[$k] = $v;
            }
        }
        if ($type == 1) {
            if ($_REQUEST['jsonpcallback']) {
                $str = self::getStr($_REQUEST['jsonpcallback']) . "(" . json_encode($return) . ")";
            } else {
                $str = json_encode($return);
            }
        } elseif ($type == 2) {
            $domain = zbj_lib_Constant::DOMAIN;
            $str = "<script>document.domain='" . $domain . "';window.parent.window." . self::getStr($_REQUEST['jsonpcallback']) . "(" . json_encode($return) . ")" . ";</script>";
        }
        echo $str;
        exit;
    }

}
