<?php
function smarty_modifier_access($access_string, $menu_list) {
    if(!$access_string || !$menu_list || !is_array($menu_list)){
        return '';    
    }
    $access_list = explode(',', $access_string);
    $array = array();
    foreach($access_list as $access_id){
       $string = search_access_name($access_id, $menu_list); 
       array_push($array, $string);
    }
    return implode(' ', $array);
} 

function search_access_name($access_id, $lists){
   foreach($lists as $item){
        if($item['id'] == $access_id){
            return $item['menu_name'];   
        }   
    }
}
?>
