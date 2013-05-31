<?php
require ('../include/init.inc.php');
$group_id = $method = $user_ids = $user_group = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

Common::checkParam($group_id);

if (Common::isPost()) {
	if( empty($user_ids) || empty($user_group)){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$user_ids=implode(',',$user_ids);
		$update_data = array ('user_group' => $user_group);
		$result = User::batchUpdateUsers ($user_ids,$update_data );
		
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'User' ,$user_ids, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','admin/groups.php');
		} else {
			 
			OSAdmin::alert("error");
		}
	}
}

$group = UserGroup::getGroupById ( $group_id );
$user_infos = User::getUsersByGroup($group_id);
$groupOptions=UserGroup::getGroupForOptions();

Template::assign ( 'group', $group );
Template::assign ( 'user_infos', $user_infos );
Template::assign ( 'groupOptions', $groupOptions );
Template::display ( 'admin/group.tpl' );