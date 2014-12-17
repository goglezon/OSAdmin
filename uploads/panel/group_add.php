<?php
require ('../include/init.inc.php');
$group_name = $group_desc = '';
extract ( $_POST, EXTR_IF_EXISTS );

if (Common::isPost ()) {
	$exist = UserGroup::getGroupByName($group_name);
	if($exist){
	
		OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
	}else if($group_name ==""){
		
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$input_data = array ('group_name' => $group_name, 'group_desc' => $group_desc, 'group_role' => "1,5,17,18,22,23,24,25" ,'owner_id' => UserSession::getUserId() );
		$group_id = UserGroup::addGroup ( $input_data );
		
		if ($group_id) {
			SysLog::addLog ( UserSession::getUserName(), 'ADD', 'UserGroup' ,$group_id, json_encode($input_data) );
			Common::exitWithSuccess ('账号组添加完成','panel/groups.php');
		}
	}
}

Template::assign("_POST" ,$_POST);
Template::display('panel/group_add.tpl' );
