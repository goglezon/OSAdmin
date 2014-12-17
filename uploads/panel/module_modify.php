<?php
require ('../include/init.inc.php');
$module_id = $module_name = $module_sort = $module_url = $module_desc = $module_icon = $online = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

Common::checkParam($module_id);

$module = Module::getModuleById ( $module_id );
if(empty($module)){
	Common::exitWithError(ErrorMessage::MODULE_NOT_EXIST,"panel/modules.php");
}

if (Common::isPost ()) {
	
	if($module_name =="" || $module_url == "" ){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$update_data = array ('module_name' => $module_name, 'module_desc' => $module_desc, 'module_icon' => $module_icon ,'module_url' => $module_url ,
						'module_sort' =>$module_sort);
		if($module_id >1){
			$update_data['online'] =$online;
		}
		$result = Module::updateModuleInfo ( $module_id,$update_data );
		
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'Module' ,$module_id, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','panel/modules.php');
		} else {
			OSAdmin::alert("error");
		}
	}
}


$module_online_optioins = array("1"=>"在线","0"=>"下线");
Template::assign ( 'module', $module );
Template::assign ( 'module_online_optioins', $module_online_optioins );
Template::display ( 'panel/module_modify.tpl' );