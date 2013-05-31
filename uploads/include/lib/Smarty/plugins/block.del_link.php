<?php
function smarty_block_del_link($params, $content, &$smarty, &$repeat){
    if($repeat === true) {
        $block_del_url  = isset($params['block_del_url']) ? $params['block_del_url'] : '';
        $block_del_msg  = isset($params['block_del_msg']) ? $params['block_del_msg'] : '';
        $block_del_content  = isset($params['block_del_content']) ? $params['block_del_content'] : '删除';
        $smarty->assign("block_del_url", SERVERNAME.'/'.$block_del_url);
        $smarty->assign("block_del_msg", $block_del_msg);
        $smarty->assign("block_del_content", $block_del_content);
    }
    return $content;
}

