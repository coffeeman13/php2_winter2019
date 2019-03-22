<?php
/**
 * Created by PhpStorm.
 * User: Evgeniya
 * Date: 2019-03-06
 * Time: 11:49 PM
 */



class DataStore
{

// Initialize application business and frontend messages.

    protected $errorMessage = 0;
    protected $userMessage = 'Please sign in';
    protected $session="";


    // Set flags.
    protected $loginCheck = FALSE;
    protected $validSession = FALSE;
    protected $postLoginForm = TRUE;

    /**
     * @return int
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return string
     */
    public function getUserMessage()
    {
        return $this->userMessage;
    }

    public function getPostLoginForm() {
        return $this->postLoginForm;
    }


public function getData()
{

// Check if user is already logged in.
    if (isset($_COOKIE['loggedin'])) {

        if ($this->validSession === FALSE) {

            $this->validSession = session_secure_init();
        }

//  Check for cookie tampering.
        if ($this->validSession === TRUE && isset($_SESSION['LOGGEDIN'])) {
            $this->postLoginForm = FALSE;
        } else {
            $this->validSession = session_obliterate();
            $this->errorMessage = 3;
            $this->postLoginForm = TRUE;
        }

// Cookie login check done.
        $this->loginCheck = TRUE;
    }
}

public function loginVerification() {

// Login verification.
    if (isset($_POST['submit'])
        && $_POST['submit'] == 1
        && !empty($_POST['username'])
        && !empty($_POST['password'])) {

        if ($this->validSession === FALSE) {

            $this->validSession = session_secure_init();
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

            if ($this->validSession === TRUE) {

                //  Check for cookie tampering.
                if (isset($_SESSION['LOGGEDIN'])) {

                    $this->validSession = session_obliterate();
                    $this->errorMessage = 3;
                    $this->postLoginForm = TRUE;

                } else {

                    setcookie('loggedin', TRUE, time()+ 4200, '/');
                    $_SESSION['LOGGEDIN'] = TRUE;
                    $_SESSION['REMOTE_USER'] = $username;
                    $this->postLoginForm = FALSE;
                    $this->session =  $_SESSION['REMOTE_USER'];

                }

            } else {

                $this->validSession = session_obliterate();
                $this->errorMessage = 3;
                $this->postLoginForm = TRUE;
            }

        } else {

            $this->validSession = session_obliterate();
            $this->errorMessage = 1;
            $this->postLoginForm = TRUE;
        }

        // Username-password login check done.
        $this->loginCheck = TRUE;
    }

// Intercept logout POST.
    if (isset($_POST['logout'])) {

        if ($this->validSession === FALSE) {

            session_secure_init();
        }

        $this->validSession = session_obliterate();
        $this->errorMessage = 2;
        $this->postLoginForm = TRUE;
    }

// Intercept invalid sessions and redirect to login page.
    if ($this->loginCheck === TRUE && $this->validSession === FALSE && $this->errorMessage === 0) {

        if ($this->validSession === FALSE) {

            $this->validSession = session_secure_init();
            $this->validSession = session_obliterate();
        }

        $this->errorMessage = 3;
        $this->postLoginForm = TRUE;
    }

// Prepare view output.
    if ($this->postLoginForm === TRUE) {

        switch ($this->errorMessage) {
            case 0:
                $this->userMessage = 'Please sign in';
                break;
            case 1:
                $this->userMessage = 'Wrong credentials!  <a href="index.php">Try again</a>.';

                break;
            case 2:
                $this->userMessage = 'You are logged out!  <a href="index.php">You can login again</a>.';
                break;
            case 3:
                $this->userMessage = 'Invalid session <a href="index.php">Please login again</a>.';
                break;
        }
    }

}
}