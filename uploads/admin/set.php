<?php
require ('../include/init.inc.php');
$t = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );
$current_user_id = UserSession::getUserId();
$templates=array("default","blacktie","wintertide","schoolpainting");

if(!in_array($t,$templates)){
	$t="default";
}
$ret=User::setTemplate(UserSession::getUserId(),$t);
//SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'User' ,$current_user_id, json_encode($t) );
$_SESSION['user_info']['template']=$t;
$rand=rand(0,10000);
$back_url=$_SERVER['HTTP_REFERER']."#".$rand;
header("Location:$back_url");