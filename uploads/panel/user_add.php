<?php
require ('../include/init.inc.php');
$user_name = $real_name = $mobile = $password  = $email = $user_desc = $user_group = '';
extract ( $_POST, EXTR_IF_EXISTS );

if (Common::isPost ()) {
	$exist = User::getUserByName($user_name);
	if($exist){
		
		OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
	}else if($password=="" || $real_name=="" || $mobile =="" || $email =="" || $user_group <= 0 ){
		
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$input_data = array ('user_name' => $user_name, 'password' => md5 ( $password ), 'real_name' => $real_name, 'mobile' => $mobile, 'email' => $email, 'user_desc' => $user_desc, 'user_group' => $user_group );
		$user_id = User::addUser ( $input_data );
		
		if ($user_id) {
			$input_data['password']="";
			SysLog::addLog ( UserSession::getUserName(), 'ADD', 'User' ,$user_id, json_encode($input_data) );
			Common::exitWithSuccess ('账号添加成功','panel/users.php');
		}else{
			OSAdmin::alert("error");
		}
	}
}
$group_options = UserGroup::getGroupForOptions();
Template::assign("_POST" ,$_POST);
Template::assign ( 'group_options', $group_options );
Template::display ( 'panel/user_add.tpl' );
