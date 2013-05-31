<?php
function smarty_modifier_role($role_string, $roles) {
    if(!$role_string || !$roles || !is_array($roles)){
        return '';    
    }
    $role_list = explode(',', $role_string);
    $array = array();
    foreach($role_list as $role_id){
       $string = search_role_name($role_id, $roles); 
       array_push($array, $string);
    }
    return implode(' ', $array);
} 

function search_role_name($role_id, $roles){
   foreach($roles as $item){
        if($item['id'] == $role_id){
            return $item['role_name'];   
        }   
    }
}
?>
