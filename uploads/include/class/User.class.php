<?php
if(!defined('ACCESS')) {exit('Access denied.');}

class User extends Base{
	// 表名
	private static $table_name = 'user';
	// 查询字段
	private static $columns = array('user_id', 'user_name', 'password', 'real_name', 'mobile', 'email', 'user_desc', 'login_time', 'status', 'login_ip', 'user_group', 'template', 'shortcuts', 'show_quicknote');
	//状态定义
	const ACTIVE = 1;
	const DEACTIVE = 0;
	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}
	
	public static function getUserByName($user_name) {
		$db=self::__instance();
		$sql= "select * ,g.group_name from ".self::getTableName() ." u,".UserGroup::getTableName()." g where u.user_name='$user_name' and u.user_group=g.group_id";
		$list = $db->query($sql)->fetch();// self::getTableName(), self::$columns, $condition );
		if ($list) {
			$list['login_time']=Common::getDateTime($list['login_time']);
			return $list;
		}
		return array ();
	}
	
	public static function getUserById($user_id) {
		if (! $user_id || ! is_numeric ( $user_id )) {
			return false;
		}
		$db=self::__instance();
		$condition = array("AND" => 
						array("user_id[=]" => $user_id,
						)
					);
		$list = $db->select ( self::getTableName(), self::$columns, $condition );
		
		if ($list) {
			$list[0]['login_time']=Common::getDateTime($list[0]['login_time']);
			return $list [0];
		}
		return array ();
	}
	
	public static function setCookieRemember($encrypted,$day=7){
		setcookie("osa_remember",$encrypted,time()+3600*24*$day);
	}
	
	public static function getCookieRemember(){
		$encrypted = $_COOKIE["osa_remember"];
		$base64=urldecode($encrypted);
		return OSAEncrypt::decrypt($base64);
	}
	
	public static function logout(){
		setcookie("osa_remember","",time()-3600);
		unset($_SESSION[UserSession::SESSION_NAME]);
		unset($_SESSION['osa_timezone']);
	}
	
	public static function getAllUsers( $start ='' ,$page_size='' ) {
		$db=self::__instance();
		$limit ="";
		if($page_size){
			$limit =" limit $start,$page_size ";
		}
		$sql = "select * ,coalesce(g.group_name,'已删除') from ".self::getTableName()." u left join ".UserGroup::getTableName()." g on u.user_group = g.group_id order by u.user_id desc $limit";
		
		$list=$db->query($sql)->fetchAll();
		if(!empty($list)){
			foreach($list as &$item){
				
				$item['login_time']=Common::getDateTime($item['login_time']);
			}
		}
		
		if ($list) {
			return $list;
		}
		return array ();
	}
	
	public static function search($user_group ,$user_name, $start ='' ,$page_size='' ) {
		$db=self::__instance();
		$limit ="";
		$where = "";
		if($page_size){
			$limit =" limit $start,$page_size ";
		}
		if($user_group >0  && $user_name!=""){
			$where = " where u.user_group=$user_group and u.user_name like '%$user_name%'";
		}else{
			if($user_group>0){
				$where = " where u.user_group=$user_group ";
			}
			if($user_name!=""){
				$where = " where u.user_name like '%$user_name%' ";
			}
		}
		$sql = "select * ,coalesce(g.group_name,'已删除') from ".self::getTableName()." u left join ".UserGroup::getTableName()." g on u.user_group = g.group_id $where order by u.user_id desc $limit";
		
		$list=$db->query($sql)->fetchAll();
		if(!empty($list)){
			foreach($list as &$item){
				
				$item['login_time']=Common::getDateTime($item['login_time']);
			}
		}
		if ($list) {
			return $list;
		}
		return array ();
	}
	
	public static function getUsersByGroup( $group_id ) {
		$db=self::__instance();
		$condition = array("AND" => 
						array("user_group[=]" => $group_id,
						)
					);
		$list = $db->select( self::getTableName(), self::$columns, $condition );
		if ($list) {
			foreach($list as &$item){
				if($item['login_time']==null){
					;
				}else{
					$item['login_time']=Common::getDateTime($item['login_time']);
				}
			}
			return $list;
		}
		return array ();
	}
	
	public static function checkLogin() {
		$user_info = UserSession::getSessionInfo ();
		if (empty ( $user_info )) {
			Common::jumpUrl("panel/login.php");
			return true;
		}
	}
	
	public static function checkActionAccess() {
		$action_url = Common::getActionUrl();
		
		
		$user_info = UserSession::getSessionInfo();
		
		$role_menu_url = MenuUrl::getMenuByRole ( $user_info['user_role']);
		
		$search_result = in_array ( $action_url, $role_menu_url );
		if (! $search_result) {
			Common::exitWithMessage ('您当前没有权限访问该功能，如需访问请联系管理员开通权限','index.php' );
			return true;
		}
	}
	
	public static function checkPassword($user_name, $password) {
		$md5_pwd = md5 ( $password );
		$db=self::__instance();
		$condition = array("AND"=>
						array("user_name" => $user_name,
							"password" => $md5_pwd,
						)
					);
					
		$list = $db->select( self::getTableName(), self::$columns, $condition );
		
		if ($list) {
			
			return $list [0];
		} else {
			return false;
		}
	}
	
	public static function updateUser($user_id,$user_data) {
		
		if (! $user_data || ! is_array ( $user_data )) {
			return false;
		}
		$db=self::__instance();
		$condition=array("user_id"=>$user_id);
		
		$id = $db->update ( self::getTableName(), $user_data, $condition );
		return $id;
	}
	
	/**
	* 批量修改用户，如批量修改用户分组
	* user_ids 可以为无key数组，也可以为1,2,3形势的字符串
	*/
	public static function batchUpdateUsers($user_ids,$user_data) {

		if (! $user_data || ! is_array ( $user_data )) {
			return false;
		}
		if(!is_array($user_ids)){
			$user_ids=explode(',',$user_ids);
		}
		$db=self::__instance();
		$condition=array("user_id"=>$user_ids);
		
		$id = $db->update ( self::getTableName(), $user_data, $condition );
		return $id;
	}
	
	public static function addUser($user_data) {
		if (! $user_data || ! is_array ( $user_data )) {
			return false;
		}
		$db=self::__instance();
		$id = $db->insert ( self::getTableName(), $user_data );
		return $id;
	}
	
	public static function delUser($user_id) {
		if (! $user_id || ! is_numeric ( $user_id )) {
			return false;
		}
		$db=self::__instance();
		$condition = array("user_id"=>$user_id);
		$result = $db->delete ( self::getTableName(), $condition );
		return $result;
	}
	
	public static function delUserByUserName($user_name) {
		if (! $user_name ) {
			return false;
		}
		$db=self::__instance();
		$condition = array("user_name"=>$user_name);
		$result = $db->delete ( self::getTableName(), $condition );
		return $result;
	}
	
	public static function count($condition = '') {
		$db=self::__instance();
		$num = $db->count ( self::getTableName(), $condition );
		return $num;
	}
	
	public static function countSearch($user_group,$user_name) {
		$db=self::__instance();
		$condition = array();
		if($user_group >0  && $user_name!=""){
			$condition['user_group']=$user_group;
			$condition['LIKE']=array("user_name"=>$user_name);
		}else{
			if($user_group>0){
				$condition['user_group']=$user_group;
			}
			if($user_name!=""){
				$condition['LIKE']=array("user_name"=>$user_name);
			}
		}
		$num = $db->count( self::getTableName(), $condition);
		return $num;
	}
	
	public static function setTemplate($user_id,$template){
		$user_data=array("template"=>$template);
		$ret=self::updateUser($user_id,$user_data);
		return $ret;
	}
	
	public static function loginDoSomething($user_id){
		
		$user_info = User::getUserById($user_id);
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
		
		$login_time = time();
		$login_ip = Common::getIp ();
		$update_data = array ('login_ip' => $login_ip, 'login_time' => $login_time );
		User::updateUser ( $user_info['user_id'], $update_data );
		$user_info['login_ip']=$login_ip;
		$user_info['login_time']=Common::getDateTime($login_time);
		UserSession::setSessionInfo( $user_info);
	}
}