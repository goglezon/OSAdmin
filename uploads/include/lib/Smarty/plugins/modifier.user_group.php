<?php
function smarty_modifier_user_group($group_string, $user_group) {
    if(!$group_string || !$user_group || !is_array($user_group)){
        return '';    
    }
    $group_list = explode(',', $group_string);
    $array = array();
    foreach($group_list as $group_id){
       $string = search_group_name($group_id, $user_group); 
       array_push($array, $string);
    }
    return implode(' ', $array);
} 

function search_group_name($group_id, $groups){
   foreach($groups as $item){
        if($item['id'] == $group_id){
            return $item['group_name'];   
        }   
    }
}
?>
