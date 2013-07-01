<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

$samples = Sample::getSamples();

Template::assign ('samples',$samples);
Template::display ( 'sample/sample.tpl' );
