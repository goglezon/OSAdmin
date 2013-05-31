<?php
require ('../include/init.inc.php');
$method = $module_id = '';
extract ( $_GET, EXTR_IF_EXISTS );


if ($method == 'del' && ! empty ( $module_id )) {
	$menus = Module::getModuleMenu($module_id);
	if(sizeof($menus)>0){
		OSAdmin::alert("error",ErrorMessage::HAVE_FUNC);
	}else{
		$module=Module::getModuleById($module_id);
		$result = Module::delModule ( $module_id );
		
		if ($result) {
			SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'Module' ,$module_id, json_encode($module) );
			Common::exitWithSuccess ('模块删除成功','admin/modules.php');
		}
	}
}

$modules = Module::getAllModules();
OSAdmin::renderConfirm("icon-remove");
Template::assign ( 'modules', $modules );
Template::display ( 'admin/modules.tpl' );