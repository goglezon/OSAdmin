<?php
function smarty_modifier_debug($data){
    var_dump($data);
   return json_encode($data);
}
