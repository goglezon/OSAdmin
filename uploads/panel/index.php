<?php 
require('../include/init.inc.php');
$user_info = UserSession::getSessionInfo();
$menus = MenuUrl::getMenuByIds($user_info['shortcuts']);
Template::assign('menus', $menus);
Template::display('index.tpl');
