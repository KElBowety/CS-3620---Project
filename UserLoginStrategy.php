<?php
require_once 'ILoginStrategy.php';

class UserLoginStrategy implements ILoginStrategy
{
    private mysqli $con;

    public function initializeDB($servername, $username, $password, $database)
    {
        $this->con = new mysqli($servername, $username, $password, $database);
    }

    public function login($postData): string
    {
        $username = $postData['user_name'];
        $password = $postData['password'];

        $query = "SELECT * FROM users WHERE user_name = '$username' AND password = '$password' 
                      AND type = 'user' AND status = '1'";
        $result = $this->con->query($query);
        if($result->num_rows == 0) {
            return './HTMLs/NoSuchUser.html';
        }
        else {
            return 'lesa'; //TODO: Link to user page
        }
    }
}