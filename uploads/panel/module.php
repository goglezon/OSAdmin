<?php
require ('../include/init.inc.php');
$module_id = $menu_ids = $module = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

Common::checkParam($module_id);

$temp = Module::getModuleById ( $module_id );
if(empty($temp)){
	Common::exitWithError(ErrorMessage::MODULE_NOT_EXIST,"panel/modules.php");
}

if (Common::isPost ()) {
	
	if(empty($module) || empty($menu_ids)){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		if($module !=1){
			foreach ($menu_ids as $menu_id){
				if($menu_id<=100){
					Common::exitWithError ('系统菜单不能转移到其它模块','panel/modules.php');
				}
			}
		}
		$menu_ids=implode(',',$menu_ids);
		$update_data = array ('module_id' => $module);
		$result = MenuUrl::batchUpdateMenus ( $menu_ids,$update_data );
		
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'MenuUrl' ,$menu_ids, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','panel/modules.php');
		} else {
			OSAdmin::alert("error");
		}
	}
}

$menus = MenuUrl::getListByModuleId($module_id );
$module_options_list = Module::getModuleForOptions ();

Template::assign ( 'module_options_list', $module_options_list );
Template::assign ( 'menus', $menus );
Template::assign ( 'module_id', $module_id );
Template::display ( 'panel/module.tpl' );