<?php
if(!defined('ACCESS')) {exit('Access denied.');}
require (__DIR__.'/Spreadsheet_Excel_Reader.class.php');
class ExcelReader {
	public static function readXLS($file){
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('UTF-8'); //设置输出的编码为utf8
		$ret = $data->read($file); //要读取的excel文件地址
		if($ret == -1){
			$array = false;
		}else{
			for ($i =1 ; $i <= $data->sheets[0]['numRows']; $i++) {
				for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
					$array[$i-1][$j-1] = $data->sheets[0]['cells'][$i][$j];
				}
			}
		}
		return $array;
	}
}
?>