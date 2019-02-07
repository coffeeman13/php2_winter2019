<?php
require 'hexiao.php';
require 'dataStore.php';

class IndexController
{
    protected $data=[];
    protected $viewManager;

    public function indexAction(){

        $dataStore = new dataStore();

        $this->data['firstName'] = $dataStore -> getFirstName();
        $this->data['lasrName'] = $dataStore -> getLastName();
        $this->data['age'] = $dataStore -> getAge();

        $this->viewManager = new TemplateManager();
        $this->viewManager-> setData($this->data);
        $this->viewManager->loadTemplate();
        $this->viewManager->render();

    }
}
