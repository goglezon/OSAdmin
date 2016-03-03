<?php
define('ACCESS', 1); 
error_reporting(E_ALL ^ E_NOTICE);
// autoload 使用常量
define('ADMIN_BASE', dirname (__FILE__) . '/../../include');
define('ADMIN_BASE_LIB', ADMIN_BASE . '/lib/');
define('ADMIN_BASE_CLASS', ADMIN_BASE . '/class/');

// Smarty 模板使用常量
define('TEMPLATE_DIR', ADMIN_BASE . '/template/');
define('TEMPLATE_COMPILED', ADMIN_BASE . '/compiled/');
define('TEMPLATE_PLUGINS', ADMIN_BASE_LIB . 'Smarty/plugins/');
define('TEMPLATE_SYSPLUGINS', ADMIN_BASE_LIB . 'Smarty/sysplugins/');
define('TEMPLATE_CONFIGS', ADMIN_BASE . '/config/');
define('TEMPLATE_CACHE', ADMIN_BASE . '/cache/');

// OSAdmin 常量
define('ADMIN_URL' ,'http://demo.osadmin.net/uploads');
define('ADMIN_TITLE' ,'管理后台');
define('COMPANY_NAME' ,'OSAdmin.org');

// OSAdmin 数据库设置
define('OSA_DB_ID' ,'osadmin');
$DATABASE_LIST[OSA_DB_ID] = array (
	'server' => '127.0.0.1',
	'port' => '3306',
	'username' => 'root',
	'password' => '',
	'db_name' => 'osadmin');

// 样例数据库设置
define('SAMPLE_DB_ID' ,'sample');
$DATABASE_LIST[SAMPLE_DB_ID] = array (
	'server' => '127.0.0.1',
	'port' => '3306',
	'username' => 'root',
	'password' => '',
	'db_name' => 'osadmin');


// COOKIE 加密密钥，建议修改
define('OSA_ENCRYPT_KEY','whatafuckingday!');

// prefix 不要更改，除非修改 osadmin.sql 文件中的所有表名
define('OSA_TABLE_PREFIX' ,'osa_');

// 页面设置
define('DEBUG' ,false);
define('PAGE_SIZE', 25);

$OSA_TEMPLATES = array(
	'default' => '默认模板',
	'schoolpainting' => '青葱校园',
	'blacktie' => '黑色领结',
	'wintertide' => '冰雪冬季',
);

$OSADMIN_COMMAND_FOR_LOG = array(	
	'SUCCESS' => '成功',
	'ERROR' => '失败',
	'ADD' => '增加',
	'DELETE' => '删除',
	'MODIFY' => '修改',
	'LOGIN' => '登录',
	'LOGOUT' => '退出',
	'PAUSE' => '封停',
	'PLAY' => '解封',
);

$OSADMIN_CLASS_FOR_LOG = array(
	'ALL' => '全部',
	'User' => '用户',
	'UserGroup' => '账号组',
	'Module' => '菜单模块',
	'MenuUrl' => '功能',
	'GroupRole' => '权限',
	'QuickNote' => 'QuickNote',
);
