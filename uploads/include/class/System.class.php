<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class System extends Base{
	private static $table_name = 'system';
	private static $columns = array('key_name', 'key_value');
	
	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}
	
	public static function set($key_name, $key_value) {
	
		$key_value= json_encode($key_value);
		$sql = "insert into ".self::getTableName() ." values ('$key_name' ,'$key_value') on duplicate key update key_value='$key_value'";
		$db=self::__instance();
		$id = $db->query ($sql);
		
		return $id;
	}
	
	public static function get($key_name) {
		$db=self::__instance();
		$condition['key_name'] = $key_name;
		$list = $db->select ( self::getTableName(),self::$columns,$condition );
		if($list){
			return json_decode($list[0]['key_value']);
		}
		return null;
	}
}
?>