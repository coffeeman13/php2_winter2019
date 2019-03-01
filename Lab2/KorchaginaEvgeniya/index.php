<?php
/**
 * Created by PhpStorm.
 * User: Evgeniya
 * Date: 2019-02-28
 * Time: 1:36 PM
 */


// curl -X POST -d "username=test&password=test&submit=1" localhost/

// Start output buffering.
ob_start();

require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'evgeniyadb_mysql_include.php';

require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'evgeniyadb_session_include.php';

// Set flags.
$loginCheck = FALSE;
$validSession = FALSE;
$postLoginForm = TRUE;

// Initialize application business and frontend messages.
$errorMessage = 0;
$userMessage = '';

// Check if user is already logged in.
if (isset($_COOKIE['loggedin'])) {

    if ($validSession === FALSE) {

        $validSession = session_secure_init();
    }

    //  Check for cookie tampering.
    if ($validSession === TRUE && isset($_SESSION['LOGGEDIN'])) {
        $postLoginForm = FALSE;
    } else {
        $validSession = session_obliterate();
        $errorMessage = 3;
        $postLoginForm = TRUE;
    }

    // Cookie login check done.
    $loginCheck = TRUE;
}

// Login verification.
if (isset($_POST['submit'])
    && $_POST['submit'] == 1
    && !empty($_POST['username'])
    && !empty($_POST['password'])) {

    if ($validSession === FALSE) {

        $validSession = session_secure_init();
    }

    $username = (string) $_POST['username'];
    $password = (string) $_POST['password'];

    if (!ctype_alpha($username)) {

        $username = preg_replace("/[^a-zA-Z]+/", "", $username);
    }

    if (strlen($username) > 40) {

        $username = substr($username, 0, 39);
    }

    $password = preg_replace("/[^_a-zA-Z0-9]+/", "", $password);

    if (strlen($password) > 40) {

        $password = substr($password, 0, 39);
    }

    // Check credentials.
    if (checkLogin($username, $password)) {

        if ($validSession === TRUE) {

            //  Check for cookie tampering.
            if (isset($_SESSION['LOGGEDIN'])) {

                $validSession = session_obliterate();
                $errorMessage = 3;
                $postLoginForm = TRUE;

            } else {

                setcookie('loggedin', TRUE, time()+ 4200, '/');
                $_SESSION['LOGGEDIN'] = TRUE;
                $_SESSION['REMOTE_USER'] = $username;
                $postLoginForm = FALSE;
            }

        } else {

            $validSession = session_obliterate();
            $errorMessage = 3;
            $postLoginForm = TRUE;
        }

    } else {

        $validSession = session_obliterate();
        $errorMessage = 1;
        $postLoginForm = TRUE;
    }

    // Username-password login check done.
    $loginCheck = TRUE;
}

// Intercept logout POST.
if (isset($_POST['logout'])) {

    if ($validSession === FALSE) {

        session_secure_init();
    }

    $validSession = session_obliterate();
    $errorMessage = 2;
    $postLoginForm = TRUE;
}

// Intercept invalid sessions and redirect to login page.
if ($loginCheck === TRUE && $validSession === FALSE && $errorMessage === 0) {

    if ($validSession === FALSE) {

        $validSession = session_secure_init();
        $validSession = session_obliterate();
    }

    $errorMessage = 3;
    $postLoginForm = TRUE;
}

// Prepare view output.
if ($postLoginForm === TRUE) {

    switch ($errorMessage) {
        case 0:
            $userMessage = 'Please sign in';
            break;
        case 1:
            $userMessage = 'Wrong credentials!  <a href="index.php">Try again</a>.';
            break;
        case 2:
            $userMessage = 'You are logged out!  <a href="index.php">You can login again</a>.';
            break;
        case 3:
            $userMessage = 'Invalid session <a href="index.php">Please login again</a>.';
            break;
    }
//    $htmlOut =  "<!DOCTYPE html>\n";
//    $htmlOut .= "<html lang=\"en\">\n";
//    $htmlOut .= "<head>\n";
//    $htmlOut .= "\t<meta charset=\"utf-8\">\n";
//    $htmlOut .= "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
//    $htmlOut .= "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
//    $htmlOut .= "\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\n\n";
//    $htmlOut .= "\t<title>Login App</title>\n\n";
//    $htmlOut .= "<link href=\"//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css\" rel=\"stylesheet\" id=\"bootstrap-css\">\n";
//    $htmlOut .= "<script src=\"//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js\"></script>\n";
//    $htmlOut .= "<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>\n";
//    $htmlOut .= "<!------ Include the above in your HEAD tag ---------->\n";
//    $htmlOut .= "	<title>Login Page</title>\n";
//    $htmlOut .= "   <!--Made with love by Mutiullah Samim -->\n";
//    $htmlOut .= "   \n";
//    $htmlOut .= "	<!--Bootsrap 4 CDN-->\n";
//    $htmlOut .= "	<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">\n";
//    $htmlOut .= "    \n";
//    $htmlOut .= "    <!--Fontawesome CDN-->\n";
//    $htmlOut .= "	<link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.3.1/css/all.css\" integrity=\"sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU\" crossorigin=\"anonymous\">\n";
//    $htmlOut .= "\n";
//    $htmlOut .= "	<!--Custom styles-->\n";
//    $htmlOut .= "\t<link href=\"css/signin.css\" rel=\"stylesheet\">\n\n";
//    $htmlOut .= "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/styles.css\">\n";
//    $htmlOut .= "\t\t<script src=\"js/html5shiv.min.js\"></script>\n";
//    $htmlOut .= "\t\t<script src=\"js/respond.min.js\"></script>\n";
//    $htmlOut .= "</head>\n";
//    $htmlOut .= "<body>\n";
//
//    if ($errorMessage === 0) {
//
//        $htmlOut .= "<div class=\"container\">\n";
//        $htmlOut .= "	<div class=\"d-flex justify-content-center h-100\">\n";
//        $htmlOut .= "		<div class=\"card\">\n";
//        $htmlOut .= "			<div class=\"card-header\">\n";
//        $htmlOut .= "\t\t\t<h3>" . $userMessage . "</h3>\n";
//        $htmlOut .= "			</div>\n";
//        $htmlOut .= "			<div class=\"card-body\">\n";
//        $htmlOut .= "				<form action=\"index.php\" method=\"post\" data-toggle=\"validator\" role=\"form\">\n";
//        $htmlOut .= "					<div class=\"input-group form-group\">\n";
//        $htmlOut .= "						<div class=\"input-group-prepend\">\n";
//        $htmlOut .= "							<span class=\"input-group-text\"><i class=\"fas fa-user\"></i></span>\n";
//        $htmlOut .= "						</div>\n";
//        $htmlOut .= "						<input type=\"text\" placeholder=\"Username\" class=\"form-control\" id=\"inputUsername\" name=\"username\" placeholder=\"username\">\n";
//        $htmlOut .= "						\n";
//        $htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
//        $htmlOut .= "					</div>\n";
//        $htmlOut .= "					<div class=\"input-group form-group\">\n";
//        $htmlOut .= "						<div class=\"input-group-prepend\">\n";
//        $htmlOut .= "							<span class=\"input-group-text\"><i class=\"fas fa-key\"></i></span>\n";
//        $htmlOut .= "						</div>\n";
//        $htmlOut .= "						<input type=\"password\" id=\"inputPassword\" class=\"form-control\" name=\"password\" placeholder=\"password\">\n";
//        $htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
//        $htmlOut .= "					</div>\n";
//        $htmlOut .= "					<div class=\"form-group\">\n";
//        $htmlOut .= "						<button type=\"submit\" class=\"btn float-right login_btn\" name=\"submit\" value=\"1\">Submit</button>\n";
//        $htmlOut .= "					</div>\n";
//        $htmlOut .= "				</form>\n";
//        $htmlOut .= "			</div>\n";
//        $htmlOut .= "		</div>\n";
//        $htmlOut .= "	</div>\n";
//        $htmlOut .= "</div>\n";
//    } else {
//        $htmlOut .= "\t<div class=\"container theme-showcase\" role=\"main\">\n";
//        $htmlOut .= "\t\t<!-- Main jumbotron for a primary marketing message or call to action -->\n";
//        $htmlOut .= "\t\t<div class=\"jumbotron\">\n";
//        $htmlOut .= "\t\t\t<h2>" . $userMessage . "</h2>\n";
//        $htmlOut .= "\t\t</div> <!-- /jumbotron -->\n";
//        $htmlOut .= "\t</div> <!-- /container -->\n\n";
//    }
//
//    $htmlOut .= "\t<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->\n";
//    $htmlOut .= "\t<script src=\"js/jquery.min.js\"></script>\n";
//    $htmlOut .= "\t<!-- Include all compiled plugins (below), or include individual files as needed -->\n";
//    $htmlOut .= "\t<script src=\"js/bootstrap.min.js\"></script>\n";
//    $htmlOut .= "\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->\n";
//    $htmlOut .= "\t<script src=\"js/ie10-viewport-bug-workaround.js\"></script>\n";
//    $htmlOut .= "\t<!-- Form validator for Bootstrap 3 -->\n";
//    $htmlOut .= "\t<script src=\"js/validator.min.js\"></script>\n\n";
//    $htmlOut .= "</body>\n\n";
//    $htmlOut .= "</html>";
//
//} else {
//
//    $htmlOut = "<!DOCTYPE html>\n\n";
//    $htmlOut .= "<html lang=\"en\">\n\n";
//    $htmlOut .= "<head>\n\n";
//    $htmlOut .= "\t<meta charset=\"utf-8\">\n";
//    $htmlOut .= "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
//    $htmlOut .= "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
//    $htmlOut .= "\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\n\n";
//    $htmlOut .= "\t<title>Login App</title>\n\n";
//    $htmlOut .= "\t<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n";
//    $htmlOut .= "\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n\n";
//    $htmlOut .= "\t<!--[if lt IE 9]>\n";
//    $htmlOut .= "\t\t<script src=\"js/html5shiv.min.js\"></script>\n";
//    $htmlOut .= "\t\t<script src=\"js/respond.min.js\"></script>\n";
//    $htmlOut .= "\t<![endif]-->\n\n";
//    $htmlOut .= "\t<style media=\"screen\" type=\"text/css\">\n\n";
//    $htmlOut .= "\t\t.container {\n";
//    $htmlOut .= "\t\t\tmax-width: 480px;\n";
//    $htmlOut .= "\t\t}\n\n";
//    $htmlOut .= "\t</style>\n\n";
//    $htmlOut .= "</head>\n\n";
//    $htmlOut .= "<body>\n\n";
//    $htmlOut .= "\t<div class=\"container theme-showcase\" role=\"main\">\n";
//    $htmlOut .= "\t\t<!-- Main jumbotron for a primary marketing message or call to action -->\n";
//    $htmlOut .= "\t\t<div class=\"jumbotron\">\n";
//
//    if (isset($_GET["check"])) {
//
//        $htmlOut .= "\t\t\t<h2>Hello, " . $_SESSION['REMOTE_USER'] . "!<br /><br /><br />You are still logged in.<br /><br /><br /><br /></h2>\n";
//
//    } else {
//
//        $htmlOut .= "\t\t\t<h2>Welcome, " . $_SESSION['REMOTE_USER'] . "!<br /><br /><br />You are logged in.</h2><br /><br /><p><a href=\"index.php?check=1\">Check cookie</a><br /><br /><br /><br /></p>\n";
//    }
//
//    $htmlOut .= "\t\t\t<form action=\"index.php\" method=\"post\">\n";
//    $htmlOut .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"logout\" type=\"submit\" value=\"2\">Logout</button>\n";
//    $htmlOut .= "\t\t\t</form>\n";
//    $htmlOut .= "\t\t</div> <!-- /jumbotron -->\n";
//    $htmlOut .= "\t</div> <!-- /container -->\n\n";
//    $htmlOut .= "\t<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->\n";
//    $htmlOut .= "\t<script src= \"js/jquery.min.js\"></script>\n";
//    $htmlOut .= "\t<!-- Include all compiled plugins (below), or include individual files as needed -->\n";
//    $htmlOut .= "\t<script src=\"js/bootstrap.min.js\"></script>\n";
//    $htmlOut .= "\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->\n";
//    $htmlOut .= "\t<script src=\"js/ie10-viewport-bug-workaround.js\"></script>\n\n";
//    $htmlOut .= "</body>\n\n";
//    $htmlOut .= "</html>";
//
//}
//
//// Render and then send the response to the client by flushing the buffer.
//echo $htmlOut;

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
        $htmlOut .= "\t\t<form class=\"form-signin\" action=\"signup.php\" method=\"post\" data-toggle=\"validator\" role=\"form\">\n";
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
    $htmlOut .= "</body>\n\n";
    $htmlOut .= "</html>";

}

// Render and then send the response to the client by flushing the buffer.
echo $htmlOut;

ob_end_flush();

flush();

exit;
