<?php
require ('../include/init.inc.php');
$method = $group_id = '';
extract ( $_GET, EXTR_IF_EXISTS );

if ($method == 'del' && ! empty ( $group_id )) {
	$users = UserGroup::getGroupUsers($group_id);
	if(sizeof($users)>0){
		OSAdmin::alert("error",ErrorMessage::HAVE_USER);
	}else if(intval($group_id) === 1){
		OSAdmin::alert("error",ErrorMessage::CAN_NOT_DO_FOR_SUPER_GROUP);
	}else{
		$group = UserGroup::getGroupById($group_id);
		$result = UserGroup::delGroup ( $group_id );
		if ($result>0) {
			SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'UserGroup',$group_id, json_encode($group) );
			Common::exitWithSuccess ('已将账号组删除','panel/groups.php');
		}else{
			OSAdmin::alert("error");
		}
	}
}

$groups = UserGroup::getAllGroup();
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");
Template::assign ( 'osadmin_action_confirm' , $confirm_html);
Template::assign ( 'groups', $groups );
Template::display ( 'panel/groups.tpl' );
