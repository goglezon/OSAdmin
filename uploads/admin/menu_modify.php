<?php
require ('../include/init.inc.php');
$menu_id = $menu_name = $menu_url = $module_id = $is_show =$online = $shortcut_allowed = $menu_desc = $father_menu = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

Common::checkParam($menu_id);

if (Common::isPost ()) {
	
	if($menu_name == "" || $menu_url =="" || $module_id ==""){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$update_data = array ('menu_name' => $menu_name, 'menu_url' => $menu_url, 'module_id' => $module_id, 
							'is_show' => $is_show, "online" => $online,'menu_desc' => $menu_desc, 'shortcut_allowed' => $shortcut_allowed,
							'father_menu' => $father_menu);
		
		$result = MenuUrl::updateMenuInfo ( $menu_id,$update_data );
		
		if ($result>=0) {
			SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'MenuUrl' ,$menu_id, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','admin/menus.php');
		} else {
			OSAdmin::alert("error");
		}
	}
}

$menu = MenuUrl::getMenuById ( $menu_id );

$module_options_list = Module::getModuleForOptions ();
$father_menu_options_list = MenuUrl::getFatherMenuForOptions ();

$show_options_list=array("1"=>"显示","0"=>"不显示");
$online_options_list=array("1"=>"在线","0"=>"下线");
$shortcut_allowed_options_list = array("1"=>"允许","0"=>"不允许");
Template::assign ( 'menu', $menu );
Template::assign ( 'module_options_list', $module_options_list );
Template::assign ( 'father_menu_options_list', $father_menu_options_list );
Template::assign ( 'show_options_list', $show_options_list );
Template::assign ( 'online_options_list', $online_options_list );
Template::assign ( 'shortcut_allowed_options_list', $shortcut_allowed_options_list );
Template::display ( 'admin/menu_modify.tpl' );