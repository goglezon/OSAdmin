<?php
function smarty_modifier_weibo_text($text) {
    if(!$text){
        return '';    
    }
    return SysPublic::tinyurlAddLink($text);
} 
?>
