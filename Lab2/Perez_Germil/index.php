<?php


require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'SessionApp.php';


    
require 'TemplateManager.php';
require 'IndexController.php';
require 'DataStore.php';
    
$dataStore = new DataStore();
    
$app = new IndexController($dataStore);
    
$app->indexActions();
    