<?php
function smarty_modifier_screen_name($bind_id, $user_infos) {
    if(!$bind_id || !$user_infos){
        return '';    
    }
    foreach($user_infos as $info){
        if($info['id'] == $bind_id){
            return "<a  target=_blank href=http://weibo.10086.cn/" . $info['screen_name'] . ">" .$info['screen_name'] . "</a>" ;    
        }    
    }
    return '';
} 
?>
