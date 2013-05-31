<?php
function smarty_modifier_bind_manual($bind_id) {
    if(!$bind_id){
        return '';
    }
    // 当前
    $string = "当前: ";
    $info   = BindList::info($bind_id);
    $bind_manual    = isset($info['manual']) ? $info['manual'] : UserBind::MANUAL_NO;
    if($bind_manual == UserBind::MANUAL_NO){
        $string .= "关闭";    
    }else{
        $string .= "开启";    
    }
    return $string;
} 
?>
