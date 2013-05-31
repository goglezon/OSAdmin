<?php
require ('../include/init.inc.php');
$page_no = $user_name = $class_name =$start_date = $end_date ="";
extract ( $_GET, EXTR_IF_EXISTS );

if($class_name=='ALL'){
	$class_name ='';
}
$start_time = strtotime($start_date);
$end_time = strtotime($end_date);
//START 数据库查询及分页数据
if($start_date != '' && $end_date !=''){
	$row_count =SysLog::getCountByDate($class_name,$user_name,$start_time,$end_time);
	 
}else{
	$row_count = SysLog::count ($class_name,$user_name);
	 
}

$page_size = PAGE_SIZE;
$page_no=$page_no<1?1:$page_no;

$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
$total_page=$total_page<1?1:$total_page;
$page_no=$page_no>($total_page)?($total_page):$page_no;

$start = ($page_no - 1) * $page_size;
//END


$sys_logs = SysLog::getLogs($class_name,$user_name, $start,$page_size,$start_time,$end_time );


$loadedClz = array();
$namePool = array();
foreach ($sys_logs as &$log){
	
	if(array_key_exists($log['action'],$OSADMIN_COMMAND_FOR_LOG)){
		$log['action']=$OSADMIN_COMMAND_FOR_LOG[$log['action']];
	}

	 
	$class_obj = $log['class_obj'];
	$class_name = $log['class_name'];
/*
	if(!in_array($class_name,$loadedClz)){
		try{
		$refl = new ReflectionClass($class_name);
		$instance = $refl->newInstance();
		$names = $instance->getNamesForLog();
		}catch(Exception $e){
			OSAdmin::alert("error",ErrorMessage::DEV_ERROR);
		}
		$namePool=array_merge($namePool,$names);
		$loadedClz[]=$class_name;
	}
*/
	if(array_key_exists($log['class_name'],$OSADMIN_CLASS_FOR_LOG)){
		$log['class_name'] = $OSADMIN_CLASS_FOR_LOG[$log['class_name']];
	}

	
	if($log['class_obj']==""){
		$log['class_obj']='null';
	}
	/*
	if(array_key_exists($class_obj,$namePool)){
		//$log['class_obj']=$namePool[$class_obj];
	}else{
		//$log['class_obj']='self/null';
	}
	*/
	if(empty($log['result'])){
		$log['result'] = '成功';
	}else{
		$result =json_decode($log['result'],true);
		if(is_array($result)){
			$temp = null;
			foreach($result as $key => $value){
				$temp[] = "$key=>$value";
			}
			$log['result']=implode(';',$temp);
		}else{
			$log['result']=$result;
		}
	}
}


// 显示分页栏
//$page_html=Pagination::showPager("syslog.php",$page_no,PAGE_SIZE,$row_count);
$page_html=Pagination::showPager("syslog.php?class_name=$class_name&user_name=$user_name&start_date=$start_date&end_date=$end_date",$page_no,PAGE_SIZE,$row_count);

Template::assign ( 'page_no', $page_no );
Template::assign ( 'page_size', PAGE_SIZE );
Template::assign ( 'row_count', $row_count );
Template::assign ( 'page_html', $page_html );
Template::assign ( '_GET', $_GET );
Template::assign ( 'class_options', $OSADMIN_CLASS_FOR_LOG );
Template::assign ( 'sys_logs', $sys_logs );
Template::display ( 'admin/syslog.tpl' );
	