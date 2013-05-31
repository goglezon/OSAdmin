<?php
function smarty_modifier_bind_mobile($bind_id, $user_infos) {
    if(!$bind_id || !$user_infos){
        return '';    
    }
    foreach($user_infos as $info){
        if($info['userId'] == $bind_id){
            return $info['mobile'];    
        }    
    }
    return '';
} 
?>
