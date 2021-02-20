<?php

interface ILoginStrategy
{
    public function initializeDB($servername, $username, $password, $database);
    public function login($postData) : string;
}