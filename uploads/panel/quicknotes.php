<?php
require ('../include/init.inc.php');
$method = $page_no = $note_id = '';
extract ( $_GET, EXTR_IF_EXISTS );

//START 数据库查询及分页数据
$row_count = QuickNote::count ();
$page_size = PAGE_SIZE;
$page_no=$page_no<1?1:$page_no;
$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
$total_page=$total_page<1?1:$total_page;
$page_no=$page_no>($total_page)?($total_page):$page_no;
$start = ($page_no - 1) * $page_size;

$current_user_info=UserSession::getSessionInfo();
$user_group = $current_user_info['user_group'];
$current_user_id = $current_user_info['user_id'];

if ($method == 'del' && ! empty ( $note_id )) {
	
	$note = QuickNote::getNoteById($note_id);
	
	//是超级管理员组的成员或者是quicknote的主人
	if($user_group ==1 || $note['owner_id'] == $current_user_id){
		$result = QuickNote::delNote ( $note_id );
		if ($result>0) {
			SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'QuickNote',$note_id, json_encode($note) );
			Common::exitWithSuccess ('便签删除成功','panel/quicknotes.php');
		}else{
			OSAdmin::alert("error");
		}
	}else{
		OSAdmin::alert("error",ErrorMessage::QUICKNOTE_NOT_OWNER);
	}
}

$quicknotes = QuickNote::getNotes($start,$page_size);

$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

$page_html=Pagination::showPager("",$page_no,PAGE_SIZE,$row_count);

Template::assign ( 'page_no', $page_no );
Template::assign ( 'page_size', PAGE_SIZE );
Template::assign ( 'row_count', $row_count );
Template::assign ( 'page_html', $page_html );
Template::assign ( 'quicknotes', $quicknotes );
Template::assign ( 'osadmin_action_confirm' , $confirm_html);
Template::assign ( 'user_group', $user_group );
Template::assign ( 'current_user_id', $current_user_id );
Template::display ( 'panel/quicknotes.tpl' );
