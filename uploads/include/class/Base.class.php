<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class Base {
	protected static $table_prefix = OSA_TABLE_PREFIX;
	protected static $db = null;
	public static function __instance($database=OSA_DB_NAME){
		if(self::$db == null){
			self::$db = new Medoo( $database );
			return self::$db;
		}
		return self::$db;
	}
	
	public static function getNamesForLog(){
		return array();
	}
	
}
