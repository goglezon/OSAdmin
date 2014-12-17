<?php
require ('../include/init.inc.php');
$user_id = $user_name = $real_name = $mobile = $password = $email = $user_desc = $user_group = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

Common::checkParam($user_id);
$user = User::getUserById ( $user_id );
if(empty($user)){
	Common::exitWithError(ErrorMessage::USER_NOT_EXIST,"panel/users.php");
}
if (Common::isPost ()) {
	
	if($real_name=="" || $mobile =="" || $email =="" || ($user_id !=1 && $user_group <= 0) ){
		
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		
		$update_data = array ('real_name' => $real_name, 'mobile' => $mobile,
							'email' => $email, 'user_desc' => $user_desc );
		if($user_id > 1 ){
			  $update_data["user_group"]=$user_group;
		}
		
		if (! empty ( $password )) {
			$update_data = array_merge ( $update_data, array ('password' => md5 ( $password ) ) );
		}
		
		$result = User::updateUser ( $user_id,$update_data );
		
		if ($result>=0) {
			$current_user=UserSession::getSessionInfo();
			$ip = Common::getIp();
			$update_data['ip']=$ip;
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'User' , $user_id, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','panel/users.php');
		} else {
			
			OSAdmin::alert("error");
		}
	}
}

$group_options=UserGroup::getGroupForOptions();

Template::assign ( 'user', $user );
Template::assign ( 'group_options', $group_options );
Template::display ( 'panel/user_modify.tpl' );