<?php
function smarty_modifier_feed_search_text($text, $feed_info, $user_infos) {
    if(!$feed_info|| !$user_infos){
        return '';    
    }
    $string     = $feed_info['text'];
    //如果是评论
    $append = '';
    if(isset($feed_info['root'])){
       $append  = "【";
       $append  .= $feed_info['root']['text'];
       $append  .= "】";
    }
    return $string.$append;
} 
?>
