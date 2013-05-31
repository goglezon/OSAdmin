<?php 
require ('../include/init.inc.php');
$user_name = $password = $real_name = $mobile = $email = $user_desc = $change_password = $show_quicknote = $old = $new= '';
extract ( $_POST, EXTR_IF_EXISTS );
$current_user_id=UserSession::getUserId();
//e10adc3949ba59abbe56e057f20f883e
if (Common::isPost()) {
	if($change_password){
		$ret=User::checkPassword(UserSession::getUserName(),$old);
		if($ret){
			if(strlen($new)<6){
		
				OSAdmin::alert("error",ErrorMessage::PWD_TOO_SHORT);
			}else{
				$user_data['password']=md5($new);
				User::updateUserInfo ( $current_user_id, $user_data );
				
				//OSAdmin::alert("success",ErrorMessage::PWD_UPDATE_SUCCESS);
				Common::exitWithSuccess (ErrorMessage::PWD_UPDATE_SUCCESS,'/index.php');
				SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'User' , UserSession::getUserId() );
			}
		}else{
			OSAdmin::alert("error",ErrorMessage::OLD_PWD_WRONG);
		}
	}else{
		$user_data['real_name']=$real_name;
		$user_data['mobile']=$mobile;
		$user_data['email']=$email;
		$user_data['user_desc']=$user_desc;
		$user_data['show_quicknote']=$show_quicknote;
		
		User::updateUserInfo ( $current_user_id, $user_data );
		
		UserSession::reload();
		
		//OSAdmin::alert("success");
		Common::exitWithSuccess ('资料修改成功','/index.php');
		SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'User' ,$current_user_id, json_encode($user_data) );
	}
}

$quicknoteOptions=array("1"=>"显示","0"=>"不显示");

//更新Session里的用户信息
Template::assign("user_info",UserSession::getSessionInfo());
Template::assign("quicknoteOptions",$quicknoteOptions);
Template::display ( 'admin/profile.tpl' );
?>


