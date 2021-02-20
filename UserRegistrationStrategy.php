<?php
require_once 'IRegistrationStrategy.php';

class UserRegistrationStrategy implements IRegistrationStrategy
{
    private mysqli $con;

    public function initializeDB($servername, $username, $password, $database)
    {
        $this->con = new mysqli($servername, $username, $password, $database);
    }

    public function register($postData): string
    {
        $name = $postData['name'];
        $username = $postData['user_name'];
        $password = $postData['password'];

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);

        if($uppercase && $lowercase && strlen($password) >= 6) {
            $query = "SELECT * FROM users WHERE user_name = '$username'";
            $result = $this->con->query($query);

            if($result->num_rows == 0) {
                $query = "INSERT INTO users(name, user_name, password, type, status) 
                            VALUES('$name', '$username', '$password', 'user', 1)";
                $result = $this->con->query($query);
                $_SESSION['registered'] = true;
                return "./LoginPage.php";
            }
            else {
                return "./HTMLs/UserExists.html";
            }
        }
        else {
            return "./HTMLs/UserPassword.html";
        }
    }
}