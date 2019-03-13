<?php

class DataStorage
{

    protected static $link;


    public function getConnection($getLink = TRUE)
    {

        $link = NULL;

        if ($link === NULL) {

            $link = mysqli_connect('localhost:3306', 'root', null, 'olivier_session_app');

        } elseif ($getLink === FALSE) {

            mysqli_close($link);

        }

        return $link;

    }






    public static function queryResults($query)
    {

        $link = self::getConnection();

        $result = mysqli_query($link, $query);

        $values = mysqli_fetch_assoc($result);

        self::getConnection(FALSE);

        return $values;

    }


    public static function getQuote()
    {
        return "'";
    }




    public function checkLogin($username, $password)
    {

        $query = 'SELECT `username`, `password` FROM `users` WHERE `username` LIKE ' . self::getQuote() . $username . self::getQuote();

        $values = self::queryResults($query);

        $passwordVerified = password_verify($password, $values['password']);

        return $passwordVerified;
    }







}

