<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class SysLog extends Base{
	private static $table_name = 'sys_log';
	private static $columns = array('op_id', 'user_name', 'action', 'class_name', 'class_obj', 'result', 'op_time');
	
	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}
	
	public static function addLog($user_name, $action, $class_name , $class_obj ,$result = "") {
		$now_time=time();
		$insert_data = array ('user_name' => $user_name, 'action' => $action, 'class_name' => $class_name ,'class_obj' => $class_obj , 'result' => $result ,'op_time' => $now_time);
		$db=self::__instance();
		$id = $db->insert ( self::getTableName(), $insert_data );
		return $id;
	}
	
	public static function getLogs($class_name,$user_name,$start ,$page_size,$start_date='',$end_date='') {
		$db=self::__instance();
		
		$condition=array();
		$sub_condition = array();
		if($class_name != ''){
			$sub_condition['class_name']=$class_name;
		}	
		if($user_name != ''){
			$sub_condition['user_name']=$user_name;
		}
		if($start_date !='' && $end_date !=''){
			$sub_condition["op_time[<>]"] =array($start_date,$end_date);
		}
		if(empty($sub_condition)){
			$condition = array();
		}else{
			$condition["AND"] = $sub_condition;
		}
		
		$condition["ORDER"]=" op_id desc";
		$condition['LIMIT']=array($start,$page_size);

		$list = $db->select ( self::getTableName(), self::$columns, $condition);
		if(!empty($list)){
			foreach ($list as &$item){
				$item['op_time']=Common::getDateTime($item['op_time']);
			}
		}

		if ($list) {
			return $list;
		}
		return array ();
	}
	
	public static function count($class_name='',$user_name=0) {
		$db=self::__instance();
		
		$sub_condition = array();
		if($class_name != ''){
			$sub_condition['class_name[=]']=$class_name;
		}
		if($user_name != ''){
			$sub_condition['user_name']=$user_name;
		}
		
		if(empty($sub_condition)){
			$condition = array();
		}else{
			$condition["AND"] = $sub_condition;
		}
		
		$num = $db->count ( self::getTableName(),$condition);
		return $num;
	}
	
	public static function getCountByDate($class_name,$user_name,$start_date,$end_date) {
		$db=self::__instance();
		$condition=array();
		if($class_name != ''){
			$sub_condition['class_name']=$class_name;
		}
		if($user_name != ''){
			$sub_condition['user_name']=$user_name;
		}
		$sub_condition["op_time[<>]"] =array($start_date,$end_date);
		$condition["AND"] = $sub_condition;
		
		$num = $db->count ( self::getTableName(),$condition );
		return $num;
	}
}
?>