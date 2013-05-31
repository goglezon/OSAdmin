<?php
function smarty_search_user_full_name($id, $lists){
   foreach($lists as $item){
        if($item['userId'] == $id){
            return $item['fullName'];   
        }   
    }

}
