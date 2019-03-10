<?php


// 'getConnection' and 'getQuote' functions.
function getConnection($getLink = TRUE)
{
    
    static $link = NULL;
    
    if ($link === NULL) {
        
        $link = mysqli_connect('localhost:3306', 'loginuser', 'testpass', 'julien_session_app');
        
    } elseif ($getLink === FALSE) {
        
        mysqli_close($link);
        
    }
    
    return $link;
    
}

function getQuote()
{
    
    return "'";
    
}

function queryResults($query)
{
    
    $link = getConnection();
    
    $result = mysqli_query($link, $query);
    
    $values = mysqli_fetch_assoc($result);
    
    getConnection(FALSE);

    return $values;
    
}

// SELECT `username`, `password` FROM `users` WHERE `username` LIKE $username; 
function checkLogin($username, $password)
{
    
    $query = 'SELECT `username`, `password` FROM `users` WHERE `username` LIKE ' . getQuote() . $username . getQuote();
    
    $values = queryResults($query);
    
    $passwordVerified = password_verify($password, $values['password']);
    
    return $passwordVerified;
    
}
