<?php
require ('../include/init.inc.php');
$module_id = $menu_ids = $module = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

Common::checkParam($module_id);

if (Common::isPost ()) {
	
	if(empty($module) || empty($menu_ids)){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$menu_ids=implode(',',$menu_ids);
		$update_data = array ('module_id' => $module);
		$result = MenuUrl::batchUpdateMenus ( $menu_ids,$update_data );
		
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'MenuUrl' ,$menu_ids, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','admin/modules.php');
		} else {
			OSAdmin::alert("error");
		}
	}
}

$menus = MenuUrl::getListByModuleId($module_id );
$module_options_list = Module::getModuleForOptions ();

Template::assign ( 'module_options_list', $module_options_list );
Template::assign ( 'menus', $menus );
Template::display ( 'admin/module.tpl' );