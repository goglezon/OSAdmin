<?php
if(!defined('ACCESS')) {exit('Access denied.');}
/**
* @author yuwenqi@gmail.com
* @time 2013-05-15
*/
class Pagination{
	//显示当前页的前后页数  4,5,6,七,8,9,10
	const OFFSET=3;
	
	public static function showPager($link,&$page_no,$page_size,$row_count){
		$url="";
		$params="";
		if($link != ""){
			$pos = strpos($link,"?");
			 
			if($pos ===false ){
				$url = $link;
			}else{
				$url=substr($link,0,$pos);
				$params=substr($link,$pos+1);
			}
		}
		 
		$navibar = "<div class=\"pagination\"><ul>";
		$offset=self::OFFSET;
		//$page_size=10;
		$total_page=$row_count%$page_size==0?$row_count/$page_size:ceil($row_count/$page_size);
		
		$page_no=$page_no<1?1:$page_no;
		$page_no=$page_no>($total_page)?($total_page):$page_no;
		if ($page_no > 1){
			$navibar .= "<li><a href=\"$url?$params&page_no=1\">首页</a></li>\n <li><a href=\"$url?$params&page_no=".($page_no-1)." \">上一页</a></li>\n";
		}
		/**** 显示页数 分页栏显示11页，前5条...当前页...后5条 *****/
		$start_page = $page_no -$offset;
		$end_page =$page_no+$offset;
		if($start_page<1){
			$start_page=1;
		}
		if($end_page>$total_page){
			$end_page=$total_page;
		}
		for($i=$start_page;$i<=$end_page;$i++){
			if($i==$page_no){
				$navibar.= "<li><span>$i</span></li>";
			}else{
				$navibar.= "<li><a href=\" $url?$params&page_no=$i \">$i</a></li>";
			}
		}
		
		if ($page_no < $total_page){
			$navibar .= "<li><a href=\"$url?$params&page_no=".($page_no+1)."\">下一页</a></li>\n <li><a href=\"$url?$params&page_no=$total_page\">末页</a></li>\n ";
		}
		if($total_page>0){
			$navibar.="<li><a>".$page_no ."/". $total_page."</a></li>";
		}
		$navibar.="<li><a>共".$row_count."条</a></li>";
		$jump ="";
		//$jump ="<li><form action='$url' method='GET' name='jumpForm'><input type='text' name='page_no' value='$page_no'></form></li>";
		
		$navibar.=$jump;
		$navibar.="</ul></div>";
	
		return $navibar;   
	}
}
?>
	 