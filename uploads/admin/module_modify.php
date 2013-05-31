<?php
require ('../include/init.inc.php');
$module_id = $module_name = $module_sort = $module_url = $module_desc = $online = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

Common::checkParam($module_id);

if (Common::isPost ()) {
	
	if($module_name =="" || $module_url == ""){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$update_data = array ('module_name' => $module_name, 'module_desc' => $module_desc, 'module_url' => $module_url ,'module_sort' =>$module_sort,'online' =>$online);
		$result = Module::updateModuleInfo ( $module_id,$update_data );
		
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'Module' ,$module_id, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','admin/modules.php');
			//OSAdmin::alert("success");
		} else {
			OSAdmin::alert("error");
		}
	}
}

$module = Module::getModuleById ( $module_id );
$module_online_optioins = array("1"=>"在线","0"=>"已下线");
Template::assign ( 'module', $module );
Template::assign ( 'module_online_optioins', $module_online_optioins );
Template::display ( 'admin/module_modify.tpl' );