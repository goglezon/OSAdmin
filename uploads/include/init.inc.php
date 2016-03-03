<?php
error_reporting(E_ALL);
require 'config/config.inc.php';
session_start();
function OSAdminAutoLoad($classname){

	$filename = str_replace('_', '/', $classname) . '.class.php';
    // class类
    $filepath = ADMIN_BASE_CLASS . $filename;
    if (file_exists($filepath)) {
        return include $filepath;
    }else{
		// Class 仅支持一级子目录
		// 如果子目录中 class 文件与 CLASS 根下文件同名，则子目录里的 class 文件将被忽略

		$handle=opendir(ADMIN_BASE_CLASS);

		while (false !== ($file = readdir($handle))) {
			if (is_dir(ADMIN_BASE_CLASS. "/" . $file)) {
				$filepath=ADMIN_BASE_CLASS."/".$file."/".$filename;
				if (file_exists($filepath)) {
					return include $filepath;
				}
			}
		}
	}
    // lib 库文件
    $filepath = ADMIN_BASE_LIB . $filename;
    if (file_exists($filepath)) {
        return include $filepath;
    }

    throw new Exception( $filepath . ' NOT FOUND!');
}
spl_autoload_register('OSAdminAutoLoad');

if(!isset($_SESSION['osa_timezone'])){
		$timezone = System::get('timezone');
		$_SESSION['osa_timezone'] = $timezone;
}

date_default_timezone_set($_SESSION['osa_timezone']);

/**
 * 不需要登录就可以访问的链接，也可以是某个目录，不含子目录
 * 如 "/nologin/", "/nologin/aaa/"
**/

$no_need_login_page=array("/block.php","/panel/login.php","/panel/logout.php",);

// 如果不需要登录就可以访问的话
$action_url = Common::getActionUrl();
if( OSAdmin::checkNoNeedLogin($action_url,$no_need_login_page) ){	
	// for login.php, logout.php, etc . . .
	// ;
} else {
	// 否则需要验证登录信息
	if (empty($_SESSION[UserSession::SESSION_NAME])) {
		$user_id = User::getCookieRemember();
		if ($user_id > 0) {
			User::loginDoSomething($user_id);
		}
	}

	User::checkLogin();

	User::checkActionAccess();
	$current_user_info = UserSession::getSessionInfo();
	// 如果非 AJAX 请求
	if (stripos($_SERVER['SCRIPT_NAME'],"/ajax") === false) {
		// 显示菜单、导航条、模板
		$sidebar = SideBar::getTree ();
		
		// 是否显示 quick note
		if($current_user_info['show_quicknote']){
			OSAdmin::showQuickNote();
		}
		
		$menu = MenuUrl::getMenuByUrl(Common::getActionUrl());
		Template::assign ( 'page_title', $menu['menu_name']);
		Template::assign ( 'content_header', $menu );
		Template::assign ( 'sidebar', $sidebar );
		Template::assign ( 'current_module_id', $menu['module_id'] );
		Template::assign ( 'user_info', UserSession::getSessionInfo());
	}
}

Template::assign ( 'osa_templates', $OSA_TEMPLATES);

$sidebarStatus=$_COOKIE['sidebarStatus']==null?"yes":$_COOKIE['sidebarStatus'];
Template::assign ( 'sidebarStatus', $sidebarStatus);
