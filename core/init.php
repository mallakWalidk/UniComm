<?php

function print_arr($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";

}

defined('ROOT') ? NULL : define('ROOT', '/wamp64/www/uni_comm');
defined('CORE_PATH') ? NULL : define('CORE_PATH', ROOT . '/core');
defined('INC_PATH') ? NULL : define('INC_PATH', ROOT . '/includes');

//include db
include_once(INC_PATH . '/db-config.php');

//include classes

include_once(CORE_PATH . '/user-class.php');
include_once(CORE_PATH . '/skill-class.php');
include_once(CORE_PATH . '/post-class.php');
include_once(CORE_PATH . '/announcement-class.php');
include_once(CORE_PATH . '/like-class.php');
include_once(CORE_PATH . '/comment-class.php');
include_once(CORE_PATH . '/message-class.php');
include_once(CORE_PATH . '/course-class.php');
include_once(CORE_PATH . '/report-class.php');




?>