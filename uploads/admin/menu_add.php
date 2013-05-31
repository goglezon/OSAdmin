<?php
require ('../include/init.inc.php');
$menu_name = $menu_url = $module_id = $is_show = $online = $shortcut_allowed = $menu_desc = $father_menu = '';
extract ( $_POST, EXTR_IF_EXISTS );

if (Common::isPost ()) {
	if($menu_name=="" || $menu_url == ""|| $module_id == ""){
		OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
	}else{
		$input_data = array ('menu_name' => $menu_name, 'menu_url' => $menu_url, 'module_id' => $module_id, 
							'is_show' => $is_show, 'online' =>1 , 'menu_desc' => $menu_desc ,'shortcut_allowed'=>$shortcut_allowed,'father_menu'=>$father_menu );
		$menu_id = MenuUrl::addMenu ( $input_data );
		
		if ($menu_id) {
			SysLog::addLog ( UserSession::getUserName(), 'ADD', 'MenuUrl' ,$menu_id ,json_encode($input_data));
			Common::exitWithSuccess ('已将链接添加','admin/menus.php');
		}else{
			OSAdmin::alert("error");
		}
	}
}

$module_options_list = Module::getModuleForOptions ();
$father_menu_options_list = MenuUrl::getFatherMenuForOptions ();
Template::assign ( 'module_options_list', $module_options_list );
Template::assign ( 'father_menu_options_list', $father_menu_options_list );
Template::display ( 'admin/menu_add.tpl' );