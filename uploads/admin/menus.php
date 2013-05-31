<?php
require ('../include/init.inc.php');
$method = $menu_id = '';
extract ( $_GET, EXTR_IF_EXISTS );

$page_no = isset($_GET ['page_no'])&&$_GET['page_no']>0 ? $_GET['page_no'] : 1;
$start = ($page_no - 1) * PAGE_SIZE;
$end = $page_no *PAGE_SIZE;


if ($method == 'del' && ! empty ( $menu_id )) {
	
	$menu = MenuUrl::getMenuById($menu_id);
	
	if(intval($menu['module_id']) === 1){
		OSAdmin::alert("error",ErrorMessage::CAN_NOT_DELETE_SYSTEM_MENU);
	}else{
		$result = MenuUrl::delMenu ( $menu_id );	
		if ($result) {
			SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'MenuUrl' ,$menu_id, json_encode($menu) );
			Common::exitWithSuccess ('已将菜单链接删除','admin/menus.php');
		}else{
			OSAdmin::alert("error");
		}
	}
}

$module_options_list = Module::getModuleForOptions ();
$menus = MenuUrl::getAllMenus ();
OSAdmin::renderConfirm("icon-remove");
Template::assign ( 'page_no', $page_no );
Template::assign ( 'menus', $menus );
Template::assign ( 'module_options_list', $module_options_list );
Template::display ( 'admin/menus.tpl' );