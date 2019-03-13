<?php
// Start output buffering.
ob_start();

require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'andrew_mysql_example.inc.php';

require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'andrew_session_example.inc.php';

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
            $userMessage = 'Please sign in.';
            break;
        case 1:
            $userMessage = 'Wrong credentials.  <a href="index.php">Try again</a>.';
            break;
        case 2:
            $userMessage = 'You are logged out!  <a href="index.php">You can login again</a>.';
            break;
        case 3:
            $userMessage = 'Invalid session. <a href="index.php">Please login again</a>.';
            break;

    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Signin Template · Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">

<?php if ($userMessage == 0) : ?>
    <div class="container">
        <form class="form-signin" action="index.php" method="post">
            <h2 class="form-signin-heading">" . $userMessage . "</h2>
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
<?php else : ?>
   <div class="container theme-showcase" role="main">
       <div class="jumbotron">\n";
            <h2><?php echo $userMessage ?></h2>
       </div>
   </div>
<?php endif ?>
</body>
</html>

<?php }
ob_end_flush();

flush();

exit;
?>