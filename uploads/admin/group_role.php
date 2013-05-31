<?php
require ('../include/init.inc.php');
$group_id = '';
$menu_id = array ();
extract ( $_REQUEST, EXTR_IF_EXISTS );

$group_id =  $group_id == ""? 1:intval($group_id);
if (Common::isPost ()) {
	$group_role = join ( ',', $menu_id );
	$group_data = array ('group_role' => $group_role );
	$result = UserGroup::updateGroupInfo ( $group_id, $group_data );
	if ($result>=0) {
		SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'UserGroup' ,$group_id, json_encode($group_data) );
		UserSession::reload();
		Common::exitWithSuccess (ErrorMessage::SUCCESS_NEED_LOGIN,'admin/group_role.php');
	}else{
		OSAdmin::alert("error");
	}	
}

$group_option_list = GroupRole::getGroupForOptions ();
$group_info = UserGroup::getGroupById ( $group_id );
if(!$group_info){
	$group_id =1;
	$group_info = UserGroup::getGroupById ( $group_id );
}
$role_list = GroupRole::getGroupRoles ( $group_id );

$group_role = $group_info ['group_role'];
$group_role_array = explode ( ',', $group_role );

Template::assign ( 'role_list', $role_list );
Template::assign ( 'group_id', $group_id );
Template::assign ( 'group_option_list', $group_option_list );
Template::assign ( 'group_role', $group_role_array );
Template::display ( 'admin/group_role.tpl' );