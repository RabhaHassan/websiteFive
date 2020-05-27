<?php
function lang($phrases){
    static $lang =array(
        //NAVBAR
        'HOME_ADMIN'=>"home",
        'ITEMS'=>"posts",
        'MEMBERS'=>"Members",
        'LOGS'=>"Logs"
    );
    return $lang[$phrases];
}//end function
?>