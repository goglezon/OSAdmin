<?php
if(!defined('ACCESS')) {exit('Access denied.');}

class OSAdmin extends Base {
	public static function showQuickNote(){
		$note = QuickNote::getRandomNote();
		$note_content=$note['note_content'];
		$note_html="<div class=\"alert alert-info\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>$note_content</div>";
		Template::assign("osadmin_quick_note",$note_html);
	}
	
	public static function alert($type,$message=""){
		if($message == "") {
			switch(strtolower($type)){
				case "success":
					$message=ErrorMessage::SUCCESS;
					break;
				case "error" :
					$message=ErrorMessage::ERROR;
					break;
			}
		}
		$alert_html="<div class=\"alert alert-$type\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>$message</div>";
		Template::assign("osadmin_action_alert",$alert_html);
	}
	
	public static function renderConfirm($class,$confirm_title="确定要这样做吗？"){
		$confirm_html="<script type=\"text/javascript\">";
		if(!is_array($class)){
			$class=explode(',',$class);
		}
		
		foreach($class as $item){
			$confirm_html .= "
				$('.$item').click(function(){
						
						var href=$(this).attr('href');
						bootbox.confirm('$confirm_title', function(result) {
							if(result){

								location.replace(href);
							}
						});		
					})
					
				";
		}
	
		$confirm_html.="</script>";	
		Template::assign("osadmin_action_confirm",$confirm_html);
	}
	
	public static function _restore_db_($sql_file){
		$file = file($sql_file);
		$sql = implode('',$file);
		$db=self::__instance();
		$ret = $db->query($sql);
		//print_r($db->error());
		return $ret;
	}
}
