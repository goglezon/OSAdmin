<?php
require ('../include/init.inc.php');
$sys_info = Common::getSysInfo ();

Template::assign ( 'sys_info', $sys_info );
Template::display ( 'panel/system.tpl' );
