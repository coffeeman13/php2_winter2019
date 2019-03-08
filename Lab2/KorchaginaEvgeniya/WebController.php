<?php

require 'TemplateSignin.php';

require 'DataStore.php';



class WebController
{
    protected $errorMes=0;
    protected  $userMes="";
    protected $varSession="";
    protected $postLoginForm = true;
    protected $sessionUser = "";

    public function webAction()
    {

        $dataStore = new DataStore();
        $viewManager = new TemplateSignin();
        $dataStore->getData();
        $dataStore->loginVerification();

        $this->postLoginForm=$dataStore->getPostLoginForm();
        $this->errorMes = $dataStore->getErrorMessage();
        $this->userMes = $dataStore->getUserMessage();

        $message  = $this->postLoginForm;
        echo "<script type='text/javascript'>alert('postlogin form is'.'$message');</script>";

        $viewManager->loadTemplate($this->errorMes, $this->userMes, $this->postLoginForm);
        $viewManager->render();


    }

}