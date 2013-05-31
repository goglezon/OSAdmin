<?php
class MemcacheQueue {
	const MEMQ_LOG_FILE_PATH = 'memq/';
	const MEMQ_LOG_FILE_SET_NAME = 'memq_set';
	const MEMQ_LOG_FILE_GET_NAME = 'memq_get';
	
	private $memcache_queue = null;
	
	private static $memq_instance = array ();
	
	/**
	 * 对外提供 
	 * @param string $cluster 队列配置关键字 
	 * @return  mq实例
	 */
	static public function Instance($cluster) {
		return self::$memq_instance [$cluster] = new MemcacheQueue ( $cluster );
	}
	
	/**
	 * 内部封装 
	 * @param string $cluster 队列配置关键字 
	 * @return  mq实例
	 */
	static private function _CreateInstance($cluster) {
		global $MEMCACHEQ_LIST;
		$memq_config = $MEMCACHEQ_LIST [$cluster];
		if (! $memq_config) {
			return false;
		}
		$memq_instance = new MemCache ();
		$timeout = isset ( $memq_config ['timeout'] ) ? $memq_config ['timeout'] : 1;
		$memq_instance->pconnect ( $memq_config ['host'], $memq_config ['port'], $timeout );
		return $memq_instance;
	}
	
	private function __construct($cluster) {
		$this->memcache_queue = self::_CreateInstance ( $cluster );
	}
	
	/**
	 * 
	 * @param mixed $queue_name 队列名 
	 * @param mixed $value 值
	 * @return 设置结果 成功为true ,不成功为false
	 */
	function Add($queue_name, $value) {
		if (! $queue_name || ! $value)
			return false;
		return memcache_set ( $this->memcache_queue, $queue_name, $value, 0, 0 );
	
	}
	
	/**
	 * 
	 * @param mixed $qname 队列名 
	 * @return 成功时返回获取到的值，失败为false
	 */
	function Get($queue_name) {
		if (! $queue_name)
			return false;
		$item = memcache_get ( $this->memcache_queue, $queue_name );
		if (! $item) {
			self::Close ();
		}
		return $item;
	}
	
	/**
	 * 
	 * @return 关闭实例连接
	 */
	function Close() {
		return memcache_close ( $this->memcache_queue );
	}
	
	/**
	 * 
	 * @param mixed $ip  服务器ip
	 * @param mixed $port 服务器端口号
	 * @return 获取所有队列状态
	 */
	public static function QueueStats($ip, $port) {
		$sock = fsockopen ( $ip, $port );
		if ($sock) {
			fwrite ( $sock, "stats queue\n" );
			$buffer = fread ( $sock, 4096 );
			fclose ( $sock );
		}
		return $buffer;
	}
	public static function QueueStatsAll($queue_infos) {
		if (! $queue_infos)
			return array ();
		$ret = array ();
		foreach ( $queue_infos as $value ) {
			$key = $value ['host'] . ':' . $value ['port'];
			$ret [$key] = mqueue_stats ( $value ['host'], $value ['port'] );
		}
		return $ret;
	}
	/**
	 * 获得服务器状态
	 */
	public static function QueueRuntimeStats($ip, $port) {
		$m = new Memcache ();
		$m->connect ( $ip, $port );
		return $m->getStats ();
	}
	/**
	 * 
	 * @param mixed $queue_infos 队列相关信息
	 * @return 队列相关信息
	 */
	public static function QueueRuntimeStatsAll($queue_infos) {
		if (! $queue_infos)
			return array ();
		$ret = array ();
		foreach ( $queue_infos as $value ) {
			$key = $value ['host'] . ':' . $value ['port'];
			$ret [$key] = mqueue_runtime_stats ( $value ['host'], $value ['port'] );
		}
		return $ret;
	}
	
	/**
	 * 
	 * @param mixed $queue_obj memcache_queue连接
	 * @param mixed $queue_value 值
	 * @param mixed $queue_name 队列名
	 * @return true/false
	 */
	public static function SetQueue($queue_obj, $queue_name, $queue_value) {
		if (empty ( $queue_obj ) || empty ( $queue_value ) || empty ( $queue_name )) {
			return false;
		}
		$result = $queue_obj->add ( $queue_name, $queue_value );
		if (! $result) {
			self::QueueSleep ();
			$result = $queue_obj->add ( $queue_name, $queue_value );
		}
		
		$op_result = $result ? 'ok' : 'fail';
		$log_array = array ('queue_name' => $queue_name, 'queue_value' => $queue_value, 'result' => $op_result );
		LogToFile::saveLog ( self::MEMQ_LOG_FILE_PATH, self::MEMQ_LOG_FILE_SET_NAME, $log_array );
		
		return true;
	}
	
	/**
	 * 
	 * @param mixed $queue_obj 队列连接
	 * @param mixed $queue_name 队列名
	 * @param mixed $log 日志名
	 * @return mixed/false
	 */
	public static function GetQueue($queue_obj, $queue_name) {
		
		if (empty ( $queue_obj ) || empty ( $queue_name )) {
			return false;
		}
		$result = $queue_obj->Get ( $queue_name );
		if (! $result) {
			self::QueueSleep ();
			$result = $queue_obj->Get ( $queue_name );
		}
		
		$op_result = $result ? 'ok' : 'fail';
		$log_array = array ('queue_name' => $queue_name, 'data' => $result, 'result' => $op_result );
		LogToFile::saveLog ( self::MEMQ_LOG_FILE_PATH, self::MEMQ_LOG_FILE_GET_NAME, $log_array );
		return $result ? $result : false;
	}
	
	/**
	 * 
	 * @return 失败后休息时间
	 */
	public static function QueueSleep() {
		usleep ( 10000 );
	}
}
