<?php
function smarty_block_box($params, $content, &$smarty, &$repeat){
    if($repeat === true) {
        $list       = isset($params['list']) ? $params['list'] : array();
        $checked    = isset($params['checked']) ? $params['checked'] : array();
        $type       = isset($params['type']) ? $params['type'] : 'radio';
        $key        = isset($params['key']) ? $params['key'] : 'id';
        $value      = isset($params['value']) ? $params['value'] : null;
        $name       = isset($params['name']) ? $params['name'] : '';
        $id         = isset($params['id']) ? $params['id'] : '';
        $line_num   = isset($params['line_num']) ? $params['line_num'] : 5; 

        //计算选中信息
        foreach($list as $k => $v){
            if(isset($v[$key]) && in_array($v[$key], $checked)){
                $list[$k]['checked'] = true;    
            }else{
                $list[$k]['checked'] = false;    
            }
        } 
        $smarty->assign("block_box_list", $list);
        $smarty->assign("block_box_type", $type);
        $smarty->assign("block_box_key", $key);
        $smarty->assign("block_box_value", $value);
        $smarty->assign("block_box_name", $name);
        $smarty->assign("block_box_id", $id);
        $smarty->assign("block_box_line_num", $line_num);
    }
    return $content;
}
