<?php

interface ICRUD
{
    function initializeDB($servername,$username, $password, $database);
    function readData( $tableName): array;
    function addData($tableName, $postData): bool;
    function updateData($tableName,  $postData): bool;
    function deleteData( $tableName): bool;
    function getById($tableName): bool;
}
