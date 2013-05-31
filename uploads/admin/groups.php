<?php
require ('../include/init.inc.php');
$method = $group_id = '';
extract ( $_GET, EXTR_IF_EXISTS );

if ($method == 'del' && ! empty ( $group_id )) {
	$users = UserGroup::getGroupUsers($group_id);
	if(sizeof($users)>0){
		
		OSAdmin::alert("error",ErrorMessage::HAVE_USER);
	}else{
		$group = UserGroup::getGroupById($group_id);
		$result = UserGroup::delGroup ( $group_id );
		if ($result>0) {
			SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'UserGroup',$group_id, json_encode($group) );
			Common::exitWithSuccess ('已将账号组删除','admin/groups.php');
		}else{
			OSAdmin::alert("error");
		}
	}
}

$groups = UserGroup::getAllGroup();
OSAdmin::renderConfirm("icon-remove");
Template::assign ( 'groups', $groups );
Template::display ( 'admin/groups.tpl' );
