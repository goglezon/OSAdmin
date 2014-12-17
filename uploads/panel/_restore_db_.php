<?php
require ('../include/init.inc.php');
$md5 = $verify_code = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

if($md5!="org.osadmin.somewhereyu"){
	Common::exitWithError ('口令错误','index.php',99999);
}
if (Common::isPost ()) {
	if(strtolower($verify_code) != strtolower($_SESSION['osa_verify_code'])){
		OSAdmin::alert("error",ErrorMessage::VERIFY_CODE_WRONG);
	}else{
		$ret = OSAdmin::_restore_db_("../sql/osadmin.sql");
		if($ret){
			SysLog::addLog ( "WARP_SPEED", '_RESOTRE_DB_', 'MYSQL' ,'STAR_TREK');
			Common::exitWithSuccess ('恢复Mysql成功','index.php',99999);
		}else{
			OSAdmin::alert("error","恢复MYSQL DB失败，可能造成数据损坏");
		}
	}
}

Template::assign ( 'page_title','恢复至初始状态' );
Template::Display ( '_restore_db_.tpl' );