<?php
require ('../include/init.inc.php');
$method = $module_id = '';
extract ( $_GET, EXTR_IF_EXISTS );


if ($method == 'del' && ! empty ( $module_id )) {
	$menus = Module::getModuleMenu($module_id);
	if(sizeof($menus)>0){
		OSAdmin::alert("error",ErrorMessage::HAVE_FUNC);
	}else if(intval($module_id) === 1){
		OSAdmin::alert("error",ErrorMessage::CAN_NOT_DELETE_SYSTEM_MODULE);
	}else{
		$module=Module::getModuleById($module_id);
		$result = Module::delModule ( $module_id );
		
		if ($result) {
			SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'Module' ,$module_id, json_encode($module) );
			Common::exitWithSuccess ('模块删除成功','panel/modules.php');
		}
	}
}

$modules = Module::getAllModules();
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");
Template::assign ( 'modules', $modules );
Template::assign ( 'osadmin_action_confirm' , $confirm_html);
Template::display ( 'panel/modules.tpl' );