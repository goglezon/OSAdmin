<?php
function smarty_block_bind_manual($params, $content, &$smarty, &$repeat){
    if($repeat === true) {
        $block_bind_id      = isset($params['block_bind_id']) ? $params['block_bind_id'] : '';
        $block_bind_action  = isset($params['block_bind_action']) ? $params['block_bind_action'] : true;
        // 当前
        $content_0  = "关闭"; // 自动
        $content_1  = "开启"; //手动
        $string = "当前: ";
        $bind_list_info = BindList::info($block_bind_id);
        $bind_manual    = isset($bind_list_info['manual']) ? $bind_list_info['manual'] : UserBind::MANUAL_NO;
        if($bind_manual == UserBind::MANUAL_NO){
            $block_bind_content = $content_1; 
            $string .= $content_0; // 默认自动   
            $block_bind_msg = "确定要人工审核数据吗？";
            $temp_manual    = UserBind::MANUAL_YES;
        }else{
            $block_bind_content = $content_0; 
            $string .= $content_1;    
            $block_bind_msg = "你确定要放弃人工审核数据吗？";
            $temp_manual    = UserBind::MANUAL_NO;
        }
        $block_bind_url= "weibo/act.php?type=bind_list_edit&id=$block_bind_id&manual=$temp_manual";
        $smarty->assign("block_bind_current_manual_string", $string);
        $smarty->assign("block_bind_url", SERVERNAME.'/'.$block_bind_url);
        $smarty->assign("block_bind_msg", $block_bind_msg);
        $smarty->assign("block_bind_content", $block_bind_content);
        $smarty->assign("block_bind_list_info", $bind_list_info);
        $smarty->assign("block_bind_action", $block_bind_action);
    }
    return $content;
}

