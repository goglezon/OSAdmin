<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class UserSession{
	public static function setSessionInfo($user_info){
		$_SESSION['user_info'] = $user_info;
		return true;
	}
	
	public static function getSessionInfo(){
		$user_info = array();
		$user_info = $_SESSION['user_info'];
		return $user_info;
	}
	
	public static function getUserName(){
		$user_name = '';
		$user_name = $_SESSION['user_info']['user_name'];
		return $user_name;
	}
	
	public static function getUserId(){
		$admin_id = '';
		$admin_id = $_SESSION['user_info']['user_id'];
		return $admin_id;
	}
	
	public static function getRealName(){
		$real_name = '';
		$real_name = $_SESSION['user_info']['real_name'];
		return $real_name;
	}
	
	public static function getUserGroup(){
		$purviews = '';
		$purviews = $_SESSION['user_info']['user_group'];
		return $purviews;
	}
	
	public static function getTemplate(){
		$template = '';
		$template = $_SESSION['user_info']['template'];
		return $template;
	}
	
    public static function clear(){
        $_SESSION['user_info'] = null;
        return true; 
    }
	
	public static function reload(){
		$current_user_info=self::getSessionInfo();
		$user_info = User::getUserById($current_user_info['user_id']);

		if($user_info['status']!=1){
			Common::jumpUrl("login.php");
			return;
		}
		
		//读取该用户所属用户组将该组的权限保存在$_SESSION中
		$user_group = UserGroup::getGroupById($user_info['user_group']);
		$user_info['group_id']=$user_group['group_id'];
		$user_info['user_role']=$user_group['group_role'];
		$user_info['shortcuts_arr']=explode(',',$user_info['shortcuts']);
		$menu = MenuUrl::getMenuByUrl('/admin/setting.php');
		if(strpos($user_group['group_role'],$menu['menu_id'])){
			$user_info['setting']=1;
		}
		$user_info['login_time']=Common::getDateTime($user_info['login_time']);
		UserSession::setSessionInfo( $user_info);
	}
}