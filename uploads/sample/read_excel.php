<?php
require('../include/init.inc.php');
if (Common::isPost ()) {
	if (empty($_FILES['excel'])) {
		OSAdmin::alert('error', 'empty file');
	} else {
		if ($_FILES['excel']['error'] != 0) {
			$message = '上传文件失败,error number('.$_FILES['excel']['error'].')';
			OSAdmin::alert("error",$message);
		}
		$file = $_FILES['excel']['tmp_name'];
		$excel_array = ExcelReader::readXLS($file);
		
		$output = print_r($excel_array,true);
	}
}

Template::assign("_POST", $_POST);
Template::assign("output", $output);
Template::display('sample/read_excel.tpl');
