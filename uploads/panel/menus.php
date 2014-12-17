<?php
require ('../include/init.inc.php');
$method = $menu_id = $module_id = $menu_name = $page_no = $search = '';
extract ( $_GET, EXTR_IF_EXISTS );

if ($method == 'del' && ! empty ( $menu_id )) {
	$menu = MenuUrl::getMenuById($menu_id);
	
	//if(intval($menu['module_id']) === 1){
	if(intval($menu_id) <= 100){
		OSAdmin::alert("error",ErrorMessage::CAN_NOT_DELETE_SYSTEM_MENU);
	}else{
		$result = MenuUrl::delMenu ( $menu_id );	
		if ($result) {
			SysLog::addLog ( UserSession::getUserName(), 'DELETE', 'MenuUrl' ,$menu_id, json_encode($menu) );
			Common::exitWithSuccess ('已将菜单链接删除','panel/menus.php');
		}else{
			OSAdmin::alert("error");
		}
	}
}

//START 数据库查询及分页数据
$page_size = PAGE_SIZE;
$page_no=$page_no<1?1:$page_no;

if($search){

	$row_count = MenuUrl::countSearch($module_id,$menu_name);
	$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
	$total_page=$total_page<1?1:$total_page;
	$page_no=$page_no>($total_page)?($total_page):$page_no;
	$start = ($page_no - 1) * $page_size;
	$menus = MenuUrl::search($module_id,$menu_name,$start , $page_size);
	
}else{
	$row_count = MenuUrl::count ();
	$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
	$total_page=$total_page<1?1:$total_page;
	$page_no=$page_no>($total_page)?($total_page):$page_no;
	$start = ($page_no - 1) * $page_size;
	$menus = MenuUrl::getAllMenus ( $start , $page_size );
}


$page_html=Pagination::showPager("menus.php?module_id=$module_id&menu_name=$menu_name&search=$search",$page_no,$page_size,$row_count);

$module_options_list = Module::getModuleForOptions ();
$module_options_list[0]="全部";
ksort($module_options_list);

$confirm_html = OSAdmin::renderJsConfirm("icon-remove");
Template::assign ( 'page_no', $page_no );
Template::assign ( 'menus', $menus );
Template::assign ( '_GET', $_GET);
Template::assign ( 'page_html', $page_html );
Template::assign ( 'module_options_list', $module_options_list );
Template::assign ( 'osadmin_action_confirm' , $confirm_html);
Template::display ( 'panel/menus.tpl' );