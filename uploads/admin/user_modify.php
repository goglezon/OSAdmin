<?php
require ('../include/init.inc.php');
$user_id = $user_name = $real_name = $mobile = $password = $email = $user_desc = $user_group = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

Common::checkParam($user_id);

if (Common::isPost ()) {
	
	if($real_name=="" || $mobile =="" || $email =="" || $user_group <= 0 ){
		
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$update_data = array ('user_name' => $user_name, 'real_name' => $real_name, 'mobile' => $mobile,
							'email' => $email, 'user_desc' => $user_desc , "user_group"=>$user_group );
		if (! empty ( $password )) {
			$update_data = array_merge ( $update_data, array ('password' => md5 ( $password ) ) );
		}
		
		$result = User::updateUserInfo ( $user_id,$update_data );
		
		if ($result>=0) {
			$current_user=UserSession::getSessionInfo();
			$update_data['password']="";
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'User' , $user_id, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','admin/users.php');
		} else {
			
			OSAdmin::alert("error");
		}
	}
}

$user = User::getUserInfoById ( $user_id );
$group_options=UserGroup::getGroupForOptions();

Template::assign ( 'user', $user );
Template::assign ( 'group_options', $group_options );
Template::display ( 'admin/user_modify.tpl' );