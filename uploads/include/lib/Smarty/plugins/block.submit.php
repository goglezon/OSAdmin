<?php
function smarty_block_submit($params, $content, &$smarty, &$repeat){
    if($repeat === true) {
        $block_name     = isset($params['block_name']) ? $params['block_name'] : 'submit';
        $block_value    = isset($params['block_value']) ? $params['block_value'] : '提交';
        $block_action   = isset($params['block_action']) ? $params['block_action'] : true;
        $smarty->assign("block_name", $block_name);
        $smarty->assign("block_value", $block_value);
        $smarty->assign("block_action", $block_action);
    }
    return $content;
}

