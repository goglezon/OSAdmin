<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class SampleBase {
	//protected static $table_prefix = OSA_TABLE_PREFIX;
	protected static $db = null;
	public static function __instance($database=SAMPLE_DB_ID){
		if(self::$db == null){
			self::$db = new Medoo( $database );
			return self::$db;
		}
		return self::$db;
	}
}
