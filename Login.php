<?php
require_once 'ILoginStrategy.php';
require_once 'AdminLoginStrategy.php';
require_once 'UserLoginStrategy.php';

class Login
{
    private ILoginStrategy $loginStrategy;

    public function setStrategy(ILoginStrategy $strategy) {
        $this->loginStrategy = $strategy;
    }

    public function login($postData) {
        $result = $this->loginStrategy->login($postData);
        header( "Location: $result" );
    }
}