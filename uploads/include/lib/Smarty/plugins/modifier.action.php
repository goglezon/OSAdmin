<?php
function smarty_modifier_action($action_string) {
    $actions = $GLOBALS['globals']['operations'];
    if(!$action_string || !$actions || !is_array($actions)){
        return '';    
    }
    $action_list = explode(',', $action_string);
    $array = array();
    foreach($action_list as $action_id){
       $string = search_action_name($action_id, $actions); 
       array_push($array, $string);
    }
    return implode(' ', $array);
} 

function search_action_name($action_id, $actions){
   foreach($actions as $item){
        if($item['id'] == $action_id){
            return $item['value'];   
        }   
    }
}
?>
