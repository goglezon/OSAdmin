<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

$samples = Sample::getSamples();
$radio_types=array(0=>"Male",1=>"Female");

Template::assign('samples', $samples);
Template::assign('radio_types', $radio_types);
Template::display('sample/sample.tpl');
