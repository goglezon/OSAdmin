<?php
function smarty_modifier_feed_audit($feed_id) {
    if(!$feed_id){
        return '';    
    }
    $string     = '';
    $logs       = WeiboLog::listByFeedId($feed_id);
    if(!$logs){
        return '';    
    }
    foreach($logs as $log){
        $status = SysPublic::weiboAuditStatus($log['status']);
        $string .= $log['user_name']."|".$log['create_time']."|".$status."<br />";
    }
    return $string;
} 
?>
