<?php

interface IRegistrationStrategy
{
    public function initializeDB($servername, $username, $password, $database);
    public function register($postData) : string;
}