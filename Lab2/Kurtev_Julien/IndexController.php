 <?php
/**
 * Created by PhpStorm.
 * User: z_kurtev
 * Date: 2019-02-06
 * Time: 7:47 PM
 */

class IndexController
{
    protected $dataStore;
    protected $data = [];
    protected $viewManager;

    public function __construct(DataStore $dataStore)
    {
        $this->dataStore = $dataStore;
    }

    public function indexActions()
    {
       
        // Start output buffering.
        ob_start();

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
            if ($this->dataStore->checkLogin($username, $password)) {
                
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

        $this->data['userMassage'] = $userMessage;
        $this->data['errorMessage'] = $errorMessage;
        $this->data['postLoginForm'] = $postLoginForm;

        $this->viewManager = new TemplateManager($this->data);
        $this->viewManager->loadTemplate();
        $this->viewManager->render();

        ob_end_flush();

        flush();

        exit;
    

} 

}
