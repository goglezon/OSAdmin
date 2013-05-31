<?php
define ('ACCESS',1); 

//autoload 使用常量
define ( 'ADMIN_BASE', dirname ( __FILE__ ) . '/../../include' );
define ( 'ADMIN_BASE_LIB', ADMIN_BASE . '/lib/' );
define ( 'ADMIN_BASE_CLASS', ADMIN_BASE . '/class/' );

//Smarty模板使用常量
define ( 'TEMPLATE_DIR', ADMIN_BASE . '/template/' );
define ( 'TEMPLATE_COMPILED', ADMIN_BASE . '/compiled/' );
define ( 'TEMPLATE_PLUGINS', ADMIN_BASE_LIB . 'Smarty/plugins/' );
define ( 'TEMPLATE_CONFIGS', ADMIN_BASE . '/config/' );
define ( 'TEMPLATE_CACHE', ADMIN_BASE . '/cache/' );

//OSAdmin常量
define ( 'ADMIN_URL' ,'http://yuwenqi.com');
define ( 'ADMIN_TITLE' ,'管理后台');
define ( 'COMPANY_NAME' ,'OSAdmin.org');

//OSAdmin数据库设置
define ( 'OSA_DB_URL','127.0.0.1:3306');
define ( 'OSA_DB_NAME' ,'osadmin');
define ( 'OSA_USER_NAME','root');
define ( 'OSA_PASSWORD','');
define ( 'OSA_TABLE_PREFIX' ,'osa_');

//页面设置
define ( 'DEBUG' ,false);
define ( 'PAGE_SIZE', 25 );

//数据库配置
$DATABASE_LIST = array (OSA_DB_NAME => array (OSA_DB_URL, OSA_USER_NAME, OSA_PASSWORD, OSA_DB_NAME ),
						'sample' => array ('127.0.0.1:3306', 'root', '', 'osadmin' ),
				);

$OSADMIN_COMMAND_FOR_LOG=array(	
							'SUCCESS'=>'成功',
							'ERROR'=>'失败',
							'ADD'=>'增加',
							'DELETE'=>'删除',
							'MODIFY'=>'修改',
							'LOGIN'=>'登录',
							'LOGOUT'=>'退出',
							'PAUSE'=>'封停',
							'PLAY'=>'解封',
				);

$OSADMIN_CLASS_FOR_LOG=array(
							'ALL' => '全部',
							'User'=>'用户',
							'UserGroup'=>'账号组',
							'Module'=>'菜单模块',
							'MenuUrl'=>'功能',
							'GroupRole'=>'权限',
							'QuickNote'=>'QuickNote',
					);
?>