<?php
function smarty_modifier_dump($data){
    var_dump($data);
    return json_encode($data); 
}
