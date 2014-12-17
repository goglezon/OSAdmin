<?php
require ('../include/init.inc.php');
$note_content = '';
extract ( $_POST, EXTR_IF_EXISTS );
$note_content = Common::filterText($note_content);
if (Common::isPost ()) {
	
	if($note_content ==""){
		
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$note_content = htmlspecialchars($note_content);
		$input_data = array ('note_content' => $note_content, 'owner_id' => UserSession::getUserId() );
		$note_id = QuickNote::addNote ( $input_data );
		
		if ($note_id) {
			SysLog::addLog ( UserSession::getUserName(), 'ADD', 'QuickNote' ,$note_id, json_encode($input_data) );
			Common::exitWithSuccess ('便签添加成功','panel/quicknote_add.php');
		}
	}
}

Template::assign("_POST" ,$_POST);
Template::display('panel/quicknote_add.tpl' );
