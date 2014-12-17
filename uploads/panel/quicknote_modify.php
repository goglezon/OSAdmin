<?php
require ('../include/init.inc.php');
$note_id = $note_content ='';
extract ( $_REQUEST, EXTR_IF_EXISTS );
Common::checkParam($note_id);

$quicknote = QuickNote::getNoteById ( $note_id );
if(empty($quicknote)){
	Common::exitWithError(ErrorMessage::QUICKNOTE_NOT_EXIST,"panel/quicknotes.php");
}

if (Common::isPost ()) {
	$note_content = Common::filterText($note_content);
	if($note_content =="" ){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$current_user_info=UserSession::getSessionInfo();
		$user_group = $current_user_info['user_group'];
		$current_user_id = $current_user_info['user_id'];
		if($user_group ==1 || $quicknote['owner_id'] == $current_user_id){
			$note_content = htmlspecialchars($note_content);
			$update_data = array ('note_content' => $note_content);
			$result = QuickNote::updateNote( $note_id,$update_data );
			
			if ($result>=0) {
				SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'QuickNote' ,$note_id, json_encode($update_data) );
				Common::exitWithSuccess ('更新完成','panel/quicknotes.php');
			} else { 
				OSAdmin::alert("error");
			}
		}else{
			OSAdmin::alert("error",ErrorMessage::QUICKNOTE_NOT_OWNER);
		}
	}
}

Template::assign ( 'quicknote', $quicknote );
Template::display ( 'panel/quicknote_modify.tpl' );