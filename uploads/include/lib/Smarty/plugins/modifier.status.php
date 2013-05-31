<?php
function smarty_modifier_status($status) {
    $status = isset($status) ? $status : 0;
    return !$status ? '关闭' : '激活';
} 

?>
