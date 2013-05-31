<?php
function smarty_block_page($params, $content, &$smarty, &$repeat){
    if($repeat === true) {
        $page_size      = isset($params['page_size']) ? $params['page_size'] : 20;
        $page_string    = isset($params['page_string']) ? $params['page_string'] : 'p';
        $row_count      = isset($params['row_count']) ? $params['row_count'] : 0;
        $page_num       = isset($params['page_num']) ? $params['page_num'] : 1;
        $script_uri     = isset($params['script_uri']) ? $params['script_uri'] : null;
        //翻页信息
        $options = array(
            'script_uri'=> $script_uri,//url, 缺省为当前页
            'pageString'=> $page_string,//页码变量，缺省为p
            'pageSize'  => $page_size,//每页条目数，缺省20
            'rowCount'  => $row_count,//总条目数，缺省为0
            'pageNo'    => $page_num,//当前页码，缺省为1
        );
        $pager      = new Pager($options);
        $page_info  = $pager->genYuan();
        $smarty->assign("page_info", $page_info);
    }
    return $content;
}

