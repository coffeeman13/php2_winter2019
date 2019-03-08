<?php

ob_start();
require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'evgeniyadb_mysql_include.php';

require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'evgeniyadb_session_include.php';

require 'WebController.php';

$app = new WebController();

$app->webAction();


ob_end_flush();
flush();
exit;



