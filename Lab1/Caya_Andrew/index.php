<?php

require 'IndexController.php'; // autoloading

// routing

$app = new IndexController();

$app->indexAction();