<?php
/**
 * Created by PhpStorm.
 * User: z_kurtev
 * Date: 2019-02-06
 * Time: 7:10 PM
 */

require 'DataStore.php';
require 'TemplateManager.php';
require 'IndexController.php';

$dataStore = new DataStore();

$app = new IndexController($dataStore);

$app->indexActions();


