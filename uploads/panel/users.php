<?php
require ('../include/init.inc.php');
$user_group = $method = $user_name = $user_id = $page_no = $search = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );
if ($method == 'pause' && ! empty ( $user_id )) {
	$user_data=array("status"=>0);
	
	if($user_id == UserSession::getUserId()){
		OSAdmin::alert("error",ErrorMessage::CAN_NOT_DO_SELF);
	}else{
		if($user_id==1){
			Common::exitWithSuccess ( '不能封停初始管理员','panel/users.php' );
		}
		$result = User::updateUser ( $user_id,$user_data );
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'PAUSE',  'User' ,$user_id ,json_encode($user_data) );
			Common::exitWithSuccess ( '已封停','panel/users.php' );
		}else{
			OSAdmin::alert("error");
		}
	}
}

if ($method == 'play' && ! empty ( $user_id )) {
	$user_data=array("status"=>1);
	$result = User::updateUser ( $user_id,$user_data );
	if ($result>=0) {
		SysLog::addLog ( UserSession::getUserName(), 'PLAY' , 'User' ,$user_id ,json_encode($user_data) );
		Common::exitWithSuccess ( '已解封','panel/users.php' );
	}else{
		OSAdmin::alert("error");
	}
}

if ($method == 'del' && ! empty ( $user_id )) {
	if($user_id == UserSession::getUserId()){
		OSAdmin::alert("error",ErrorMessage::CAN_NOT_DO_SELF);
	}else{
		if($user_id==1){
			Common::exitWithSuccess ( '不能删除初始管理员','panel/users.php' );
		}
		$user = User::getUserById($user_id);
		$result = User::delUser ( $user_id );
		if ($result>=0) {
			$user['password']=null;
			SysLog::addLog ( UserSession::getUserName(), 'DELETE',  'User' ,$user_id ,json_encode($user) );
			Common::exitWithSuccess ( '已删除','panel/users.php' );
		}else{
			OSAdmin::alert("error");
		}
	}
}

//START 数据库查询及分页数据
$page_size = PAGE_SIZE;
$page_no=$page_no<1?1:$page_no;

if($search){
	$row_count = User::countSearch($user_group,$user_name);
	$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
	$total_page=$total_page<1?1:$total_page;
	$page_no=$page_no>($total_page)?($total_page):$page_no;
	$start = ($page_no - 1) * $page_size;
	$user_infos = User::search($user_group,$user_name,$start , $page_size);
	
}else{
	$row_count = User::count ();
	$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
	$total_page=$total_page<1?1:$total_page;
	$page_no=$page_no>($total_page)?($total_page):$page_no;
	$start = ($page_no - 1) * $page_size;
	$user_infos = User::getAllUsers ( $start , $page_size );
}

$page_html=Pagination::showPager("users.php?user_group=$user_group&user_name=$user_name&search=$search",$page_no,$page_size,$row_count);

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-pause,icon-play,icon-remove");

// 设置模板变量
$group_options=UserGroup::getGroupForOptions();
$group_options[0] = "全部";
ksort($group_options);

Template::assign ( 'group_options', $group_options );
Template::assign ( 'user_infos', $user_infos );
Template::assign ( '_GET', $_GET );
Template::assign ( 'page_no', $page_no );
Template::assign ( 'page_html', $page_html );
Template::assign ( 'osadmin_action_confirm' , $confirm_html);
Template::display ( 'panel/users.tpl' );
