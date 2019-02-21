<?php
/**
 * Created by PhpStorm.
 * User: z_hexiao
 * Date: 2019-02-06
 * Time: 6:43 PM
 */

class TemplateManager
{
    protected $htmlOut;
    protected $data = [];

    public function loadTemplate(){
        $this->htmlOut = '<!DOCTYPE html>';
        $this->htmlOut .= '<html>';
        $this->htmlOut .= '<head>';
        $this->htmlOut .= '<link rel="stylesheet" href="styles.css">';
        $this->htmlOut .= '</head>';
        $this->htmlOut .= '<body>';
        $this->htmlOut .= '<p>'. $this->data['age'].'years old'.'</p>';
        $this->htmlOut .= '<form>';
        $this->htmlOut .= '</form>';
        $this->htmlOut .= '</body>';
        $this->htmlOut .= '</html>';
     //
    }

    public function render()
    {
        echo $this->htmlOut;
    }

    public function getData(){
         return $this->data;
    }
    public function setData($data){
          $this->data = $data;
    }

}