<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class Module extends Base {
	// 表名
	private static $table_name = 'module';
	// 查询字段
	private static $columns = array('module_id', 'module_name', 'module_url', 'module_sort', 'module_desc', 'module_icon', 'online');
	
	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}
	//列表 
	public static function getAllModules($is_online=null) {
		$db=self::__instance();
		$conditon=array();
		
		if(isset($is_online)){
			$condition['AND']=array("online"=>$is_online);
		}else{
		}
		$order = ' module_sort asc,module_id asc';
		$condition['ORDER']=$order;
		$list = $db->select ( self::getTableName(), self::$columns, $condition );
		if ($list) {
			return $list;
		}
		return array ();
	}
	
	public static function addModule($module_data) {
		if (! $module_data || ! is_array ( $module_data )) {
			return false;
		}
		$db=self::__instance();
		$id = $db->insert ( self::getTableName(), $module_data );
		return $id;
	}
	
	public static function getModuleById($module_id) {
		if (! $module_id || ! is_numeric ( $module_id )) {
			return false;
		}
		$db=self::__instance();
		$condition['module_id'] = $module_id;
		$list = $db->select ( self::getTableName(), self::$columns, $condition );
		if ($list) {
			return $list [0];
		}
		return array ();
	}
	
	public static function getModuleByName($module_name) {
		if (! $module_name || ! is_numeric ( $module_name )) {
			return false;
		}
		$db=self::__instance();
		$condition['module_name'] = $module_name;
		$list = $db->select ( self::getTableName(), self::$columns, $condition );
		if ($list) {
			return $list [0];
		}
		return array ();
	}
	
	public static function getModuleMenu($module_id) {
		if (! $module_id || ! is_numeric ( $module_id )) {
			return false;
		}
		$db=self::__instance();
		$sql="select * from ".self::getTableName() ." m,".MenuUrl::getTableName()." u where m.module_id = $module_id and m.module_id = u.module_id order by m.module_id,u.menu_id";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list[0];
		}
		return array ();
	}
	
	public static function updateModuleInfo($module_id,$module_data) {
		if (! $module_data || ! is_array ( $module_data )) {
			return false;
		}
		$db=self::__instance();
		$condition=array("module_id"=>$module_id);
		$id = $db->update ( self::getTableName(), $module_data, $condition );
		return $id;
	}
	
	public static function delModule($module_id) {
		if (! $module_id || ! is_numeric ( $module_id )) {
			return false;
		}
		$db=self::__instance();
		$condition = array("module_id"=>$module_id);
		$result = $db->delete ( self::getTableName(), $condition );
		return $result;
	}
	
	public static function getModuleForOptions() {
		$module_options_array = array ();
		$module_list = self::getAllModules (1);
		
		foreach ( $module_list as $module ) {
			$module_options_array [$module ['module_id']] = $module ['module_name'];
		}
		
		return $module_options_array;
	}
}
