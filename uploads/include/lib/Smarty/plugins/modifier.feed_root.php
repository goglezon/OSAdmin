<?php
function smarty_modifier_feed_root($text, $feed_info, $user_infos) {
    if(!$feed_info|| !$user_infos){
        return '';    
    }
    $string     = '';
    $root_id    = $feed_info['root']['id'];
    $root_text  = $feed_info['root']['text'];
    $root_time  = date("Y-m-d H:i:s", substr($feed_info['root']['create_time'], 0, 10));
    $root_uid   = $feed_info['root']['user_id'];
    $root_name  = SysPublic::feedSearchUserName($root_uid, $user_infos); 
    $string     .= $root_text; 
    $string     .= "<br/> ($root_uid|$root_name|$root_time)";

    return $string;
} 
?>
