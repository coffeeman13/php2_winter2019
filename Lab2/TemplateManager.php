<?php
/**
 * Created by PhpStorm.
 * User: z_kurtev
 * Date: 2019-02-06
 * Time: 6:44 PM
 */

class TemplateManager
{


    protected $htmlTempleta;
    protected $data = [];
    public function loadTemplate(){
        $this->htmlTempleta  = '<!DOCTYPE html>' ;
        $this->htmlTempleta .= '<html lang="en">';
        $this->htmlTempleta .= '<head>';
        $this->htmlTempleta .= '<meta charset="UTF-8">';
        $this->htmlTempleta .= '<title>Title</title>';
        $this->htmlTempleta .= '<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">';
        $this->htmlTempleta .= '<link rel="stylesheet" href="css/style.css">';
        $this->htmlTempleta .= '<script type="javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>';
        $this->htmlTempleta .= '</head>';
        $this->htmlTempleta .= '<body>';
        $this->htmlTempleta .= '<div class="wrapper">';
        $this->htmlTempleta .= '<div class="container">';
        $this->htmlTempleta .= '<form class="form-signin">';
        $this->htmlTempleta .= '<p>Hello ' . $this->data['firstName']  . ' ' . $this->data['lastName'] . ' ' . $this->data['age']  . '</p>';
        $this->htmlTempleta .= '<h1>Please sign in</h1>';
        $this->htmlTempleta .= '<div class="form-label-group">';
        $this->htmlTempleta .= '<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>';
        $this->htmlTempleta .= '<label for="inputEmail">Email address</label>';
        $this->htmlTempleta .= '</div>';
        $this->htmlTempleta .= '<div class="form-label-group">';
        $this->htmlTempleta .= '<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>';
        $this->htmlTempleta .= '<label for="inputPassword">Password</label>';
        $this->htmlTempleta .= '</div>';
        $this->htmlTempleta .= '<div class="checkbox mb-3">';
        $this->htmlTempleta .= '<label><input type="checkbox" value="remember-me"> Remember me</label>';
        $this->htmlTempleta .= '</div>';
        $this->htmlTempleta .= '<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>';
        $this->htmlTempleta .= '<p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>';
        $this->htmlTempleta .= '</form></div></div></body></html>';



    }

    public function render(){
        echo $this->htmlTempleta;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}