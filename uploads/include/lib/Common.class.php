<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class Common {

	//获取OSAdmin的action_url，用于权限验证
	public static function getActionUrl(){
		$action_script=$_SERVER['SCRIPT_NAME'];
		$admin_url = strtolower(ADMIN_URL);
		if($admin_url{strlen($admin_url)-1}=="/"){
			$admin_url = substr($admin_url,0,strlen($admin_url)-1);
		}
	
		$http_pos = strpos($admin_url,'http://');
		
		if($http_pos !== false){
			$admin_url_no_http = substr($admin_url,7);			
		}else{
			$admin_url_no_http=$admin_url;
		}
		$slash = 0;
		$slash=strpos($admin_url_no_http,'/');
		
		if($slash){
			$sub_dir = substr($admin_url_no_http,$slash);
			$action_url = substr($action_script,strlen($sub_dir));
		}else{
			$action_url =$action_script;
		}
		return str_replace('//','/',$action_url);
	}
	public static function exitWithMessage($message_detail, $forward_url, $second = 3,$type="message") {

		switch ($type) {
			case "success" :
				$page_title="操作成功！";
				break;
			case "error":
				$page_title="错误!";
				break;
			default:
				$page_title="嗯!";
				break;
		}
		$temp = explode('?',$forward_url);
		$file_url = $temp[0];
		if($file_url{0} !=="/"){
			$file_url ='/'.$file_url;
			$forward_url ='/'.$forward_url;
		}
		$menu = MenuUrl::getMenuByUrl($file_url);
		$forward_title = "首页";
		if(sizeof($menu)>0){
			$forward_title = $menu['menu_name'];
		}
		if ($forward_url) {
			$message_detail = "$message_detail <script>setTimeout(\"window.location.href ='".ADMIN_URL."$forward_url';\", " . ($second * 1000) . ");</script>";
		}
		Template::assign ( 'type', $type );
		Template::assign ( 'page_title', $page_title );
		Template::assign ( 'message_detail', $message_detail );
		Template::assign ( 'forward_url', $forward_url );
		Template::assign ( 'forward_title', $forward_title);
		Template::Display ( 'message.tpl' );
		exit();
	}
	
	public static function exitWithError($message_detail, $forward_url, $second = 3,$type="error") {
		self::exitWithMessage($message_detail, $forward_url, $second ,$type);
	}
	
	public static function exitWithSuccess($message_detail, $forward_url, $second = 3 ,$type="success") {
		self::exitWithMessage($message_detail, $forward_url, $second, $type);
	}
	
	public static function checkParam($param,$to_url=null){
		
		if($to_url == null ){
			if(array_key_exists('HTTP_REFERER',$_SERVER)){
				$referer = $_SERVER['HTTP_REFERER'];
			}
			if(!empty($referer)){
				$start = strpos($referer,ADMIN_URL);
				$to_url = substr($referer,$start+strlen(ADMIN_URL));
			}else{
				$to_url = 'index.php';
			}
		}
		
		if (empty ( $param )) {
			Common::exitWithError ( '缺少必要的参数', $to_url ,3,"error" );
		}
	}
	
	public static function jumpUrl($url) {
		
		Header ( "Location: ".ADMIN_URL."/$url" );
		return true;
	}
	
	public static function isPost() {
		return $_SERVER ['REQUEST_METHOD'] === 'POST' ? TRUE : FALSE;
	}
	
	public static function isGet() {
		return $_SERVER ['REQUEST_METHOD'] === 'GET' ? TRUE : FALSE;
	}
	
	public static function getIp() {
		if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" )) {
			$ip = getenv ( "HTTP_CLIENT_IP" );
		} elseif (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" )) {
			$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
		} elseif (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" )) {
			$ip = getenv ( "REMOTE_ADDR" );
		} elseif (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" )) {
			$ip = $_SERVER ['REMOTE_ADDR'];
		} else {
			$ip = "unknown";
		}
		return ($ip);
	}
	
	public static function getDateTime($time = null) {
		
		return (!is_numeric($time)) ? date ( 'Y-m-d H:i:s' ) : date( 'Y-m-d H:i:s', $time);
	}
	
	public static function getTime() {
		return strtotime(date( 'Y-m-d H:i:s' ));
	}
	
	public static function getSysInfo() {
		$sys_info_array = array ();
		$sys_info_array ['gmt_time'] = gmdate ( "Y年m月d日 H:i:s", time () );
		$sys_info_array ['bj_time'] = gmdate ( "Y年m月d日 H:i:s", time () + 8 * 3600 );
		$sys_info_array ['server_ip'] = gethostbyname ( $_SERVER ["SERVER_NAME"] );
		$sys_info_array ['software'] = $_SERVER ["SERVER_SOFTWARE"];
		$sys_info_array ['port'] = $_SERVER ["SERVER_PORT"];
		$sys_info_array ['admin'] = $_SERVER ["SERVER_ADMIN"];
		$sys_info_array ['diskfree'] = intval ( diskfreespace ( "." ) / (1024 * 1024) ) . 'Mb';
		$sys_info_array ['current_user'] = @get_current_user ();
		$sys_info_array ['timezone'] = date_default_timezone_get();
		$db=new Medoo(OSA_DB_ID);
		$mysql_version = $db->query("select version()")->fetchAll();
		$sys_info_array ['mysql_version'] = $mysql_version[0]['version()'];
		return $sys_info_array;
	}
	
	public static function transact($options) {
		$temp_array = array ();
		foreach ( $options as $k => $v ) {
			if (is_null ( $v ) || (is_string ( $v ) && trim ( $v ) == ''))
				$v = '';
			else
				is_array ( $v ) ? $v = self::transact ( $v ) : $v = ( string ) $v;
			$temp_array [$k] = $v;
		}
		return $temp_array;
	}
	
	public static function getRandomIp() {
		$ip = '';
		for($i = 0; $i < 4; $i ++) {
			$ip_str = rand ( 1, 255 );
			$ip .= ".$ip_str";
		}
		$ip = substr($ip, 1);
		
		return $ip;
	}
	
	public static function filterText($text){
		if(ini_get('magic_quotes_gpc')){
			$text=stripslashes($text);
		}
		return $text;
	}
}