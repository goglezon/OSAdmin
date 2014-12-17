<?php
require ('../include/init.inc.php');
$module_name = $module_desc = $module_sort = $module_url = $module_icon ='';
$_POST['module_sort'] = 1;
extract ( $_POST, EXTR_IF_EXISTS );

if (Common::isPost ()) {
	$exist = Module::getModuleByName($module_name);
	if($exist){
		OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
	}else if($module_name =="" || $module_url == ""){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$input_data = array ('module_name' => $module_name, 'module_desc' => $module_desc, 'module_url' => $module_url ,'module_sort' =>$module_sort,'module_icon' =>$module_icon);
		$module_id = Module::addModule ( $input_data );
		
		if ($module_id) {
			SysLog::addLog ( UserSession::getUserName(), 'ADD', 'Module' , $module_id, json_encode($input_data) );
			Common::exitWithSuccess ('模块添加成功','panel/modules.php');
		}
	}
}
Template::assign("_POST" ,$_POST);
Template::display('panel/module_add.tpl' );
