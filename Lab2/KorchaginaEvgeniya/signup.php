<?php

session_start();
ob_start();

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
$htmlOut .= "</head>\n\n";
$htmlOut .= "<body>\n\n";
$htmlOut .= "\t<div class=\"container\">\n";
$htmlOut .= "\t\t<form class=\"form-signin\" method=\"post\" data-toggle=\"validator\" role=\"form\">\n";
$htmlOut .= "\t\t\t<h2 class=\"form-signin-heading\" style=\"margin-bottom: 40px;\">" . "Please fill out the form" . "</h2>\n";
$htmlOut .= "\t\t\t<div class=\"form-group\">\n";
$htmlOut .= "						<img src=\"images/icon_person.png\" id=\"input_img1\">";
$htmlOut .= "\t\t\t\t<label for=\"inputUsername\" class=\"control-label\">Username:</label>\n";
$htmlOut .= "\t\t\t\t<input class=\"form-control\" id=\"inputUsername\" name=\"name\" placeholder=\"Username\" type=\"text\" pattern=\"^[a-zA-Z]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required autofocus>\n";
$htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
$htmlOut .= "\t\t\t</div>\n";
$htmlOut .= "\t\t\t<div class=\"form-group\">\n";
$htmlOut .= "						<img src=\"images/icon_lock.png\" id=\"input_img2\">";
$htmlOut .= "\t\t\t\t<label for=\"inputPassword\" class=\"control-label\">Password:</label>\n";
$htmlOut .= "\t\t\t\t<input class=\"form-control\" id=\"inputPassword\" name=\"password\" placeholder=\"Password\" type=\"password\" pattern=\"^[_a-zA-Z0-9]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required>\n";
$htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
$htmlOut .= "\t\t\t</div>\n";
$htmlOut .= "						<img src=\"images/icon_lock.png\" id=\"input_img2\">";
$htmlOut .= "\t\t\t\t<label for=\"inputPassword\" class=\"control-label\">Repeat password:</label>\n";
$htmlOut .= "\t\t\t\t<input class=\"form-control\" id=\"inputPassword\" name=\"repeatpassword\" placeholder=\"Password\" type=\"password\" pattern=\"^[_a-zA-Z0-9]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required>\n";
$htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
$htmlOut .= "\t\t\t</div>\n";
$htmlOut .= "\t\t\t<div class=\"form-group\">\n";
$htmlOut .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"submit\" type=\"submit\" >Submit</button>\n";
$htmlOut .= "\t\t\t</div>\n";
$htmlOut .= "\t\t</form>\n";
$htmlOut .= "\t\t</form>\n";
$htmlOut .= "\t\t<form class=\"form-signin\" action=\"index.php\" method=\"post\" data-toggle=\"validator\" role=\"form\">\n";
$htmlOut .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"submit\" type=\"submit\" value=\"1\">Back</button>\n";
$htmlOut .= "\t\t</form>\n";
$htmlOut .= "</body>\n\n";
$htmlOut .= "</html>";

echo $htmlOut;

// initializing variables
$name = "";
$errors = array();

function getConnection()
{
    if (!isset($link)) {
        static $link = NULL;
    }

    if ($link === NULL) {
        $link = mysqli_connect('localhost:3306', 'root', '', 'evgeniyadb_login');
    }
    return $link;
}

function closeConnection()
{
    if (!isset($link)) {
        static $link = NULL;
        return FALSE;
    } else {
        mysqli_close($link);
        return TRUE;
    }
}
getConnection();
$db=getConnection();

// REGISTER USER
if (isset($_POST['submit'])) {
    // receive all input values from the form
    $name = $_POST['name'];
    $password = $_POST['password'];
    $passwordrepeat = $_POST['repeatpassword'];

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($name)) {
        array_push($errors, "Username is required");
        echo '<span style="color: firebrick;text-align:center;">Username is required</span>';
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
        echo '<span style="color: firebrick;text-align:center;">Password is required</span>';
    }
    if ($password != $passwordrepeat) {
        array_push($errors, "The two passwords do not match");
        echo '<span style="color: firebrick;text-align:center;">The two passwords do not match</span>';
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM logins WHERE username='$name' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $name) {
            array_push($errors, "Username already exists");
            echo '<span style="color: firebrick;text-align:center;">Username already exists</span>';
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
//        $password = md5($password);//encrypt the password before saving in the database
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO logins (username, password) 
  			  VALUES('$name', '$password')";
        mysqli_query($db, $query);
        $_SESSION['name'] = $name;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
    closeConnection();
}

ob_end_flush();

flush();
exit;