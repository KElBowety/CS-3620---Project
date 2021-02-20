<?php
require_once 'IRegistrationStrategy.php';
require_once 'AdminRegistrationStrategy.php';
require_once 'UserRegistrationStrategy.php';

class Registration
{
    private IRegistrationStrategy $registrationStrategy;

    public function setStrategy(IRegistrationStrategy $strategy) {
        $this->registrationStrategy = $strategy;
    }

    public function register($postData) {
        $result = $this->registrationStrategy->register($postData);
        header( "Location: $result" );
    }
}