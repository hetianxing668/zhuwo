<?php
/**
 * 定义常量
 */
class lib_Constant {
	const PAGE_SIZE = 10; //分页每页数量
	const ROOT_DIR = ""; //程序相对网站根目录的目录 为空表示根目录 注意末尾不要加“/”
	const TABLE_PREFIX = "zw_"; //数据库表前缀
	const URL_SUFFIX = "html"; //伪静态时 文件后缀
	const URL_FORMAT = "-"; //URI参数分隔符
	const REWRITE = FALSE; //是否启用伪静态
	const COOKIE_KEY = "1b04c22c8bbf0ad9cda884d86ceb653b"; //cookie密匙
	const TEMP_DIR = ""; //模版目录
	const DEFAULT_TITLE = "猪八戒微信打卡系统"; //默认网站标题
	const VERSION = "v1.0 Release";
}