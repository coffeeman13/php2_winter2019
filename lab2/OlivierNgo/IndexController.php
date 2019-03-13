<?php

require 'TemplateManager.php';


class indexController
{
    protected $viewManager;
    public function indexAction()
    {

        $this->viewManager = new TemplateManager();
        $this->viewManager->validationProcess();
        $this->viewManager->loadTemplate();
        $this->viewManager->render();


    }


}
