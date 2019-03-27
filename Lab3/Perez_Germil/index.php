<?php

// Start output buffering.
ob_start();


require_once '__DIR__' . '/vendor/autoload.php';

// need routing

$app = new IndexController();

$app->indexAction();

ob_end_flush();