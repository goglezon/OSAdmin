<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

if ($method == 'pause' && ! empty ( $user_id )) {
	$user_data=array("status"=>0);
	
	if($user_id == UserSession::getUserId()){
		OSAdmin::alert("error",ErrorMessage::CAN_NOT_DO_SELF);
	}else{
		$result = User::updateUserInfo ( $user_id,$user_data );
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'PAUSE',  'User' ,$user_id ,json_encode($user_data) );
			Common::exitWithSuccess ( '已封停','admin/users.php' );
		}else{
			OSAdmin::alert("error");
		}
	}
}

if ($method == 'play' && ! empty ( $user_id )) {
	$user_data=array("status"=>1);
	$result = User::updateUserInfo ( $user_id,$user_data );
	if ($result>=0) {
		SysLog::addLog ( UserSession::getUserName(), 'PLAY' , 'User' ,$user_id ,json_encode($user_data) );
		Common::exitWithSuccess ( '已解封','admin/users.php' );
	}else{
		OSAdmin::alert("error");
	}
}

if ($method == 'del' && ! empty ( $user_id )) {
	if($user_id == UserSession::getUserId()){
		OSAdmin::alert("error",ErrorMessage::CAN_NOT_DO_SELF);
	}else{
		$user = User::getUserInfoById($user_id);
		$result = User::delUser ( $user_id );
		if ($result>=0) {
			$user['password']=null;
			SysLog::addLog ( UserSession::getUserName(), 'DELETE',  'User' ,$user_id ,json_encode($user) );
			Common::exitWithSuccess ( '已删除','admin/users.php' );
		}else{
			OSAdmin::alert("error");
		}
	}
}

//START 数据库查询及分页数据
$row_count = User::count ();
$page_size = PAGE_SIZE;
$page_no=$page_no<1?1:$page_no;
$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
$total_page=$total_page<1?1:$total_page;
$page_no=$page_no>($total_page)?($total_page):$page_no;
$start = ($page_no - 1) * $page_size;
//END

$user_infos = User::getAllUsers ( $start , $page_size );

// 显示分页栏
$page_html=Pagination::showPager("",$page_no,$page_size,$row_count);

//追加操作的确认层
OSAdmin::renderConfirm("icon-pause,icon-play,icon-remove");


// 设置模板变量
Template::assign ( 'user_infos', $user_infos );
Template::assign ( 'page_no', $page_no );
Template::assign ( 'page_html', $page_html );
Template::display ( 'admin/users.tpl' );
