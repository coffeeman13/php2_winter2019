<?php
/**
 * Created by PhpStorm.
 * User: Evgeniya
 * Date: 2019-03-06
 * Time: 11:43 PM
 */

class TemplateSignin
{
    protected $htmlout = "";

    public function loadTemplate($errorMessage, $userMessage, $postLoginForm)
    {
        if ($postLoginForm === TRUE) {

        $htmlOut = "<!DOCTYPE html>\n\n";
        $htmlOut .= "<html lang=\"en\">\n\n";
        $htmlOut .= "<head>\n\n";
        $htmlOut .= "\t<meta charset=\"utf-8\">\n";
        $htmlOut .= "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
        $htmlOut .= "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
        $htmlOut .= "\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\n\n";
        $htmlOut .= "\t<title>Login App</title>\n\n";
        $htmlOut .= "\t<!-- Bootstrap -->\n";
        $htmlOut .= "\t<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n\n";
        $htmlOut .= "\t<!-- Custom styles for this template -->\n";
        $htmlOut .= "\t<link href=\"css/signin.css\" rel=\"stylesheet\">\n\n";
        $htmlOut .= "\t<link href=\"css/styles.css\" rel=\"stylesheet\">\n\n";
        $htmlOut .= "\t<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n";
        $htmlOut .= "\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n\n";
        $htmlOut .= "\t<!--[if lt IE 9]>\n";
        $htmlOut .= "\t\t<script src=\"js/html5shiv.min.js\"></script>\n";
        $htmlOut .= "\t\t<script src=\"js/respond.min.js\"></script>\n";
        $htmlOut .= "\t<![endif]-->\n\n";
        $htmlOut .= "</head>\n\n";
        $htmlOut .= "<body>\n\n";

        if ($errorMessage === 0) {

            $htmlOut .= "\t<div class=\"container\">\n";
            $htmlOut .= "\t\t<form class=\"form-signin\" action=\"index.php\" method=\"post\" data-toggle=\"validator\" role=\"form\">\n";
            $htmlOut .= "\t\t\t<h2 class=\"form-signin-heading\" style=\"margin-bottom: 40px;\">" . $userMessage . "</h2>\n";
            $htmlOut .= "\t\t\t<div class=\"form-group\">\n";
            $htmlOut .= "\t\t\t<div id=\"input_container\">\n";
            $htmlOut .= "						<img src=\"images/icon_person.png\" id=\"input_img1\">";
            $htmlOut .= "\t\t\t\t<label for=\"inputUsername\" class=\"control-label\">Username:</label>\n";
            $htmlOut .= "\t\t\t</div>\n";
            $htmlOut .= "\t\t\t\t<input class=\"form-control\" id=\"inputUsername\" name=\"username\" placeholder=\"Username\" type=\"text\" pattern=\"^[a-zA-Z]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required autofocus>\n";
            $htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
            $htmlOut .= "\t\t\t</div>\n";
            $htmlOut .= "\t\t\t<div class=\"form-group\">\n";
            $htmlOut .= "						<img src=\"images/icon_lock.png\" id=\"input_img2\">";
            $htmlOut .= "\t\t\t\t<label for=\"inputPassword\" class=\"control-label\">Password:</label>\n";
            $htmlOut .= "\t\t\t\t<input class=\"form-control\" id=\"inputPassword\" name=\"password\" placeholder=\"Password\" type=\"password\" pattern=\"^[_a-zA-Z0-9]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required>\n";
            $htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
            $htmlOut .= "\t\t\t</div>\n";
            $htmlOut .= "\t\t\t<div class=\"form-group\">\n";
            $htmlOut .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"submit\" type=\"submit\" value=\"1\">Submit</button>\n";
            $htmlOut .= "\t\t\t</div>\n";
            $htmlOut .= "\t\t</form>\n";
            $htmlOut .= "\t\t<form class=\"form-signin\" action=\"TemplateSignup.php\" method=\"post\" role=\"form\">\n";
            $htmlOut .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"signup\" value=\"1\">Sign Up</button>\n";
            $htmlOut .= "\t\t</form>\n";
            $htmlOut .= "\t</div> <!-- /container -->\n\n";

        } else {

            $htmlOut .= "\t<div class=\"container theme-showcase\" role=\"main\">\n";
            $htmlOut .= "\t\t<!-- Main jumbotron for a primary marketing message or call to action -->\n";
            $htmlOut .= "\t\t<div class=\"jumbotron\">\n";
            $htmlOut .= "\t\t\t<h2>" . $userMessage . "</h2>\n";
            $htmlOut .= "\t\t</div> <!-- /jumbotron -->\n";
            $htmlOut .= "\t</div> <!-- /container -->\n\n";

        }

        if (isset($_POST['signup'])) {
            $htmlOut .= "\t<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->\n";
            $htmlOut .= "\t<script src=\"js/jquery.min.js\"></script>\n";
            $htmlOut .= "\t<!-- Include all compiled plugins (below), or include individual files as needed -->\n";
            $htmlOut .= "\t<script src=\"js/bootstrap.min.js\"></script>\n";
            $htmlOut .= "\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->\n";
            $htmlOut .= "\t<script src=\"js/ie10-viewport-bug-workaround.js\"></script>\n";
            $htmlOut .= "\t<!-- Form validator for Bootstrap 3 -->\n";
            $htmlOut .= "\t<script src=\"js/validator.min.js\"></script>\n\n";
            $htmlOut .= "</body>\n\n";
            $htmlOut .= "</html>";
 }
        } else {

            $htmlOut = "<!DOCTYPE html>\n\n";
            $htmlOut .= "<html lang=\"en\">\n\n";
            $htmlOut .= "<head>\n\n";
            $htmlOut .= "\t<meta charset=\"utf-8\">\n";
            $htmlOut .= "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
            $htmlOut .= "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
            $htmlOut .= "\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\n\n";
            $htmlOut .= "\t<title>Login App</title>\n\n";
            $htmlOut .= "\t<!-- Bootstrap -->\n";
            $htmlOut .= "\t<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n\n";
            $htmlOut .= "\t<!-- Custom styles for this template -->\n";
            $htmlOut .= "\t<link href=\"css/signin.css\" rel=\"stylesheet\">\n\n";
            $htmlOut .= "\t<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n";
            $htmlOut .= "\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n\n";
            $htmlOut .= "\t<!--[if lt IE 9]>\n";
            $htmlOut .= "\t\t<script src=\"js/html5shiv.min.js\"></script>\n";
            $htmlOut .= "\t\t<script src=\"js/respond.min.js\"></script>\n";
            $htmlOut .= "\t<![endif]-->\n\n";
            $htmlOut .= "\t<style media=\"screen\" type=\"text/css\">\n\n";
            $htmlOut .= "\t\t.container {\n";
            $htmlOut .= "\t\t\tmax-width: 480px;\n";
            $htmlOut .= "\t\t}\n\n";
            $htmlOut .= "\t</style>\n\n";
            $htmlOut .= "</head>\n\n";
            $htmlOut .= "<body>\n\n";
            $htmlOut .= "\t<div class=\"container theme-showcase\" role=\"main\">\n";
            $htmlOut .= "\t\t<!-- Main jumbotron for a primary marketing message or call to action -->\n";
            $htmlOut .= "\t\t<div class=\"jumbotron\">\n";


                if (isset($_GET["check"])) {
                    $htmlOut .= "\t\t\t<h2>Hello, " . $_SESSION['REMOTE_USER'] . "!<br /><br /><br />You are still logged in.<br /><br /><br /><br /></h2>\n";

                } else {
                    $htmlOut .= "\t\t\t<h2>Welcome, " . $_SESSION['REMOTE_USER'] . "!<br /><br /><br />You are logged in.</h2><br /><br /><p><a href=\"index.php?check=1\">Check cookie</a><br /><br /><br /><br /></p>\n";
                }


            $htmlOut .= "\t\t\t<form action=\"index.php\" method=\"post\">\n";
            $htmlOut .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"logout\" type=\"submit\" value=\"2\">Logout</button>\n";
            $htmlOut .= "\t\t\t</form>\n";
            $htmlOut .= "\t\t</div> <!-- /jumbotron -->\n";
            $htmlOut .= "\t</div> <!-- /container -->\n\n";
            $htmlOut .= "\t<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->\n";
            $htmlOut .= "\t<script src= \"js/jquery.min.js\"></script>\n";
            $htmlOut .= "\t<!-- Include all compiled plugins (below), or include individual files as needed -->\n";
            $htmlOut .= "\t<script src=\"js/bootstrap.min.js\"></script>\n";
            $htmlOut .= "\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->\n";
            $htmlOut .= "\t<script src=\"js/ie10-viewport-bug-workaround.js\"></script>\n\n";
            $htmlOut .= "\t<script src=\"js/validator.min.js\"></script>\n\n";
            $htmlOut .= "</body>\n\n";
            $htmlOut .= "</html>";

        }

        $this->htmlout = $htmlOut;

    }

    public function render () {

        echo $this->htmlout;
    }

}