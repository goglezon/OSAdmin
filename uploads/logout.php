<?php
require('./include/init.inc.php');
if(array_key_exists("user_info",$_SESSION)){
	SysLog::addLog ( UserSession::getUserName(), 'LOGOUT','User' ,UserSession::getUserId() );
}
User::logout();
Common::exitWithSuccess("您已安全登出！","login.php");