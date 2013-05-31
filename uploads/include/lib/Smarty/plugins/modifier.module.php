<?php
function smarty_modifier_module($module_id, $modules) {
    if(!$module_id){
        return '';    
    }
    if(!$modules || !is_array($modules)){
        return '';    
    }
    $module_name = '';
    foreach($modules as $module){
        if($module['id'] == $module_id){
           $module_name = $module['module_name'] ;
           break;
        }    
    }
    return $module_name;
} 

?>
