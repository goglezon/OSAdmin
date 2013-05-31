<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class UserGroup extends Base {
	// 表名
	private static $table_name = 'user_group';
	// 查询字段
	private static $columns = 'group_id, group_name, group_role, owner_id , group_desc';
	//状态定义
	
	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}
	
	//列表 
	public static function getAllGroup() {
		$db=self::__instance();
		$sql="select ".self::$columns." ,u.user_name as owner_name from ".self::getTableName()." g left join ".User::getTableName()." u on g.owner_id =  u.user_id order by g.group_id";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			
			return $list;
		}
		return array ();
	}
	
	public static function addGroup($group_data) {
		if (! $group_data || ! is_array ( $group_data )) {
			return false;
		}
		$db=self::__instance();
		$id = $db->insert ( self::getTableName(), $group_data );
		//var_dump($db->last_query());
		return $id;
	}

	public static function getGroupById($group_id) {
		if (! $group_id || ! is_numeric ( $group_id )) {
			return false;
		}
		$db=self::__instance();
		$condition['group_id'] = $group_id;
		$list = $db->select ( self::getTableName(), self::$columns, $condition );
		if ($list) {
			return $list [0];
		}
		return array ();
	}
	
	public static function getGroupByName($group_name) {
		if ( $group_name == "" ) {
			return false;
		}
		$db=self::__instance();
		$condition['group_name'] = $group_name;
		$list = $db->select ( self::getTableName(), self::$columns, $condition );
		if ($list) {
			return $list [0];
		}
		return array ();
	}
	
	public static function updateGroupInfo($group_id,$group_data) {
		if (! $group_data || ! is_array ( $group_data )) {
			return false;
		}
		$db=self::__instance();
		$condition=array("group_id"=>$group_id);
		$id = $db->update ( self::getTableName(), $group_data,$condition );
		
		return $id;
	}
	
	public static function delGroup($group_id) {
		if (! $group_id || ! is_numeric ( $group_id )) {
			return false;
		}
		$db=self::__instance();
		$condition = array("group_id" => $group_id);
		$result = $db->delete ( self::getTableName(), $condition );
		return $result;
	}
	
	public static function getGroupForOptions() {
		//$group_options_array = array (0 => "-----分组-----");
		$group_list = self::getAllGroup ();
		
		foreach ( $group_list as $group ) {
			$group_options_array [$group ['group_id']] = $group ['group_name'];
		}
		
		return $group_options_array;
	}
	
	public static function getGroupUsers($group_id) {
		$db=self::__instance();
		$sql="select ".self::$columns." ,u.user_id as user_id,u.user_name as user_name,u.real_name as real_name from ".self::getTableName()." g,".User::getTableName()." u where g.group_id = $group_id and g.group_id = u.user_group order by g.group_id,u.user_id";
		$list = $db->query ($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array ();
	}
	/*
	public static function getNamesForLog(){
		$db=self::__instance();
		$condition=array();
		$list = $db->select ( self::getTableName(),"group_id, group_name");
		foreach($list as $item){
			$ret[get_class().'='.$item['group_id']]=$item['group_name'];
		}
		if ($ret) {
			return $ret;
		}else{
			return array();
		}
	}
	*/
}
