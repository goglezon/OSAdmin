<?php
function smarty_modifier_system($system) {
    $system = isset($system) ? $system : 0;
    return !$system ? '否' : '是';
} 

?>
