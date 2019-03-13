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
         // Prepare view output.
        if ($data['postLoginForm'] === TRUE) {
            
            switch ($data['errorMessage']) {
                
                case 0:
                    $data['userMessage'] = 'Please sign in.';
                    break;
                case 1:
                    $data['userMessage'] = 'Wrong credentials.  <a href="index.php">Try again</a>.';
                    break;
                case 2:
                    $data['userMessage'] = 'You are logged out!  <a href="index.php">You can login again</a>.';
                    break;
                case 3:
                    $data['userMessage'] = 'Invalid session. <a href="index.php">Please login again</a>.';
                    break;
            
                }

        $this->htmlTempleta  = "<!DOCTYPE html>\n\n";
        $this->htmlTempleta  .= "<html lang=\"en\">\n\n";
        $this->htmlTempleta  .= "<head>\n\n";
        $this->htmlTempleta  .= "\t<meta charset=\"utf-8\">\n";
        $this->htmlTempleta  .= "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
        $this->htmlTempleta  .= "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
        $this->htmlTempleta  .= "\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\n\n";
        $this->htmlTempleta  .= "\t<title>Login App</title>\n\n";
        $this->htmlTempleta  .= "\t<!-- Bootstrap -->\n";
        $this->htmlTempleta  .= ">\n\n";
        $this->htmlTempleta  .= "\t<!-- Custom styles for this template -->\n";
        $this->htmlTempleta  .= ">\n\n";
        $this->htmlTempleta  .= "\t<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n";
        $this->htmlTempleta  .= "\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n\n";
        $this->htmlTempleta  .= "\t<!--[if lt IE 9]>\n";
        $this->htmlTempleta  .= "></script>\n";
        $this->htmlTempleta  .= "></script>\n";
        $this->htmlTempleta  .= "\t<![endif]-->\n\n";
        $this->htmlTempleta  .= "</head>\n\n";
        $this->htmlTempleta  .= "<body>\n\n";

       
        

         if ($this->$data['errorMessage'] === 0) {

                    $this->htmlTempleta .= "\t<div class=\"container\">\n";
                    $this->htmlTempleta .= ">\n";
                    $this->htmlTempleta .= "\t\t\t<h2 class=\"form-signin-heading\">" . $this->$data['userMessage'] . "</h2>\n";
                    $this->htmlTempleta .= "\t\t\t<div class=\"form-group\">\n";
                    $this->htmlTempleta .= "\t\t\t\t<label for=\"inputUsername\" class=\"control-label\">Username:</label>\n";
                    $this->htmlTempleta .= "\t\t\t\t<input class=\"form-control\" id=\"inputUsername\" name=\"username\" placeholder=\"Username\" type=\"text\" pattern=\"^[a-zA-Z]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required autofocus>\n";
                    $this->htmlTempleta .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
                    $this->htmlTempleta .= "\t\t\t</div>\n";
                    $this->htmlTempleta .= "\t\t\t<div class=\"form-group\">\n";
                    $this->htmlTempleta .= "\t\t\t\t<label for=\"inputPassword\" class=\"control-label\">Password:</label>\n";
                    $this->htmlTempleta .= "\t\t\t\t<input class=\"form-control\" id=\"inputPassword\" name=\"password\" placeholder=\"Password\" type=\"password\" pattern=\"^[_a-zA-Z0-9]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required>\n";
                    $this->htmlTempleta .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
                    $this->htmlTempleta .= "\t\t\t</div>\n";
                    $this->htmlTempleta .= "\t\t\t<div class=\"form-group\">\n";
                    $this->htmlTempleta .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"submit\" type=\"submit\" value=\"1\">Submit</button>\n";
                    $this->htmlTempleta .= "\t\t\t</div>\n";
                    $this->htmlTempleta .= "\t\t</form>\n";
                    $this->htmlTempleta .= "\t</div> <!-- /container -->\n\n";

                } else {

                    $this->htmlTempleta .= "\t<div class=\"container theme-showcase\" role=\"main\">\n";
                    $this->htmlTempleta .= "\t\t<!-- Main jumbotron for a primary marketing message or call to action -->\n";
                    $this->htmlTempleta .= "\t\t<div class=\"jumbotron\">\n";
                    $this->htmlTempleta .= "\t\t\t<h2>" . $this->$data['userMessage'] . "</h2>\n";
                    $this->htmlTempleta .= "\t\t</div> <!-- /jumbotron -->\n";
                    $this->htmlTempleta .= "\t</div> <!-- /container -->\n\n";

                }
                
                $this->htmlTempleta .= "\t<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->\n";
                $this->htmlTempleta .= "></script>\n";
                $this->htmlTempleta .= "\t<!-- Include all compiled plugins (below), or include individual files as needed -->\n";
                $this->htmlTempleta .= "></script>\n";
                $this->htmlTempleta .= "\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->\n";
                $this->htmlTempleta .= "></script>\n";
                $this->htmlTempleta .= "\t<!-- Form validator for Bootstrap 3 -->\n";
                $this->htmlTempleta .= "></script>\n\n";
                $this->htmlTempleta .= "</body>\n\n";
                $this->htmlTempleta .= "</html>";

            } else {

                $this->htmlTempleta = "<!DOCTYPE html>\n\n";
                $this->htmlTempleta .= "<html lang=\"en\">\n\n";
                $this->htmlTempleta .= "<head>\n\n";
                $this->htmlTempleta .= "\t<meta charset=\"utf-8\">\n";
                $this->htmlTempleta .= "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
                $this->htmlTempleta .= "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
                $this->htmlTempleta .= "\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\n\n";
                $this->htmlTempleta .= "\t<title>Login App</title>\n\n";
                $this->htmlTempleta .= "\t<!-- Bootstrap -->\n";
                $this->htmlTempleta .= ">\n\n";
                $this->htmlTempleta .= "\t<!-- Custom styles for this template -->\n";
                $this->htmlTempleta .= ">\n\n";
                $this->htmlTempleta .= "\t<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n";
                $this->htmlTempleta .= "\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n\n";
                $this->htmlTempleta .= "\t<!--[if lt IE 9]>\n";
                $this->htmlTempleta .= "></script>\n";
                $this->htmlTempleta .= "></script>\n";
                $this->htmlTempleta .= "\t<![endif]-->\n\n";
                $this->htmlTempleta .= "\t<style media=\"screen\" type=\"text/css\">\n\n";
                $this->htmlTempleta .= "\t\t.container {\n";
                $this->htmlTempleta .= "\t\t\tmax-width: 480px;\n";
                $this->htmlTempleta .= "\t\t}\n\n";
                $this->htmlTempleta .= "\t</style>\n\n";
                $this->htmlTempleta .= "</head>\n\n";
                $this->htmlTempleta .= "<body>\n\n";
                $this->htmlTempleta .= "\t<div class=\"container theme-showcase\" role=\"main\">\n";
                $this->htmlTempleta .= "\t\t<!-- Main jumbotron for a primary marketing message or call to action -->\n";
                $this->htmlTempleta .= "\t\t<div class=\"jumbotron\">\n";
                
                if (isset($_GET["check"])) {
                    
                    $this->htmlTempleta .= "\t\t\t<h2>Hello, " . $_SESSION['REMOTE_USER'] . "!<br /><br /><br />You are still logged in.<br /><br /><br /><br /></h2>\n";
                    
                } else {
                    
                    $this->htmlTempleta .= "\t\t\t<h2>Welcome, " . $_SESSION['REMOTE_USER'] . ">Check cookie</a><br /><br /><br /><br /></p>\n";
                }
                
                $this->htmlTempleta .= ">\n";
                $this->htmlTempleta .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"logout\" type=\"submit\" value=\"2\">Logout</button>\n";
                $this->htmlTempleta .= "\t\t\t</form>\n";
                $this->htmlTempleta .= "\t\t</div> <!-- /jumbotron -->\n";
                $this->htmlTempleta .= "\t</div> <!-- /container -->\n\n";
                $this->htmlTempleta .= "\t<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->\n";
                $this->htmlTempleta .= "></script>\n";
                $this->htmlTempleta .= "\t<!-- Include all compiled plugins (below), or include individual files as needed -->\n";
                $this->htmlTempleta .= "></script>\n";
                $this->htmlTempleta .= "\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->\n";
                $this->htmlTempleta .= "></script>\n\n";
                $this->htmlTempleta .= "</body>\n\n";
                $this->htmlTempleta .= "</html>";

            } 

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