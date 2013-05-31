<?php
function smarty_modifier_feed_relation($text, $feed_info, $user_infos) {
    if(!$feed_info|| !$user_infos){
        return '';    
    }
    $string     = '';
    $id    = $feed_info['id'];
    $text  = $feed_info['text'];
    $time  = date("Y-m-d H:i:s", substr($feed_info['create_time'], 0, 10));
    $uid   = $feed_info['user_id'];
    $status= $feed_info['status'];
    $name  = SysPublic::feedSearchUserName($uid, $user_infos); 
    $status= SysPublic::adviceAdminStatus($status); 
    $string     = "$name($uid)|"; 
    $string     .= "$time |"; 
    $string     .= "$status"; 

    return $string;
} 
?>
