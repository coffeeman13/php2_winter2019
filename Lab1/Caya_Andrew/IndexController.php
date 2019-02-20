<?php

require 'TemplateManager.php';
require 'DataStore.php';

class IndexController
{
    protected $data = [];
    protected $viewManager;

    public function indexAction()
    {
        $dataStore = new DataStore();

        $this->data['firstName'] = $dataStore->getFirstName();
        $this->data['lastName'] = $dataStore->getLastName();
        $this->data['age'] = $dataStore->getAge();

        $this->viewManager = new TemplateManager();
        $this->viewManager->setData($this->data);
        $this->viewManager->loadTemplate();

        $this->viewManager->render();
    }
}