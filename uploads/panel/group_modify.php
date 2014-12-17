<?php
require ('../include/init.inc.php');
$group_id = $group_name = $group_desc = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );
 
Common::checkParam($group_id);

$group = UserGroup::getGroupById ( $group_id );
if(empty($group)){
	Common::exitWithError(ErrorMessage::GROUP_NOT_EXIST,"panel/groups.php");
}

if (Common::isPost ()) {
	
	if($group_name =="" ){
		 
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$update_data = array ('group_name' => $group_name, 'group_desc' => $group_desc);
		$result = UserGroup::updateGroupInfo ( $group_id,$update_data );
		
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'UserGroup' ,$group_id, json_encode($update_data) );
			Common::exitWithSuccess ( '账号组修改完成','panel/groups.php' );
		} else {
			 
			OSAdmin::alert("error");
		}
	}
}

$groupOptions=UserGroup::getGroupForOptions();

Template::assign ( 'group', $group );
Template::assign ( 'groupOptions', $groupOptions );
Template::display ( 'panel/group_modify.tpl' );