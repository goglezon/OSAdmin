<?php
if (!defined('ACCESS')) {exit('Access denied.');}

class Sample extends SampleBase
{
//class Sample extends Base {
	private static $table_name = 'sample';

	private static $columns = 'sample_id, sample_content';

	public static function getTableName()
	{
		return self::$table_name;
	}

	public static function getSamples() {

		// 以下两种方式均可以访问 sample 的 DB
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select ".self::$columns." from ".self::getTableName();
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
}
